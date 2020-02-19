<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class ZijinController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}
	
	/**
	 * [com 公司首页]
	 */
	public function com_show(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'comshow','params'=>'id='.intval($_GET['id']))));
		}
		$tpl = I('get.tpl','default','trim');
		$this->display(MODULE_PATH.'View/tpl_company/'.$tpl.'/com_show.html');
	}
	/**
	 * [com_jobs_list 企业职位列表]
	 */
	public function com_jobs_list(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'comshow','params'=>'id='.intval($_GET['id']))));
		}
		$tpl = I('get.tpl','default','trim');
		$this->display(MODULE_PATH.'View/tpl_company/'.$tpl.'/com_jobs_list.html');
	}
	/**
	 * [jobs_show 职位详情]
	 */
	public function jobs_show(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'show','params'=>'id='.intval($_GET['id']))));
		}
		$tpl = I('get.tpl','default','trim');
        $this->display(MODULE_PATH.'View/tpl_company/'.$tpl.'/jobs_show.html');
	}
	
	/**
	 * [jobs_list 职位列表]
	 */
	public function jobs_list(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'index')));
		}
		url_key_shift();//搜索关健字URL中文转码(gbk->utf_8)
		$this->display();
	}
	/**
	 * [jobs_list 地图职位列表]
	 */
	public function jobs_map(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'index')));
		}
		$this->display();
	}
	/**
	 * [index 招聘首页]
	 */
	public function index(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'index')));
		}
		$this->display();
	}
}
?>