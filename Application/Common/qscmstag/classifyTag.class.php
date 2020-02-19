<?php
/**
 * 分类
 */
namespace Common\qscmstag;
defined('THINK_PATH') or exit();
class classifyTag {
    protected $params = array();
    protected $limit;
    function __construct($options) {
        $array = array(
            '列表名'            =>  'listname',
            '类型'              =>  'act',
            '显示数目'          =>  'row',
            '名称长度'          =>  'titlelen',
            '填补字符'          =>  'dot',
            'id'                =>  'id',
            '地区分类'          =>  'citycategory',
            '职位分类'          =>  'jobcategory'
        );
        foreach ($options as $key => $value) {
            $this->params[$array[$key]] = $value;
        }
        $this->params['id']=isset($this->params['id'])?intval($this->params['id']):"all";
        $this->params['listname']=isset($this->params['listname'])?$this->params['listname']:"list";
        $this->params['titlelen']=isset($this->params['titlelen'])?intval($this->params['titlelen']):18;
        $this->params['dot']=isset($this->params['dot'])?$this->params['dot']:'';
        $this->limit=isset($this->params['row'])?intval($this->params['row']):0;
        $this->params['act']=isset($this->params['act'])?trim($this->params['act']):'';
    }

    public function run(){
        switch($this->params['act']){
            case 'QS_article':
                return $this->_get_article_category();
            case 'QS_help':
                return $this->_get_help_category();
            default:
                return $this->_get_category();
                break;
        }
    }

    protected function _get_category(){
        if($this->params['act']){
            $category = D('Category')->get_category_cache($this->params['act']);
        }else{
            $category = D('Category')->get_category_cache();
        }
        if($this->limit>0){
            $result = array_slice($result,0,$this->limit);
        }
        /*foreach ($category as $key => $value) {
            $value = cut_str($value,$this->params['titlelen'],0,$this->params['dot']);
        }*/
        return $category;
    }

    protected function _get_article_category(){
        $result = D('ArticleCategory')->get_article_category_cache($this->params['id']);
        if($this->limit>0){
            $result = array_slice($result,0,$this->limit);
        }
        return $result;
    }

    protected function _get_help_category(){
        if(false === $help_category = F('help_category_list')) $help_category = D('HelpCategory')->help_category_list();
        return $help_category;
    }
}