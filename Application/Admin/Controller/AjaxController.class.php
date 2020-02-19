<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class AjaxController extends BackendController{
	public function _initialize() {
        parent::_initialize();
    }

    public function userinfo(){
    	$uid = I('get.uid',0,'intval');
    	if(!$uid){
    		$this->ajaxReturn(0,'参数错误！');
    	}
    	$userinfo = D('Members')->get_user_one(array('uid'=>$uid));
    	$manage_url = $userinfo['utype']==1?U('Company/management',array('id'=>$userinfo['uid'])):U('Personal/management',array('id'=>$userinfo['uid']));
    	if($userinfo['utype']==1){
            $consultant = D('Consultant')->find($userinfo['consultant']);
            $this->assign('consultant',$consultant);
            $company_profile = D('CompanyProfile')->where(array('uid'=>$userinfo['uid']))->find();
            $this->assign('company_profile',$company_profile);
        }else{
            $userinfo['realname'] = M('Members')->where(array('uid'=>$uid))->getfield('realname');
            $this->assign('resume_manage',U('personal/management',array('id'=>$userinfo['uid'],'action'=>'resume')));
        }
        $this->assign('userinfo',$userinfo);
    	$this->assign('manage_url',$manage_url);
        $html = $this->fetch('userinfo');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    public function custormer_info(){
        $uid = I('get.uid',0,'intval');
        if(!$uid){
            $this->ajaxReturn(0,'参数错误！');
        }
        $userinfo = M('Customer')->where(['uid'=>$uid])->find();
        //$log = M('Customer')->_sql();
        //$this->ajaxReturn(0,$userinfo['uid']);
        $this->assign('userinfo',$userinfo);
        $html = $this->fetch('custormer_info');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }


    public function ajax_send_sms(){
        $uid = I('request.uid',0,'intval');
        $mobile = I('request.mobile','','trim');
        $utype = M('Members')->where(['uid'=>$uid,'mobile'=>$mobile])->getField('utype');
        if(IS_POST){
            //$txt = I('request.txt','','trim');
            if (!$uid){
                $this->error('用户UID错误！');
            }
            $setsqlarr['s_mobile']=$mobile?$mobile:$this->error('手机不能为空！');
            $setsqlarr['s_addtime']=time();
            $setsqlarr['s_uid']=$uid;
            $date_count = M('Receive')->where(['uid'=>$uid])->count();
            $click_count = M('BaseInfo')->where(['uid'=>$uid])->getField('click');
            if(D('Sms')->sendSms('other',array('mobile'=>$setsqlarr['s_mobile'],'tpl'=>'send_itemer','data'=>array('count'=>$click_count.'','num'=>$date_count.'','url'=>'http://www.7ronghui.com')))){
                $setsqlarr['s_sendtime']=time();
                $setsqlarr['s_type']=2;//发送成功
                D('Smsqueue')->add($setsqlarr);
                unset($setsqlarr);
                $this->success('发送成功！');
            }else{
                $setsqlarr['s_sendtime']=time();
                $setsqlarr['s_type']=3;//发送失败
                D('Smsqueue')->add($setsqlarr);
                unset($setsqlarr);
                $this->error('发送失败，错误未知！');
            }
        }else{
            $this->assign('uid',$uid);
            $this->assign('mobile',$mobile);
            $html = $this->fetch('send_sms');
            $this->ajaxReturn(1,'获取数据成功！',$html);
        }
    }

    function ajax_locked(){
        $uid = I('get.uid','','intval');
        if($uid){
            $res = M('Customer')->where(['uid'=>$uid])->setfield('is_locked',1);
            if($res){
                $this->success('用户锁定成功！');
            }else{
                $this->error('用户锁定失败！');
            }
        }else{
            $this->error('用户uid错误！');
        }
    }

    //专属客户
    function exclusive_custormer(){
        $keyword = I('request.term','');
        $admin_id = session('admin.id');
        if(empty($admin_id)){
            $result='';
            header('Content-type:text/json');
            echo json_encode($result);
            exit;
        }
        $keyword = trimall($keyword);
        $where['cid'] = $admin_id;
        $where['mobile']=array('like','%'.$keyword.'%');
        $users= M("Customer")->field('uid,mobile')->where($where)->select();
        $result=array();
        foreach($users as $n=>$val){
            $result[$n]['id'] = $val['uid'];
            $result[$n]['label'] = $val['mobile'];
        }
        header('Content-type:text/json');
        echo json_encode($result);
    }


    public function ajax_send_email(){
        $uid = I('request.uid',0,'intval');
        $email = I('request.email','','trim');
        if(IS_POST){
            $subject = I('request.subject','','trim');
            $body = I('request.body','','trim');
            if (!$uid){
                $this->error('用户UID错误！');
            }
            $setsqlarr['m_mail']=$email?$email:$this->error('邮件地址必须填写！');
            if(!$email || !fieldRegex($setsqlarr['m_mail'],'email'))
            {
                $this->error('邮箱格式错误！');
            }
            $setsqlarr['m_subject']=$subject?$subject:$this->error('邮件标题必须填写！');    
            $setsqlarr['m_body']=$body?$body:$this->error('邮件内容必须填写！');
            $setsqlarr['m_addtime']=time();
            $setsqlarr['m_uid']=$uid;
            $result = company_send_mail($to=$setsqlarr['m_mail'], $name='', $subject = $setsqlarr['m_subject'], $body=$setsqlarr['m_body']);
                if($result==1){
                    $this->success('发送成功',$url);
                }else{
                    $this->error('发送失败，错误未知！',$url);
                }
        }else{
            $this->assign('uid',$uid);
            $this->assign('email',$email);
            $html = $this->fetch('send_email');
            $this->ajaxReturn(1,'获取数据成功！',$html);
        }
    }

    public function ajax_send_pms(){
        $tousername = I('request.tousername','','trim');
        if(IS_POST){
            if (!$tousername){
                $this->error('用户名填写错误！');exit;
            }else{
                $s=0;
                $msg=I('post.msg','','trim');
                $time=time();
                $data = array();
                $userinfo = D('Members')->where(array('username'=>$tousername))->find();
                if (intval($userinfo['uid'])>0){
                    $data['msgtype'] = 1;
                    $data['msgtouid'] = $userinfo['uid'];
                    $data['msgtoname'] = $userinfo['username'];
                    $data['message'] = $msg;
                    $data['dateline']=$time;
                    $data['replytime']=$time;
                    $data['new']=1;
                }
                D('Pms')->add($data);
                admin_write_log("发送消息,共发给了 1 个会员", C('visitor.username'),3);
                $this->success("发送成功！");exit;
            }
        }else{
            $this->assign('tousername',$tousername);
            $html = $this->fetch('send_pms');
            $this->ajaxReturn(1,'获取数据成功！',$html);
        }
    }

    function ajax_send_talks(){
        if(IS_POST){
            $mobile_array = array();
            $mobile_array = I('post.mobile','','trim');
            $where['mobile'] = array('in',$mobile_array);
            $user_list = M('Members')->field('uid')->where($where)->select();
            $from_user_id = ['23841','23843','23894','23889','23895','23891','23907','23908','23910','23911','23913','23914','23916','23917','23918','23919','23922','23921','23927','23924','23926','23929'];
            foreach ($from_user_id as $key => $value){
                foreach ($user_list as $k => $v) {
                    $data[$key]['uid'] = $v['uid'];
                    $data[$key]['info_id'] = M('BaseInfo')->field('id')->where(['uid'=>$data[$k]['uid']])->getField('id');
                    if(!$data[$key]['info_id']){
                        $this->success("用户还没有发布信息,现在还不能发送！");exit;
                    }
                    $data[$key]['from_user_id']=$value;
                    $data[$key]['addtime'] = time();
                    $data[$key]['times'] = mt_rand(3,16);
                }
            }
            $result = M('Receive')->addall($data);
            $this->success("发送成功！");exit;
        }else{
            $this->assign('tousername',$tousername);
            $html = $this->fetch('send_talks');
            $this->ajaxReturn(1,'获取数据成功！',$html);
        }
    }


    function ajax_send_talks_inner(){
        if(IS_POST){
            $mobile_array = array();
            $mobile_array = I('post.mobile','','trim');
            $where['mobile'] = array('in',$mobile_array);
            $user_list = M('Members')->field('uid')->where($where)->select();
            $from_user_id = $this->inquiry();
            foreach ($from_user_id as $key => $value){
                foreach ($user_list as $k => $v) {
                    $data[$key]['uid'] = $v['uid'];
                    $data[$key]['info_id'] = M('BaseInfo')->field('id')->where(['uid'=>$data[$k]['uid']])->getField('id');
                    if(!$data[$key]['info_id']){
                        $this->success("用户还没有发布信息,现在还不能发送！");exit;
                    }
                    $data[$key]['from_user_id']=$value;
                    $data[$key]['addtime'] = time();
                    $data[$key]['times'] = mt_rand(3,16);
                }
            }
            $result = M('Receive')->addall($data);
            $this->success("发送成功！");exit;
        }else{
            $this->assign('tousername',$tousername);
            $html = $this->fetch('send_talks_inner');
            $this->ajaxReturn(1,'获取数据成功！',$html);
        }
    }


    function send_phone(){

    }

    function inquiry(){
        $where['mobile'] = ['neq',''];
        $where['utype'] = 1;
        $user_list = M('Members')->field('uid')->where($where)->limit(25)->order('uid desc')->select();
        $user_list = array_multi_to_single($user_list);
        return $user_list;
    }

    function ajax_kefu(){
        $model = M('Admin');
        $keyword = I('request.term','');
        $keyword = trimall($keyword);

        /*
        1:$where['name']  = array('like', '%thinkphp%');
        2:$where['title']  = array('like','%thinkphp%');
        3:$where['_logic'] = 'or';
        4:$map['_complex'] = $where;
        5:$map['id']  = array('gt',1);
        */
        $where['role_id'] = ['in',[5,6]];
        $where['status'] = 1;
        $where['_string'] = "(username like '%$keyword%') OR ( realname like '%$keyword%')";
        if($keyword=='all'){
            $where['_string'] = "(username like '%%') OR ( realname like '%%')";
        }else{
            $where['_string'] = "(username like '%$keyword%') OR ( realname like '%$keyword%')";
        }
        $users= M("Admin")->field('id,username,realname')->where($where)->select();
        $result=array();
        foreach($users as $n=>$val){
            $result[$n]['id'] = $val['id'];
            $result[$n]['label'] = $val['realname'];
        }
        header('Content-type:text/json');
        echo json_encode($result);
    }

    function ajax_distribution_customer(){
        if(IS_POST){
            $model = M('Customer');
            $realname = I('post.key','','trim');
            $owner = M('Admin')->where(['realname'=>$realname,'role_id'=>5])->getField('id');
            $data['mobile'] = I('post.mobile');
            $uid = I('post.uid','','intval');
            $member_info = M('Members')->where(['uid'=>$uid])->find();
            $data['uid'] = I('post.uid');
            $data['cid'] = $owner;
            $data['addtime'] = $member_info['reg_time'];
            $data['vip_kf_name'] = $realname;
            $data['gonghai'] = 1;
            $data['start_time'] = time();
            $data['end_time'] = time()+864000;
            $data['sex'] = $member_info['sex'];
            if(!$uid) return;
            $info = $model->where(['uid'=>$uid])->find();
            if($info){
                $data['updatetime'] =time();
                M()->startTrans();
                $result = $model->where(['uid'=>$info['uid']])->save($data);
                $info = $model->where(['uid'=>$uid])->find();
                $change = array('owner'=>$info['cid'],'owner_name'=>$info['vip_kf_name']);
                $res = M('Members')->where(['uid'=>$uid])->setField($change);
                if($result && $res){
                    M('Members')->commit();
                    $this->success("客服分配成功");exit;
                }else{
                    M('Members')->rollback();
                    $this->error("客服分配失败");exit;
                }
            }else{
                if($id = $model->add($data)){
                    $info = $model->where(['id'=>$id])->find();
                    $change = array('owner'=>$info['cid'],'owner_name'=>$info['vip_kf_name']);
                    $res =M('Members')->where(['uid'=>$info['uid']])->setField($change);
                    if($res){
                        $this->success("客服添加成功");exit;
                    }else{
                        $this->error("客服添加失败");exit;
                    }
                }
            }
        }
        $uid = I('request.uid',0,'intval');
        $mobile = I('request.mobile','','trim');
        $this->assign('uid',$uid);
        $this->assign('mobile',$mobile);
        $html = $this->fetch('distribution_customer');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }


    function distribution_multi_customer(){
        if(IS_POST){
            $realname = I('post.key','','trim');
            $first_beizhu = I('post.first_beizhu','');
            if(empty($realname) && $first_beizhu){
                    $uid = I('post.uid',0,'intval');
                    $uid = (int)$uid[0];
                    $member_info = M('Members')->where(['uid'=>$uid])->find();
                    $customer['uid'] = $uid;
                    $customer['sex'] = $member_info['sex'];
                    $customer['addtime'] = $member_info['reg_time'];
                    $customer['mobile'] = $member_info['mobile'];
                    $customer['first_beizhu'] = $first_beizhu;
                    $user_info = M('Customer')->where(['uid'=>$uid])->find();
                    if($user_info){
                        $result = M('Customer')->where(['uid'=>$uid])->save($customer);
                        if($result !== FALSE){
                            $this->success("信息备注成功!");exit;
                        }  
                    }
                    $result = M('Customer')->add($customer);
                    $this->success("信息备注成功!");exit;
            }
            $owner = M('Admin')->where(['realname'=>$realname,'role_id'=>['in',[5,6]]])->getField('id');
            if(!$owner){
                $this->error("客服人员不存在");exit;
            }
            $uids = I('post.uid');
            if(empty($uids) && !is_array($uids)){
                $this->error("未选择分配客户");exit;
            }
            $customer_uids = M('Customer')->field('uid')->select();
            $members_uids = M('Members')->field('uid')->select();
            $customer_uids =array_multi_to_single($customer_uids);
            $members_uids =array_multi_to_single($members_uids);
            M()->startTrans();
            foreach ($uids as $k => $v) {
                if(in_array($v,$customer_uids)){
                    $change_c = array('cid'=>$owner,'vip_kf_name'=>$realname,'gonghai'=>1);
                    $result = M('Customer')->where(['uid'=>$v])->setField($change_c);
                }else{
                    $member_info = M('Members')->where(['uid'=>$v])->find();
                    $customer['uid'] = $v;
                    $customer['cid'] = $owner;
                    $customer['addtime'] = $member_info['reg_time'];
                    $customer['mobile'] = $member_info['mobile'];
                    $customer['vip_kf_name'] = $realname;
                    $customer['gonghai'] = 1;
                    $customer['first_beizhu'] = $first_beizhu;
                    $customer['start_time'] = time();
                    $customer['end_time'] = time()+864000;
                    $customer['sex'] = $member_info['sex'];
                    $result = M('Customer')->add($customer);
                }
            }
            $change = array('owner'=>$owner,'owner_name'=>$realname);
            $res = M('Members')->where(['uid'=>['in',$uids]])->setField($change);
            if($result === FALSE && $res === FALSE){
                M('Members')->rollback();
                $this->error("客服分配失败");exit;  
            }else{
                M('Members')->commit();
                $this->success("客服分配成功");exit;
            }
        }
        $html = $this->fetch('distribution_multi_customer');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    function get_news_custorm(){
        $where['gonghai']=1;
        $admin_uid = session('admin.id');
        $where['cid'] = $admin_uid;
        $count = M('Customer')->where($where)->count();
        $count = (int)$count;
        header('Content-type:text/json');
        echo json_encode($count);
    }

    function ajax_discard(){
        $uid = I('request.uid',0,'intval');
        $mobile = I('request.mobile','','trim');
        if(IS_POST){
            if(!$mobile){
                $this->error("请填写手机号");exit;
            }
            $change_m = array('owner'=>0,'owner_name'=>'');
            $change_c = array('cid'=>0,'vip_kf_name'=>'');
            M()->startTrans();
            $res = M('Customer')->where(['mobile'=>$mobile])->setField($change_c);
            $result = M('Members')->where(['mobile'=>$mobile])->setField($change_m);
            if($result === FALSE && $res === FALSE){
                M('Members')->rollback();
                $this->error("解绑失败");exit;  
            }else{
                M('Members')->commit();
                $this->success("解绑成功");exit;
            }
        }
        $this->assign('uid',$uid);
        $this->assign('mobile',$mobile);
        $html = $this->fetch('ajax_discard');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    /**
     * 审核日志
     */
    function audit_log(){
        $type = I('get.type','jobs_id','trim');
        $id = I('get.id',0,'intval');
        switch($type){
            case 'jobs_id':
            case 'resume_id':
            case 'company_id':
                $list = D('AuditReason')->where(array($type=>$id,'famous'=>0))->order('id desc')->select();
                break;
            default:
                $list = null;
                break;
        }
        $this->assign('list',$list);
        $html = $this->fetch('audit_log');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    /**
     * [famous_log description]
     */
    public function famous_log(){
        $id = I('get.id',0,'intval');
        $list = D('AuditReason')->where(array('company_id'=>$id,'famous'=>1))->order('id desc')->select();
        $this->assign('list',$list);
        $html = $this->fetch('famous_log');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }
	
    /**
     * 登录日志
     */
    public function login_log(){
        $id = I('get.id',0,'intval');
        $list = D('MembersLog')->where(array('log_uid'=>$id,'log_type'=>1001))->order('log_addtime desc')->limit('5')->select();
        $this->assign('list',$list);
        $html = $this->fetch('login_log');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }
	
    /**
     * [ajax_subsite description]
     */
    public function ajax_subsite(){
        $uid = I('get.id',0,'intval');
        $subsites = D('Admin')->where(array('id'=>$uid))->getfield('subsite');
        $this->assign('subsites',explode(',',$subsites));
        $html = $this->fetch('subsite');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }
	
    protected function _subsite($mod,$where){
        $field = M($mod)->getDbFields();
        if($this->apply['Subsite'] && in_array('subsite_id',$field) && C('visitor.subsite')){
            $where['subsite_id'] = array('in',C('visitor.subsite'));
        }
        return M($mod)->where($where)->find();
    }
    
}
?>