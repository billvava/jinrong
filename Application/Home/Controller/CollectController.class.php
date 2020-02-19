<?php
namespace Home\Controller;
use QL\QueryList;
use QL\Ext\Lib\CurlMulti;
use QL\Ext\Multi;
use Common\Controller\FrontendController;
class CollectController extends FrontendController{

	public function _initialize(){
		parent::_initialize();
	}

    public function read_file(){
        $path = ROOT_PATH.'file'.'/';
        $files_list = scandir($path);
        if(is_array($files_list)){
            $list=array();
            foreach ($files_list as $key => $value) {
                if ($value != "." && $value != ".."){
                    $suffix = substr(strrchr($value, '.'),1);
                    if($suffix!='json'){
                        unset($value);
                    }else{
                        $list[]=$value;
                    }
                }
            }
        }
        foreach ($list as $k => $v) {
            $content[] = file_get_contents($path.$v);
        }
        print_r($content);
        exit;
    }


    public function collect_page(){
        if(IS_POST){
            $id = I('post.id');
            $info_root = ROOT_PATH.'cj_info';
            $base_root = str_replace("\\", '/',$info_root);
            //$this->makedir($info_root);
            //exit;
            /*
            $seller_cur_count = count($place_info);
            if(F('seller_num')!=$seller_cur_count){
                $this->makedir($place_info_dir);
            }
            */
            $file_path = $base_root.'/'.$id;
            $result = $this->collect($id,$type='');
            $info = json_encode_no_zh($result);
            $result = file_put_contents($file_path,$info);
            if($result){
                $this->success('采集成功,正在为您跳转...');
                die();
            }
        }
        $this->display();
    }

    //批量采集
    public function c(){
		$category = F('category');
        $url = 'http://xiangmu.trjcn.com';
        $data = QueryList::Query($url,[
        'url' => ['.w788 h6 a','href',
        ]])->getData(function($item){
        return $item;
    });
    $url_array = array_column($data, 'url');
	$url_array=array_slice($url_array,0,2);
    //$url_array = implode(',',$url_array);
        //多线程扩展
        QueryList::run('Multi',[
        //待采集链接集合
        'list' => $url_array,
        /*
		'list' => [
        'http://xiangmu.trjcn.com/detail_609375.html',
		],
        */
        'curl' => [
            'opt' => array(
                        //这里根据自身需求设置curl参数
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_AUTOREFERER => true,
                        //........
                    ),
            //设置线程数
            'maxThread' => 100,
            //设置最大尝试数
            'maxTry' => 3 
        ],
        'success' => function($a){
            //采集规则
            $rule = array(
				'dt' => ['.detail-left dt','text'],
				'dd' => ['.detail-left dd','text'],
                'title'=>['p .ui-text-blue-2','text'],
                'i_overview_title'=>['#i_overview .title-span','text'],
                'i_overview_content'=>['#i_overview .txt2em p','text'],
                'i_introduce_title'=>['#i_introduce .title-span','text'],
                'i_introduce_content'=>['#i_introduce .txt2em p','text'],
                'i_other_remark_title'=>['#i_other_remark .title-span','text'],
                'i_other_remark_content'=>['#i_other_remark .txt2em p','text'],
                'info_type'=>['p span.m-smMenu:eq(0)','text'],
                'i_keywords'=>['.m-xxfj .col999','text'],
                'addtime'=>['.ui-text-gray time','text'],
                'click'=>['.m-mainLeft .bgFFF .fn-left.fn-mt-10.ui-text-gray','text'],
                );
            $ql = QueryList::Query($a['content'],$rule);
			//$ext_info = QueryList::Query($a['content'],$rule);
            $data = $ql->getData();
			//$temp_ext_info = $ext_info->getData();
			$pipei  = ['项目类型'=>'info_type','所在地区'=>'temp_area_info','交易类别'=>'xmzc_type','所属行业'=>'industry_id','融资用途'=>'xmrz_usage','融资金额'=>'amount_interval','总投金额'=>'amount','意向资金'=>'xmrz_intention','融资方式'=>'xmrz_type','可提供资料'=>'S11','项目所处阶段'=>'xmgq_period','资金方占股比例'=>'S18','投资退出方式'=>'S19','最短退出年限'=>'S20','交易方式'=>'trade_way','转让范围'=>'transfer_type','固定资产'=>'xmzc_assass','转让价格'=>'transfer_price','分类'=>'S62','资产估价'=>'xmzc_assass','保有储量'=>'S71','采矿权证'=>'S66','招商方式'=>'xmf_zs_way','产品类型'=>'tzlc_type','风险偏好'=>'xmlc_fxph','投资门槛'=>'xmlc_tzmk','投资期限'=>'xmlc_tzqx','预期收益率'=>'S159','固定值'=>'S190','浮动范围'=>'S191','管理公司'=>'S180','发行时间'=>'S173','基金规模'=>'S175','投资类型'=>'S176','投资地区'=>'S178','投资行业'=>'S177','融资主体'=>'xmrz_body','资金占用时长'=>'S22','可承担最高利息'=>'S21'];
			foreach ($data as $k => &$v){
            $v['dt'] = $this->strFilter($v['dt']);
            foreach ($pipei as $key => $value) {
               if($v['dt']==$key){
                   $v['dt'] =$value;
                }
            }
            $ext_info[$v['dt']] = $v['dd'];
				unset($v['dt'],$v['dd']);
				if(!$v){
					unset($data[$k] );  
				} 
			}
			$info = array_merge_multi($data[0],$ext_info);
			
			foreach($info as $k => $v){
				if($k=='addtime'){
					$info['addtime'] = strtotime($info['addtime']);
				}
				if($k=='click'){
					$patterns = "/\d+/";
					$click = explode(" ",$info['click']);
					preg_match_all($patterns,$info['click'],$arr);
					$info['click'] = end($arr[0]);
				}
				
				if($k == 'xmrz_body'){
					$category = F('category');
					$financing_body = array_flip($category['financing_body']);
					$info['xmrz_body'] = $financing_body[$info['xmrz_body']];
				}
				if($k == 'xmrz_intention'){
					if($info['xmrz_intention']=='不限'){
						$info['xmrz_intention']='617';
					}else{
						$info['xmrz_intention'] = D('Category')->findRecord_name($info['xmrz_intention'],$ext='funds_body');
					}
				}
				if($k == 'amount'){
					$category = F('category');
					$patterns = "/\d+/";
					preg_match_all($patterns,$info['amount'],$arr);
					$amount = implode(" ",$arr[0]);
					$info['amount_unit'] = str_replace($amount,'',$info['amount']);
					$money_unit = array_flip($category['money_unit']);
					$info['amount_unit'] = $money_unit[$info['amount_unit']];
					$info['amount'] = $amount;
				}
				if($k == 'amount_interval'){
					$info = amount_interval_do($info,$empty=1);
				}
				if($k=='xmrz_type'){
					//$info['xmrz_type'] = D('Category')->findRecord_name($info['xmrz_type'],$ext='xmrz_type');
					//$info = ext_info_do($info,$field='xmrz_type');
				}
				if($k=='info_type'){
					$category = F('category');
					$info_type = array_flip($category['invest_type']);
					$info['info_type'] = $info_type[$info['info_type']];
				}
                if($k=='temp_area_info'){
                    $info = area_do($info,$field='temp_area_info');
                }
				
            }
			print_r($info);
			
        }
    ]);
    }


    public function item_collect($id='',$type=''){
        $category = F('category');
        if($id){
            $id = $id;
        }else{
            $id = I('get.id');
        }
        if(!$id){
            echo "id不存在";
            exit;
        }
        $url = 'http://xiangmu.trjcn.com/detail_'.$id.'.html';
        $rules=[
        'dt' => array('.detail-left dt','text'),
        'dd' => array('.detail-left dd','text'),
        ];
        $temp_ext_info = QueryList::Query($url,$rules)->getData(function($info){
            return $info;
        });
        $pipei  = ['项目类型'=>'info_type','所在地区'=>'temp_area_info','交易类别'=>'xmrz_body','所属行业'=>'industry_id','融资用途'=>'xmrz_usage','融资金额'=>'amount_interval','总投金额'=>'amount','意向资金'=>'xmrz_intention','融资方式'=>'xmrz_type','可提供资料'=>'S11','项目所处阶段'=>'xmgq_period','资金方占股比例'=>'S18','投资退出方式'=>'S19','最短退出年限'=>'S20','交易方式'=>'trade_way','转让范围'=>'transfer_type','固定资产'=>'xmzc_assass','转让价格'=>'transfer_price','分类'=>'S62','资产估价'=>'xmzc_assass','保有储量'=>'S71','采矿权证'=>'S66','招商方式'=>'xmf_zs_way','产品类型'=>'tzlc_type','风险偏好'=>'xmlc_fxph','投资门槛'=>'xmlc_tzmk','投资期限'=>'xmlc_tzqx','预期收益率'=>'S159','固定值'=>'S190','浮动范围'=>'S191','管理公司'=>'S180','发行时间'=>'S173','基金规模'=>'S175','投资类型'=>'S176','投资地区'=>'S178','投资行业'=>'S177'];
        foreach ($temp_ext_info as $k => &$v){
            $v['dt'] = $this->strFilter($v['dt']);
            foreach ($pipei as $key => $value) {
               if($v['dt']==$key){
                   $v['dt'] =$value;
                }
            }
            $ext_info[$v['dt']] = $v['dd'];
            unset($temp_ext_info);
        }
        $rules1=[
        'title'=>['p .ui-text-blue-2','text'],
        'i_overview_title'=>['#i_overview .title-span','text'],
        'i_overview_content'=>['#i_overview .txt2em p','text'],
        'i_introduce_title'=>['#i_introduce .title-span','text'],
        'i_introduce_content'=>['#i_introduce .txt2em p','text'],
        'i_other_remark_title'=>['#i_other_remark .title-span','text'],
        'i_other_remark_content'=>['#i_other_remark .txt2em p','text'],
        'info_type'=>['p span.m-smMenu:eq(0)','text'],
        'i_keywords'=>['.m-xxfj .col999','text'],
        'addtime'=>['.ui-text-gray time','text'],
        'click'=>['.m-mainLeft .bgFFF .fn-left','text'],
        ];
        $base_info = QueryList::Query($url,$rules1)->data;
        $info = array_merge_multi($base_info[0],$ext_info);
		
		if($info['S19']){
			$info['S19'] = D('Category')->findRecord_name($info['S19'],$ext='S19');
		}
        $info['xmgq_period'] = D('Category')->findRecord_name($info['xmgq_period'],$ext='xmgq_period');
        if($info['S11']){
            $info['S11'] = D('Category')->findRecord_name($info['S11'],$ext='s100');
        }
		
		if($info['S159']){
            $info = ext_info_do($info,$field='S159');
		}
		
        if($info['xmrz_type']){
            $info['xmrz_type'] = D('Category')->findRecord_name($info['xmrz_type'],$ext='xmrz_type');
        }
        if($info['xmf_zs_way']){
            $info['xmf_zs_way'] = D('Category')->findRecord_name($info['xmf_zs_way'],$ext='xmf_zs_way');
        }
		
        if($info['xmrz_intention']){
            if($info['xmrz_intention']=='不限'){
                $info['xmrz_intention']='617';
            }else{
                $info['xmrz_intention'] = D('Category')->findRecord_name($info['xmrz_intention'],$ext='funds_body');
            }
        }
		
		if($info['xmlc_tzmk']){
			$info  = unit_do($info,$field='xmlc_tzmk',$type='money');
		}
		if(info['xmlc_tzqx']){
			$info  = unit_do($info,$field='xmlc_tzqx',$type='date');
		}
		if($info['S173']){
			$info['S173'] = explode(' ',$info['S173']);
			$info['S173_min'] = strtotime(reset($info['S173']));
			$info['S173_max'] = strtotime(end($info['S173']));
			unset($info['S173']);
		}
		if($info['S175']){
			$info  = unit_do($info,$field='S175',$type='money');
		}
		if($info['S176']){
			$info['S176'] = D('Category')->findRecord_name($info['S176'],$ext='S176');
		}
		if($info['S177']){
			$info['S177'] = D('Category')->findRecord_name($info['S177'],$ext='industry_id');
		}
		if($info['S178']){
			$info['S178'] = explode(' ',$info['S178']);
			$temp_S178 = array();
			foreach ($category['invest_area'] as $k => $v){
				foreach ($info['S178'] as $key => $value) {
					if($v==$value){
						$temp_S178[]=$k;
					}
				}
			}
			$info['S178'] = implode(',',$temp_S178);
		}
		if($info['S190']){
			$info = cut_date($info,$field='S190');
		}
		if($info['S191']){
			$info = three_unit_do($info,$field='S191',$empty='1',$type='date');
		}
		
        if($info['amount']){
            $patterns = "/\d+/";
            preg_match_all($patterns,$info['amount'],$arr);
            $amount = implode(" ",$arr[0]);
            $info['amount_unit'] = str_replace($amount,'',$info['amount']);
            $money_unit = array_flip($category['money_unit']);
            $info['amount_unit'] = $money_unit[$info['amount_unit']];
            $info['amount'] = $amount;
        }
        $info = amount_interval_do($info);
        if($info['addtime']){
            $info['addtime'] = strtotime($info['addtime']);
        }
        if($info['click']){
            $patterns = "/\d+/";
            $click = explode(" ",$info['click']);
            preg_match_all($patterns,$info['click'],$arr);
            $info['click'] = end($arr[0]);
        }
		
        if($info['xmrz_body']){
            $financing_body = array_flip($category['financing_body']);
            $info['xmrz_body'] = $financing_body[$info['xmrz_body']];
        }
		
		if($info['tzlc_type']){
			$tzlc_type = array_flip($category['tzlc_type']);
            $info['tzlc_type'] = $tzlc_type[$info['tzlc_type']];
		}
		
		if($info['xmlc_fxph']){
			$xmlc_fxph = array_flip($category['xmlc_fxph']);
            $info['xmlc_fxph'] = $xmlc_fxph[$info['xmlc_fxph']];
		}
		
        if($info['industry_id']){
            $industry_id = array_flip($category['industry_id']);
            $info['industry_id'] = $industry_id[$info['industry_id']];
        }
        if($info['info_type']){
            $info_type = array_flip($category['invest_type']);
            $info['info_type'] = $info_type[$info['info_type']];
        }
        if($info['S18']){
            $patterns = "/\d+/";
            $S18 = explode(" ",$info['S18']);
            preg_match_all($patterns,$info['S18'],$arr);
            $info['S18_min'] = reset($arr[0]);
            $info['S18_max'] = end($arr[0]);
            $info['S18_unit'] = end($S18);
            unset($info['S18']);
        }
        if($info['S20']){
            $patterns = "/\d+/";
            $S20 = explode(" ",$info['S20']);
            preg_match_all($patterns,$info['S20'],$arr);
            $info['S20'] = end($arr[0]);
        }
        if($info['trade_way']){
            $trade_way = array_flip($category['trade_way']);
            $info['trade_way'] = $trade_way[$info['trade_way']];
        }
        $money_unit = array_flip($category['money_unit']);
        if($info['transfer_price']){
            $patterns = "/\d+/";
            preg_match_all($patterns,$info['transfer_price'],$arr);
            $transfer_price = end($arr[0]);
            $info['transfer_price_unit'] = str_replace($transfer_price,"",$info['transfer_price']);
            $info['transfer_price_unit'] = $money_unit[$info['transfer_price_unit']];
            $info['transfer_price'] = $transfer_price;
        }
        if($info['xmzc_assass']){
            $patterns = "/\d+/";
            preg_match_all($patterns,$info['xmzc_assass'],$arr);
            $xmzc_assass = end($arr[0]);
            $info['xmzc_assass_unit'] = str_replace($xmzc_assass,"",$info['xmzc_assass']);
            $info['xmzc_assass_unit'] = $money_unit[$info['xmzc_assass_unit']];
            $info['xmzc_assass'] = $xmzc_assass;
        }
        if($info['S62']){
            $S62 = array_flip($category['S62']);
            $info['S62'] = $S62[$info['S62']];
        }
        if($info['transfer_type']){
            $info['transfer_type'] = D('Category')->findRecord_name($info['transfer_type'],$ext='transfer_type');
        }
        $area = F('area');
        $province = F('province');
        $city = F('city');
        $city_pid= F('city_pid');
        if($info['temp_area_info']){
            foreach ($area as $k => $v) {
                $area_info[$v] = strstr($info['temp_area_info'],$k);
            }
            $area_info = array_filter($area_info);
            if($area_info){
                $province_city_info = str_replace($area_info,'',$info['temp_area_info']);
                foreach ($city as $k => $v) {
                    $city_info[$v] = strstr($province_city_info,$k);
                }
                $city_info = array_filter($city_info);
                if($city_info){
                $c_name=implode('',$city_info);
                $a_name=implode('',$area_info);
                $p_name = str_replace($c_name.$a_name,'',$info['temp_area_info']);
                    if($p_name){
                        $province_info = $province[$p_name];
                    }
                    if($province_info){
                        $province_info=[$province_info=>$p_name];
                    }
                }
            }else{
                foreach ($city as $k => $v) {
                    $city_info[$v] = strstr($info['temp_area_info'],$k);
                }
                $city_info = array_filter($city_info);
                if($city_info){
                    $c_name=implode('',$city_info);
                    $p_name = str_replace($c_name,'',$info['temp_area_info']);
                    if($p_name){
                        $province_info = $province[$p_name];
                    }
                    if($province_info){
                        $province_info=[$province_info=>$p_name];
                    }
                }else{
                    $p_name = $ext_info['temp_area_info'];
                    $province_info = $province[$p_name];
                    $province_info=[$province_info=>$p_name];
                }
            }
            $province_info = array_keys($province_info);
            $city_info = array_keys($city_info);
            $area_info = array_keys($area_info);
            if(!empty($province_info)){
                $address['province_id'] = $province_info[0];
            }else{
                $address['province_id'] = $city_pid[$city_info[0]];
            }
            if(!empty($city_info)){
                //北京、重庆、北京、天津
                $address['city_id'] = $city_info[0];
            }else{
                $address['city_id'] =0;
            }
            if(!empty($area_info)){
                $address['area_id'] = $area_info[0];
            }else{
                $address['area_id'] =0;
            }
        }
        $last_area_id = end(array_filter($address));
        $info['province_id'] = $address['province_id'];
        $info['city_id'] = $address['city_id'];
        $info['area_id'] = $address['area_id'];
        $info['last_area_id'] = $last_area_id;
        unset($info['temp_area_info']);
        unset($info['i_overview_title'],$info['i_other_remark_title']);
        if($info['info_type']==700){
            $info['industry_id'] = $info['招商行业'];
            if($info['industry_id']){
                $industry_id = array_flip($category['industry_id']);
                $info['industry_id'] = $industry_id[$info['industry_id']];
            }
            unset($info['招商行业']);
            $info['amount_interval'] = $info['投资估算'];
            $info = amount_interval_do($info,$empty=1);
        }
        //$info = array_filter($info);
        print_r($info);
        exit;
    }


    public function collect($id='',$type=''){
        if($id){
            $id = $id;
        }else{
            $id = I('get.id');
        }
        if(!$id){
            echo "id不存在";
            exit;
        }
        //投融界信息采集器
        if($id && ($type==1||$type=='')){
            $url = 'http://zijin.trjcn.com/detail_'.$id.'.html';
        }elseif($id && $type==2){
            $url = 'http://xiangmu.trjcn.com/detail_'.$id.'.html';
        }
        $category = F('category');
        $rules=[
        'dt' => array('.detail-left dt','text'),
        'dd' => array('.detail-left dd','text'),
        ];
        $temp_ext_info = QueryList::Query($url,$rules)->getData(function($info){
            return $info;
        });
        $pipei  = ['资金主体'=>'funds_body','投资行业'=>'tz_industry','投资地区'=>'tz_area','前期费用'=>'S201','需提供资料'=>'S100','股权投资类型'=>'zjf_tz_type','投资阶段'=>'zjf_tz_period','参股比例'=>'S108','投资期限'=>'S115','投资金额'=>'amount_interval','所在地区'=>'temp_area_info','风控要求'=>'zjf_fk_claim','抵押物类型'=>'S213','抵押物折扣率'=>'S214','最低回报要求'=>'zjf_pay_back','风险偏好'=>'zjf_fx_like','产品偏好'=>'zjf_tp_like'];
        foreach ($temp_ext_info as $k => &$v){
            $v['dt'] = $this->strFilter($v['dt']);
            foreach ($pipei as $key => $value) {
               if($v['dt']==$key){
                   $v['dt'] =$value;
                }
            }
            $ext_info[$v['dt']] = $v['dd'];
            unset($temp_ext_info);
        }

        $area = F('area');
        $province = F('province');
        $city = F('city');
        $city_pid= F('city_pid');

        //$ext_info['temp_area_info'] ='浙江省温州市乐清市';
        if($ext_info['temp_area_info']){
            foreach ($area as $k => $v) {
                $area_info[$v] = strstr($ext_info['temp_area_info'],$k);
            }
            $area_info = array_filter($area_info);
            if($area_info){
                $province_city_info = str_replace($area_info,'',$ext_info['temp_area_info']);
                foreach ($city as $k => $v) {
                    $city_info[$v] = strstr($province_city_info,$k);
                }
                $city_info = array_filter($city_info);
                if($city_info){
                $c_name=implode('',$city_info);
                $a_name=implode('',$area_info);
                $p_name = str_replace($c_name.$a_name,'',$ext_info['temp_area_info']);
                    if($p_name){
                        $province_info = $province[$p_name];
                    }
                    if($province_info){
                        $province_info=[$province_info=>$p_name];
                    }
                }
            }else{
                foreach ($city as $k => $v) {
                    $city_info[$v] = strstr($ext_info['temp_area_info'],$k);
                }
                $city_info = array_filter($city_info);
                if($city_info){
                    $c_name=implode('',$city_info);
                    $p_name = str_replace($c_name,'',$ext_info['temp_area_info']);
                    if($p_name){
                        $province_info = $province[$p_name];
                    }
                    if($province_info){
                        $province_info=[$province_info=>$p_name];
                    }
                }else{
                    $p_name = $ext_info['temp_area_info'];
                    $province_info = $province[$p_name];
                    $province_info=[$province_info=>$p_name];
                }
            }
            $province_info = array_keys($province_info);
            $city_info = array_keys($city_info);
            $area_info = array_keys($area_info);
            if(!empty($province_info)){
                $address['province_id'] = $province_info[0];
            }else{
                $address['province_id'] = $city_pid[$city_info[0]];
            }
            if(!empty($city_info)){
                //北京、重庆、北京、天津
                $address['city_id'] = $city_info[0];
            }else{
                $address['city_id'] =0;
            }
            if(!empty($area_info)){
                $address['area_id'] = $area_info[0];
            }else{
                $address['area_id'] =0;
            }
        }
        $last_area_id = end(array_filter($address));
        $ext_info['province_id'] = $address['province_id'];
        $ext_info['city_id'] = $address['city_id'];
        $ext_info['area_id'] = $address['area_id'];
        $ext_info['last_area_id'] = $last_area_id;
        unset($ext_info['temp_area_info']);
        $ext_info['tz_industry'] = D('Category')->findRecord_name($ext_info['tz_industry'],$ext='tz_industry');
        //$ext_info['tz_area'] = $province[$ext_info['tz_area']];
        $ext_info['S100'] = D('Category')->findRecord_name($ext_info['S100'],$ext='S100');
        $ext_info['zjf_tz_period'] = D('Category')->findRecord_name($ext_info['zjf_tz_period'],$ext='zjf_tz_period');
        if($ext_info['zjf_tz_type']){
            $ext_info['zjf_tz_type'] = D('Category')->findRecord_name($ext_info['zjf_tz_type'],$ext='zjf_tz_type');
        }
        if($ext_info['S213']){
            $ext_info['S213'] = D('Category')->findRecord_name($ext_info['S213'],$ext='S213');
        }
        $ext_info['zjf_fk_claim'] = D('Category')->findRecord_name($ext_info['zjf_fk_claim'],$ext='zjf_fk_claim');
        $ext_info['S201'] = D('Category')->findRecord_name($ext_info['S201'],$ext='S201');
        $exp =['S214','S110','S115'];
        foreach ($exp as $k => $v) {
            if($ext_info[$v]){
                $ext_info[$v] = explode(' ',$ext_info[$v]);
            }
            if(count($ext_info[$v])==4){
                $ext_info[$v.'_min'] = reset($ext_info[$v]);
                $ext_info[$v.'_unit'] = end($ext_info[$v]);
                $ext_info[$v.'_max'] = prev($ext_info[$v]);
            }
            unset($ext_info[$v]);
        }
        $tz_area = explode(" ",$ext_info['tz_area']);
        if($ext_info['zjf_pay_back']){
             $patterns = "/\d+/";
            //$ext_info['zjf_pay_back']=trim($ext_info['zjf_pay_back']);
            preg_match_all($patterns,$ext_info['zjf_pay_back'],$arr);
            $ext_info['zjf_pay_back'] = implode(" ",$arr[0]);
        }
        $money_unit = array_flip($category['money_unit']);
        if($ext_info['amount_interval']){
            $patterns = "/\d+/";
            preg_match_all($patterns,$ext_info['amount_interval'],$amount_interval_num);
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$ext_info['amount_interval'], $amount_interval_cn);
            $ext_info['amount_interval_min'] = $amount_interval_num[0][0];
            $ext_info['amount_interval_max'] = $amount_interval_num[0][1];
            $ext_info['amount_interval_min_unit']=$money_unit[$amount_interval_cn[0][0]];
            $ext_info['amount_interval_max_unit']=$money_unit[$amount_interval_cn[0][1]];
            unset($ext_info['amount_interval']);
        }
        $amount_interval = explode(" ",$ext_info['amount_interval']);
        $category = F('category');
        $temp_area = array();
        foreach ($category['province'] as $k => $v){
            foreach ($tz_area as $key => $value) {
                if($v==$value){
                    $temp_area[]=$k;
                }
            }
        }
        $ext_info['tz_area'] = implode(',',$temp_area);
        $rules1=[
        'title'=>['p .ui-text-blue-2','text'],
        'i_overview_title'=>['#i_overview .title-span','text'],
        'i_overview_content'=>['#i_overview .txt2em p','text'],
        'i_introduce_title'=>['#i_introduce .title-span','text'],
        'i_introduce_content'=>['#i_introduce .txt2em p','text'],
        'i_other_remark_title'=>['#i_other_remark .title-span','text'],
        'i_other_remark_content'=>['#i_other_remark .txt2em p','text'],
        'info_type'=>['p span.m-smMenu:eq(0)','text'],
        'i_keywords'=>['.m-xxfj .col999','text'],
        'addtime'=>['.ui-text-gray time','text'],
        'click'=>['.m-mainLeft .bgFFF .fn-left','text'],
        ];
        $base_info = QueryList::Query($url,$rules1)->data;
        $info = array_merge_multi($base_info[0],$ext_info);
        if($info['funds_body']){
           $funds_body = array_flip($category['funds_body']);
           $info['funds_body'] = $funds_body[$info['funds_body']];
        }
        if($info['zjf_tp_like']){
            $zjf_tp_like = array_flip($category['zjf_tp_like']);
            $info['zjf_tp_like'] = $zjf_tp_like[$info['zjf_tp_like']];
        }
        if($info['zjf_fx_like']){
            $zjf_fx_like = array_flip($category['zjf_fx_like']);
            $info['zjf_fx_like'] = $zjf_fx_like[$info['zjf_fx_like']];
        }
        if($info['info_type']){
            $info_type = array_flip($category['invest_type']);
            $info['info_type'] = $info_type[$info['info_type']];
        }
        if($info['S108']){
            $patterns = "/\d+/";
            $S108 = explode(" ",$info['S108']);
            preg_match_all($patterns,$info['S108'],$arr);
            $info['S108_unit'] = end($S108);
            $info['S108_min'] = reset($arr[0]);
            $info['S108_max'] = end($arr[0]);
            unset($info['S108']);
        }
        if($info['click']){
            $patterns = "/\d+/";
            $click = explode(" ",$info['click']);
            preg_match_all($patterns,$info['click'],$arr);
            $info['click'] = end($arr[0]);
        }
        if($info['i_keywords']){
            $info['i_keywords'] = str_replace('标签：','',$info['i_keywords']);
        }
        if($info['addtime']){
            $info['addtime'] = strtotime($info['addtime']);
        }
        if($info['S115_unit']){
            $date = array_flip($category['date']);
            $info['S115_unit'] = $date[$info['S115_unit']];
        }
        $info = array_filter($info);
        unset($info['i_overview_title'],$info['i_other_remark_title'],$info['i_introduce_title']);
        print_r($info);
        exit;
        return $info;
        print_r($info);
        exit;
        //打印结果
        $data = $temp_data[0];
        $data['body'] =$this->strFilter($data['body']);

        print_r($data);
        exit;
        $result = M('BaseInfo')->add($data);
        if($result){
            echo "<script>alert('采集成功');</script>";
        }
        exit;
       
    }

    function strFilter($str){
        $str = str_replace('`', '', $str);
        $str = str_replace('·', '', $str);
        $str = str_replace('~', '', $str);
        $str = str_replace('!', '', $str);
        $str = str_replace('！', '', $str);
        $str = str_replace('@', '', $str);
        $str = str_replace('#', '', $str);
        $str = str_replace('$', '', $str);
        $str = str_replace('￥', '', $str);
        $str = str_replace('%', '', $str);
        $str = str_replace('^', '', $str);
        $str = str_replace('……', '', $str);
        $str = str_replace('&', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('(', '', $str);
        $str = str_replace(')', '', $str);
        $str = str_replace('（', '', $str);
        $str = str_replace('）', '', $str);
        $str = str_replace('-', '', $str);
        $str = str_replace('_', '', $str);
        $str = str_replace('——', '', $str);
        $str = str_replace('+', '', $str);
        $str = str_replace('=', '', $str);
        $str = str_replace('|', '', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('[', '', $str);
        $str = str_replace(']', '', $str);
        $str = str_replace('【', '', $str);
        $str = str_replace('】', '', $str);
        $str = str_replace('{', '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace(';', '', $str);
        $str = str_replace('；', '', $str);
        $str = str_replace(':', '', $str);
        $str = str_replace('：', '', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('“', '', $str);
        $str = str_replace('”', '', $str);
        $str = str_replace(',', '', $str);
        $str = str_replace('，', '', $str);
        $str = str_replace('<', '', $str);
        $str = str_replace('>', '', $str);
        $str = str_replace('《', '', $str);
        $str = str_replace('》', '', $str);
        $str = str_replace('.', '', $str);
        $str = str_replace('。', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('、', '', $str);
        $str = str_replace('?', '', $str);
        $str = str_replace('？', '', $str);
        return trim($str);
    }

    function makedir($dir, $mode = 0777){  
        if(!$dir) return false;
        if(!file_exists($dir)) {  
            mkdir($dir,$mode,true);  
            return chmod($dir,$mode);  
        } else {  
            return true;  
        }
    }
}
?>