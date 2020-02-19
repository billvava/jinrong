<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class MsgController extends FrontendController{
    
    function init_check($uid=''){
        if($uid){
            $id = M('BaseInfo')->where(['uid'=>$uid])->getfield('id');
            $arr['id']=$id;
            $arr['msg']='获取成功';
            $arr['code']=1;
            echo json_encode($arr);
        }
    }

    function save(){
        if(IS_POST){
            $data['content'] = I('post.content');
            $data['uid'] = I('post.uid');
            $data['info_id'] = I('post.info_id');
            $data['info_uid'] = I('post.info_uid');
			$data['public'] = I('post.public',0);
            $data['addtime'] = time();
            if($data['uid'] == $data['info_uid']){
                $arr['msg']='自己发布的信息不允许评论';
                $arr['code']=0;
                echo json_encode($arr);
            }
            $result = M('InfoConsult')->add($data);
            if($result){
                $arr['msg']='发布成功';
                $arr['code']=1;
                echo json_encode($arr);
            }else{
                $arr['msg']='发布失败';
                $arr['code']=0;
                echo json_encode($arr);
            }
        }
        
    }

    function guest_submit(){
        if(IS_POST){
            $data['name'] = I('post.name');
            $data['phone'] = I('post.mobile');
            $data['info_id'] = I('post.info_id');
            $data['addtime'] = time();
            $data['content'] = I('post.content');
			$data['public'] = I('post.public',0);
            $result = M('InfoConsult')->add($data);
            if($result){
                $arr['msg']='发布成功';
                $arr['code']=1;
                echo json_encode($arr);
            }else{
                $arr['msg']='发布失败';
                $arr['code']=0;
                echo json_encode($arr);
            }
        }
    }
}