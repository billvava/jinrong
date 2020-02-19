<?php
namespace Api\Controller;
class ItemController{
    
    function item_list($where=array()){
        $category = F('category');
        $where['bi.type'] = 2;
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->where($where)->count();
        $limit=10;
        $pager = new \Think\Page($count,$listRows);
        $pager = pager($count,$limit);
        $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.trj_info_id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,bi.province_id,ii.industry_id,ii.xmrz_type,bi.info_type,bi.addtime,bi.updatetime')->limit($pager->firstRow.','.$pager->listRows)->where($where)->where(['bi.type'=>2])->select();
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
        if($arr['item_list']){
            $arr['code']=200;
        }else{
            $arr['code']=0;
        }
        header('Content-type:text/json');
        exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
        //exit(json_encode_no_zh($arr));
    }

    public function show($id){
        $category = F('category');
        $id = intval($id);
        $login_id = C('visitor.uid');
        $money_unit = array(1=>'万',10000=>'亿');
        $sex_cn = array(0=>'nan',1=>'nv');
        if($id){
           $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ ii on bi.id =ii.id')->where(['bi.id'=>$id])->find();
           $info = fund_info_tz_area($info);
           $info['area'] = link_area($info['province_id'],$info['city_id'],$info['area_id']);
           if($info['amount_interval_min'] ==$info['amount_interval_max'] && $info['amount_interval_min_unit'] ==$info['amount_interval_max_unit']){
                unset($info['amount_interval_max'],$info['amount_interval_max_unit']);
        }

        if($info){
            //更新访问计数
            $viewsData=array();
            $viewsData['click'] = array('exp','click+1');
            $viewsData['id'] = $info['id'];
            D('BaseInfo')->editData($viewsData);
        }
        $info['info_type'] = $category['info_type'][$info['info_type']];
        $info['amount_interval_min_unit'] = ($category['money_unit_min'][$info['amount_interval_min_unit']]);
        $info['amount_interval_max_unit'] = ($category['money_unit_min'][$info['amount_interval_max_unit']]);
        $info['xmrz_body'] = $category['xmrz_body'][$info['xmrz_body']];
        $info['xmrz_intention'] = field_get_name($info['xmrz_intention'],$field='xmrz_intention');
        $xmrz_type = explode(',', $info['xmrz_type']);
        $info['xmrz_type'] = field_get_name($info['xmrz_type'],$field='xmrz_type');
        $info['industry_id'] = $category['industry_id'][$info['industry_id']];
        $info['xmgq_period'] = $category['xmgq_period'][$info['xmgq_period']];
        $info['i_overview'] = nl2br($info['i_overview']);
        $info['s11'] = field_get_name($info['s11'],$field='s11');
        $info['s19'] = field_get_name($info['s19'],$field='s19');

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
           $info['sex_cn'] = $sex_cn[$info['sex']];
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
           //json_encode_no_zh($arr));
            exit(json_encode($arr, JSON_UNESCAPED_UNICODE));
       }
   }
}
?>