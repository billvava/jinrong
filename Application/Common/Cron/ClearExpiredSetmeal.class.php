<?php

defined('THINK_PATH') or exit();
ignore_user_abort(true);
class ClearExpiredSetmeal{
	public function run(){
		$map['endtime'] = array(array('elt',time()),array('neq',0));
		$map['setmeal_id'] = array('gt',1);
		$list = M('MembersSetmeal')->where($map)->select();
		foreach ($list as $key => $value) {
			D('MembersSetmeal')->set_members_setmeal($value['uid'],1);
		}
	}
}
?>