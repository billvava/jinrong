<?php
namespace Common\Model;
use Think\Model;
class SmsModel extends Model{

	protected $_validate = array(
		//配置参数不为空验证
		array('config','config_sub','',1,'callback'),
		//短信服务商名称长度验证
		array('name','1,60','{%sms_name_length_error}',1,'length'),
		//别名长度验证
		array('alias','1,40','{%sms_alias_length_error}',1,'length'),
	);

	protected $_auto = array (
		array('config','serialize',3,'function'), //配置参数序列化
		array('create_time','time',1,'function'), //添加时间
		array('update_time','time',3,'function'), //修改时间
		array('status',1), //状态
	);

	protected function config_sub($data){
		if($data['appkey'] == '') return 'sms_null_error_appkey';
		return true;
	}

	/**
	 * [sms_tpl_cache 短信配置参数缓存生成]
	 * @return [array]
	 */
	public function sms_cache(){
		$smsList = $this->where(array('status'=>1))->order('ordid desc,id')->getfield('alias,id,name,filing,config');
		F('sms_list',$smsList);
		return $smsList;
	}

	/**
	 * [sms_replace_cache 不同服务商模板解析]
	 * @return [type] [description]
	 */
	public function sms_replace_cache(){
		$sms_replace = $this->getfield('id,replace,filing');
		F('sms_replace',$sms_replace);
		return $sms_replace;
	}
	
	/**
	 * [sms_tpl_cache 短信发送接口]
	 * @param  [string]   $type      短信通道['captcha'：验证码,'notice'：通知,'other'：其它]
	 * @return [array]    $option    ['mobile':手机号码,'tpl':系统模板名称,'data'：系统模板所需数据,'tplStr'：自定义模板内容]
	 * @return [boolean/string]
	 */

	public function sendSms($type='',$option){
		if(!C('qscms_sms_open')) return L('sms_open_error');
		$service = C('qscms_sms_'.$type.'_service');
		$sms = new \Common\qscmslib\sms($service);
		
		if($option['tpl']){
			if(false === $sms_list = F('sms_list')){
				$sms_list = D('Sms')->sms_cache();
			}
			if(!$sms_list[$service]) return L('sms_service_failed');
			if(false === $sms_tpl = F('oauth_tpl/tpl_'.$service)){
				$sms_tpl = D('SmsOauth')->oauth_tpl_cache($service);
			}
			$tpl_value = '';
			$tplId = $sms_tpl[$option['tpl']]['tpl_id'];
		}else{
			$tpl = $option['tplStr'];
		}
		$data = array('mobile'=>$option['mobile'],'tpl_value'=>$tpl_value,'tplId'=>$tplId,'data'=>$option['data']);
		
		if(false === $sms->sendTemplateSMS($type,$data)){
			return  $sms->getError();
		}
		return true;
	}


	public function sendSms2($type='',$option){
		if(!C('qscms_sms_open')) return L('sms_open_error');
		$service = C('qscms_sms_'.$type.'_service');
		$sms = new \Common\qscmslib\sms($service);
		if($option['tpl']){
			if(false === $sms_list = F('sms_list')){
				$sms_list = D('Sms')->sms_cache();
			}
			if(!$sms_list[$service]) return L('sms_service_failed');
			if(false === $sms_tpl = F('oauth_tpl/tpl_'.$service)){
				$sms_tpl = D('SmsOauth')->oauth_tpl_cache($service);
			}
			$tpl_value = '';
			$tplId = $sms_tpl[$option['tpl']]['tpl_id'];
		}else{
			$tpl = $option['tplStr'];
		}
		$data = array('mobile'=>$option['mobile'],'tpl_value'=>$tpl_value,'tplId'=>$tplId,'data'=>$option['data']);

		if(false === $sms->sendTemplateSMS2($type,$data)){
			return  $sms->getError();
		}
		return true;
	}

	/**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('sms_list', NULL);
        F('sms_replace',NULL);
    }
    /**
     * 后台有删除也删除缓存
     */
    protected function _after_delete($data,$options){
        F('sms_list', NULL);
        F('sms_replace',NULL);
    }
}
?>