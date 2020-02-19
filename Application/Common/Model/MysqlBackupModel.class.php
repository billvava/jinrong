<?php
/**
 * 后台备份数据库模型类
 */
namespace Common\Model;
use Think\Model;
class MysqlBackupModel{
    public $model;
    public $db;
    public function __construct(){
        $this->model = new Model();
        $this->db = $this->model->db();
    }
    /**
     * 获取所有数据库列表
     */
    public function get_tables(){
        return $this->db->getTables();
    }
    /**
     * 获取数据库版本
     */
    public function get_mysql_version(){
        $version = $this->query_sql("select version() as ver");
        return $version[0]['ver'];
    }
    /**
     * 执行查询sql
     */
    public function query_sql($sql){
        return $this->db->query($sql);
    }
    /**
     * 执行sql
     */
    public function execute_sql($sql){
        // return $this->model->execute($sql);
        return $this->db->execute($sql);
    }
    /**
     * 获取结果集中字段数
     */
    public function num_fields($result){
        return mysql_num_fields($result);
    }
    /**
     * 获取结果集中第一条
     */
    public function getfirst($sql) {
        $query = $this->query_sql($sql);
        return $query[0];
    }
    public function write_head($table){
        $sql = '';
        $sql .= "DROP TABLE IF EXISTS `".$table."`;\r\n";
        $row = $this->getfirst("SHOW CREATE TABLE ".$table);
        $sql .= $row['create table'];
        return $sql;
    }
    public function escape_str($str){
        $str=mysql_escape_string($str);
        $str=str_replace('\\\'','\'\'',$str);
        $str=str_replace("\\\\","\\\\\\\\",$str);
        $str=str_replace('$','\$',$str);
        return $str;
    }
    public function write_file($file, $sql){
        @file_put_contents($file, $sql);
        return true;
    }
    public function get_sqlfile_info($file){
        $file_info = array('74cms_ver'=>'', 'mysql_ver'=> '', 'add_time'=>'');
        if (!$fp = @fopen($file,'rb'))
        {
            return array('state'=>0,'msg'=>"打开文件{$file}失败");
        }
        $str = fread($fp, 200);
        @fclose($fp);
        $arr = explode("\n", $str);
        foreach ($arr AS $val){
            $pos = strpos($val, ':');
            if ($pos > 0){
                $type = trim(substr($val, 0, $pos), "-\n\r\t ");
                $value = trim(substr($val, $pos+1), "/\n\r\t ");
                if ($type == '74CMS VERSION'){
                    $file_info['74cms_ver'] = $value;
                }
                elseif ($type == 'Mysql VERSION'){
                    $file_info['mysql_ver'] = substr($value,0,3);
                }
                elseif ($type == 'Create time'){
                    $file_info['add_time'] = $value;
                }
            }
        }
        return array('state'=>1,'msg'=>"",'data'=>$file_info);
    }
    /**
     * 优化表
     */
    public function optimize_table($table){
        if (is_array($table))
        {
            $sqlstr=implode(",",$table);
            if ($this->execute_sql("OPTIMIZE TABLE $sqlstr"))
            {   
                return true;
            }
            else
            {
                return fase;
            }
        }
        else
        {
            return fase;
        }
    }
}