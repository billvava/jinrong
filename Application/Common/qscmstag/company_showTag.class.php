<?php
/**
 * 企业详情
 */
namespace Common\qscmstag;
defined('THINK_PATH') or exit();
class company_showTag {
	protected $params = array();
	protected $map = array();
    function __construct($options) {
    	$array = array(
    		'列表名'			=>	'listname',
    		'企业id'			=>	'id'
    	);
    	foreach ($options as $key => $value) {
    		$this->params[$array[$key]] = $value;
    	}

        $this->map['user_status'] = array('eq',1);
        $this->map['id'] = array('eq',intval($this->params['id']));
    	$this->params['listname']=isset($this->params['listname'])?$this->params['listname']:"info";
    }
    public function run(){
        $profile = M('CompanyProfile')->where($this->map)->find();
        if(!$profile){
            $controller = new \Common\Controller\BaseController;
            $controller->_empty();
        }
        if(C('SUBSITE_TYPE')) check_url($profile['subsite_id']);
        $profile['company_url']=url_rewrite('QS_companyshow',array('id'=>$profile['id']));
        $profile['company_profile']=htmlspecialchars_decode($profile['contents'],ENT_QUOTES);

        if ($profile['logo'])
        {
            $profile['logo']=attach($profile['logo'],'company_logo');
        }
        else
        {
            $profile['logo']=attach('no_logo.png','resource');
        }
        //简历处理率
        $apply = M('PersonalJobsApply')->where(array('company_uid'=>$profile['uid'],'addtime'=>array('gt',strtotime("-14day"))))->select();
        foreach ($apply as $key => $val) {
            if($val['is_reply']){
                $reply++;
                $val['reply_time'] && $reply_time += $val['reply_time'] - $val['apply_addtime'];
            }
        }
        $profile['reply_ratio'] = !$apply ? 100 : intval($reply / count($apply) * 100);
        $profile['reply_time'] = !$reply_time ? '0天' : sub_day(intval($reply_time / count($apply)),0);
        $last_login_time = M('Members')->where(array('uid'=>$profile['uid']))->getfield('last_login_time');
        $profile['last_login_time'] = $last_login_time ? fdate($last_login_time) : '未登录';
        $jobs_count_map['uid'] = $profile['uid'];
        if(C('qscms_jobs_display')==1){
            $jobs_count_map['audit'] = 1;
        }
        $profile['jobs_count'] = D('Jobs')->where($jobs_count_map)->count();
        $profile['fans'] = D('PersonalFocusCompany')->where(array('company_id'=>$profile['id']))->count();
        $profile['preview'] = C('visitor.uid')==$profile['uid']?1:0;
        $img_map['uid'] = $profile['uid'];
        if(C('qscms_companyimg_display')==1){
            $img_map['audit'] = 1;
        }else{
            $img_map['audit'] = array(array('eq',1),array('eq',2),'or');
        }
        $profile['img'] = D('CompanyImg')->where($img_map)->select();
        
        foreach ($profile['img'] as $key => $value) {
            $profile['img'][$key]['img'] = attach($value['img'],'company_img');
        }
        $tag = $profile['tag'];
        $profile['tag_arr'] = array();
        if($tag){
            $tag_arr = explode(",", $tag);
            foreach ($tag_arr as $key => $value) {
                $arr = explode("|", $value);
                $profile['tag_arr'][] = $arr[1];
            }
        }
        if($profile['website']){
            $profile['website_'] = $profile['website'];
            if(strstr($profile['website'],"http://")===false){
                $profile['website'] = "http://".$profile['website'];
            }else{
                $profile['website_'] = str_replace("http://", "", $profile['website_']);
            }
        }
        $hide = true;
        if(C('qscms_showjobcontact') == 0)
        {
            $hide = false;
        }
        elseif(C('qscms_showjobcontact') == 1)
        {
            if(C('visitor')){
                $hide = false;
            }
        }
        else
        {
            if(C('visitor.utype') == 2)
            {
                $has_resume = M('Resume')->where(array('uid'=>C('visitor.uid')))->order('def desc,id asc')->find();
                if($has_resume) $hide = false;
            }
        }
        
        // if(C('visitor.utype') == 2){
        //     $has_resume = M('Resume')->where(array('uid'=>C('visitor.uid')))->order('def desc,id asc')->find();
        //     if(C('qscms_showjobcontact') == 2 && !$has_resume) $hide = true;
        // }else{
        //     if(C('visitor.uid')){
        //         C('visitor.uid') != $profile['uid'] && $hide = true;
        //     }else{
        //         if(C('qscms_showjobcontact') == 1 || C('qscms_showjobcontact') == 2) $hide = true;
        //     }
        // }
        $profile['landline_tel'] = trim($profile['landline_tel'],'-');
        $hide && $profile['telephone'] = contact_hide($profile['telephone'],2);
        $hide && $profile['landline_tel'] = contact_hide($profile['landline_tel'],1);
        $hide && $profile['email'] = contact_hide($profile['email'],3);
        $profile['contact_show']==0 && $profile['contact'] = '企业设置不公开';
        $profile['telephone_show']==0 && $profile['telephone'] = '企业设置不公开';
        $profile['email_show']==0 && $profile['email'] = '企业设置不公开';
        $profile['landline_tel_show']==0 && $profile['landline_tel'] = '企业设置不公开';
        $profile['focus'] = 0;
        if(C('visitor.uid')){
            $focus = D('PersonalFocusCompany')->check_focus($profile['id'],C('visitor.uid'));
            if($focus){
                $profile['focus'] = 1;
            }
        }
        $profile['hide'] = $hide;
        // if(C('qscms_contact_img_com') == 2){
        //     $profile['telephone_img'] = $v;
        //     Image::BuildImageVerify($config,'captcha');
        // }
        $setmeal = D('MembersSetmeal')->get_user_setmeal($profile['uid']);
        $profile['setmeal_id'] = $setmeal['setmeal_id'];
        $profile['setmeal_name'] = $setmeal['setmeal_name'];
        return $profile;
    }
}