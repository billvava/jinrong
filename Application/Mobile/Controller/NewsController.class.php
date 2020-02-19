<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;

class NewsController extends MobileController
{
    // 初始化函数
    function _initialize(){
        parent::_initialize();
    }

    function index(){
        $this->display();
    }

    function news_list($id=''){
        if(empty($id)){
           $this->error('栏目不存在!');
        }
        $seo_info = D('ArticleCategory')->get_id_seo($id);
        $page_seo = [];
        $page_seo['title']=$seo_info['title'];
        $page_seo['header_title']=$seo_info['title'];
        $count = M('Article')->where(['type_id'=>$id])->count();
        $list = M('Article')->where(['type_id'=>$id])->limit($limit)->select();
        $pager = pager($list['num'],$limit);
        $page = $pager->fshow();
        foreach ($list as $k => &$v) {
            $list[$k]['url'] = U('News/show',array('id'=>$v['id']));
        }
        $list['page'] = $page;
        $this->assign('page',$list['page']);
        $this->assign('page_seo',$page_seo);
        $this->assign('list',$list);
        if($id==95){
            $this->display('School/business_plan');
            exit;
        }
        $this->display();
    }

    public function show(){
        $this->display();
    }
}

?>
