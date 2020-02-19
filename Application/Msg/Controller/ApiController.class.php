<?php
namespace Msg\Controller;
use Think\Controller;
class ApiController extends Controller{
    
    public function msg_list($id='',$uid='',$ext='',$pos=1){
        if(empty($id)){
            return;
        }
        if(empty($uid)){
            $uid = 0;
        }
        $where['info_id'] = $id;

        //表示后台调用
        if($pos==1){
            $where['is_show'] = 1;
        }
        $msg_list = M('InfoConsult')->where($where)->select();
        if($ext ==1){
            return $msg_list;
        }
         foreach ($msg_list as $k => &$v) {
             $v['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
             if($v['public']==1 && $uid !==$v['info_uid']){
                    $v['content'] = '内容仅楼主可见';
             }
             if($v['public']==2 && empty($uid)){
                $v['content'] = '内容仅会员可见';
             }
         }
         if($msg_list){
            $result['code']=200;
            $result['data'] = $msg_list;
            $result['msg']='加载成功';
         }else{
            $result['code']=0;
            $result['msg']='加载失败';
         }
         $this->ajaxReturn($result);
    }

    public function change_status($id='',$is_show=''){
        $id = I('post.id','','intval');
        $is_show = I('post.is_show','','intval');
        if($is_show == 1){
            M('InfoConsult')->where(['id'=>$id])->setfield('is_show',0);
        }elseif($is_show == 0){
            M('InfoConsult')->where(['id'=>$id])->setfield('is_show',1);
        }
        $state = M('InfoConsult')->field('is_show')->where(['id'=>$id])->find();
        $data['state'] = $state['is_show'];
        $this->ajaxReturn($data);
    }

}
?>