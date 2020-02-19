<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class NewsController extends FrontendController{
	public function _initialize() {
		parent::_initialize();
	}

	public function index(){
        $this->redirect(U('News/news_list',array('id'=>2)));

		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'News','a'=>'news_list','params'=>'id='.intval(4))));
		}
		//$this->display();
	}
	
	public function show(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'News','a'=>'show','params'=>'id='.intval($_GET['id']))));
		}
		$this->display('news_show');
	}

	public function news_list(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'News','a'=>'index')));
		}
		$id = I('get.id','','int');
		if($id){
			$pid = M('ArticleCategory')->where(['id'=>$id])->getField('parentid');
			$pids=[21,22,23,24];
			if(in_array($pid,$pids)){
				$tpl='School/baike';
			}
			if($pid==31){
				$tpl='School/success_case';
			}
			if($id==95){
				$tpl='School/business_plan';
			}
		}
		$list = M('Article')->field('id,type_id,title,content')->where(['type_id'=>$id])->limit(20)->select();
		$this->assign('list',$list);
		$tpl=isset($tpl) ? $tpl : 'news_list';
		$this->display($tpl);
	}

	public function ajax_new_article_list(){
		$page = I('get.page',0,'intval');
		$start = $page*5;
		$this->assign('start',$start);
		$html = $this->fetch('ajax_new_article_list');
		if($html){
			$this->ajaxReturn(1,'',$html);
		}else{
			$this->ajaxReturn(0);
		}
	}
}
?>