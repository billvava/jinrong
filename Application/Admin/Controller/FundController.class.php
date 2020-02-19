<?php
namespace Admin\Controller;
use Common\Controller\FrontendController;
class FundController extends FrontendController{
	
  public function _initialize(){
		parent::_initialize();
    $this->_mod = D('FundInfo');
	}

	public function fund_list(){
		if(!I('get.org','','trim') && C('PLATFORM') == 'mobile' && $this->apply['Mobile']){
			redirect(build_mobile_url(array('c'=>'Jobs','a'=>'index')));
		}
        $category = M('Category')->field('c_id,c_name,c_alias,ext_id')->select();
        $category_list = array();
        foreach($category as $k=>$v){
            if($v['ext_id']){
               $v['c_id']=$v['ext_id'];
            }
            $category_list[$v['c_alias']][$v['c_id']] = $v['c_name'];
        }
    $this->assign('category_list',$category_list);
		$fund_style = M('Category')->field('c_id')->where(['c_alias'=>'fund_style'])->select();
		$money_unit = array(1=>'万',10000=>'亿');
		$invest_type=array(1=>'项目融资',200=>'资产交易',700=>'政府招商',2005=>'投资理财',2010=>'股权投资',2011=>'债权投资',2012=>'金融投资',2013=>'BT/BOT 项目投资',2014=>'其他投资');
		$fund_list = M('FundInfo')->select();
		$fund_list = D('FundInfo')->changeList($fund_list);
		foreach ($fund_list as $k => $v) {
			$fund_list[$k]['amount_interval_min_unit'] =$money_unit[$v['amount_interval_min_unit']];
			$fund_list[$k]['amount_interval_max_unit'] =$money_unit[$v['amount_interval_max_unit']];
			$fund_list[$k]['info_type'] =$invest_type[$v['info_type']];
		}
		$this->assign('fund_list',$fund_list);
		$this->display();
	}

	public function fund_show($id){
        $money_unit = array(1=>'万',10000=>'亿');
		if($id){
			$info = M('FundInfo')->where(['id'=>$id])->find();
           $info['i_overview'] = strip_textarea($info['i_overview']);
           $info['i_introduce'] = strip_textarea($info['i_introduce']);
           $info['i_other_remark'] = strip_textarea($info['i_other_remark']);
           $category = D('Category');
           $info['funds_body'] = $category->findRecord($info['funds_body']);
            $info['tz_area'] = $category->findRecord($info['tz_area']);
           $info['tz_industry'] = $category->findRecord($info['tz_industry']);
           $info['zjf_tz_type'] = $category->findRecord($info['zjf_tz_type']);
           $info['zjf_tz_period'] = $category->findRecord($info['zjf_tz_period']);
           $info['s100'] = $category->findRecord($info['s100']);
           $info['s201'] = $category->findRecord($info['s201']);           
           $info['amount_interval_min_unit'] = $money_unit[$info['amount_interval_min_unit']];
           $info['amount_interval_max_unit'] = $money_unit[$info['amount_interval_max_unit']];
            if($info){
                //更新访问计数
                $viewsData=array();
                $viewsData['click'] = array('exp','click+1');
                $viewsData['id'] = $info['id'];
                D('FundInfo')->editData($viewsData);
            }else{
                $this->error('信息不存在!');
            }
		}
        $this->assign('info',$info);
		$this->display();
	}

}
?>