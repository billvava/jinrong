<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
use Common\ORG\ThinkImage;
class LianmengController extends FrontendController{
    
    

    public function locate(){
        if(C('visitor.utype')==3){
            $step = M('Stlm')->where(['id'=>C('visitor.uid')])->getField('step');
            if(!empty($step)){
                $action = [1=>'Lianmeng/locate',2=>'Lianmeng/company'];
                $this->redirect($action[$step]);
            } 
        }
        $this->display();
    }

    public function company(){
        $category = F('category');
        $this->assign('category',$category);
        $this->display('company');
    }

    public function img_save(){
        $uid = C('visitor.uid');
        $path = "/data/upload/preview/{yy}{mm}/{dd}/";
        $d = explode('-', date("y-m-d-H-i-s"));
        $path = str_replace("{yy}", $d[0], $path);
        $path = str_replace("{mm}", $d[1], $path);
        $path = str_replace("{dd}", $d[2], $path);
        $this->makedir(ROOT_PATH.$path);
        $img = I('post.certificate_img');
        if(!$img) return;
        list($type,$data) = explode(',', $img); 
        if(!empty(strstr($type,'image/jpeg'))){
            $ext='.jpg';
        }elseif(!empty(strstr($type,'image/gif'))){
            $ext='.gif';
        }elseif(!empty(strstr($type,'image/png'))){
            $ext='.png';
        }
        $photo = time().rand(000,999).$ext;    
        $res=file_put_contents(ROOT_PATH.$path.$photo,base64_decode($data),true);
        $shuju['uid'] = $uid;
        $shuju['info_id'] = 0;
        $shuju['path'] = $path.$photo;
        $shuju['attach_type'] = "i_license";
        $shuju['memo'] = $photo;
        $shuju['addtime'] = time();
        $where['uid'] = $uid;
        $where['attach_type'] = 'i_license';
        $info = M('attach')->where($where)->find();
        if($info){
            $del_path = ROOT_PATH.$info['path'];
            //删除原来的图片
            $result = @unlink($del_path); 
            M('attach')->where($where)->save($shuju);
        }else{
            M('attach')->data($shuju)->add();
        }
        $ret = array('code'=>1,'img'=>$path.$photo);
        echo json_encode($ret);
    }

    public function save(){
        $data = I('post.');
        $data['uid'] = C('visitor.uid');
        $request = M('stlm')->data($data)->add();
        if($request){
            $this->success('加入成功!');
        }else{
            $this->error('加入失败!');
        }
    }

    public function makedir($dir, $mode = 0777){  
        if(!$dir) return false;
        if(!file_exists($dir)) {  
            mkdir($dir,$mode,true);  
            return chmod($dir,$mode);  
        } else {  
            return true;  
        }
    }
}
?>