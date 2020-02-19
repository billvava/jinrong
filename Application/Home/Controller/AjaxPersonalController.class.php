<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class AjaxPersonalController extends FrontendController{

	public function _initialize() {
        parent::_initialize();
    }

    public function senditem(){
        //访问者控制
        if($this->visitor->is_login && C('visitor.utype') != 2) $this->ajaxReturn(0,'您是资金方，不能发起投递项目！');
        $item_list = M('BaseInfo')->field('id,info_type,title')->where(['uid'=>C('visitor.uid')])->select();
        $funder_id = I('get.funder_id',0,'int');
        $user_id = I('get.user_id','','int');
        if(!empty($item_list)){
            $this->assign('item_list',$item_list);
        }
        $this->assign('funder_id',$funder_id);
        $this->assign('user_id',$user_id);
        $html = $this->fetch('AjaxCommon/send_item');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    public function arrange_itemer(){
        //访问者控制
        if(!$this->visitor->is_login){
            $html = $this->fetch('AjaxCommon/login_min');
        }else{
            $html = $this->fetch('AjaxCommon/login_min');
        }
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    public function show_contact(){
        $html = $this->fetch('AjaxCommon/show_contact');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    public function show_login(){
        $html = $this->fetch('AjaxCommon/show_login');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    function deliver_save(){
        $data = I('post.');
        if($data['itemer_id'] && $data['user_id'] && $data['funder_id'] && $data['uid']){
            $info = M('Deliver')->where(['uid'=>C('visitor.uid'),'itemer_id'=>$data['itemer_id'],'user_id'=>$data['user_id']])->find();
            if($info){
                $res['code']=0;
                $res['msg']='已经提交过了,无需重复提交';
                header('Content-type:text/json');
                echo json_encode($res);
                exit;
            }
            $result = M('Deliver')->add($data);
            if($result){
                $res['code']=200;
                $res['msg']='提交成功,请等待资金方回复!';
                header('Content-type:text/json');
                echo json_encode($res);
                exit;
            }else{
                $res['code']=0;
                $res['msg']='提交失败,请联系客服人员进行处理!';
                header('Content-type:text/json');
                echo json_encode($res);
                exit;
            }
        }
    }
}
?>