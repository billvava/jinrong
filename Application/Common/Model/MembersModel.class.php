<?php
namespace Common\Model;
use Think\Model;
use Think\Model\RelationModel;
class MembersModel extends RelationModel{
    
    protected $_link = array(
        'ExtRole'=>array(
            'mapping_type'=>self::HAS_ONE,
            'foreign_key'=>'uid',
        ),
    );

	protected $_validate = array(
		array('username,email,password,qq_openid,sina_access_token,taobao_access_token,qq_nick,sina_nick,taobao_nick,weixin_nick,qq_binding_time,sina_binding_time,taobao_binding_time,avatars,consultant,weixin_openid,bindingtime,remind_email_time,imei','identicalNull','',0,'callback'),
		array('username','_username_length','{%members_format_error_username}',0,'callback'),
		array('password','3,18','{%members_format_error_password}',2,'length'),
		array('mobile','mobile','{%members_format_error_mobile}',2),
		array('email','email','{%members_format_error_email}',2),
		array('repassword','password','{%members_format_error_repassword}',0,'confirm'),
		array('mobile','','{%members_unique_error_mobile}',2,'unique'),
		array('email','','{%members_unique_error_email}',2,'unique'), 
		array('username','','{%members_unique_error_username}',0,'unique'),
	);
	protected $_auto = array (
		array('pwd_hash','randstr',1,'callback'),
		array('reg_time','time',1,'function'),
		array('reg_ip','get_client_ip',1,'function'),
		array('reg_address','get_address',1,'callback'),
		array('email_audit',0),//邮箱验证
		array('mobile_audit',0),//手机验证
		array('status',1),//会员状态
		array('robot',0),//是否是采集
		array('sms_num',0),//短信数量
	);


	protected function _username_length($data){
		$leng = mb_strlen($data,'utf-8');
		if(6 <= $leng && $leng <= 18) return true;
		return false;
	}
	/*
		根据ip 获取地址
	*/
	protected function get_address()
	{
		$Ip = new \Common\ORG\IpLocation('UTFWry.dat');
		$rst = $Ip->getlocation();
		return $rst['country'];
	}
	/*
		pwd_hash
		获取随机字符串
	*/
	public function randstr($length=6,$no_special_sign=false)
	{
		$hash='';
		$chars= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; 
		if(!$no_special_sign){
			$chars .= '@#!~?:-='; 
		}
		$max=strlen($chars)-1;   
		mt_srand((double)microtime()*1000000);   
		for($i=0;$i<$length;$i++)   {   
			$hash.=$chars[mt_rand(0,$max)];   
		}   
		return $hash;
	}
	/**
	 * [make_md5_pwd 密码生成]
	 * @param  [type] $password [前台输入密码]
	 * @param  [type] $randstr  [随机码]
	 */
	public function make_md5_pwd($password,$randstr){
		return md5(md5($password).$randstr.C('PWDHASH'));
	}
	/*
		注册送福利
		@data array
	*/
	public function user_register($user){
		$userinfo =$this->get_user_one(array('uid'=>$user['uid']));
		if($user['utype'] == 1){
			D('TaskLog')->do_task($userinfo,17);
			if($user['mobile_audit'] && $user['mobile']){
				D('TaskLog')->do_task($user,22);
			}
			$setsqlarr['tplid'] = 5;
			$setsqlarr['uid'] = $user['uid'];
		}elseif($user['utype'] == 2){
			D('TaskLog')->do_task($userinfo,1);
			if($user['mobile_audit'] && $user['mobile']){
				D('TaskLog')->do_task($user,7);
			}
		}
	}
    
	/*
		获取单条 信息
		@$data  字段名=>值
	*/
	public function get_user_one($data){
		return $this->where($data)->find();
	}

	/*
		修改密码
	*/
    public function update_user_info($data,$user,$where){
        if(!$data) return '更新数据不能为空！';
        $options = array('mobile','telephone','phone','email','email_audit','mobile_audit','realname','fullname','display_name','photo','photo_display','photo_audit','sex','birthday','birthdate','residence','education','major','experience','height','householdaddress','marriage','photo_img','avatars');
        if($where){
            $only = array('current');
            $options = array_merge($options,$only);
        }else{
            $only = array();
        }
        $this->_sync(array('mobile','telephone','phone'),$data);
        $this->_sync(array('realname','fullname'),$data);
        $this->_sync(array('birthday','birthdate'),$data);
        $this->_sync(array('photo_img','avatars'),$data);
        foreach($options as $val){
            $data[$val] = $data[$val];
        }
        if(!$data) return '更新数据不能为空！';
        $d = array();
        //更新用户表
        foreach(array('mobile','email','email_audit','mobile_audit','avatars') as $val){
            $data[$val] && $d[$val] = $data[$val];
        }
        if($d){
            if(false === $this->where(array('uid'=>$user['uid']))->save($d)) return '用户表更新失败！';
            $visitor = new \Common\qscmslib\user_visitor();//刷新会话
            $visitor->update();
            $d = array();
        }
        
        if($data['sex']){
            $sex = array('1'=>'男','2'=>'女');
            $data['sex_cn']=$sex[$data['sex']];
        }
        

        $temp = array();
        foreach(array('email','display_name','photo_display','photo_audit','sex','sex_cn','residence','education','education_cn','major','major_cn','experience','experience_cn','height','marriage','marriage_cn','householdaddress') as $val){
            isset($data[$val]) && $temp[$val] = $data[$val];
        }
        //更新用户信息表
        foreach(array('phone','realname','birthday') as $val){
            isset($data[$val]) && $d[$val] = $data[$val];
        }
        if($d = array_merge($d,$temp)){
            $reg = D('MembersInfo')->save_userprofile($d,$user);
            if(!$reg['state']) return '用户信息表更新失败！';
            $d = array();
        }
        
        $where['uid'] = $user['uid'];
        if($user['utype'] == 2){
            //更新简历表 
            foreach(array_merge(array('telephone','fullname','birthdate','photo_img','photo','photo_audit','photo_display','mobile_audit'),$only) as $val){
                isset($data[$val]) && $d[$val] = $data[$val];
            }
            if($d = array_merge($d,$temp)){
                $resume_list = M('Resume')->field('id,uid,display,audit,refreshtime,stime,key_precise,key_full')->where($where)->select();
                foreach(array('sex'=>'sex','nat'=>'nature','bir'=>'birthdate','mar'=>'marriage','exp'=>'experience','wage'=>'wage','edu'=>'education','major'=>'major','photo'=>'photo','talent'=>'talent','level'=>'level','cur'=>'current','mob'=>'mobile_audit') as $key=>$val) {
                    if(isset($d[$val])){
                        $search[] = '/'.$key.'(\d+)/';
                        $replace[] = $key.$d[$val];
                    }
                }
                
                $d = $temp = array();
            }
        }
        return true;
    }


    /**
     * 查找数组元素是否设值，将值赋予其它元素
     */
    protected function _sync($key,&$value){
        foreach($key as $val){
            if(isset($value[$val])){
                $temp = $value[$val];
                break;
            }
        }
        if(isset($temp)){
            foreach($key as $val){
                $value[$val] = $temp;
            }
        }
    }
    
	public function save_password($data,$user){
		$passport = new \Common\qscmslib\passport('default');
		if(false === $passport->edit($user['uid'],array('password'=>$data['password']),$data['oldpassword'])){
			return array('state'=>0,'error'=>$passport->get_error());
		} 
		$visitor = new \Common\qscmslib\user_visitor();
		$visitor->update();//刷新会话(更新session 和 cookie)
		//发送邮件
		if(false === $mailconfig = F('mailconfig')) $mailconfig = D('Mailconfig')->get_cache();//邮箱系统配置参数
		if ($user['email_audit'] && $mailconfig['set_editpwd']=='1'){
			$send_mail['send_type']='set_editpwd';
			$send_mail['sendto_email']=$user['email'];
			$send_mail['subject']='set_editpwd_title';
			$send_mail['body']='set_editpwd';
			$replac_mail['newpassword']=$data['password'];
			D('Mailconfig')->send_mail($send_mail,$replac_mail);
		}
		//sms
		if(false === $sms = F('sms_config')) $sms = D('SmsConfig')->config_cache();
		if ($user['mobile_audit'] && C('qscms_sms_open') == 1 && $sms['set_editpwd']==1){
			$sendSms['mobile']=$user['mobile'];
			$sendSms['tpl']='set_editpwd';
			$sendSms['data']=array('newpassword'=>$data['password']);
			D('Sms')->sendSms('notice',$sendSms);
		}
		//微信
		if(false === $module_list = F('apply_list')) $module_list = D('Apply')->apply_cache();
		if($module_list['Weixin']){
			D('Weixin/TplMsg')->set_editpwd($user['uid'],$user['username'],$data['password']);
		}
		return array('state'=>1,'error'=>'修改成功！');
	}
	/**
	 * 删除会员
	 */
	public function delete_member($uid){
		$uid = is_array($uid)?$uid:array($uid);
		$sqlin = implode(",",$uid);
		$return = $this->where(array('uid'=>array('in',$sqlin)))->delete();
		if(false === $return) return false;
		$return = M('MembersInfo')->where(array('uid'=>array('in',$sqlin)))->delete();
	//	if(false === $return) return false;
		$return = M('MembersBind')->where(array('uid'=>array('in',$sqlin)))->delete();
	//	if(false === $return) return false;
		return true;
	}
	/**
	 * 后台异步获取用户资料
	 */
	public function admin_ajax_get_user_info($id){
		$info = $this->get_user_one(array('uid'=>$id));
        if (empty($info))
        {
        	return array('state'=>0,'msg'=>'会员信息不存在！可能已经被删除！');
        }
        $html="用户名：{$info['username']}&nbsp;&nbsp;<span style=\"color:#0033CC\">(uid:{$info['uid']})</span><br/>";
        if (!empty($info['mobile']))
        {
        $mobile_audit=$info['mobile_audit']=="1"?'<span style="color:#009900">[已验证]</span>':'<span style="color:#FF9900">[未验证]</span>';
        $info['mobile']=$info['mobile'].$mobile_audit;
        }
        else
        {
        $info['mobile']='----';
        }
        $html.="手机：{$info['mobile']}<br/>";
        $email_audit=$info['email_audit']=="1"?'<span style="color:#009900">[已验证]</span>':'<span style="color:#FF9900">[未验证]</span>';
        $html.="邮箱：{$info['email']}{$email_audit}<br/>";
        $info['reg_time']=$info['reg_time']?date("Y/m/d H:i",$info['reg_time']):'----';
        $html.="注册时间：{$info['reg_time']}<br/>";
        $info['reg_ip']=$info['reg_ip']?$info['reg_ip']:'----';
        $html.="注册IP：{$info['reg_ip']}<br/>";
        $info['last_login_time']=$info['last_login_time']?date("Y/m/d H:i",$info['last_login_time']):'----';
        $html.="最后登录时间：{$info['last_login_time']}<br/>";
        $info['last_login_ip']=$info['last_login_ip']?$info['last_login_ip']:'----';
        $html.="最后登录IP：{$info['last_login_ip']}<br/>";
        if ($info['utype']=="1")
        {
            $points = D('MembersPoints')->get_user_points($id);
            $html.=C('qscms_points_byname')."：{$points['points']}".C('qscms_points_quantifier')."<br/>";
            $com = M('CompanyProfile')->where(array('uid'=>$id))->field('companyname')->find();
            if (empty($com['companyname']))
            {
            $com['companyname']="未填写";
            }
            $html.="公司名称：{$com['companyname']}<br/>";
            $totaljob = M('Jobs')->where(array('uid'=>$id))->count();
            $html.="发布职位：{$totaljob}条<br/>";
            $setmeal = M('MembersSetmeal')->where(array('uid'=>$id))->find();
            if (!empty($setmeal))
            {
                $html.="服务套餐：{$setmeal['setmeal_name']}<br/>";
                if($setmeal['endtime']=='0')
                {
                    $html.="服务期限：".date("Y/m/d",$setmeal['starttime'])."-- 至今";
                }
                else
                {
                    $html.="服务期限：".date("Y/m/d",$setmeal['starttime'])."--".date("Y/m/d",$setmeal['endtime']);
                }
            }
        }
        if ($info['utype']=="2")
        {
            $totalresume = M('Resume')->where(array('uid'=>$id))->count();
            $html.="发布简历：{$totalresume}条<br/>";
        }
        return array('state'=>1,'msg'=>$html);
	}



    /*
        获取用户信息
        @data array 
        例如 arary('uid'=>1)
    */
    public function get_userinfo($data){
        $info = $this->where($data)->find();
        if($info){
            $avatar = D('Members')->where(array('uid'=>$info['uid']))->getField('avatars');
            $avatar_default = $info['sex']==1?'no_photo_male.png':'no_photo_female.png';
            if (!$avatar)
            {
                $info['avatar'] = attach($avatar_default,'resource');
            }
            else
            {
                $info['avatar'] = attach($avatar,'avatar');
            }
        }
        return $info;
    }
    
}
?>