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
<link href="../public/css/personal/common.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal_index.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal_ajax_dialog.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/receive.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/board.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal.css" rel="stylesheet" type="text/css" />
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<style>
*::-moz-placeholder {
    border: 0 none;
    color: gray;
    cursor: text;
    opacity: 1;
    overflow: hidden;
    padding: 0;
    text-overflow: ellipsis;
}
.select_shelter {
    border: 0 none;
    display: inline-block;
    height: 20px;
}
.standard_select {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    display: inline-block;
    margin-right: 5px;
    padding: 2px;
    vertical-align: middle;
}
.select_shelter {
    border: 0 none;
    display: inline-block;
    height: 20px;
    overflow: hidden;
}
.select_shelter select {
    border: 0 none;
    color: #999;
    padding: 2px;
}
.select_shelter select:focus {
    outline: 0 none;
}
.select-w246 {
    width: 246px;
}
.select-w264 {
    width: 264px;
}
.select-w126 {
    width: 126px;
}
.part-search-nav-a {
    background: #f1f1f1 none repeat scroll 0 0;
    padding: 10px 10px 0;
}
.part-search-nav-a th {
    text-align: right;
}
.part-search-nav-a .fn-tac {
    padding-right: 5px;
    text-align: center;
}
.part-search-nav-a th, .part-search-nav-a td {
    padding-bottom: 10px;
}
.part-search-cont-a table {
    color: #666;
    margin-top: 10px;
    width: 100%;
}
.part-search-cont-a thead th {
    background: #f1f1f1 none repeat scroll 0 0;
    text-align: center;
}
.part-search-cont-a tbody th {
    background: #f5f5f5 none repeat scroll 0 0;
}
.part-search-cont-a th {
    border: 1px solid #f1f1f1;
    padding: 10px;
}
.part-search-cont-a td {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f1f1f1;
    overflow-wrap: break-word;
    padding: 10px;
    word-break: break-all;
}
.part-search-cont-a-msg {
    border: 1px solid #dedede;
    margin-top: 10px;
    position: relative;
}
.part-search-cont-a-msg .ui-le-ht24 {
    padding: 20px 10px;
}
.part-search-cont-a-msg i {
    border: 8px dashed transparent;
    height: 0;
    overflow: hidden;
    position: absolute;
    width: 0;
}
.part-search-cont-a-msg .search-msg-arrow-a {
    border-bottom: 8px solid #fff;
    left: 10px;
    top: -15px;
    z-index: 10;
}
.part-search-cont-a-msg .search-msg-arrow-b {
    border-bottom: 8px solid #dedede;
    left: 10px;
    top: -16px;
}
.part-search-cont-a-msg .search-msg-close {
    font-size: 18px;
    position: absolute;
    right: 10px;
    top: 0;
}
.part-search-cont-a-msg .search-msg-close:hover {
    text-decoration: none;
}
.part-aside-information {
    background: #f5f5f5 none repeat scroll 0 0;
    border: 1px solid #e2e2e2;
    width: 180px;
}
.part-aside-information h2 {
    color: #666699;
    font-family: "宋体";
    font-weight: bold;
    padding: 7px;
}
.part-aside-information h6 {
    background: #ededed none repeat scroll 0 0;
    color: #000;
    font-family: "微软雅黑";
    padding: 7px;
}
.part-aside-information h6 i {
    background: rgba(0, 0, 0, 0) url("../../images/icon-information.png") no-repeat scroll 0 0;
    display: inline-block;
    height: 17px;
    margin-right: 5px;
    vertical-align: middle;
    width: 16px;
}
.part-aside-information .aside-information-icon1 {
    background-position: -1px 0;
}
.part-aside-information .aside-information-icon2 {
    background-position: -21px 0;
}
.part-aside-information .aside-information-icon3 {
    background-position: -44px 0;
}
.part-aside-information .aside-information-icon4 {
    background-position: -66px 0;
}
.part-aside-information p {
    line-height: 22px;
    padding: 7px 7px 7px 28px;
}

.ui-btn-blue {
    background-color: #7381ac !important;
}
a.ui-btn-blue:hover {
    background-color: #8fa0d3 !important;
}
.ui-btn-small {
    height: 24px;
    line-height: 24px;
    padding: 0 6px;
}
.select_shelter select {
    border: 0 none;
    color: #999;
    padding: 2px;
}
.select_shelter select:focus {
    outline: 0 none;
}
.part-fieldset .t_input {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    display: inline-block;
    height: 28px;
    line-height: 28px;
    margin-right: 5px;
    padding: 0 10px;
    position: relative;
    vertical-align: middle;
    width: 248px;
}
.part-fieldset section label {
    color: #666;
    cursor: pointer;
    display: inline-block;
    margin-right: 10px;
}
.part-fieldset section label input {
    margin-right: 3px;
    vertical-align: middle;
}
.part-fieldset .part-fieldset-msg {
    display: inline-block;
    padding: 2px 0;
    vertical-align: middle;
}
.part-fieldset .part-fieldset-msg em {
    display: block;
    margin: 0 0 0 20px;
    position: relative;
}
.part-fieldset .part-fieldset-msg i {
    left: -20px;
    position: absolute;
    top: 2px;
}
.part-fieldset textarea {
    border: 1px solid #ddd;
    display: inline-block;
    height: 72px;
    margin-right: 5px;
    padding: 5px;
    position: relative;
    vertical-align: middle;
    width: 360px;
}
body placeholder {
    white-space: nowrap !important;
}
.part-fieldset-code {
    border: 1px solid #ddd;
    display: inline-block;
    height: 28px;
    line-height: 28px;
    margin-left: -6px;
    text-align: center;
    vertical-align: middle;
    width: 147px;
}
.part-fieldset-code:hover {
    text-decoration: none;
}
.part-fieldset-code-cur, .part-fieldset-code-cur:hover {
    background: #ccc none repeat scroll 0 0;
    color: #999;
}
.part-fieldset-pic-itimg img {
    display: block;
    height: 80px;
    width: 80px;
}
.part-fieldset-pic-ittext {
    margin-left: 100px;
}
.part-fieldset-footer {
    margin: 40px 0;
    text-align: center;
}
.part-fieldset-all-a {
    border: 1px solid #ddd;
    padding: 20px;
}
.part-fieldset-all-aside80 aside {
    width: 80px;
}
.part-fieldset .t_input_disabled {
    background: #f0f0f0 none repeat scroll 0 0;
}
.part-footer-ml146 {
    margin-left: 146px;
}
.part-footer-ml96 {
    margin-left: 96px;
}
.part-footer-ml110 {
    margin-left: 110px;
}
.part-fieldset-multi-select {
    border: 1px solid #ddd;
    cursor: pointer;
    display: inline-block;
    height: 28px;
    line-height: 28px;
    margin-right: 5px;
    overflow: hidden;
    padding: 0 20px 0 10px;
    position: relative;
    vertical-align: middle;
    width: 156px;
}
.part-fieldset-multi-select i {
    border-color: #ddd transparent transparent;
    border-image: none;
    border-style: solid dashed dashed;
    border-width: 6px;
    height: 0;
    overflow: hidden;
    position: absolute;
    right: 5px;
    top: 12px;
    width: 0;
    border-bottom:0;
}
.part-search-nav-a th, .part-search-nav-a td {
    padding-bottom: 10px;
}
.part-search-cont-a table {
    color: #666;
    margin-top: 10px;
    width: 100%;
}
.news-info-title {
    color: #536290;
    height: 20px;
    overflow: hidden;
    white-space: nowrap;
}
.news-info-title span {
    display: inline-block;
    margin-right: 5px;
    vertical-align: middle;
}
.news-info-title .news-info-name {
    font-size: 14px;
    font-weight: bold;
}
.news-info-title .news-info-certification {
    background: #54618f none repeat scroll 0 0;
    color: #fff;
    padding: 0 5px;
}
.news-info-post {
    color: #999;
    height: 20px;
    overflow: hidden;
}
.news-info-message {
    min-height: 20px;
    padding-right: 110px;
    position: relative;
    width: 270px;
}
.news-info-message-cont {
    display: block;
    white-space: normal;
    width: 260px;
}
.news-info-message .fn-text-overflow {
    height: 20px;
    white-space: nowrap;
}
.news-info-genre {
    color: #999;
    display: block;
    position: absolute;
    right: 0;
    top: 0;
    width: 110px;
}
.news-info-time {
    color: #999;
    height: 20px;
    overflow: hidden;
}
.news-info-item {
    border-bottom: 1px dashed #c2c2c2;
    overflow: hidden;
    padding: 15px 0;
    width: 540px;
}
.news-info-hover .news-info-list {
    margin: 0;
    padding: 0;
}
.news-info-hover .news-info-item {
    padding: 15px 30px;
    width: 738px;
}
.user-avatar {
    border: 1px solid #ddd;
    float: left;
    height: 78px;
    overflow: hidden;
    width: 78px;
}
.user-avatar img {
    height: 78px;
    width: 78px;
}
.news-info-wrap {
    float: left;
    padding: 0 60px 0 10px;
    position: relative;
    width: 390px;
}
.news-info-hover .news-info-control {
    margin-top: -10px;
}
.news-info-control {
    position: absolute;
    right: 0;
    text-align: right;
    top: 50%;
}
.news-info-control .ui-btn-small {
    width: 48px;
}
.ui-btn-gray {
    background-color: #ededed;
    color: #999;
}
.ui-btn-small {
    height: 24px;
    line-height: 24px;
    padding: 0 6px;
}
.ui-btn, .ui-btn-small, .ui-btn-big {
    border: 0 none;
    border-radius: 3px;
    color: #fff;
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}
.news-info-form {
    display: none;
    padding-right: 110px;
    padding-top: 5px;
}
.news-info-genre {
    color: #999;
    display: block;
    position: absolute;
    right: 0;
    top: 0;
    width: 110px;
}
.news-info-time {
    color: #999;
    height: 20px;
    overflow: hidden;
}
.j-See-reply-expansion {
    color: #e93100;
    cursor: pointer;
    display: block;
    position: absolute;
    right: 230px;
    top: 0;
    width: 50px;
}
.news-info-hover .j-See-reply-show {
    display: block;
    width: 58%;
}
.fn-text-overflow {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.fn-linear {
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #fcfcfc, #f1f1f1) repeat scroll 0 0;
}
.fn-linear-light {
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #fcfcfc, #f9f9f9) repeat scroll 0 0;
}
input {
    position: relative;
}
.vip-progress {
    margin: 0 auto;
    position: relative;
}
.news-info-hover .news-info-type {
    left: -101px;
    position: absolute;
    top: 36px;
}
.news-info-hover .j-hover {
    background: #f8f8f8 none repeat scroll 0 0;
}
.news-info-hover .news-info-wrap {
    width: 588px;
}
.news-info-hover .news-info-message {
    width: 440px;
}
.ui-btn-gray {
    background-color: #ededed;
    color: #999;
}
a.ui-btn-gray:hover {
    background-color: #d8d8d8;
    color: #666;
}
a:hover {
    color: #f60;
    text-decoration: underline;
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
            <?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'10','分类'=>'1','排序'=>'addtime:desc','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$notice_list);?>
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

<div class="user_head link_white" id="header">
<style>
.insidebox span a:hover{text-decoration: none;}
.insidebox span img{position: absolute;top: 2px;}
</style>
 <div class="insidebox">
 	<div class="logobox"><a href="/"><img src="<?php if(C('qscms_logo_user')): echo attach(C('qscms_logo_user'),'resource'); else: ?>__HOMEPUBLIC__/images/logo_user.png<?php endif; ?>"    border="0"/></a></div>
<style type="text/css">
.member_select{margin-left:50px;line-height:85px;height:85px;font-size:30px;color:#fff;position: relative;}
</style>
<?php if($visitor['utype'] == 2): ?><span class="member_select"><a href="<?php echo U('home/fund/fund_list');?>">找资金</a>
 <?php else: ?>
<span class="member_select"><a href="<?php echo U('home/item/item_list');?>">找项目</a><?php endif; ?>
<img src="__HOMEPUBLIC__/images/hot.gif">
 	</span>
	<div class="clear"></div>
	 
 </div>
</div>
<script type="text/javascript">
	$('#ajax_search_location').submit(function(){
		var nowKeyValue = $.trim($('input[name="key"]').val());
		var post_data = $('#ajax_search_location').serialize();
		if(qscms.keyUrlencode==1){
			post_data = encodeURI(post_data);
		}
		$.post($('#ajax_search_location').attr('action'),post_data,function(result){
			window.location.href=result.data;
		},'json');
		return false;
	});
</script>
<div class="user_main">
<link href="../public/css/personal/nav.css" rel="stylesheet" type="text/css" />
<script>
$('.part-top-allnav-list li:last').remove();
function ajax_login_log(){
    $.getJSON("<?php echo U('Personal/ajax_login_log');?>", {}, function(data){
    if(data.data==0){
        var qsDialog = $(this).dialog({
                title: '修改密码',
                loading: true,
                showFooter: false,
                close:true,
                yes: function() {
                    var options = {};
                    options['oldpassword'] = $('#J_passwordWrap').find('input[name="oldpassword"]').val();
                    options['password'] = $('#J_passwordWrap').find('input[name="password"]').val();
                    options['password1'] = $('#J_passwordWrap').find('input[name="password1"]').val();
                    $.post("/index.php?m=&c=members&a=save_password",options,function(r){
                        if(r.status == 1){
                            disapperTooltip('success',r.msg);
                            qsDialog.hide();
                        }else{
                            disapperTooltip("remind", r.msg);
                        }
                    },'json');
                }
            });
            $.getJSON("/index.php?m=&c=members&a=save_password",function(result){
                if(result.status == 1){
                    qsDialog.setCloseDialog(false);
                    qsDialog.setContent(result.data.html);
                    qsDialog.showFooter(true);
                }else{
                    qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                }
            });

    }
});
}
</script>
<div class="leftnav">
<div class="subnav">
<h2 class="subnav-header"><i class="icon-subnav-manage"></i>账户信息<i class="icon-subnav-arrow"></i></h2>
<nav class="subnav-wrap">
<dl class="subnav-group" style="margin-top: 0px;">
<dt class="subnav-title"><i class="icon-subnav-line"></i><i class="icon-subnav-info"></i>信息管理</dt>
<dd class="subnav-item subnav-item-first <?php if($personal_nav == 'publish'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('Personal/publish');?>"><i class="icon-nav-dot"></i>发布信息</a></dd>
<dd class="subnav-item <?php if($personal_nav == 'published'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('Personal/published');?>"><i class="icon-nav-dot"></i>已发布信息
</a></dd>
<dd class="subnav-item <?php if($personal_nav == 'receive'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('Personal/receive');?>">
<i class="icon-nav-dot"></i>我的收件箱</a>
</dd>

<dd class="subnav-item <?php if($personal_nav == 'talks' || $personal_nav == 'sendlist'): ?>subnav-item-current<?php endif; ?>">
<?php if(C('visitor.utype') == 2): ?><a href="<?php echo U('Personal/talks');?>"><i class="icon-nav-dot"></i>收到的约谈
</a>
<?php else: ?>
<a href="<?php echo U('Personal/sendlist');?>"><i class="icon-nav-dot"></i>发起的约谈
</a><?php endif; ?>
</dd>

<dd class="subnav-item <?php if($personal_nav == 'dsendlist' || $personal_nav == 'dreceive'): ?>subnav-item-current<?php endif; ?>">
<?php if(C('visitor.utype') == 2): ?><a href="<?php echo U('Personal/dsendlist');?>"><i class="icon-nav-dot"></i>发起的投递</a>
<?php else: ?>
<a href="<?php echo U('Personal/dreceive');?>"><i class="icon-nav-dot"></i>收到的投递</a><?php endif; ?>
</dd>

<?php if(C('visitor.utype') == 2 && C('visitor.is_vip') == 1): ?><dd class="subnav-item subnav-item-last <?php if($personal_nav == 'funder'): ?>subnav-item-current<?php endif; ?>"><a style="color:#ff4663" href="<?php echo U('Personal/funder');?>"><i class="icon-nav-dot"></i>资金方查询</a></dd><?php endif; ?>


<dd class="subnav-item subnav-item-last <?php if($personal_nav == 'manage_rss'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('Personal/manage_rss');?>"><i class="icon-nav-dot"></i>我的收藏</a></dd>

<dd class="subnav-item subnav-item-last <?php if($personal_nav == 'draft'): ?>subnav-item-current<?php endif; ?>"><a style="color:#f00;" href="<?php echo U('Personal/draft');?>"><i class="icon-nav-dot"></i>票据业务</a></dd>

</dl>
<dl class="subnav-group">
<dt class="subnav-title"><i class="icon-subnav-line"></i><i class="icon-subnav-social"></i>人脉交流</dt>
<dd class="subnav-item subnav-item-first <?php if($personal_nav == 'my'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('BusinessCard/my');?>"><i class="icon-nav-dot"></i>商友与联系人</a></dd>
<dd class="subnav-item <?php if($personal_nav == 'who_have_seen_me'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('Visited/who_have_seen_me');?>"><i class="icon-nav-dot"></i>谁看过我
</a></dd>
<dd class="subnav-item <?php if($personal_nav == 'who_i_have_see'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('Visited/who_i_have_see');?>"><i class="icon-nav-dot"></i>我看过谁</a></dd>
<dd class="subnav-item last <?php if($personal_nav == 'myfans'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('BusinessCard/myfans');?>"><i class="icon-nav-dot"></i>收到的名片
</a></dd>
</dl>
<dl class="subnav-group">
<dt class="subnav-title">
<i class="icon-subnav-line"></i>
<i class="icon-subnav-order"></i>
会员服务
</dt>
<dd class="subnav-item subnav-item-first <?php if($personal_nav == 'order'): ?>subnav-item-current<?php endif; ?>"><a href="<?php echo U('Personal/order');?>"><i class="icon-nav-dot"></i>我的订单</a></dd>
</dl>
<dl class="subnav-group">
<dt class="subnav-title">
<i class="icon-subnav-line"></i>
<i class="icon-subnav-account"></i>账户管理</dt>
<dd class="subnav-item subnav-item-first">
<a href="<?php echo U('Company/show',array('company_id'=>C('visitor.uid')));?>" target="_blank">
<i class="icon-nav-dot"></i>我的展厅</a>
</dd>
<dd class="subnav-item <?php if($personal_nav == 'account'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('Personal/account');?>"><i class="icon-nav-dot"></i>我的资料</a>
</dd>

<dd class="subnav-item <?php if($personal_nav == 'usercert'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('UserCert/index');?>"><i class="icon-nav-dot"></i>我的认证</a></dd>

<dd class="subnav-item <?php if($personal_nav == 'lemberlevel'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('MemberLevel/index');?>"><i class="icon-nav-dot"></i>我的等级</a></dd>
<dd class="subnav-item <?php if($personal_nav == 'security'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('Personal/security');?>"><i class="icon-nav-dot"></i>账号安全</a></dd>
<dd class="subnav-item <?php if($personal_nav == 'complaints'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('Personal/complaints');?>"><i class="icon-nav-dot"></i>投诉维权</a></dd>
<dd class="subnav-item last <?php if($personal_nav == 'invitee'): ?>subnav-item-current<?php endif; ?>">
<a href="<?php echo U('Personal/invitee');?>"><i class="icon-nav-dot"></i>邀请注册</a>
</dd>
</dl>
</nav>
</div>
</div>

<div class="mainbox">
<div class="main">
<div class="ui-tab-head-box">
<div class="ui-tab-head ui-tab-head-p">
<ul>
<li class="ui-tab-head-current">
<a href="<?php echo U('Personal/receive');?>">收到的消息</a></li>
<li>
<a href="<?php echo U('Personal/sent');?>">已发送的消息</a></li>
<li>
<a href="<?php echo U('Personal/msg_pms');?>">系统消息</a></li>
<li>
<a href="<?php echo U('Personal/rss');?>">订阅信息</a></li>
</ul>
</div>
</div>
<div class="ui-tab-cont">
<div class="search-part-nav">
<form name="frmSearch" id="frmMsgSearch">
<input name="r" value="" type="hidden">
<div class="fn-left search-part-link">
<a href="#" class="search-part-link-first">全部</a>
<span>|</span>
<a href="#">未读</a>
<span>|</span>
<a href="#">按时间</a>
</div>
<div class="fn-left fn-mr-15">会员类型：<select name="u_t">
<option value="">所有会员</option>
<option value="1">企业</option>
<option value="2">政府</option>
<option value="3">个人</option>
</select>
</div>
<div class="fn-left fn-mr-15">消息类型：<select name="t">
<option value="">全部</option>
<option value="1">留言</option>
<option value="2">私信</option>
</select>
</div>
<div class="fn-left fn-pr">
<a href="javascript:void(0);" class="ui-btn-small ui-btn-blue" id="btnSearch" data-type="receive"><i class="icon-part-bg icon-part-search"></i>搜索</a>
</div>
</form>
</div>
<div class="news-info-hover fn-mt-10 j-part-hover  j-See-reply">
<div>

<?php if(!empty($msg_list['list'])): ?><ul class="news-info-list">

<!--
<li class="news-info-item">
<div class="user-avatar">
<a href="#" target="_blank">
<img src="#" alt="会员头像">
</a>
</div>
<div class="news-info-wrap">
<p class="news-info-title">
<span class="news-info-name">
<a href="#" target="_blank">郭先生</a>
</span>
<i class="icon-auth-p-16-2 fn-mr-5" title="资金"></i>
<i class="icon-auth-s-16-1 fn-mr-5" title="企业"></i>
<span><i class="userEnterprise" title="企业身份认证会员"></i></span>
</p>
<p class="news-info-message">
<span class="news-info-post">江西省南昌市某公司 总经理</span>
<span class="news-info-genre">类型：留言</span>
</p>
<p class="news-info-message">
<span class="j-See-reply-show fn-text-overflow"><em class="j-See-reply-info">张总，我对你项目有投资意向，想进一步了解，能否把项目资料发到我的邮箱，谢谢。</em></span>
<span class="j-See-reply-expansion">【展开】</span>
</p>
<p class="news-info-post">来源：会员展厅：<a href="#" target="_blank">张女士</a></p>
<p class="news-info-time"><i class="icon-info-time"></i>2017年5月3日 16:21</p>
<div class="news-info-control">
<a type="button" class="ui-btn-small ui-btn-gray j-See-reply-btn" data-id="9293573" data-reply="1">查看回复</a>
</div>
<div class="message-reply-box reply-9293573">
<form class="news-info-form" action="#">
<input name="id" value="9293573" type="hidden">
<input name="message_id" value="730613" type="hidden">
<input name="type" value="1" type="hidden">
<textarea class="message-reply" name="content" placeholder="严禁发布含有联系方式或广告性质的内容，违者一律删除！"></textarea>
<span class="left_word_tip"></span>
<br>
<a href="javascript:void(0);" class="ui-btn-small ui-btn-gray btn-replay-message" data-id="9293573">回复</a>
</form>
</div>
<div class="news-info-type"><input name="chkIds" value="730613" _type="1" type="checkbox"></div>
</div>
</li>
-->
</ul><?php endif; ?>

<div class="part-not-cont"><i class="icoPro16yellow"></i><a href="<?php echo U('Home/Fund/fund_list');?>" class="fn-vam">您还没有收到消息，马上主动出击，给资金方发消息。</a>
</div>
</div>
<footer class="table-page-part">
<?php if(!empty($msg_list['count'])): ?><div class="fn-left">
<input id="chk_delete_all" class="fn-vam fn-mr-10" type="checkbox">
<a href="javascript:void(0);" class="ui-btn-small ui-btn-blue fn-vam" id="btn_delete_all" data-url="<?php echo U('Personal/msg/del');?>">删除</a>
</div><?php endif; ?>
</footer>
</div>
</div>
</div>
</div>
<div class="floatmenu">
  <div class="item ask">
    <a class="blk" target="_blank" href="<?php echo url_rewrite('QS_suggest');?>"></a>
  </div>
  <div id="backtop" class="item backtop" style="display: none;"><a class="blk"></a></div>
</div>

<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script type="text/javascript" src="../public/js/jquery.tooltip.js"></script>
<script type="text/javascript" src="../public/js/jquery.disappear.tooltip.js"></script>
<script type="text/javascript" src="../public/js/jquery.dropdown.js"></script>

<!--[if lt IE 9]>
	<script type="text/javascript" src="../public/js/PIE.js"></script>
  <script type="text/javascript">
    (function($){
        $.pie = function(name, v){
            // 如果没有加载 PIE 则直接终止
            if (! PIE) return false;
            // 是否 jQuery 对象或者选择器名称
            var obj = typeof name == 'object' ? name : $(name);
            // 指定运行插件的 IE 浏览器版本
            var version = 9;
            // 未指定则默认使用 ie10 以下全兼容模式
            if (typeof v != 'number' && v < 9) {
                version = v;
            }
            // 可对指定的多个 jQuery 对象进行样式兼容
            if ($.browser.msie && obj.size() > 0) {
                if ($.browser.version*1 <= version*1) {
                    obj.each(function(){
                        PIE.attach(this);
                    });
                }
            }
        }
    })(jQuery);
    if ($.browser.msie) {
      $.pie('.pie_about');
    };
  </script>
<![endif]-->
<script>
    //会员中心收件,发件内容展开收缩
    var L_expansion = $(".j-See-reply-info").length;
    for(i=0;i<L_expansion;i++)
    {

        if($(".j-See-reply-info").eq(i).width() > 250)
        {
            $(".j-See-reply-info").eq(i).parent().next().removeClass("fn-hide");    
            $(".j-See-reply-info").eq(i).parent().addClass("fn-text-overflow");
        }   
    }
    $(".j-See-reply-expansion").click(function(){
        if($(this).prev().hasClass("fn-text-overflow")){
            $(this).prev().removeClass("fn-text-overflow");
            $(this).html("【收缩】");   
        }else{
            $(this).prev().addClass("fn-text-overflow");
            $(this).html("【展开】");   
        }
        
    });
</script>
</body>
</html>