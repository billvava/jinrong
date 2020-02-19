<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;

class CaseController extends MobileController
{
    // 初始化函数
    function _initialize(){
        parent::_initialize();
    }

    function index(){
        $page_seo['title']='案例展示';
        $page_seo['header_title']='案例展示';
        $case_list = M('Case')->limit()->select();
        $this->assign('case_list',$case_list);
        $this->assign('page_seo',$page_seo);
        $this->display();
    }
    
}

?>
