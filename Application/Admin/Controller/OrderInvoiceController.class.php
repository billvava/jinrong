<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class OrderInvoiceController extends BackendController{
	public function _initialize(){
		parent::_initialize();
		$this->_mod = D('OrderInvoice');
	}
	public function _before_index(){
		$this->order = 'audit asc';
		$this->assign('count',parent::_pending('OrderInvoice',array('audit'=>0)));
	}
	public function _before_search($data){
		$key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $where['uid'] = intval($key);
                    break;
                case 2:
                    $where['addressee'] = array('like','%'.$key.'%');
                    break;
            }
        }else{
            if($settr = I('request.settr',0,'intval')){
                $where['addtime'] = array('gt',strtotime("-".$settr." day"));
            }
        }
		return $data;
	}
	/**
	 * [set_audit 处理发票申请]
	 */
	public function set_audit(){
		$id = I('request.order_id');
        $audit = I('request.audit',0,'intval');
        if(empty($id)){
            $this->error('请选择记录！');
        }
        !is_array($id) && $id = array($id);
        $r = $this->_mod->where(array('order_id'=>array('in',$id)))->setField('audit',$audit);
        if(false !== $r){
            $this->admin_write_log_unify($id);
            $this->success('设置成功！响应行数'.$r);
        }else{
            $this->error('设置失败！');
        }
	}
	/**
	 * [edit 详情]
	 */
	public function invoice_show(){
		$id = I('get.order_id',0,'intval');
		!$id && $this->error('请选择发票内容！');
		$order = M('Order')->where(array('id'=>$id))->find();
		$order['username'] = M('Members')->where(array('uid'=>$order['uid']))->getfield('username');
		$this->assign('order',$order);
		$this->_tpl = 'invoice_show';
		parent::edit();
	}
}
?>