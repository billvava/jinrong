<?php
namespace Api\Controller;
header('Content-type:text');
define("TOKEN", "7ronghui");
class MessageController{

    public function login(){
        $code = I('get.code','');
        $appid='wxd5283a13ae3824c5';
        $secret="b7ca9d85a83e6117edc9c54db47bb021";
        $api = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret=$secret&js_code={$code}&grant_type=authorization_code";
        $str = $this->vget($api);
        $arr = json_decode($str,true);
        $openid = $arr['openid'];
        $session_key = $arr['session_key'];
        $signature = $_GET['signature'];
        $signature2 = sha1($_GET['rawData'].$session_key);
        //记住不应该用TP中的I方法，会过滤掉必要的数据
        if ($signature != $signature2) {
            echo '数据签名验证失败！';die;
        }
        //开发者如需要获取敏感数据，需要对接口返回的加密数据( encryptedData )进行对称解密
        //加载解密文件，在官方有下载
        $iv = $_GET['iv'];
        $encryptedData = $_GET['encryptedData'];
        $wx = new \Common\ORG\WXBizDataCrypt();
        $wx->WXBizDataCrypt($appid,$session_key);
        $errCode = $wx->decryptData($encryptedData,$iv,$data);
        if ($errCode == 0) {
            print($data . "\n");
        } else {
            print($errCode . "\n");
            die;
        }



        //生成第三方3rd_session
        $session3rd  = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;
        for($i=0;$i<16;$i++){
            $session3rd .=$strPol[rand(0,$max)];
        }
        echo $session3rd;
        exit;
    }


    public function check_server(){     
    //校验服务器地址URL
        if (isset($_GET['echostr'])) {
            $this->valid();
        }else{
            $this->responseMsg();
        }
    }

    public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            header('content-type:text');
            echo $echoStr;
            exit;
        }else{
            echo $echoStr.'+++'.TOKEN;
            exit;
        }
    }

    private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr) && is_string($postStr)){
            //禁止引用外部xml实体
            //libxml_disable_entity_loader(true);
            //$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $postArr = json_decode($postStr,true);
            if(!empty($postArr['MsgType']) && $postArr['MsgType'] == 'text'){   //文本消息
                $fromUsername = $postArr['FromUserName'];   //发送者openid
                $toUserName = $postArr['ToUserName'];       //小程序id
                $textTpl = array(
                    "ToUserName"=>$fromUsername,
                    "FromUserName"=>$toUserName,
                    "CreateTime"=>time(),
                    "MsgType"=>"transfer_customer_service",
                );
                exit(json_encode($textTpl));
            }elseif(!empty($postArr['MsgType']) && $postArr['MsgType'] == 'image'){ //图文消息
                $fromUsername = $postArr['FromUserName'];   //发送者openid
                $toUserName = $postArr['ToUserName'];       //小程序id
                $textTpl = array(
                    "ToUserName"=>$fromUsername,
                    "FromUserName"=>$toUserName,
                    "CreateTime"=>time(),
                    "MsgType"=>"transfer_customer_service",
                );
                exit(json_encode($textTpl));
            }elseif($postArr['MsgType'] == 'event' && $postArr['Event']=='user_enter_tempsession'){ //进入客服动作
                $fromUsername = $postArr['FromUserName'];   //发送者openid
                $content = '您好，有什么能帮助你?';
                $data=array(
                    "touser"=>$fromUsername,
                    "msgtype"=>"text",
                    "text"=>array("content"=>$content)
                );
                $json = json_encode($data,JSON_UNESCAPED_UNICODE);  //php5.4+
                
                $access_token = $this->get_accessToken();
                /* 
                 * POST发送https请求客服接口api
                 */
                $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
                //以'json'格式发送post的https请求
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                if (!empty($json)){
                    curl_setopt($curl, CURLOPT_POSTFIELDS,$json);
                }
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                //curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
                $output = curl_exec($curl);
                if (curl_errno($curl)) {
                    echo 'Errno'.curl_error($curl);//捕抓异常
                }
                curl_close($curl);
                if($output == 0){
                    echo 'success';exit;
                }
                
            }else{
                exit('aaa');
            }
        }else{
            echo "";
            exit;
        }
    }

    public function get_accessToken(){
        if(S('access_token')){
            return S('access_token');
        }
        else{
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxd5283a13ae3824c5&secret=4xw7HLlykF4CWpjJehDOgdAr2WxaLoIJ5npWPJo9yv6';
            $result = $this->vget($url);
            $res = json_decode($result,true);   
            //json字符串转数组
            if($res){
                S('access_token',$res['access_token'],7100);
                return S('access_token');
            }else{
                return 'api return error';
            }
        }
    }

    function vget($url){
        $info=curl_init();
        curl_setopt($info,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($info,CURLOPT_HEADER,0);
        curl_setopt($info,CURLOPT_NOBODY,0);
        curl_setopt($info,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($info,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($info,CURLOPT_URL,$url);
        $output= curl_exec($info);
        curl_close($info);
        return $output;
    }

}