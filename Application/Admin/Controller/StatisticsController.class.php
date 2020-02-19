<?php 
namespace Admin\Controller;
use Common\Controller\BackendController;
class StatisticsController extends BackendController {
	public function _initialize(){
		parent::_initialize();
	}

	public function index(){
        $jsonArray = $this->getJsonTime();
        $this->assign('jsonArray',$jsonArray);
        $this->display();
    }

    public function user_analysis(){
        $jsonArray = $this->getjsonUser();
        $this->assign('jsonArray',$jsonArray);
        $this->display();
    }


    public function getjsonUser(){
        $jsonArray = array();
        $jsonArray['chart']['plotBackgroundColor']=null;
        $jsonArray['chart']['plotBorderWidth']=null;
        $jsonArray['chart']['plotShadow']=false;
        $jsonArray['title']['text'] ='项目方资金方占比';
        $jsonArray['tooltip']['headerFormat'] = '{series.name}<br>';
        $jsonArray['tooltip']['pointFormat'] = '{point.name}: <b>{point.percentage:.1f}%</b>';
        $jsonArray['tooltip']['pointFormat'] = '{point.name}: <b>{point.percentage:.1f}%</b>';
        $jsonArray['plotOptions']['pie']['allowPointSelect'] = true;
        $jsonArray['plotOptions']['pie']['cursor'] = 'pointer';
        $jsonArray['plotOptions']['pie']['dataLabels']['enabled'] = true;
        $jsonArray['plotOptions']['pie']['dataLabels']['format'] = '<b>{point.name}</b>: {point.percentage:.1f} %';
        //$jsonArray['plotOptions']['pie']['dataLabels']['style']['color'] = "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'";
        $jsonArray['plotOptions']['pie']['dataLabels']['style']['color'] = 'black';
        $json = R('Home/yunying/get_user_count');
        $jsonArray['series'][0]['type']= "pie";
        $jsonArray['series'][0]['name'] = "项目方资金方占比";
        $jsonArray['series'][0]['data'] = $json;
        header('Content-type:text/json');
        return json_encode_no_zh($jsonArray);
    }

    /**
     * 生成时间数据
     * @param int $num 数量
     * @param int $type 类型
     * @return array 信息
     */
    public function getJsonTime($num=24,$type='Hour',$date='H'){
        $jsonArray = array();
        $timeArray = array();
        $jsonArray['chart']['type']='column';
        $jsonArray['title']['text']='24小时用户注册量统计';
        $jsonArray['subtitle']['text']='数据来源: 金融网';
        //$jsonArray['labels']['format']['value'] ='0f';
        //$jsonArray['labels']['format']['value'] ='0f';
        for ($i=0; $i<$num;$i++) {
            $timeNow = strtotime("+".$i." ".$type,strtotime(date('Y-m-d 0:0:0')));
            $jsonArray['xAxis']['categories'][] = date($date,$timeNow).'点';
            $where['reg_time'] = array(array('EGT', $timeNow), array('LT', strtotime('+ 1 '.$type, $timeNow)),'and');
            $jsonArray['series']['name'] ='24小时注册量';
            $jsonArray['series']['data'][] = (int)M('Members')->where($where)->count();
        }
        $jsonArray['series'] = [$jsonArray['series']];

        //$jsonArray['xAxis']['categories'] = array_reverse($jsonArray['xAxis']['categories']);
        //array_unshift($jsonArray['xAxis']['categories'],'00');
        //向数组前部插入元素
        //array_pop($jsonArray['xAxis']['categories']);
        $jsonArray['xAxis']['crosshair'] = true;
        $jsonArray['yAxis']['min'] = 0;
        $jsonArray['yAxis']['tickInterval'] = 2;
        $jsonArray['yAxis']['title']['text'] ='注册量 (人数)';
        //$jsonArray['tooltip']['headerFormat'] ='<span style="font-size:10px"></span><table>';
        //$jsonArray['tooltip']['pointFormat'] ='';
        //$jsonArray['tooltip']['footerFormat']='</table>';
        //$jsonArray['tooltip']['shared']=true;
        //$jsonArray['tooltip']['useHTML']=true;
        $jsonArray['plotOptions']['column']['pointPadding']=0.2;
        $jsonArray['plotOptions']['column']['borderWidth']=0;
        //$jsonArray['series']=[['name'=>'24小时注册量','data'=>[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]]];
        header('Content-type:text/json');
        return json_encode_no_zh($jsonArray);
    }

}
?>