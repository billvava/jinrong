<?php
namespace Common\Model;
use Think\Model;
class FundInfoModel extends Model{
	
	public function changeList($list = array()){
        $newList = array();
        $category = D('Category');
        foreach ($list as $val){
            array_push($newList, $val);
        }
        return $newList;
	}

    public function process_info($info,$base_info){

        $info['S100'] = implode(',',I('post.S100'));
        $info['S201'] = implode(',',I('post.S201'));
        $base_info['info_type'] = I('post.info_type');
        $base_info['title'] = $base_info['title'];
        $base_info['province_id'] = I('post.province_id');
        $base_info['city_id'] = I('post.city_id');
        $base_info['area_id'] = I('post.area_id');
        $base_info['last_area_id'] = I('post.last_area_id');
        $base_info['amount_interval_min'] = I('post.amount_interval_min');
        $base_info['amount_interval_max'] = I('post.amount_interval_max');
        $base_info['amount_interval_min_unit'] = I('post.amount_interval_min_unit');
        $base_info['amount_interval_max_unit'] = I('post.amount_interval_max_unit');
        $base_info['amount'] = I('post.amount');
        $base_info['amount_unit'] = I('post.amount_unit');
        $base_info['i_pic'] = I('post.i_pic');
        $base_info['i_att'] = I('post.i_att');
        $base_info['is_open'] =2;
        if($base_info['info_type']==2010){
            $info['zjf_tz_type'] = implode(',',$info['zjf_tz_type']);
            $info['zjf_tz_period'] = implode(',',$info['zjf_tz_period']);
            $info['extra_zjf_tz_type'] = implode(',',$info['extra_zjf_tz_type']);
        }
        if($base_info['info_type']==2011){
            $info['zjf_fk_claim'] = implode(',',I('post.zjf_fk_claim'));
            $info['S213'] = implode(',',I('post.S213'));
        }
        if($base_info['info_type']==2012){
            $info['zjf_tp_like'] = implode(',',I('post.zjf_tp_like'));
        }
        $info['extra_S100']=implode(',',I('post.extra_S100'));
        $amount_range = $this->amount_range($info['amount_interval_min'],$info['amount_interval_max'],$info['amount_interval_min_unit'],$info['amount_interval_max_unit']);
        $result = $this->cal_range($amount_range[0],$amount_range[1]);
        $base_info['amount_range']=$result['num'];
        M('BaseInfo')->startTrans();
        $res = M('BaseInfo')->add($base_info);
        
        if(!empty($base_info['i_att'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att']]])->data(['info_id'=>$res])->save();
        }
        if(!empty($base_info['i_pic'])){
            M('Attach')->where(['id'=>['in',$base_info['i_pic']]])->data(['info_id'=>$res])->save();
        }
        if(!$res){
            $this->error = D('BaseInfo')->getError();
            return false;
        }
        $info['id'] = $res;
        $result = M('FundInfo')->add($info);
            return $res;
    }

    public function editData($data){
        $map = array();
        $map['id'] = $data['id'];
        return $this->where($map)->data($data)->save();
    }


    public function amount_range($a,$b,$c,$d){
        if($c==1){
                $c=10000;
           }else{
                $c=100000000;
           }
           if($d==1){
                $d=10000;
           }else{
                $d=100000000;
           }
           $e = $a*$c;
           $f = $b*$d;
           return array($e,$f);
    }

    public function cal_range($a,$b){
        if($a>0 && $b<=100000){
            $range['num'] = 1;
            $range['cn']='1万-10万';
        }elseif($a>=100000 && $b<=500000){
            $range['num'] = 2;
            $range['cn']='10万-50万';
        }elseif($a>=500000 && $b<=1000000){
            $range['num'] = 3;
            $range['cn']='50万-100万';
        }elseif($a>=1000000 && $b<=5000000){
            $range['num'] = 4;
            $range['cn']='100万-500万';
        }elseif($a>=5000000 && $b<=10000000){
            $range['num'] = 5;
            $range['cn']='500万-1000万';
        }elseif($a>=10000000 && $b<=50000000){
            $range['num'] = 6;
            $range['cn']='1000万-5000万';
        }elseif($a>=50000000 && $b<=100000000){
            $range['num'] = 7;
            $range['cn']='5000万-1亿';
        }elseif($a>100000000 || $b<100000000){
            $range['num'] = 8;
            $range['cn']='大于1个亿';
        }else{
            $range['num'] = 9;
            $range['cn']='什么也没有';
        }
        return $range;
    }

    public function save_data($data){
        $data['S100'] = implode(',',$data['S100']);
        $data['S201'] = implode(',',$data['S201']);
        $data['extra_S100'] = implode(',',$data['extra_S100']);
        if($data['info_type']==2010){
            $data['zjf_tz_type'] = implode(',',$data['zjf_tz_type']);
            $data['extra_zjf_tz_type'] = implode(',',$data['extra_zjf_tz_type']);
            $data['zjf_tz_period'] = implode(',',$data['zjf_tz_period']);
        }
        if($data['info_type']==2011){
            $data['S213'] = implode(',',$data['S213']);
            $data['zjf_fk_claim'] = implode(',',$data['zjf_fk_claim']);
        }
        if($data['info_type']==2012){
            $data['zjf_tp_like'] = implode(',',$data['zjf_tp_like']);
        }
        $amount_range = $this->amount_range($data['amount_interval_min'],$data['amount_interval_max'],$data['amount_interval_min_unit'],$data['amount_interval_max_unit']);
        $temp_result = $this->cal_range($amount_range[0],$amount_range[1]);
        $base_info['info_type'] = $data['info_type'];
        $base_info['title']=$data['title'];
        $base_info['province_id']=$data['province_id'];
        $base_info['city_id'] = $data['city_id'];
        $base_info['area_id'] = $data['area_id'];
        $base_info['last_area_id'] = $data['last_area_id'];
        $base_info['amount_interval_min'] = $data['amount_interval_min'];
        $base_info['amount_interval_min_unit'] = $data['amount_interval_min_unit'];
        $base_info['amount_interval_max'] = $data['amount_interval_max'];
        $base_info['amount_interval_max_unit'] = $data['amount_interval_max_unit'];
        $base_info['amount'] = $data['amount'];
        $base_info['amount_unit'] = $data['amount_unit'];
        $base_info['i_overview'] = trim($data['i_overview']);
        $base_info['i_introduce'] = trim($data['i_introduce']);
        $base_info['i_other_remark'] = trim($data['i_other_remark']);
        $base_info['i_pic'] = $data['i_pic'];
        $base_info['i_att'] = $data['i_att'];
        $base_info['i_att_other'] = $data['i_att_other'];
        $base_info['i_keywords'] = $data['i_keywords'];
        $base_info['updatetime'] = $data['updatetime'];
        $base_info['amount_range']=$temp_result['num'];
        unset($data['tz_area_area']);
            M('BaseInfo')->startTrans();
            $result = M('BaseInfo')->where(['id'=>$data['id']])->save($base_info);
            if(!empty($base_info['i_pic'])){
                M('Attach')->where(['id'=>['in',$base_info['i_pic']],'attach_type'=>'i_pic'])->data(['info_id'=>$data['id']])->save();
            }
            if(!empty($base_info['i_att'])){
                M('Attach')->where(['id'=>['in',$base_info['i_att']],'attach_type'=>'i_att'])->data(['info_id'=>$data['id']])->save();
            }
            if($result === false){
                return false;
            }
            $result = $this->where(['id'=>$data['id']])->save($data);
            if($result === false){
                $this->rollback();
                return false;
            }
            $this->commit();
            return true;
    }

}
?>