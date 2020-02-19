<?php
namespace Home\Controller;
use QL\QueryList;
use QL\Ext\Lib\CurlMulti;
use QL\Ext\Multi;
use Common\Controller\FrontendController;
class CheckController extends FrontendController{

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


    public function check(){
        if(IS_POST){
            $qq = I('post.qq');
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
            $file_path = $base_root.'/'.$qq;
            $result = $this->collect($qq,$type='');
            $info = json_encode_no_zh($result);
            $result = file_put_contents($file_path,$info);
            if($result){
                $this->success('采集成功,正在为您跳转...');
                die();
            }
            $user_info = $result;
            if($user_info){
                pre($user_info);
                exit;
            }
        }
        $this->display();
    }

    public function collect($qq='',$type=''){
        if($qq){
            $qq = $qq;
        }else{
            $qq = I('get.qq');
        }
        if(!$qq){
            echo "qq不存在";
            exit;
        }
        if($qq){
            $url = 'http://www.175hd.com/level/'.$qq.'.html';
        }
        $rules=[
            'name' => array('.table1','text'),
        ];
        $temp_ext_info = QueryList::Query($url,$rules)->getData(function($info){
            return $info;
        });
        print_r($temp_ext_info);
        exit;

        return $temp_ext_info;
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