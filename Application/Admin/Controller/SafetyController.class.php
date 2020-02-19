<?php
namespace Admin\Controller;
use Common\Controller\ConfigbaseController;
class SafetyController extends ConfigbaseController {
    public function _initialize() {
        parent::_initialize();
    }
    /**
     * 验证设置
     */
    public function index(){
        $this->_edit();
        $this->display();
    }
    /**
     * 禁止ip设置
     */
    public function ipFilter(){
        $this->_edit();
        $this->display();
    }
    /**
     * 敏感词列表
     */
    public function badwordIndex(){
        $this->_name = 'Badword';
        if(IS_POST){
            $this->_edit();
            exit;
        }
        parent::index();
    }
    /**
     * 添加敏感词
     */
    public function badwordAdd(){
        $this->_name = 'Badword';
        $this->add();
    }
    /**
     * 编辑敏感词
     */
    public function badwordEdit(){
        $this->_name = 'Badword';
        $this->edit();
    }
    /**
     * 删除敏感词
     */
    public function badwordDelete(){
        $this->_name = 'Badword';
        $this->delete();
    }
}