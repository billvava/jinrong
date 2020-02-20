<?php
/**
 * 文章模板标签解析
 *
 * @author andery
 */
namespace Common\qscmslib;
class email
{
    private $_error = 0;
    public $mailconfig;
    public function __construct($name) {
        if(false === $this->mailconfig = F('mailconfig')) $this->mailconfig = D('Mailconfig')->get_cache();
    }
    public function smtp_mail($sendto_email,$subject,$body,$From='',$FromName=''){ 

        if($this->mailconfig['method'] == 1 && !$this->mailconfig['smtpservers']){
            $this->_error = '请配置邮箱参数！';
            return false;
        } 
        Vendor('PHPMailer.class#phpmailer');
        $mail = new \PHPMailer();

        $mail->SMTPDebug = 1;
        $this->mailconfig['smtpservers']=explode('|-_-|',$this->mailconfig['smtpservers']);
        $this->mailconfig['smtpusername']=explode('|-_-|',$this->mailconfig['smtpusername']);
        $this->mailconfig['smtppassword']=explode('|-_-|',$this->mailconfig['smtppassword']);
        $this->mailconfig['smtpfrom']=explode('|-_-|',$this->mailconfig['smtpfrom']);
        $this->mailconfig['smtpport']=explode('|-_-|',$this->mailconfig['smtpport']);
        for ($i=0; $i<count($this->mailconfig['smtpservers']); $i++)
        {
        $mailconfigarray[]=array('smtpservers'=>$this->mailconfig['smtpservers'][$i],'smtpusername'=>$this->mailconfig['smtpusername'][$i],'smtppassword'=>$this->mailconfig['smtppassword'][$i],'smtpfrom'=>$this->mailconfig['smtpfrom'][$i],'smtpport'=>$this->mailconfig['smtpport'][$i]);
        }
        $mc=array_rand($mailconfigarray,1);
        $mc=$mailconfigarray[$mc];
        $this->mailconfig['smtpservers']=$mc['smtpservers'];
        $this->mailconfig['smtpusername']=$mc['smtpusername'];
        $this->mailconfig['smtppassword']=$mc['smtppassword'];
        $this->mailconfig['smtpfrom']=$mc['smtpfrom'];
        $this->mailconfig['smtpport']=$mc['smtpport'];
        $From=$From?$From:$this->mailconfig['smtpfrom'];
        $FromName=$FromName?$FromName:$_CFG['site_name'];
        if ($this->mailconfig['method']=="1")
        {
            if (empty($this->mailconfig['smtpservers']) || empty($this->mailconfig['smtpusername']) || empty($this->mailconfig['smtppassword']) || empty($this->mailconfig['smtpfrom']))
            {
                setLog(array('_t'=>'syslog','l_type'=>2,'l_type_name'=>'MAIL','l_str'=>'邮件配置信息不完整'));
                return false;
            }
        $mail->IsSMTP();
        $mail->Host = $this->mailconfig['smtpservers'];
        $mail->SMTPDebug= 0; 
        $mail->SMTPAuth = true;
        // $mail->SMTPSecure = 'ssl';
        $mail->Username = $this->mailconfig['smtpusername']; 
        $mail->Password = $this->mailconfig['smtppassword']; 
        $mail->Port =$this->mailconfig['smtpport'];
        $mail->From =$this->mailconfig['smtpfrom']; 
        $mail->FromName =$FromName;
         // dump($mail->Password);exit;
        }

        elseif($this->mailconfig['method']=="2")
        {
        $mail->IsSendmail();
        }
        elseif($this->mailconfig['method']=="3")
        {
        $mail->IsMail();
        }
        $mail->CharSet ='utf-8';
        $mail->Encoding = "base64";
        $mail->AddReplyTo($From,$FromName);
        $mail->AddAddress($sendto_email,"");
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = htmlspecialchars_decode($body);
        $mail->AltBody ="text/html";
        $result = $mail->Send();
        // dump($mail);exit;
        if($result)
        {

            setLog(array('_t'=>'sys_email_log','send_from'=>$this->mailconfig['smtpusername'],'send_to'=>$sendto_email,'subject'=>$subject,'body'=>addslashes($body),'state'=>1));
            return true;

        }
        else
        {
            echo $mail->ErrorInfo;exit;
            setLog(array('_t'=>'syslog','l_type'=>2,'l_type_name'=>'MAIL','l_str'=>$mail->ErrorInfo));
            setLog(array('_t'=>'sys_email_log','send_from'=>$this->mailconfig['smtpusername'],'send_to'=>$sendto_email,'subject'=>$subject,'body'=>addslashes($body),'state'=>2));
            //$this->_error = $mail->ErrorInfo;
            $this->_error = '邮件无法正常发送！';
            return false;
        }
    }
    /*
        邮件模板替换
    */
    public function label_replace($templates,$replac)
    {
        $replac['sitename']=C('qscms_site_name');
        $replac['sitedomain']=rtrim(C('qscms_site_domain').C('qscms_site_dir'),'/');
        if(!empty($replac)){
            foreach ($replac as $key => $val) {
                $replac['{'.$key.'}'] = $val;
            } 
        }
        return $templates = strtr($templates,$replac);
    }
    public function getError(){
        return $this->_error;
    }
}