<?php

defined('THINK_PATH') or exit();
ignore_user_abort(true);
class ClearCache{
	public function run(){
		rmdirs(RUNTIME_PATH);
        rmdirs(QSCMS_DATA_PATH.'static');
        rmdirs(STATISTICS_PATH);
        rmdirs(QSCMS_DATA_PATH.'wxpay');
	}
}
?>