<?php
namespace Common\Model;
use Think\Model;
use Think\Model\RelationModel;

class BaseInfoModel extends RelationModel{

    protected $_link = array(
        'ItemInfo'=>array(
            'mapping_type'=>self::HAS_ONE,
            'foreign_key'=>'id',
        ),
        'ItemInfoTzlc'=>array(
            'mapping_type'=>self::HAS_ONE,
            'foreign_key'=>'id',
        ),
        'ItemInfoZcjy'=>array(
            'mapping_type'=>self::HAS_ONE,
            'foreign_key'=>'id',
        ),
        'FundInfo'=>array(
            'mapping_type'=>self::HAS_ONE,
            'foreign_key'=>'id',
        ),
    );

    //公共基础信息处理
    public function base_info_process($info){
        $data['info_type'] = I('post.info_type');
        $data['title'] = I('post.title');
        $data['province_id'] = I('post.province_id');
        $data['city_id'] = I('post.city_id');
        $data['area_id'] = I('post.area_id');
        $data['last_area_id'] = I('post.last_area_id');
        $data['amount_interval_min'] = I('post.amount_interval_min');
        $data['amount_interval_min_unit'] = I('post.amount_interval_min_unit');
        $data['amount_interval_max'] = I('post.amount_interval_max');
        $data['amount_interval_max_unit'] = I('post.amount_interval_max_unit');
        $data['amount_range'] = I('post.amount_range');
        $data['amount'] = I('post.amount');
        $data['amount_unit'] = I('post.amount_unit');
        $data['i_overview'] = str_replace("\r\n","",text_in(I('post.i_overview','','trim')));
        $data['i_introduce'] = str_replace("\r\n","",text_in(I('post.i_introduce','','trim')));
        $data['i_other_remark'] = str_replace("\r\n","",text_in(I('post.i_other_remark','','trim')));
        $data['i_pic'] = I('post.i_pic');
        $data['i_att'] = I('post.i_att');
        $data['i_att_other'] = I('post.i_att_other');
        $data['i_keywords'] = I('post.i_keywords');
        $data['uid'] = I('post.uid');
        $data['is_open'] = I('post.is_open');
        $data['addtime'] = time();
        $data['updatetime'] = time();
    }

    public function editData($data){
        $map = array();
        $map['id'] = $data['id'];
        return $this->where($map)->data($data)->save();
    }


}
?>