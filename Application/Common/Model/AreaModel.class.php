<?php 
namespace Common\Model;
use Think\Model;
class AreaModel extends Model
{
	public function build_cache(){
        if(false === $area = F('area')){
            $area_temp = M('Area')->field('id,name,type')->where(['type'=>3])->select();
            $area =array();
            foreach ($area_temp as $k => $v){
                 $area[$v['name']] =$v['id'];
            }
            F('area',$area);
        }
        if(false === $city = F('city')){
            $city_temp = M('Area')->field('id,name,type')->where(['type'=>2])->select();
            $city =array();
            foreach ($city_temp as $k => $v){
                 $city[$v['name']] =$v['id'];
            }
            F('city',$city);
        }
        if(false === $province = F('province')){
            $province_temp = M('Area')->field('id,name,type')->where(['type'=>1])->select();
            $province =array();
            foreach ($province_temp as $k => $v){
                 $province[$v['name']] =$v['id'];
            }
            F('province',$province);
        }
        if(false === $city_pid = F('city_pid')){
            $where['type'] = array('ELT',2);
            $city_pid_temp = M('Area')->field('id,type,pid')->where($where)->select();
            $city_pid =array();
            foreach ($city_pid_temp as $k => $v){
                 $city_pid[$v['id']] =$v['pid'];
            }
            F('city_pid',$city_pid);
        }
        return;
    }
}
?>