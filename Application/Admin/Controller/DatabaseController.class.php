<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
use Common\Model\MysqlBackupModel;
class DatabaseController extends BackendController {
    public $model;
    public function _initialize() {
        parent::_initialize();
        $this->model = new MysqlBackupModel();
    }
    public function index(){
		$list = $this->model->get_tables();
		$this->assign('list',$list);
		$this->display();
	 
    }
    public function doBackup(){
		 if(empty($_POST['tablearr'])){
		   $table=$this->getTable();
		 }else{
		   $table=explode(",",$_POST['tablearr']);
		 }
			 
		 $struct=$this->bakStruct($table);
		 $record=$this->bakRecord($table);
		 $sqls=$struct.$record;
		 $dir=DATABASE_BACKUP_PATH.date("y-m-d").".sql";
		 file_put_contents($dir,$sqls);
		 if(file_exists($dir)){
		   $this->admin_write_log_unify($dir);
		   $this->success("备份成功");
		 }else{
		   $this->error("备份失败");
		 }
   }
 
    protected function getTable(){
		 $dbName=C('DB_NAME');
		 $result=M()->query('show tables from '.$dbName);
		 foreach ($result as $v){
		   $tbArray[]=$v['tables_in_'.C('DB_NAME')];
		 }
		return $tbArray;
    }
 
    protected function bakStruct($array){
		  foreach ($array as $v){
		  $tbName=$v;
		  $result=M()->query('show columns from '.$tbName);
		  $sql.="--\r\n";
		  $sql.="-- 数据表结构: `$tbName`\r\n";
		  $sql.="--\r\n\r\n";
		  $sql.="DROP TABLE IF EXISTS `$tbName`;\r\n";
		  $sql.="create table `$tbName` (\r\n";
		  $rsCount=count($result);
		  foreach ($result as $k=>$v){
			  $field  =       $v['field'];
			  $type   =       $v['type'];
			  $default=       $v['default'];
			  $extra  =       $v['extra'];
			  $null   =       $v['null'];
			  if(!($default=='')){
				$default='default '.$default;
			  }      
			  if($null=='NO'){
				$null='not null';
			  }else{
				$null="null";
			  }          
			  if($v['key']=='PRI'){
				$key    =       'primary key';
			  }
			  else{
				$key    =       '';
			  }
			if($k<($rsCount-1)){
			 $sql.="`$field` $type $null $default $key $extra ,\r\n";
			}else{
			 //最后一条不需要","号
			 $sql.="`$field` $type $null $default $key $extra \r\n";
			}
		  }
		   $sql.=") ENGINE=MyISAM DEFAULT CHARSET=utf8;\r\n\r\n";
		 }
	    return str_replace(',)',')',$sql);
   }
 
    protected function bakRecord($array){
		  foreach ($array as $v){
		   $tbName=$v;
		   $rs=M()->query('select * from '.$tbName);
		   if(count($rs)<=0){
			  continue;
			 }
			  $sql.="--\r\n";
			  $sql.="-- 数据表中的数据: `$tbName`\r\n";
			  $sql.="--\r\n\r\n";
		   foreach ($rs as $k=>$v){
			 $sql.="INSERT INTO `$tbName` VALUES (";
			 foreach ($v as $key=>$value){
				 if($value==''){
				   $value='null';
				 }
				 $type=gettype($value);
				 if($type=='string'){
				   $value="'".addslashes($value)."'";
				  }
				 $sql.="$value," ;
			  }
				 $sql.=");\r\n\r\n";
			}
		  }
		 return str_replace(',)',')',$sql);
    }
	
     public function click(){
		$url=explode("&",$_GET['zhi']);
		$do=$url[0];
		$table=$url[1];
		switch($do){
			case optimize://优化
		  $rs =M()->Query("OPTIMIZE TABLE `$table` ");
		  if($rs){
			  echo "执行优化表： $table  OK！";
		  }
		  else{
			echo "执行优化表： $table  失败，原因是：".M()->GetError();
		  }
			break;
		case repair://修复
		  $rs = M()->Query("REPAIR TABLE `$table` ");
			  if($rs){
			echo "修复表： $table  OK！";
		  }
		  else{
			echo "修复表： $table  失败，原因是：".M()->GetError();
		  }
		   break;
		default://结构
		  $dsql=M()->Query("SHOW CREATE TABLE ".$table);
		  foreach($dsql as $k=>$v){
			foreach($v as $k1=>$v1){
			 $rs=$v1;
			}
		  }
		  echo trim($rs);
		}
   }
//获取文件目录列表,该方法返回数组
    protected function getDir($dir) {
        if (false != ($handle = opendir ( $dir ))) {
            while ( false !== ($file = readdir ( $handle )) ) {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if (false !== strpos($file,".sql")) {
                    $dirArray[]=$file;
                }
            }
            //关闭句柄
            closedir ( $handle );
        }
        return $dirArray;
    }
  /**
     * 备份数据列表
     */
    public function restore(){
        $files = $this->getDir(DATABASE_BACKUP_PATH);
        $data_backup_list = $file_info = array();
        $dir = opendir(DATABASE_BACKUP_PATH);
            foreach ($files as $key => $file) {
                if(strpos($file,'.sql')!==false && !in_array(preg_replace('#_\d+\.sql#i','',$file).'.sql', $data_backup_list))
                {
                $data_backup_list[] = preg_replace('#_\d+\.sql#i','',$file);
                }
            }
            foreach($data_backup_list as $key => $file)
            {
                if (file_exists(DATABASE_BACKUP_PATH.$file))
                {
                    $r = $this->model->get_sqlfile_info(DATABASE_BACKUP_PATH.$file);
                    if($r['state']==0){
                        $this->error($r['msg']);
                    }
                    $sqlfile_info_arr = $r['data'];
                    $file_info[$key]['file_size'] = round(filesize(DATABASE_BACKUP_PATH.$file)/1024/1024,2);
                }
                else
                {
                    $r = $this->model->get_sqlfile_info(DATABASE_BACKUP_PATH.preg_replace('#\.sql#i','',$file).'_1.sql');
                    if($r['state']==0){
                        $this->error($r['msg']);
                    }
                    $sqlfile_info_arr = $r['data'];
                    $i = 1;
                        while (file_exists(DATABASE_BACKUP_PATH.preg_replace('#\.sql#i','',$file).'_'.$i.'.sql'))
                        {
                        $file_info[$key]['file_size'] += round(filesize(DATABASE_BACKUP_PATH.preg_replace('#\.sql#i','',$file)."_{$i}.sql")/1024/1024,2);
                        $i++;
                        }
                }
            $file_info[$key]['file_name'] = substr($file,0);
            $file_info[$key]['74cms_ver'] = $sqlfile_info_arr['74cms_ver'];
            $file_info[$key]['mysql_ver'] = $sqlfile_info_arr['mysql_ver'];
            $file_info[$key]['add_time'] = $sqlfile_info_arr['add_time'];
        }
        $this->assign('list',array_reverse($file_info));
        $this->display();
    }
    /**
     * 删除备份文件
     */
    public function del(){
        $file_name = I('request.file_name','','trim') ? I('request.file_name','','trim') : $this->error('请选择项目');
        if (!is_array($file_name)) $file_name=array($file_name);
        foreach ($file_name as $fname)
        {
            $fname = substr($fname, 0, -4);
            if ($handle = opendir(DATABASE_BACKUP_PATH))
            {
                while (false !== $file = readdir($handle))
                {
                    if (strpos($file, $fname) !== false && $file != 'index.htm' && $file != '.' && $file != '..')
                    {
                    $sql_file[] = $file;
                    }
                }
            }
            foreach ($sql_file as $val)
            {
            @unlink(DATABASE_BACKUP_PATH . $val);
            }   
            unset($sql_file,$file);
        }
        $this->success('删除备份文件成功');
    }
    /**
     * 执行还原
     */
    public function import(){
        $file_name = I('get.file_name','','trim');
        $file_name = substr($file_name, 0, -4);
        if ($handle = $this->getDir(DATABASE_BACKUP_PATH))
        {
			foreach ($handle as $key => $file) {
                if (strpos($file, $file_name) !== false && $file != 'index.htm' && $file != '.' && $file != '..')
                {
                $backup_file[] = $file;
                }
            }
            if (is_array($backup_file) && !empty($backup_file))
            {
                natsort($backup_file);
                foreach($backup_file as $v)
                {
                $backup_arr[]=$v;
                }
                $backup_file=$backup_arr;
            }
        }
        else
        {
            $this->error('该备份文件不存在！');
        }
        closedir(DATABASE_BACKUP_PATH);
        $file =DATABASE_BACKUP_PATH.$backup_file[0];
        $r = $this->model->get_sqlfile_info($file);
        if($r['state']==0){
            $this->error($r['msg']);
        }
        $file_info = $r['data'];
        if($file_info['74cms_ver'] == C('QSCMS_VERSION'))
        {
            $this->error('当前程序与备份程序版本不一致');
        }
        $_SESSION['backup_file']=$backup_file;
        $filekey=I('get.filekey',0,'intval');
        $backup_file=$_SESSION['backup_file'][$filekey];
        if (empty($backup_file))
        {
            unset($_SESSION['backup_file']);
            $this->success('数据库还原成功',U('restore'));
            exit;
        }
        else
        {
            $file = DATABASE_BACKUP_PATH.$backup_file;
            $file = array_filter(file($file), array($this, '_remove_comment'));
            $file = str_replace("\r", "\n", implode('', $file));
            $arr = explode(";\r\n", trim($file));
            $arr_count = count($arr);
            for($i = 0; $i < $arr_count; $i++)
            {
                $arr[$i] = trim($arr[$i]);
                if (!empty($arr[$i]))
                {
                        if ((strpos($arr[$i], 'CREATE TABLE') !== false) && (strpos($arr[$i], 'DEFAULT CHARSET='.str_replace('-', '', QISHI_CHARSET) )!== false))
                        {
                        $arr[$i] = str_replace('DEFAULT CHARSET='. str_replace('-', '', QISHI_CHARSET), '', $arr[$i]);
                        }
                    $this->model->execute_sql($arr[$i]);
                }
            }           
            $this->success("还原分卷 ({$backup_file}) 成功，系统将自动还原下一个分卷...",U('import',array('file_name'=>I('get.file_name'),'filekey'=>($filekey+1))));
        }
    }
    protected function _remove_comment($str)
    {
        return (substr($str, 0, 2) != '--');
    }
    /**
     * 数据表列表
     */
    public function optimize(){
        $list = $this->_get_optimize_list();
        $this->assign('list',$list);
        $this->display();
    }
    /**
     * 获取需要优化的表
     */
    protected function _get_optimize_list()
    {
        $dbname = C('DB_NAME');
        $row_arr = array();
        $result = $this->model->query_sql("SHOW TABLE STATUS FROM `{$dbname}` WHERE Data_free>0");
        foreach ($result as $key => $value) {
            if ($value['data_free']=="0")
            {
            $value['data_free']="-";
            }
            if ($value['data_free']>1 && $value['data_free']<1024)
            {
            $value['data_free']=$value['data_free']." byte";
            }
            elseif($value['data_free']>1024 && $value['data_free']<1048576)
            {
            $value['data_free']=number_format(($value['data_free']/1024),1)." KB";
            }
            elseif($value['data_free']>1048576)
            {
            $value['data_free']=number_format(($value['data_free']/1024/1024),1)." MB";
            }
            $value['data_length']=$value['data_length']+$value['index_length'];
            //--
            if ($value['data_length']=="0")
            {
            $value['data_length']="-";
            }
            elseif($value['data_length']<1048576)
            {
            $value['data_length']=number_format(($value['data_length']/1024),1)." KB";
            }
            elseif($value['data_length']>1048576)
            {
            $value['data_length']=number_format(($value['data_length']/1024/1024),1)." MB";
            }
        $row_arr[] = $value;
        }
        return $row_arr;
    }
    public function doOptimize(){
        $tableArr = I('post.tables');
        if(empty($tableArr)){
            $this->error('请选择项目！');
        }
        $r = $this->model->optimize_table($tableArr);
        if($r){
            $this->success('操作成功！');
        }else{
            $this->error('操作失败！');
        }
    }   

   
}

?>
