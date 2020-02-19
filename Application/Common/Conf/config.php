<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST'    	=> array('Home','Admin','Mobile','Service','Msg','Api','Member'),  //可访问模块
	'MODULE_DENY_LIST'      => array('Common'), // 禁止访问的模块列表
    /*
    'APP_SUB_DOMAIN_DEPLOY' => 1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES' => array(
    'piaoju' => 'Home/Piaoju',
    ),
    */
	'DEFAULT_MODULE'       	=> 'Home',
    'LOG_RECORD'            =>'false',
	'TAGLIB_PRE_LOAD'       => 'qscms', //自动加载标签
	'DEFAULT_FILTER'		=> 'htmlspecialchars,stripslashes,strip_tags',
	'TMPL_ACTION_SUCCESS'	=> 'public:showmsg',
	'TMPL_ACTION_ERROR'		=> 'public:showmsg',
    'LANG_SWITCH_ON' 		=> true,//开启多语言支技
    'DEFAULT_LANG' 			=> 'zh-cn', // 默认语言
    'LANG_AUTO_DETECT'		=> true, // 自动侦测语言
    'LANG_LIST'				=> 'zh-cn',//必须写可允许的语言列表
    'LOAD_EXT_CONFIG'       => 'url,db,cache,tags,sub_domain,pwdhash', //扩展配置
    'CRON_ON'               => false,//定时任务开关
    'DATA_CACHE_SUBDIR'		=> true, //缓存文件夹
	'DATA_PATH_LEVEL'		=> 3, //缓存文件夹层级
    'TMPL_DETECT_THEME'     => true,
    'APP_SUB_DOMAIN_DEPLOY' => true,
	'TOKEN_ON'=>false,  // 是否开启令牌验证
	'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
	'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
	'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	'DB_FIELDTYPE_CHECK'=>true,//开启字段类型验证
    'OUTPUT_ENCODE' =>true,//是否开启页面压缩输出
);