<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class UserCertController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
		$uid=C('visitor.uid');
		//会员身份
		$type = M('ExtRole')->where(['uid'=>$uid]) -> getField('type');
		if(!M('ExtRole')->where(['uid'=>$uid])->count()){
			$this -> error('请先完善个人资料');
		}

		//认证内容
		$list = M('Attest') -> where(['type' => $type]) -> order('id asc') -> select();
		$user_auth_list = array();
		$user_auth_list = M('UserAuth') -> where(['uid' => $uid]) -> field('type,status,attest_id') -> order('id asc') -> select();

		foreach ($list as $key => $value) {
			if(!empty($user_auth_list)){
				foreach ($user_auth_list as $k => $v) {
					$list[$key]['status'] = isset($list[$key]['status']) ? $list[$key]['status']: -1;
					if($value['id'] == $v['attest_id']){
						$list[$key]['status'] = $v['status'];
					}
				}
			}else{
				$list[$key]['status'] = -1;
			}
			
		}
	
		$this->assign('list',$list);
		$this->assign('type',$type);
    $this->assign('personal_nav','usercert');
		$this->display();
	}

	
	// 资料认证
	public function authData(){
		$view_type = $_GET['view_type'];
		$id = $_GET['id']; //认证内容id
		if(IS_POST){
			$view_type = isset($_POST['view_type'])? $_POST['view_type']:1;
			if($view_type != 6){
				$id = $_POST['id'];//认证内容id

				unset($_POST['id']);
				$upload = new \Common\ORG\UploadFile();
		    //实例化UploadFile类
		    if(empty($_FILES)){
		      $this->error("未选择上传图片！");
		    }
		   
		    
		    //设置文件大小
		    $upload -> maxSize = 3292200;
		    //设置文件保存规则唯一
		    $upload->saveRule = 'uniqid';
		    //设置上传文件的格式
		    $upload -> allowExts = array('jpg','png','jpeg');

		    //保存路径
		    $upload->savePath ='./Uploads/imgs/';
		    //上传失败返回错误信息

		    if(!$upload->upload()){
		      $this->error($upload->getErrorMsg());

		    }else{
					//获取上传文件的信息
					$inf = $upload-> getUploadFileInfo();
					
					foreach ($inf as $k => $v) {
						$img_data[] = $v['savename'];
					}
					//认证内容
					$one = M('Attest') -> where(['id' => $id]) ->find();
					$name = $one['name'];
					$type = $one['type'];
					$uid = C('visitor.uid');
					
					$username = M('Members') -> where(['uid' => $uid]) -> getField('realname');
					$data = $_POST;
					$data['username'] = $username;
					$data['img_data'] = json_encode($img_data);
					$data['name'] = $name;
					
					$data['uid'] = $uid;
					$data['type'] = $type;
					$data['attest_id'] = $id;
					if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
						$this -> error('请勿重复提交');exit;
					}
					$res = M('UserAuth') -> add($data);

					if($res){
						$this -> success('提交成功', '/UserCert/index');exit;
					}else{
						$this -> error('提交失败返回错误信息');exit;
					}
					
		    }
	    }else{  //邮箱认证
	    	$id = $_POST['id'];
	    	unset($_POST['id']);
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
				$username = M('Members') -> where(['uid' => $uid]) -> getField('realname');
				$data['username'] = $username;
				$email = $_POST['email'];
				$subject = '邮箱认证';
		    $to = $email;
		    $data['email'] = $email;
		    $data['name'] = $name;
		    $data['uid'] = $uid;
		    $data['type'] = $type;
		    $data['attest_id'] = $id;
		    if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
		    	echo json_encode(array('status' => 0,'msg' => '请勿重复提交'));exit;
		    }
		      $res = M('UserAuth') -> add($data);

		      $url = 'http://'.$_SERVER['HTTP_HOST'].'/UserCert/emailConfirmed/id/'.$res;
		     	$this -> assign('url',$url);
		      $body = $this->fetch('Emailtpl/email_tpl');
		      $result = person_send_mail($to, $name, $subject, $body);
		      if(!$result){
		      	M('UserAuth') -> where("`id`= $res") -> delete();
		      }
		      if($res){
		      	echo json_encode(array('status' => 1,'msg' => '提交成功'));exit;
		      }else{
		      	echo json_encode(array('status' => 1,'msg' => '提交失败'));exit;
		      }
      
	    }
  	}
    $this -> assign('id',$id);
    $this -> assign('view_type',$view_type);
		$this -> display('auth_view_'.$view_type);
	}

	public function emailConfirmed(){
		$id = $_GET['id'];
		$data['status'] = 1;
		$res = M('UserAuth') -> where("`id`= $id") -> save($data);
		if($res){
			echo '认证成功';exit;
		}else{
			echo '认证失败';exit;
		}
	}

	


}
?>