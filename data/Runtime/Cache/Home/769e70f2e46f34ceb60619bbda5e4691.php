<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>"/>
<meta name="description" content="<?php echo ($page_seo["description"]); ?>"/>
<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico"/>
<script src="../public/js/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="/static/js/plugin/font/ali-iconfont/iconfont.css">
<script type="text/javascript">
	var qscms = {
		base : "<?php echo C('SUBSITE_DOMAIN');?>",
		keyUrlencode:"<?php echo C('qscms_key_urlencode');?>",
		domain : "http://<?php echo ($_SERVER['HTTP_HOST']); ?>",
		root : "/index.php",
	};
	/*
	$(function(){
		$.getJSON("<?php echo U('Home/AjaxCommon/get_header_min');?>",function(result){
			if(result.status == 1){
				$('.header_min_top').html(result.data.html);
			}
		});
	})
	*/
</script>
<link href="../public/css/common.css" rel="stylesheet" />
<link href="../public/css/base_main.css" rel="stylesheet" />
<link href="../public/css/index.css" rel="stylesheet" />
<link href="../public/css/header.css" rel="stylesheet" type="text/css" />
<link href="../public/css/slider/themes/default/default.css" rel="stylesheet" />
<link href="../public/css/banner.css" rel="stylesheet" />
<link href="../public/css/slider/nivo-slider.css" rel="stylesheet" />
<script src="../public/js/jquery.common.js"></script>
<script src="../public/js/jquery.tabs.js"></script>
<script src="../public/js/index.js"></script>
<script src="../public/js/showbox.js"></script>
<script src="../public/job/js/baiduTemplate.js"></script>
<script src="../public/js/zepto.min.js"></script>
<script src="../public/js/zepto.cookie.min.js"></script>
<script src="../public/js/zepto.hwSlider.js"></script>
<script src="../public/js/zepto.textSlider.js"></script>
<link href="../public/css/login.css" rel="stylesheet" />
<link href="../public/css/main.css" rel="stylesheet" />
<link href="../public/css/showbox.css" rel="stylesheet" />
<style>
    .logobox a {
        color: #333
    }

    .js_ad li a {
        display: block;
        height: 400px;
        cursor: pointer;
    }

    .login_box_wrapper {
        *zoom: 1;
        width: 1000px;
        min-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 10;
    }
</style>
</head>

<body>
    <link href="../public/css/top.css" rel="stylesheet" type="text/css" />
<link href="../public/css/header.css" rel="stylesheet" type="text/css" />
<div class="header_min" id="header">
    <div class="header_min_top">
        <div id="top-fast-login" class="itopl font_gray6 link_gray6"  style="width: 300px;">

            <span class="link_yellow loginno" <?php if($login == 1 ): ?>style="display: none"<?php endif; ?> >欢迎登录<?php echo C('qscms_site_name');?>！请 <a href="<?php echo U('home/members/login');?>">登录</a> 或 <a href="<?php echo U('home/members/register');?>">免费注册</a></span>

            <span class="link_yellow loginyes" <?php if($login == 0 ): ?>style="display: none"<?php endif; ?> >欢迎登录<?php echo C('qscms_site_name');?>！</span>

        </div>

        <div class="" style="width: 100px;float: left;height: 40px;color: #666666;line-height:40px;overflow: hidden;">
           <!-- <div class="leftimg"><img src="../public/images/11.png"></div> -->
            <?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'10','分类'=>'1','排序'=>'addtime:desc','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"金融汇","keywords"=>"项目融资,融资,天使投资,投资,投资项目,投资公司,项目,股权融资,债权融资,投融资,融资平台,金融汇","description"=>"金融汇（7ronghui.com）是中国最大的融资服务平台，拥有超百万的投融资机构、企业与个人用户入驻。金融汇通过线上＋线下、标准化  ＋个性化的服务体系，为客户提供针对性的投融资信息对接和项目撮配服务，成功对接融资千余亿元。金融汇凭借其强大、便捷的平台信息整合能力，大大提高企业投融资活动成功率，为中小微企业解决融资难问题。","header_title"=>""),$notice_list);?>
            <ul class="txt ul-upscroll">
                <?php if(is_array($notice_list['list'])): $i = 0; $__LIST__ = $notice_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notice): $mod = ($i % 2 );++$i;?><li class="" onClick="javascript:location.href='<?php echo ($notice["url"]); ?>'"><?php echo ($notice["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="itopr font_gray9 link_gray6">

            <ul class="part-top-allnav-list">
                <li class="part-top-allnav-link">
                    <a href="/" class="home">
                        <span class="iconfont icon-home top-home"></span>网站首页
                    </a>
                </li>
                <li class="part-top-allnav-link">
                    <a href="/help/help_list/id/3" class="help">
                        <span class="iconfont icon-question-mark top-home"></span> 新手指导
                    </a>
                </li>
                <li class="part-top-allnav-link">
                    <a href="<?php echo U('Home/Index/shortcut');?>" class="last"><span class="iconfont icon-computer top-home"></span>保存到桌面</a></li>
                <li class="part-top-allnav-pr j-hover-all">
                    <div class="sn-dropdown sn-mobile">
                        <span class="part-icon-mobile-box">
<a href="#" class="sn-dropdown-hd m">
<span class="iconfont icon-mobile top-home"></span> 手机金融网
                        </a>
                        </span>
                        <div class="part-sn-dropdown-bd">
                            <i class="sn-mobile-qrcode"></i>
                            <p class="sn-mobile-text">扫描我，立刻打开触屏站</p>
                            <p class="sn-mobile-text">手机触屏站：<span class="ui-text-red">m.jinrong.xiaba666.com</span></p>
                        </div>
                    </div>
                </li>
                <li class="part-top-allnav-pr j-hover-all">
                    <a href="/members/register/utype/1" class="btn-invest-recruit" target="_blank"><i class="icon-recruit-add-a"></i><i class="icon-recruit-add-b"></i>资本机构免费入驻</a>
                </li>
            </ul>

        </div>
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">
    // 公共组件hover
    jQuery.jqhover = function(tabtit) {
        $(tabtit).hover(function() {
            $(this).addClass("cur")
        }, function() {
            $(this).removeClass("cur")
        });
    };
    $.jqhover('.j-hover-all');

</script>

    <div class="header_wrapper">
        <div class="index_head">
            <div class="logobox" style="text-align:center;padding-top:15px;">
                <a href="/"><img src="../public/images/logo.png" border="0" /></a>
            </div>
            <div class="index_nav">
                <ul class="link_gray6 nowrap">
                    <?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','数量'=>'9','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"金融汇","keywords"=>"项目融资,融资,天使投资,投资,投资项目,投资公司,项目,股权融资,债权融资,投融资,融资平台,金融汇","description"=>"金融汇（7ronghui.com）是中国最大的融资服务平台，拥有超百万的投融资机构、企业与个人用户入驻。金融汇通过线上＋线下、标准化  ＋个性化的服务体系，为客户提供针对性的投融资信息对接和项目撮配服务，成功对接融资千余亿元。金融汇凭借其强大、便捷的平台信息整合能力，大大提高企业投融资活动成功率，为中小微企业解决融资难问题。","header_title"=>""),$nav);?><!--QS_top -->
                    <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if( MODULE_NAME == C( 'DEFAULT_MODULE') ): if($nav[ 'tag'] == strtolower(CONTROLLER_NAME) ): ?>select hover<?php endif; else: if($nav[ 'tag'] == strtolower(MODULE_NAME) ): ?>select hover<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="Outbox adKey">
        <div class="wideBox js_ad">
            <ul class="ad_top jsimg">
               <!-- <li class="ad000">
                    <a target="_blank" href="javascript:;"></a>
                </li>
                <li class="ad001">
                    <a target="_blank" href="javascript:;"></a>
                </li>
                <li class="ad002">
                    <a target="_blank" href="javascript:;"></a>
                </li>
                <li class="ad003">
                    <a target="_blank" href="javascript:;"></a>
                </li>
                <li class="ad004">
                    <a target="_blank" href="javascript:;"></a>
                </li>
                <li class="ad005">
                    <a target="_blank" href="javascript:;"></a>
                </li>-->
                <?php if(is_array($imgUrl)): $i = 0; $__LIST__ = $imgUrl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$url): $mod = ($i % 2 );++$i;?><li style="background: url('<?php echo ($url); ?>') no-repeat">
                    <a target="_blank" href="javascript:;"></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="ad_index">
                <ul class="jsnum">
                </ul>
            </div>
        </div>
        <div class="login_box_wrapper">
            <div class="Infor">
                <div class="Insub jsKey">
                    <div class="InforBox">
                        <div class="loginBox">
                            <!--未登录-->
                            <ul class="loginTab">
                                <li class="on">登录</li>
                                <li>免费注册</li>
                            </ul>
                            <div class="tab-cont">
                                <!--登录-->
                                <div>
                                    <!--登录-->
                                    <form id="login-form">
                                        <ul class="fromMain">
                                            <li>
                                                <input type="text" id="login_username" class="textBox" name="username" placeholder="手机号/会员号/邮箱" />
                                                <p class="login-tips fn-hide" id="login-msg"></p>
                                            </li>

                                            <li>
                                                <input type="password" id="login_password" class="textBox" name="password" placeholder="密码" />
                                            </li>

                                            <li style="height:22px;padding-bottom: 0px;">
                                                <div class="fn-clear"><label class="fn-left label-pointer ui-text-white"><input id="is_auto_login" value="1" class="checkbox" type="checkbox"> 两周内自动登录</label>
                                                    <p class="login-forget fn-right"><a href="/index.php?m=&c=members&a=user_getpass" target="_blank">忘记密码？</a></p>
                                                </div>
                                            </li>
                                            <input id="logintype" value="0" type="hidden">
                                        </ul>
                                        <p class="m_t10 btn-login-p">
                                            <button id="login" class="btn-login" type="button">登录</button></p>
                                    </form>
                                </div>
                                <!--注册-->

                                <div class="display">
                                    <form id="register-form" class="form-horizontal" action="/customer/create" method="post">
                                        <input id="username" type="hidden" name="Customer[username]" />
                                        <ul class="fromMain">
                                            <!--注册-->
                                            <li>
                                                <input type="text" id="mobile" name="mobile" class="textBox" placeholder="请输入手机号码" />
                                            </li>
                                            <li>
                                                <input type="text" id="img_yzm" style="width:104px;" name="img_yzm" class="textBox" placeholder="请输入图形验证码" />
                                                <img id="yzimg" src="Home/index/verify" onclick="this.src='Home/index/verify?'+Math.random()" alt="计算结果" style="position: absolute;right: 30px;width:90px;height:30px;cursor:pointer" />
                                            </li>
                                            <li>
                                                <input id="verify_code" type="text" name="yzm" class="textBox halftext" placeholder="请输入验证码" />
                                                <button type="button" id="verify" class="checkBtn">获取验证码</button>
                                                <p class="reg-tips" id="reg-tips"></p>
                                            </li>
                                            <div class="fn-clear fn-pb-5 ui-text-white agree"><input id="trj_agreement" value="1" class="checkbox" checked="" type="checkbox"> 我已阅读并同意<a href="<?php echo U('index/terms_conditions');?>" target="_blank">《金融网服务协议》</a></div>
                                        </ul>
                                        <p class="m_t10 btn-login-p"><a id="register" class="btn-login" href="javascript:void(0);">免费注册</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".loginTab li").click(function() {
            var idx = $(".loginTab li").index(this);
            $(this).addClass("on").siblings().removeClass("on");
            $(".tab-cont>div").eq(idx).show().siblings().hide();
        });
    </script>

    <style>
        ins,
        a {
            text-decoration: none;
        }

        .ui-text-white {
            color: #fff;
        }

        .fn-right {
            float: right;
        }

        .ad010 {
            background: url(../public/images/banner/img00.jpg) no-repeat;
        }

        .ad000 {
            background: url(../public/images/banner/img0.jpg) no-repeat;
        }

        .ad001 {
            background: url(../public/images/banner/img1.jpg) no-repeat;
        }

        .ad002 {
            background: url(../public/images/banner/img2.jpg) no-repeat;
        }

        .ad003 {
            background: url(../public/images/banner/img3.jpg) no-repeat;
        }

        .ad004 {
            background: url(../public/images/banner/img4.jpg) no-repeat;
        }

        .ad005 {
            background: url(../public/images/banner/img5.jpg) no-repeat;
        }

        .login-form li a {
            color: #fff;
        }

        .agree a {
            color: #fff;
        }

        .login-tips {
            color: #fff;
            float: none;
            padding-top: 5px;
        }

        .login-form li.fn-clear .login-tips {
            float: left;
            width: 220px;
        }

        .login-tips a,
        .login-tips a:hover {
            color: #ffd800;
        }

        .login-form li {
            padding-bottom: 10px;
        }

        .reg-tips {
            color: #fff;
            float: left;
            width: 220px;
            padding-top: 5px;
        }

        .clearfix::before,
        .clearfix::after {
            content: "";
            display: table;
            line-height: 0;
        }

        .clearfix::after {
            clear: both;
        }

        .fn-clear::after {
            clear: both;
            content: " ";
            display: block;
            font-size: 0;
            height: 0;
            visibility: hidden;
        }

        .fn-ow-clear {
            overflow: hidden;
        }

        .container::after {
            clear: both;
            content: " ";
            display: block;
            font-size: 0;
            height: 0;
            visibility: hidden;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
            min-width: 1000px;
            width: 1000px;
        }

        .ui-box-head {
            background-color: #f8f8f8;
            height: 48px;
        }

        .ui-box-title {
            float: left;
            font-size: 14px;
            font-weight: bold;
            height: 48px;
            line-height: 48px;
            padding-left: 50px;
            position: relative;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
            min-width: 1200px;
            width: 1200px;
        }

        .look-tab {
            background-color: #fff;
            border: 1px solid #ddd;
            float: left;
            height: 308px;
            overflow: hidden;
            position: relative;
            width: 830px;
        }

        .look-tips {
            border-top: 1px solid #eee;
            color: #666;
            height: 30px;
            margin-top: 20px;
            padding-top: 10px;
            text-align: right;
        }

        .btn-look-tips {
            background-color: #56C6FF;
            border-radius: 3px;
            color: #fff;
            display: inline-block;
            font-size: 14px;
            height: 28px;
            line-height: 28px;
            padding: 0 10px;
            text-align: center;
            vertical-align: middle;
        }

        a.btn-look-tips:hover {
            text-decoration: none;
        }

        .look-tab-head {
            height: 308px;
            overflow: hidden;
            position: absolute;
            width: 60px;
        }

        .look-tab-head li {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-top: 1px solid #ddd;
            cursor: pointer;
            float: left;
            height: 154px;
            margin-top: -1px;
            position: relative;
            width: 59px;
        }

        .look-tab-head li.ui-tab-head-current {
            background-color: #56C6FF;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #56C6FF;
            border-top: 1px solid #ddd;
            z-index: 10;
        }

        .look-tab-head li.ui-tab-head-current span {
            color: #fff;
        }

        .look-title {
            display: block;
            font-size: 18px;
            font-weight: bold;
            height: 60px;
            left: 50%;
            line-height: 18px;
            margin-left: -10px;
            margin-top: -40px;
            position: absolute;
            top: 50%;
            width: 20px;
        }

        .look-explain {
            bottom: 30px;
            display: block;
            position: absolute;
            text-align: center;
            width: 59px;
        }

        .look-tab-cont {
            padding-left: 60px;
        }

        .look-item {
            padding: 35px 35px 0;
        }

        .look-form span {
            display: block;
            float: left;
            margin-left: 10px;
        }

        .look-form span a {
            color: #333;
            display: block;
            font-size: 14px;
            font-weight: bold;
        }

        .ui-case {
            background-color: #fff;
            border: 1px solid #ddd;
            float: right;
            height: 308px;
            width: 348px;
        }

        .ui-case-total {
            background-color: #f8f8f8;
            height: 36px;
            overflow: hidden;
            padding-bottom: 19px;
            padding-left: 50px;
            padding-top: 19px;
        }

        .ui-case-total ul {
            height: 36px;
            overflow: hidden;
        }

        .ui-case-data {
            color: #666;
            float: left;
            height: 36px;
            width: 298px;
        }

        .ui-case-data .figure,
        .ui-case-data .punctuation {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #56C6FF;
            display: block;
            float: left;
            font: bold 30px/34px "Microsoft Yahei", arial;
            height: 34px;
            margin-right: 2px;
            text-align: center;
            width: 23px;
        }

        .ui-case-data .punctuation {
            background-color: transparent;
            border: 0 none;
            width: 12px;
        }

        .ui-case-data .text {
            display: block;
            float: left;
            font-size: 14px;
            height: 18px;
            margin: 0 5px;
            padding-top: 18px;
        }

        .ui-case-group {
            overflow: hidden;
            padding: 0 24px 10px;
        }

        .ui-case-title {
            font-size: 14px;
            height: 50px;
            line-height: 50px;
            position: relative;
        }

        .ui-case-title .more {
            float: right;
        }

        .ui-case-title i.icon-box-anli {
            background-position: -30px -194px;
            display: block;
            height: 16px;
            left: 62px;
            position: absolute;
            top: 16px;
            width: 16px;
        }

        .financing-report .ui-case-title i.icon-box-anli {
            background-position: -47px -194px;
        }

        .ui-case-pic {
            float: left;
            margin-right: 10px;
        }

        .ui-case-info {
            float: left;
            width: 195px;
        }

        .ui-case-info strong {
            display: block;
            font-size: 14px;
            height: 22px;
            line-height: 18px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 195px;
        }

        .ui-case-info p {
            color: #666;
            height: 68px;
            line-height: 20px;
            margin: 3px 0 8px;
            overflow: hidden;
        }

        .btn-case-more {
            background-color: #e7e7e7;
            border-radius: 3px;
            color: #333;
            display: inline-block;
            height: 24px;
            line-height: 24px;
            text-align: center;
            width: 80px;
        }

        .classify {
            overflow: hidden;
            width: 1180px;
        }

        .classify-group {
            width: 1180px;
        }

        .classify-item {
            float: left;
            margin-right: 10px;
            padding-top: 10px;
            width: 382px;
        }

        .classify-head {
            background-color: #f8f8f8;
            height: 32px;
            line-height: 32px;
            padding: 0 10px;
        }

        .classify-title {
            float: left;
            font-size: 14px;
            font-weight: bold;
        }

        .classify-title a {
            color: #666;
        }

        .classify-title span {
            color: #666;
            font-size: 12px;
            font-weight: normal;
            margin-left: 5px;
        }

        .classify-title span em {
            color: #f06612;
        }

        .classify-more {
            color: #666;
            float: right;
            font-size: 12px;
        }

        .classify-cont {
            overflow: hidden;
            padding: 10px;
            width: 300px;
        }

        .classify-info-region,
        .classify-info-name {
            display: block;
            float: left;
            height: 30px;
            line-height: 30px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .classify-info-region {
            width: 50px;
        }

        .classify-info-region a {
            color: #56C6FF;
        }

        .classify-info-name {
            margin-left: 10px;
            width: 240px;
        }

        .classify-info-name a {
            color: #666;
        }

        .ui-box-cont {
            padding: 10px;
        }

        .btn-emphasis-item {
            background-color: #fff;
            border: 1px solid #ea4f39;
            border-radius: 3px;
            color: #ef4349;
            display: block;
            font-size: 12px;
            font-weight: normal;
            height: 22px;
            left: 120px;
            line-height: 22px;
            margin-left: 15px;
            padding: 0 10px;
            position: absolute;
            top: 12px;
            white-space: nowrap;
        }

        a.btn-emphasis-item:hover {
            background-color: #ef4349;
            color: #fff;
            text-decoration: none;
        }

        html,
        body,
        .ui-case-title a,
        .ui-case-pic a {
            color: #333;
        }

        .ui-box-more {
            color: #666;
            display: block;
            float: right;
            height: 48px;
            line-height: 48px;
            padding-right: 45px;
            position: relative;
        }

        .case-repeat {
            height: 234px;
            overflow: hidden;
            width: 348px;
        }

        .case-repeat ul {
            height: 234px;
            width: 696px;
        }

        .case-repeat li {
            float: left;
            height: 234px;
            width: 348px;
        }

        .icon-box-more {
            background-color: #e8e8e8;
            background-position: -83px -72px;
            height: 24px;
            position: absolute;
            right: 0;
            top: 12px;
            width: 36px;
        }

        .look-sort {
            height: 132px;
            overflow: hidden;
            padding-top: 0px;
        }

        .look-sort dl {
            float: left;
        }

        .look-sort dl dt {
            display: block;
            float: left;
            font-size: 14px;
            font-weight: bold;
            padding-bottom: 8px;
            width: 100%;
        }

        .look-sort dl dd {
            float: left;
            height: 26px;
            line-height: 28px;
            overflow: hidden;
            white-space: normal;
            width: 100%;
        }

        .look-sort dl dd a {
            color: #666;
        }

        .look-grid-01 {
            width: 110px;
        }

        .look-grid-03 {
            margin-right: 10px;
            width: 210px;
        }

        dl.look-grid-03 dd {
            float: left;
            width: 33.3%;
        }

        .look-grid-02 {
            width: 172px;
        }

        dl.look-grid-02 dd {
            width: 50%;
        }

        .input-look-search {
            background-color: #fff;
            border: 2px solid #56C6FF;
            float: left;
            font-size: 14px;
            height: 20px;
            padding: 8px;
            width: 300px;
        }

        .input-look-search.item {
            width: 380px;
        }

        .btn-look-search {
            background-color: #56C6FF;
            border: 0 none;
            color: #fff;
            cursor: pointer;
            float: left;
            font-size: 14px;
            font-weight: bold;
            height: 40px;
            text-align: center;
            width: 98px;
        }

        .fn-mt-20 {
            margin-top: 20px !important;
        }

        .look-tab-head li {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-top: 1px solid #ddd;
            cursor: pointer;
            float: left;
            height: 154px;
            margin-top: -1px;
            position: relative;
            width: 59px;
        }

        body .fn-hide {
            display: none;
        }

        .ui-case-strategy {
            border-top: 1px solid #eee;
            color: #666;
            line-height: 48px;
            text-align: center;
        }

        .ui-case-strategy a {
            color: #56C6FF;
            font-size: 14px;
            padding-left: 28px;
            position: relative;
        }

        .ui-case-strategy a i.icon-box-help {
            background-position: 0 -194px;
            display: block;
            height: 13px;
            left: 5px;
            position: absolute;
            top: 2px;
            width: 19px;
        }

        .ui-case-data .text {
            display: block;
            float: left;
            font-size: 14px;
            height: 18px;
            margin: 0 5px;
            padding-top: 18px;
        }

        body {
            background-color: #eee;
            font-family: "微软雅黑";
        }

        .ui-box {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .ui-case-title {
            font-size: 14px;
            height: 50px;
            line-height: 50px;
            position: relative;
        }

        .ui-case-title .more {
            float: right;
        }

        .ui-case-title i.icon-box-anli {
            background-position: -30px -194px;
            display: block;
            height: 16px;
            left: 62px;
            position: absolute;
            top: 16px;
            width: 16px;
        }
    </style>
    <div id="content" style="margin-top:20px;">
        <div class="container">
            <div class="look-tab" id="look-tab">
                <div class="ui-tab-head look-tab-head">
                    <ul>
                        <li id="look-tab-2" class="ui-tab-head-current"><span class="look-title">找资金</span></li>
                        <li><span class="look-title">选项目</span></li>
                    </ul>
                </div>
                <div class="ui-tab-cont look-tab-cont">
                    <div class="look-item ">
                        <form class="look-form fn-clear" action="Fund/fund_list" method="get">
                            <input name="k" id="J_keyword_zj" class="input-look-search J_placeholder" maxlength="30" tip="输入你想找的资金，来试试吧…" value="输入你想找的资金，来试试吧…" style="color: rgb(153, 153, 153);" type="text">
                            <button class="btn-look-search J_search_submit" type="submit">搜资金</button>
                        </form>
                        <div class="look-sort fn-clear">
                            <dl class="look-grid-01">
                                <dt>投资方式</dt>
                                <dd><a href="/Fund/fund_list/info_type/2010" target="_blank">股权投资</a></dd>
                                <dd><a href="/Fund/fund_list/info_type/2011" target="_blank">债权投资</a></dd>
                                <dd><a href="/Fund/fund_list/info_type/2012" target="_blank">金融投资</a></dd>
                                <dd><a href="/Fund/fund_list/info_type/2013" target="_blank">BT/BOT投资</a></dd>
                            </dl>
                            <dl class="look-grid-03">
                                <dt>资金主体</dt>
                                <dd><a href="/Fund/fund_list/funds_body/301" target="_blank">个人资金</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/302" target="_blank">企业资金</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/303" target="_blank">天使投资</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/304" target="_blank">VC投资</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/305" target="_blank">PE投资</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/306" target="_blank">小额贷款</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/310" target="_blank">投资公司</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/311" target="_blank">商业银行</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/312" target="_blank">基金公司</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/313" target="_blank">证券公司</a></dd>
                                <dd><a href="/Fund/fund_list/funds_body/308" target="_blank">担保公司</a></dd>
                                <dd><a href="/fund/fund_list" target="_blank">更多</a></dd>
                            </dl>
                            <dl class="look-grid-02">
                                <dt>投资金额</dt>
                                <dd><a href="/Fund/fund_list/mo/357" target="_blank">1万-10万</a></dd>
                                <dd><a href="/Fund/fund_list/mo/358" target="_blank">10万-50万</a></dd>
                                <dd><a href="/Fund/fund_list/mo/359" target="_blank">50万-100万</a></dd>
                                <dd><a href="/Fund/fund_list/mo/360" target="_blank">100万-500万</a></dd>
                                <dd><a href="/Fund/fund_list/mo/361" target="_blank">500万-1000万</a></dd>
                                <dd><a href="/Fund/fund_list/mo/362" target="_blank">1000万-5000万</a></dd>
                                <dd><a href="/Fund/fund_list/mo/363" target="_blank">5000万-1亿</a></dd>
                                <dd><a href="/Fund/fund_list/mo/364" target="_blank">1亿以上</a></dd>
                            </dl>
                        </div>
                        <div class="look-tips">
                            不知道怎么找？
                            <a href="<?php echo U('Item/item_list');?>" id="J_btn_look_fund" class="btn-look-tips fn-ml-10">
                                <!--填写项目信息，-->帮您找资金</a>
                        </div>
                    </div>
                    <div class="look-item fn-hide">
                        <form class="look-form fn-clear" action="Item/item_list" method="get">
                            <input name="k" id="J_keyword_xm" class="input-look-search item J_placeholder" maxlength="30" tip="输入你想找的项目，来试试吧…" value="输入你想找的项目，来试试吧…" style="color: rgb(153, 153, 153);" type="text">
                            <button class="btn-look-search J_search_submit" type="submit">找项目</button>
                        </form>
                        <div class="look-sort fn-clear">
                            <dl class="look-grid-01">
                                <dt>融资方式</dt>
                                <dd><a href="/Item/item_list/xmrz_type/618" target="_blank">债权融资</a></dd>
                                <dd><a href="/Item/item_list/xmrz_type/619" target="_blank">股权融资</a></dd>
                                <dd><a href="/Item/item_list/xmrz_type/892" target="_blank">其他融资</a></dd>
                                <dd><a href="/Item/item_list/xmrz_type/891" target="_blank">整体转让</a></dd>
                            </dl>
                            <dl class="look-grid-02">
                                <dt>热门行业</dt>
                                <dd><a href="/Item/item_list/industry_id/392" target="_blank">IT互联网</a></dd>
                                <dd><a href="/Item/item_list/industry_id/373" target="_blank">农林牧渔</a></dd>
                                <dd><a href="/Item/item_list/industry_id/366" target="_blank">房地产</a></dd>
                                <dd><a href="/Item/item_list/industry_id/383" target="_blank">餐饮休闲娱乐</a></dd>
                                <dd><a href="/Item/item_list/industry_id/370" target="_blank">建筑建材</a></dd>
                                <dd><a href="/Item/item_list/industry_id/382" target="_blank">旅游酒店</a></dd>
                                <dd><a href="/Item/item_list/industry_id/389" target="_blank">食品饮料烟草</a></dd>
                                <dd><a href="/Item/item_list/industry_id/369" target="_blank">节能环保</a></dd>
                            </dl>
                            <dl class="look-grid-03">
                                <dt>热门地区</dt>
                                <dd><a href="/Item/item_list/province_id/507" target="_blank">广东省</a></dd>
                                <dd><a href="/Item/item_list/province_id/2316" target="_blank">山东省</a></dd>
                                <dd><a href="/Item/item_list/province_id/5" target="_blank">浙江省</a></dd>
                                <dd><a href="/Item/item_list/province_id/1105" target="_blank">河南省</a></dd>
                                <dd><a href="/Item/item_list/province_id/2760" target="_blank">四川省</a></dd>
                                <dd><a href="/Item/item_list/province_id/1770" target="_blank">江苏省</a></dd>
                                <dd><a href="/Item/item_list/province_id/6" target="_blank">北京</a></dd>
                                <dd><a href="/Item/item_list/province_id/1561" target="_blank">湖南省</a></dd>
                                <dd><a href="/Item/item_list/province_id/917" target="_blank">河北省</a></dd>
                                <dd><a href="/Item/item_list/province_id/777" target="_blank">贵州省</a></dd>
                                <dd><a href="/Item/item_list/province_id/1440" target="_blank">湖北省</a></dd>
                                <dd><a href="/Item/item_list/province_id/3191" target="_blank">云南省</a></dd>
                            </dl>
                        </div>
                        <div class="look-tips">
                            让项目方主动找您？<a href="<?php echo U('Members/register',array('utype'=>1));?>" target="_blank" class="btn-look-tips fn-ml-10">申请成为投资人</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui-case">
                <div class="ui-case-total" id="case-total-roll1">
                    <ul>
                        <li class="ui-case-data fn-clear">
                            <span class="text">今日新增项目&nbsp;</span>
                            <div class="today_num">
<!--
<span class="figure">1</span>
<span class="punctuation">,</span>
-->
                                <script type="text/html" id="case_num">
                                    <%for(var i=0;i<data.length;i++){%>
                                        <span class="figure"><%=data[i]%></span>
                                        <%if(data.length >=4){%>
                                            <%if(i == 0){%><span class="punctuation">,</span>
                                                <%}%>
                                                    <%}%>
                                                        <%}%>
                                </script>
                            </div>
                            <span class="text">个</span>
                        </li>
                    </ul>
                </div>
                <div class="case-repeat slideCase">
                    <div class="tempWrap" style="overflow:hidden; position:relative; width:348px">
                        <ul>
                            <li class="financing-report">
                                <div class="ui-case-group">
                                    <div class="ui-case-title">融资报告
                                        <i class="icon-box-anli"></i>
                                    </div>
                                    <p>
                                        <a href="<?php echo U('home/News/show',array('id'=>$top_report['id']));?>" target="_blank"><img src="<?php echo attach($top_report['small_img'],images);?>" width="300" height="129"></a>
                                    </p>
                                </div>
                                <div class="ui-case-strategy">
                                    融资早知道，创业有方向 快来看看吧 <a href="#" target="_blank">金融网每日融资报告</a>
                                </div>
                            </li>

                            <li class="success-case">
                                <div class="ui-case-group">
                                    <div class="ui-case-title"><a href="<?php echo U('Case/index');?>" target="_blank">成功案例</a>
                                        <i class="icon-box-anli"></i>
                                    </div>
                                    <div class="ui-case-pic">
                                        <a href="<?php echo U('home/Case/index');?>" title="成功案例" target="_blank">
                                            <img src="./data/upload/images/402_1491385911.jpg" alt="成功案例" width="90" height="90">
                                        </a>
                                    </div>
                                    <div class="ui-case-info">
                                        <strong><?php echo ($success_case['title']); ?></strong>
                                        <p><?php echo cut_str($success_case['i_overview'],40,0,'...');?></p>
                                        <a href="#" class="btn-case-more" target="_blank">查看详细 &gt;</a>
                                    </div>
                                </div>
                                <div class="ui-case-strategy">
                                    想要和他们一样快速成功融资？快来看看<a href="#" target="_blank"><i class="icon-box-help"></i>融资攻略</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="ui-box fn-mt-20">
                <div class="ui-box-head">
                    <h2 class="ui-box-title"><i class="icon-box-money"></i>精选资金</h2>
                    <a href="/fund/fund_list" target="_blank" class="ui-box-more">查看更多</a>
                </div>
                <div class="ui-box-cont fn-clear">
                    <div class="classify">
                        <ul class="classify-group">

                            <li class="classify-item">
                                <div class="classify-head fn-clear">
                                    <h3 class="classify-title"><a href="/Fund/fund_list/info_type/2010" target="_blank">股权投资</a></h3>
                                    <a href="/Fund/fund_list/info_type/2010" target="_blank" class="classify-more">更多</a>
                                </div>

                                <dl class="classify-cont fn-clear">
                                    <?php if(is_array($fund_list_2010)): foreach($fund_list_2010 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Fund/fund_show',array('funds_body'=>$vo['funds_body']));?>" title="<?php echo ($category['funds_body'][$vo['funds_body']]); ?>" target="_blank"><?php echo ($category['funds_body'][$vo['funds_body']]); ?></a></dt>
                                        <dd class="classify-info-name"><a href="<?php echo U('Fund/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                                </dl>
                            </li>
                            <li class="classify-item">
                                <div class="classify-head fn-clear">
                                    <h3 class="classify-title"><a href="/Fund/fund_list/info_type/2011" target="_blank">债权投资</a></h3>
                                    <a href="/Fund/fund_list/info_type/2011" target="_blank" class="classify-more">更多</a>
                                </div>
                                <dl class="classify-cont fn-clear">
                                    <?php if(is_array($fund_list_2011)): foreach($fund_list_2011 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Fund/show',array('funds_body'=>$vo['funds_body']));?>" title="<?php echo ($category['funds_body'][$vo['funds_body']]); ?>" target="_blank"><?php echo ($category['funds_body'][$vo['funds_body']]); ?></a></dt>
                                        <dd class="classify-info-name"><a href="<?php echo U('Fund/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                                </dl>
                            </li>
                            <li class="classify-item">
                                <div class="classify-head fn-clear">
                                    <h3 class="classify-title"><a href="/Fund/fund_list/info_type/2014" target="_blank">其它投资</a></h3>
                                    <a href="/Fund/fund_list/info_type/2014" target="_blank" class="classify-more">更多</a>
                                </div>
                                <dl class="classify-cont fn-clear">
                                    <?php if(is_array($fund_list_2014)): foreach($fund_list_2014 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Fund/fund_list',array('funds_body'=>$vo['funds_body']));?>" title="<?php echo ($category['funds_body'][$vo['funds_body']]); ?>" target="_blank"><?php echo ($category['funds_body'][$vo['funds_body']]); ?></a></dt>
                                        <dd class="classify-info-name"><a href="<?php echo U('Fund/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                                </dl>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="ui-box fn-mt-20">
                <div class="ui-box-head">
                    <h2 class="ui-box-title">
                        <i class="icon-box-item"></i>优质项目<a href="javascript:;" class="btn-emphasis-item">重点项目推荐</a></h2>
                    <a href="/item/item_list" target="_blank" class="ui-box-more">查看更多</a>
                </div>
                <div class="ui-box-cont fn-clear" class="visibility:hidden;">
                    <div class="exhibition" id="exhibition" style="/*visibility:hidden;*/display: none;">
                        <a class="prev" href="javascript:void(0)"></a>
                        <a class="next" href="javascript:void(0)"></a>
                        <div class="exhibition-scroll">
                            <ul>
                                <li>
                                    <div class="flipcard-container">
                                        <div class="flipcard">
                                            <div class="back face">
                                                <a href="" target="_blank" title="黑龙江胚芽米项目股权融资">
                                                    <h3>黑龙江胚芽米项目股权融资</h3>
                                                    <p class="text">
                                                        所属行业：农林牧渔<br> 融资金额：3000万元
                                                        <br> 所在地区：黑龙江
                                                    </p>
                                                </a>
                                            </div>


                                            <div class="front face"></div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="flipcard-container">
                                        <div class="flipcard">
                                            <div class="back face">
                                                <a href="" target="_blank" title="广州咖啡轻社交互动平台建设">
                                                    <h3>广州咖啡轻社交互动平台建设</h3>
                                                    <p class="text">
                                                        所属行业：IT互联网<br> 融资金额：650万元-750万元
                                                        <br> 所在地区：广东省
                                                    </p>
                                                </a>
                                            </div>

                                            <div class="front face"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="classify">
                    <ul class="classify-group">
                        <li class="classify-item">
                            <div class="classify-head fn-clear">
                                <h3 class="classify-title"><a href="/Item/item_list/industry_id/392" target="_blank">IT互联网</a></h3>
                                <a href="/Item/item_list/industry_id/392" target="_blank" class="classify-more">更多</a>
                            </div>
                            <dl class="classify-cont fn-clear">
                                <?php if(is_array($item_list_392)): foreach($item_list_392 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Item/item_list',array('province_id'=>$vo['province_id']));?>" title="<?php echo ($category['province'][$vo['province_id']]); ?>" target="_blank"><?php echo ($category['province'][$vo['province_id']]); ?></a></dt>
                                    <dd class="classify-info-name"><a href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                            </dl>
                        </li>
                        <li class="classify-item">
                            <div class="classify-head fn-clear">
                                <h3 class="classify-title"><a href="/Item/item_list/industry_id/373" target="_blank">农林牧渔</a></h3>
                                <a href="/Item/item_list/industry_id/373" target="_blank" class="classify-more">更多</a>
                            </div>
                            <dl class="classify-cont fn-clear">
                                <?php if(is_array($item_list_373)): foreach($item_list_373 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Item/item_list',array('province_id'=>$vo['province_id']));?>" title="<?php echo ($category['province'][$vo['province_id']]); ?>" target="_blank"><?php echo ($category['province'][$vo['province_id']]); ?></a></dt>
                                    <dd class="classify-info-name"><a href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                            </dl>
                        </li>
                        <li class="classify-item">
                            <div class="classify-head fn-clear">
                                <h3 class="classify-title"><a href="/Item/item_list/industry_id/366" target="_blank">房地产</a></h3>
                                <a href="/Item/item_list/industry_id/366" target="_blank" class="classify-more">更多</a>
                            </div>
                            <dl class="classify-cont fn-clear">
                                <?php if(is_array($item_list_366)): foreach($item_list_366 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Item/item_list',array('province_id'=>$vo['province_id']));?>" title="<?php echo ($category['province'][$vo['province_id']]); ?>" target="_blank"><?php echo ($category['province'][$vo['province_id']]); ?></a></dt>
                                    <dd class="classify-info-name"><a href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                            </dl>
                        </li>
                        <li class="classify-item">
                            <div class="classify-head fn-clear">
                                <h3 class="classify-title"><a href="/Item/item_list/industry_id/383" target="_blank">餐饮休闲娱乐</a></h3>
                                <a href="/Item/item_list/industry_id/383" target="_blank" class="classify-more">更多</a>
                            </div>
                            <dl class="classify-cont fn-clear">
                                <?php if(is_array($item_list_383)): foreach($item_list_383 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Item/item_list',array('province_id'=>$vo['province_id']));?>" title="<?php echo ($category['province'][$vo['province_id']]); ?>" target="_blank"><?php echo ($category['province'][$vo['province_id']]); ?></a></dt>
                                    <dd class="classify-info-name"><a href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                            </dl>
                        </li>
                        <li class="classify-item">
                            <div class="classify-head fn-clear">
                                <h3 class="classify-title"><a href="/Item/item_list/industry_id/370" target="_blank">建筑建材</a></h3>
                                <a href="/Item/item_list/industry_id/370" target="_blank" class="classify-more">更多</a>
                            </div>
                            <dl class="classify-cont fn-clear">
                                <?php if(is_array($item_list_370)): foreach($item_list_370 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Item/item_list',array('province_id'=>$vo['province_id']));?>" title="<?php echo ($category['province'][$vo['province_id']]); ?>" target="_blank"><?php echo ($category['province'][$vo['province_id']]); ?></a></dt>
                                    <dd class="classify-info-name"><a href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                            </dl>
                        </li>
                        <li class="classify-item">
                            <div class="classify-head fn-clear">
                                <h3 class="classify-title"><a href="/Item/item_list/industry_id/400" target="_blank">其他行业</a></h3>
                                <a href="/Item/item_list/industry_id/400" target="_blank" class="classify-more">更多</a>
                            </div>
                            <dl class="classify-cont fn-clear">
                                <?php if(is_array($item_list_400)): foreach($item_list_400 as $key=>$vo): ?><dt class="classify-info-region"><a href="<?php echo U('Item/item_list',array('province_id'=>$vo['province_id']));?>" title="<?php echo ($category['province'][$vo['province_id']]); ?>" target="_blank"><?php echo ($category['province'][$vo['province_id']]); ?></a></dt>
                                    <dd class="classify-info-name"><a href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
                            </dl>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>



    <div class="links link_gray6">
        <?php $tag_link_class = new \Common\qscmstag\linkTag(array('列表名'=>'links','类型'=>'2','cache'=>'0','type'=>'run',));$links = $tag_link_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"金融汇","keywords"=>"项目融资,融资,天使投资,投资,投资项目,投资公司,项目,股权融资,债权融资,投融资,融资平台,金融汇","description"=>"金融汇（7ronghui.com）是中国最大的融资服务平台，拥有超百万的投融资机构、企业与个人用户入驻。金融汇通过线上＋线下、标准化  ＋个性化的服务体系，为客户提供针对性的投融资信息对接和项目撮配服务，成功对接融资千余亿元。金融汇凭借其强大、便捷的平台信息整合能力，大大提高企业投融资活动成功率，为中小微企业解决融资难问题。","header_title"=>""),$links);?>
        <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><div class="imglink">
                <a href="<?php echo ($link["link_url"]); ?>" target="_blank"><img src="<?php echo attach($link['link_logo'],'link_logo');?>" border="0" /></a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>

        <?php $tag_link_class = new \Common\qscmstag\linkTag(array('列表名'=>'links','类型'=>'1','cache'=>'0','type'=>'run',));$links = $tag_link_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"金融汇","keywords"=>"项目融资,融资,天使投资,投资,投资项目,投资公司,项目,股权融资,债权融资,投融资,融资平台,金融汇","description"=>"金融汇（7ronghui.com）是中国最大的融资服务平台，拥有超百万的投融资机构、企业与个人用户入驻。金融汇通过线上＋线下、标准化  ＋个性化的服务体系，为客户提供针对性的投融资信息对接和项目撮配服务，成功对接融资千余亿元。金融汇凭借其强大、便捷的平台信息整合能力，大大提高企业投融资活动成功率，为中小微企业解决融资难问题。","header_title"=>""),$links);?>
        <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><!--<div class="txtlink substring"><a href="<?php echo ($link["link_url"]); ?>" target="_blank"><?php echo ($link["title"]); ?></a></div>--><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
    </div>


    <style type="text/css">.eqx-ui-footer{width:100%;background-color:#334259;color:#a6b9d3;text-align:left;font-size:12px}.eqx-ui-footer p{line-height:22px}.eqx-ui-footer a{color:#a6b9d3;text-decoration:none}.eqx-ui-footer a:hover{color:#fff}.eqx-ui-footer .renzheng{position:relative}.eqx-ui-footer .renzheng .bbs{background-color:#56c6ff;padding:0 10px;color:#fff;line-height:30px}.eqx-ui-footer .renzheng .bbs:hover{background-color:#08a1ef}.eqx-ui-footer .renzheng .wx{background-color:#6cd69d;border-radius:3px;cursor:pointer}.eqx-ui-footer .renzheng .wx:hover{background-color:#44cb83}.eqx-ui-footer .renzheng .out-red{background-color:#ff847b}.eqx-ui-footer .renzheng .out-red:hover{background-color:#ff5448}.eqx-ui-footer .renzheng .qq-group{width:30px;line-height:30px;overflow:hidden;background-color:#56c6ff}.eqx-ui-footer .renzheng .qq-group em,.eqx-ui-footer .renzheng .qq-group span{float:left}.eqx-ui-footer .renzheng .qq-group:hover{background-color:#08a1ef;width:100px}.eqx-ui-footer .renzheng .qq-group:hover em{color:#fff}.eqx-ui-footer .renzheng a{float:left;position:relative;height:30px;font-size:12px;margin-right:5px;border-radius:3px}.eqx-ui-footer .renzheng a em{height:30px;line-height:30px;display:inline-block;width:30px;font-size:14px;color:#fff;border-radius:3px;text-align:center}.eqx-ui-footer .renzheng a .weixin{position:absolute;bottom:50px;left:-40px;display:none;z-index:2}.eqx-ui-footer .renzheng a:hover .weixin{display:block}.eqx-ui-footer .same-border{border-bottom:1px solid hsla(0,0%,100%,.2)}.eqx-ui-footer .home-help{width:26%;float:left;padding:30px 0 20px}.eqx-ui-footer .home-help.long-same{width:18%}.eqx-ui-footer .home-help:last-child{width:20%}.eqx-ui-footer .home-help h6{font-size:14px;margin-bottom:30px}.eqx-ui-footer .home-help h6 em{border-bottom:1px solid #44cb83;padding-bottom:10px;color:#fff}.eqx-ui-footer .home-help ul li{line-height:25px}.eqx-ui-footer .home-help ul li a{font-size:12px}.eqx-ui-footer .home-help ul li a:hover{color:#fff}.eqx-ui-footer .contact-friend{padding:20px 0}.eqx-ui-footer .contact-friend ul{max-height:51px;overflow:hidden}.eqx-ui-footer .contact-friend ul li{margin-right:15px;float:left;line-height:25px}.eqx-ui-footer .contact-friend ul li:last-child{margin-right:0}.eqx-ui-footer .company-info{padding:20px 0}.eqx-ui-footer .same-content, .eqx-ui-header .same-content, .eqx-ui-sidebar .same-content {
    margin: 0 auto;
    width: 1180px;
}em, i {
    font-style: normal;
    font-weight: 400;
}.eqx-ui-footer .contact-friend {
    padding: 20px 0;
}
.eqx-ui-footer .contact-friend ul {
    max-height: 51px;
    overflow: hidden;
}
.eqx-ui-footer .contact-friend ul li {
    float: left;
    line-height: 25px;
    margin-right: 15px;
}
.eqx-ui-footer .contact-friend ul li:last-child {
    margin-right: 0;
}
.f2 {
    float: right;
    height: 88px;
    width: 280px;
}
.f2 > p {
    color: #a6b9d3;
    font-size: 12px;
    height: 22px;
    line-height: 22px;
}
.fr {
    float: right;
}
</style>
<link href="../public/css/font/iconfonts.min.css" rel="stylesheet" type="text/css" />
<div class="eqx-ui-footer">
<div class="same-content">
<div class="help-contain clearfix same-border">
<div class="home-help long-same">
<h6><em>金融网</em></h6>
<ul>
<li><a href="<?php echo U('Index/about');?>" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">关于我们</a></li>
<li><a href="<?php echo U('Explain/explain_show',array('id'=>8));?>" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">招贤纳士</a></li>
<li><a href="<?php echo U('Explain/explain_show',array('id'=>7));?>" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">联系我们</a></li>
</ul>
</div> 
<div class="home-help long-same">
<h6><em>新手指导</em></h6>
<ul>

<li><a href="<?php echo U('Help/help_list',array('id'=>16));?>" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">免费注册生成名片</a>
</li>

<li><a href="<?php echo U('Help/help_list',array('id'=>41));?>" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">免费发布投融资信息</a></li>

<li><a href="<?php echo U('Help/help_list',array('id'=>3));?>" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">常见问题解答</a></li>

</ul>
</div>


<div class="home-help long-same"> <h6><em>企业服务</em></h6> 
<ul> <li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">金融宝</a></li> <li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">委托刷新</a> </li>
<li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">投递项目</a></li> </ul>
</div>

<div class="home-help long-same"><h6><em>平台保障</em></h6>
<ul>
<li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">信息审核及被关闭</a>
</li>
<li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">会员认证</a>
</li>
<li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">隐私保护</a>
</li>

<li><a href="#" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">违规处罚</a>
</li>
</ul> 
</div> 
<div class="home-help"> <h6><em>加盟合作</em></h6> 
<ul>

<li><a href="<?php echo U('Lianmeng/locate');?>" target="_self" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">金融网投资生态联盟</a></li>

<li><a href="<?php echo U('Loan/apply_loan');?>" target="_blank" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">线下机构加盟合作</a></li> 
</ul> 
</div>
</div>
<div class="contact-friend same-border">
<ul class="clearfix">
<li ng-repeat="link in friendLinks track by $index" class="ng-scope">
<a href="#" target="_blank" class="ng-binding">友链互换:</a>
</li>


 <li class="ng-scope">
 <a target="_blank" class="ng-binding" href="<?php echo U('suggest/index');?>">交换友链</a>
 </li>

 <?php $tag_link_class = new \Common\qscmstag\linkTag(array('列表名'=>'links','类型'=>'1','cache'=>'0','type'=>'run',));$links = $tag_link_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"金融汇","keywords"=>"项目融资,融资,天使投资,投资,投资项目,投资公司,项目,股权融资,债权融资,投融资,融资平台,金融汇","description"=>"金融汇（7ronghui.com）是中国最大的融资服务平台，拥有超百万的投融资机构、企业与个人用户入驻。金融汇通过线上＋线下、标准化  ＋个性化的服务体系，为客户提供针对性的投融资信息对接和项目撮配服务，成功对接融资千余亿元。金融汇凭借其强大、便捷的平台信息整合能力，大大提高企业投融资活动成功率，为中小微企业解决融资难问题。","header_title"=>""),$links);?>
 <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><li class="ng-scope"><a href="<?php echo ($link["link_url"]); ?>" class="ng-binding" target="_blank"><?php echo ($link["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul> 

</div><div class="company-info clearfix">
<div class="fr" style="width:280px">
<div class="fr" style="background-color:#fff"><img src="../public/images/v2/weixin_erweima.jpg" width="80px" height="80px;" alt="微信关注"></div> <p>微信：扫描二维码咨询在线客服</p> <p class="ng-binding">邮箱：</p>
<p class="ng-binding">400电话：</p> <p class="ng-binding">时间：9:00-18:00</p> </div> <div class="fl"><p>© 2012-2017 jinrong.com. All rights reserved 金融网 V1.01</p>
<p>网站备案：<a href="http://www.miibeian.gov.cn"></a></p>
<div class="renzheng" style="padding-top:10px">
<a href="http://bbs.jinrong.com" class="bbs all-change ng-isolate-scope" target="_blank" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2">官方论坛</a> <a> <em class="eqf-wechat wx all-change"></em>
<div class="weixin" style="background-color:#fff"><img src="../public/images/v2/weixin_erweima.jpg" width="120px" height="120px"></div></a>
<a href="http://weibo.com/u/6212990189" target="_blank" big-data-event="" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2" class="ng-isolate-scope">
<em class="eqf-weibo out-red all-change"></em>
</a>
<a href="https://jq.qq.com/?_wv=1027&k=4ANgZ8X" target="_blank" class="qq-group all-change ng-isolate-scope" category-one="Public" category-two="页面布局" category-three="底导" one-id="24" two-id="1" three-id="2"> <em class="eqf-qq"></em>
<span>QQ群交流</span>
</a>
</div> 
</div>
</div> 
</div> 
</div>
<script type="text/javascript" src="../public/js/jquery.tooltip.js"></script>
<style type="text/css">
.tip_anim {
    display: block;
    -webkit-animation-name: bounceIn;
    animation-name: bounceIn
}
@-webkit-keyframes bounceOut {
    100% {
        opacity: 0;
        -webkit-transform: scale(.7);
        transform: scale(.7)
    }

    30% {
        -webkit-transform: scale(1.03);
        transform: scale(1.03)
    }

    0% {
        -webkit-transform: scale(1);
        transform: scale(1)
    }
}

@keyframes bounceOut {
    100% {
        opacity: 0;
        -webkit-transform: scale(.7);
        -ms-transform: scale(.7);
        transform: scale(.7)
    }

    30% {
        -webkit-transform: scale(1.03);
        -ms-transform: scale(1.03);
        transform: scale(1.03)
    }

    0% {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1)
    }
}
.tip_anim_close {
    z-index: -100;
    background: rgba(0,0,0,0);
    -pie-background: rgba(0,0,0,0);
    -webkit-animation-name: bounceOut;
    animation-name: bounceOut;
    -webkit-animation-duration: .2s;
    animation-duration: .2s;
}
</style>
<script type="text/javascript">
$(".bbs").click(function(){
        setTimeout(function() { 
            disapperTooltip("success", "改版中,请耐心等待!");
},300);
});
</script>
    <div id="popup-captcha"></div>
    <script src="../public/js/jquery.modal.dialog.js"></script>
    <script src="../public/js/jquery.tooltip.js"></script>
    <script src="../public/js/jquery.listitem.js"></script>
    <script src="../public/js/jquery.dropdown.js"></script>
    <script src="../public/js/jquery.nivo.slider.pack.js"></script>

    <!--[if lt IE 9]>
<script src="../public/js/PIE.js"></script>
<![endif]-->
    <script src="../public/js/jquery.index.js"></script>
    <script src="../public/js/jquery.SuperSlide.2.1.1.js"></script>
    <script>
        $.get("<?php echo U('Item/today_item_num');?>", function(data) {
            $('.today_num').html(baidu.template('case_num', data));
        });
    </script>
    <script type="text/javascript">
        $(".btn-emphasis-item").click(function() {
            setTimeout(function() {
                disapperTooltip("success", "正在汇总精编项目方,请耐心等待!");
            }, 300);
        });
    </script>
    <script>
        $(".slideCase").slide({
            mainCell: "ul",
            effect: "leftLoop",
            autoPlay: !0
        });
        $('.sdg-sub-city').each(function(index, value) {
            if ((index + 1) % 4 == 0) {
                $(this).addClass('no-mr');
            }
        });
    </script>
    <script src="../public/js/jquery.validate.js"></script>
    <script src="../public/js/index_login.js"></script>
    <script src="../public/js/index_reg.js"></script>
    <script src="../public/js/check.js"></script>
    <script src="../public/js/jquery.disappear.tooltip.js"></script>
    <script>
        $(".ui-tab-head ul li").click(function() {
            var num = $(this).index();
            $(".ui-tab-head li").removeClass("ui-tab-head-current").eq(num).addClass("ui-tab-head-current");
            $(".look-item").hide().eq(num).show();
        });
    </script>
    <script>
        $("input.J_placeholder").focus(function() {
            var cur = $(this);
            cur.val() == cur.attr("tip") && cur.val("").css({
                color: "#333"
            })
        }).blur(function() {
            var cur = $(this);
            "" == cur.val() && cur.val(cur.attr("tip")).css({
                color: "#999"
            })
        }).css({
            color: "#999"
        });
        $("button.J_search_submit").click(function() {
            var b = $(this).prev(".J_placeholder");
            b.val() == b.attr("tip") && b.val("");
        });

        $(".ul-upscroll").textSlider({line:1,speed:500,timer:3000});

    </script>
</body>

</html>