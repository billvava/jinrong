<?php
namespace Home\Model;
use Think\Model;
/**
 * 数据库备份还原
 */

class DatabaseModel {

    public $tableList = array(); //表列表

    /**
     * 数据库列表
     */
    public function loadTableList(){
        $Db = M();
        return $Db->query('SHOW TABLE STATUS'); 
    }

    /**
     * 数据库所有字段
     */
    public function loadTableField(){
        $db_name = C('DB_NAME');
        $Db = M();
        $DB_LIST = $Db->query('SHOW TABLE STATUS');
        foreach($DB_LIST as $key=>$val) {
            $field_name = $val['name'];
            $Field_list[$key]['biaoming'] = $val['name'];
            $Field_list[$key]['beizhu'] = $val['comment'];
            $Field_list[$key]['database_structure'] = $Db->query('SHOW FULL FIELDS FROM '."$field_name".' FROM '."$db_name".'');
              if($key!==0){
                  $Field_list[$key-1]['maodian'] = $val['name'];
              } 
       }
       return $Field_list;
    }
}
