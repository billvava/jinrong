<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class LoanController extends FrontendController{
	public function _initialize() {
		parent::_initialize();
	}

	public function apply_loan(){
        if(IS_POST){
            $data['province_id'] = I('post.province_id','');
            $data['city_id'] = I('post.city_id','');
            $data['area_id'] = I('post.area_id','');
            $data['last_area_id'] = I('post.last_area_id','');
            $data['realname'] = I('post.realname','');
            $data['yzm'] = I('post.yzm','');
            $data['mobile'] = I('post.mobile','');
            $step = I('post.step','');
            switch ($step) {
                case 1:
                    if($data['province_id'] && $data['last_area_id'] && $data['realname'] & $data['mobile']){
                    $log = M('Members')->where(['mobile'=>$data['mobile']])->find();
                    $smsVerify = session('reg_smsVerify');
                    if(!$smsVerify) $this->ajaxReturn(0,'验证码错误！');
                    if($data['mobile'] != $smsVerify['mobile']) $this->ajaxReturn(0,'手机号不一致！',$smsVerify);//手机号不一致
                    if(time()>$smsVerify['time']+60000) $this->ajaxReturn(0,'验证码过期！');//验证码过期
                    $sms_code = I('post.yzm',0,'intval');
                     $mobile_rand=substr(md5($sms_code), 8,16);
                    if($mobile_rand!=$smsVerify['code']) $this->ajaxReturn(0,'验证码错误！');
                    //验证码错误！
                    if(!$log){
                        if($data['mobile']){
                            $data['username'] = '7rh_'.$data['mobile'];
                            $data['mobile_audit'] = 1;
                            $data['utype'] = 4;
                            $data['realname'] = $data['realname'];
                            $pwd_hash = D('Members')->randstr();
                            $password= I('post.yzm',0,'intval');
                            $data['password'] = D('Members')->make_md5_pwd($password,$pwd_hash);
                            $data['pwd_hash'] = $pwd_hash;
                            $data['mobile_audit']=1;
                            $data['reg_time'] = time();
                            $data['status']=1;
                            $data['inner']=1;
                        }
                        M()->startTrans();
                        $result = M('Members')->add($data);
                        if(!$result){
                            return false;
                            M('Members')->rollback();
                            header('Content-type:text/json');
                            $result['code']=0;
                            $result['msg']='申请提交失败!';
                            echo json_encode($result);
                            exit;
                        }else{
                            $data['id'] = $result;
                            $data['step']=1;
                            $result = M('Loan')->add($data);
                            if($result){
                                M('Loan')->commit();
                                $result['status']=1;
                                $result['msg']='申请提交成功!';
                            }else{
                                M('Loan')->rollback();
                                $result['status']=0;
                                $result['msg']='申请提交失败!';
                                
                            }
                            header('Content-type:text/json');
                            echo json_encode($result);
                            exit;
                        }
                    }else{
                        $setp = M('Loan')->where(['mobile'=>$data['mobile']])->getfield('step');
                        if($step == '1'){
                            header('Content-type:text/json');
                            $result['status']=1;
                            $result['msg']='手机号已经注册';
                            echo json_encode($result);
                            exit;
                        }
                    }
                    header('Content-type:text/json');
                    $result['status']=1;
                    $result['msg']='基本资料填写完毕';
                    echo json_encode($result);
                    exit;
                    }else{
                        header('Content-type:text/json');
                        $result['status']=0;
                        $result['msg']='基本资料填写有误,请重写填写';
                        echo json_encode($result);
                        exit;
                    }
                    break;
                case 2:
                    $data = I('post.','');
                    $mobile = session('reg_smsVerify.mobile');
                    if($data['notes'] && isset($data['has_car']) && $data['idcard'] && $data['step'] ==2){
                    $member_id = M('Members')->where(['mobile'=>$mobile])->getfield('uid');
                    $re = M('Loan')->where(['id'=>$member_id])->save($data);
                        if($re !== false){
                            header('Content-type:text/json');
                            $result['status']=1;
                            $result['msg']='补充材料填写完毕';
                            echo json_encode($result);
                            exit;
                        }else{
                            $result['msg']='补充材料提交失败';
                            echo json_encode($result);
                            exit;
                        }
                    }else{
                        header('Content-type:text/json');
                        $result['status']=0;
                        $result['msg']='补充材料填写有误,请重写填写';
                        echo json_encode($result);
                        exit;
                    }
                    break;
                default:
                    break;
            }
        }
        if(C('visitor.uid') && C('visitor.utype')==4){
            $userinfo = M('Members')->where(['uid'=>C('visitor.uid')])->find();
            $userinfo_ext = M('Loan')->where(['uid'=>C('visitor.uid')])->find();
            $userinfo = array_merge_multi($userinfo,$userinfo_ext);
            $this->assign('userinfo',$userinfo);
        }
        $this->display();
	}
}
?>