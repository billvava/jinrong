<?php
/*
 *简历模型类
 */
namespace Common\Model;
use Think\Model\RelationModel;
class ItemInfoModel extends RelationModel{
	
	public function changeList($list = array()){
        $newList = array();
        $category = D('Category');
        foreach ($list as $val) {
            //$val['industry_id'] = $category->findRecord($val['industry_id']); // 投资主体
            //$val['xmrz_intention'] = $category->findRecord($val['xmrz_intention']); // 投资类型
            array_push($newList, $val);
        }
        return $newList;
	}

	public function admin_del_iteminfo($id){
		if (!is_array($id)) $id=array($id);
		$sqlin = implode(',',$id);
		$where['id']=array('in',$id);
		if(false === $id_num = $this->where($where)->delete()) return false;
		return true;
	}

    public function saveData(){
        $data = $this->create();
        if(!$data){
            return false;
        }
        if(empty($data['id'])){
            return false;
        }
        $data['xmrz_type'] = implode(',',$data['xmrz_type']);
        $data_ext['xmf_zs_way'] = implode(',',$data['xmf_zs_way']);
        $data_ext['extra_xmf_zs_way'] = implode(',',$data['extra_xmf_zs_way']);
        $data['S11'] = implode(',',$data['S11']);
        $data['S23'] = implode(',',$data['S23']);
        $data['S24'] = implode(',',$data['S24']);
        $data['S26'] = implode(',',$data['S26']);
        $data['extra_S23'] = implode(',',$data['extra_S23']);
        $data['extra_S24'] = implode(',',$data['extra_S24']);
        $data['extra_S26'] = implode(',',$data['extra_S26']);
        $data['extra_S19'] = implode(',',$data['extra_S19']);
        $amount_range = $this->amount_range($data['amount_interval_min'],$data['amount_interval_max'],$data['amount_interval_min_unit'],$data['amount_interval_max_unit']);
        $result = $this->cal_range($amount_range[0],$amount_range[1]);
        $base_info['amount_range']=$result['num'];
        $base_info['id']=I('post.id');
        $base_info['title']=I('post.title');
        $base_info['info_type']=I('post.info_type');
        $base_info['province_id']=I('post.province_id');
        $base_info['city_id']=I('post.city_id');
        $base_info['area_id']=I('post.area_id');
        $base_info['last_area_id']=I('post.last_area_id');
        $base_info['amount_interval_min']=I('post.amount_interval_min');
        $base_info['amount_interval_min_unit']=I('post.amount_interval_min_unit');
        $base_info['amount_interval_max']=I('post.amount_interval_max');
        $base_info['amount_interval_max_unit']=I('post.amount_interval_max_unit');
        $base_info['amount']=I('post.amount');
        $base_info['amount_unit']=I('post.amount_unit');
        $base_info['i_overview']=I('post.i_overview','','trim');
        $base_info['i_introduce']=I('post.i_introduce','','trim');
        $base_info['i_other_remark']=I('post.i_other_remark','','trim');
        $base_info['i_pic']=I('post.i_pic');
        $base_info['i_att']=I('post.i_att');
        $base_info['i_att_ppt']=I('post.i_att_ppt');
        $base_info['i_att_other']=I('post.i_att_other');
        $base_info['i_keywords']=I('post.i_keywords');
        $base_info['updatetime']=time();
        $res = M('BaseInfo')->where(['id'=>$base_info['id']])->save($base_info);
        if(!empty($base_info['i_att'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att']],'attach_type'=>'i_att'])->data(['info_id'=>$base_info['id']])->save();
        }
        if(!empty($base_info['i_pic'])){
            M('Attach')->where(['id'=>['in',$base_info['i_pic']],'attach_type'=>'i_pic'])->data(['info_id'=>$base_info['id']])->save();
        }
        if(!empty($base_info['i_att_ppt'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att_ppt']],'attach_type'=>'i_att_ppt'])->data(['info_id'=>$base_info['id']])->save();
        }
        if(!empty($base_info['i_att_other'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att_other']],'attach_type'=>'i_att_other'])->data(['info_id'=>$base_info['id']])->save();
        }
        if($res){
            $status = $this->save($data);
        }
        if($status === false){
            return false;
        }
        return true;
    }


    /*
    public function jsj(){
        $arr = $this->amount_range($a=100,$b=500,$c='万',$d='万');
        $result = $this->cal_range($arr[0],$arr[1]);
        return $result['num'];
    }
    */

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

	public function process_info($info,$base_info){

        $base_info['info_type'] = I('post.info_type');
        $base_info['title'] = I('post.title');
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
        $base_info['is_open'] =2;
        M('BaseInfo')->startTrans();
		unset($info['attxmrz_intention_div']);
        unset($info['extra_S19']);
        unset($info['extra_S23']);
        //处理区间金额
        $amount_range = $this->amount_range($info['amount_interval_min'],$info['amount_interval_max'],$info['amount_interval_min_unit'],$info['amount_interval_max_unit']);
        $result = $this->cal_range($amount_range[0],$amount_range[1]);
        $base_info['amount_range']=$result['num'];
        $res = M('BaseInfo')->add($base_info);
        if(!empty($base_info['i_pic'])){
            M('Attach')->where(['id'=>['in',$base_info['i_pic']]])->data(['info_id'=>$res])->save();
        }
        if(!empty($base_info['i_att'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att']]])->data(['info_id'=>$res])->save();
        }
        if(!empty($base_info['i_att_ppt'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att_ppt']]])->data(['info_id'=>$res])->save();
        }
        if(!empty($base_info['i_att_other'])){
            M('Attach')->where(['id'=>['in',$base_info['i_att_other']]])->data(['info_id'=>$res])->save();
        }
        if(!$res){
            $this->error = D('BaseInfo')->getError();
            return false;
        }
        $data['zjf_tz_type'] = implode(',',$data['zjf_tz_type']);
        $info['S11'] = implode(',',I('post.S11'));
        $info['S23'] = implode(',',I('post.S23'));
        $info['S24'] = implode(',',I('post.S24'));
        $info['S26'] = implode(',',I('post.S26'));
        $info['extra_S19'] = implode(',',I('post.extra_S19'));
        $info['extra_S23'] = implode(',',I('post.extra_S23'));
        $info['extra_S24'] = implode(',',I('post.extra_S24'));
        $info['extra_S26'] = implode(',',I('post.extra_S26'));
        $info['xmrz_type'] = implode(',',I('post.xmrz_type'));
        $info['id'] = $res;
        $result = M('ItemInfo')->add($info);
        if(!$result){
            $this->error = D('ItemInfo')->getError();
            return false;
        }
        if($info['info_type']==200){
            $data['id'] = $res;
            $data['xmzc_type'] = $info['xmzc_type'];
            //房屋
            if($info['xmzc_type']==493){
                $data['S38'] = implode(',',I('post.S38'));
                $data['S39'] = $info['S39'];
                $data['S40'] = $info['S40'];
                $data['S41'] = $info['S41'];
                $data['S42'] = $info['S42'];
                $data['S43'] = strtotime($info['S43']);
            }
            //土地
            if($info['xmzc_type']==494){
                $data['S44'] = $info['S44'];
                $data['S45'] = $info['S45'];
                $data['S46'] = $info['S46'];
                $data['S47'] = $info['S47'];
                $data['S48'] = $info['S48'];
                $data['S49'] = $info['S49'];
                $data['S50'] = $info['S50'];
            }
            //交通工具
            if($info['xmzc_type']==495){
                $data['S51'] = $info['S51'];
                $data['S52'] = $info['S52'];
                $data['S53'] = $info['S53'];
                $data['S54'] = $info['S54'];
            }
            //机械设备
            if($info['xmzc_type']==496){
                $data['S55'] = $info['S55'];
                $data['S56'] = $info['S56'];
                $data['S57'] = $info['S57'];
            }
            //账款债权
            if($info['xmzc_type']==497){
                $data['S58'] = $info['S58'];
                $data['S58_unit'] = $info['S58_unit'];
            }
            //有价票据
            if($info['xmzc_type']==498){
                $data['S59'] = $info['S59'];
                $data['S59_unit'] = $info['S59_unit'];
            }
            //无形资产
            if($info['xmzc_type']==499){
                $data['S62'] = $info['S62'];
            }
            //股权
            if($info['xmzc_type']==500){
                $data['S63'] = $info['S63'];
                $data['S64'] = $info['S64'];
                $data['S65'] = $info['S65'];
            }
            //金融资产
            if($info['xmzc_type']==501){
                $data['S60'] = $info['S60'];
                $data['S60_unit'] = $info['S60_unit'];
                $data['S61'] = $info['S61'];
            }
            //林权
            if($info['xmzc_type']==502){
                $data['S73'] = $info['S73'];
                $data['S73_unit'] = $info['S73_unit'];
                $data['S74'] = $info['S74'];
            }
            //存货
            if($info['xmzc_type']==503){
                $data['S75'] = $info['S75'];
                $data['S76'] = $info['S76'];
                $data['S77'] = $info['S77'];
                $data['S78'] = $info['S78'];
            }
            //收藏品
            if($info['xmzc_type']==504){
                $data['S79'] = $info['S79'];
                $data['S79_unit'] = $info['S79_unit'];
            }
            //经营权
            if($info['xmzc_type']==505){
                $data['S80'] = $info['S80'];
                $data['S80_unit'] = $info['S80_unit'];
            }
            //矿产
            if($info['xmzc_type']==506){
                 $data['S66'] = $info['S66'];
                 $data['S67'] = $info['S67'];
                 $data['S69'] = $info['S69'];
                 $data['S70'] = $info['S70'];
                 $data['S72'] = $info['S72'];
            }
            $data['trade_way'] = implode(',',I('post.trade_way'));
            $data['transfer_type'] = implode(',',I('post.transfer_type'));
            $data['xmzc_assass'] = $info['xmzc_assass'];
            $data['xmzc_assass_unit'] = $info['xmzc_assass_unit'];
            $data['transfer_price'] = $info['transfer_price'];
            $data['transfer_price_unit'] = $info['transfer_price_unit'];
            $data['transfer_dateend'] = strtotime($info['transfer_dateend']);
            M('ItemInfoZcjy')->add($data);
        }

        if($info['info_type']==2005){
            $data['id'] = $res;
            $data['xmlc_fxph'] = $info['xmlc_fxph'];
            $data['xmlc_tzmk'] = $info['xmlc_tzmk'];
            $data['xmlc_tzmk_unit'] = $info['xmlc_tzmk_unit'];
            $data['xmlc_tzqx'] = $info['xmlc_tzqx'];
            $data['xmlc_tzqx_unit'] = $info['xmlc_tzqx_unit'];
            $data['tzlc_type'] = $info['tzlc_type'];

            //银行理财
            if($info['tzlc_type']==508 && $result){
                $data['id'] = $res;
                $data['tzlc_type'] = $info['tzlc_type'];
                $data['S141_min'] = strtotime($info['S141_min']);
                $data['S141_max'] = strtotime($info['S141_max']);
                $data['S142'] = $info['S142'];
                $data['extra_S142'] = implode(',',$info['extra_S142']);
                $data['S143'] = $info['S143'];
                $data['S144_min'] = $info['S144_min'];
                $data['S144_max'] = $info['S144_max'];
                $data['S145'] = implode(',',$info['S145']);
                $data['S150'] = $info['S150'];
                $data['S151'] = $info['S151'];
            }
            
            //信托产品
            if($info['tzlc_type']==509 && $result){
                $data['id'] = $res;
                $data['S152'] = $info['S152'];
                $data['S153'] = $info['S153'];
                $data['S154'] = $info['S154'];
                $data['S155'] = implode(',',$info['S155']);
                $data['S156'] = implode(',',$info['S156']);
                $data['S188'] = $info['S188'];
                $data['S189_min'] = $info['S189_min'];
                $data['S189_max'] = $info['S189_max'];
                $data['S200'] = $info['S200'];
                $data['S157_min'] = strtotime($info['S157_min']);
                $data['S157_max'] = strtotime($info['S157_max']);
            }
            //有限合伙
            if($info['tzlc_type']==510 && $result){
                $data['S158_min'] = strtotime($info['S158_min']);
                $data['S158_max'] = strtotime($info['S158_max']);
                $data['S159'] = implode(',',$info['S159']);
                $data['S160'] = $info['S160'];
                $data['S190'] = $info['S190'];
                $data['S191_min'] = $info['S191_min'];
                $data['S191_max'] = $info['S191_max'];
            }
            //阳光私募
            if($info['tzlc_type']==511 && $result){
                $data['S158_min'] = $info['S158_min'];
                $data['S161_min'] = strtotime($info['S161_min']);
                $data['S161_max'] = strtotime($info['S161_max']);
                $data['S162'] = $info['S162'];
                $data['S163'] = $info['S163'];
                $data['S164'] = $info['S164'];
                $data['S165'] = $info['S165'];
                $data['S166'] = $info['S166'];
                $data['S166_unit'] = $info['S166_unit'];
                $data['S167'] = $info['S167'];
                $data['S168'] = $info['S168'];
                $data['S169'] = $info['S169'];
                $data['S170'] = $info['S170'];
                $data['S171'] = $info['S171'];
                $data['S172'] = $info['S172'];
            }
            //私募股权
            if($info['tzlc_type']==512 && $result){
                $data['S173_min'] = strtotime($info['S173_min']);
                $data['S173_max'] = strtotime($info['S173_max']);
                $data['S174'] = implode(',',$info['S174']);
                $data['S175'] = $info['S175'];
                $data['S175_unit'] = $info['S175_unit'];
                $data['S176'] = implode(',',$info['S176']);
                $data['S177'] = $info['S177'];
                $data['S178'] = $info['S178'];
                $data['S192'] = $info['S192'];
                $data['S193_min'] = $info['S193_min'];
                $data['S193_max'] = $info['S193_max'];
            }
            //券商集合
            if($info['tzlc_type']==513 && $result){
                $data['S179'] = $info['S179'];
                $data['S180'] = $info['S180'];
            }
            // 一对多
            if($info['tzlc_type']==514 && $result){
                $data['S181'] = implode(',',$info['S181']);
                $data['S182'] = $info['S182'];
                $data['S183'] = $info['S183'];
                $data['S184'] = $info['S184'];
                $data['S185'] = $info['S185'];
                $data['S198'] = $info['S198'];
                $data['S199_min'] = $info['S199_min'];
                $data['S199_max'] = $info['S199_max'];
            }
            //私募债
            if($info['tzlc_type']==515 && $result){
                $data['S194'] = $info['S194'];
                $data['S186'] = implode(',',$info['S186']);
                $data['S195_min'] = $info['S195_min'];
                $data['S195_max'] = $info['S195_max'];
            }
            //其他
            if($info['tzlc_type']==516 && $result){
                $data['S187'] = implode(',',$info['S187']);
                $data['S196'] = $info['S196'];
                $data['S197_min'] = $info['S197_min'];
                $data['S197_max'] = $info['S197_max'];
            }
            M('ItemInfoTzlc')->add($data);
            M('ItemInfoTzlc')->commit();
        }
            
            if($info['xmf_zs_way'] && $result){
                $data['id'] = $res;
                $data['xmf_zs_way'] = implode(',',$info['xmf_zs_way']);
                $data['extra_xmf_zs_way'] = implode(',',$info['extra_xmf_zs_way']);
                M('ItemInfoZcjy')->add($data);
            }
        return $res;
	}

}
?>