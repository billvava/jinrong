<?php

namespace Common\Model;
use Think\Model\RelationModel;
class ItemInfoTzlcModel extends RelationModel{
	
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
        $data['S141_min']=strtotime($data['S141_min']);
        $data['S141_max']=strtotime($data['S141_max']);
        $data['extra_S142'] = implode(',',$data['extra_S142']);
        $data['S158_min']=strtotime($data['S158_min']);
        $data['S158_max']=strtotime($data['S158_max']);
        $data['S157_min']=strtotime($data['S157_min']);
        $data['S157_max']=strtotime($data['S157_max']);
        $data['S161_min']=strtotime($data['S161_min']);
        $data['S161_max']=strtotime($data['S161_max']);
        $data['S173_min']=strtotime($data['S173_min']);
        $data['S173_max']=strtotime($data['S173_max']);
        $data['S145'] = implode(',',$data['S145']);
        $data['S155'] = implode(',',$data['S155']);
        $data['S156'] = implode(',',$data['S156']);
        $data['S159'] = implode(',',$data['S159']);
        $data['S174'] = implode(',',$data['S174']);
        $data['S176'] = implode(',',$data['S176']);
        $data['S181'] = implode(',',$data['S181']);
        $data['S186'] = implode(',',$data['S186']); 
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
        //D('ItemInfoZcjy')->saveData();
        return true;
    }


}
?>