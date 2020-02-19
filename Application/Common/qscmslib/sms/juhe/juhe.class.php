<?php

class juhe_sms{
	protected $_error = 0;
	protected $setting = array('appkey'=>'');
	protected $_base_url = 'http://v.juhe.cn/sms/send?';//基础类短信请求地址
	protected $_notice_url = 'http://v.juhe.cn/sms/send?';//通知类短信请求地地址
	protected $_captcha_url = 'http://v.juhe.cn/sms/send?';//验证码类短信请求地址
	protected $_other_url = 'http://v.juhe.cn/sms/send?';//其它类短信请求地址
	public function __construct($setting) {
		$this->setting = $setting;
	}

	/**
	 * 发送模板短信
	 * @param    string     $type 短信通道 手机号码集合,用英文逗号分开
	 * @param    array      $option['mobile':手机号码集合,用英文逗号分开,'content':短信内容]
	 * @return   boolean
	 */
	/**
	 * 发送模板短信
	 * @param    string     $type 短信通道 手机号码集合,用英文逗号分开
	 * @param    array      $option['mobile':手机号码集合,用英文逗号分开,'content':短信内容]
	 * @return   boolean
	 */
	public function sendTemplateSMS($type='captcha',$option){
		$key = $this->setting['appkey'];
        //解析模板内容
		if($option['data']){
			foreach ($option['data'] as $k => $val){
                $first_key = key($option['data']);
				if($k == $first_key){
                    $data['tpl_value=#'.$k.'#'] = $val;
                }else{
                    $data['#'.$k.'#'] = $val;
                }
            }
			$tpl_id = strtr($option['tplId'],$data);
        }else{
            $tpl_id = $option['tplId'];
        }
        //转换编码
        foreach ($data as $k => $val) {
			$data[$k] = $val;
		}
        $key = 'key='.$key.'&';
        $tpl_id = '&tpl_id='.$tpl_id;
        $data= http_build_query($data);
        $data = urlencode(urldecode($data));
		$name = '_'.$type.'_url';
		$url = $this->$name.$key.$data.$tpl_id;
        $url=preg_replace('/%3D/','=',$url,1);
		//遍历发送
        $mobile = explode(',',$option['mobile']);
        foreach ($mobile as $key => $val) {
        	if(false === $this->_https_request($url.'&mobile='.$val)) return false;
        }
		return true;
	}
	
	protected function _https_request($url,$data = null){
		if(function_exists('curl_init')){
			$curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
			curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		    curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		    if (!empty($data)){
		        curl_setopt($curl, CURLOPT_POST, 1);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		    }
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    $output = curl_exec($curl);
		    curl_close($curl);
		    return $output;
		}else{
			$this->_error = '短信发送失败，请开启curl服务！';
			return false;
		}
	}
	public function getError(){
		return $this->_error;
	}
}
?>