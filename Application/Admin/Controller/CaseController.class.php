<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class CaseController extends BackendController{
    public function _initialize() {
        parent::_initialize();
    }

    public function index(){
        $list = M('Article')->where(['type_id'=>25])->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function _before_add(){
        if(IS_POST){
            if(!$_FILES['Small_img']['name']) return false;
            $date = date('y/m/d/');
            $result = $this->_upload($_FILES['Small_img'], 'images/' . $date, array(
                    'maxSize' => 2*1024,//图片最大2M
                    'uploadReplace' => true,
                    'attach_exts' => 'bmp,png,gif,jpeg,jpg'
            ));
            if ($result['error']) {
                $_POST['Small_img'] = $date.$result['info'][0]['savename'];
            } else {
                $this->ajaxReturn(0, $result['info']);
            }
        }
    }

    
    public function edit(){
        $id = I('get.id');
        if(!$id){
            return;
        }
        if(IS_POST){
            $data = I('post.');
            $info = M('Article')->where(['id'=>$id])->save($data);
        }
        $info = M('Article')->where(['id'=>$id])->find();
        $this->assign('info',$info);
        $this->display();
    }
    
    /**
     * [del_img 删除缩略图]
     */
    public function del_img(){
        $id = I('get.id',0,'intval');
        $Small_img = D('Article')->where(array('id'=>$id))->getfield('Small_img');
        false === $Small_img && $this->error('投资机构不存在或已经删除！');
        if($Small_img){
            $reg = D('Article')->where(array('id'=>$id))->setfield('Small_img','');
            if(false !== $reg){
                @unlink(C('qscms_attach_path')."images/".$Small_img);
            }else{
                $this->error('缩略图删除失败，请重新操作！');
            }
        }
        $this->success('缩略图删除成功！');
    }
}
?>