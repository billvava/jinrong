<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class MailTemplatesController extends BackendController{
	public function _initialize() {
        parent::_initialize();
    }
    public function _before_search($data){
        $data['status'] = 1;
        $this->order = 'id asc';
        return $data;
    }
    public function _after_select($data){
        $data['variate'] = unserialize($data['variate']);
        return $data;
    }
}
?>