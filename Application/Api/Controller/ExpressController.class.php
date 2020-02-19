<?php
namespace Api\Controller;
class ExpressController{
    function submit(){
        if(IS_POST){
            $data = I('post.');
            $data['project'] = I('post.pro_name','');
            $data['url'] = I('post.website','');
            header('Content-type:text/json');
            $res = M('ItemDeliver')->add($data);
            if($res){
                $result['code'] = 1;
                $result['msg'] = '提交成功';
                $result['data'] = $data;
            }else{
                $result['code'] = 0;
                $result['msg'] = '提交失败';
            }
            exit(json_encode($result,JSON_UNESCAPED_UNICODE));
        }
    }

    function get_one(){
        $one = M('ItemDeliver2')->field('files_file')->find();
        exit(json_encode($one,JSON_UNESCAPED_UNICODE));
    }
}