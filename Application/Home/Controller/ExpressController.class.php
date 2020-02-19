<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class ExpressController extends FrontendController{
    
    function editprojectinfo(){
        if(IS_POST){
            $data = I('post.');
            $files = $_FILES['files'];
            if($files){
                $date = date('Y-m/d');
                $result = $this->_upload($_FILES['files'],'attach/'.$date,array(
                'maxSize' => '25480',
                'uploadReplace' => true,
                'attach_exts' => 'jpg,jpeg,png,gif,ppt,pptx,pdf,doc,docx'
                ),$save_rule='uniqid',$type='unimg');
                //$upload = new \Common\ORG\UploadFile();
                //$result = $upload->uploadOne($_FILES['files'],'attach/'.$date);
                if ($result['error']) {
                    $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                    $name = $result['info'][0]['name'];
                    $res = M('Attach')->data(array('path'=>$path,'uid'=>C('visitor.uid'),'attach_type'=>'item_files','addtime'=>time()))->add();

                    /*
                    if($result){
                        $data = array('code'=>200,'aid'=>$res,'file'=>$path,'name'=>$result['info'][0]['savename']);
                    }
                    */
                }
            }
            $projectpicture = $_FILES['projectpicture'];
            if($projectpicture){
                $date = date('Y-m/d');
                $result = $this->_upload($_FILES['projectpicture'],'attach/'.$date,array(
                'maxSize' => '25480',
                'uploadReplace' => true,
                'attach_exts' => 'jpg,jpeg,png,gif'
                ));
                if ($result['error']) {
                    $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                    $name = $result['info'][0]['name'];
                    $res = M('Attach')->data(array('path'=>$path,'uid'=>C('visitor.uid'),'attach_type'=>'item_logo','addtime'=>time()))->add();
                    
                    /*
                    if($result){
                        $data = array('code'=>200,'aid'=>$res,'file'=>$path,'name'=>$result['info'][0]['savename']);
                    }
                    */
                }
            }
            $data['uid'] = C('visitor.uid');
            $result = M('ItemDeliver')->where(['uid'=>$data['uid']])->find();
            if($result){
                $res = M('ItemDeliver')->where(['uid'=>C('visitor.uid')])->save($data);
            }else{
                $res = M('ItemDeliver')->add($data);
            }
            if($res !== False){
                $data='ok';
                    header('Content-type:text/json');
                    echo json_encode($data);
                    exit;
                }
        }
    }

    function write_item(){
        $this->display();
    }

    function login(){
        $this->display();
    }

    function save(){
        $info = M('ItemDeliver')->where(['uid'=>C('visitor.uid')])->find();
        $info['projectid'] = $info['id'];
        if(empty($info['mobile'])){
            $info['mobile'] = M('Members')->field('mobile')->where(['uid'=>C('visitor.uid')])->getField('mobile');
        }
        $info['projectpicture'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_logo'])->order('id desc')->getField('path');
        $info['files'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_files'])->order('id desc')->getField('path');
        $this->assign('info',$info);
        $this->display();
    }

    function project_info(){
        $info = M('ItemDeliver')->where(['uid'=>C('visitor.uid')])->find();
        $percent = array('cust_name'=>6,'project'=>6,'post'=>6,'email'=>6,'pro_name'=>6,'category'=>6,'stage'=>6,'city'=>6,'money'=>6,'currency'=>6,'fround'=>6,'url'=>6,'pro_info'=>8,'pro_race'=>10,'pro_team'=>10);
        if($info){
            foreach ($info as $k => $v) {
               foreach ($percent as $key => $val) {
                    if($k==$key && !empty($v)){
                        $user_percent+=$val;
                    }
                } 
            }
        }
        
        if($user_percent>=85){
            if(D('Sms')->sendSms('other',array('mobile'=>$info['mobile'],'tpl'=>'itemer_write'))){
                $setsqlarr['s_sendtime']=time();
                $setsqlarr['s_type']=2;//发送成功
                D('Smsqueue')->add($setsqlarr);
                unset($setsqlarr);
            }else{
                $setsqlarr['s_sendtime']=time();
                $setsqlarr['s_type']=3;//发送失败
                D('Smsqueue')->add($setsqlarr);
                unset($setsqlarr);
            }
        }

         if(!empty($info)){
             $info['projectid'] = $info['id'];
         }
        if(empty($info['mobile'])){
            $info['mobile'] = M('Members')->field('mobile')->where(['uid'=>C('visitor.uid')])->getField('mobile');
        }
        if(!empty($info)){
            $info['projectpicture'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_logo'])->order('id desc')->getField('path');
            $info['files'] = M('Attach')->where(['uid'=>C('visitor.uid'),'attach_type'=>'item_files'])->order('id desc')->getField('path');
        }
        if(empty($user_percent)){
            $user_percent=0;
        }
        $this->assign('user_percent',$user_percent);
        $this->assign('info',$info);
        $this->display();
    }

    function setpart2info(){
        if(IS_POST){
            $data = I('post.');
            $data['uid'] = C('visitor.uid');
            $result = M('ItemDeliver')->where(['uid'=>$data['uid']])->find();
            if($result){
                $res = M('ItemDeliver')->where(['uid'=>$data['uid']])->save($data);
            }else{
                $res = M('ItemDeliver')->add($data);
            }
            if($res !== False){
               $this->ajaxReturn('1','ok','ok');
            }
        }
    }

    function setpart3info(){
        if(IS_POST){
            $data = I('post.');
            $data['uid'] = C('visitor.uid');
            $result = M('ItemDeliver')->where(['uid'=>$data['uid']])->find();
            if($result){
                $res = M('ItemDeliver')->where(['uid'=>$data['uid']])->save($data);
            }else{
                $res = M('ItemDeliver')->add($data);
            }
            if($res !== False){
               $this->ajaxReturn('1','ok');
            }
        }
    }

    function user_check(){
        //访问者控制
        if (!$this->visitor->is_login){
            $data['html'] = $this->fetch('Express/login');
            $this->ajaxReturn(0,'',$data);
        }else{
            $this->ajaxReturn(1,'');
        }
        if(C('visitor.utype') !=2) $this->ajaxReturn(0,'请登录项目方帐号！');
    }
}