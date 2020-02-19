<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class CompanyController extends FrontendController{
    
    protected function _global_variable() {
    	C('visitor.utype') !=1 && $this->redirect('members/login');
		// 帐号状态 为暂停
		if (C('visitor.status') == 2 && !in_array(ACTION_NAME, array('index'))){
			$this->error('您的账号处于暂停状态，请联系管理员设为正常后进行操作！',U('Company/index'));
		}
		// 短信必须验证
		if (C('qscms_sms_open')==1 && C('qscms_login_com_audit_mobile')==1 && C('visitor.mobile_audit') == 0 && !in_array(ACTION_NAME, array('user_security'))){
			$this->error('您的手机未认证，认证后才能进行其他操作！',U('Company/user_security'));
		}
        $this->_cominfo_flge();
        // 强制认证营业执照
        if (C('qscms_login_com_audit_certificate')==1 && $this->company_profile['audit'] !=1 && !in_array(ACTION_NAME, array('user_security','com_auth','com_info'))){
            $this->error('您的营业执照未认证，认证后才能进行其他操作！',U('Company/com_auth'));
        }
        $this->assign('company_profile',$this->company_profile);
        $this->assign('cominfo_flge',$this->cominfo_flge);
        // 第一次登录
        if(!S('personal_login_first_'.C('visitor.uid'))){
            S('personal_login_first_'.C('visitor.uid'),1,86400-(time()-strtotime("today")));
            //快到期提醒
            $my_setmeal = D('MembersSetmeal')->get_user_setmeal(C('visitor.uid'));
            if($my_setmeal['endtime']>0){
                if(C('qscms_meal_min_remind')==0){
                    $confirm_setmeal = 0;
                }else{
                    if($my_setmeal['endtime'] - time()>C('qscms_meal_min_remind')){
                        $confirm_setmeal = 0;
                    }else{
                        $confirm_setmeal = 1;
                    }
                }
                $this->assign('confirm_setmeal',$confirm_setmeal);
            }
        }
		$this->assign('company_nav',ACTION_NAME);
    }


    public function show($company_id=''){
        $uid = $company_id;
        if(empty($uid)){
            $this->error('参数不能为空！');
        }else{
            $user_info = M('Members')->where(['uid'=>$uid])->find();
            if(empty($user_info)){
                $user_info = M('Members')->where(['uid'=>$uid])->find();
                $province = array_flip(F('province'));
                $city = array_flip(F('city'));
                $area = array_flip(F('area'));
               if($user_info['province_id']){
                    $user_info['province'] = $province[$user_info['province_id']];
               }
               if($user_info['city_id']){
                    $user_info['city'] = $city[$user_info['city_id']];
               }
               if($user_info['area_id']){
                    $user_info['area'] = $area[$user_info['area_id']];
               }
            }
        }
        $user_info['user_area'] = $user_info['province'].$user_info['city'].$user_info['area'];
        $this->assign('user_info',$user_info);
        $this->display();
    }

    
    /**
     * [authenticate 帐号安全]
     */
    public function user_security(){
    	$uid=C('visitor.uid');
        $user_bind = M('MembersBind')->where(array('uid'=>$uid))->limit('10')->getfield('type,keyid,info');
        foreach($user_bind as $key=>$val){
        	$user_bind[$key] = unserialize($val['info']);
        }
        if(false === $oauth_list = F('oauth_list')){
            $oauth_list = D('Oauth')->oauth_cache();
        }
        $this->assign('members_info',D('Members')->get_user_one(array('uid'=>$uid)));
        $this->assign('user_bind',$user_bind);
        $this->assign('oauth_list',$oauth_list);
		$this->assign('company_nav','com_info');
        $this->_config_seo(array('title'=>'账号安全 - 企业会员中心 - '.C('qscms_site_name')));
    	$this->display();
    }
    

	/**
	 * 投诉客服
	 */
	public function complaint_consultant(){
		$consultant = M('Consultant')->where(array('id'=>C('visitor.consultant')))->find();
		if(IS_POST){
			$data['uid'] = C('visitor.uid');
			$data['username'] = C('visitor.username');
			$data['consultant_id'] = $consultant['id'];
			$data['consultant_name'] = $consultant['name'];
			$data['notes'] = I('post.notes','','trim');
			if(!$data['notes']){
				$this->ajaxReturn(0,'请填写投诉说明');
			}
            if($this->apply['Subsite']){
                $data['subsite_id'] = $consultant['subsite_id'];
            }
			$data['addtime'] = time();
            $data['audit'] = 1;
			$r = M('ConsultantComplaint')->add($data);
			if($r){
				$this->ajaxReturn(1,'投诉成功！管理员将尽快核实！');
			}else{
				$this->ajaxReturn(0,'投诉失败');
			}
		}
		$this->assign('consultant',$consultant);
		$html = $this->fetch('Company/ajax_tpl/ajax_complaint_consultant');
		$this->ajaxReturn(1,'获取数据成功',$html);
	}
    

}
?>