<?php
namespace Common\Model;
use Think\Model;
class SmsTemplatesModel extends Model{
	protected $_validate = array(
		//模板不能为空
		array('value','require','{%sms_template_null_error_value}',1),
	);
	protected $_auto = array (
		array('variate','_serialize',3,'callback'),
	    array('status','1'),  // 新增的时候把status字段设置为1
	    array('update_time','time',3,'function'), // 对create_time字段在更新的时候写入当前时间戳
	);
	protected function _serialize($data){
		return $data?serialize($data):'';
	}
	/**
	 * [sms_tpl_cache 短信模板缓存生成]
	 * @return [array]
	 */
	public function sms_tpl_cache(){
		$smsTplList = $this->where(array('status'=>1))->getfield('id,name,alias,value');
		F('sms_tpl',$smsTplList);
		return $smsTplList;
	}
	/**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
    	D('SmsOauth')->where(array('tid'=>$data['id']))->setfield('status',0);
        F('sms_tpl', NULL);
    }
    /**
     * 后台有删除也删除缓存
     */
    protected function _after_delete($data,$options){
		D('SmsOauth')->where(array('tid'=>$data['id']))->delete();
        F('sms_tpl', NULL);
    }
}
?>