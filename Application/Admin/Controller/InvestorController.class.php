<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class InvestorController extends BackendController{
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('ArticleCategory');
    }

    public function _before_index(){
        if(false === $article_property = F('article_property')){
            $article_property = D('ArticleProperty')->article_property_cache();
        }
        $this->assign('article_category',$article_category);
        //$this->list_relation = true;
        $this->assign('parentid',I('get.parentid',0,'intval'));
        $this->order = 'article_order desc';
    }

    /**
     * [_before_search 查询条件]
     */
    public function _before_search($data){
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $data['name'] = array('like','%'.$key.'%');
                    break;
                case 2:
                    $data['id'] = intval($key);
                    break;
            }
        }
        return $data;
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

    /**
     * [_before_edit 修改资讯信息]
     */
    public function _before_edit(){
        $this->_before_add();
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