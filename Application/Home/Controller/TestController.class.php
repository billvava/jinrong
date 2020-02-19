<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class TestController extends FrontendController{
	public function _initialize() {
        parent::_initialize();
    }

	//批量用户注册-项目方
    public function item_batch_user_reg(){
        $i = M('members')->where(['utype'=>2,'inner'=>'1'])->order('uid desc')->getField('username');
        $base_num = str_replace("qrh_","",$i);
        if(!$base_num){
            return;
        }
        for($i=$base_num;$i<20;$i++) {
            $f = $this->family_name();
            $data[$i]['username'] = 'qrh_xm_'.$i;
            $data[$i]['mobile']='';
            $data[$i]['realname']=$f['family_name'];
            $data[$i]['sex']=$f['sex'];
            $data[$i]['inner']=1;
            $data[$i]['utype']=2;
            $pwd_hash = D('Members')->randstr();
            $password='123456';
            $data[$i]['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
            $data[$i]['pwd_hash'] = $pwd_hash;
            $data[$i]['mobile_audit']=1;
            $data[$i]['status']=1;
        }
        $result = M('Members')->addall($data);
        if($result){
            $this->success('添加成功!',U('index/index'));
            die();
        }else{
            $this->error('添加失败!',U('index/index'));
            die();
        }
    }


    //批量用户注册-资金方
    public function zijin_batch_user_reg(){
        $i = M('members')->where(['utype'=>1,'inner'=>'1'])->order('uid desc')->getField('username');
        $base_num = str_replace("qrh_","",$i);
        if(!$base_num){
            return;
        }
        for($i=0;$i<20;$i++) {
            $f = $this->family_name();
            $data[$i]['username'] = 'qrh_zj_'.$i;
            $data[$i]['mobile']='';
            $data[$i]['realname']=$f['family_name'];
            $data[$i]['sex']=$f['sex'];
            $data[$i]['utype']=2;
            $pwd_hash = D('Members')->randstr();
            $password='123456';
            $data[$i]['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
            $data[$i]['pwd_hash'] = $pwd_hash;
            $data[$i]['mobile_audit']=1;
            $data[$i]['status']=1;
        }
        $result = M('Members')->addall($data);
        if($result){
            $this->success('添加成功!',U('index/index'));
            die();
        }else{
            $this->error('添加失败!',U('index/index'));
            die();
        }
    }


    public function family_name(){
        $family_name = ['梁','刘','赵','陈','李','周','朱','胡','傅','张','杨','卢','高','黄','王','柯','唐','鲁','徐','周','祝','邓','何','石','沈','寇','林','罗','邱','龚','曾','秦','白','段','彭','潘','杜','聂','郑','董','金','邵','吴','姜','戴','孙','罗','岑','马','贾','夏','余','包','宁','钱','冯','沈','韩','吕','孔','曹','严','魏','陶','蒋','姜','江','佟','亢','岳','海','钦','汝','阎','楚','晋','卫','施','谢','邹','柏','章','窦','苏','葛','苗','方','袁','柳','俞','任','酆','史','薛','贺','倪','汤','牛','游','荆','关','那','简','巩','聂','晁','越','文','廖','艾','瞿','柴','尚','谭','乔','黎','詹','宁','伊','井','靳','陆','裴','邢','程','诸','丁','缪','莫','樊','田','蔡','郭','童','阮','项','屈','舒','纪','熊','庞','茅','宋','米','狄','毛','祁','贝','姚','汪','尹','萧','穆','孟','顾','康','齐','时','于','毕','郝','常'];
        $sex=[0=>'先生',1=>'女士'];
        $rand_family_name = array_rand($family_name,1);
        $rand_sex = array_rand($sex,1);
        $f['family_name'] = $family_name[$rand_family_name].$sex[$rand_sex];
        $f['sex']=$rand_sex;
        return $f;
    }
    
}
?>