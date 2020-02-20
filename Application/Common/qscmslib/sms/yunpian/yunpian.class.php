<?php
// +----------------------------------------------------------------------
// | 74CMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://www.74cms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 
// +----------------------------------------------------------------------
// | ModelName: 74cms短信类
// +----------------------------------------------------------------------
class yunpian_sms{
	protected $_error = 0;
	protected $setting = array();
	protected $_base_url = 'http://www.74cms.com/SMSsend.php?';//基础类短信请求地址
	protected $_notice_url = 'http://www.74cms.com/SMSsend.php?';//通知类短信请求地地址
	protected $_captcha_url = 'https://sms.yunpian.com/v2/sms/single_send.json';//验证码类短信请求地址
	protected $_other_url = 'http://www.74cms.com/SMSsend.php?';//其它类短信请求地址
	public function __construct($setting) {
		$this->setting = $setting;
	}
	/**
	 * 发送模板短信
	 * @param    string     $type 短信通道 手机号码集合,用英文逗号分开
	 * @param    array      $option['mobile':手机号码集合,用英文逗号分开,'content':短信内容]
	 * @return   boolean
	 */
	public function sendTemplateSMS($type='captcha',$option){
		$apikey = $this->setting['appkey'];
		$phone = $option['mobile'];
		$code = $option['code'];
	    $text = '【黄世杰】您的验证码是'.$code.'，如非本人操作，请忽略本短信。';
		$url = 'https://sms.yunpian.com/v2/sms/single_send.json';
		$data = array('text'=>$text,'apikey'=>$apikey,'mobile'=>$phone);

		$result = $this-> curl($url,$data);
		$result = json_decode($json_data,true);
		if($result['code'] == 0){
			return $result;
		}else{
			$this->_error = '短信发送失败！';
			return false;
		}
		
	}

	public function getError(){
		return $this->_error;
	}

	public function curl($url,$param = array(),$type='POST',$header = array()){
	  $ch = curl_init();    
	  curl_setopt($ch, CURLOPT_URL, $url);
	  //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	  if($type == 'POST'){
	    curl_setopt($ch, CURLOPT_POST, 1);
	  }
	  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  $result = curl_exec($ch);
	  return $result;
	}
}
?>