<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class HuodongController extends BackendController{
	public function _initialize() {
        parent::_initialize();
        $this->_mod = D('Huodong');
    }

    public function _before_index(){

    }

    public function _before_search($data){
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $data['title'] = array('like','%'.$key.'%');
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
    	}else{
	    	$this->assign('article_property',$article_property);
	    	$this->assign('article_category',$article_category);
    	}
    }
    

    public function _before_edit(){
        $article_category = D('ArticleCategory')->get_article_category_cache('all');
        if(false === $article_property = F('article_property')){
            $article_property = D('ArticleProperty')->article_property_cache();
        }
        $this->assign('article_property',$article_property);
        $this->assign('article_category',$article_category);
    	$this->_before_add();
    }
    
    public function del_img(){
    	$id = I('get.id',0,'intval');
    	$Small_img = D('Article')->where(array('id'=>$id))->getfield('Small_img');
    	false === $Small_img && $this->error('新闻不存在或已经删除！');
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
    
    public function property(){
    	$this->_name='ArticleProperty';
        $this->order = 'category_order desc,id';
    	$this->index();
    }
    
    public function add_property(){
    	$this->_name = 'ArticleProperty';
    	$this->add();
    }
    
    public function edit_property(){
    	$this->_name = 'ArticleProperty';
    	$this->edit();
    }
    
    public function del_property(){
    	$this->_name = 'ArticleProperty';
        $this->_map['admin_set'] = array('neq',1);
    	$this->delete();
    }
}
?>