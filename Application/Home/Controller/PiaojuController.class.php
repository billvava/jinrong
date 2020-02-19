<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class PiaojuController extends FrontendController{

	public function _initialize(){
		parent::_initialize();
	}

    function index(){
        $this->display();
    }
}
?>