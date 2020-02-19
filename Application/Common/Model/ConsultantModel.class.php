<?php 
namespace Common\Model;
use Think\Model;
class ConsultantModel extends Model{
	protected $_validate = array(
		array('name,qq','identicalNull','',1,'callback'),
	);
	/*
		为企业随机分配顾问
		@uid 企业 uid 
	*/
	public function set_consultant($user){
		if(C('apply.Subsite') && isset($user['subsite_id'])){
			$where['subsite_id'] = $user['subsite_id'];
		}
		if($consultant = $this->where($where)->getField('id',true)){
			$rand = array_rand($consultant,1);
			return D('Members')->where('uid='.$user['uid'])->setField('consultant',$consultant[$rand]);
		}
	}
}
?>