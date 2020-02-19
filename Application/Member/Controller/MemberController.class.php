<?php
namespace Member\Controller;
use Common\Controller\FrontendController;
class MemberController extends FrontendController{
	
    public function _initialize() {
		parent::_initialize();
	}

	public function receive(){
		$this->display();
	}

    public ttt(){
        echo 333;
        exit;
    }
	
}
?>