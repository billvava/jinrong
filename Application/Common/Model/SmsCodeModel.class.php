<?php
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
namespace Common\Model;
use Think\Model;

class SmsCodeModel extends Model{
	private $deadline = 300;	//验证码失效时间
	private $ip_count = 5; 	//同ip发送短信次数限制
	private $day_count = 5;

	/**
	 * 发送短信
	 * @param $phone 发送到的电话号码	 
	 * @param $type 短信类型 0普通验证码 1注册 2忘记密码 3提现密码
	 * @param $code 制定验证码 不制定则自动生成
	 */
	public function sendSMS($phone,$type = 'reg'){
		if(!preg_match("/^1[345789]\d{9}$/", $phone)){
			$data['code'] = 1;
			$data['msg'] = '手机号码不正确';
			return $data;
		}

		//验证码检查，不重复发送
		$result = $this -> sendCheck($phone,$type);
		if($result['success'] == false){
			$data['success'] = false;
			$data['msg'] = $result['msg'];
			return $data;
		}

	
		$code = rand(100000,999999);
		
		//调用发送短信方法 
    $result  = $this -> sendHuiYiSms($phone,$code);
    if ($result['code'] != 0){
        $data['success'] = false;
        $data['msg'] = $result['msg'];
        return $data;
    }
    $send_result = true;
		
		
		//发送记录
		$this -> sendLog($phone,$code,$type);
		
		if(!$send_result){
			$data['success'] = false;
			$data['msg'] = '短信发送失败';
			return $data;			
		}

		$data['success'] = true;
		$data['msg'] = '短信发送成功';
		return $data;
	}


	//验证短信验证码
	public function verify($phone,$code,$type = 'reg'){
		$start_time = strtotime(date("Y-m-d"));
		$end_time = strtotime(date('Y-m-d', strtotime('+1 day')));

		$map['phone'] = $phone;
		$map['type'] = $type;
		$map['state'] = 0;
		// $map['time']  = array('EGT',$start_time);
		// $map['time']  = array('ELT',$end_time);
		$map['time']  = array('between',array($start_time,$end_time));
		$log = $this -> where($map) -> order('time desc') -> find();
		
		if(!$log || $log['time'] < time() - $this -> deadline || $log['code'] != $code){
			
			return false;
		}
		
		// $this -> where($map) -> order('time desc') -> update(['state'=>'1']);

		return true;
	}

	/*
	 * 发送记录
	 */
	private function sendLog($phone,$code,$type){
	
		$sms_data['phone'] = $phone;
		$sms_data['state'] = 0;
		$sms_data['type'] = $type;
		$sms_data['code'] = $code;

		$sms_data['time'] = time();
		$sms_data['ip'] =  $_SERVER['REMOTE_ADDR'];
		$sms_data['app_status'] = 'development';

		$this -> data($sms_data) -> add();
	}

	/*
	 * 发送验证，检查是否还有有效验证码
	 */
	private function sendCheck($phone,$type){		
		$start_time = strtotime(date("Y-m-d"));
		$end_time = strtotime(date('Y-m-d', strtotime('+1 day')));
		$ip =  $_SERVER['REMOTE_ADDR'];;		

		//同ip发送验证码次数查询
		$ip_count_map['ip'] = array('eq',$ip);
		
		// $ip_count_map['time']  = array('EGT',$start_time);
		$ip_count_map['time']  = array('between',array($start_time,$end_time));

		$ip_count = $this -> where($ip_count_map) -> count();

		
		
		//有效验证码查询
		$map['phone'] = array('eq',$phone);
		$map['state'] = array('eq',0);
		$map[] = array('time','between time',[$start_time,$end_time]);
    
		$log = $this -> where($map) -> order('time desc') -> find();
		$count = $this -> where($map) -> order('time desc') -> count();

		if($count == 0){
			$data['success'] = true;		
			return $data;	
		}
		if($count >= $this -> day_count){
			$data['success'] = false;
			$data['msg'] = '您的验证码发送次数过多，请明天再尝试';
			return $data;			
		}		
		if($log['time'] > time() - $this -> deadline){
			$data['success'] = false;
			$data['msg'] = '验证码仍然有效，请勿重复获取';
			return $data;			
		}

		return $data;
	}

	/**
	 * 发送短信
	 */
	public function sendHuiYiSms($phone,$code){
		// 发送短信
		$apikey = '991b2ff293e237e6dd2d18c6295b6c05';
		$text = '【黄世杰】您的验证码是'.$code.'，如非本人操作，请忽略本短信。';
		$url = 'https://sms.yunpian.com/v2/sms/single_send.json';
		$data = array('text'=>$text,'apikey'=>$apikey,'mobile'=>$phone);

		$json_data = $this -> curl($url,'POST',$data);
		$result = json_decode($json_data,true);
		return $result;
		
	}

	public function curl($url,$type='POST',$param = array() ,$header = array()){
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