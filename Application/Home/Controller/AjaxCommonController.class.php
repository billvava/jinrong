<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class AjaxCommonController extends FrontendController{
	public function _initialize() {
        parent::_initialize();
    }

    public function news_list(){
    	$type_id = I('get.type_id',0,'intval');
    	!$type_id && $this->ajaxReturn(0,'请选择资讯类型！');
    	$where = array(
    		'显示数目' => '15',
    		'资讯小类' => $type_id
    	);
    	$news_mod = new \Common\qscmstag\news_listTag($where);
    	$news_list = $news_mod->run();
    	$this->assign('article_list',$news_list['list']);
    	$tpl=$this->fetch('index_news_list');
    	$this->ajaxReturn(1,'资讯列表信息获取成功！',$tpl);
    }

    public function list_show_type(){
        $action = I('get.action','','trim');
        $type = I('get.type',null,'intval');
        if(!$action || !in_array($action,array('jobs','resume'))) return false;
        $type = $type ? 1 : null;
        cookie($action.'_show_type',$type);
        $this->ajaxReturn(1,'设置成功！');
    }

    public function get_header_min(){
        if($this->visitor->is_login){
            if(C('visitor.utype') == 1){
            }else{
                $realname = M('Members')->where(array('uid'=>C('visitor.uid')))->getfield('realname');
                $this->assign('realname',$realname);
                $this->assign('refresh',$refrestime > strtotime('today') ? 1 : 0);
                $this->assign('resume',$resume);
            }
        }
        $data['html'] = $this->fetch('AjaxCommon/header_min');
        $this->ajaxReturn(1,'',$data);
    }

    public function get_login_dig(){
        if(false === $oauth_list = F('oauth_list')){
            $oauth_list = D('Oauth')->oauth_cache();
        }
        $this->assign('oauth_list',$oauth_list);
        $this->assign('verify_userlogin',$this->check_captcha_open(C('qscms_captcha_config.user_login'),'error_login_count'));
        $type = I('get.type','','trim');
        $tpl = $type=='job'?'job_login':'login';
        $data['html'] = $this->fetch('AjaxCommon/'.$tpl);
        $this->ajaxReturn(1,'快速登录窗口',$data);
    }

    public function news_click(){
        $id = I('id',0,'intval');
        !$id && $this->ajaxReturn(0,'请选择要查看的资讯！');
        $where = array('id'=>$id);
        M('Article')->where($where)->setInc('click',1);
        $click = M('Article')->where($where)->getfield('click');
        $this->ajaxReturn(1,'查看次数',$click);
    }
    public function ajax_search_location(){
        $this->ajaxReturn(1,'',url_rewrite(I('get.type','QS_jobslist','trim'),I('post.')));
    }

    //收藏
    public function collection(){
        if(!C('visitor.uid')){
            $this->error('错误');
            die();
        }
        if(IS_POST){
            $data = I('post.');
            $info_id = $data['info_id'];
            $info_type = $data['info_type'];
            $res = M("Collection")->where(['uid'=>C('visitor.uid'),'info_id'=>$info_id])->select();
            $data['addtime'] = time();
            if(empty($res)){
              M("Collection")->add($data);
              $this->ajaxReturn(array('msg'=>1));
            }
            $this->ajaxReturn(array('msg'=>0));
        }else{
            $status = I('status');
            if($status == 1){
                $html = $this->fetch('AjaxCommon/collection_success');
                    $this->ajaxReturn(1,'获取数据成功！',$html);
            }else{
                $html = $this->fetch('AjaxCommon/collection_error');
                $this->ajaxReturn(1,'获取数据成功！',$html);
            }
        }
    }

    function exchange(){
        if(!C('visitor.uid')){
            $this->error('错误');
            die();
        }
        if(IS_POST){
            $data = I('post.');
            $uid = $data['uid'];
            $friend_id = $data['friend_id'];
            $res = M("businessCard")->where(['uid'=>$uid,'friend_id'=>$friend_id])->select();
            $data['addtime'] = time();
            if(empty($res)){
              M("businessCard")->add($data);
              $this->ajaxReturn(array('msg'=>1));
            }
            $this->ajaxReturn(array('msg'=>0));
        }else{
            $status = I('status');
            if($status == 1){
                $html = $this->fetch('AjaxCommon/exchange_success');
                    $this->ajaxReturn(1,'获取数据成功！',$html);
            }else{
                $html = $this->fetch('AjaxCommon/exchange_error');
                $this->ajaxReturn(1,'获取数据成功！',$html);
            }
        }
    }

    //收到的约谈
    function user_talk_num(){
        $where['uid'] = C('visitor.uid');
        $count = M('Receive')->where($where)->count();
        return $count;
    }

    //留言总数
    function user_message_num(){
        $where['uid'] = C('visitor.uid');
        $count = M('InfoConsult')->where($where)->count();
        return $count;
    }

}
?>