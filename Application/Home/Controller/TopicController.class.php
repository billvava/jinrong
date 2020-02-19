<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class TopicController extends FrontendController{
	public function _initialize(){
        parent::_initialize();
    }

	public function index($id=''){
			if($id==''){
					$this->error('信息不存在!');
			}
			$info = M('BaseInfo')->where(['id'=>$id])->find();
			if($style){
				$this->assign('info',$info);
				$this->dispaly();
			}else{
				$this->dispaly();
			}
	}


}
?>
