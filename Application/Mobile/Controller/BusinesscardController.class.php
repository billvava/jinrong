<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class BusinesscardController extends MobileController{
	public function _initialize() {
        parent::_initialize();
        //访问者控制
        if(I('get.code','','trim') && !in_array(ACTION_NAME,array('order_detail'))){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding',array('openid'=>$this->openid));
        }
        if (!$this->visitor->is_login) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
            //非ajax的跳转页面
            $this->redirect('Members/login');
        }
    }
    protected function _global_variable() {
        // 帐号状态 为暂停
        if (C('visitor.status') == 2 && !in_array(ACTION_NAME, array('index'))){
            $this->_404('您的账号处于暂停状态，请联系管理员设为正常后进行操作！',U('Personal/index'));
        }
        $this->assign('personal_nav',ACTION_NAME);
    }

	function my(){
        $page_seo['header_title']='商友/人脉';
        $this->assign('page_seo',$page_seo);
		$this->display();
	}

    function myfollow(){
        $page_seo['header_title']='商友/人脉';
        $this->assign('page_seo',$page_seo);
        $this->display();
    }

    function myfans(){
        $page_seo['header_title']='商友/人脉';
        $this->assign('page_seo',$page_seo);
        $this->display();
    }

    function contact(){
        $page_seo['header_title']='商友/人脉';
        $this->assign('page_seo',$page_seo);
        $this->display();
    }


	
}
?>