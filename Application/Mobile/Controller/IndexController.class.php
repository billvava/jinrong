<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class IndexController extends MobileController{
	// 初始化函数
	public function _initialize(){
		parent::_initialize();
	}
	public function index(){
		$info_type=[1=>'项目融资',200=>'资产交易',700=>'政府招商',2005=>'投资理财',2010=>'股权投资',2011=>'债权投资',2012=>'金融投资',2013=>'BT/BOT 项目投资',2014=>'其它投资'];
		$fund_list = M('BaseInfo')->where(['type'=>1])->limit(5)->select();
		$item_list = M('BaseInfo')->where(['type'=>2])->limit(5)->select();
		$this->assign('info_type',$info_type);
		$this->assign('fund_list',$fund_list);
		$this->assign('item_list',$item_list);
		$this->display();
	}

	public function test(){
		$config = C();
		print_r($config);
		exit;
	}

}
?>
