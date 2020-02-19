<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class fundController extends MobileController
{
    // 初始化函数
    public function _initialize(){
        parent::_initialize();
        if(I('get.code','','trim')){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding');
        }
    }

    public function fund_list(){
        $page_seo['header_title']='找资金';
        $k=I('get.k','','trim');
        $province_id=I('get.province_id','');
        $mo=I('get.mo','');
        $info_type=I('get.info_type','');
        $atttz_industry=I('get.atttz_industry','');
        if(!empty($k)){
             $where['bi.title'] =array('like','%'.$k.'%');
        }
        if(!empty($province_id)){
             $where['bi.province_id'] =$province_id;
        }
        if(!empty($mo)){
             $where['bi.amount_range'] =$mo;
        }
        if(!empty($info_type)){
             $where['bi.info_type'] =$info_type;
        }
        if(!empty($atttz_industry)){
             $where['fi.info_type'] =$atttz_industry;
        }
        $category = F('category');
        $province = implode(",",$category['province']);
        $list = R('Common/Api/fund_list',[$where]);
        $this->assign('num',$list['num']);
        $limit=10;
        $pager = pager($list['num'],$limit);
        $page = $pager->fshow();
        $this->assign('fund_list',$list['fund_list']);
        $this->assign('province',$province);
        $this->assign('page_seo',$page_seo);
        $this->assign('category',$category);
        $this->assign('page',$page);
        $this->display('index');
    }

    public function fund_show(){
        $category = F('category');
        $money_unit = array(1=>'万',10000=>'亿');
        $this->assign('category',$category);
        $page_seo['header_title']='资金详情';
        $id = I('get.id');
        if(!$id){
            $this->error('信息不存在');
        }
        $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where(['bi.id'=>$id])->find();
        if($info['amount_interval_min'] ==$info['amount_interval_max'] && $info['amount_interval_min_unit'] ==$info['amount_interval_max_unit']){
                unset($info['amount_interval_max'],$info['amount_interval_max_unit']);
        }
        $info['amount_interval_min_unit'] = $money_unit[$info['amount_interval_min_unit']];
        $info['amount_interval_max_unit'] = $money_unit[$info['amount_interval_max_unit']];
        $info['s100'] = field_get_name($info['s100'],$field='S100');
           $info['s201'] = field_get_name($info['s201'],$field='S201');
        $info['tz_industry'] = field_get_name($info['tz_industry'],$field='tz_industry');
        $info['zjf_tz_type'] = field_get_name($info['zjf_tz_type'],$field='zjf_tz_type');
        $info['zjf_tz_period'] = field_get_name($info['zjf_tz_period'],$field='zjf_tz_period');
        $info['i_keywords'] = explode('，',str_replace('标签：','',$info['i_keywords']));
        $this->assign('info',$info);
        $this->assign('page_seo',$page_seo);
        $this->display('show');
    }
}

?>