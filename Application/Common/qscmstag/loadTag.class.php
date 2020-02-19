<?php
/**
 * 合并加载JS和CSS文件
 *
 */
namespace Common\qscmstag;
defined('THINK_PATH') or exit();
class LoadTag {
    protected $jm;
    protected $options = array();
    function __construct($options) {
        $this->options = $options;
        import('Common.ORG.JSMin');
        $this->jm = new \JSMin();
    }
    /*
     * 生成默认JS文件(根据当前模型类名称)
    */
    public function def(){
    	$this->js(array('href'=>'__STATIC__/js/'.MODULE_NAME.'/'.__MODULE__.'.js'));
    }
    public function js() {
        $path = QSCMS_DATA_PATH . 'static/' . md5($this->options['href']) . '.js';
        $statics_url = C('qscms_statics_url') ? C('qscms_statics_url') : './static';
        if (!is_file($path)) {
            //静态资源地址
            $files = explode(',', $this->options['href']);
            $content = '';
            foreach ($files as $val) {
                $val = str_replace('__STATIC__', $statics_url, $val);
                $content.=file_get_contents($val);
            }
            file_put_contents($path, $this->jm->minify($content));
        }
        echo ( '<script type="text/javascript" src="' . __ROOT__ . '/data/static/' . md5($this->options['href']) . '.js?"></script>');
    }
    /**
     * [category 生成项目所需枚举类js缓存]
     * @return [js]                  [js文件]
     */
    public function category(){
        if($this->options['search'] && C('SUBSITE_VAL.s_id') > 0) $cache = '_'.C('SUBSITE_VAL.s_id');

        $path = QSCMS_DATA_PATH . 'static/' . md5('cache_classify') . $cache . '.js';

        $statics_url = C('qscms_statics_url') ? C('qscms_statics_url') : './static';

        if (!is_file($path)){
            $content = '';
            $category = D('Category')->get_category_cache();
            foreach ($category as $key => $val) {
                $arr = array();
                foreach ($val as $_key=>$_val) {
                    $arr[] = '"'.$_key.','.$_val.'"';
                }
                $arr = implode(',',$arr);
                $content.="var {$key}=new Array({$arr});";
            }
            file_put_contents($path,$this->jm->minify($content));
        }
        echo ( '<script type="text/javascript" src="' . __ROOT__ . '/data/static/' . md5('cache_classify') . $cache . '.js?"></script>');
    }

    /**
     * [spell_assembly 数组转字符串]
     * @param  [array]     $data    [被转换的数组]
     * @param  string      $p       [间隔字符]
     * @return [string]             [处理结果]
     */
    public function spell_assembly($data,$p=',',$s='"'){
        foreach ($data as $key=>$val) {
            $arr[] = $s.$val['spell'].','.$val['categoryname'].$s;
        }
        $arr = implode($p,$arr);
        if(!$s) return '"'.$arr.'"';
        return $arr;
    }
    /**
     * [assembly 数组转字符串]
     * @param  [array]     $data    [被转换的数组]
     * @param  string      $p       [间隔字符]
     * @return [string]             [处理结果]
     */
    public function assembly($data,$p=',',$s='"'){
        foreach ($data as $key=>$val) {
            $arr[] = $s.$key.','.$val.$s;
        }
        $arr = implode($p,$arr);
        if(!$s) return '"'.$arr.'"';
        return $arr;
    }
}