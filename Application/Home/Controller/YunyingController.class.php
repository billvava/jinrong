<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class YunyingController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}

	//添加视频文章
    function add_video_page(){
        for ($i=6; $i <501 ;$i++) {
            $data[$i]['type_id'] = 3;
            $data[$i]['title'] = '金融网网络推介会No.'.$i;
        }
        $empty = array();
        $data = array_merge($data,$empty);
        $result = M('Article')->addall($data);
    }

    function link_contacter(){
        $customer_list = M('Customer')->select();
        /*
        $kf_list = M('Admin')->field('id,realname')->where(['role_id'=>5])->select();
        
        foreach ($kf_list as $k => $v) {
            foreach ($customer_list as $key => $value) {
                if($v['realname']==$value['vip_kf_name']){
                    M('Customer')->where(['mobile'=>$value['mobile']])->setField('cid',$v['id']);
                }
            }
        }
        exit;
        */
        
        $list = M("Members")->field('uid,utype,username,realname,sex,mobile,email,qq,reg_time,reg_address,is_vip')->where(['mobile'=>['neq','']])->select();
        foreach ($customer_list as $k => &$v) {
            foreach ($list as $key => $value) {
                if($v['cid'] != 0 && $v['mobile'] ==$value['mobile']){
                    $data = ['owner'=>$v['cid'],'owner_name'=>$v['vip_kf_name']];
                    $res = M('Members')->where(['mobile'=>$v['mobile']])->setField($data);
                    if($res=== FALSE){
                        echo "错误";
                    }
                }
            }
        }
        echo "结束";
        exit;
    }

    function get_contacter_info(){
        $file = ROOT_PATH.'/contacter'.'/common'.'/'.'gonghai.txt';
        $file = file_get_contents($file);
        $content=str_replace("\n",' ',$file);
        $info = explode(' ',$content);
        foreach($info as $k=>&$v){
            if(!trim($v))unset($info[$k]);
        }
        $info = array_merge($info,[]);
        foreach ($info as $k => &$v) {
            $res = M("Members",'7ronghui_',DB_7rh)->field('uid,reg_time,mobile,sex')->where(['mobile'=>(int)$v])->find();
            if(is_array($res) && !empty($res)){
                $user_info[] = $res;
            }
        }
        foreach ($user_info as $k => &$v) {
            $user_info[$k]['cid'] = 0;
            $user_info[$k]['vip_kf'] = 0;
            $user_info[$k]['vip_kf_name'] = '';
            $user_info[$k]['addtime']=$v['reg_time'];
            unset($v['reg_time']);
        }
        print_r($user_info);
        exit;
        $result = M('Custcon')->addall($user_info);
        if($result){
            echo "保存成功!";
            exit;
        }
    }

    function get_user_count(){
        //echo M('Members')->field('mobile')->where(['utype'=>2,'mobile'=>['neq',''],'inner'=>0])->count();
        $unlogin_user = M('Members')->field('mobile')->where(['utype'=>'','mobile'=>['neq',''],'inner'=>0])->count();
        $login_user = M('Members')->field('mobile')->where(['utype'=>'2','mobile'=>['neq',''],'inner'=>0])->count();
        $fund_user_num = M('Members')->field('mobile')->where(['utype'=>1,'mobile'=>['neq',''],'inner'=>0])->count();
        //echo "项目方活跃用户数".$login_user;
        //echo "<br/>";
        //echo "项目方不活跃用户".$unlogin_user;
        //echo "<br/>";
        //echo "项目方用户".($login_user+$unlogin_user)."人";
        //echo "<br/>";
        //echo "资金方用户数".$fund_user_num."人";
        //exit;
        $total = $fund_user_num+$login_user+$unlogin_user;
        $data[0][] = '项目方用户数';
        //$data[0][] = $login_user+$unlogin_user;
        $data[0][]=round((($login_user+$unlogin_user)/$total)*100);
        $data[1][] = '资金方用户数';
        $data[1][]=round(($fund_user_num/$total)*100);
        return $data;
    }

    function send_email(){
        $subject = '金融网简介';
        $to = '277285371@qq.com';
        $body = $this->fetch('Emailtpl/aboutus');
        $result = company_send_mail($to, $name='', $subject = $subject, $body = $body);
    }

    function search(){
        $members = M('Members')->field('uid')->where(['utype'=>'2','mobile'=>['neq',''],'inner'=>0])->select();
        $info_uid = M('BaseInfo')->field('uid')->where(['uid'=>['neq',0],'type'=>2])->select();
        foreach ($info_uid as $k => $v){
            if(in_array($v,$members)){
                $published[] = $v;
            }else{
                $unpublish[] = $v;
            }
        }
        
       foreach ($unpublish as $k => $v) {
            if(!in_array($v,$members)){
                $unpublished[] = $v;
            }
       }
       $unlogin_user = M('Members')->field('uid')->where(['utype'=>0,'mobile'=>['neq',''],'inner'=>0])->select();
       //print_r($unlogin_user);
       //exit;
       print_r($unpublished);
       exit;
        //exit;
        //$unpublish = $this->remove_duplicate($unpublish);
        //print_r($unpublish);
        //exit;
        //$uid = array_link($members,array_key($member,'uid'),'uid');
    }

    //二维数组去重
    function remove_duplicate($array){
        $result = [];
        foreach($array as $key => $value) {
            $has = false;
        foreach($result as $val){
            if($val['uid']==$value['uid']){
                $has = true;
                break;
            }
        }
        if(!$has)
            $result[]=$value;
        }
        return $result;
    }

    function xxl(){
        $mm = M('Members')->field('reg_time,following')->where(['following'=>['neq','']])->select();
        foreach ($mm as $k => &$v) {
            $v['reg_time'] = date('Y-m-d H:i:s',$v['reg_time']);
        }
        print_r($mm);
        exit;
    }

}
?>