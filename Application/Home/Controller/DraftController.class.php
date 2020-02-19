<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class DraftController extends FrontendController{
   
    public function index() {
        $detect = new \Common\Util\Mobile_Detect();
        if($detect->isMobile()){
            $utm_source = I('utm_source','');
            $this->assign('utm_source',$utm_source);
            $this->display('draft3_mobile');
            die();
        }
        $utm_source = I('utm_source','');
        $this->assign('utm_source',$utm_source);
        $this->display('draft3');
    }

    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->useNoise = true;
        $Verify->codeSet = '0123456789';
        $Verify->useCurve = false;
        $Verify->fontSize = 50;
        $Verify->length   = 4;
        //$Verify->entry_add();
        $Verify->entry();
        //验证方法：
        //if (!check_verify($verify,'','add')) {
        //$this->error('验证码错误！');
        //return;
        //}

        /*
        $Verify = new \Think\Verify();
        $Verify->fontSize = 32;
        $Verify->length   = 4;
        $Verify->useImgBg = true;
        $Verify->entry();
        */
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = '',$type=''){
        $Verify = new \Think\Verify();
        if($type='add'){
            return $Verify->check_add($code, $id);
          }else{
            return $Verify->check($code, $id);
        }
    }

    function get_yzm(){
        $code=session();
        print_r($code);
        exit;
    }
}