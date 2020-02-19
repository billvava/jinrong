<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class ResourceController extends FrontendController{
	public function _initialize(){
        parent::_initialize();
    }
	
    function company(){
        $this->display();
    }

    function invester(){
        $this->display();
    }

    function institutional_invest(){
        $this->display();
    }
}
?>