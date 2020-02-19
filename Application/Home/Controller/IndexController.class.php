<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class IndexController extends FrontendController{
	public function _initialize() {
        parent::_initialize();
    }

	/**
	 * [index 首页]
	 */
	public function index(){
        $url = $_SERVER['HTTP_HOST'];
        if($url=="goldconnectllc.com" || $url=="www.goldconnectllc.com"){
            $this->display('goldconnectllc');
            exit;
        }
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
            redirect(build_mobile_url());
		}
		if(false === $oauth_list = F('oauth_list')){
            $oauth_list = D('Oauth')->oauth_cache();
        }
        $this->assign('url',$url);
        $this->assign('verify_userlogin',$this->check_captcha_open(C('qscms_captcha_config.user_login'),'error_login_count'));
		$this->assign('oauth_list',$oauth_list);
        $category = F('category');

		$fund_list_2010 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.title,bi.info_type,fi.funds_body')->where(['bi.info_type'=>2010,'bi.is_open'=>1])->order('bi.id desc')->limit(5)->select();
		$this->assign('fund_list_2010',$fund_list_2010);
        $fund_list_2011 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.title,bi.info_type,fi.funds_body')->where(['info_type'=>2011,'bi.is_open'=>1])->order('bi.id desc')->limit(5)->select();
        $this->assign('fund_list_2011',$fund_list_2011);
        $fund_list_2014 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->field('bi.id,bi.title,bi.info_type,fi.funds_body')->where(['info_type'=>2014,'bi.is_open'=>1])->order('bi.id desc')->limit(5)->select();
        $this->assign('fund_list_2014',$fund_list_2014);


        //$where['A.class_id'] = array('in','366,370,373,383,392,400');

		$item_list_366 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id =ii.id')->field('bi.id,bi.title,bi.info_type,bi.province_id')->where(['ii.industry_id'=>366,'bi.is_open'=>1])->order('bi.updatetime desc')->limit(5)->select();
		$this->assign('item_list_366',$item_list_366);
		$item_list_370 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id =ii.id')->field('bi.id,bi.title,bi.info_type,bi.province_id')->where(['ii.industry_id'=>370,'bi.is_open'=>1])->order('bi.updatetime desc')->limit(5)->select();
        $this->assign('item_list_370',$item_list_370);
		$item_list_373 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id =ii.id')->field('bi.id,bi.title,bi.info_type,bi.province_id')->where(['ii.industry_id'=>373,'bi.is_open'=>1])->order('bi.updatetime desc')->limit(5)->select();
        $this->assign('item_list_373',$item_list_373);
		$item_list_383 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id =ii.id')->field('bi.id,bi.title,bi.info_type,bi.province_id')->where(['ii.industry_id'=>383,'bi.is_open'=>1])->order('bi.updatetime desc')->limit(5)->select();
        $this->assign('item_list_383',$item_list_383);
		$item_list_392 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id =ii.id')->field('bi.id,bi.title,bi.info_type,bi.province_id')->where(['ii.industry_id'=>392,'bi.is_open'=>1])->order('bi.updatetime desc')->limit(5)->select();
        $this->assign('item_list_392',$item_list_392);
        $item_list_400 = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ as ii on bi.id =ii.id')->field('bi.id,bi.title,bi.info_type,bi.province_id')->where(['ii.industry_id'=>400,'bi.is_open'=>1])->order('bi.updatetime desc')->limit(5)->select();
        $this->assign('item_list_400',$item_list_400);

		$condition['i_overview'] = array('neq','');
		$success_case = M('BaseInfo')->field('title,i_overview')->where($condition)->find();
        $this->assign('success_case',$success_case);
        $top_report = M('Article')->field('id,type_id,title,small_img')->where(['type_id'=>94])->find();
        $this->assign('top_report',$top_report);
        $this->assign('category',$category);


        $info_root = ROOT_PATH.'Application/Home/View/default/public/images/banner';
        $base_root = str_replace("\\", '/',$info_root);
        if(is_dir($base_root)){
            $file = scandir($base_root);
            unset($file[0]);
            unset($file[1]);
        }
        $imgUrl = [];
        foreach ($file as $k => $v) {
            $imgUrl[$k] = "/Application/Home/View/default/public/images/banner/".$v;
        }
        $this->assign('imgUrl',$imgUrl);


		$this->display();
	}

    // function uuu(){
    //     'http://www.175hd.com/level/'.'277285371'
    // }


    function group_seach(){
        $result=M('Members2')->field('uid,trj_company_id,count(trj_company_id) as num')->order('num desc')->group('trj_company_id')->select();
        print_r($result);
        exit;
    }

    //网站项目方和资金方信息批量更新时间
    function muiti_edit_update(){
        $base_info = M('BaseInfo')->field('id,addtime,updatetime')->where(['type'=>1])->order('addtime desc')->limit(774)->select();
        $day_time = strtotime(date("Y-m-d"));
        foreach ($base_info as $k =>$v) {
            M('BaseInfo')->where(['id'=>$v['id']])->SetField('updatetime',$day_time);
        }
    }

	/**
	 * [ajax_user_info ajax获取用户登录信息]
	 */
	public function ajax_user_info(){
		if(IS_AJAX){
			!$this->visitor->is_login && $this->ajaxReturn(0,'请登录！');
			$uid = C('visitor.uid');
			if(C('visitor.utype') == 1){
				$info = M('Members')->field('username')->where(array('uid'=>$uid))->find();
			}else{
				$info['username'] = M('Members')->where(array('uid'=>$uid))->getfield('username');
			}
			$this->assign('info',$info);
			$hour=date('G');
			if($hour<11){
				$am_pm = '早上好';
	        }else if($hour<13){
	        	$am_pm = '中午好';
	        }else if($hour<17){
	        	$am_pm = '下午好';
	        }else{
	        	$am_pm = '晚上好';
	        }
	        $this->assign('am_pm',$am_pm);
			$data['html'] = $this->fetch('ajax_user_info');
        	$this->ajaxReturn(1,'',$data);
		}
	}
	/**
	 * [index 首页搜索跳转]
	 */
	public function search_location(){
		$act = I('get.act','','trim');
		$key = I('get.key','','trim');
		$this->ajaxReturn(1,'',url_rewrite($act,array('key'=>$key)));
	}

	public function verify(){
        $Verify = new \Think\Verify();
        $Verify->useNoise = true;
        $Verify->codeSet = '0123456789';
        $Verify->useCurve = false;
        $Verify->fontSize = 50;
        $Verify->length   = 4;
        //$Verify->entry_add();
        $Verify->entry();
        //验证方法：
        //if (!check_verify($verify,'','add')) {
        //$this->error('验证码错误！');
        //return;
        //}

        /*
		$Verify = new \Think\Verify();
        $Verify->fontSize = 32;
        $Verify->length   = 4;
        $Verify->useImgBg = true;
        $Verify->entry();
        */
	}

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = '',$type=''){
        $Verify = new \Think\Verify();
        if($type='add'){
            return $Verify->check_add($code, $id);
          }else{
            return $Verify->check($code, $id);
        }
    }

    function get_yzm(){
        $code=session();
        print_r($code);
        exit;
    }

	function mergById($arr1, $arr2, $id){
        $tmp = array();
        foreach($arr2 as $record){
            $tmp[$record[$id]][] = $record;
        }
        $arr3 = array();
        foreach($arr1 as $record){
            $arr3[] = $record;
            if(isset($tmp[$record[$id]])){
                foreach($tmp[$record[$id]] as $sameIdRecord){
                    $arr3[] = $sameIdRecord;
                }
            }
        }
        return $arr3;
    }


	function terms_conditions(){
        $this->display();
    }

	function read_area(){
		$this->readLog(__ROOT__."area.json");
	}

	function readLog($filename){
	    if(file_exists($filename)){
	        $result = file_get_contents($filename);
	        $result = json_decode($result,true);
	        foreach ($result as $k => $v){
	        	$data['id'] = $k;
	        	$data['pid'] = $result[$k]['pid'];
	        	$data['pid'] = $result[$k]['pid'];
	        	$data['name'] = $result[$k]['name'];
	        	$data['cshort'] = $result[$k]['cshort'];
	        	$data['type'] = $result[$k]['type'];
	        	$data['value'] = $result[$k]['value'];
	        	M('Area')->add($data);
	        }
	    }else{
	    	echo "文件不存在!";
	    }
	}

	public function build_category(){
        $category = M('Category')->field('c_id,c_name,c_alias,ext_id')->select();
        $category_list = array();
        foreach($category as $k=>$v){
            if($v['ext_id']){
               $v['c_id']=$v['ext_id'];
            }
            $category_list[$v['c_alias']][$v['c_id']] = $v['c_name'];
        }
        $temp_province = M('Area')->field('id,name,type')->where(['type'=>1])->select();
        $sheng =array();
        foreach ($temp_province as $k => $v){
             $sheng[$v['id']] =$v['name'];
        }
        ksort($sheng);
        $category_list['province'] = $sheng;
        F('category_list',$category_list);
    }

	/**
	 * 保存到桌面
	 */
	public function shortcut(){
		$Shortcut = "[InternetShortcut]
		URL=".C('qscms_site_domain').C('qscms_site_dir')."?lnk
		IDList=
		IconFile=".C('qscms_site_domain').C('qscms_site_dir')."favicon.ico
		IconIndex=100
		[{000214A0-0000-0000-C000-000000000046}]
		Prop3=19,2";
		header("Content-type: application/octet-stream");
		$ua = $_SERVER["HTTP_USER_AGENT"];
		$filename=C('qscms_site_name').'.url';
		$filename = urlencode($filename);
		$filename = str_replace("+", "%20", $filename);
		if (preg_match("/MSIE/", $ua)){
		    header('Content-Disposition: attachment; filename="' . $filename . '"');
		}else if(preg_match("/Firefox/", $ua)){
		    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
		}else{
		    header('Content-Disposition: attachment; filename="' . $filename . '"');
		}
		exit($Shortcut);
	}

    function ttt(){
        print_r(get_C('qscms_attach_path'));
        exit;
    }

    function cn(){
        print_r(C());
        exit;
    }


    /*
     * 极验验证码
     * 2017年9月15日 14:02:23
     */
    public function StartCaptchaServlet(){
        $GtSdk = new \Common\Util\Geetestlib('6f8ae6847dd463e52a4fac0569901e3a','b3fcfdd5a205a69a2a0fd9704c2cdb34');
        $data = array(
            "user_id" => session_id(), # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => get_client_ip() # 请在此处传输用户请求验证时所携带的IP
        );
        $status = $GtSdk->pre_process($data, 1);
        session('gtserver',$status);
        session('user_id',$data['user_id']);
        echo $GtSdk->get_response_str();
        exit();
    }
}
?>