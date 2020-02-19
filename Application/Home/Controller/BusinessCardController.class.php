<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class BusinessCardController extends FrontendController{
	public function _initialize(){
		parent::_initialize();
	}

	public function my(){
        $page_seo['title']='我的商友-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav',ACTION_NAME);
		$this->display();
	}

    public function myfans(){
        $page_seo['title']='收到的名片-用户中心';
        $friend_id = C('visitor.uid');
        $business_card_list = M('BusinessCard')->where(['uid'=>$friend_id])->select();
        $category = F('category');
        $industry_id = $category['industry_id'];
        foreach ($business_card_list as $k => $v) {
            $members_info = M('members')->field('realname,sex,company_name,job,industry_id')->where(['uid'=>$v['uid']])->find();
            $count = M('businessCard')->where(['uid'=>$v['uid']])->count();
            $members_info['industry_id'] = $industry_id[$members_info['industry_id']];
            $business_card_list[$k]['addtime'] = date("Y-m-d",$business_card_list[$k]['addtime']);
            $business_card_list[$k]['business_count'] = $count;
            $business_card_list[$k] = array_merge($business_card_list[$k],$members_info);
        }
        $this->assign('business_card_list',$business_card_list);
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','myfans');
        $this->display();
    }

    public function myfollow(){
        $page_seo['title']='已递送名片-用户中心';
        $uid = C('visitor.uid');
        $business_card_list = M('BusinessCard')->where(['uid'=>$uid])->select();
        $category = F('category');
        $industry_id = $category['industry_id'];
        foreach ($business_card_list as $k => $v) {
            $members_info = M('members')->field('realname,sex,company_name,job,industry_id')->where(['uid'=>$v['friend_id']])->find();
            $count = M('businessCard')->where(['uid'=>$v['friend_id']])->count();
            $members_info['industry_id'] = $industry_id[$members_info['industry_id']];
            $business_card_list[$k]['addtime'] = date("Y-m-d",$business_card_list[$k]['addtime']);
            $business_card_list[$k]['business_count'] = $count;
            $business_card_list[$k] = array_merge($business_card_list[$k],$members_info);
        }
        $this->assign('business_card_list',$business_card_list);
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','my');
        $this->display();
    }

    public function contact(){
        $page_seo['title']='已查看联系方式-用户中心';
        $this->assign('page_seo',$page_seo);
        $this->assign('personal_nav','my');
        $this->display();  
    }
}
?>