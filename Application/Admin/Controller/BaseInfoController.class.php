<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class BaseInfoController extends BackendController {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('ArticleCategory');
    }

    public function info_list(){
        $info_type=[1=>'资金信息',2=>'项目信息'];
        $approve = [1=>'审核通过',2=>'待审核'];
        $type=[1=>'Fund',2=>'Item'];
        $pagesize = 20;
        $map= I('get.info_type','');
        if(!empty($map)){
            $where['bi.type'] = $map;
        }
        if($settr = I('request.settr',0,'intval')){
            $where['bi.updatetime'] = array('gt',strtotime("-".$settr." day"));
        }
        if($is_open= I('get.is_open','')){
            $where['bi.is_open'] = intval($is_open);
        }
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $where['bi.title'] = array('like','%'.$key.'%');
                    break;
                case 2:
                    $where['bi.id'] = intval($key);
                    break;
                case 3:
                    $where['m.uid'] = intval($key);
                    break;
                case 4:
                    $where['m.mobile'] = intval($key);
                    break;
            }
        }
        if($pagesize){
            $model = M('BaseInfo');
            $count = $model->alias('bi')->where($where)->count();
            $pager = pager($count, $pagesize);
            $info_list = $model->alias('bi')->join("LEFT JOIN __MEMBERS__ as m on bi.uid = m.uid")->field('bi.id,bi.type,bi.info_type,bi.title,bi.is_open,bi.addtime,bi.updatetime,bi.click,bi.uid,m.uid,m.mobile')->where($where)->limit($pager->firstRow.','.$pager->listRows)->order('bi.updatetime desc,bi.addtime desc')->select();
            $status = [0=>'等待审核',1=>'审核通过',2=>'等待审核'];
        }
        foreach ($info_list as $k => $v) {
            $info_list[$k]['type_en'] =$type[$v['type']];
            $info_list[$k]['info_status'] = $status[$v['is_open']];
        }
        $page = $pager->fshow();
        $this->assign("page",$page);
        $this->assign('type',$type);
        $this->assign('info_type',$info_type);
        $this->assign('approve',$approve);
        $this->assign('info_list',$info_list);
        $this->assign('pagesize',$pagesize);
        $this->assign('count',$count);
        $this->display();
    }

    public function edit($id=''){
		if(IS_POST){
			$id = I('post.id');
			$data['is_top'] = I('post.is_top');
            $data['is_open'] = I('post.is_open','2');
            if(!empty($_FILES['top_img']['tmp_name'])){
                if(!$_FILES['top_img']['name']) return false;
                $date = date('y/m/d/');
                $result = $this->_upload($_FILES['top_img'], 'images/' . $date, array(
                        'maxSize' => 2*1024,//图片最大2M
                        'uploadReplace' => true,
                        'attach_exts' => 'bmp,png,gif,jpeg,jpg'
                ));
                if ($result['error']) {
                    $data['top_img'] = $date.$result['info'][0]['savename'];
                } else {
                    $this->ajaxReturn(0, $result['info']);
                }
            }
			$result = M('BaseInfo')->where(['id'=>$id])->data($data)->save();
			if($result){
				$this->success('修改成功');
				die();
			}else{
				$this->error('修改失败');
				die();
			}
		}
		if(empty($id)){
			$this->error('信息不存在');
		}
		$info = M('BaseInfo')->where(['id'=>$id])->find();
        $msg_list = R('Msg/Api/msg_list',['id'=>$id,'','ext'=>1,'pos'=>0]);
        $msg_type=[0=>'对外开放',1=>'楼主可见',2=>'会员可见'];
        foreach ($msg_list as $k => &$v){
            $v['public'] = $msg_type[$v['public']];
        }
        $this->assign('msg_list',$msg_list);
		$this->assign('info',$info);
		$this->display();
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