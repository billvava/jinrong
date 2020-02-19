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

		//认证内容
		$list = M('Attest') -> where(['type' => $type]) -> order('id asc') -> select();
		$user_auth_list = array();
		$user_auth_list = M('UserAuth') -> where(['uid' => $uid]) -> field('type,status,attest_id') -> order('id asc') -> select();
		foreach ($list as $key => $value) {
			foreach ($user_auth_list as $k => $v) {
				$list[$key]['status'] = isset($list[$key]['status']) ? $list[$key]['status']: -1;
				if($value['id'] == $v['attest_id']){
					$list[$key]['status'] = $v['status'];
				}
			}
		}
	
		$this->assign('list',$list);
		$this->assign('type',$type);
    $this->assign('personal_nav','usercert');
		$this->display();
	}

	


	//身份验证
	public function idCard(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$id_card_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['id_card_img'] = json_encode($id_card_img);
				$data['name'] = $name;
				$data['id_card'] = $_POST['id_card'];
				$data['real_name'] = $_POST['real_name'];
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
    $this -> display();
	}

	//企业身份认证
	public function enterpriseIdCard(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$enterpriseId_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['enterpriseId_img'] = json_encode($enterpriseId_img);
				$data['name'] = $name;
				$data['company'] = $_POST['company'];
				$data['empower_name'] = $_POST['empower_name'];
				$data['business_license_no'] = $_POST['business_license_no'];
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
		$this -> display();
	}

	//银行账户认证
	public function bankAccount(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$bank_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['bank_img'] = json_encode($bank_img);
				$data['name'] = $name;

				$data['corporation'] = $_POST['corporation'];
				$data['opening_bank'] = $_POST['opening_bank'];
				$data['bank_card'] = $_POST['bank_card'];
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
		$this -> display();
	}


	//企业荣誉证书
	public function honor(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$honor_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['honor_img'] = json_encode($honor_img);
				$data['name'] = $name;
				
				
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
		$this -> display();
	}

	//成功案例
	public function successfulCases(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$successfulCases_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['successfulCases_img'] = json_encode($successfulCases_img);
				$data['name'] = $name;
	
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
		$this -> display();
	}

	//邮箱认证
	public function email(){
		$id = $_GET['id'];
		if(IS_AJAX && IS_POST){

			$id = $_POST['id'];
			//认证内容
			$one = M('Attest') -> where(['id' => $id]) ->find();
			$name = $one['name'];
			$type = $one['type'];
			$uid=C('visitor.uid');
			$email = $_POST['email'];
			$subject = '邮箱认证';
      $to = $email;
      $data['email'] = $email;
      $data['name'] = $name;
      $data['uid'] = $uid;
      $data['type'] = $type;
      $data['attest_id'] = $id;
      if(M('UserAuth') -> where("`uid` = $uid and `type` = $type") -> count()){
      	echo json_encode(array('status' => 0,'msg' => '请勿重复提交'));exit;
      }
      $res = M('UserAuth') -> add($data);

      $url = 'http://'.$_SERVER['HTTP_HOST'].'/UserCert/emailConfirmed/id/'.$res;
     	$this -> assign('url',$url);
      $body = $this->fetch('Emailtpl/email_tpl');
      $result = person_send_mail($to, $name='', $subject = $subject, $body = $body);
      
      if($res){
      	echo json_encode(array('status' => 1,'msg' => '提交成功'));exit;
      }else{
      	echo json_encode(array('status' => 1,'msg' => '提交失败'));exit;
      }
      
     

		}
		$this -> assign('id',$id);
		$this->display();
	}

	public function emailConfirmed(){
		$id = $_GET['id'];
		$data['status'] = 1;
		M('UserAuth') -> where("`id`= $id") -> save($data);
	}

	//政府身份认证
	public function government(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$government_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['government_img'] = json_encode($government_img);
				$data['name'] = $name;
				$data['company'] = $_POST['company'];
				$data['empower_name'] = $_POST['empower_name'];
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
		$this -> display();
	}

	//个人职务证明
	public function position(){
		$id = $_GET['id'];
		if(IS_POST){
			$id = $_POST['id'];
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
					$position_img[] = $v['savename'];
				}
				//认证内容
				$one = M('Attest') -> where(['id' => $id]) ->find();
				$name = $one['name'];
				$type = $one['type'];
				$uid=C('visitor.uid');
			
				$data['position_img'] = json_encode($position_img);
				$data['name'] = $name;
	
				$data['uid'] = $uid;
				$data['type'] = $type;
				$data['attest_id'] = $id;
				if(M('UserAuth') -> where("`uid` = $uid and `attest_id` = $id") -> count()){
					$this -> error('请勿重复提交');exit;
				}
				$res = M('UserAuth') -> add($data);

				if($res){
					$this -> success('上传成功', '/UserCert/index');
				}else{
					$this -> error('上传失败返回错误信息');exit;
				}
				
	    }
    }
    $this -> assign('id',$id);
		$this -> display();
	}


}
?>