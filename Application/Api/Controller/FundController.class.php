<?php
namespace Api\Controller;
class FundController{
    
    function fund_list($where=array()){
        $page = I('get.p','');
        $category = F('category');
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where()->count();
        $limit=10;
        $pager = new \Think\Page($count,$listRows);
        $pager = pager($count,$limit);
        $fund_list = M('BaseInfo')->alias('bi')->join('inner JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.info_type,bi.title,fi.funds_body,fi.tz_industry,fi.tz_area,bi.amount_interval_min,bi.amount_interval_min_unit,bi.amount_interval_max,bi.amount_interval_max_unit,amount_range,addtime,updatetime,bi.trj_info_id,fi.id as fid')->where($where)->limit($pager->firstRow.','.$pager->listRows)->select();
        $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id,city_id,area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>1])->select();
        $fund_list = array_link($fund_list,array_key($member_list,'trj_info_id'),'trj_info_id');
        foreach ($fund_list as $k => $v) {
            $fund_list[$k]['tz_industry'] =field_get_name($v['tz_industry'],$field='tz_industry',$ext_field='',$ext_condition=1);
            $fund_list[$k]['tz_area'] =field_get_name($v['tz_area'],$field='tz_area',$ext_field='province',$ext_condition=1);
            $fund_list[$k]['funds_body']=$category['funds_body'][$v['funds_body']];
            $fund_list[$k]['amount_interval_min_unit'] =$category['money_unit'][$v['amount_interval_min_unit']];
            $fund_list[$k]['amount_interval_max_unit'] =$category['money_unit'][$v['amount_interval_max_unit']];
            $fund_list[$k]['info_type'] =$category['info_type'][$v['info_type']];
            $fund_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            $fund_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
        }
        $arr['num'] =$count;
        $arr['fund_list'] =$fund_list;
        if($arr['fund_list']){
            $arr['code']=200;
        }else{
            $arr['code']=0;
        }
        //sleep(1);
        header('Content-type:text/json');
        exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

    public function show($id){
        $category = F('category');
        $id = intval($id);
        $login_id = C('visitor.uid');
        $money_unit = array(1=>'万',10000=>'亿');
        $sex_cn = array(0=>'nan',1=>'nv');
        if($info_type==2){
            redirect(U('Item/show',array('id'=>$id)));
        }
        if($id){
           $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where(['bi.id'=>$id])->find();
           $info = fund_info_tz_area($info);
           $info['area'] = link_area($info['province_id'],$info['city_id'],$info['area_id']);
           if($info['uid']){
                $member_info = M('Members')->field('uid as m_uid,utype,username,realname,sex,province_id as province_id_u,city_id as city_id_u,area_id as area_id_u,trj_info_id,job,company_name,trj_company_id')->where(['utype'=>1,'uid'=>$info['uid']])->find();
           }
           $info = array_merge_multi($info,$member_info);
           $info['surname'] = split_name($info['realname']);
           $province = array_flip(F('province'));
           $city = array_flip(F('city'));
           $area = array_flip(F('area'));
           if($info['province_id_u']){
                $province_id_u = $province[$info['province_id_u']];
           }
           if($info['city_id_u']){
                $city_id_u = $city[$info['city_id_u']];
           }
           if($info['area_id_u']){
                $area_id_u = $area[$info['area_id_u']];
           }
           $info['user_area'] = $province_id_u.$city_id_u.$area_id_u;
           $info['i_overview'] = nl2br($info['i_overview']);
           $info['i_introduce'] = nl2br($info['i_introduce']);
           $info['i_other_remark'] = nl2br($info['i_other_remark']);
           $info['funds_body_cn'] = field_get_name($info['funds_body'],$field='funds_body');
           $info['tz_industry'] = field_get_name($info['tz_industry'],$field='tz_industry');
           $info['zjf_tz_type'] = field_get_name($info['zjf_tz_type'],$field='zjf_tz_type');
           $info['zjf_tz_period'] = field_get_name($info['zjf_tz_period'],$field='zjf_tz_period');
           $info['s100'] = field_get_name($info['s100'],$field='S100');
           $info['s201'] = field_get_name($info['s201'],$field='S201');
           $info['i_keywords'] = explode('，',str_replace('标签：','',$info['i_keywords']));
           $info['login_id'] = $login_id;
           if($info['amount_interval_min'] ==$info['amount_interval_max'] && $info['amount_interval_min_unit'] ==$info['amount_interval_max_unit']){
                unset($info['amount_interval_max'],$info['amount_interval_max_unit']);
           }
           $info['amount_interval_min_unit'] = $money_unit[$info['amount_interval_min_unit']];
           $info['sex_cn'] = $sex_cn[$info['sex']];
           $info['amount_interval_max_unit'] = $money_unit[$info['amount_interval_max_unit']];
            if($info){
                //更新访问计数
                $viewsData=array();
                $viewsData['click'] = array('exp','click+1');
                $viewsData['id'] = $info['id'];
                D('BaseInfo')->editData($viewsData);
            }
            if($info){
                $arr['code']=200;
                $arr['info']=$info;
            }else{
                $arr['code']=0;
            }
            header('Content-type:text/json');
            exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
       }
   }
}
?>