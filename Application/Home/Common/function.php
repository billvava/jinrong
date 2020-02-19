<?php

function select_condition(){

    /*
    $array = ['info_type','sort','rsort','p'];
    foreach ($array as $k => $v) {
       if(!in_array($v,$array)){
            return true;
       }else{
            return false;
       }

       if($_GET[$k])
    }
    */

    if((!$_GET['info_type'] && count($_GET)>0) || 
        ($_GET['info_type'] && count($_GET)>1)){
        return true;
    }else{
        return false;
    }
}

