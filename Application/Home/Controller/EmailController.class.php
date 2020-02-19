<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class EmailController extends FrontendController{

    function _initialize() {
        parent::_initialize();
    }


    function email_send($uid=''){
        $uid = (int)$uid;
        if(empty($uid)){
            return;
        }
        $user_info = M('Members')->field('uid,utype,realname,mobile,reg_time')->where(['uid'=>$uid])->find();
        $_remove = [];
        if(!in_array($user_info['mobile'],$_remove)){
            $subject = '新用户注册';
            $to = '123456@qq.com';
            $phone= $user_info['mobile'];
            $add_time= date('Y-m-d H:i:s',$user_info['reg_time']);
            $this->assign('phone',$phone);
            $this->assign('add_time',$add_time);
            $body = $this->fetch('Emailtpl/tpl');
            $result = person_send_mail($to, $name='', $subject = $subject, $body = $body);
        }
    }

    function draft_email_send($uid=''){
        $uid = (int)$uid;
        if(empty($uid)){
            return;
        }
        $user_info = M('DraftMembers')->field('uid,utype,realname,mobile,reg_time')->where(['uid'=>$uid])->find();
        
        $_remove = [];

        if(!in_array($user_info['mobile'],$_remove)){
            $subject = '票据业务-新用户注册';
            $to = '123456@qq.com';
            $phone= $user_info['mobile'];
            $add_time= date('Y-m-d H:i:s',$user_info['reg_time']);
            $this->assign('phone',$phone);
            $this->assign('add_time',$add_time);
            $body = $this->fetch('Emailtpl/draft_tpl');
            $result = person_send_mail($to, $name='', $subject = $subject, $body = $body);
        }
    }

    function send_piaoju(){
        $subject = '票据业务-新用户注册';
            $to = '123456@qq.com';
            $phone= 13838384388;
            $add_time= date('Y-m-d H:i:s',time());
            $this->assign('phone',$phone);
            $this->assign('add_time',$add_time);
            $body = $this->fetch('Emailtpl/draft_tpl');
            $result = person_send_mail($to, $name='', $subject = $subject, $body = $body);
    }

    function send_rongzi(){
        $subject = '投融资业务-新用户注册';
            $to = '123456@qq.com';
            $phone= 13838384388;
            $add_time= date('Y-m-d H:i:s',time());
            $this->assign('phone',$phone);
            $this->assign('add_time',$add_time);
            $body = $this->fetch('Emailtpl/tpl');
            $result = person_send_mail($to, $name='', $subject = $subject, $body = $body);
    }
}
?>