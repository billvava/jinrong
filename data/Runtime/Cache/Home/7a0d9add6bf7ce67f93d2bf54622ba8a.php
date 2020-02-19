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
<link href="../public/css/personal/board.css" rel="stylesheet" type="text/css" />
<link href="../public/css/box.css" rel="stylesheet" type="text/css" />
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<style>
th, td{
    margin: 0;
    padding: 0;
}
.select_shelter select {
    border: 0 none;
    color: #999;
}
.select_shelter select:focus {
    outline: 0 none;
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
.select_shelter select:focus {
    outline: 0 none;
}
address, caption, cite, code, dfn, em, i, th, var {
    font-style: normal;
    font-weight: 500;
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
caption, th {
    text-align: left;
}
.part-search-nav-a th {
    text-align: right;
}
.part-search-nav-a .fn-tac {
    padding-right: 5px;
    text-align: center;
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
table {
    border-collapse: collapse;
    border-spacing: 0;
}
th {
    text-align: inherit;
}
.part-not-cont {
    padding-top: 50px;
    text-align: center;
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
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
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
}
.part-search-nav-a th, .part-search-nav-a td {
    padding-bottom: 10px;
}
.part-search-cont-a table {
    color: #666;
    margin-top: 10px;
    width: 100%;
}
.part-not-cont span, .part-not-cont a {
    color: #e93100;
}
.ui-btn-small {
    height: 24px;
    line-height: 24px;
    padding: 0 6px;
}
.w60 {
    width: 60px !important;
}
.view-project-list ul {
    overflow: hidden;
    width: 850px;
}
.view-project-list li {
    border-top: 1px dotted #c2c2c2;
    float: left;
    margin-top: -1px;
    padding: 10px 10px 10px 0;
    position: relative;
    width: 259px;
}
.view-project-list ul {
    overflow: hidden;
    width: 850px;
}
.view-project-box {
    border: 1px solid #dddddd;
    border-radius: 5px;
    color: #666;
}
.view-project-list li .ittext-all {
    border-bottom: 1px dashed #ddd;
    overflow: hidden;
    padding-bottom: 15px;
}
.view-project-list li .view-project-bd {
    padding: 10px;
    position: relative;
}
.view-project-list li .ittext-all .fn-left {
    border: 1px solid #ddd;
}
.view-project-list li .ittext-all .fn-left img {
    display: block;
    height: 60px;
    width: 60px;
}
.view-project-list li .ittext-all .ittext-box {
    margin-left: 72px;
}
.view-project-list li h6 a {
    color: #536290;
    display: block;
    font-weight: bold;
    height: 36px;
    padding: 4px 0 2px;
}
.view-project-list li .ittext span {
    color: #333;
}
.view-project-list .view-project-hover .icon-project-close {
    display: block;
}
.view-project-list li .icon-project-close {
    display: none;
    position: absolute;
}
.icon-project-close:hover {
    opacity: 0.5;
}
.view-project-list li .view-project-bd .icon-project-close {
    right: 0;
    top: 3px;
}
.view-project-list li .view-project-fd {
    background: #f5f5f5 none repeat scroll 0 0;
    border-radius: 0 0 5px 5px;
    border-top: 1px solid #ddd;
    overflow: hidden;
    padding: 10px;
}
.view-project-list-s li .ittext-all {
    height: 78px;
    overflow: hidden;
}
.view-project-list-s li .ittext-all p {
    height: 40px;
    overflow: hidden;
}
.view-more-part a {
    background: #e3eaff none repeat scroll 0 0;
    border-radius: 5px;
    color: #3b4a82;
    display: block;
    font-size: 14px;
    height: 30px;
    padding-top: 10px;
    text-align: center;
    width: 100%;
}
.view-more-part a i {
    background: rgba(0, 0, 0, 0) url("../public/images/icon.png") no-repeat scroll -25px -105px;
    display: inline-block;
    font-size: 0;
    height: 12px;
    margin-left: 5px;
    vertical-align: middle;
    width: 9px;
}
.fn-mr-5 {
    margin-right: 5px;
}
.fn-pt-10 {
    padding-top: 10px;
}
.fn-tac {
    text-align: center;
}
.view-project-list-s li .ittext-all p {
    height: 40px;
    overflow: hidden;
}
h1, h2, h3, h4, h5, h6 {
    font-size: 100%;
    font-weight: 500;
}
.fn-mr-15 {
    margin-right: 15px;
}
body, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td, hr, button, article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
    margin: 0;
    padding: 0;
}
.view-project-list-s li .ittext-all p {
    height: 40px;
    overflow: hidden;
}
.ui-btn-orange {
    background-color: #f60;
}
.icon-project-close {
    background-position: -2px -102px;
    height: 16px;
    text-indent: -1000em;
    width: 16px;
}
.icon-subnav-manage, .icon-subnav-arrow, .icon-subnav-info, .icon-subnav-social, .icon-subnav-order, .icon-subnav-account, .i-tips-info, .i-tips-info-amount, .icon-notice, .icon-user-phone, .icon-user-face, .icon-user-email, .icon-user-post, .icon-user-org, .icon-user-firm, .icon-user-honor, .icon-user-phone-gray, .icon-user-face-gray, .icon-user-email-gray, .icon-user-post-gray, .icon-user-org-gray, .icon-user-firm-gray, .icon-user-honor-gray, .icon-info-deliver, .icon-info-guestbook, .icon-info-private, .icon-info-message, .icon-info-time, .icon-question-mark, .toolbar-info-nav i, .icon-part-bg {
    background-image: url("../public/images/icon.png");
    background-repeat: no-repeat;
}
.view-more-part a {
    background: #e3eaff none repeat scroll 0 0;
    border-radius: 5px;
    color: #3b4a82;
    display: block;
    font-size: 14px;
    height: 30px;
    padding-top: 10px;
    text-align: center;
    width: 100%;
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
<header class="part-fieldset part-search-nav-a">
<form method="?" name="frm">
<table width="100%">
<tbody><tr>
<th>发起人：</th>
<td><input class="t_input" name="uname" value="" type="text"></td>
<th width="120">发起时间：</th>
<script type="text/javascript" src="../public/js/DatePicker/WdatePicker.js"></script>
<td width="137"><span class="part-fieldset-time fn-pr"><i class="icon-part-bg icon-part-calendar"></i><input class="t_input w100" onfocus="WdatePicker()" value="" name="start" type="text"></span></td>
<th class="fn-tac" width="40">到</th>
<td width="137"><span class="part-fieldset-time fn-pr"><i class="icon-part-bg icon-part-calendar"></i><input class="t_input w100" onfocus="WdatePicker()" value="" name="end" type="text"></span></td>

</tr>
<tr>
<th>处理状态：</th>
<td>
<span class="standard_select">
<span class="select_shelter">
<select class="select-w264" name="invite_status">
<option value="">全部</option>
<option value="0">等待约谈</option>
<option value="1">约谈成功</option>
<option value="2">约谈中</option>
<option value="3">拒绝约谈</option>
</select>
</span>
</span>
</td>
<th>评价：</th>
<td>
<span class="standard_select">
<span class="select_shelter">
<select class="select-w126" name="evaluate">
<option value="">全部</option>
<option value="Y">满意</option>
<option value="N">不满意</option>
</select>
</span>
</span>
</td>
</tr>
<tr>
<th></th>
<td><a href="javascript:document.frm.submit()" class="ui-btn-small ui-btn-blue w60">搜&nbsp;&nbsp;索</a></td>
</tr>
</tbody></table>
</form>
</header>

<!--
<div class="part-not-cont">
<i class="icoPro16yellow"></i><a href="/index.php?m=home&c=fund&a=fund_list" class="fn-vam">您还没有收到任何资金方的约谈，马上主动出击，立即投递资金方。</a></div>
-->
<div class="view-project-list view-project-list-s">
<input id="unshow_project" name="unshow_project" value="0" type="hidden">
<ul id="itemList">
<?php if(C('visitor.utype') == 2): if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
<div class="view-project-box">
<div class="view-project-bd">
<div class="ittext-all">
<h6><a href="<?php echo U('Fund/show',array('id'=>$vo['info']['id']));?>" target="_blank" title="<?php echo ($vo["info"]["title"]); ?>"><?php echo ($vo["info"]["title"]); ?></a></h6>
<!--
<p>山东 债权融资  电器&nbsp;</p>
-->
</div>
<p class="ittext fn-pt-10 fn-tac">浏览：<span class="fn-mr-15"><?php echo ($vo["info"]["click"]); ?>次</span>约谈：<span><?php echo ($vo["times"]); ?>次</span></p>
<a href="javascript:;" class="icon-part-bg icon-part-bg icon-project-close" _val="563612">关闭</a>
</div>
<div class="view-project-fd">
<a href="javascript:;" data-title="<?php echo U('Fund/show',array('id'=>$vo['info']['id']));?>" data-zjxm-id="563612" data-user-id="<?php echo ($vo['info']['uid']); ?>" class="ui-btn-small ui-btn-orange fn-right btn_dl_invite">&nbsp;约谈&nbsp;</a>
<a href="<?php echo U('Fund/show',array('id'=>$vo['info']['id']));?>" target="_blank" class="ui-btn-small ui-btn-blue fn-mr-5 fn-left">查看详情</a><a href="<?php echo U('Fund/show',array('id'=>$vo['info']['id']));?>#i-zjxm-comment" target="_blank" class="ui-btn-small ui-btn-blue fn-left">留言</a>
</div>
</div>
</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</ul>
<div id="egItem" style="display:none">
<div class="view-project-box">
<div class="view-project-bd">
<div class="ittext-all">
<h6><a href="/detail_{{item_id}}.html" target="_blank" title="{{item_title}}">{{item_title}}</a></h6>
<p>{{i_keywords}}&nbsp;</p>

</div>
<p class="ittext fn-pt-10 fn-tac">浏览：<span class="fn-mr-15">{{view_num}}次</span>约谈：<span>{{item_be_invite_num}}次</span></p>
<a href="javascript:;" class="icon-part-bg icon-part-bg icon-project-close" _val="{{item_id}}">关闭</a>
</div>
<div class="view-project-fd"><a href="javascript:;" class="ui-btn-small ui-btn-red fn-right" data-title="{{item_title}}" data-zjxm-id="{{item_id}}" {{item_show}}="" data-user-id="{{item_user_id}}">&nbsp;约谈&nbsp;</a><a href="/detail_{{item_id}}.html" target="_blank" class="ui-btn-small ui-btn-blue fn-mr-5 fn-left">查看详情</a><a href="/detail_{{item_id}}.html#TA-COMMENT" target="_blank" class="ui-btn-small ui-btn-blue fn-left">留言</a></div>
</div>
</div>
</div>
</div>


<!--
<div class="view-more-part fn-mb-10"><a href="javascript:void(0)" class="moreList">查看更多<i></i></a></div>
-->

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
<script type="text/javascript" src="../public/js/layer/layer.js"></script>
<script>
dialog = function (title,msg){
            layer.open({
                type: 1,
                title: '约谈资金方' || '温馨提示',
                skin: 'layui-layer-rim',
                area: ['520px','173px'],
                //move:false,
                content: '<form class="layerContent fn-tac ui-dialog-body popup-msg">' +
                '<p class="part-popup-ittext">'+msg+'</p>'+
                '<footer class="fn-mt-30"><a href="javascript:;" id="dialog_close" class="ui-btn ui-btn-orange layui-layer-close">确定</a></footer>'+
                '</form>'
            });
        }

$('a.btn_dl_invite').click(function(){
        var user_id = parseInt($(this).attr('data-user-id'));
        var zjxm_id = $(this).attr('data-zjxm-id') || 0;
        var title = $(this).attr('data-title') || '';
        $.ajax({
                url: "<?php echo U('Personal/talks');?>",
                type: "post",
                dataType: "json",
                data:{
                user_id: user_id,
                zjxm_id: zjxm_id,
                title: title,
                },
                success: function (result){
                    if(result.code==1){
                        dialog('',result.msg);
                    }else{
                      dialog('',result.msg);
                    }
                }
        });
}).removeClass('J_btn_dl_invite');
</script>
</body>
</html>