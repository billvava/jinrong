<?php
namespace Admin\Controller;
use Common\Controller\ConfigbaseController;
class SetComController extends ConfigbaseController {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('Config');
        $this->_name = 'Config';
    }
    public function index(){
        if(IS_POST){
            parent::_edit();
        }else{
            $setmeal = D('Setmeal')->select();
            $this->assign('setmeal',$setmeal);
            $increment = D('SetmealIncrement')->select();
            $this->assign('increment',$increment);
            $this->assign('cate_arr',D('SetmealIncrement')->cate_arr);
            parent::edit();
        }
    }
    public function set_task(){
        $model = D('Task');
        if(IS_POST){
            $idArr = I('post.id');
            $pointsArr = I('post.points');
            $timesArr = I('post.times');
            foreach ($idArr as $key => $val) {
                $data['points'] = $pointsArr[$key];
                $data['times'] = $timesArr[$key];
                $model->where(array('id' => $val))->save($data);
                unset($data);
            }
            $this->admin_write_log_unify();
            $this->success(L('operation_success'));
            exit;
        }
        $list = $model->where(array('utype'=>1))->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function login_remind(){
        parent::_edit();
        $this->display();
    }
	 public function search(){
        parent::_edit();
        $this->display();
    }
	public function set_points(){
        parent::_edit();
        $this->display();
    }
	public function set_meal(){
        if(IS_POST){
            parent::_edit();
        }else{
            $setmeal = D('Setmeal')->order('show_order desc,id')->select();
            $this->assign('setmeal',$setmeal);
        }
        $this->display();
    }
	public function set_margin(){
        if(IS_POST){
            if($_FILES['famous_company_img']['name']){
                $date = date('y/m/d/');
                $result = $this->_upload($_FILES['famous_company_img'], 'images/'.$date, array(
                        'maxSize' => 100,//图片最大100K
                        'uploadReplace' => true,
                        'attach_exts' => 'bmp,png,gif,jpeg,jpg'
                ));
                if ($result['error']) {
                    $_POST['famous_company_img'] = $date.$result['info'][0]['savename'];
                }
            }
        }
        parent::_edit();
        $this->display();
    }
	public function set_audit(){
        parent::_edit();
        $this->display();
    }
	public function set_quick(){
        parent::_edit();
        $this->display();
    }
}