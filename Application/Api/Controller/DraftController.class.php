<?php
namespace Api\Controller;
class DraftController{

    function index(){
        echo 333;
        exit;
    }

    function submit(){
        header("Access-Control-Allow-Origin:*");
        if(false === $config = F('config')){
            $config = D('Config')->config_cache();
        }
        C($config);
        $request = $_POST['data'];
        parse_str($request, $data);
        $result = M('Draft')->add($data);
        if($result){
            $arr['data'] = $data;
            $arr['code'] = 200;
            $arr['msg'] = "提交成功";
        }else{
            $arr['code'] = -1;
            $arr['msg'] = "提交失败";
        }
        header('Content-type:text/json');
        sleep(1);
        exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

}