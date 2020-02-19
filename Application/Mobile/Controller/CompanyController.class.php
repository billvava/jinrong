<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class CompanyController extends MobileController{
    public function _initialize(){
        parent::_initialize();
        //访问者控制
        if(I('get.code','','trim') && !in_array(ACTION_NAME,array('order_detail'))){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding');
        }
        if (!$this->visitor->is_login) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
            //非ajax的跳转页面
            $this->redirect('members/login');
        }
        if(!IS_AJAX){
            $this->_global_variable();
        }else{
            $this->_cominfo_flge();
        }
    }
    protected function _global_variable() {
        C('visitor.utype') !=1 && $this->redirect('members/login');
        // 顾问信息
        if(C('visitor.consultant')>0){
            $consultant = M('Consultant')->where(array('id'=>C('visitor.consultant')))->find();
            $this->assign('consultant',$consultant);
        }
        // 帐号状态 为暂停
        if (C('visitor.status') == 2 && !in_array(ACTION_NAME, array('index'))){
            $this->_404('您的账号处于暂停状态，请联系管理员设为正常后进行操作！',U('Company/index'));
        }
        // 短信必须验证
        if (C('qscms_sms_open')==1 && C('qscms_login_com_audit_mobile')==1 && C('visitor.mobile_audit') == 0 && !in_array(ACTION_NAME, array('com_security_tel'))){
            $this->_404('您的手机未认证，认证后才能进行其他操作！',U('Company/com_security_tel'));
        }
        $this->_cominfo_flge();
        // 强制认证营业执照
        if (C('qscms_login_com_audit_certificate')==1 && $this->company_profile['audit'] !=1 && !in_array(ACTION_NAME, array('com_auth'))){
            $this->_404('您的营业执照未认证，认证后才能进行其他操作！',U('Company/com_auth'));
        }
        $this->assign('company_profile',$this->company_profile);
        $this->assign('cominfo_flge',$this->cominfo_flge);
        // 第一次登录
        if(!S('personal_login_first_'.C('visitor.uid'))){
            S('personal_login_first_'.C('visitor.uid'),1,86400-(time()-strtotime("today")));
            //快到期提醒
            $my_setmeal = D('MembersSetmeal')->get_user_setmeal(C('visitor.uid'));
            if($my_setmeal['endtime']>0){
                if(C('qscms_meal_min_remind')==0){
                    $confirm_setmeal = 0;
                }else{
                    if($my_setmeal['endtime'] - time()>C('qscms_meal_min_remind')){
                        $confirm_setmeal = 0;
                    }else{
                        $confirm_setmeal = 1;
                    }
                }
                $this->assign('confirm_setmeal',$confirm_setmeal);
            }
        }
        $this->assign('company_nav',ACTION_NAME);
    }
    

}
?>