<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class MemberLevelController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
        $uid = C('visitor.uid');
        $user_info = M('Members')->where(['uid'=>$uid])->find();
        $this->assign('personal_nav','lemberlevel');
        $this->assign('user_info',$user_info);
		$this->display();
	}

    function growth(){
        $uid = C('visitor.uid');
        $user_info = M('Members')->where(['uid'=>$uid])->find();
        $this->assign('personal_nav','lemberlevel');
        $this->assign('user_info',$user_info);
        $this->display();
    }

    function growth_record(){
        $uid = C('visitor.uid');
        $user_info = M('Members')->where(['uid'=>$uid])->find();
        $this->assign('personal_nav','lemberlevel');
        $this->assign('user_info',$user_info);
        $this->display();
    }
}
?>