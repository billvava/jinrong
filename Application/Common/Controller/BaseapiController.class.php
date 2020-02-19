<?php
namespace Common\Controller;
use Common\Controller\BaseController;
class BaseapiController extends BaseController{
    
	function fund_list($where=array()){
        $category = F('category');
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where($where)->count();
        $limit = $this->getPageLimit($count,20);
        $page = $this->getPageShow($pageMaps);
        $fund_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.info_type,bi.title,fi.funds_body,fi.tz_industry,fi.tz_area,bi.amount_interval_min,bi.amount_interval_min_unit,bi.amount_interval_max,bi.amount_interval_max_unit,amount_range,addtime,updatetime,bi.trj_info_id')->where($where)->limit($limit)->select();
        $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id,city_id,area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>1])->select();
        $fund_list = array_link($fund_list,array_key($member_list,'trj_info_id'),'trj_info_id');
        foreach ($fund_list as $k => $v) {
            $fund_list[$k]['tz_industry'] =field_get_name($v['tz_industry'],$field='tz_industry',$ext_field='',$ext_condition=1);
            $fund_list[$k]['tz_area'] =field_get_name($v['tz_area'],$field='tz_area',$ext_field='province',$ext_condition=1);
            $fund_list[$k]['funds_body']=$category['funds_body'][$fund_list[$k]['funds_body']];
            $fund_list[$k]['amount_interval_min_unit'] =$category['money_unit'][$v['amount_interval_min_unit']];
            $fund_list[$k]['amount_interval_max_unit'] =$category['money_unit'][$v['amount_interval_max_unit']];
            $fund_list[$k]['info_type'] =$category['info_type'][$v['info_type']];
            $fund_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            $fund_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
        }
        $arr['num'] =$count;
        $arr['fund_list'] =$fund_list;
        return $arr;
    }

    function item_list($where=array()){
        $category = F('category');
        $where['bi.type'] = 2;
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->where($where)->count();
        $limit = $this->getPageLimit($count,20);
        $page = $this->getPageShow($pageMaps);
        $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.trj_info_id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,bi.province_id,ii.industry_id,ii.xmrz_type,bi.info_type,bi.addtime,bi.updatetime')->limit($limit)->where($where)->where(['bi.type'=>2])->select();
        foreach ($info_list as $k => &$v){
            if($v['amount_interval_min']==$v['amount_interval_max'] && $v['amount_interval_min_unit']==$v['amount_interval_max_unit']){
                unset($v['amount_interval_max']);
                unset($v['amount_interval_max_unit']);
            }
            $info_list[$k]['amount_interval_min_unit'] =$category['money_unit_min'][$v['amount_interval_min_unit']];
            $info_list[$k]['industry_id'] =$category['industry_id'][$v['industry_id']];
            $info_list[$k]['amount_interval_max_unit'] =$category['money_unit_min'][$v['amount_interval_max_unit']];
            $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
            $info_list[$k]['xmrz_type'] = field_get_name($v['xmrz_type'],$field='xmrz_type');
            $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
        }
        $arr['num'] =$count;
        $arr['item_list'] =$info_list;
        return $arr;
    }

    function send_email(){
        $tpl=$this->fetch('Common/ajax_send_email');
        $this->ajaxReturn(1,'修改密码弹窗获取成功！',$tpl);
    }

    //收藏
    public function collection(){ 
        if(IS_POST){
            $data = $_POST;
            $collector_id = $data['collector_id'];
            $info_id = $data['info_id'];
            $res = M("collection")->where(["collector_id"=>$collector_id,"info_id"=>$info_id])->select();
            $data['addtime'] = time();
            if(empty($res)){
              M("collection")->add($data);
              $this->ajaxReturn(array('msg'=>1));
            }
            $this->ajaxReturn(array('msg'=>0));
        }else{
            $status = I('status');
            if($status == 1){
                $html = $this->fetch('AjaxCommon/collection_success');
                $this->ajaxReturn(1,'获取数据成功！',$html);
            }else{
                $html = $this->fetch('AjaxCommon/collection_error');
                $this->ajaxReturn(1,'获取数据成功！',$html);
            }
        }
    }

}
?>