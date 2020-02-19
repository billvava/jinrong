<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class HuodongController extends FrontendController{
	public function _initialize(){
        parent::_initialize();
    }
	public function index(){
		$this->display();
	}
	public function huodong_list(){
        $huodong_list = M('Huodong')->select();
        $this->assign('huodong_list',$huodong_list);
		$this->display();
	}
    public function show(){
        $id = I('get.id');
        if($id){
        $info = M('Huodong')->where(['id'=>$id])->find();
        M('Huodong')->where(['id'=>$id])->setInc('click');
        }else{
            $this->error('信息不存在');
        }
        $this->assign('info',$info);
        $this->display();
    }
}
?>