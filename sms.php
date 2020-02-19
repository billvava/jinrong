<?php
header("Content-Type:text/html;charset=utf-8");
$apikey = "991b2ff293e237e6dd2d18c6295b6c05"; //修改为您的apikey
$mobile = "18774185239"; //请用自己的手机号代替
$text="【黄世杰】您的验证码是123456，如非本人操作，请忽略本短信。";


// 发送短信
$url = 'https://sms.yunpian.com/v2/sms/single_send.json';
$data = array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);

$json_data = curl($url,'POST',$data);
$array = json_decode($json_data,true);
echo '<pre>';print_r($array);

function curl($url,$type='POST',$param = array() ,$header = array()){
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


?>