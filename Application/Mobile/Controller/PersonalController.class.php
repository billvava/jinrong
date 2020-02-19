<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class PersonalController extends MobileController{
	public function _initialize() {
        parent::_initialize();
        //访问者控制
        if(I('get.code','','trim') && !in_array(ACTION_NAME,array('order_detail'))){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding',array('openid'=>$this->openid));
        }
        if (!$this->visitor->is_login) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
            //非ajax的跳转页面
            $this->redirect('members/login');
        }
    }
    protected function _global_variable() {
        // 帐号状态 为暂停
        if (C('visitor.status') == 2 && !in_array(ACTION_NAME, array('index'))){
            $this->_404('您的账号处于暂停状态，请联系管理员设为正常后进行操作！',U('Personal/index'));
        }
        $this->assign('personal_nav',ACTION_NAME);
    }

	public function index(){
		session('error_login_count',0);
		$uid=C('visitor.uid');
		$user_info=C('visitor');
		$this->assign('user_info',$user_info);
		$this->display();
	}
	
    /**
     * 意见反馈
     */
    public function feedback(){
        if(IS_POST){
            $data = I('post.');
            $r = D('Feedback')->addeedback($data);
            $this->ajaxReturn($r['state'],$r['msg']);
        }
        if (C('qscms_wap_captcha_config.varify_suggest')==1 && C('qscms_mobile_captcha_open')==1){
            $varify_suggest = 1;
        }else{
            $varify_suggest = 0;
        }
        $this->assign('varify_suggest',$varify_suggest);
        $this->_config_seo(array('title'=>'意见反馈 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'意见反馈'));
        $this->display();
    }

    /**
     * 消息提醒
     */
    public function pms_list(){
        if(I('get.type',0,'intval')){//留言咨询
            $msg_list = D('Msg')->msg_list(C('visitor'),false);
            $this->assign('msg_list',$msg_list);
            $this->_config_seo(array('title'=>'消息提醒 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'消息提醒'));
        }else{
            $settr = I('get.settr',0,'intval');
            $new = I('get.new',0,'intval');
            $map = array();
            if($settr>0){
                $tmp_addtime = strtotime('-'.$settr.' day');
                $map['dateline'] = array('egt',$tmp_addtime);
            }
            if($new>0){
                $map['new'] = array('eq',$new);
            }
            $msg = D('Pms')->update_pms_read(C('visitor'),10,$map);
            $this->assign('msg_list',$msg);
            $this->_config_seo(array('title'=>'消息提醒 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'消息提醒'));
        }
        $this->display();
    }

     /**
     * 消息详细
     */
    public function pms_show(){
        $ids = I('request.id','','trim');
        $reg = D('Pms')->msg_check($ids,C('visitor'));
        if($reg['state']){
            $this->assign('msg',$reg['data']);
        }else{
            $this->_404($reg['error']);
        }
        $this->_config_seo(array('title'=>'系统消息 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'系统消息'));
        $this->display();
    }
    
     /**
     * 咨询详细
     */
    public function pms_consult_show(){
        $id = I('get.id',0,'intval');
        if(!$id){
            $uid = I('get.uid',0,'intval');
            !$uid && $this->_404('请选择求职资询');
        }else{
            $msg_list = D('Msg')->smsg_list($id,C('visitor'));
            if($msg_list){
                $uid = $msg_list[0]['touid'];
            }
            $this->assign('msg_list',$msg_list);
        }
        $company_profile = M('company_profile')->where(array('uid'=>$uid))->find();
        $this->assign('company_profile',$company_profile);
        $this->_config_seo(array('title'=>'留言咨询 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'留言咨询'));
        $this->display();
    }
    public function resume_preview(){
        $resume_list = D('Resume')->get_resume_list(array('where'=>array('uid'=>C('visitor.uid')),'limit'=>1,'order'=>'def desc'));
        if($resume_list){
            $this->ajaxReturn(1,'',url_rewrite('QS_resumeshow',array('id'=>$resume_list[0]['id'])));
        }else{
            $this->ajaxReturn(0,'您还没有创建有效简历，请先创建简历');
        }
    }
}
?>