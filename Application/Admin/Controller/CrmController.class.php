<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class CrmController extends BackendController{

    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $model = M('Customer');
        $pagesize = I('get.pagesize',6);
        foreach ($model->getDbFields() as $key => $val) {
                if (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
                    if(in_array($val,['username','realname','mobile','qq','email'])){
                        $map[$val] = array('like','%'.urldecode(trim($_REQUEST['key'])).'%');
                    }
                }
        }
        $map['_logic'] = 'or';
        if (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
                $where['_complex'] = $map;
                $where['gonghai'] = 0;
            }else{
                $map['mobile']=['neq',''];
                $where['_complex'] = $map;
                $where['gonghai'] = 0;
        }
        if($admin_uid = session('admin.id')){
            $count = $model->where(['cid'=>$admin_uid])->where($where)->count();
            $pager = pager($count,$pagesize);
            $member_list = $model->where(['cid'=>$admin_uid])->where($where)->limit($pager->firstRow.','.$pager->listRows)->order('addtime desc')->select();
        }
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        $sex=[0=>'男',1=>'女'];
        $is_locked=[0=>'未锁',1=>'锁定'];
        foreach ($member_list as $k => &$v) {
            $v['sex'] = $sex[$v['sex']];
            $v['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $v['is_locked'] = $is_locked[$v['is_locked']];
        }
        $page = $pager->fshow();
        $this->assign('count',$count);
        $this->assign("page",$page);
        $this->assign('member_list',$member_list);
        $this->display();
    }

    function ajax_tracking_log(){
        $this->display();
    }


    function member_info(){
        $model = M('Customer');
        $uid = I('get.uid',0,'intval');
        if(IS_POST){
            $data = I('post.');
            $result = $model->where(['uid'=>$data['uid']])->save($data);
            if($result){
                $this->success('会员信息修改成功！');
                die();
            }else{
                $this->error('会员信息修改失败！');
                die();
            }
        }
        $info = $model->where(['uid'=>$uid])->find();
        $info_ext = M('Members')->field('uid,username,last_login_time,last_login_ip,reg_ip')->where(['uid'=>$uid])->find();
        $info = array_merge_multi($info,$info_ext);
        $this->assign('info',$info);
        $this->display();
    }

    public function company_customer(){
        $pagesize = I('get.pagesize',20);
        $model = M("Members");
        if(isset($_REQUEST['type']) && $_REQUEST['type'] != ''){
              switch ($_REQUEST['type']) {
                case 1:
                $where['owner'] =array('eq',0);
                break;
                case 2:
                $where['owner'] =array('neq',0);
                break;
              }
        }
        if(isset($_REQUEST['add_time']) && $_REQUEST['add_time'] != ''){
            $user_reg_time = $_REQUEST['add_time'];
            $this->assign('user_reg_time',$user_reg_time);
            if(isset($_REQUEST['end_time']) && $_REQUEST['end_time'] != ''){
                $end_time = $_REQUEST['end_time'];
                $this->assign('end_time',$end_time);
                $where['reg_time'] = [
                ['egt',strtotime($user_reg_time)],
                ['lt',strtotime($end_time)]
                ];
            }else{
                $where['reg_time'] = [
                ['egt',strtotime($user_reg_time)],
                ['lt',strtotime($user_reg_time.'+1 day')]
                ];
            }
        }
        if($addtimesettr = I('request.addtimesettr',0,'intval')){
            $where['reg_time'] = ['gt',strtotime("-".$addtimesettr." day")];
        }
        foreach ($model->getDbFields() as $key => $val) {
                if (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
                    if(in_array($val,['username','realname','mobile','qq','email','owner_name'])){
                        $map[$val] = array('like','%'.urldecode(trim($_REQUEST['key'])).'%');
                    }
                }
        }
        $map['_logic'] = 'or';
        if (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
                $where['inner'] = 0;
                $where['_complex'] = $map;
            }else{
                $map['mobile']=array("neq","");
                $where['_complex'] = $map;
                $where['inner'] = 0;
        }
        $count = M("Members")->field('uid,utype,username,realname,sex,mobile,email,qq,reg_time,reg_address,is_vip,owner,owner_name')->where($where)->count();
        $pager = pager($count,$pagesize);
        $member_list = M("Members")->field('uid,utype,username,realname,sex,mobile,email,qq,reg_time,reg_address,is_vip,owner,owner_name,inner')->limit($pager->firstRow.','.$pager->listRows)->where($where)->order('uid desc')->select();
        $customer_list = M('Customer')->where($condition)->field('uid,realname as c_realname,beizhu,first_beizhu')->select();
        $member_list = array_link($member_list,array_key($customer_list,'uid'),'uid');
        $sex=[0=>'男',1=>'女'];
        foreach ($member_list as $k => &$v) {
            $v['sex'] = $sex[$v['sex']];
            $v['reg_time'] = date('Y-m-d H:i:s',$v['reg_time']);
            $reg_time[] = $v["reg_time"];
        }
        array_multisort($reg_time,SORT_DESC,$member_list);
        $page = $pager->fshow();
        $this->assign('member_list', $member_list);
        $this->assign("page",$page);
        $this->assign("count",$count);
        $this->display();
    }

    function trace_log(){
        $model = M('TraceRecord');
        if(FALSE === $kf_group = F('kf_group')){
            $kf_group = M('Admin')->field('id,realname')->where(['role_id'=>5])->select();
            foreach ($kf_group as $k => $v) {
                $kf[$v['id']] = $v['realname'];
            }
            F('kf_group',$kf);
        }
        $admin_id = session('admin.id');
        $role_id = session('admin.role_id');
        if(!in_array($role_id,[1,4])){
            $condition['cid'] =$admin_id;
            //unset($condition['cid']);
        }
        /*
        if(in_array($role_id,[6]) && $admin_id = 6){
            $condition['cid'] =['in',[6,10,11,12,14,16,17]];
        }
        if(in_array($role_id,[6]) && $admin_id = 7){
            $condition['cid'] =['in',[7,9,13,15]];
        }
        */
        $uids = M('Customer')->field('uid')->where($condition)->select();
        $uids = array_multi_to_single($uids);
        if(!in_array($role_id,[1,4])){
            $where['uid'] =['in',$uids];
        }
        $trace_log_new = $model->where($where)->order('addtime desc')->getField('cid');
        $trace_log = $model->where($where)->select();
        foreach ($trace_log as $k => &$v) {
            $v['cid'] = $kf_group[$v['cid']];
            $trace_log[$k]['new_cid'] = $kf_group[$trace_log_new];
        }
        $customer_list = M('Customer')->where($condition)->field('uid,realname,mobile,addtime as reg_time')->select();
        $trace_log = array_link($trace_log,array_key($customer_list,'uid'),'uid');
        $pager = pager($count,$pagesize);
        $page = $pager->fshow();
        $this->assign('count',$count);
        $this->assign("page",$page);
        $this->assign('trace_log',$trace_log);
        $this->display();
    }

    public function trace_detail(){
        if(IS_POST){
            $mobile = I('post.mobile','','intval');
            $admin_uid =session('admin.id');
            if(!$admin_uid || !$mobile){
                $this->error('未选择客户!');
            }
            $custorm_info = M('Customer')->where(['mobile'=>$mobile,''=>$admin_uid])->find();
            if($mobile && $custorm_info){
                $data['notes'] = I('post.notes');
                $data['addtime'] = time();
                $data['uid'] = $custorm_info['uid'];
                $data['cid'] = $admin_uid;
                $data['type'] = I('post.type','');
                $data['name'] = I('post.name','');
                if(!empty($data['name'])){
                    $cus['realname'] = $data['name'];
                    $res = M('Customer')->where(['mobile'=>$mobile])->find();
                    if($res){
                        $result = M('Customer')->where(['mobile'=>$mobile])->save($cus);
                    } 
                }
                $result = M('TraceRecord')->add($data);
                if($result){
                    $this->success('添加成功!');
                    die();
                }
            }else{
                    $this->success('未选择客户!');
                    die();
            }
        }
        $trace_type = [0=>'电话拜访',1=>'微信聊天',2=>'发送短信',3=>'上门拜访'];
        $stage_type = [0=>'电话拜访',1=>'微信聊天',2=>'发送短信',3=>'上门拜访'];
        $this->assign('trace_type',$trace_type);
        $this->assign('stage_type',$stage_type);
        $trace_record= M('TraceRecord')->where(['uid'=>$uid])->select();
        $mobile = I('get.mobile');
        if($mobile){
            $realname= M('Customer')->where(['mobile'=>$mobile])->getField('realname');
            $this->assign('realname',$realname);
        }
        $this->assign('trace_record',$trace_record);
        $this->assign('uid',$uid);
        
        $this->display();
    }

    public function personal_customer(){
        $model = M('Customer');
        $pagesize = I('get.pagesize',6);
        foreach ($model->getDbFields() as $key => $val) {
                if (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
                    if(in_array($val,['username','realname','mobile','qq','email'])){
                        $map[$val] = array('like','%'.urldecode(trim($_REQUEST['key'])).'%');
                    }
                }
        }
        $map['_logic'] = 'or';
        if (isset($_REQUEST['key']) && $_REQUEST['key'] != '') {
                $where['_complex'] = $map;
            }else{
                $map['mobile']=array("neq","");
                $where['_complex'] = $map;
                $where['gonghai']=1;
        }
        if($admin_uid = session('admin.id')){
            $count = $model->where(['cid'=>$admin_uid])->where($where)->count();
            $pager = pager($count,$pagesize);
            $member_list = $model->where(['cid'=>$admin_uid])->where($where)->limit($pager->firstRow.','.$pager->listRows)->order('addtime desc')->select();
        }
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        $sex=[0=>'男',1=>'女'];
        foreach ($member_list as $k => &$v) {
            $v['sex'] = $sex[$v['sex']];
            $v['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
        }
        $page = $pager->fshow();
        $this->assign('count',$count);
        $this->assign('new_count',$count);
        $this->assign("page",$page);
        $this->assign('member_list',$member_list);
        $this->display();
    }

    function transfer_custormer(){
        $id = I('post.id');
        if(!is_array($id)){
            $this->error('参数错误!');
        }
        if(is_array($id) && !empty($id)){
            $where['id']  = ['in',$id];
            $result = M('Customer')->where($where)->setField('gonghai',0);
            if($result){
                $this->success('转移成功!');
            }else{
                $this->error('转移失败!');
            }
        }else{
            $this->error('未选择客户');
        }
    }

    //客户扔进公海,资源重新分配
    function throw_into_sea(){
        $uid = I('post.uid');
        if(!is_array($uid)){
            $this->error('参数错误!');
        }
        if(is_array($uid) && !empty($uid)){
            $where['uid']  = ['in',$uid];
            $change_c = ['cid'=>0,'vip_kf_name'=>''];
            M()->startTrans();
            $result = M('Customer')->where($where)->setField($change_c);
            $change_m = ['owner'=>0,'owner_name'=>''];
            $res = M('Members')->where($where)->setField($change_m);
            if($res === FALSE && $result === FALSE){
                M('Members')->rollback();
                $this->error('移入公海失败!');
            }else{
                M('Members')->commit();
                $this->success('移入公海成功!');
            }
        }else{
            $this->error('未选择客户');
        }
    }

    public function member_list(){
        $this->_name = 'Members';
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key && $key_type==5){
            $id = intval($key);
            $uid = M('BaseInfo')->where(['id'=>$id])->getField('uid');
            $list = M('Members')->where(['uid'=>$uid])->select();
            $this->assign('list',$list);
            $this->display('member_list');
            exit;
        }
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $where['username'] = array('like','%'.$key.'%');
                    break;
                case 2:
                    $where['uid'] = intval($key);
                    break;
                case 3:
                    $where['email'] = array('like','%'.$key.'%');
                    break;
                case 4:
                    $where['mobile'] = array('like','%'.$key.'%');
                    break;
            }
        }else{
            if($settr = I('request.settr',0,'intval')){
                $where['reg_time'] = array('gt',strtotime("-".$settr." day"));
            }
            if ($verification = I('get.verification',0,'intval')){
                switch($verification){
                    case 1:
                        $where['email_audit']=array('eq',1);
                        break;
                    case 2:
                        $where['email_audit']=array('eq',0);
                        break;
                    case 3:
                        $where['mobile']=array('neq','');
                        break;
                    case 4:
                        $where['mobile']=array('eq','');
                        break;
                }
            }
            if($photo_audit = I('get.photo_audit',0,'intval')){
                $db_pre = C('DB_PREFIX');
                $this_t = C('DB_PREFIX').'members';
                $this->join = 'left join '.$db_pre .'members_info i on i.uid='.$this_t.'.uid';
                $where['i.photo_audit'] = $photo_audit;
                $this->fields = $db_pre.'members.*,i.photo_audit';
                $this->sort = $this_t.'.uid';
            }
        }
        $this->where = $where;
        $this->custom_fun = '_format_member_list';
        $this->_tpl = 'member_list';
        parent::index();
    }

    /**
     * 删除会员
     */
    public function member_delete(){
        $tuid = I('post.tuid','','trim');
        !$tuid && $this->error('你没有选择会员！');
        if (I('post.delete_user')=='yes' && false===D('Members')->delete_member($tuid))
        {
            $this->error('删除会员失败！');
        }
        admin_write_log('删除会员'.$tuid,C('visitor'),3);
        $this->success('删除成功！');
    }
    /**
     * 添加会员
     */
    public function member_add(){
        $this->_name = 'Members';
        parent::add();
    }

    public function _before_insert($data){
        $data['username'] = '7rh_'.$data['username'];
        if(fieldRegex($data['username'],'number')){
            $this->error('用户名不能是纯数字！');
        }
        $data['mobile_audit'] =1;
        $data['password'] = D('Members')->make_md5_pwd($data['password'],$data['pwd_hash']);
        return $data;
    }

    public function _after_insert($id,$data){
        D('Members')->user_register($data);
    }

    /**
     * 编辑会员信息
     */
    public function member_edit(){
        $this->_name = 'Members';
        if(!IS_POST){
            $uid = I('get.uid',0,'intval');
        }
        parent::edit();
    }
    public function _before_update($data){
        if(isset($_POST['password'])){
            $model = D('Members');
            $member = $model->find(I('post.uid',0,'intval'));
            $data['password'] = $model->make_md5_pwd(I('post.password','','trim'),$member['pwd_hash']);
        }
        return $data;
    }
    /**
     * 加载会员详情
     */
    public function ajax_get_user_info(){
        $id = I('get.id',0,'intval');
        $rst = D('Members')->admin_ajax_get_user_info($id);
        exit($rst['msg']);
    }

    /**
     * 查看会员中心
     */
    public function management(){
        $id = I('get.id',0,'intval');
        $action = I('get.action','home/members/index','trim');
        $action == 'resume' && $action = 'home/personal/resume_list';
        $u = D('Members')->get_user_one(array('uid'=>$id));
        if (!empty($u)){
            $user_visitor = new \Common\qscmslib\user_visitor;
            $user_visitor->logout();
            $user_visitor->assign_info($u);
            redirect(U($action));
        }
    }

    public function user_log(){
        $this->_name = 'MembersLog';
        $this->assign('type_arr',D('MembersLog')->type_arr);
        $where['log_uid'] = I('request.uid',0,'intval');
        if($settr = I('request.settr',0,'intval')){
            $where['log_addtime'] = array('gt',strtotime("-".$settr." day"));
        }
        $this->where = $where;
        parent::index();
    }

    
    
    
    /**
     * [_format_member_list 解析用户注册地址]
     */
    protected function _format_member_list($list){
        $Ip = new \Common\ORG\IpLocation('UTFWry.dat');
        foreach ($list as $key => $val) {
            $rst = $Ip->getlocation($val['reg_ip']); 
            $list[$key]['ipAddress'] = $rst['country'];
        }
        return $list;

    }
    
}
?>