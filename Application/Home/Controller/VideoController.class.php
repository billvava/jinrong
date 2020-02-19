<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class VideoController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}

	public function index(){
        $page_seo['title']='视频中心';
        $this->assign('page_seo',$page_seo);
		$this->display();
	}

    function video_list(){
        $page_seo['title']='视频中心';
        $p = I('get.p');
        if($p>=2){
            $this->error('充值会员可查看更多!',U('Video/video_list'));
        }
        $count = M('Article')->where(['type_id'=>3])->count();
        $limit = $this->getPageLimit($count,8);
        $video_list = M('Article')->where(['type_id'=>3])->order('id asc')->limit($limit)->select();
        $page = $this->getPageShow($pageMaps);
        $this->assign('page', $page);
        $this->assign('video_list',$video_list);
        $this->assign('page_seo',$page_seo);
        $this->display();
    }

    function show(){
        $id = I('get.id');
        $type = I('get.type');
        if(!$id){
            $this->error('信息不存在');
        }
        
        if($type==1){

            $res['code'] =200;
            $res['msg'] = '';
            echo json_encode($res);
            die();
            
            /*
            if($id>51){
                $res['code'] =0;
                $res['msg'] = '充值会员可查看更多';
                echo json_encode($res);
                die();
            }else{
                $res['code'] =200;
                $res['msg'] = '';
                echo json_encode($res);
                die();
            }
            */
        }
       
        $info = M('Article')->where(['id'=>$id])->find();
        $this->assign('info',$info);
        $this->display();
    }

}
?>