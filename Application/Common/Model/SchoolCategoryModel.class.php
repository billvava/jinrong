<?php
namespace Common\Model;
use Think\Model;
class SchoolCategoryModel extends Model
	{
		protected $_validate = array(
			array('categoryname','require','{%article_category_null_error_categoryname}',1),
			array('categoryname','1,60','{%article_category_length_error_categoryname}',1,'length'),
		);
		protected $_auto = array (
			array('category_order',255),
			array('admin_set',0),
		);

		/**
		 * [article_category_cache 获取信息数据写入缓存]
		 */
		public function School_category_cache(){
			$aschool = array();
			$schoolData = $this->field('id,parentid,categoryname')->order('category_order desc,id')->select();
			foreach ($schoolData as $key => $val) {
				$school[$val['parentid']][$val['id']] = $val['categoryname'];
			}
			F('school_category',$school);
			return $school;
		}
		/**
		 * [get_article_category_cache 读取信息数据]
		 */
		public function get_school_category_cache($pid=0){
			if(false === $school = F('school_category')){
				$school = $this->school_category_cache();
			}
			if($pid === 'all') return $school;
			return $school[intval($pid)];
		}
		/**
	     * 后台有更新则删除缓存
	     */
	    protected function _before_write($data, $options) {
	        F('school_category', NULL);
	    }
	    /**
	     * 后台有删除也删除缓存
	     */
	    protected function _after_delete($data,$options){
	        $options['where']['id'][1] && $this->where(array('parentid'=>array('in',$options['where']['id'][1])))->delete();
	        F('school_category', NULL);
	    }
	}
?>
