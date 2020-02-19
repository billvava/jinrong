<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;

class ServicesController extends MobileController
{
    // 初始化函数
    function _initialize(){
        parent::_initialize();
    }

    function index(){
        $page_seo['title']=$seo_info['title'];
        $page_seo['header_title']=$seo_info['title'];
        $this->assign('page_seo',$page_seo);
        $this->display();
    }
}

?>
