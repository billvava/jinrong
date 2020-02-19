<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class SchoolController extends BackendController {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('SchoolCategory');
    }
    function index(){
       $this->display();
    }

    function _before_add(){
      $school_category = $this->_mod->get_school_category_cache('all');
      $this->assign('school_category',$school_category);
      $this->display();
    }
}
