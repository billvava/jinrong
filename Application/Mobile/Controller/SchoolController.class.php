<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;

class SchoolController extends MobileController
{
    // 初始化函数
    function _initialize(){
        parent::_initialize();
    }

    function index(){
        $title = [95=>'投融学院'];
        $page_seo['title']='投融学院';
        $page_seo['header_title']='投融学院';
        $this->assign('page_seo',$page_seo);
        $this->display();
    }
}

?>
