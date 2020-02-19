<?php
namespace Home\Controller;
use QL\QueryList;
use QL\Ext\Lib\CurlMulti;
use QL\Ext\Multi;
use Common\Controller\FrontendController;
class MultiCollectController extends FrontendController{

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
            $url = I('post.url');
            $type = I('post.type','');
                if(empty($url)){
                    $this->error('url不存在');
                    die();
                }
                if(!preg_match("/^(http):/",$url)){
                    $url = 'http://'.$url;
                }
                $str='.trjcn.com';
                if(strpos($url,$str) === false){
                    $this->error('url不合法,请输入投融界url!');
                    die();
                }
            if($type==1){
                $str1='zijin';
                $str2='xiangmu';
                if(strpos($url,$str1) !== false){
                        $type='fund_multi_do';
                        $this->$type($url);
                }
                if(strpos($url,$str2) !== false){
                        $type='item_multi_do';
                        $this->$type($url);
                }
                //$this->error('采集参数填写不正确');
            }
            if($type==2){
                $str1='news';
                $str2='zhiku';
                if(strpos($url,$str1) !== false){
                        $type='news_multi_do';
                        $this->$type($url);
                }
                if(strpos($url,$str2) !== false){
                        $type='zhiku_multi_do';
                        $this->$type($url);
                }
                //$this->error('采集参数填写不正确');
            }
            if($type==3){
                $str1='zijin';
                $str2='xiangmu';
                if(strpos($url,$str1) !== false){
                        $type='fund_user_do';
                        $this->$type($url);
                }
                if(strpos($url,$str2) !== false){
                        $type='item_user_do';
                        $this->$type($url);
                }
                //$this->error('采集参数填写不正确');
            }
            //$info_root = ROOT_PATH.'cj_info';
            //$base_root = str_replace("\\", '/',$info_root);
            //$this->makedir($info_root);
            //exit;
            /*
            $seller_cur_count = count($place_info);
            if(F('seller_num')!=$seller_cur_count){
                $this->makedir($place_info_dir);
            }
            */
            //$file_path = $base_root.'/'.$id;
            //$result = $this->collect($id,$type='');
            //$info = json_encode_no_zh($result);
            //$result = file_put_contents($file_path,$info);
            /*
            if($result){
                $this->success('采集成功,正在为您跳转...');
                die();
            }
            */
        }
        $this->display();
    }

    //新闻信息采集器
    public function news_multi_do(){
        echo '新闻信息采集器';
        exit;
    }

    public function zhiku_multi_do(){
        echo '知识库信息采集方法';
        exit;
    }

    public function item_user_do($url=''){
        //echo "项目用户采集";
        //exit;
        if(empty($url)){
            $this->error('请填写url!');
        }
        $data = QueryList::Query($url,[
            'url' => ['.w788 h6 a','href',
            ]])->getData(function($item){
            return $item;
        });
        $url_array = array_column($data,'url');
        //$url_array=array_slice($url_array,0,5);
        //多线程扩展
QueryList::run('Multi',[
    //待采集链接集合
    'list' => $url_array,
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
        $reg = array(
            'published'=>['.m-title3 .title-span','text'],
            'realname' => ['#J_view_contact_name span','text'],
            'trj_info_id'=>['#J_addfav','data-id'],
            'ext' => ['.m-hyxm.colfff .pad20 .line24','text'],
            'trj_company_id'=>['.btn-hall','href','',function($content){
                 return  preg_replace('/\D/s','',$content);
            }],
            );
        $ql = QueryList::Query($a['content'],$reg);
        $data = $ql->getData();
        foreach ($data as $k => &$v) {
            $v['ext'] = str_replace("所在公司：","company_name,",$v['ext']);
            $v['ext'] = str_replace("职位：","job,",$v['ext']);
            $v['ext'] = str_replace("所在地区：","temp_area,",$v['ext']);
            $v['ext'] = str_replace("所属行业：","industry_id,",$v['ext']);
            $v['ext'] = str_replace("意向资金：","attxmrz_intention,",$v['ext']);
            $pattern = '/(,)+/i';
            $v['ext'] = preg_replace($pattern,',',$this->myTrim($v['ext']));
            $v['ext'] = explode(',',$v['ext']);
            foreach ($v['ext'] as $kk => $vv) {
                if($kk%2 == 0){
                    $v['ext'][$vv] = $v['ext'][$kk+1];
                }
                unset($v['ext'][$kk]);
            }
            $v['ext']=array_filter($v['ext']);
            if(empty($v['ext'])) unset($v['ext']);
        }
        $data = $data[0];
        foreach ($data as $key => &$value) {
            if(is_array($value)){
                foreach ($value as $k => &$v) {
                    $data[$k] = $v;
                }
                unset($data[$key]);
            }
        }
        $info = $data;
        if($info['temp_area']){
            $info = area_do($info,$field='temp_area');
        }
        if($info['attxmrz_intention']){
            $info = ext_info_do($info,$field='attxmrz_intention',$ext_filed='funds_body');
        }
        if($info['industry_id']){
            $category = F('category');
            $industry_id = array_flip($category['industry_id']);
            $info['industry_id'] = $industry_id[$info['industry_id']];
        }
        if(count($info)<=1){
            unset($info);
        }
        $info['username'] = 'qrh_xm_'.$info['trj_info_id'];
        $info['utype']=2;
        $info['mobile']='';
        $info['inner']=1;
        $pwd_hash = D('Members')->randstr();
        $password='123456';
        $info['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
        $info['pwd_hash'] = $pwd_hash;
        $info['mobile_audit']=1;
        $info['status']=1;
        $str1='先生';
        $str2='女士';
        if(strpos($info['realname'],$str1) !== false){
                $info['sex']=0;
        }
        if(strpos($info['realname'],$str2) !== false){
                $info['sex']=1;
        }
        $trj_info_ids = M('Members2')->field('trj_info_id')->select();
        $trj_info_ids = array_multi_to_single($trj_info_ids);
            if(!empty($trj_info_ids)){
                array_flip($trj_info_ids);
                if(isset($trj_info_ids[$info['trj_info_id']])){
                    unset($info);
                }
            }
        if(!empty($info)){
                $result = M('Members2')->add($info);
                $this->success('采集成功!');
        }else{
                $this->error('采集信息重复度过高,采集失败!');
        }
    }
]);


    }

    function myTrim($str){
        $search = array("\n","\r","\t");
        $replace = array(",",",",",");
        return str_replace($search, $replace, $str);
    }

    public function fund_user_do($url=''){
        //echo "资金用户采集";
        //exit;
        if(empty($url)){
            $this->error('请填写url!');
        }
        $data = QueryList::Query($url,[
            'url' => ['.w788 h6 a','href',
            ]])->getData(function($item){
            return $item;
        });
        $url_array = array_column($data,'url');
        //$url_array=array_slice($url_array,0,5);
        //多线程扩展
QueryList::run('Multi',[
    //待采集链接集合
    'list' => $url_array,
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
        $reg = array(
            'published'=>['.m-title3 .title-span','text'],
            'realname' => ['#J_view_contact_name span','text'],
            'trj_info_id'=>['#J_addfav','data-id'],
            'ext' => ['.m-hyxm.colfff .pad20 .line24','text'],
            'trj_company_id'=>['.btn-hall','href','',function($content){
                 return  preg_replace('/\D/s','',$content);
            }],
            );
        $ql = QueryList::Query($a['content'],$reg);
        $data = $ql->getData();
        foreach ($data as $k => &$v) {
            $v['ext'] = str_replace("所在公司：","company_name,",$v['ext']);
            $v['ext'] = str_replace("职位：","job,",$v['ext']);
            $v['ext'] = str_replace("所在地区：","temp_area,",$v['ext']);
            $v['ext'] = str_replace("所属行业：","industry_id,",$v['ext']);
            $v['ext'] = str_replace("意向资金：","attxmrz_intention,",$v['ext']);
            $pattern = '/(,)+/i';
            $v['ext'] = preg_replace($pattern,',',$this->myTrim($v['ext']));
            $v['ext'] = explode(',',$v['ext']);
            foreach ($v['ext'] as $kk => $vv) {
                if($kk%2 == 0){
                    $v['ext'][$vv] = $v['ext'][$kk+1];
                }
                unset($v['ext'][$kk]);
            }
            $v['ext']=array_filter($v['ext']);
            if(empty($v['ext'])) unset($v['ext']);
        }
        $data = $data[0];
        foreach ($data as $key => &$value) {
            if(is_array($value)){
                foreach ($value as $k => &$v) {
                    $data[$k] = $v;
                }
                unset($data[$key]);
            }
        }
        $info = $data;
        if($info['temp_area']){
            $info = area_do($info,$field='temp_area');
        }
        if($info['attxmrz_intention']){
            $info = ext_info_do($info,$field='attxmrz_intention',$ext_filed='funds_body');
        }
        if($info['industry_id']){
            $category = F('category');
            $industry_id = array_flip($category['industry_id']);
            $info['industry_id'] = $industry_id[$info['industry_id']];
        }
        if($info['published']='会员名片'){
            $info['published']=1;
        }else{
            $info['published']=0;
        }
        $info['username'] = 'qrh_xm_'.$info['trj_info_id'];
        $info['utype']=2;
        $info['mobile']='';
        $info['inner']=1;
        $pwd_hash = D('Members')->randstr();
        $password='123456';
        $info['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
        $info['pwd_hash'] = $pwd_hash;
        $info['mobile_audit']=1;
        $info['status']=1;
        $str1='先生';
        $str2='女士';
        if(strpos($info['realname'],$str1) !== false){
                $info['sex']=0;
        }
        if(strpos($info['realname'],$str2) !== false){
                $info['sex']=1;
        }
        if(count($info)<=10){
            unset($info);
        }
        $trj_info_ids = M('Members2')->field('trj_info_id')->select();
        $trj_info_ids = array_multi_to_single($trj_info_ids);
            if(!empty($trj_info_ids)){
                array_flip($trj_info_ids);
                if(isset($trj_info_ids[$info['trj_info_id']])){
                    unset($info);
                }
            }
        //print_r($info);
        if(!empty($info)){
            $result = M('Members2')->add($info);
            $this->success('采集成功!');
        }
         
    }
]);
    }
    //批量采集
    public function item_multi_do($url=''){
        //echo '进入了项目方';
        //exit;
		$category = F('category');
        if(empty($url)){
            $url = 'http://xiangmu.trjcn.com';
        }
        $data = QueryList::Query($url,[
            'url' => ['.w788 h6 a','href',
            ]])->getData(function($item){
            return $item;
        });
        $url_array = array_column($data,'url');
	    //$url_array=array_slice($url_array,0,30);
        //$url_array = implode(',',$url_array);
        //多线程扩展
        QueryList::run('Multi',[
        //待采集链接集合
        /*
        'list' => [
        'http://xiangmu.trjcn.com/detail_609719.html',
        'http://xiangmu.trjcn.com/detail_609717.html',
        //更多的采集链接....
        ],
        */
        'list' => $url_array,
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
            'maxThread' => 1000,
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
                'i_overview'=>['#i_overview .txt2em p','text'],
                'i_introduce_title'=>['#i_introduce .title-span','text'],
                'i_introduce'=>['#i_introduce .txt2em p','text'],
                'trj_info_id'=>['#J_addfav','data-id'],
                'i_other_remark_title'=>['#i_other_remark .title-span','text'],
                'i_other_remark'=>['#i_other_remark .txt2em p','text'],
                'info_type'=>['p span.m-smMenu:eq(0)','text'],
                'i_keywords'=>['.m-xxfj .col999','text'],
                'addtime'=>['.ui-text-gray time','text'],
                'click'=>['.m-mainLeft .bgFFF .fn-left.fn-mt-10.ui-text-gray','text'],
                );
            $ql = QueryList::Query($a['content'],$rule);
            $data = $ql->getData();
			$pipei  = ['项目类型'=>'info_type','所在地区'=>'temp_area_info','交易类别'=>'xmzc_type','所属行业'=>'industry_id','融资用途'=>'xmrz_usage','融资金额'=>'amount_interval','总投金额'=>'amount','意向资金'=>'xmrz_intention','融资方式'=>'xmrz_type','可提供资料'=>'S11','项目所处阶段'=>'xmgq_period','资金方占股比例'=>'S18','投资退出方式'=>'S19','最短退出年限'=>'S20','交易方式'=>'trade_way','转让范围'=>'transfer_type','固定资产'=>'xmzc_assass','转让价格'=>'transfer_price','分类'=>'S62','资产估价'=>'xmzc_assass','保有储量'=>'S71','采矿权证'=>'S66','招商方式'=>'xmf_zs_way','产品类型'=>'tzlc_type','风险偏好'=>'xmlc_fxph','投资门槛'=>'xmlc_tzmk','投资期限'=>'xmlc_tzqx','预期收益率'=>'S159','固定值'=>'S190','浮动范围'=>'S191','管理公司'=>'S180','发行时间'=>'S173','基金规模'=>'S175','投资类型'=>'S176','投资地区'=>'S178','投资行业'=>'S177','融资主体'=>'xmrz_body','资金占用时长'=>'S22','可承担最高利息'=>'S21','抵押物类型'=>'S24','可提供风控'=>'S23','还款来源'=>'S26','抵押物市值'=>'S25'];
			foreach ($data as $k => &$v){
            $v['dt'] = strFilter($v['dt']);
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
            if(empty($info)){
                unset($info);
            }else{
                $info['type']=2;
            }
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
                if($k=='S11'){
                    $info = ext_info_do($info,$field='S11',$ext_field='s100');
                }
                if($k=='xmrz_type'){
                    $info = ext_info_do($info,$field='xmrz_type');
                }
                if($k=='S25'){
                    $info = unit_do($info,$field='S25',$type='money');
                }
                if($k=='S18'){
                    $info = S18($info,$field='S18');
                }
                if($k=='S19'){
                    $info = ext_info_do($info,$field='S19');
                }
                if($k=='S20'){
                    $info =get_single_num($info,$field='S20');
                }
                if($k=='S21'){
                    $info = cut_date($info,$field='S21');
                }
                if($k=='S22'){
                    $info = three_unit_do($info,$field='S22',$empty=1);
                }
                if($k=='industry_id'){
                    $category = F('category');
                    $industry_id = array_flip($category['industry_id']);
                    $info['industry_id'] = $industry_id[$info['industry_id']];
                }
				if($k=='info_type'){
					$category = F('category');
					$info_type = array_flip($category['invest_type']);
					$info['info_type'] = $info_type[$info['info_type']];
				}
                if($k=='xmgq_period'){
                    $category = F('category');
                    $xmgq_period = array_flip($category['project_stage']);
                    $info['xmgq_period'] = $xmgq_period[$info['xmgq_period']];
                }
                if($k=='S24'){
                    $info = ext_info_do($info,$field='S24');
                }
                if($k=='S23'){
                    $info = special_field_do($info,$field='S23');
                }
                if($k=='S26'){
                    $info = special_field_do($info,$field='S26');
                }
                if($k=='temp_area_info'){
                    $info = area_do($info,$field='temp_area_info');
                }
                if($k == 'trj_info_id'){
                    (int)$info['trj_info_id'];
                }
            }
            unset($info['i_overview_title'],$info['i_other_remark_title'],$info['i_introduce_title']);
            $field_base_info = ['info_type','title','province_id','city_id','area_id','last_area_id','amount_interval_min','amount_interval_min_unit','amount_interval_max','amount_interval_max_unit','amount_range','amount','amount_unit','i_overview','i_introduce','i_other_remark','i_keywords','i_pic','i_att','is_open','click','i_att_other','uid','addtime','updatetime','trj_info_id','type'];
            $field_key = array_keys($info);
            foreach ($field_base_info as $vv){
                foreach ($field_key as $value) {
                    if($value==$vv){
                        $infos[$value] = $info[$value];
                    }
                } 
            }
            $field_item_info=['xmrz_body','industry_id','xmrz_revenue','xmrz_revenue_unit','xmrz_asset','xmrz_asset_unit','xmrz_usage','xmrz_intention','xmrz_type','S11','S18_min','S18_max','S18_unit','S19','extra_S19','S20','S21','S22_min','S22_max','S22_unit','S23','extra_S23','S24','extra_S24','S25','S25_unit','S26','extra_S26','xmgq_period','S86','S87','S88','S89','S90'];
            foreach ($field_item_info as $vv){
                foreach ($field_key as $value) {
                    if($value==$vv){
                        $infos['ItemInfo'][$value] = $info[$value];
                    }
                } 
            }
            $filed_item_info_tzlc=['tzlc_type','xmlc_fxph','xmlc_tzmk','xmlc_tzmk_unit','xmlc_tzqx','xmlc_tzqx_unit','S141_min','S141_max','S142','extra_S142','S143','S144_min','S144_max','S145','S150','S151','S152','S153','S154','S155','S156','S157_min','S157_max','S158_min','S158_max','S159','S160','S161_min','S161_max','S162','S163','S164','S165','S166','S166_unit','S167','S168','S169','S170','S171','S172','S173_min','S173_max','S174','S175','S175_unit','S176','S177','S178','S179','S180','S181','S182','S183','S184','S185','S186','S187','S188','S189_min','S189_max','S190','S191_min','S191_max','S192','S193_min','S193_max','S194','S195_min','S195_max','S196','S197_min','S197_max','S198','S199_min','S199_max','S199_unit','S200'];
            foreach ($filed_item_info_tzlc as $vv){
                foreach ($field_key as $value) {
                    if($value==$vv){
                        $infos['ItemInfoTzlc'][$value] = $info[$value];
                    }
                } 
            }
            $field_item_info_zcjy=['xmzc_type','trade_way','transfer_type','xmzc_assass','xmzc_assass_unit','transfer_price','transfer_price_unit','transfer_dateend','xmf_zs_way','extra_xmf_zs_way','S38','S39','S40','S41','S42','S43','S44','S45','S46','S47','S48','S49','S50','S51','S52','S53','S54','S55','S56','S57','S58','S58_unit','S59','S59_unit','S60','S60_unit','S61','S62','S63','S64','S65','S66','S67','S69','S70','S71','S72','S73','S73_unit','S74','S75','S76','S77','S78','S79','S79_unit','S80','S80_unit'];
            foreach ($field_item_info_zcjy as $vv){
                foreach ($field_key as $value) {
                    if($value==$vv){
                        $infos['ItemInfoZcjy'][$value] = $info[$value];
                    }
                } 
            }
            $trj_info_ids = M('BaseInfo')->field('trj_info_id')->select();
            $trj_info_ids = array_multi_to_single($trj_info_ids);
            if(!empty($trj_info_ids)){
                array_flip($trj_info_ids);
                if(isset($trj_info_ids[$info['trj_info_id']])){
                    unset($info);
                }
            }
            //print_r($infos);
            if(!empty($infos)){
                $result = D('BaseInfo')->relation(true)->add($infos);
                $this->success('采集成功!');
            }else{
                $this->error('采集信息重复度过高,采集失败!');
            }
            //print_r($infos);
        }
    ]);
    }

    public function fund_multi_do($url=''){
        //echo '进入了资金方';
        //exit;
        if(empty($url)){
            $url ='http://zijin.trjcn.com';
        }
        $data = QueryList::Query($url,
            [
            'url' => ['.w788 h6 a','href'],
            'info_type' => ['.part-money-list-a .part-money-text-list span:contains(投资方式：)','text'],
            ])->getData(function($item){
            return $item;
        });
        $category = F('category');
        foreach ($data as $k => &$v) {
            $v['id'] = preg_replace('/\D/s','',$v['url']);
            $v['info_type'] = str_replace("投资方式：","",$v['info_type']);
            foreach ($category['info_type'] as $key => &$value){
                if($value == $v['info_type']){
                   $v['info_type'] = $key;
                }
            }
        }
        foreach ($data as $k => &$v) {
             $list_par[$v['id']] = $v['info_type'];
             F('list_par',$list_par);
        }
        $url_array = array_column($data, 'url');
        //$url_array=array_slice($url_array,0,10);
        //多线程扩展
        QueryList::run('Multi',[
        //待采集链接集合
        'list' => $url_array,
        
        'list' => [
        'http://zijin.trjcn.com/detail_599370.html',
        //更多的采集链接....
        ],
        
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
            'maxThread' => 1000,
            //设置最大尝试数
            'maxTry' => 3
        ],
        'success' => function($a){
            //采集规则
            $rule = [
                'dt' => ['.detail-left dt','text'],
                'dd' => ['.detail-left dd','text'],
                'title'=>['p .ui-text-blue-2','text'],
                'i_overview_title'=>['#i_overview .title-span','text'],
                'i_overview'=>['#i_overview .txt2em p','text'],
                'i_introduce_title'=>['#i_introduce .title-span','text'],
                'i_introduce'=>['#i_introduce .txt2em p','text'],
                'trj_info_id'=>['#J_addfav','data-id'],
                'i_other_remark_title'=>['#i_other_remark .title-span','text'],
                'i_other_remark'=>['#i_other_remark .txt2em p','text'],
                'info_type'=>['p span.m-smMenu:eq(0)','text'],
                'i_keywords'=>['.m-xxfj .col999','text'],
                'addtime'=>['.ui-text-gray time','text'],
                'click'=>['.m-mainLeft .bgFFF .fn-left.fn-mt-10.ui-text-gray','text'],
            ];
            $ql = QueryList::Query($a['content'],$rule);
            $data = $ql->getData();
            $pipei  = ['资金主体'=>'funds_body','投资行业'=>'tz_industry','投资地区'=>'tz_area','前期费用'=>'S201','需提供资料'=>'S100','股权投资类型'=>'zjf_tz_type','投资阶段'=>'zjf_tz_period','参股比例'=>'S108','投资期限'=>'S115','投资金额'=>'amount_interval','所在地区'=>'temp_area_info','风控要求'=>'zjf_fk_claim','抵押物类型'=>'S213','抵押物折扣率'=>'S214','最低回报要求'=>'zjf_pay_back','风险偏好'=>'zjf_fx_like','产品偏好'=>'zjf_tp_like'];
            //S115 S110 投资期限,根据条件进行判断
            foreach ($data as $k => &$v){
                $v['dt'] = strFilter($v['dt']);
                foreach ($pipei as $key => $value) {
                   if($v['dt']==$key){
                       $v['dt'] =$value;
                    }
                }
                $ext_info[$v['dt']] = $v['dd'];
                unset($v['dt'],$v['dd']);
                if(!$v){
                    unset($data[$k]);  
                }
            }
            $info = array_filter(array_merge_multi($data[0],$ext_info));
            foreach ($info as $k => $v){
                unset($info['i_other_remark_title'],$info['i_overview_title'],$info['i_introduce_title']);
                if($k=='info_type'){
                    $category = F('category');
                    $info_type = array_flip($category['invest_type']);
                    $info['info_type'] = $info_type[$info['info_type']];
                }
                if(empty($info['info_type']) || !isset($info['info_type'])){
                    $list_par = F('list_par');
                    $info['info_type'] = $list_par[$info['trj_info_id']];
                }
                if($k=='zjf_fk_claim'){
                    $info = ext_info_do($info,$field='zjf_fk_claim');
                }
                if($k=='zjf_tp_like'){
                    $info = ext_info_do($info,$field='zjf_tp_like');
                }
                if($k=='S213'){
                    $info = ext_info_do($info,$field='S213');
                }
                if($info['zjf_pay_back']){
                    $patterns = "/\d+/";
                    preg_match_all($patterns,$info['zjf_pay_back'],$arr);
                    $info['zjf_pay_back'] = implode(" ",$arr[0]);
                }
                if($k=='S115'){
                    $info = three_unit_do($info,$field='S115',$empty=1);
                }
                if($k=='S214'){
                    $info = three_unit_do($info,$field='S214',$empty=1);
                }
                if($k=='funds_body'){
                    $category = F('category');
                    $info['funds_body'] = trim($info['funds_body']);
                    $funds_body = array_flip($category['funds_body']);
                    $info['funds_body'] = $funds_body[$info['funds_body']];
                }
                if($k=='zjf_fx_like'){
                    $info['zjf_fx_like'] = trim($info['zjf_fx_like']);
                    $funds_body = array_flip($category['zjf_fx_like']);
                    $info['zjf_fx_like'] = $funds_body[$info['zjf_fx_like']];
                }
                if($k=='S108'){
                    $patterns = "/\d+/";
                    $S108 = explode(" ",$info['S108']);
                    preg_match_all($patterns,$info['S108'],$arr);
                    $info['S108_unit'] = end($S108);
                    $info['S108_min'] = reset($arr[0]);
                    $info['S108_max'] = end($arr[0]);
                    unset($info['S108']);
                }
                if($k=='S100'){
                    $info = special_field_do($info,$field='S100');
                }
                if($k=='amount_interval'){
                    $info = amount_interval_do($info,$empty=1);
                }
                if($k=='tz_industry'){
                    $info = ext_info_do($info,$field='tz_industry');
                }
                if($k=='tz_area'){
                    $info = ext_info_do($info,$field='tz_area',$ext_field='province');
                }
                if($k=='zjf_tz_type'){
                    $info = ext_info_do($info,$field='zjf_tz_type');
                }
                if($k=='zjf_tz_period'){
                    $info = ext_info_do($info,$field='zjf_tz_period');
                }
                if($k=='temp_area_info'){
                    $info = area_do($info,$field='temp_area_info');
                }
                if($k == 'trj_info_id'){
                    (int)$info['trj_info_id'];
                }
                if($k=='S201'){
                    $info = ext_info_do($info,$field='S201');
                }
                if($k=='addtime'){
                    $info['addtime'] = strtotime($info['addtime']);
                }
                if($k=='click'){
                    $patterns = "/\d+/";
                    $click = explode(" ",$info['click']);
                    preg_match_all($patterns,$info['click'],$arr);
                    $info['click'] = end($arr[0]);
                }
            }
            if(empty($info)){
                unset($info);
            }else{
                $info['type']=1;
            }
            $field_key = array_keys($info);
            $field_base_info = ['info_type','title','province_id','city_id','area_id','last_area_id','amount_interval_min','amount_interval_min_unit','amount_interval_max','amount_interval_max_unit','amount_range','amount','amount_unit','i_overview','i_introduce','i_other_remark','i_keywords','i_pic','i_att','is_open','click','i_att_other','uid','addtime','updatetime','trj_info_id','type'];
            foreach ($field_base_info as $vv){
                foreach ($field_key as $value) {
                    if($value==$vv){
                        $infos[$value] = $info[$value];
                    }
                } 
            }
            $field_fund_info =['tz_industry','tz_area','funds_body','zjf_fx_like','zjf_tp_like','zjf_pay_back','S115_min','S115_max','S115_unit','zjf_fk_claim','zjf_tz_type','extra_zjf_tz_type','zjf_tz_period','delfiles','S100','extra_S100','S108_min','S108_max','S108_unit','S110_min','S110_max','S110_unit','S201','S213','S214_min','S214_max','S214_unit'];
            foreach ($field_fund_info as $vv){
                foreach ($field_key as $value) {
                    if($value==$vv){
                        $infos['FundInfo'][$value] = $info[$value];
                    }
                } 
            }
            $trj_info_ids = M('BaseInfo')->field('trj_info_id')->select();
            $trj_info_ids = array_multi_to_single($trj_info_ids);
            if(!empty($trj_info_ids)){
                array_flip($trj_info_ids);
                if(isset($trj_info_ids[$info['trj_info_id']])){
                    unset($info);
                }
            }
            //print_r($infos);
            if(!empty($infos)){
                D('BaseInfo')->relation(true)->add($infos);
                $this->success('采集成功!');
            }else{
                $this->error('采集信息重复度过高,采集失败!');
            }
    }
]);
    }

    function multi_del($ids){
        //D('BaseInfo')->$where(['id'=>['in',$ids]])->relation(true)->delete();
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