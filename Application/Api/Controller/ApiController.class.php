<?php
namespace Api\Controller;
class ApiController{
    
    function help_list($where=array()){
        $help_list = M('Help')->where($where)->order('addtime desc')->limit(6)->select();
        header('Content-type:text/json');
        exit(json_encode($help_list,JSON_UNESCAPED_UNICODE));
    }

    function category($cat_name=''){
        if($cat_name){
            $cat = F('category');
            $category = $cat[$cat_name];
            header('Content-Type:application/json;charset=utf-8');
            exit(json_encode($category,JSON_UNESCAPED_UNICODE));
        }
    }

    function wx_category(){
        $cat_name = I('get.category','');
        if($cat_name){
            $cat = F('category');
            $category = $cat[$cat_name];
            header('Content-Type:application/json;charset=utf-8');
            exit(json_encode($category,JSON_UNESCAPED_UNICODE));
        }
    }

    function fund_list($where=array()){
        $category = F('category');
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where($where)->count();
        $fund_list = M('BaseInfo')->alias('bi')->join('inner JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.info_type,bi.title,fi.funds_body,fi.tz_industry,fi.tz_area,bi.amount_interval_min,bi.amount_interval_min_unit,bi.amount_interval_max,bi.amount_interval_max_unit,amount_range,addtime,updatetime,bi.trj_info_id,fi.id as fid')->where($where)->limit(0,10)->select();
        $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id,city_id,area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>1])->select();
        $fund_list = array_link($fund_list,array_key($member_list,'trj_info_id'),'trj_info_id');
        foreach ($fund_list as $k => $v) {
            $fund_list[$k]['tz_industry'] =field_get_name($v['tz_industry'],$field='tz_industry',$ext_field='',$ext_condition=1);
            $fund_list[$k]['tz_area'] =field_get_name($v['tz_area'],$field='tz_area',$ext_field='province',$ext_condition=1);
            $fund_list[$k]['funds_body']=$category['funds_body'][$v['funds_body']];
            $fund_list[$k]['amount_interval_min_unit'] =$category['money_unit'][$v['amount_interval_min_unit']];
            $fund_list[$k]['amount_interval_max_unit'] =$category['money_unit'][$v['amount_interval_max_unit']];
            $fund_list[$k]['info_type'] =$category['info_type'][$v['info_type']];
            $fund_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            $fund_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
        }
        $arr['num'] =$count;
        $arr['fund_list'] =$fund_list;
        if($arr['fund_list']){
            $arr['code']=200;
        }else{
            $arr['code']=0;
        }
        header('Content-type:text/json');
        exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

    function item_list($where=array()){
        $category = F('category');
        $where['bi.type'] = 2;
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->where($where)->count();
        $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.trj_info_id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,bi.province_id,ii.industry_id,ii.xmrz_type,bi.info_type,bi.addtime,bi.updatetime')->limit(0,20)->where($where)->where(['bi.type'=>2])->select();
        foreach ($info_list as $k => &$v){
            if($v['amount_interval_min']==$v['amount_interval_max'] && $v['amount_interval_min_unit']==$v['amount_interval_max_unit']){
                unset($v['amount_interval_max']);
                unset($v['amount_interval_max_unit']);
            }
            $info_list[$k]['amount_interval_min_unit'] =$category['money_unit_min'][$v['amount_interval_min_unit']];
            $info_list[$k]['industry_id'] =$category['industry_id'][$v['industry_id']];
            $info_list[$k]['amount_interval_max_unit'] =$category['money_unit_min'][$v['amount_interval_max_unit']];
            $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
            $info_list[$k]['xmrz_type'] = field_get_name($v['xmrz_type'],$field='xmrz_type');
            $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
        }
        $arr['num'] =$count;
        $arr['item_list'] =$info_list;
        if($arr['item_list']){
            $arr['code']=200;
        }else{
            $arr['code']=0;
        }
        header('Content-type:text/json');
        exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

    function attach_upload(){
        $date = date('Y-m/d');
        if (!empty($_FILES['file']['name'])){
            $result = $this->_upload($_FILES['file'],'attach/'.$date, array(
                'maxSize' => '800',
                'uploadReplace' => true,
                'attach_exts' => 'bmp,png,gif,jpeg,jpg'
            ));
            //exit(json_encode_no_zh($result));
            if ($result['error']) {
                $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                $name = $result['info'][0]['name'];
                $res = M('Attach')->data(array('path'=>$path,'attach_type'=>$attach_type,'addtime'=>time()))->add();
                if($result){
                    $data = array('code'=>200,'aid'=>$res,'file'=>'https://www.7ronghui.com'.$path,'name'=>$result['info'][0]['savename']);
                }
                $arr['code'] = 200;
                $arr['msg']='加载成功';
                $arr['data'] = $data;
                header('Content-type:text/json');
                exit(json_encode($arr));
            } else {
                $data = array('code'=>100,'msg'=>'加载失败');
                echo json_encode($data);
            }
        }else{
            $data = array('code'=>100,'msg'=>'加载失败');
            echo json_encode($data);
        }
    }

    protected function _upload($file, $dir = '', $thumb = array(), $save_rule='uniqid') {
        if(false === $config = F('config')){
            $config = D('Config')->config_cache();
        }
        C($config);
        $upload = new \Common\ORG\UploadFile();
        if ($dir) {
            $upload_path = C('qscms_attach_path').$dir . '/';
            $upload->savePath = $upload_path;//上传文件保存路径
        }
        if ($thumb) {
            $maxSize = isset($thumb['maxSize']) ? $thumb['maxSize'] : C('qscms_attr_allow_size');
            $upload->maxSize = intval($maxSize) * 1024;   //文件大小限制
            $upload->uploadReplace=isset($thumb['uploadReplace']) ? true : false;//存在同名文件是否是覆盖 
            $upload->thumb =isset($thumb['thumb']) ? true : false;//是否对图像进行缩略图处理
            $upload->thumbMaxWidth = $thumb['width'];//生成缩略图的尺寸，多个时用(,)进行分割
            $upload->thumbMaxHeight = $thumb['height'];//生成缩略图的尺寸，多个时用(,)进行分割
            $upload->thumbPrefix = '';//缩略图的文件前缀，默认为thumb_
            $upload->thumbSuffix = isset($thumb['suffix']) ? $thumb['suffix'] : '_thumb';//缩略图的文件后缀，默认为空 
            $upload->thumbExt = isset($thumb['ext']) ? $thumb['ext'] : '';//指定缩略图的扩展名
            $upload->thumbRemoveOrigin = isset($thumb['remove_origin']) ? true : false;//生成缩略图后是否删除原图 
            if(isset($thumb['attach_exts'])){//永许上传的文件类型
                $upload->allowExts = explode(',', $thumb['attach_exts']);  //文件类型限制
            }else{
                $allow_exts = explode(',', C('qscms_attr_allow_exts')); //读取配置
                $allow_exts && $upload->allowExts = $allow_exts;  //文件类型限制
            }
        }
        if( $save_rule!='uniqid' ){
            $upload->saveRule = $save_rule;
        }
        if ($result = $upload->uploadOne($file)) {
            foreach (array('png','gif','bmp','jpg','jpeg') as $val) {
                if(strpos(strtolower($thumb['attach_exts']),$val)){
                    $s = true;
                    break;
                }
            }
            if(!$upload->thumb && $s){
                $image = new \Common\ORG\ThinkImage();
                $path = $result[0]['savepath'].$result[0]['savename'];
                $imageModel = $image->open($path);
                $thumb_width = $imageModel->width();
                $thumb_height = $imageModel->height();
                $imageModel->thumb($thumb_width,$thumb_height)->save($path);
            }
            return array('error'=>1, 'info'=>$result);
        } else {
            return array('error'=>0, 'info'=>$upload->getErrorMsg());
        }
    }

    function cn(){
        if(false === $config = F('config')){
            $config = D('Config')->config_cache();
        }
        C($config);
        print_r(C());
        exit;
    }

    function agreement(){
        $agreement = M('Text')->where(array('name'=>'agreement'))->getField('value');
        $agreement = html_out($agreement);
        ajax_out($agreement,1,'加载成功');
    }
}
?>