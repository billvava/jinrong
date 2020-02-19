<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class ResourceController extends BackendController{
    public function _initialize() {
        parent::_initialize();
    }

    public function index(){
        $this->assign('list',$list);
        $this->display();
    }

    //创业公司
    function company(){
        $this->display();
    }

    //投资机构
    function institutional_invest(){
        $this->display();
    }

    //新增投资机构
    function institutional_invest_add(){
        if(IS_POST){
            $data = I('post.');
            if(!empty($_FILES['small_img']['tmp_name'])){
                if(!$_FILES['small_img']['name']) return false;
                $date = date('y/m/d/');
                $result = $this->_upload($_FILES['small_img'], 'images/' . $date, array(
                        'maxSize' => 2*1024,//图片最大2M
                        'uploadReplace' => true,
                        'attach_exts' => 'bmp,png,gif,jpeg,jpg'
                ));
                if ($result['error']) {
                    $data['small_img'] = $date.$result['info'][0]['savename'];
                } else {
                    $this->ajaxReturn(0, $result['info']);
                }
            }
            print_r($data);
            exit;
        }
        $this->display();
    }

    //创业者
    function entrepreneur(){
        $this->display();
    }

    //投资人
    function invester(){
        $this->display();
    }
    
}
?>