<?php
return array(
    'LOG_RECORD' => false, // 日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,WARN,NOTICE,INFO,DEBUG,SQL',
    'SHOW_ERROR_MSG' => true, // 出错显示
    //'SHOW_PAGE_TRACE' => 1,  // 显示页面Trace信息
    'PAGE_TRACE_SAVE' => array('base','file','sql'),
    'ERROR_MESSAGE'  =>    '系统故障',
    'DB_SQL_LOG' => false, // SQL日志
    'DB_DEBUG' =>  false,
);
