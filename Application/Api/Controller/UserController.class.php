<?php
namespace Api\Controller;
class UserController{

    function login(){
        $request = $_POST['data'];
        parse_str($request, $data);
        $username = trimall($data['username']);
        $password = trimall($data['password']);
        //exit(json_encode((I('post.'))));
        $passport = new \Common\qscmslib\passport('default');
        $visitor = new \Common\qscmslib\user_visitor();
        if(false === $uid = $passport->auth($username, $password)) $err = $passport->get_error();
        if($uid){
            if(false === $visitor->login($uid, $expire))ajax_out(0,0,$visitor->getError());
            $data['session'] = session('_7rh'.md5(C('PWDHASH')));
            ajax_out($data,200,'登录成功');
        }else{
            ajax_out('',0,'账户名或密码错误');
        }
    }

    function sendSms(){
        header("Access-Control-Allow-Origin:*");
        if(false === $config = F('config')){
            $config = D('Config')->config_cache();
        }
        C($config);
        $request = $_POST['data'];
        parse_str($request, $data);
        $mobile = $data['mobile'];
        !$mobile && ajax_out('',0,'请填手机号码！');
        if(!fieldRegex($mobile,'mobile')) ajax_out('',0,'手机号错误！');
        $sms_type = I('post.sms_type','reg','trim');
        $user_info = M('Members')->where(['mobile'=>$mobile])->find();
        if($user_info){
            ajax_out('',0,'用户已经存在,请登录！');
        }
        $rand=mt_rand(100000, 999999);
        switch ($sms_type) {
            case 'reg':
                $sendSms['tpl']='set_register';
                $sendSms['data']=array('code'=>$rand.'');
                break;
            case 'gsou_reg':
                $sendSms['tpl']='set_register';
                $sendSms['data']=array('code'=>$rand.'');
                break;
            case 'getpass':
                $sendSms['tpl']='set_retrieve_password';
                $sendSms['data']=array('code'=>$rand.'');
                break;
            case 'login':
                if(!$uid=M('Members')->where(array('mobile'=>$mobile))->getfield('uid')) ajax_out('',0,'您输入的手机号未注册会员');
                $sendSms['tpl']='set_login';
                $sendSms['data']=array('code'=>$rand.'');
                break;
        }
        $smsVerify = session($sms_type.'_smsVerify');
        if($smsVerify && $smsVerify['mobile']==$mobile && time()<$smsVerify['time']+600) ajax_out('',0,'10分钟内仅能获取一次短信验证码,请稍后重试');
        $sendSms['mobile']=$mobile;
        if(true === $reg = D('Sms')->sendSms('captcha',$sendSms)){
            session($sms_type.'_smsVerify',array('code'=>substr(md5($rand), 8,16),'time'=>time(),'mobile'=>$mobile));
            ajax_out('',200,'手机验证码发送成功！');
        }else{
            ajax_out('',0,$reg);
        }
    }

    function cn(){
        if(false === $config = F('config')){
            $config = D('Config')->config_cache();
        }
        C($config);
        print_r(C());
        exit;
    }

    function message(){
        
    }
}