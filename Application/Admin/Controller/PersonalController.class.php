<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class PersonalController extends BackendController{
    public function _initialize() {
        parent::_initialize();
    }
    
    public function index(){
        $db_pre = C('DB_PREFIX');
        $this_t = $db_pre.'resume';
        $this->_name = 'Resume';
        $this->sort = 'refreshtime';
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $where['fullname'] = array('like','%'.$key.'%');
                    break;
                case 2:
                    $where[$this_t.'.id'] = intval($key);
                    break;
                case 3:
                    $where[$this_t.'.uid'] = intval($key);
                    break;
                case 4:
                    $where['telephone'] = array('like','%'.$key.'%');
                    break;
                case 5:
                    $where['qq'] = array('like','%'.$key.'%');
                    break;
                case 6:
                    $where['i.residence'] = array('like','%'.$key.'%');
                    break;
            }
        }else{
            $tabletype=I('request.tabletype',0,'intval');
            $audit = $tabletype == 1 ? 0 : I('request.audit','','trim');
            if (I('request.photo',0,'intval') || I('request.photo_display',0,'intval')){
                $this->sort = 'addtime';
            }
            if($addtimesettr = I('request.addtimesettr',0,'intval')){
                $where['addtime'] = array('gt',strtotime("-".$addtimesettr." day"));
                $this->sort = 'addtime';
            }
            if($settr = I('request.settr',0,'intval')){
                $where['refreshtime'] = array('gt',strtotime("-".$settr." day"));
            }
            if($photos = I('photos','','intval')){
                $photos == 1 && $where['photo_img'] = array('neq','');
                $photos == 2 && $where['photo_img'] = array('eq','');
            }
            if($tabletype==1){
                $where['display'] = 1;
                //$where['audit'] = 1;
            }elseif($tabletype==2){
                if($audit != 3){
                    if($audit == ''){
                        $where['_string'] = '`display`=0 or `audit`=3';
                    }else{
                        $where['display'] = 0;
                    }
                }
            }elseif($tabletype==0){}
        }
        $this->field = $this_t.'.*';
        $this->order = 'field(audit,2) desc, '.$this_t.'.id desc';
        $this->where = $where;
        $this->join = "left join ".$db_pre."members_info as i on ".$this_t.".uid=i.uid";
        $this->custom_fun = '_format_resume_list';
        $this->_after_search_resume($tabletype);
        $this->_tpl = 'index';
        parent::index();
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
        if(!empty($u)){
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