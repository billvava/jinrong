<?php
/**
 * 用户控制器基类
 *
 */
namespace Common\Controller;
use Common\Controller\FrontendController;
class UserbaseController extends FrontendController {
    protected $visitor = null;
    public function _initialize() {
        parent::_initialize();
		$this->_total_sql();
    }
}