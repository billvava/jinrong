<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
/**
 * 数据库表结构
 */
class HandbookController extends FrontendController{

     /**
     * 数据库列表
     */
    public function index(){
        $database_list = D('Database')->loadTableList();
        $Field_list  = D('Database')->loadTableField();
        $this->assign('database_list',$database_list);
        $this->assign('Field_list',$Field_list);
        $this->display();
    }

}

