<?php

defined('THINK_PATH') or exit();
ignore_user_abort(true);
class MembersLog{
	public function run(){
		D('MembersLog')->where('log_addtime<'.strtotime("-45 day"))->delete();
	}
}
?>