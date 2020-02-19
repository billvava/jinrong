<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;

class HuodongController extends MobileController
{
    // 初始化函数
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $this->display();
    }

    function huodong_list(){
      $this->display();
    }

    /**
     * 资讯详情
     */
    public function show()
    {
        $this->display();
    }
}

?>
