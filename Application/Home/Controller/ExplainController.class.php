<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class ExplainController extends FrontendController{
    public function explain_show(){
        if(I('get.id')==8){
          $this->display('Job/job');
          die();
        }
        $this->display();
    }
}
