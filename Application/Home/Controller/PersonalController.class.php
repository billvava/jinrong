<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class PersonalController extends FrontendController{

    public $arr_time =array('s141_min','s141_max','s158_min','s158_max','s161_min','s161_max','s173_min','s173_max','s157_min','s157_max','transfer_dateend','s53','s77','s43');

    public function _initialize() {
        parent::_initialize();
        //访问者控制
        if (!$this->visitor->is_login){
            IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
            //非ajax的跳转页面
            $this->redirect('members/login');
        }
        !IS_AJAX && $this->_global_variable();
    }

    protected function _global_variable() {
        // 帐号状态 为暂停
        if (C('visitor.status') == 2 && !in_array(ACTION_NAME, array('index'))){
            $this->error('您的账号处于暂停状态，请联系管理员设为正常后进行操作！',U('Personal/index'));
        }
        // 短信必须验证
        if (C('qscms_sms_open')==1 && C('qscms_login_per_audit_mobile')==1 && C('visitor.mobile_audit') == 0 && !in_array(ACTION_NAME, array('user_safety','resume_add'))){
            $this->error('您的手机未认证，认证后才能进行其他操作！',U('Personal/user_safety'));
        }
        $this->assign('personal_nav',ACTION_NAME);
    }
    
    function editprojectinfo(){
        if(IS_POST){
            $data = I('post.');
            $files = $_FILES['files'];
            if($files){
                $date = date('Y-m/d');
                $result = $this->_upload($_FILES['files'],'attach/'.$date,array(
                'maxSize' => '25480',
                'uploadReplace' => true,
                'attach_exts' => 'jpg,jpeg,png,gif,ppt,pptx,pdf,doc,docx'
                ),$save_rule='uniqid',$type='unimg');
                //$upload = new \Common\ORG\UploadFile();
                //$result = $upload->uploadOne($_FILES['files'],'attach/'.$date);
                if ($result['error']) {
                    $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                    $name = $result['info'][0]['name'];
                    $res = M('Attach')->data(array('path'=>$path,'uid'=>C('visitor.uid'),'attach_type'=>'item_files','addtime'=>time()))->add();
                    if($result){
                        $data = array('code'=>200,'aid'=>$res,'file'=>$path,'name'=>$result['info'][0]['savename']);
                    }
                    echo json_encode($data);
                }
            }
            $projectpicture = $_FILES['projectpicture'];
            if($projectpicture){
                $date = date('Y-m/d');
                $result = $this->_upload($_FILES['projectpicture'],'attach/'.$date,array(
                'maxSize' => '25480',
                'uploadReplace' => true,
                'attach_exts' => 'jpg,jpeg,png,gif'
                ));
                if ($result['error']) {
                    $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                    $name = $result['info'][0]['name'];
                    $res = M('Attach')->data(array('path'=>$path,'uid'=>C('visitor.uid'),'attach_type'=>'item_logo','addtime'=>time()))->add();
                    if($result){
                        $data = array('code'=>200,'aid'=>$res,'file'=>$path,'name'=>$result['info'][0]['savename']);
                    }
                    echo json_encode($data);
                }
            }
            $data['uid'] = C('visitor.uid');
            $result = M('ItemDeliver')->where(['uid'=>$data['uid']])->find();
            if($result){
                $res = M('ItemDeliver')->where(['uid'=>C('visitor.uid')])->save($data);
            }else{
                $res = M('ItemDeliver')->add($data);
            }
            if($res !== False){
                $data='ok';
                    header('Content-type:text/json');
                    echo json_encode($data);
                    exit;
                }
        }
    }

    function save(){
        $info = M('ItemDeliver')->where(['uid'=>C('visitor.uid')])->find();
        $info['projectid'] = $info['id'];
        if(empty($info['mobile'])){
            $info['mobile'] = M('Members')->field('mobile')->where(['uid'=>C('visitor.uid')])->getField('mobile');
        }
        $info['projectpicture'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_logo'])->order('id desc')->getField('path');
        $info['files'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_files'])->order('id desc')->getField('path');
        $this->assign('info',$info);
        $this->display();
    }

    function project_info(){
        $info = M('ItemDeliver')->where(['uid'=>C('visitor.uid')])->find();
         if(!empty($info)){
             $info['projectid'] = $info['id'];
         }
        if(empty($info['mobile'])){
            $info['mobile'] = M('Members')->field('mobile')->where(['uid'=>C('visitor.uid')])->getField('mobile');
        }
        if(!empty($info)){
            $info['projectpicture'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_logo'])->order('id desc')->getField('path');
            $info['files'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_files'])->order('id desc')->getField('path');
        }
        $this->assign('info',$info);
        $this->display();
    }

    function setpart2info(){
        if(IS_POST){
            $data = I('post.');
            $data['uid'] = C('visitor.uid');
            $result = M('ItemDeliver')->where(['projectid'=>$data['projectid']])->find();
            if($result){
                $res = M('ItemDeliver')->where(['projectid'=>$data['projectid']])->save($data);
            }else{
                $res = M('ItemDeliver')->add($data);
            }
            if($res !== False){
               $this->ajaxReturn('1','ok','ok');
            }
        }
    }

    function setpart3info(){
        if(IS_POST){
            $data = I('post.');
            $data['uid'] = C('visitor.uid');
            $result = M('ItemDeliver')->where(['projectid'=>$data['projectid']])->find();
            if($result){
                $res = M('ItemDeliver')->where(['projectid'=>$data['projectid']])->save($data);
            }else{
                $res = M('ItemDeliver')->add($data);
            }
            if($res !== False){
               $this->ajaxReturn('1','ok');
            }
        }
    }

    function ajax_login_log(){
        $member_log = M('MembersLog')->where(['log_uid'=>C('visitor.uid')])->find();
        if(empty($member_log)){
            $data=0;
            $this->ajaxReturn('0','没有登录记录日志',$data);
        } 
    }


    function get_user_info(){
        $uid = C('visitor.uid');

        $name = M('Members')->getField('name');
        if(empty($name)){
            $res['data']='';
            $res['code']=0;
            $res['msg'] ='';
            $this->ajaxReturn(0,'',$res);
        }
    }
    
    function index(){
        $user_info = $this->visitor->info;
        $utype = C('visitor.utype');
        
        if($user_info['utype']==0){
            $this->member_init();
            die();
        }

        if(session('btype')==2){
            $this->redirect('Personal/draft');
        }
        $user_talk_num = R('AjaxCommon/user_talk_num');
        $user_message_num = R('AjaxCommon/user_message_num');
        $this->assign('user_talk_num',$user_talk_num);
        $this -> assign('utype',$utype);
        $this->assign('user_message_num',$user_message_num);
        $this->assign('user_info',$user_info);
        $this->display();
    }

    function draft(){
        if(IS_POST){
            $post = I('post.');
            print_r($post);
            exit;
        }
        $this->display();
    }

    function member_init(){
        $user_info = $this->visitor->info;
        if(IS_POST){
            $data['utype'] = I('post.utype');
            if($data['utype']){
                $result = M('Members')->where(['uid'=>$user_info['uid']])->setfield('utype',$data['utype']);
                $this->visitor->update();
                $this->ajaxReturn(1,'角色修改成功!',U('Personal/account'));
            }
        }
        $this->display('member_init');
    }

    //发布信息
    public function publish(){
        $page_seo['title']='发布信息-用户中心';
        $this->assign('page_seo',$page_seo);
        $user_info = $this->visitor->info;
        if(IS_POST){
            if(M('BaseInfo')->where(['uid'=>C('visitor.uid')])->count() >=3){
                $this->error('免费会员最多只能发布3条信息!');
                exit;
            }
            $info = I('post.');
            
            
            $developer_str = $info['development_phase'].','.$info['developer_rank'].','.$info['developer_qualification'].',';
            $info['utype']=C('visitor.utype');//1-资金方，2-项目方
            if($info['utype'] == 2){
                $province_id = $info['province_id'];//省份id
                $sel_industry_id = $info['sel_industry_id']; //行业id
                $keywords_str = $developer_str.$province_id.','.$sel_industry_id;
            }else{
                $keywords_str = $developer_str.$info['tz_industry'].$info['tz_area'];
            }
           


            $base_info['uid']= C('visitor.uid');
            $base_info['i_overview'] = trim($info['i_overview']);
            $base_info['i_introduce'] = trim($info['i_introduce']);
            $base_info['i_other_remark'] = trim($info['i_other_remark']);
            $base_info['i_pic'] = $info['i_pic'];
            $base_info['i_att'] = $info['i_att'];
			$base_info['i_att_other'] = $info['i_att_other'];
            
          
            $base_info['keywords'] = $keywords_str; //关键词用匹配
            $base_info['i_keywords'] = $info['i_keywords'];
            $base_info['addtime']=time();
            $base_info['updatetime']=time();
            if($info['utype']=='1'){ //资金方
                $base_info['type'] =1;
                $result = D('FundInfo')->process_info($info,$base_info);
            }elseif($info['utype']=='2'){ //项目方
                $base_info['type'] =2;
                $result = D('ItemInfo')->process_info($info,$base_info);
            }
            if($result){
                if($sql_data['xmzc_type']==505){
                    $sql_data['id'] = $result;
                    $sql_data['S80'] = I('post.S80');
                    $sql_data['S80_unit'] = I('post.S80_unit');
                    $res = M('ItemInfoZcjy')->add($sql_data);
                }
                if($sql_data['xmzc_type']==500){
                    $sql_data['id'] = $result;
                    $sql_data['S63'] = I('post.S63');
                    $sql_data['S64'] = I('post.S64');
                    $sql_data['S65'] = I('post.S65');
                }
                if($sql_data['tzlc_type']==508){
                    $sql_data['id'] = $result;
                    $sql_data['S141_min'] = I('post.S141_min');
                    $sql_data['S141_max'] = I('post.S141_max');
                    $sql_data['S142'] = I('post.S142');
                    $sql_data['S145'] = implode(',',I('post.S145'));
                    $sql_data['S150'] = I('post.S150');
                    $sql_data['S151'] = I('post.S151');
                    $res = M('ItemInfoTzlc')->add($sql_data);
                }
                if($sql_data['xmzc_type']==506){
                    $sql_data['id'] = $result;
                    $sql_data['S66'] = I('post.S66');
                    $sql_data['S67'] = I('post.S67');
                    $sql_data['S69'] = I('post.S69');
                    $sql_data['S70'] = I('post.S70');
                    $sql_data['S71'] = I('post.S71');
                    $sql_data['S72'] = I('post.S72');
                }
                $this->success('信息添加成功!',U('Home/Personal/edit',array('info_type'=>$info['info_type'],'id'=>$result)));
                die();
            }else{
                $this->error('信息添加失败!');
                die();
            }
        }
        $this->assign('personal_nav',ACTION_NAME);
        if($user_info['utype']==1){
            $this->display('publish_fund');
        }else{
            $this->display();
        }
    }
 
    public function edit(){
        $page_seo['title']='编辑信息-用户中心';
        $this->assign('page_seo',$page_seo);
        $info_type = I('get.info_type','');
        $utype = C('visitor.utype');
        $uid = C('visitor.uid');
        $id = I('request.id');
        $infos = M('BaseInfo')->field('id')->where(['uid'=>$uid])->select();

        $infos = array_multi_to_single($infos);
       
        if(is_array($infos)){
            foreach ($infos as $k => &$v){
                $v = (int)($v);
            }
        }
        //console_log($infos);
        if(!in_array($id,$infos)){
            $this->error('信息不存在!');
        }
        if($id && $utype==2){
            $info = M('BaseInfo')->where(['id'=>$id])->find();
            switch ($info['info_type']) {
                case '1':
                    $info = $this->ajax_xmrz_info($info['id']);
                    break;
                case '200':
                    $info = $this->ajax_zcjy_info($info['id']);
                    break;
                case '700':
                    $info = $this->ajax_zfzs_info($info['id']);
                    break;
                case '2005':
                    $info = $this->ajax_tzlc_info($info['id']);
                    break;
            }
            $base_info['i_overview'] =text_out($info['i_overview']);
            $base_info['i_introduce'] =text_out($info['i_introduce']);
            $base_info['i_other_remark'] =text_out($info['i_other_remark']);
            foreach ($this->arr_time as $k => $v){
                if($info[$v]==0){
                    unset($info[$v]);
                }
                if(isset($info[$v])){
                    $info[$v] = date('Y-m-d',$info["$v"]);
                    unset($this->arr_time[$k]);
                }
            }
        }elseif($id && $utype==1){
            $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ ii ON ii.id=bi.id')->where(['bi.id'=>$id])->find();
            if(!empty($info['i_pic'])){
                $info['ext_i_pic'] = M('Attach')->field('id,info_id,path,attach_type,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_pic']],'attach_type'=>'i_pic'])->select();
            }
            if(!empty($info['i_att'])){
                $info['ext_i_att'] = M('Attach')->field('id,info_id,path,attach_type,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att']],'attach_type'=>'i_att'])->select();
            }
        }
        if(IS_GET){
            if(empty($info)){
                $this->error('信息不存在!');
            }
            $category_list = F('category_list');
            $this->assign('s11',$category_list['S100']);
            $this->assign('info',$info);
            $this->assign('category_list',$category_list);
        }
        if(IS_POST){
            $data = I('post.');
            $data['is_open'] = 2;
            if($utype==2){
            //事务总表处理
                if($data['info_type']==1){
                    $result = D('ItemInfoZcjy')->saveData();
                    
                }
                if($data['info_type']==200){
                    $result = D('ItemInfoZcjy')->saveData(); 
                }
                if($data['info_type']==700){
                    $result = D('ItemInfoZcjy')->saveData(); 
                }
                if($data['info_type']==2005){
                    $result = D('ItemInfoTzlc')->saveData(); 
                }
            }else{
                $result = D('FundInfo')->save_data($data);
               
            }

            $developer_str = $data['development_phase'].','.$data['developer_rank'].','.$data['developer_qualification'].',';
           //1-资金方，2-项目方
            if($utype == 2){
                $province_id = $data['province_id'];//省份id
                $sel_industry_id = $data['sel_industry_id']; //行业id
                $keywords_str = $developer_str.$province_id.','.$sel_industry_id;
            }else{
                $keywords_str = $developer_str.$data['tz_industry'].$data['tz_area'];
            }
            $new_array['keywords'] = $keywords_str;
            $res = M('BaseInfo')->where(['id'=>$id])->save($new_data);
            $res = M('BaseInfo')->where(['id'=>$id])->save($data);
            if($res){
                $this->success('信息修改成功');
                die();
            }else{
                $this->error('信息修改失败1');
                die();
            }
        }
        $this->display('zjxm_publish_'.$info_type);
    }

    public function ajax_xmrz_info($id){
        $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ ii ON ii.id=bi.id')->where(['bi.id'=>$id])->find();
        if($info['i_pic']){
            $info['ext_i_pic'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_pic']]])->select();
        }
        if($info['i_att']){
            $info['ext_i_att'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att']]])->select();
        }
        if($info['i_att_ppt']){
            $info['ext_i_att_ppt'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att_ppt']]])->select();
        }
        if($info['i_att_other']){
            $info['ext_i_att_other'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att_other']]])->select();
        }
        return $info;
    }

    public function ajax_zcjy_info($id){
        $base_info = M('BaseInfo')->where(['id'=>$id])->find();
        $info = M('ItemInfo')->alias('il')->join('LEFT JOIN __ITEM_INFO_ZCJY__ iiz ON il.id=iiz.id')->where(['il.id'=>$id])->find();
        $info = array_merge_multi($base_info,$info);
        $info['i_overview'] = html_in($info['i_overview']);
        if($info['i_pic']){
            $info['ext_i_pic'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_pic']]])->select();
        }
        if($info['i_att']){
            $info['ext_i_att'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att']]])->select();
        }
        if($info['i_att_ppt']){
            $info['ext_i_att_ppt'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att_ppt']]])->select();
        }
        if($info['i_att_other']){
            $info['ext_i_att_other'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att_other']]])->select();
        }
        return $info;
    }

    public function ajax_zfzs_info($id){
        $base_info = M('BaseInfo')->where(['id'=>$id])->find();
        $info = M('ItemInfo')->alias('il')->join('LEFT JOIN __ITEM_INFO_ZCJY__ iit ON il.id=iit.id')->where(['il.id'=>$id])->find();
        if($info['i_pic']){
            $info['ext_i_pic'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_pic']]])->select();
        }
        if($info['i_att']){
            $info['ext_i_att'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att']]])->select();
        }
        $info = array_merge_multi($base_info,$info);
        return $info;
    }

    public function ajax_tzlc_info($id){
        $base_info = M('BaseInfo')->where(['id'=>$id])->find();
        $info = M('ItemInfo')->alias('il')->join('LEFT JOIN __ITEM_INFO_TZLC__ iit ON il.id=iit.id')->where(['il.id'=>$id])->find();
        if($info['i_pic']){
            $info['ext_i_pic'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_pic']]])->select();
        }
        if($info['i_att']){
            $info['ext_i_att'] = M('Attach')->field('id,info_id,path,memo')->where(['info_id'=>$info['id'],'id'=>['in',$info['i_att']]])->select();
        }
        $info = array_merge_multi($base_info,$info);
        return $info;
    }

    public function zjxm_publish(){
        $page_seo['title']='发布信息-用户中心';
        $this->assign('page_seo',$page_seo);
        $add = I('get.add','');
        $category_list = F('category_list');
        $this->assign('category_list',$category_list);
        $s100 = M('Category')->where(['c_alias'=>'s100'])->select();
        $this->assign('s11',$s100);

        if($add){
            $data['info_type']=$add;
            $this->display('zjxm_publish_'.$add);
        }
    }

    
    public function jsj(){
        $arr = $this->amount_range($a,$b,$c,$d);
        $result = $this->cal_range($arr[0],$arr[1]);
        return $result['num'];
    }
    

    public function js(){
        $info_list = M('BaseInfo2')->field('id,amount_interval_min,amount_interval_max,amount_interval_min_unit,amount_interval_max_unit,amount_range')->select();
        $amount_range = [];       
        foreach ($info_list as $k => $v) {            
            if($k >0 && $k <= 500){
                $result = $this->jsj($v['amount_interval_min'],$v['amount_interval_max'],$v['amount_interval_min_unit'],$v['amount_interval_max_unit']);
                M('base_info2')->where(["id"=>$v['id']])->save(["amount_range"=>$result]);
            }
        }
    }

    public function amount_range($a,$b,$c,$d){
        if($c==1){
                $c=10000;
           }else{
                $c=100000000;
           }
           if($d==1){
                $d=10000;
           }else{
                $d=100000000;
           }
           $e = $a*$c;
           $f = $b*$d;
           return array($e,$f);
    }

    public function cal_range($a,$b){
        if($a>0 && $b<=100000){
            $range['num'] = 1;
            $range['cn']='1万-10万';
        }elseif($a>=100000 && $b<=500000){
            $range['num'] = 2;
            $range['cn']='10万-50万';
        }elseif($a>=500000 && $b<=1000000){
            $range['num'] = 3;
            $range['cn']='50万-100万';
        }elseif($a>=1000000 && $b<=5000000){
            $range['num'] = 4;
            $range['cn']='100万-500万';
        }elseif($a>=5000000 && $b<=10000000){
            $range['num'] = 5;
            $range['cn']='500万-1000万';
        }elseif($a>=10000000 && $b<=50000000){
            $range['num'] = 6;
            $range['cn']='1000万-5000万';
        }elseif($a>=50000000 && $b<=100000000){
            $range['num'] = 7;
            $range['cn']='5000万-1亿';
        }elseif($a>100000000 || $b<100000000){
            $range['num'] = 8;
            $range['cn']='大于1个亿';
        }else{
            $range['num'] = 9;
            $range['cn']='什么也没有';
        }
        return $range;
    }

    
    function account(){
        $uid=C('visitor.uid');
        if(empty($uid)){
            $this->error('参数不能为空！');
        }
        $category = F('category');
        $userinfo=D('Members')->get_userinfo(array('uid'=>$uid));

        $ext_role = M('ExtRole')->where(['uid'=>$uid])->find();
        $userinfo = array_merge_multi($userinfo,$ext_role);
        
        $userinfo['percent_info'] = R('Personal/member_percent',[$userinfo]);
        
        //print_r($userinfo['percent_info']);
        //exit;
        $userinfo['years_revenue'] = explode(',',$userinfo['years_revenue']);
        $userinfo['years_profit'] = explode(',',$userinfo['years_profit']);
        if(IS_AJAX){
            $data = I('post.','','trim');
            if(!empty($data['email'])){
                $email_check = M('Members')->where(['email'=>$data['email']])->find();
                if($email_result){
                    $res['code']=0;
                    $res['msg'] = '邮箱已经存在,请更换!';
                }
            }
                $ExtRole=['type','company','introduce','registered_capital','is_earnings','years_revenue','years_revenue_unit','years_profit','years_profit_unit','net_asset','net_asset_unit','company_date','department_name','contact_job','contact_job_name','company_address','province_id_com','city_id_com','area_id_com','company_area_id','last_fiscal_revenue'];
                $field_key = array_keys($data);
                foreach ($ExtRole as $v){
                    foreach ($field_key as &$vv) {
                        if($vv==$v){
                            $data['ExtRole'][$vv] = $data[$v];
                            unset($data[$v]);
                        }
                    }
                }
                unset($data['contact_job']);
                $ExtRole_id = M('ExtRole')->where(['uid'=>$uid])->find();
                if(empty($ExtRole_id)){
                    M('ExtRole')->data(['uid'=>$uid])->add();
                }
                if($data['ExtRole']['company_date']){
                    $data['ExtRole']['company_date'] = strtotime($data['ExtRole']['company_date']);
                }
                if($data['ExtRole']['years_revenue']){
                    $data['ExtRole']['years_revenue'] = implode(',',$data['ExtRole']['years_revenue']);
                }
                if($data['ExtRole']['years_profit']){
                    $data['ExtRole']['years_profit'] = implode(',',$data['ExtRole']['years_profit']);
                }
                //这点有点问题,需要处理下,数据为空时不会保存
                //$data = array_filter($data);
                $data = array_no_empty($data);

                // echo '<pre>';
                // print_r($data);
                // exit;
                $result = D('Members')->where(['uid'=>$uid])->relation(true)->save($data);

                //echo M()->_sql();
                if($result !== false){
                    $res['code']=200;
                    $res['msg']='修改成功';
                    $res['result']=$result;
                }else{
                    $res['data']['error_messages']=0;
                    $res['msg']='修改失败';
                    $res['result']=$result;
                }
            echo json_encode($res);
            die();
        }
        $category = F('category');
        $this->assign('category',$category);
        $this->assign('personal_nav',ACTION_NAME);
        $this->assign('userinfo',$userinfo);
        $type = I('get.type',$userinfo['type']);
        switch ($type) {
            case 1:
                $type='company';
                break;
            case 2:
                $type='government';
                break;
            case 3:
                $type='personal';
                break;
            default:
                $type='account';
                break;
        }
        $page_seo['title']='我的资料-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->display($type);
    }
    
    public function del(){
        if(IS_POST){
            $utype = C('visitor.utype');
            $uid = C('visitor.uid');
            $id = I('post.id');
           if($id){
            if($utype==1){
                $result = M('BaseInfo')->where(['id'=>$id,'uid'=>$uid])->delete();
                if($result){
                    $result = M('FundInfo')->where(['id'=>$id])->delete();
                }
            }else{
                $result = M('BaseInfo')->where(['id'=>$id,'uid'=>$uid])->delete();
                if($result){
                    $result = M('ItemInfo')->where(['id'=>$id,'uid'=>$uid])->delete();
                } 
            }
                if($result){
                    $this->ajaxReturn($result);
                }
           }
        }
    }
    
    public function published(){
        $page_seo['title']='已发布信息-用户中心';
        $this->assign('page_seo',$page_seo);
        $info_type=[1=>'项目融资',200=>'资产交易',700=>'政府招商',2010=>'股权投资',2005=>'投资理财',2011=>'债权投资',2012=>'金融投资',2013=>' BT/BOT 项目投资',2014=>'其它投资'];
        $utype = C('visitor.utype');
        $uid = C('visitor.uid');
        if($utype==1){
            $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ fi ON bi.id=fi.id')->where(['bi.uid'=>$uid])->select();
        }else{
            $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ ii ON bi.id=ii.id')->where(['bi.uid'=>$uid])->select();
            foreach ($info_list as $k => $v) {
                $info_list[$k]['count'] = M('InfoConsult')->where(['info_id'=>$v['id']])->count();
            }
        }
        $this->assign('info_type',$info_type);
        $this->assign('info_list',$info_list);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function security(){
        $uid = C('visitor.uid');
        $info = M('Members')->where(['uid'=>$uid])->find();
        $this->assign('info',$info);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function complaints(){
        $name_id = C('visitor.uid');
        $complaints_list = M('complaints')->where(['name_id'=>$name_id])->select();
        foreach ($complaints_list as $k => $v) {
            $complaints_list[$k]['addtime'] = date('Y-m-d',$v['addtime']);
        }
        $this->assign('complaints_list',$complaints_list);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    function member_percent($userinfo){
        if(!is_array($userinfo)){
            return;
        }
        switch ($userinfo['type']) {
            case '3':
            $percent = array('mobile'=>25,'phone'=>8,'email'=>25,'qq'=>8,'personal_introduce'=>17,'reg_address'=>8,'avatars'=>8);
            foreach ($userinfo as $k => $v) {
               foreach ($percent as $key => $val) {
                    if($k==$key && !empty($v)){
                        $user_percent+=$val;
                    }elseif($k==$key && empty($v)){
                        $unperfect[$key]=$key;
                    }
                } 
            }
                break;
            case '2':
                # code...
                break;
            case '1':
                # code...
                break;
            default:
                return;
                break;
        }
        $data['user_percent'] = $user_percent;
        $data['unperfect'] = $unperfect;
        return $data;
    }

    function complaints_send(){
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function order(){
        $page_seo['title']='我的订单-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function tongbao(){
        $page_seo['title']='我的订单-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','order');
        $this->display();
    }

    public function company_show(){
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function rss(){
        $page_seo['title']='订阅消息-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','receive');
        $this->display();
    }

    function contact(){
        $this->display();
    }

    function manage_rss(){
        $page_seo['title']='我的收藏-用户中心';
        $collection_list = M('Collection')->where(['uid'=>C('visitor.uid')])->select();
        foreach ($collection_list as $k => $v) {
            $in = $v['info_id'].',';
        }
        $where['id'] = ['in',$in];
        $base_info = M('BaseInfo')->field('id,title,type')->where($where)->select();
        $info_c=[1=>'Fund',2=>'Item'];
        foreach ($base_info as $k => $v) {
            $base_info[$k]['url'] = $info_c[$v['type']].'/show/id/'.$v['id'];
            $base_info[$k]['list_url'] = $info_c[$v['type']].'/'.strtolower($info_c[$v['type']]).'_list';
        }
        $collection_list = array_link($base_info,array_key($collection_list,'info_id'),'id');
        $this->assign('collection_list',$collection_list);
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    function manage_rss_del(){
        if(IS_POST){
        $id = I('post.ids');
        $uid = C('visitor.uid');
        $where['id'] = ['in',$id];
        $where['uid'] = $uid;
        if(!$id) $this->error('id不存在!');
        $res = M('Collection')->where($where)->delete();
            if($res){
                $msg['code'] =1;
                $this->ajaxReturn(1,'删除成功',$msg);
            }else{
                $msg['code'] =0;
                $this->ajaxReturn(0,'删除失败',$msg);
            }
        }
    }

    function who_collect_me(){
        $page_seo['title']='被谁收藏-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','manage_rss');
        $this->display();
    }

    function funder(){
        $page_seo['title']='资金方查询-用户中心';
        $this->assign('page_seo',$page_seo);
        $relaname = I('get.keyword','股权投资');
        if($relaname){
            $where['company_name']  = array('like',"%$relaname%");
        }
        $count = M('Members2')->where($where)->count();
        $limit = $this->getPageLimit($count,20);

        $member_list = M('Members2')->field('uid,realname,company_name,reg_address,mobile,phone,area_name')->limit($limit)->where($where)->order('rand()')->select();
        $page = $this->getPageShow($pageMaps);
        $this->assign('page', $page);
        $this->assign('member_list',$member_list);
        $this->display();
    }

    function show_contacter(){
        $user_id = I('post.user_id');
        $login_uid = I('post.login_uid');
        if(empty($user_id) || empty($login_uid)){
            $res['code'] = 0;
            $res['msg'] = '请正确传递参数';
            echo json_encode($res);
        }
        $mobile = M('Members2')->where(['uid'=>$user_id])->getField('mobile');
        if($mobile){
            $res['code'] = 1;
            $res['msg'] = '资方联系方式为:'.$mobile;
            echo json_encode($res);
        }
    }

    public function invitee(){
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function receive($info_id=''){
        $page_seo['title']='我收到的约谈-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
        if($info_id){
            $where['info_id'] = $info_id;
        }
        $where['uid'] = C('visitor.uid');
        $msg_list['count'] = M('InfoConsult')->where($where)->count();
        $msg_list['list'] = M('InfoConsult')->where($where)->select();
        $this->assign('msg_list',$msg_list);
        $this->display();
    }

    function dreceive(){
        $page_seo['title']='我收到的投递-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    function sendlist(){
        $page_seo['title']='我发起的约谈-金融网';
        //$receice_list = M('')->select();
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function sent(){
        $page_seo['title']='已发送的消息-金融网';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','receive');
        $this->display();
    }

    public function system(){
        $page_seo['title']='系统消息-金融网';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','receive');
        $this->display();
    }

    public function talks(){
        if(IS_POST){
            $user_id = I('post.user_id');
            $zjxm_id = I('post.zjxm_id');
            $title = I('post.title');
            $is_vip = C('visitor.is_vip');
            if($is_vip){
                $user_info = M('Members')->where(['uid'=>$user_id])->find();
                $result['msg']='资金方联系方式为:'.$user_info['mobile'];
                $this->ajaxReturn(0,"资金方联系方式为".$user_info['mobile']);
            }
            if($user_id){
                $result['msg']='加入会员后才能联系资金方';
                $this->ajaxReturn(0,'加入会员后才能联系资金方');
            }
        }
        $page_seo['title']='我收到的约谈-用户中心';
        $this->assign('page_seo',$page_seo);
        $item_list = M('Receive')->where(['uid'=>C('visitor.uid')])->order('addtime desc')->select();
        foreach ($item_list as $k => $v) {
            $item_list[$k]['info'] = M('BaseInfo')->field('id,title,click,uid')->where(['uid'=>$v['from_user_id']])->find();
            if(empty($item_list[$k]['info'])){
                unset($item_list[$k]);
            }
        }
        $this->assign('item_list',$item_list);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    public function dsendlist(){
        $page_seo['title']='我发起的投递-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
        $this->display();
    }

    /**
     * 消息提醒
     */
    public function msg_pms(){
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
            $this->assign('msg',$msg);
            $this->_config_seo(array('title'=>'消息提醒 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'消息提醒'));
        }
        $this->display();
    }

    /**
     * 消息详细
     */
    public function msg_check(){
        $ids = I('request.id','','trim');
        $reg = D('Pms')->msg_check($ids,C('visitor'));
        if($reg['state']){
        //    $this->assign('msg',$reg['data']);
            $this->ajaxReturn(1,'获取数据成功！',$reg['data']['message']);
        }else{
            $this->_404($reg['error']);
        }
     //   $this->_config_seo(array('title'=>'系统消息 - 个人会员中心 - '.C('qscms_site_name'),'header_title'=>'系统消息'));
      //  $this->display();
    }

}
?>