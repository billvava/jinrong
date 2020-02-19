<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class FundController extends FrontendController{
    	
    public function _initialize(){
    		parent::_initialize();
    }

    function fund_list($sort=''){
        if(!I('get.org','','trim') && C('PLATFORM') == 'mobile'&& $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Fund','a'=>'fund_list')));
        }
        $category = F('category');
        $where = array();
        $info_type = I('get.info_type','2010');
        $k=I('get.k','','trim');
        $funds_body = I('get.funds_body','');
        $province_id = I('get.province_id','');
        $tz_industry = I('get.tz_industry','');
        $tz_area = I('get.tz_area','');
        $mo = I('get.mo','');
        $where['bi.type'] = 1;
        if(!empty($info_type)){
            $where['bi.info_type'] = $info_type;
        }
        if(!empty($k)){
             $where['bi.title'] =array('like','%'.$k.'%');
        }
        if(!empty($funds_body)){
            $where['fi.funds_body'] = $funds_body;
        }
        if(!empty($province_id)){
            $where['bi.province_id'] = $province_id;
        }
        if(!empty($tz_industry)){
            $where['fi.tz_industry'] = $tz_industry;
        }
        if(!empty($tz_area)){
            $where['fi.tz_area']  = array('like',"%$tz_area%");
        }
        if(!empty($mo)){
            $where['bi.amount_range'] = $mo;
        }
        $where['bi.is_open'] = 1;
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where($where)->count();
        $limit = $this->getPageLimit($count,20);
        if($count>3000){
            $count = '3000+';
        }
        $order = I('get.sort','');
        if(!isset($order) || empty($order)){
            $order = 'updatetime desc';
        }
        if($order=='rtime'){
            $order = 'addtime desc';
        }
        $page = $this->getPageShow($pageMaps);
        $fund_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.info_type,bi.title,fi.funds_body,fi.tz_industry,fi.tz_area,bi.amount_interval_min,bi.amount_interval_min_unit,bi.amount_interval_max,bi.amount_interval_max_unit,amount_range,addtime,updatetime,bi.trj_info_id,bi.uid')->where($where)->order($order)->limit($limit)->select();
          /*
          foreach ($fund_list as $k => $v) {
              $in[] = $v['uid'];
          }
          */
          //$inn['uid'] = array('in',$in);
          //$member_list = M('Members')->field('uid,utype,username,realname,sex,province_id,city_id,area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>1])->where($inn)->select();
          $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id,city_id,area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>1])->select();
          $fund_list = array_link($fund_list,array_key($member_list,'uid'),'uid');
      foreach ($fund_list as $k => $v){
            $fund_list[$k]['tz_industry'] =field_get_name($v['tz_industry'],$field='tz_industry',$ext_field='',$ext_condition=1);
            $fund_list[$k]['tz_area'] =field_get_name($v['tz_area'],$field='tz_area',$ext_field='province',$ext_condition=1);
            $fund_list[$k]['funds_body']=$category['funds_body'][$fund_list[$k]['funds_body']];
            $fund_list[$k]['amount_interval_min_unit'] =$category['money_unit'][$v['amount_interval_min_unit']];
            $fund_list[$k]['amount_interval_max_unit'] =$category['money_unit'][$v['amount_interval_max_unit']];
            $fund_list[$k]['info_type'] =$category['info_type'][$v['info_type']];
            $fund_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            if($v['updatetime'] != 0){
                $fund_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
            }
      }
        $where_1['type'] = 1;
        $where_1['is_top'] = 1 ;
        $recommend_funder = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.title,bi.addtime,bi.updatetime,bi.type,bi.is_top,bi.top_img,fi.tz_industry,fi.tz_area')->where($where_1)->limit(10)->select();
        foreach ($recommend_funder as $k => $v) {
            $recommend_funder[$k]['tz_industry'] =field_get_name($v['tz_industry'],$field='tz_industry',$ext_field='',$ext_condition=1);
            $recommend_funder[$k]['tz_area'] =field_get_name($v['tz_area'],$field='tz_area',$ext_field='province',$ext_condition=1);
        }
        $this->assign('recommend_funder',$recommend_funder);
        $this->assign('fund_list',$fund_list);
        $this->assign('category',$category);
        $this->assign('page', $page);
        $this->assign('count',$count);
        $this->display('fund_list_'.$info_type);
  }


  function tag_list($id=''){
      $info = M('BaseInfo')->field('id,i_keywords')->where(['id'=>$id])->find();
      //$info['i_keywords'] = explode('，',str_replace('标签：','',$info['i_keywords']));
      //$info['i_keywords'] = implode(',',$info['i_keywords']);
      //$where['i_keywords']  = array('like',"%$info.i_keywords]%");
      $tag_list = M('BaseInfo')->field('id,title,i_keywords')->where($where)->limit(10)->order(rand())->select();
      $this->assign('tag_list');
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
        if(C('visitor.uid')){
            if($info['trj_company_id']==0){
                $view_log = M('ViewInfo')->where(array('uid'=>C('visitor.uid'),'info_id'=>$info['id']))->find();
            }else{
                $view_log = M('ViewInfo')->where(array('uid'=>C('visitor.uid'),'info_user_id'=>$info['trj_company_id'],'info_id'=>$info['id']))->find();
            }
            if($view_log){
                M('ViewInfo')->where(array('uid'=>C('visitor.uid'),'info_id'=>$info['id']))->setField('addtime',time());
            }else{
                M('ViewInfo')->add(array('uid'=>C('visitor.uid'),'info_user_id'=>$info['trj_company_id'],'info_id'=>$info['id'],'addtime'=>time()));
            }
        }
		}   

           $this->_history($id);
           $_history = cookie('fund_history');
        if($_history){
            $map = array();
            $map['id'] = array("IN", $_history);
            $historys = M('BaseInfo')->where($map)->limit(10)->select();
            foreach ($historys as $key => $value) {
              $v = M('BaseInfo')->field('id,title')->where(['id'=>$value['id']])->find();
              $historys[$key] = $v;
            }
        }
        //$info['i_keywords'] = explode('，',str_replace('标签：','',$info['i_keywords']));
       //$info['i_keywords'] = implode(',',$info['i_keywords']);
       //$where['i_keywords']  = array('like',"%$info.i_keywords]%");
        $tag_list = M('BaseInfo')->field('id,title,i_keywords,amount_interval_max,amount_interval_max_unit,amount_interval_min,amount_interval_min_unit')->where()->limit(4)->order('rand()')->select();
        foreach ($tag_list as $k => &$v){
            if($v['amount_interval_min']==$v['amount_interval_max'] && $v['amount_interval_min_unit']==$v['amount_interval_max_unit']){
                unset($v['amount_interval_max']);
                unset($v['amount_interval_max_unit']);
            }else{
              $tag_list[$k]['amount_interval_max_unit'] =$category['money_unit'][$v['amount_interval_max_unit']];
            }
            $tag_list[$k]['amount_interval_min_unit'] =$category['money_unit'][$v['amount_interval_min_unit']];
        }
        $this->assign('tag_list',$tag_list);
        $this->assign("historys",$historys);
        $this->assign('info',$info);
        $page_seo=['title'=>$info['title']];
        $this->assign('page_seo',$page_seo);
        $msg_list = M('InfoConsult')->where(['info_id'=>$info['id'],'public'=>1])->select();
        foreach ($msg_list as $k => $v) {
            $temp[] = $v['uid'];
        }
        $temp = array_unique($temp);
        $temp = implode(',',$temp);
        $map['uid'] = array('in',$temp);
        $msg_user = M('Members')->field('uid,utype,realname,sex')->where($map)->select();
        $msg_list = array_link($msg_list, array_key($msg_user,'uid'),'uid');
        $this->assign('msg_list',$msg_list);
		    $this->display();
	   }
     
    function _history($id = 0) {
		$id = (int) $id;
		if($id < 1) return false;
		$_history = cookie('fund_history');
		$_history = str2arr($_history);
		if(empty($_history) || !in_array($id, $_history)) {
			$_history[] = $id;
		}
		$_history=array_reverse($_history);
			while (count($_history) > 10){
			array_pop($_history);
		}		
		cookie('fund_history', arr2str($_history));
		return true;
	}
    


    //二维数组排序
    function arr_sort($array,$key,$order="asc"){
        //asc是升序 desc是降序
        $arr_nums=$arr=array();
        foreach($array as $k=>$v){
            $arr_nums[$k]=$v[$key];
        }
        if($order=='asc'){
            asort($arr_nums);
        }else{
            arsort($arr_nums);
        }
        foreach($arr_nums as $k=>$v){
            $arr[$k]=$array[$k];
        }
        return $arr;
    }


}
?>