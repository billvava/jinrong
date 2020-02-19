<?php 
namespace Common\Model;
use Think\Model;
class CategoryModel extends Model
{
	protected $_validate = array(
		array('c_name,c_alias,','identicalNull','',0,'callback'),
		array('c_name','1,30','{%category_length_error_c_name}',0,'length'),
		array('c_alias','1,30','{%category_length_error_c_alias}',0,'length'),
	);

	/*public function get_classify($alias){
		if (intval($alias)!=$alias) return false;
		$where['c_alias']=$alias;
		$get_classify = $this->where($where)->select(); 
		F('get_classify', $get_classify);
        
        return $get_classify;
	}*/
    
	/**
     * 读取其它分类(全部)参数生成缓存文件
     */
    public function category_cache() {
        $category = array();
        $category = $this->field('c_id,c_name,c_alias,ext_id')->select();
        $category_list = array();
          foreach($category as $k=>$v){
              if($v['ext_id']){
                 $v['c_id']=$v['ext_id'];
              }
              $category_list[$v['c_alias']][$v['c_id']] = $v['c_name'];
          }
        $province = M('Area')->field('id,name,type')->where(['type'=>1])->select();
        $province_temp =array();
        foreach ($province as $k => $v){
             $province_temp[$v['id']] =$v['name'];
        }
        ksort($sheng);
        $category_list['province'] = $province_temp;
        $category_list['sex'] = array(0=>'先生',1=>'女士');
		$category_list['xmlc_fxph'] = array(676=>'稳健性',677=>'进取型');
		$category_list['S159'] = array(691=>'固定值',692=>'浮动范围');
        $category_list['money_unit'] = array(1=>'万元',10000=>'亿元');
        $category_list['money_unit_min'] = array(1=>'万',10000=>'亿');
        $category_list['date'] =array('M360'=>'年','M30'=>'月','M1'=>'天');
        $category_list['invest_type']=array(1=>'项目融资',200=>'资产交易',700=>'政府招商',2005=>'投资理财',2010=>'股权投资',2011=>'债权投资',2012=>'金融投资',2013=>'BT/BOT 项目投资',2014=>'其它投资');
        $category_list['registered_capital'] = $category_list['last_fiscal_revenue'] = [1=>'0～50万',2=>'50万～200万',3=>'200万～1000万',4=>'1000万～1亿',5=>'1亿～5亿',6=>'5亿以上'];
        $category_list['contact_job'] =['government'=>[120=>'处长',107=>'局长',102=>'市长',106=>'主任',110=>'科员',111=>'办事员',112=>'调研员',113=>'巡视员',99=>'其他职位'],'company'=>[1=>'董事长',5=>'董事',6=>'总经理',7=>'副总经理',11=>'总监',8=>'经理',99=>'其他职位']];
        
        $category_list['account']['personal_explain'] =['mobile'=>'联系手机','phone'=>'电话','email'=>'邮箱地址','qq'=>'qq号码','personal_introduce'=>'个人简介','reg_address'=>'详细地址','avatars'=>'真实头像'];

        $category_list['info_type'] = $category_list['invest_type'];
        $category_list['S24'] =array('624'=>'固定资产','625'=>'有价证券','626'=>'其他资产');
        $category_list['S26'] =array('627'=>'销售回款','628'=>'其它来源');
        $category_list['range'] =array('1'=>'1万-10万','2'=>'10万-50万','3'=>'50万-100万','4'=>'100万-500万','5'=>'500万-1000万','6'=>'1000万-5000万','7'=>'5000万-1亿','8'=>'大于1亿');
        $category_list['company_type'] =array('1'=>'小额贷款','2'=>'典当公司','3'=>'担保公司','4'=>'金融租赁','5'=>'投资公司','6'=>'商业银行','7'=>'基金公司','8'=>'证券公司','9'=>'信托公司','10'=>'资产管理','99'=>'其他服务');
        $category_list['xmrz_body'] = $category_list['financing_body'];
        $category_list['xmrz_intention'] = $category_list['funds_body'];
        $category_list['xmrz_intention'][617]='不限';
        $category_list['xmgq_period'] = $category_list['project_stage'];
        F('category',$category_list);
        return $category_list;
    }
    

    public function category_list(){
        $category = M('Category')->select();
        $category_list = array();
        foreach($category as $k=>$v){
            $category_list[$v['c_alias']][] = $v;
        }
        $area = M('Area')->field('id,name')->where(['type'=>1])->select();
        foreach ($area as $k => $v){
          $area[$k]['c_id'] = $v['id'];
          unset($area[$k]['id']);
          $area[$k]['c_name']=$v['name'];
          unset($area[$k]['name']);
          $area[$k]['c_parentid']=0;
          $area[$k]['c_alias']='invest_area';
          $area[$k]['c_order'] = 0;
          $area[$k]['c_index'] = '';
          $area[$k]['ext_id']='';
          $area[$k]['ext_form_id']=0;
          $area[$k]['data_rule']=0;
          $area[$k]['data_unique']=0; 
        }
        $category_list['invest_area']=$area;
        F('category_list',$category_list);
        return $category_list;
    }
    
    /**
     * [get_category_cache 读取缓存]
     * @param  string $type [单一分类名称]
     * @return array       [分类集]
     */
    public function get_category_cache($type='')
    {
        if(false === $category = F('category')){
            $category = $this->category_cache();
        }
        if($type) return $category[$type];
        return $category;
    }
	/**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('get_classify', NULL);
        F('category', NULL);
    }
    /**
     * 后台有删除也删除缓存
     */
    protected function _after_delete($data,$options){
        F('get_classify', NULL);
        F('category', NULL);
    }


     /**
     * 获取指定类型名称
     * @return string 
     */
    public function findRecord($id){
      $str = ',';
      $cname = '';
      if(strpos($id, $str)===false){
        $map['c_id'] = intval($id);
      }else{
        $map['c_id'] = array('in', $id);
      }
      $all_category = $this->where($map)->select();
      foreach ($all_category as $val) {
        $cname .= ($str.$val['c_name']);
      }
      $cname = substr($cname,1);
      return $cname;
    }

    public function get_name(){
        $category = F('category');
    }

    /**
     * 获取指定类型id
     * @return string 
     */
    public function findRecord_name($name,$ext){
      $str = ',';
      $c_id = '';
      if($ext){
        $map['c_alias'] = $ext;
      }
      if(strpos($name, $str)===false){
        $map['c_name'] = $name;
      }else{
        $map['c_name'] = array('in', $name);
      }
      $all_category = $this->where($map)->select();
      foreach ($all_category as &$val){
        $c_id .= ($str.$val['c_id']);
      }
      $c_id = substr($c_id,1);
      return $c_id;
    }

}
?>