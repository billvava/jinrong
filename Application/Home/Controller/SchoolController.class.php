<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class SchoolController extends FrontendController{
	// 初始化函数
	public function _initialize(){
		parent::_initialize();
	}

	public function index(){
        $tzbk = M('ArticleCategory')->where(['parentid'=>21])->select();
        $rzbk = M('ArticleCategory')->where(['parentid'=>22])->select();
        $zjbk = M('ArticleCategory')->where(['parentid'=>23])->select();
        $dbbk = M('ArticleCategory')->where(['parentid'=>24])->select();
        $success_list = M('article')->where(['type_id'=>25])->limit(4)->select();
        foreach ($success_list as $key => $value) {
            $content = htmlspecialchars_decode($value['content'],ENT_QUOTES);
            $str1 = strstr($content, "简介：");
            $str2 = strstr($content,"特刊展示：");
            $str3 = str_replace($str2, "", $str1);
            $str3 = $this->cut_string($str3);
            $success_list[$key]['content'] = $str3;
        }
        $contract_list = M('article')->field('id,title')->where(['type_id'=>29])->limit(14)->select();
        $law_list = M('article')->field('id,title')->where(['type_id'=>30])->limit(14)->select();
        $help_list = M('help')->field('id,title')->where(['type_id'=>41])->limit(6)->select();
        $business_plan = M('article')->field('id,title')->where(['type_id'=>95])->limit(12)->select();
        $this->assign('business_plan',$business_plan);
        $this->assign('law_list',$law_list);
        $this->assign('help_list',$help_list);
        $this->assign('success_list',$success_list);
        $this->assign('contract_list',$contract_list);
        $this->assign('tzbk',$tzbk);
        $this->assign('rzbk',$rzbk);
        $this->assign('zjbk',$zjbk);
        $this->assign('dbbk',$dbbk);
        $this->display('school2');
	}


    //过滤字符串中的HTML CSS JS
    public function cut_string($string,$length=90,$ellipsis="..."){
        $string = strip_tags($string);
        $string=preg_replace('/\n/is','',$string);
        $string=preg_replace('/ |　/is','',$string);
        $string=preg_replace('/&nbsp;/is','',$string);
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);
        if(is_array($string)&&!empty($string[0])){
            if(is_numeric($length)&&$length){
                $string=join('',array_slice($string[0],0,$length)).$ellipsis;
            }else{
                $string=implode('',$string[0]);
            }
        }else{
            $string = '';
        }
        return $string;
    }
	
}
?>