<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class InvestorController extends FrontendController{
	public function _initialize() {
		parent::_initialize();
	}

	public function index(){
		$limit = $this->getPageLimit($count,5);
        $investor_list = M('Investor')->limit($limit)->select();
        $this->assign('investor_list',$investor_list);
        $page = $this->getPageShow($pageMaps);
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Investor','a'=>'index')));
		}
		$this->assign('page', $page);
		$this->display();
	}
	
	public function one_key(){
		$tpl=$this->fetch('ajax_reg');
		$this->ajaxReturn(1,'修改密码弹窗获取成功！',$tpl);
	}

	//投资机构展示
	public function investor_show(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Investor','a'=>'show','params'=>'id='.intval($_GET['id']))));
		}
		$id = I('get.id');
		if(!$id){
			$this->error('信息不存在');
		}
		$info = M('Investor')->field('id,name,small_img,click,content')->where(['id'=>$id])->find();
		$info['content']=html_out($info['content']);
		if($info){
            //更新访问计数
            $viewsData=array();
            $viewsData['click'] = array('exp','click+1');
            M('Investor')->where(['id'=>$info['id']])->save($viewsData);
        }
        $red_investor = M('Investor')->limit(6)->order('click desc')->select();
        $this->assign('red_investor',$red_investor);
		$this->assign('info',$info);
        $page_seo=['title'=>$info['name']];
        $this->assign('page_seo',$page_seo);
		$this->display();
	}

	public function ajax_Investor_list(){
		$page = I('get.page',0,'intval');
		$start = $page*5;
		$inverstor_list = M('Investor')->field()->where()->limit($start,5)->select();
		$this->assign('inverstor_list',$inverstor_list);
		$this->assign('start',$start);
		$html = $this->fetch('ajax_investor_list');
		if($html){
			$this->ajaxReturn(1,'',$html);
		}else{
			$this->ajaxReturn(0);
		}
	}

}
?>