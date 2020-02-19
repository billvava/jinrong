<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class MembersController extends FrontendController{
	public function _initialize() {
		parent::_initialize();
        //访问者控制
        if(!$this->visitor->is_login) {
            if(in_array(ACTION_NAME, array('index','pms','sign_in'))){
                IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
                //非ajax的跳转页面
                $this->redirect('members/login');
            }
        }else{
            /*
            if(C('visitor.utype')==0){
                $this->redirect('personal/select_role');
            }
           */
            $urls = array('1'=>'personal/index','2'=>'personal/index');
            !IS_AJAX && !in_array(ACTION_NAME, array('logout','varify_email')) && $this->redirect($urls[C('visitor.utype')]);
        }
	}
	
    public function batch_user_reg(){
        $data['username'] = 'qrh_'.randnums(5,0);
        $data['mobile']='18080808040';
        $data['realname']=444;
        $pwd_hash = D('Members')->randstr();
        $password='211314';
        $data['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
        $data['pwd_hash'] = $pwd_hash;
        $data['mobile_audit']=1;
        $data['status']=1;
        $result = M('Members')->add($data);
        if($result){
            $this->success('添加成功!',U('index/index'));
            die();
        }else{
            $this->error('添加失败!',U('index/index'));
            die();
        }
    }

    public function family_name(){
        $arr = ['梁','刘','赵','陈','李','周','朱','胡','傅','张','杨','卢','高','黄','王','柯','唐','鲁','徐','周','祝','邓','何','石','沈','寇','林','罗','邱','龚','曾','秦','白','段','彭','潘','杜','聂','郑','董','金','邵','吴','姜','戴','孙','罗','岑','马','贾','夏','余','包','宁','钱','冯','沈','韩','吕','孔','曹','严','魏','陶','蒋','姜','江','佟','亢','岳','海','钦','汝','阎','楚','晋','卫','施','谢','邹','柏','章','窦','苏','葛','苗','方','袁','柳','俞','任','酆','史','薛','贺','倪','汤','牛','游','荆','关','那','简','巩','聂','晁','越','文','廖','艾','瞿','柴','尚','谭','乔','黎','詹','宁','伊','井','靳','陆','裴','邢','程','诸','丁','缪','莫','樊','田','蔡','郭','童','阮','项','屈','舒','纪','熊','庞','茅','宋','米','狄','毛','祁','贝','姚','汪','尹','萧','穆','孟','顾','康','齐','时','于','毕','郝','常'];
    }

    /**
     * [login 用户登录]
     */
	public function login() {
        if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Members','a'=>'login')));
        }
        
        if(IS_AJAX && IS_POST){
            $btype = I('get.btype','');
            $expire = I('post.expire',0,'intval');
            if($btype){
                session('btype',$btype);
            }
            $index_login = I('post.index_login',0,'intval');
            $url = I('post.url','','trim');
            if (C('qscms_captcha_open')==1 && (C('qscms_captcha_config.user_login')==0 || (session('?error_login_count') && session('error_login_count')>=C('qscms_captcha_config.user_login')))){
                if(true !== $reg = \Common\qscmslib\captcha::verify()) $this->ajaxReturn(0,$reg);
            }
            if($mobile = I('post.mobile','','trim')){
                if(!fieldRegex($mobile,'mobile')) $this->ajaxReturn(0,'手机号格式错误！');
                $smsVerify = session('login_smsVerify');
                !$smsVerify && $this->ajaxReturn(0,'验证码错误！');//验证码错误！
                if($mobile != $smsVerify['mobile']) $this->ajaxReturn(0,'手机号不一致！');//手机号不一致
                if(time()>$smsVerify['time']+600) $this->ajaxReturn(0,'验证码过期！');//验证码过期
                $vcode_sms = I('post.mobile_vcode',0,'intval');
                $mobile_rand=substr(md5($vcode_sms), 8,16);
                if($mobile_rand!=$smsVerify['code']) $this->ajaxReturn(0,'验证码错误！');//验证码错误！
                $user = M('Members')->where(array('mobile'=>$smsVerify['mobile']))->find();
                !$user && $err = '帐号不存在！';
                $uid = $user['uid'];
                if(!$user['mobile_audit']){
                    $setsqlarr['mobile'] = $smsVerify['mobile'];
                    $setsqlarr['mobile_audit']=1;
                    if(false !== $reg = M('Members')->where(array('uid'=>$uid))->save($setsqlarr)){
                        D('Members')->update_user_info($setsqlarr,$user);
                        if($user['utype']=='1'){
                            $rule=D('Task')->get_task_cache($user['utype'],22);
                            D('TaskLog')->do_task($user,22);
                        }else{
                            $rule=D('Task')->get_task_cache($user['utype'],7);
                            D('TaskLog')->do_task($user,7);
                        }
                        write_members_log($user,8002);
                    }
                }
                session('login_smsVerify',null);
            }else{
                $username = I('post.username','','trim');
                $password = I('post.password','','trim');
                $passport = $this->_user_server();
                if(false === $uid = $passport->auth($username, $password)) $err = $passport->get_error();
            }
            if($uid){
                if(false === $this->visitor->login($uid, $expire)) $this->ajaxReturn(0,$this->visitor->getError());
                $urls = array('1'=>'personal/index','2'=>'personal/index');
                $login_url = $url ? $url : U($urls[$this->visitor->info['utype']]);
                $this->ajaxReturn(1,'登录成功！',$login_url);
            }
            //记录登录错误次数
            if(C('qscms_captcha_open')==1){
                if(C('qscms_captcha_config.user_login')>0){
                    $error_login_count = session('?error_login_count')?(session('error_login_count')+1):1;
                    session('error_login_count',$error_login_count);
                    if(session('error_login_count')>=C('qscms_captcha_config.user_login')){
                        $verify_userlogin = 1;
                    }else{
                        $verify_userlogin = 0;
                    }
                }else{
                    $verify_userlogin = 1;
                }
            }else{
                $verify_userlogin = 0;
            }
            
            $this->ajaxReturn(0,$err,$verify_userlogin);
        }else{
            if($this->visitor->is_login){
                $urls = array('1'=>'personal/index','2'=>'personal/index');
                $this->redirect($urls[C('visitor.utype')]);
            }
            if(false === $oauth_list = F('oauth_list')){
                $oauth_list = D('Oauth')->oauth_cache();
            }
            $this->assign('oauth_list',$oauth_list);
            $this->assign('title','会员登录 - '.C('qscms_site_name'));
            $this->assign('weixin_login',C('qscms_weixin_apiopen') && C('qscms_weixin_scan_login'));//微信扫描登录是否开启
            $this->assign('verify_userlogin',$this->check_captcha_open(C('qscms_captcha_config.user_login'),'error_login_count'));
            $this->display();
        }
    }

    //弹窗登录
    public function show_login() {        
        $username = I('post.username','','trim');
        $password = I('post.password','','trim');
        $passport = $this->_user_server();
        if(false === $uid = $passport->auth($username, $password)) $this->ajaxReturn(0,'账号或密码错误，请重新输入');
        if($uid){
            if(false === $this->visitor->login($uid, $expire)) $this->ajaxReturn(0,$this->visitor->getError());
            //上次调用的页面路径
            $url = getenv("HTTP_REFERER");
            $this->ajaxReturn(1,'登录成功！',$url);
        } 
    }

    /**
     * 用户退出
     */
    public function logout() {
		$this->visitor->logout();
		//同步退出
		$passport = $this->_user_server();
		$synlogout = $passport->synlogout();
        $this->redirect('members/login');
    }

    /**
     * [register 会员注册]
     */
    public function register(){
        if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Members','a'=>'register')));
        }
        if(IS_POST && IS_AJAX){
            $data['reg_type'] = I('post.reg_type',0,'intval');
            $array = array(1 => 'mobile');
            if(!$reg = $array[$data['reg_type']]) $this->ajaxReturn(0,'正确选择注册方式！');
            $data['utype'] = I('post.utype',0,'intval');
            if($data['utype'] != 1 && $data['utype'] != 2) $this->ajaxReturn(0,'请正确选择会员类型!');
            if($data['reg_type'] == 1){
                $data['mobile'] = I('post.mobile',0,'trim');
                $smsVerify = session('reg_smsVerify');
                if(!$smsVerify) $this->ajaxReturn(0,'验证码错误！');
                if($data['mobile'] != $smsVerify['mobile']) $this->ajaxReturn(0,'手机号不一致！',$smsVerify);//手机号不一致
                if(time()>$smsVerify['time']+60000) $this->ajaxReturn(0,'验证码过期！');//验证码过期
                $vcode_sms = I('post.mobile_vcode',0,'intval');
                $mobile_rand=substr(md5($vcode_sms), 8,16);
                if($mobile_rand!=$smsVerify['code']) $this->ajaxReturn(0,'验证码错误！');//验证码错误！
                $data['password'] = I('post.password','','trim');
                $passwordVerify = I('post.passwordVerify','','trim');
            }else{
                if($data['utype'] == 1){
                    $data['password'] = I('post.cpassword','','trim');
                    $passwordVerify = I('post.cpasswordVerify','','trim');
                }else{
                    $data['password'] = I('post.emailpassword','','trim');
                    $passwordVerify = I('post.emailpasswordVerify','','trim');
                }
                $data['username'] = I('post.username','','trim,badword');
                $data['utype']==1 && $data['mobile'] = I('post.telephone','','trim,badword');
                C('qscms_check_reg_email') && $data['status'] = 0;
            }
            $data['password'] = I('post.password','','trim');
            $passwordVerify = I('post.passwordVerify','','trim');
            !$data['password'] && $this->ajaxReturn(0,'请输入密码!');
            $data['password'] != $passwordVerify && $this->ajaxReturn(0,'两次密码输入不一致!');
            $passport = $this->_user_server();
            if(false === $data = $passport->register($data)){
                if($user = $passport->get_status()) $this->ajaxReturn(1,'会员注册成功！',array('url'=>U('members/reg_email_activate',array('uid'=>$user['uid']))));
                $this->ajaxReturn(0,$passport->get_error());
            }
            //如果是推荐注册，赠送积分
            $incode = I('post.incode','','trim');
            if($incode){
                if(preg_match('/^[a-zA-Z0-9]{8}$/',$incode)){  
                    $inviter_info = M('Members')->where(array('invitation_code'=>$incode))->find();
                    if($inviter_info){
                        $task_id = $inviter_info['utype']==1?31:14;
                        D('TaskLog')->do_task($inviter_info,$task_id);
                    }
                }
            }
            if('bind' == I('post.org','','trim') && cookie('members_bind_info')){
                $user_bind_info = object_to_array(cookie('members_bind_info'));
                $user_bind_info['uid'] = $data['uid'];
                $oauth = new \Common\qscmslib\oauth($user_bind_info['type']);
                $oauth->bindUser($user_bind_info);
                $this->_save_avatar($user_bind_info['temp_avatar'],$data['uid']);//临时头像转换
                cookie('members_bind_info', NULL);//清理绑定COOKIE
            }
            session('reg_smsVerify',null);
            D('Members')->user_register($data);
            $this->_correlation($data);
            $result['url'] = $data['utype']==2 ? U('Home/personal/account') : U('Home/personal/index');
            $this->ajaxReturn(1,'会员注册成功！',$result);
        }else{
            $utype = I('get.utype',0,'intval');
            $utype == 0 && $type = 'reg';
            $utype == 1 && $type = 'reg_company';
            $utype == 2 && $type = 'reg_personal';
            $this->assign('utype',$utype);//注册会员类型
            $this->assign('user_bind',$user_bind);
            $this->assign('oauth_list',$oauth_list);
            $this->assign('company_repeat',C('qscms_company_repeat'));//企业注册名称是否可以重复
            $this->_config_seo(array('title'=>'会员注册 - '.C('qscms_site_name')));

            $this->display($type);
        }
    }

    //注册测试
    function reg_test(){
        if(IS_POST && IS_AJAX){
            //$post = I('post.');
            //print_r($post);
            //exit;
            $data['mobile'] = I('post.mobile',0,'trim');
            $log = M('Members')->where(['mobile'=>$data['mobile']])->find();
            if(!$log){
                if($data['mobile']){
                    $data['username'] = '7rh_'.$data['mobile'];
                    $data['mobile_audit'] = 1;
                    $data['utype'] = 3;
                    $data['realname'] = $data['realname'];
                    $pwd_hash = D('Members')->randstr();
                    $password= I('post.yzm',0,'intval');
                    $data['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
                    $data['pwd_hash'] = $pwd_hash;
                    $data['mobile_audit']=1;
                    $data['reg_time'] = time();
                    $data['status']=1;
                }
                M()->startTrans();
                $result = M('Members')->add($data);
                if(!$result){
                    return false;
                    M('Members')->rollback();
                    $this->error('申请提交失败!');
                }else{
                    $data['id'] = $result;
                    $data['step']=2;
                    $result = M('Stlm')->add($data);
                    if($result){
                        M('Stlm')->commit();
                        $this->success('申请提交成功!');
                    }else{
                        M('Stlm')->rollback();
                        $this->error('申请提交失败!');
                    }
                }
            }
            if($result){
                echo 333;
                exit;
                //R('Home/Email/email_send',[$result]);
                $user = M('Members')->where(['mobile'=>$data['mobile']])->find();
                $uid = $user['uid'];
                if(false === $this->visitor->login($uid, $expire)) $this->ajaxReturn(0,$this->visitor->getError());
                $this->ajaxReturn(1,'注册成功！',['url'=>U('Lianmeng/index')]);
            }else{
                $this->ajaxReturn(0,'注册失败！');
            }
        }
    }

    public function index_register(){
        if(IS_POST && IS_AJAX){
            $array = array(1 => 'mobile');
            $data['mobile'] = I('post.mobile',0,'trim');
            $utm_source = I('post.following','');
            if($utm_source){
                $data['following'] = serialize(explode('-',$utm_source));
            }
            $log = M('Members')->where(['mobile'=>$data['mobile']])->find();
            if(!$log){
                if($data['mobile']){
                    $data['username'] = '7rh_'.$data['mobile'];
                    $data['mobile_audit'] = 1;
                    $pwd_hash = D('Members')->randstr();
                    $password= I('post.yzm',0,'intval');
                    $data['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
                    $data['pwd_hash'] = $pwd_hash;
                    $data['mobile_audit']=1;
                    $data['reg_time'] = time();
                    $data['status']=1;
                }
                $result = M('Members')->add($data);
            }
            if($result){
                R('Home/Email/email_send',[$result]);
                $user = M('Members')->where(array('mobile'=>$data['mobile']))->find();
                $uid = $user['uid'];
                if(false === $this->visitor->login($uid, $expire)) $this->ajaxReturn(0,$this->visitor->getError());
                $this->ajaxReturn(1,'注册成功！',array('url'=>U('Personal/index')));
            }else{
                $this->ajaxReturn(0,'注册失败！');
            }
        }
        return false;
    }

    function draft_register(){
        header("Access-Control-Allow-Origin:http://piaoju.7ronghui.com");

        if(IS_POST){
            $array = array(1 => 'mobile');
            $data['mobile'] = I('post.mobile',0,'trim');
            $log = M('DraftMembers')->where(['mobile'=>$data['mobile']])->find();
            if(!$log){
                if($data['mobile']){
                    $data['username'] = '7rh_'.$data['mobile'];
                    $data['mobile_audit'] = 1;
                    $pwd_hash = D('Members')->randstr();
                    $password= I('post.yzm',0,'intval');
                    $data['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
                    $data['pwd_hash'] = $pwd_hash;
                    $data['mobile_audit']=1;
                    $data['reg_time'] = time();
                    $data['status']=1;
                }
                $result = M('DraftMembers')->add($data);
            }else{
                $this->ajaxReturn(0,'账户已存在,请登录！');
            }
            if($result){
                R('Home/Email/draft_email_send',[$result]);
                $this->ajaxReturn(1,'注册成功！,稍后工作人员会跟您联系');
            }
        }
        return false;
    }

    public function index_register3(){
        if(IS_POST && IS_AJAX){
            $array = array(1 => 'mobile',2=>'pc');
            $data['mobile'] = I('post.mobile',0,'trim');
            $smsVerify = session('reg_smsVerify');
            if(!$smsVerify) $this->ajaxReturn(0,'验证码错误！');
            if($data['mobile'] != $smsVerify['mobile']) $this->ajaxReturn(0,'手机号不一致！',$smsVerify);//手机号不一致
            if(time()>$smsVerify['time']+60000) $this->ajaxReturn(0,'验证码过期！');//验证码过期
                $vcode_sms = I('post.yzm',0,'intval');
                $mobile_rand=substr(md5($vcode_sms), 8,16);
                if($mobile_rand!=$smsVerify['code']) $this->ajaxReturn(0,'验证码错误！');//验证码错误！
            $log = M('Members')->where(['mobile'=>$data['mobile']])->find();
            if(!$log){
                $data['password'] = I('post.password','','trim');
                $passwordVerify = I('post.passwordVerify','','trim');
                !$data['password'] && $this->ajaxReturn(0,'请输入密码!');
                $data['password'] != $passwordVerify && $this->ajaxReturn(0,'两次密码输入不一致!');
                $password= I('post.password',0,'intval');
                $data['username'] = '7rh_'.$data['mobile'];
                $data['mobile_audit'] = 1;
                $pwd_hash = D('Members')->randstr();
                $password= I('post.yzm',0,'intval');
                $data['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
                $data['pwd_hash'] = $pwd_hash;
                $data['mobile_audit']=1;
                $data['reg_time'] = time();
                $data['status']=1;
                $data['utype']=2;
                $result = M('Members')->add($data);
            }else{
                $url = getenv("HTTP_REFERER");
                $this->ajaxReturn(1,'注册成功！',array('url'=>$url));
            }
            if($result){
                R('Home/Email/email_send',[$result]);
                $user = M('Members')->where(array('mobile'=>$data['mobile']))->find();
                $uid = $user['uid'];
                if(false === $this->visitor->login($uid, $expire)) $this->ajaxReturn(0,$this->visitor->getError());
                //上次调用的页面路径
                 $url = getenv("HTTP_REFERER");
                 $this->ajaxReturn(1,'注册成功！',array('url'=>$url));
            }else{
                $this->ajaxReturn(0,'注册失败！');
            }
        }
        return false;
    }


    protected function _correlation($data){
        $members_mod = D('Members');
        if(false === $this->visitor->login($data['uid'])){
            IS_AJAX && $this->ajaxReturn(0,$this->visitor->getError());
            $this->error($this->visitor->getError(),'register');
        }
        if($data['reg_type'] == 2){
            if(false === $mailconfig = F('mailconfig')) $mailconfig = D('Mailconfig')->get_cache();//邮箱系统配置参数
            if($mailconfig['set_reg']==1){
                $utype_cn = array('1'=>'企业','2'=>'个人');
                $send_mail['send_type']='set_reg';
                $send_mail['sendto_email']=$data['email'];
                $send_mail['subject']='set_reg_title';
                $send_mail['body']='set_reg';
                $replac_mail['username']=$this->visitor->info['username'];
                $replac_mail['password']=$data['password'];
                $replac_mail['utype']=$utype_cn[$data['utype']];
                D('Mailconfig')->send_mail($send_mail,$replac_mail);
            }
        }
    }

    /**
     * [activate 邮箱注册激活]
     */
    public function activate(){
        parse_str(decrypt(I('get.key','','trim')),$data);
        !fieldRegex($data['e'],'email') && $this->error('邮箱格式错误！',U('members/register'));
        $end_time=$data['t']+24*3600;
        if($end_time<time()) $this->error('注册失败,链接过期!',U('members/register'));
        $key_str=substr(md5($data['e'].$data['t']),8,16);
        if($key_str!=$data['k']) $this->error('注册失败,key错误',U('members/register'));
        $members_mod = D('Members');
        $user = $members_mod->field('uid,utype,email,status')->where(array('email'=>$data['e']))->find();
        !$user && $this->error('帐号不存在！',U('members/register'));
        $points_rule = D('Task')->get_task_cache(2,1);
        $urls = array('1'=>'company/index','2'=>U('personal/resume_add',array('points'=>$points_rule['points'],'first'=>1)));
        if($user['status'] == 0){
            $d = array('username'=>$data['n'],'password'=>$data['p'],'status'=>1,'email_audit'=>1);
            $passport = $this->_user_server();
            if(false === $uid = $passport->edit($user['uid'],$d)) $this->error('帐号激活失败，请重新操作！',U('members/register'));
            $user['reg_type'] = 2;
            $user['password'] = $data['p'];
            $this->_correlation($user);
            $this->success('帐号激活成功！',$urls[$this->visitor->info['utype']]);
        }else{
            $this->success('帐号已经激活,请登录！',U('members/login'));
        }
    }

    public function reg_email_activate(){
        $uid = I('get.uid',0,'intval');
        !$uid && $this->redirect('members/register');
        $user = M('Members')->field('uid,email')->where(array('uid'=>$uid,'status'=>0))->find();
        !$user && $this->redirect('members/register');
        $this->assign('user',$user);
        $this->assign('title','会员注册 - '.C('qscms_site_name'));
        $this->display();
    }

    /**
     * [send_sms 注册验证短信]
     */
    public function verify_sms(){
        $mobile=I('get.mobile','','trim');
        if(!fieldRegex($mobile,'mobile')) $this->ajaxReturn(0,'手机号格式错误！');
        $smsVerify = session('reg_smsVerify');
        if($mobile!=$smsVerify('mobile')) $this->ajaxReturn(0,'手机号不一致！');//手机号不一致
        if(time()>$smsVerify('time')+600) $this->ajaxReturn(0,'验证码过期！');//验证码过期
        $vcode_sms = I('get.mobile_vcode',0,'intval');
        $mobile_rand=substr(md5($vcode_sms), 8,16);
        if($mobile_rand!=$smsVerify('code')) $this->ajaxReturn(0,'验证码错误！');//验证码错误！
        $this->ajaxReturn(1,'手机验证成功！');
    }

    // 注册发送短信/找回密码 短信
    public function reg_send_sms(){
        /*
        $allow_origin = array(  
            'https://www.7ronghui.com',  
            'http://www.7ronghui.com',
            'http://piaoju.7ronghui.com'
        );
        */
        //header('Access-Control-Allow-Origin:'.$allow_origin);
        header('Access-Control-Allow-Origin:*');
        if($uid = I('post.uid',0,'intval')){
            $mobile=M('Members')->where(array('uid'=>$uid))->getfield('mobile');
            !$mobile && $this->ajaxReturn(0,'用户不存在！');
        }else{
            $mobile = I('post.mobile','','trim');
            !$mobile && $this->ajaxReturn(0,'请填手机号码！');
        }
        if(!fieldRegex($mobile,'mobile')) $this->ajaxReturn(0,'手机号错误！');
        $sms_type = I('post.sms_type','reg','trim');
        $rand=mt_rand(100000, 999999);
        $img_yzm = I('post.img_yzm','','trim');
        // //if($img_yzm){
        //     if (!R('index/check_verify',['code'=>$img_yzm,'id'=>'','type'=>'ceshi'])){
        //     $this->ajaxReturn(0,'图片验证码错误！');
        //         return;
        //     }
        // //}
        switch ($sms_type) {
            case 'reg':
                $sendSms['tpl']='set_register';
                $sendSms['data']=array('code'=>$rand.'');
                break;
            case 'gsou_reg':
                $sendSms['tpl']='set_register';
                $sendSms['data']=array('code'=>$rand.'');
                break;
            case 'getpass':
                $sendSms['tpl']='set_retrieve_password';
                $sendSms['data']=array('code'=>$rand.'');
                break;
            case 'login':
                if(!$uid=M('Members')->where(array('mobile'=>$mobile))->getfield('uid')) $this->ajaxReturn(0,'您输入的手机号未注册会员');
                $sendSms['tpl']='set_login';
                $sendSms['data']=array('code'=>$rand.'');
                break;
        }
        $smsVerify = session($sms_type.'_smsVerify');
        if($smsVerify && $smsVerify['mobile']==$mobile && time()<$smsVerify['time']+600) $this->ajaxReturn(0,'10分钟内仅能获取一次短信验证码,请稍后重试');
        $sendSms['mobile']=$mobile;
        //F('sendSms',$sendSms);
        if(true === $reg = D('Sms')->sendSms('captcha',$sendSms)){
            session($sms_type.'_smsVerify',array('code'=>substr(md5($rand), 8,16),'time'=>time(),'mobile'=>$mobile));
            $this->ajaxReturn(1,'手机验证码发送成功！');
        }else{
            $this->ajaxReturn(0,$reg);
        }
    }

    
    public function regSendSms(){
        header('Access-Control-Allow-Origin:*');
        if($uid = I('post.uid',0,'intval')){
            $mobile=M('Members')->where(array('uid'=>$uid))->getfield('mobile');
            !$mobile && $this->ajaxReturn(0,'用户不存在！');
        }else{
            $mobile = I('post.mobile','','trim');
            !$mobile && $this->ajaxReturn(0,'请填手机号码！');
        }
        if(!fieldRegex($mobile,'mobile')) $this->ajaxReturn(0,'手机号错误！');

        $result = D('SmsCode') -> sendSMS($mobile);
        if($result['success']){
            $data = (array('status' => 1,'msg' => $result['msg']));
            $this->ajaxReturn(1,$result['msg'],$data);
        }else{
            $this->ajaxReturn(0,$result['msg']);
        }
       
    }

    /**
     * 检测用户信息是否存在或合法
     */
    public function ajax_check() {
        $type = I('post.type', 'trim', 'email');
        $param = I('post.param','','trim');
        if(in_array($type,array('username','mobile','email'))){
            $type != 'username' && !fieldRegex($param,$type) && $this->ajaxReturn(0,L($type).'格式错误！');
            $where[$type] = $param;
            $reg = M('Members')->field('uid,status')->where($where)->find();
            $reg['uid'] && $reg['status'] != 0 ? $this->ajaxReturn(0,L($type).'已经注册') : $this->ajaxReturn(1);
        }elseif($type == 'companyname'){
            if(C('qscms_company_repeat')==0){
                $reg = M('CompanyProfile')->where(array('companyname'=>$param))->getfield('id');
                $reg ? $this->ajaxReturn(0,'企业名称已经注册') : $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(1);
            }
        }
    }

    /**
     * 检测用户信息是否存在或合法
     */
    public function draft_ajax_check() {
        header("Access-Control-Allow-Origin:*");
        /*
        $allow_origin = array(  
            'https://www.7ronghui.com',  
            'http://www.7ronghui.com',
            'http://7ronghui.com',
            'http://piaoju.7ronghui.com'
        );
        header('Access-Control-Allow-Origin:'.$allow_origin);
        */
        $type = I('post.type', 'trim', 'email');
        $param = I('post.param','','trim');
        if(in_array($type,array('username','mobile','email'))){
            $type != 'username' && !fieldRegex($param,$type) && $this->ajaxReturn(0,L($type).'格式错误！');
            $where[$type] = $param;
            $reg = M('DraftMembers')->field('uid,status')->where($where)->find();
            $reg['uid'] && $reg['status'] != 0 ? $this->ajaxReturn(0,L($type).'已经注册') : $this->ajaxReturn(1);
        }
    }
    
    /**
     * [user_getpass 忘记密码]
     */
    public function user_getpass(){
        if(IS_POST){
            $type = I('post.type',0,'intval');
            $array = array(1 => 'mobile');
            $post = I('post.');
            //print_r($post);
            //exit;
            if(!$reg = $array[$type]) $this->error('请正确选择找回密码方式！');
            $retrievePassword = session('retrievePassword');
            if($retrievePassword['token'] != I('post.token','','trim')) $this->error('非法参数！');
            if($type == 1){
                $mobile = I('post.mobile',0,'trim');
                if(!$user = M('Members')->field('uid,username')->where(array('mobile'=>$mobile,'mobile_audit'=>1))->find()) $this->error('该手机号没有绑定帐号！');
                $smsVerify = session('getpass_smsVerify');
                if($mobile != $smsVerify['mobile']) $this->error('手机号不一致！');//手机号不一致
                if(time()>$smsVerify['time']+600) $this->error('验证码过期！');//验证码过期
                $vcode_sms = I('post.yzm',0,'intval');
                $mobile_rand=substr(md5($vcode_sms), 8,16);
                if($mobile_rand!=$smsVerify['code']) $this->error('验证码错误！');//验证码错误！
                $tpl = 'user_setpass';
                session('smsVerify',null);
            }
        }
        $token=substr(md5(mt_rand(100000, 999999)), 8,16);
        session('retrievePassword',array('uid'=>$user['uid'],'token'=>$token));
        $this->assign('token',$token);
        $this->_config_seo(array('title'=>'找回密码 - '.C('qscms_site_name')));
        $this->display($tpl);
    }

     /**
     * [find_pwd 重置密码]
     */
    public function user_setpass(){
        if(IS_POST){
            $retrievePassword = session('retrievePassword');
            if($retrievePassword['token'] != I('post.token','','trim')) $this->error('非法参数！');
            $user['password']=I('post.password','','trim,badword');
            !$user['password'] && $this->error('请输入新密码！');
            if($user['password'] != I('post.password1','','trim,badword')) $this->error('两次输入密码不相同，请重新输入！');
            $passport = $this->_user_server();
            if(false === $uid = $passport->edit($retrievePassword['uid'],$user)) $this->error($passport->get_error());
            $tpl = 'user_setpass_sucess';
            session('retrievePassword',null);
        }else{
            parse_str(decrypt(I('get.key','','trim')),$data);
            !fieldRegex($data['e'],'email') && $this->error('找回密码失败,邮箱格式错误！','user_getpass');
            $end_time=$data['t']+24*3600;
            if($end_time<time()) $this->error('找回密码失败,链接过期!','user_getpass');
            $key_str=substr(md5($data['e'].$data['t']),8,16);
            if($key_str!=$data['k']) $this->error('找回密码失败,key错误!','user_getpass');
            if(!$uid = M('Members')->where(array('email'=>$data['e']))->getfield('uid')) $this->error('找回密码失败,帐号不存在!','user_getpass');
            $token=substr(md5(mt_rand(100000, 999999)), 8,16);
            session('retrievePassword',array('uid'=>$uid,'token'=>$token));
            $this->assign('token',$token);
        }
        $this->_config_seo(array('title'=>'找回密码 - '.C('qscms_site_name')));
        $this->display($tpl);
    }

    /**
     * 账号申诉
     */
    public function appeal_user(){
        $mod = D('MembersAppeal');
        if(IS_POST && IS_AJAX){
            if (false === $data = $mod->create()) {
                $this->ajaxReturn(0, $mod->getError());
            }
            if($this->apply['Subsite']){
                $where['mobile'] = I('post.mobile','','trim');
                $where['email'] = I('post.email','','trim');
                $where['_logic'] = 'OR';
                $subsite_id = M('Members')->where($where)->getfield('subsite_id');
                $data['subsite_id'] = $subsite_id?:(C('SUBSITE_VAL.s_id')?:0);
            }
            if (false !== $mod->add($data)) {
                $this->ajaxReturn(1, L('operation_success'));
            } else {
                $this->ajaxReturn(0, L('operation_failure'));
            }
        }
        $this->_config_seo(array('title'=>'账号申诉 - '.C('qscms_site_name')));
        $this->display();
    }

    /**
     * [binding 第三方绑定]
     */
    public function apilogin_binding(){
        $user_bind_info = object_to_array(cookie('members_bind_info'));
        if(!$this->visitor->is_login && !$user_bind_info) $this->redirect('members/login');
        if(false === $oauth_list = F('oauth_list')){
            $oauth_list = D('Oauth')->oauth_cache();
        }
        $this->assign('third_name',$oauth_list[$user_bind_info['type']]['name']);
        $this->assign('user_bind_info', $user_bind_info);
        $this->_config_seo();
        $this->display();
    }

    /**
     * [oauth_reg 第三方登录注册]
     */
    public function oauth_reg(){
        if (cookie('members_bind_info')) {
            $user_bind_info = object_to_array(cookie('members_bind_info'));
        }else{
            $this->error('第三方授权失败，请重新操作！');
        }
        //第三方帐号绑定
        $username = I('post.username','','trim');
        $password = I('post.password','','trim');
        $passport = $this->_user_server();
        if(false === $uid = $passport->auth($username, $password)) $this->error($passport->get_error());
        if(false === $this->visitor->login($uid)) $this->error($this->visitor->getError());
        $oauth = new \Common\qscmslib\oauth($user_bind_info['type']);
        $bind_user = $oauth->_checkBind($user_bind_info['type'], $user_bind_info['keyid']);
        if($bind_user['uid'] && $bind_user['uid'] != $uid) $this->error('此帐号已经绑定过本站！');
        $user_bind_info['uid'] = $uid;
        if(false === $oauth->bindUser($user_bind_info)) $this->error('帐号绑定失败，请重新操作！');
        $this->visitor->get('avatars');
        if(!$this->visitor->get('avatars')) $this->_save_avatar($user_bind_info['temp_avatar'],$uid);//临时头像转换
        cookie('members_bind_info', NULL);//清理绑定COOKIE
        $urls = array('1'=>'company/index','2'=>'personal/index');
        $this->redirect($urls[$this->visitor->info['utype']]);
    }

    /**
     * [_save_avatar 第三方头像保存]
     */
    protected function _save_avatar($avatar,$uid){
        if(!$avatar) return false;
        $path = C('qscms_attach_path').'avatar/temp/'.$avatar;
        $image = new \Common\ORG\ThinkImage();
        $date = date('ym/d/');
        $save_avatar=C('qscms_attach_path').'avatar/'.$date;//图片存储路径
        if(!is_dir($save_avatar)) mkdir($save_avatar,0777,true);
        $savePicName = md5($uid.time()).".jpg";
        $filename = $save_avatar.$savePicName;
        $size = explode(',',C('qscms_avatar_size'));
        copy($path, $filename);
        foreach ($size as $val) {
            $image->open($path)->thumb($val,$val,3)->save("{$filename}._{$val}x{$val}.jpg");
        }
        M('Members')->where(array('uid'=>$uid))->setfield('avatars',$date.$savePicName);
        @unlink($path);
    }

    /**
     * [save_username 修改帐户名]
     */
    public function save_username(){
        if(IS_POST){
            $user['username']=I('post.username','','trim,badword');
            $passport = $this->_user_server();
            if(false === $uid = $passport->edit(C('visitor.uid'),$user)) $this->ajaxReturn(0,$passport->get_error());
            $this->visitor->update();//刷新会话
            $this->ajaxReturn(1,'用户名修改成功！');
        }else{
            $data['html']=$this->fetch('ajax_modify_uname');
            $this->ajaxReturn(1,'修改用户名弹窗获取成功！',$data);
        }
    }

    /**
     * [save_password 修改密码]
     */
    public function save_password(){
        if(IS_POST){
            $oldpassword=I('post.oldpassword','','trim,badword');
            !$oldpassword && $this->ajaxReturn(0,'请输入原始密码!');
            $password=I('post.password','','trim,badword');
            !$password && $this->ajaxReturn(0,'请输入新密码！');
            if($password != I('post.password1','','trim,badword')) $this->ajaxReturn(0,'两次输入密码不相同，请重新输入！');
            $data['oldpassword'] = $oldpassword;
            $data['password'] = $password;
            $reg = D('Members')->save_password($data,C('visitor'));
            !$reg['state'] && $this->ajaxReturn(0,$reg['error']);
            $this->ajaxReturn(1,'密码修改成功！');
        }else{
            $data['html']=$this->fetch('ajax_modify_pwd');
            $this->ajaxReturn(1,'修改密码弹窗获取成功！',$data);
        }
    }

    /**
     * [user_email 获取邮箱验证弹窗]
     */
    public function user_email(){
        $this->assign('members_info',D('Members')->get_user_one(array('uid'=>C('visitor.uid'))));
        $tpl=$this->fetch('ajax_auth_email');
        $this->ajaxReturn(1,'邮箱验证弹窗获取成功！',$tpl);
    }

    /**
     * [send_code 验证邮箱_发送验证链接]
     */
    public function send_email_varify_url(){
        $email=I('post.email','','trim,badword');
        if(!fieldRegex($email,'email')) $this->ajaxReturn(0,'邮箱格式错误!');
        $user=M('Members')->field('uid,email,email_audit')->where(array('email'=>$email))->find();
        $user && $user['uid'] <> C('visitor.uid') && $this->ajaxReturn(0,'邮箱已经存在,请填写其他邮箱!');
        if($user['email'] && $user['email_audit'] == 1 && $user['email'] == $email) $this->ajaxReturn(0,"你的邮箱 {$email} 已经通过验证！");
        if(session('verify_email.time') && (time()-session('verify_email.time'))<60) $this->ajaxReturn(0,'请60秒后再进行验证！');
        $token = encrypt(C('visitor.uid')).'-'.encrypt($email).'-'.time();
        $url = C('qscms_site_domain').U('Members/varify_email',array('token'=>$token));
        $send_mail['sendto_email']=$email;
        $send_mail['subject']=C('qscms_site_name').'邮件认证';
        $send_mail['body']=C('qscms_site_name').'提醒您：<br>您正在进行邮箱验证，该链接24小时内有效，点击链接完成验证：'.$url;
        if (true === $reg = D('Mailconfig')->send_mail($send_mail)){
            $this->ajaxReturn(1,'验证邮件发送成功！');
        }else{
            $this->ajaxReturn(0,$reg);
        }
    }

    /**
     * 邮箱链接验证
     */
    public function varify_email(){
        $token = I('get.token','','trim');
        $return_url_arr = array('1'=>U('Company/user_security'),'2'=>U('Personal/user_safety'));
        if($token){
            $token = str_replace(C('URL_HTML_SUFFIX'), '', $token);
            $verify = explode("-", $token);
            $uid = decrypt($verify[0]);
            $email = decrypt($verify[1]);
            $time = $verify[2];
            if($time+3600*24>=time()){//24小时内有效
                $userinfo = D('Members')->where(array('uid'=>$uid))->find();
                if(!$userinfo){
                    $this->error('邮箱验证失败!',$return_url_arr[$userinfo['utype']]);
                }
                $setsqlarr['email']=$email;
                $setsqlarr['email_audit']=1;
                if(false === $reg = M('Members')->where(array('uid'=>$uid))->save($setsqlarr)) $this->error('邮箱验证失败!',$return_url_arr[$userinfo['utype']]);
                if(!$reg){
                    $this->success("你的邮箱 {$email} 已经通过验证！",$return_url_arr[$userinfo['utype']]);
                    return;
                }
                $user_visitor = new \Common\qscmslib\user_visitor;
                $user_visitor->logout();
                $user_visitor->assign_info($userinfo);
                D('Members')->update_user_info($setsqlarr,$userinfo);
                if ($userinfo['utype']=="1"){
                    $rule=D('Task')->get_task_cache($userinfo['utype'],23);
                    $r = D('TaskLog')->do_task($userinfo,23);
                }else{
                    $rule=D('Task')->get_task_cache($userinfo['utype'],16);
                    $r = D('TaskLog')->do_task($userinfo,16);
                }
                write_members_log($userinfo,8001);
                if($r['data']){
                    $sub = '增加'.$r['data'].C('qscms_points_byname');
                }else{
                    $sub = ''; 
                }
                $this->success('邮箱验证通过!'.$sub,$return_url_arr[$userinfo['utype']]);
            }else{
                $this->error('该链接已过期',$return_url_arr[$userinfo['utype']]);
            }
        }
        else{
            $this->error('链接无效',$return_url_arr[$userinfo['utype']]);
        }  
    }
    
    /**
     * [user_mobile 获取手机验证弹窗]
     */
    public function user_mobile(){
        $audit = D('Members')->where(array('uid'=>C('visitor.uid')))->getField('mobile_audit');
        $this->assign('audit',$audit);
        $tpl=$this->fetch('ajax_auth_mobile');
        $this->ajaxReturn(1,'手机验证弹窗获取成功！',$tpl);
    }

    /**
     * [send_mobile_code 发送手机验证码]
     */
    public function send_mobile_code(){
        $mobile=I('post.mobile','','trim,badword');
        if(!fieldRegex($mobile,'mobile')) $this->ajaxReturn(0,'手机格式错误!');
        $user=M('Members')->field('uid,mobile,mobile_audit')->where(array('mobile'=>$mobile))->find();
        $user['uid'] && $user['uid']<>C('visitor.uid') && $this->ajaxReturn(0,'手机号已经存在,请填写其他手机号!');
        if($user['mobile'] && $user['mobile_audit'] == 1 && $user['mobile'] == $mobile) $this->ajaxReturn(0,"你的手机号 {$mobile} 已经通过验证！");
        if(session('verify_mobile.time') && (time()-session('verify_mobile.time'))<180) $this->ajaxReturn(0,'请180秒后再进行验证！');
        $rand=mt_rand(100000, 999999);
        $sendSms = array('mobile'=>$mobile,'tpl'=>'set_mobile_verify','data'=>array('rand'=>$rand.'','sitename'=>C('qscms_site_name')));
        if (true === $reg = D('Sms')->sendSms('captcha',$sendSms)){
            session('verify_mobile',array('mobile'=>$mobile,'rand'=>$rand,'time'=>time()));
            $this->ajaxReturn(1,'验证码发送成功！');
        }else{
            $this->ajaxReturn(0,$reg);
        }
    }

    /**
     * [verify_mobile_code 验证手机验证码]
     */
    public function verify_mobile_code(){
        $verifycode=I('post.verifycode',0,'intval');
        $verify = session('verify_mobile');
        if (!$verifycode || !$verify['rand'] || $verifycode<>$verify['rand']) $this->ajaxReturn(0,'验证码错误!');
        $setsqlarr['mobile'] = $verify['mobile'];
        $setsqlarr['mobile_audit']=1;
        $uid=C('visitor.uid');
        if(false === $reg = M('Members')->where(array('uid'=>$uid))->save($setsqlarr)) $this->ajaxReturn(0,'手机验证失败!');
        !$reg && $this->ajaxReturn(0,"你的手机 {$verify['mobile']} 已经通过验证！");
        D('Members')->update_user_info($setsqlarr,C('visitor'));
        if(C('visitor.utype')=='1'){
            $rule=D('Task')->get_task_cache(C('visitor.utype'),22);
            D('TaskLog')->do_task(C('visitor'),22);
        }else{
            $rule=D('Task')->get_task_cache(C('visitor.utype'),7);
            D('TaskLog')->do_task(C('visitor'),7);
        }
        write_members_log(C('visitor'),8002);
        session('verify_mobile',null);
        $this->ajaxReturn(1,'手机验证通过!',array('mobile'=>$verify['mobile'],'points'=>$rule['points']));
    }
    
    /**
     * [sign_in 签到]
     */
    public function sign_in(){
        if(IS_AJAX){
            $reg = D('Members')->sign_in(C('visitor'));
            if($reg['state']){
                write_members_log(C('visitor'),8003);
                $this->ajaxReturn(1,'成功签到！',$reg['points']);
            }else{
                $this->ajaxReturn(0,$reg['error']);
            }
        }
    }

    /**
     * 推荐注册
     */
    public function invitation_reg(){
        $taskid = C('visitor.utype')==1?31:14;
        $task_info = D('Task')->get_task_cache(C('visitor.utype'),$taskid);
        $this->assign('task_info',$task_info);
        $invitation_code = D('Members')->where(array('uid'=>C('visitor.uid')))->getField('invitation_code');
        $invitation_url = C('qscms_site_domain').U('Members/register',array('incode'=>$invitation_code));
        $this->assign('invitation_url',$invitation_url);
        if(C('visitor.utype')==1){
            $css = '../../public/css/company/company_ajax_dialog.css';
        }else{
            $css = '../../public/css/personal/personal_ajax_dialog.css';
        }
        $this->assign('css',$css);
        $html = $this->fetch('ajax_invitation_reg');
        $this->ajaxReturn(1,'获取数据成功！',$html);
    }

    /**
     * 获取注册协议
     */
    public function agreement(){
        $agreement = htmlspecialchars_decode(M('Text')->where(array('name'=>'agreement'))->getField('value'),ENT_QUOTES);
        $this->assign('agreement',$agreement);
        $tpl = $this->fetch('Members/agreement');
        $this->ajaxReturn(1,'获取数据成功！',$tpl);
    }

}
?>
