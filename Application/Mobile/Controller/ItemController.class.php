<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class itemController extends MobileController{
    // 初始化函数
    public function _initialize(){
        parent::_initialize();
        if(I('get.code','','trim')){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding');
        }
    }

    public function item_list(){
        $page_seo['header_title']='选项目';
        $k=I('get.k','');
        $province_id=I('get.province_id','');
        $industry_id=I('get.industry_id','');
        $xmrz_type=I('get.xmrz_type','');
        $mo=I('get.mo','');
        if(!empty($k)){
             $where['bi.title'] =array('like','%'.$k.'%');
        }
        if(!empty($province_id)){
             $where['bi.province_id'] = $province_id;
        }
        if(!empty($industry_id)){
             $where['ii.industry_id'] = $industry_id;
        }
        if(!empty($xmrz_type)){
             $where['ii.xmrz_type'] = $xmrz_type;
        }
        if(!empty($xmrz_type)){
             $where['bi.amount_range'] = $mo;
        }
        $category = F('category');
        $list = R('Common/Api/item_list',[$where]);
        $limit=10;
        $pager = pager($list['num'],$limit);
        $page = $pager->fshow();
        $this->assign('num',$list['num']);
        $this->assign('item_list',$list['item_list']);
        $this->assign('page_seo',$page_seo);
        $this->assign('page',$page);
        $this->assign('category',$category);
        $this->display('index');
    }

    public function item_show(){
        $page_seo['header_title']='项目详情';
        $category = F('category');
        $province = array_flip(F('province'));
        $city = array_flip(F('city'));
        $area = array_flip(F('area'));
        $money_unit = array(1=>'万',10000=>'亿');
        $this->assign('category',$category);
        $id = I('get.id');
        if(!$id){
            $this->error('信息不存在');
        }
        $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ ii on bi.id =ii.id')->where(['bi.id'=>$id])->find();
        if($info['amount_interval_min'] ==$info['amount_interval_max'] && $info['amount_interval_min_unit'] ==$info['amount_interval_max_unit']){
                unset($info['amount_interval_max'],$info['amount_interval_max_unit']);
        }
           if($info['province_id']){
                $province_id = $province[$info['province_id']];
           }
           if($info['city_id']){
                $city_id = $city[$info['city_id']];
           }
           if($info['area_id']){
                $area_id = $area[$info['area_id']];
           }
           $info['area'] = $province_id.$city_id.$area_id;
        if($info){
            //更新访问计数
            $viewsData=array();
            $viewsData['click'] = array('exp','click+1');
            $viewsData['id'] = $info['id'];
            D('BaseInfo')->editData($viewsData);
        }
        $info['info_type'] = $category['info_type'][$info['info_type']];
        $info['amount_interval_min_unit'] = ($category['money_unit'][$info['amount_interval_min_unit']]);
        $info['amount_interval_max_unit'] = ($category['money_unit'][$info['amount_interval_max_unit']]);
        $info['xmrz_body'] = $category['xmrz_body'][$info['xmrz_body']];
        $info['xmrz_intention'] = field_get_name($info['xmrz_intention'],$field='xmrz_intention');
        $xmrz_type = explode(',', $info['xmrz_type']);
        $info['xmrz_type'] = field_get_name($info['xmrz_type'],$field='xmrz_type');
        $info['industry_id'] = $category['industry_id'][$info['industry_id']];
        $info['xmgq_period'] = $category['xmgq_period'][$info['xmgq_period']];
        $info['i_overview'] = nl2br($info['i_overview']);
        $info['s11'] = field_get_name($info['s11'],$field='s11');
        $info['s19'] = field_get_name($info['s19'],$field='s19');
        $this->assign('page_seo',$page_seo);
        $this->assign('info',$info);
        $this->assign('xmrz_type',$xmrz_type);
        $this->display();
    }

}

?>