<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class UploadController extends FrontendController{
	public function _initialize() {
		parent::_initialize();
		//访问者控制
		if (!$this->visitor->is_login) {
			IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
			//非ajax的跳转页面
			$this->redirect('members/login');
		}
	}

	/**
	 * [attach 附件上传]
	 * @return [type] [description]
	 */
	public function attach(){
		if(IS_POST){
			$type = I('post.type','image','trim');
			if(!in_array($type,array('resume_img','word_resume','company_logo','i_pic','certificate_img'))) return false;
			if (!empty($_FILES[$type]['name'])) {
				$this->$type();
			}else{
				$this->ajaxReturn(0, L('illegal_parameters'));
			}
		}
	}


	/**
	 * [attach 附件上传]
	 * @return [type] [description]
	 */
	public function attach_upload(){
		if(IS_POST){
			/*
			$temp = I('post.');
			print_r($temp);
			exit;
			*/
			$type = I('post.attach_type','','trim');
			if(!in_array($type,array('zjxm_image','zjxm_file'))) return false;
			if (!empty($_FILES['Filedata']['name'])) {
				$this->$type();
			}else{
				$this->ajaxReturn(0, L('illegal_parameters'));
			}
		}
	}

    function makeDir($dir, $mode = 0777) {  
        if (!$dir) return false;
        if(!file_exists($dir)) {  
            mkdir($dir,$mode,true);  
            return chmod($dir,$mode);  
        } else {  
            return true;  
        }   
    }

	public function zjxm_image(){
        $date = date('Y-m/d');
        //图片存储路径
        if(!is_dir($paths)){
            $this->makeDir($paths);
        }
		$result = $this->_upload($_FILES['Filedata'],'attach/', array(
				'maxSize' => '800',
				'uploadReplace' => true,
				'attach_exts' => 'bmp,png,gif,jpeg,jpg'
		));
        if ($result['error']) {
            $attach_type = I('post.filename');
                $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                $name = $result['info'][0]['name'];
                $res = M('Attach')->data(array('path'=>$path,'uid'=>C('visitor.uid'),'attach_type'=>$attach_type,'addtime'=>time(),'memo'=>$name))->add();
                if($result){
                    $data = array('code'=>200,'aid'=>$res,'file'=>$path,'name'=>$result['info'][0]['savename']);
                }
                echo json_encode($data);
        }else{
            $data = array('code'=>100,'msg'=>'加载失败');
            echo json_encode($data);
        }
	}

    function zjxm_file(){
            $date = date('Y-m/d');
            $result = $this->_upload($_FILES['Filedata'],'attach/'.$date,array(
                'maxSize' => '25480',
                'uploadReplace' => true,
                'attach_exts' => 'doc,docx,xls,xlsx,ppt,pptx,pdf'
            ));
            if ($result['error']) {
                $attach_type = I('post.filename');
                $path = '/'.$result['info'][0]['savepath'].$result['info'][0]['savename'];
                $name = $result['info'][0]['name'];
                $res = M('Attach')->data(array('path'=>$path,'uid'=>C('visitor.uid'),'attach_type'=>$attach_type,'addtime'=>time(),'memo'=>$name))->add();
                if($result){
                    $data = array('code'=>200,'aid'=>$res,'file'=>$path,'name'=>$result['info'][0]['savename']);
                }
                echo json_encode($data);
            }else{
                $data = array('code'=>100,'msg'=>'加载失败');
                echo json_encode($data);
            }
        }

	/**
	 * [avatar 头像上传保存]
	 */
	public function avatar(){
    	//日期路径
    	$date = date('ym/d/');
    	$save_avatar=C('qscms_attach_path').'avatar/'.$date;//图片存储路径
    	if(!is_dir($save_avatar)){
	    	mkdir($save_avatar,0777,true);
	    }
	    $uid = C('visitor.uid');
    	$savePicName = md5($uid.time());
		$filename = $save_avatar.$savePicName.".jpg";
		$pic=base64_decode($_POST['pic1']);
		file_put_contents($filename,$pic);
		$image= new \Common\ORG\ThinkImage();
		$size = explode(',',C('qscms_avatar_size'));
		foreach ($size as $val) {
			$image->open($filename)->thumb($val,$val,3)->save($filename."_".$val."x".$val.".jpg");
		}
		$setsqlarr['avatars']=$date.$savePicName.".jpg";
		$old_avatar = D('Members')->where(array('uid'=>$uid))->getfield('avatars');
		$photo = M('MembersInfo')->field('photo_audit,photo_display')->where(array('uid'=>$uid))->find();
		if($photo['photo_display'] == 1){
			$setsqlarr['photo'] = 1;
		}else{
			$setsqlarr['photo'] = 0;
		}
		if(true !== $reg = D('Members')->update_user_info($setsqlarr,C('visitor'))) $this->ajaxReturn(0,$reg);
		$user_resume_list = D('Resume')->where(array('uid'=>$uid))->select();
		foreach ($user_resume_list as $key => $value) {
			D('Resume')->check_resume($uid,$value['id']);//更新简历完成状态
		}
		D('TaskLog')->do_task(C('visitor'),5);
		write_members_log(C('visitor'),2044);
		$rs['status'] = 1;
		$rs['picUrl'] = $savePicName.".jpg";
		print json_encode($rs);
	}
}
?>