<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class ItemController extends FrontendController{
	function _initialize() {
        parent::_initialize();
    }

    function item_list(){
        if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Item','a'=>'index')));
        }
        $category = F('category');
        $where = array();
        $k=I('get.k','','trim');
        $industry_id = I('get.industry_id','');
        $province_id = I('get.province_id','');
        $xmrz_type = I('get.xmrz_type','');
        $developer_rank = I('get.developer_rank','');
        $info_type = I('get.info_type','1');
        $mo = I('get.mo','');
        if(!empty($k)){
             $where['bi.title'] =array('like','%'.$k.'%');
        }
        if(!empty($info_type)){
             $where['bi.info_type'] =$info_type;
        }
        if(!empty($industry_id)){
            $where['ii.industry_id'] = $industry_id;
        }
        if(!empty($province_id)){
            $where['bi.province_id'] = $province_id;
        }
        if(!empty($xmrz_type)){
            $where['ii.xmrz_type'] = $xmrz_type;
        }
        if(!empty($mo)){
            $where['bi.amount_range'] = $mo;
        }

        if(!empty($developer_rank)){
            $where['bi.developer_rank'] = $developer_rank;
        }

        $where['bi.type'] = 2;
        $where['bi.is_open'] = 1;
        switch ($info_type) {
            case 200:
            $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->where($where)->count();
                break;
            case 700:
            $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->where($where)->count();
                break;
            case 2005:
            $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_TZLC__ as iit on bi.id = iit.id')->where($where)->count();
                break;
            default:
                $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->where($where)->count();
                break;
        }
        $limit = $this->getPageLimit($count,20);
        if($count>3000){
            $count = '3000+';
        }
        $order = I('get.sort');
        if(!isset($order) || empty($order)){
            $order = 'updatetime desc';
        }
        if($order=='rtime'){
            $order = 'addtime desc';
        }
        switch ($info_type) {
            case 200:
                
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->field('bi.title,iiz.xmzc_assass,iiz.xmzc_assass_unit,iiz.transfer_price,iiz.transfer_price_unit,iiz.xmzc_type,iiz.trade_way,bi.id,bi.trj_info_id,bi.addtime,bi.updatetime,bi.province_id')->limit($limit)->where($where)->where(['bi.type'=>2,'bi.info_type'=>200])->order($order)->select();
               
                // print_r($info_list);exit;
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
                foreach ($info_list as $k => &$v){
                    $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
                    $info_list[$k]['developer_rank'] =$category['developer_rank'][$v['developer_rank']];
                    $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
                    $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
                     $info_list[$k]['xmzc_assass_unit'] =$category['money_unit_min'][$v['xmzc_assass_unit']];
                     $info_list[$k]['transfer_price_unit'] =$category['money_unit_min'][$v['transfer_price_unit']];
                     $info_list[$k]['xmzc_type'] =$category['trade_category'][$v['xmzc_type']];
                     $info_list[$k]['trade_way'] = field_get_name($v['trade_way'],$field='trade_way');
                }
                break;
            case 700:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->field('bi.id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,iiz.xmf_zs_way,bi.addtime,bi.updatetime,bi.province_id,iiz.xmf_zs_way')->limit($limit)->where($where)->where(['bi.type'=>2,'bi.info_type'=>700])->order($order)->select();
                $item_info = M('ItemInfo')->field('id,industry_id')->select();
                $info_list = array_link($info_list,array_key($item_info,'id'),'id');
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
                foreach ($info_list as $k => &$v){
                    if(($v['amount_interval_min']==$v['amount_interval_max']) && ($v['amount_interval_min_unit']==$v['amount_interval_max_unit'])){
                        unset($v['amount_interval_max']);
                        unset($v['amount_interval_max_unit']);
                    }
                    if($v['amount_interval_min'] == $v['amount_interval_max'] && $v['amount_interval_min'] == 0) unset($v['amount_interval_min'],$v['amount_interval_max']);

                    $info_list[$k]['amount_interval_min_unit'] =$category['money_unit_min'][$v['amount_interval_min_unit']];
                    $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
                    $info_list[$k]['developer_rank'] =$category['developer_rank'][$v['developer_rank']];
                    $info_list[$k]['industry_id'] =$category['industry_id'][$v['industry_id']];
                    $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
                    $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
                }
                break;
            case 2005:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_TZLC__ as iit on bi.id = iit.id')->field('')->limit($limit)->where($where)->where(['bi.type'=>2,'bi.info_type'=>2005])->order($order)->select();
                /*
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
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
                */
                break;
            default:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.trj_info_id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,bi.province_id,ii.industry_id,ii.developer_rank,ii.xmrz_type,bi.info_type,bi.addtime,bi.updatetime')->limit($limit)->where($where)->where(['bi.type'=>2])->order($order)->select();
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
                foreach ($info_list as $k => &$v){
                    if($v['amount_interval_min']==$v['amount_interval_max'] && $v['amount_interval_min_unit']==$v['amount_interval_max_unit']){
                        unset($v['amount_interval_max']);
                        unset($v['amount_interval_max_unit']);
                    }
                    $info_list[$k]['amount_interval_min_unit'] =$category['money_unit_min'][$v['amount_interval_min_unit']];
                    $info_list[$k]['industry_id'] =$category['industry_id'][$v['industry_id']];
                    $info_list[$k]['developer_rank'] =$category['developer_rank'][$v['developer_rank']];
                    $info_list[$k]['amount_interval_max_unit'] =$category['money_unit_min'][$v['amount_interval_max_unit']];
                    $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
                    $info_list[$k]['xmrz_type'] = field_get_name($v['xmrz_type'],$field='xmrz_type');
                    $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
                    $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
                }
                break;
        }
        $where_1['type'] = 2;
        $where_1['is_top'] = 1 ;
        $where_1['top_img'] = ['neq',''] ;
        $page = $this->getPageShow($pageMaps);
        $this->assign('page',$page);
        $recommend_item = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.title,bi.addtime,bi.updatetime,bi.type,bi.is_top,bi.top_img,bi.province_id,ii.industry_id')->where($where_1)->limit(10)->select();
        $this->assign('count',$count);
        $this->assign('recommend_item',$recommend_item);
        $this->assign('category',$category);
        $this->assign('info_list',$info_list);
        
        $this->display('item_list_'.$info_type);
    }

    //智能匹配
    function compatible(){
        if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url(array('c'=>'Item','a'=>'index')));
        }
        $uid = C('visitor.uid');
        $keywords_array = M('BaseInfo')-> where(['uid' => $uid]) -> field('keywords') -> order('id desc') -> find();
        $keywords = $keywords_array['keywords'];

        $category = F('category');
        $where = array();
        $k=I('get.k','','trim');
        $industry_id = I('get.industry_id','');
        $province_id = I('get.province_id','');
        $xmrz_type = I('get.xmrz_type','');
        $developer_rank = I('get.developer_rank','');
        $info_type = I('get.info_type','1');
        $mo = I('get.mo','');
        if(!empty($keywords)){
            $where['bi.keywords'] = array('like','%'.$keywords.'%');
        }
        if(!empty($k)){
             $where['bi.title'] =array('like','%'.$k.'%');
        }
        if(!empty($info_type)){
             $where['bi.info_type'] =$info_type;
        }
        if(!empty($industry_id)){
            $where['ii.industry_id'] = $industry_id;
        }
        if(!empty($province_id)){
            $where['bi.province_id'] = $province_id;
        }
        if(!empty($xmrz_type)){
            $where['ii.xmrz_type'] = $xmrz_type;
        }
        if(!empty($mo)){
            $where['bi.amount_range'] = $mo;
        }

        if(!empty($developer_rank)){
            $where['bi.developer_rank'] = $developer_rank;
        }

        $where['bi.type'] = 2;
        $where['bi.is_open'] = 1;
        switch ($info_type) {
            case 200:
            $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->where($where)->count();
                break;
            case 700:
            $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->where($where)->count();
                break;
            case 2005:
            $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_TZLC__ as iit on bi.id = iit.id')->where($where)->count();
                break;
            default:
                $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->where($where)->count();
                break;
        }
        $limit = $this->getPageLimit($count,20);
        if($count>3000){
            $count = '3000+';
        }
        $order = I('get.sort');
        if(!isset($order) || empty($order)){
            $order = 'updatetime desc';
        }
        if($order=='rtime'){
            $order = 'addtime desc';
        }
        switch ($info_type) {
            case 200:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->field('bi.title,iiz.xmzc_assass,iiz.xmzc_assass_unit,iiz.transfer_price,iiz.transfer_price_unit,iiz.xmzc_type,iiz.developer_rank,iiz.trade_way,bi.id,bi.trj_info_id,bi.addtime,bi.updatetime,bi.province_id')->limit($limit)->where($where)->where(['bi.type'=>2,'bi.info_type'=>200])->order($order)->select();
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
                foreach ($info_list as $k => &$v){
                    $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
                    $info_list[$k]['developer_rank'] =$category['developer_rank'][$v['developer_rank']];
                    $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
                    $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
                     $info_list[$k]['xmzc_assass_unit'] =$category['money_unit_min'][$v['xmzc_assass_unit']];
                     $info_list[$k]['transfer_price_unit'] =$category['money_unit_min'][$v['transfer_price_unit']];
                     $info_list[$k]['xmzc_type'] =$category['trade_category'][$v['xmzc_type']];
                     $info_list[$k]['trade_way'] = field_get_name($v['trade_way'],$field='trade_way');
                }
                break;
            case 700:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ as iiz on bi.id = iiz.id')->field('bi.id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,iiz.xmf_zs_way,bi.addtime,bi.updatetime,bi.province_id,ii.developer_rank,iiz.xmf_zs_way')->limit($limit)->where($where)->where(['bi.type'=>2,'bi.info_type'=>700])->order($order)->select();
                $item_info = M('ItemInfo')->field('id,industry_id')->select();
                $info_list = array_link($info_list,array_key($item_info,'id'),'id');
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
                foreach ($info_list as $k => &$v){
                    if(($v['amount_interval_min']==$v['amount_interval_max']) && ($v['amount_interval_min_unit']==$v['amount_interval_max_unit'])){
                        unset($v['amount_interval_max']);
                        unset($v['amount_interval_max_unit']);
                    }
                    if($v['amount_interval_min'] == $v['amount_interval_max'] && $v['amount_interval_min'] == 0) unset($v['amount_interval_min'],$v['amount_interval_max']);

                    $info_list[$k]['amount_interval_min_unit'] =$category['money_unit_min'][$v['amount_interval_min_unit']];
                    $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
                    $info_list[$k]['developer_rank'] =$category['developer_rank'][$v['developer_rank']];
                    $info_list[$k]['industry_id'] =$category['industry_id'][$v['industry_id']];
                    $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
                    $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
                }
                break;
            case 2005:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_TZLC__ as iit on bi.id = iit.id')->field('')->limit($limit)->where($where)->where(['bi.type'=>2,'bi.info_type'=>2005])->order($order)->select();
                
                break;
            default:
                $info_list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.trj_info_id,bi.title,bi.amount_interval_min,bi.amount_interval_max,bi.amount_interval_min_unit,bi.amount_interval_max_unit,bi.province_id,ii.industry_id,ii.developer_rank,ii.xmrz_type,bi.info_type,bi.addtime,bi.updatetime')->limit($limit)->where($where)->where(['bi.type'=>2])->order($order)->select();
                $member_list = M('Members')->field('uid,utype,username,realname,sex,province_id as u_province_id,city_id as u_city_id,area_id as u_area_id,last_area_id,trj_info_id,company_name,trj_company_id')->where(['utype'=>2])->select();
                $info_list = array_link($info_list,array_key($member_list,'uid'),'uid');
                foreach ($info_list as $k => &$v){
                    if($v['amount_interval_min']==$v['amount_interval_max'] && $v['amount_interval_min_unit']==$v['amount_interval_max_unit']){
                        unset($v['amount_interval_max']);
                        unset($v['amount_interval_max_unit']);
                    }
                    $info_list[$k]['amount_interval_min_unit'] =$category['money_unit_min'][$v['amount_interval_min_unit']];
                    $info_list[$k]['industry_id'] =$category['industry_id'][$v['industry_id']];
                    $info_list[$k]['developer_rank'] =$category['developer_rank'][$v['developer_rank']];
                    $info_list[$k]['amount_interval_max_unit'] =$category['money_unit_min'][$v['amount_interval_max_unit']];
                    $info_list[$k]['province_id'] =$category['province'][$v['province_id']];
                    $info_list[$k]['xmrz_type'] = field_get_name($v['xmrz_type'],$field='xmrz_type');
                    $info_list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
                    $info_list[$k]['updatetime'] = date("Y-m-d",$v['updatetime']);
                }
                break;
        }
        $where_1['type'] = 2;
        $where_1['is_top'] = 1 ;
        $where_1['top_img'] = ['neq',''] ;
        $page = $this->getPageShow($pageMaps);
        $this->assign('page',$page);
        $recommend_item = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id = ii.id')->field('bi.id,bi.title,bi.addtime,bi.updatetime,bi.type,bi.is_top,bi.top_img,bi.province_id,ii.industry_id')->where($where_1)->limit(10)->select();
        $this->assign('count',$count);
        $this->assign('recommend_item',$recommend_item);
        $this->assign('category',$category);
        $this->assign('info_list',$info_list);
        // dump($info_type);exit;
        $this->display('item_list_'.$info_type);
    }
    public function show($id){
        $sex_cn = array(0=>'nan',1=>'nv');
        $category = D('Category');
        if(!$id){
            $this->error('信息不存在');
        }
        $info_type = M('BaseInfo')->where(['id'=>$id])->getField('type');
        if($info_type==1){
            redirect(U('Fund/show',array('id'=>$id)));
        }
        $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ ii on bi.id =ii.id')->where(['bi.id'=>$id])->find();
        $info['area'] = link_area($info['province_id'],$info['city_id'],$info['area_id']);
        if($info['uid']){
                $member_info = M('Members')->field('uid,utype,username,realname,sex,province_id as province_id_u,city_id as city_id_u,area_id as area_id_u,trj_info_id,job,company_name,trj_company_id')->where(['utype'=>2,'uid'=>$info['uid']])->find();
        }
        $info = array_merge_multi($info,$member_info);

        if(($info['amount_interval_min']==$info['amount_interval_max']) && ($info['amount_interval_min_unit']==$info['amount_interval_max_unit'])){
                unset($info['amount_interval_max']);
                unset($info['amount_interval_max_unit']);
        }
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
        if($info){
            //更新访问计数
            $viewsData=array();
            $viewsData['click'] = array('exp','click+1');
            $viewsData['id'] = $info['id'];
            D('BaseInfo')->editData($viewsData);
        }
        /*
        if(C('visitor.uid')){
        $view_log = M('ViewInfo')->where(array('uid'=>C('visitor.uid'),'info_id'=>$info['id']))->find();
            if($view_log){
                M('ViewInfo')->where(array('uid'=>C('visitor.uid'),'info_id'=>$info['id']))->setField('addtime',time());
            }else{
                M('ViewInfo')->add(array('uid'=>C('visitor.uid'),'uid'=>$val['uid'],'info_id'=>$info['id'],'addtime'=>time()));
            }
        }
        */
        if($info['i_pic']){
            $info['i_pic'] = M('Attach')->where(['info_id'=>$info['id'],'attach_type'=>'i_pic'])->select();
            foreach ($info['i_pic'] as $k => $v) {
                $info['i_pic'][$k]['title'] = $info['title'];
            }
        }
        $member = M('members');
        $member_info = $member->field('realname,sex')->where(['uid'=>$info['uid']])->find();
        $member_info['surname'] = split_name($member_info['realname']);
        $category = F('category');
        $Db_caterory = D('category');
        $member_info['sex'] = $category['sex'][$member_info['sex']];
        $info['info_type'] = $category['invest_type'][$info['info_type']];
        $info['amount_interval_min_unit'] = ($category['money_unit'][$info['amount_interval_min_unit']]);
        $info['amount_interval_max_unit'] = ($category['money_unit'][$info['amount_interval_max_unit']]);
        $info['xmrz_body'] = $category['xmrz_body'][$info['xmrz_body']];
        $info['industry_id'] = $category['industry_id'][$info['industry_id']];
        $info['i_overview'] = nl2br($info['i_overview']);
        $info['i_introduce'] = nl2br($info['i_introduce']);
        $info['i_other_remark'] = nl2br($info['i_other_remark']);
        if(!empty($info['s86'])){
            $info['s86'] = nl2br($info['s86']);
        }
        if(!empty($info['s87'])){
            $info['s87'] = nl2br($info['s87']);
        }
        if(!empty($info['s88'])){
            $info['s88'] = nl2br($info['s88']);
        }
        if(!empty($info['s89'])){
            $info['s89'] = nl2br($info['s89']);
        }
		if(!empty($info['s90'])){
            $info['s90'] = nl2br($info['s90']);
        }
        $info['sex_cn'] = isset($sex_cn[$info['sex']])?$sex_cn[$info['sex']]:'nan';
        $info['s11'] = $category['s11'][$info['s11']];
        $this->assign('member_info',$member_info);
        $this->assign('info',$info);
        $page_seo=['title'=>$info['title']];
        $this->assign('page_seo',$page_seo);
        $this->display();
    }

    public function item_trade(){
        $trade_category = I('get.trade_category','');
        $province_id = I('get.province_id','');
        $trade_way = I('get.trade_way','');
        $p = I('get.p');
        if($p>=2){
            $this->error('充值会员可查看更多!',U('Item/item_trade'));
        }
        if($trade_category){
            $where['zcjy.xmzc_type'] = $trade_category;
        }
        if($province_id){
            $where['bi.province_id'] = $province_id;
        }
        if($trade_way){
            $where['zcjy.trade_way'] = $trade_way;
        }
        $where['bi.info_type']=200;
        $category = F('category');
        $province = array_flip(F('province'));
        $count = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ zcjy ON bi.id=zcjy.id')->where($where)->count();
        $limit = $this->getPageLimit($count,8);
        $page = $this->getPageShow($pageMaps);
        $list = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ zcjy ON bi.id=zcjy.id')->where($where)->limit($limit)->order('addtime desc')->select();
        foreach ($list as $k => $v) {
            $list[$k]['small_img'] = M('Attach')->where(['info_id'=>$v['id'],'attach_type'=>'i_pic'])->getField('path');
        }
        $this->assign('category',$category);
        $this->assign('province',$province);
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$list);
        $this->display();
    }

    function trade_show($id){
        if($id){
            $id = (int)$id;
        }
        $category = F('category');
        //print_r($category['trade_way']);
        //exit;
        $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO_ZCJY__ zcjy ON bi.id=zcjy.id')->where(['bi.id' => $id])->find();
        $info['area'] = link_area($info['province_id'],$info['city_id'],$info['area_id']);
        if($info){
            //更新访问计数
            $viewsData=array();
            $viewsData['click'] = array('exp','click+1');
            $viewsData['id'] = $info['id'];
            D('BaseInfo')->editData($viewsData);
        }
        if($info['i_pic']){
            $info['i_pic'] = M('Attach')->where(['info_id'=>$info['id'],'attach_type'=>'i_pic'])->select();
            foreach ($info['i_pic'] as $k => $v) {
                $info['i_pic'][$k]['title'] = $info['title'];
            }
        }
        $info['info_type'] = $category['info_type'][$info['info_type']];
        $info['trade_way'] = $category['trade_way'][$info['trade_way']];
        $info['xmzc_type'] = $category['trade_category'][$info['xmzc_type']];
        $info['xmzc_assass_unit'] = $category['money_unit'][$info['xmzc_assass_unit']];
        $info['transfer_price_unit'] = $category['money_unit'][$info['transfer_price_unit']];
        $info['s62'] = $category['S62'][$info['s62']];
        $this->assign('info',$info);
        $this->display();
    }

    public function get_area_name($area_id){
        if($area_id){
            $category = F('category');
        }
        return $category['province'][$area_id];
    }

    function today_item_num(){
        $now_time = strtotime(date("Y-m-d"));
        $where['updatetime'] = $now_time;
        $count = M('BaseInfo')->where($where)->where(['type'=>2])->count();
        if(!empty($count)){
            $count = str_split($count);
        }
        if($count==0){
            $count=132;
            $count = str_split($count);
        }
        $this->ajaxReturn(1,'加载成功',$count); 
    }

}
?>
