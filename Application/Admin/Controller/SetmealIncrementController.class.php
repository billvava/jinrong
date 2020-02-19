<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class SetmealIncrementController extends BackendController {
    public function _initialize() {
        parent::_initialize();
        $this->_name = 'SetmealIncrement';
        $this->_mod = D('SetmealIncrement');
    }
    public function _before_index(){
        $this->pagesize = 100;
    }
    public function _after_search(){
        $this->assign('service_type',D('SetmealIncrement')->cate_arr);
    }
    public function add(){
    	if(!IS_POST){
    		$this->assign('cate_arr',$this->_mod->cate_arr);
    		$this->assign('setmeal',D('Setmeal')->get_setmeal_cache());
    	}else{
    		$info = I('post.');
    		$info['discount'] = serialize($info['discount']);
    		$r = $this->_mod->create($info);
    		if($r){
    			$insert_id = $this->_mod->add();
                $this->admin_write_log_unify($insert_id);
    		}else{
    			$this->error($this->_mod->getError());
    		}
    		$this->success('保存成功！');
    		exit;
    	}
    	$this->display();
    }
    public function edit(){
    	$id = I('request.id',0,'intval');
    	if(!$id){
    		$this->error('参数错误！');
    	}
    	if(!IS_POST){
    		$this->assign('cate_arr',$this->_mod->cate_arr);
    		$this->assign('info',$this->_mod->getone($id));
    		$this->assign('setmeal',D('Setmeal')->get_setmeal_cache());
    	}else{
    		$info = I('post.');
    		$info['discount'] = serialize($info['discount']);
    		$r = $this->_mod->create($info);
    		if($r){
    			$this->_mod->save();
                $this->admin_write_log_unify($insert_id);
    		}else{
    			$this->error($this->_mod->getError());
    		}
    		$this->success('保存成功！');
    		exit;
    	}

    	$this->display();
    }
}