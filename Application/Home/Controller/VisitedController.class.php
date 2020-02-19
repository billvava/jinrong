<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class VisitedController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}
	
	public function who_have_seen_me(){
		$list = M('ViewInfo')->where(['info_user_id'=>C('visitor.uid')])->select();
		$page_seo['title']='谁看过我-用户中心';
		$this->assign('page_seo',$page_seo);
		$this->assign('list',$list);
		$this->assign('personal_nav',ACTION_NAME);
		$this->display();
	}
	
	public function who_i_have_see(){
		$where['trj_company_id']  = ['neq','0'];
		$list = M('ViewInfo')->where(['uid'=>C('visitor.uid')])->limit()->select();
		$member_list = M('Members')->where($where)->field('uid,realname,sex,trj_company_id,job')->select();
		$list = array_link($list,array_key($member_list,'trj_company_id'),'info_user_id');
		$type=[1=>'Fund',2=>'Item'];
		foreach ($list as $k => &$v){
			$info = $this->get_info_type($v['info_id']);
			$v['type'] = $info['type'];
			$list[$k]['title'] = $info['title'];
			$list[$k]['controller'] = $type[$v['type']];
			$v['addtime'] = daterange(time(),$v['addtime'],'Y-m-d',"#FF3300");
		}
		$page_seo['title']='我看过谁-用户中心';
		$this->assign('page_seo',$page_seo);
		$this->assign('list',$list);
		$this->assign('personal_nav',ACTION_NAME);
		$this->display('who_have_see');
	}


	function get_info_type($id=''){
		if($id==''){
			return;
		}
		$info = M('BaseInfo')->field('id,title,type')->where(['id'=>$id])->find();
		return $info;
	}

	
}
?>