<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class PriceRangeController extends FrontendController{

    public function jsj($a,$b,$c,$d){
        $arr = $this->amount_range($a,$b,$c,$d);
        $result = $this->cal_range($arr[0],$arr[1]);
        return $result['num'];
    }
    
    public function js(){
        $info_list = M('BaseInfo')->field('id,amount_interval_min,amount_interval_max,amount_interval_min_unit,amount_interval_max_unit,amount_range')->select();
            foreach ($info_list as $k => $v) {
                $result = $this->jsj($v['amount_interval_min'],$v['amount_interval_max'],$v['amount_interval_min_unit'],$v['amount_interval_max_unit']);
                M('BaseInfo')->where(['id'=>$v['id']])->SetField('amount_range',$result);
            }
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

}
?>