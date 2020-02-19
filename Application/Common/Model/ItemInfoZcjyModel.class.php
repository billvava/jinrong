<?php
namespace Common\Model;
use Think\Model\RelationModel;
class ItemInfoZcjyModel extends RelationModel{
	
    public function saveData(){
        //事务总表处理
        $this->startTrans();
        //开始处理主表数据
        $id = D('ItemInfo')->saveData();
        if(!$id){
            $this->error = D('ItemInfo')->getError();
            return false;
        }
        //分表处理
        $data = $this->create();
        //数据处理
        $data['trade_way'] = implode(',',$data['trade_way']);
        $data['transfer_type'] = implode(',',$data['transfer_type']);
        $data['xmf_zs_way'] = implode(',',$data['xmf_zs_way']);
        $data['extra_xmf_zs_way'] = implode(',',$data['extra_xmf_zs_way']);
        if($data['xmzc_type']==493){
            $data['S38'] = implode(',',$data['S38']);
            $data['S43'] = strtotime($data['S43']);
        }
        if($data['xmzc_type']==495){
            $data['S53'] = strtotime($data['S53']);
        }
        if($data['xmzc_type']==503){
            $data['S77'] = strtotime($data['S77']);
        }
        $data['transfer_dateend']=strtotime($data['transfer_dateend']);
        if(!$data){
            $this->rollback();
            return false;
        }
        //分表数据提交
        $status = $this->where('id='.$data['id'])->save($data);

        //提交不成功回滚
            if($status === false){
                $this->rollback();
                return false;
            }
        //成功,提交并返回真
        $this->commit();
        return true;
    }


}
?>