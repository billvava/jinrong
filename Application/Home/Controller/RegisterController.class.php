<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class RegisterController extends FrontendController{
	// 初始化函数
	public function _initialize(){
		parent::_initialize();
	}

	function success(){
        $this->display();
    }
	
}
?>