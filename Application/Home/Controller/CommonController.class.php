<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class CommonController extends FrontendController{
	public function _initialize() {
		parent::_initialize();
	}

    function send_email(){
        $info_id = I('info_id');
        $info = M('BaseInfo')->where(['id'=>$info_id])->find();
        if(!$info_id){
            $this->ajaxReturn(0,'信息id不存在！');
        }
        if(IS_POST){
            $email = I('post.email');
            if(is_email($email)){
                $to = $email;               
                if($info['type'] == 1){
                    $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __FUND_INFO__ as fi on bi.id =fi.id')->where(['bi.id'=>$info_id])->find();
                    $info = fund_info_tz_area($info);
                    $info['area'] = link_area($info['province_id'],$info['city_id'],$info['area_id']);
                    $info['i_overview'] = strip_textarea($info['i_overview']);
                    $info['i_introduce'] = strip_textarea($info['i_introduce']);
                    $info['i_other_remark'] = strip_textarea($info['i_other_remark']);
                    $info['funds_body_cn'] = field_get_name($info['funds_body'],$field='funds_body');
                    $info['tz_industry'] = field_get_name($info['tz_industry'],$field='tz_industry');
                    $info['zjf_tz_type'] = field_get_name($info['zjf_tz_type'],$field='zjf_tz_type');
                    $info['zjf_tz_period'] = field_get_name($info['zjf_tz_period'],$field='zjf_tz_period');
                    $info['s100'] = field_get_name($info['s100'],$field='S100');
                    $info['s201'] = field_get_name($info['s201'],$field='S201');
                    $info['i_keywords'] = explode('，',str_replace('标签：','',$info['i_keywords']));
                    if($info['amount_interval_min'] ==$info['amount_interval_max'] && $info['amount_interval_min_unit'] ==$info['amount_interval_max_unit']){
                         unset($info['amount_interval_max'],$info['amount_interval_max_unit']);
                    }
                    $info['amount_interval_min_unit'] = $category['money_unit_min'][$info['amount_interval_min_unit']];
                    $info['sex_cn'] = $sex_cn[$info['sex']];
                    $info['amount_interval_max_unit'] = $category['money_unit_min'][$info['amount_interval_max_unit']];
                    $this->assign('info',$info);
                    $body = $this->fetch('Emailtpl/email_fund_info');
                }else{
                    $category = F('category');
                    $info = M('BaseInfo')->alias('bi')->join('LEFT JOIN __ITEM_INFO__ ii on bi.id =ii.id')->where(['bi.id'=>$info_id])->find();
                    $info['area'] = link_area($info['province_id'],$info['city_id'],$info['area_id']);
                    $info['info_type'] = $category['info_type'][$info['info_type']];
                    $info['amount_interval_min_unit'] = $category['money_unit'][$info['amount_interval_min_unit']];
                    $info['amount_interval_max_unit'] = $category['money_unit'][$info['amount_interval_max_unit']];
                    $info['xmrz_body'] = $category['xmrz_body'][$info['xmrz_body']];
                    $info['industry_id'] = $category['industry_id'][$info['industry_id']];
                    $info['i_overview'] = nl2br($info['i_overview']);
                    $info['i_keywords'] = explode('，',str_replace('标签：','',$info['i_keywords']));
                    $info['s11'] = $category['s11'][$info['s11']];
                    $this->assign("info",$info);
                    $body = $this->fetch('Emailtpl/email_item_info');
                }
                $result = company_send_mail($to, $name='', $subject = $subject, $body=$body);
                if($result==1){
                    $this->ajaxReturn(1,'发送成功');
                }
            }else{
                $this->ajaxReturn(0,'邮箱格式不正确');
            }
        }
        $this->assign('info_id',$info_id);
        $tpl=$this->fetch('ajax_send_email');
        $this->ajaxReturn(1,'加载成功！',$tpl);
    }

    function send_success(){
        $tpl=$this->fetch('send_success');
        $this->ajaxReturn(1,'加载成功！',$tpl);
    }
}
?>