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
<link href="../public/css/init.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/common.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal_index.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal_ajax_dialog.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/account.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/board.css" rel="stylesheet" type="text/css" />
<script src="../public/js/personal/jquery.common.js" type="text/javascript"></script>
<script src="../public/js/jquery.form.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript"></script>
<script src="../public/js/area.js" type="text/javascript"></script>
<script src="../public/js/multiselect.js" type="text/javascript"></script>
<style type="text/css">
.part-fieldset .part-fieldset-section {
    min-height: 44px;
}
.perfect-information {
    color: #666;
    padding: 5px 10px;
}
.perfect-information nav span {
    display: inline-block;
    text-align: right;
    width: 15px;
}
.perfect-information nav label {
    cursor: pointer;
    display: inline-block;
    margin-left: 5px;
    width: 60px;
}
.perfect-information nav input {
    margin-right: 3px;
    vertical-align: middle;
}
.part-cont-radio-a {
    background: #f6f6f6 none repeat scroll 0 0;
    border-top: 1px solid #ddd;
    padding: 40px 0;
}
.part-cont-radio-a .part-list {
    color: #666666;
    overflow: hidden;
}
.part-cont-radio-a .part-list aside {
    border-right: 1px dashed #c2c2c2;
    margin-left: 80px;
    width: 162px;
}
.part-cont-radio-a .part-list aside li {
    padding: 15px 0;
}
.part-cont-radio-a .part-list aside input {
    margin-right: 3px;
    vertical-align: middle;
}
.part-cont-radio-a .part-list table {
    height: 192px;
    margin-left: 242px;
}
.part-cont-radio-a .part-list .info {
    margin-left: 245px;
}
.part-cont-radio-a .part-list .info table {
    margin-left: 0;
}
.part-cont-radio-a .part-list table td {
    line-height: 24px;
    padding: 0 80px;
}
.preview-all {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #999;
    font-family: "微软雅黑";
    font-size: 14px;
    height: 500px;
    line-height: 30px;
    margin: 10px 0;
    overflow-y: auto;
    padding: 0 30px;
    position: relative;
}
.preview-box {
    border-top: 1px dashed #c2c2c2;
    margin-top: -1px;
    padding: 22px 0;
}
.preview-box-list {
    overflow: hidden;
}
.preview-box-list li {
    display: block;
    float: left;
    height: 30px;
    line-height: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 49%;
}
.preview-box-list li .ittext {
    margin-left: 70px;
}
.project-course li {
    height: 30px;
    line-height: 30px;
}
.project-course .small-radius {
    background: #536290 none repeat scroll 0 0;
    border-radius: 15px;
    display: inline-block;
    font-size: 0;
    height: 10px;
    left: 50%;
    margin-left: -5px;
    margin-top: -5px;
    position: absolute;
    top: 50%;
    width: 10px;
}
.project-course .br-preview {
    border-left: 1px solid #536290;
    font-size: 0;
    height: 30px;
    left: 15px;
    position: absolute;
    top: -27px;
}
.project-course .fn-pr {
    display: inline-block;
    vertical-align: middle;
    width: 30px;
}
.preview-img-all {
    margin: 22px auto 0;
    width: 800px;
}
.preview-img-box img {
    display: block;
    height: 400px;
    width: 800px;
}
.preview-img-list {
    margin: 20px auto 5px;
    position: relative;
    width: 500px;
}
.preview-img-list li {
    cursor: pointer;
    float: left;
    margin-right: 10px;
}
.preview-img-list img {
    display: block;
    height: 80px;
    width: 160px;
}
.preview-img-list .sPrev {
    background: rgba(0, 0, 0, 0) url("../../src/images/icon-arrow-big.jpg") no-repeat scroll right center;
    display: inline-block;
    height: 27px;
    left: -40px;
    position: absolute;
    top: 28px;
    width: 14px;
    z-index: 11;
}
.preview-img-list .sNext {
    background: rgba(0, 0, 0, 0) url("../../src/images/icon-arrow-big.jpg") no-repeat scroll left center;
    display: inline-block;
    height: 27px;
    left: 527px;
    position: absolute;
    top: 28px;
    width: 14px;
    z-index: 11;
}
.part-info-a-all {
    border: 1px solid #ddd;
    margin-top: 10px;
}
.part-info-a-all header {
    background: #f5f5f5 none repeat scroll 0 0;
    color: #999;
    height: 30px;
    line-height: 30px;
    overflow: hidden;
    padding: 0 10px;
}
.part-info-a-all .part-info-a-box {
    color: #666;
    padding: 20px 20px 10px;
}
.part-info-a-all .part-info-a-box footer {
    border-top: 1px dashed #ddd;
    margin-top: 10px;
    padding-top: 10px;
}
.footer-published {
    font-family: "微软雅黑";
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    margin-top: 20px;
}
.part-info-a-all .delivery-times-msg {
    left: -10px;
    top: 46px;
}
.information-form-all-a {
    margin-left: 192px;
}
.information-form-all-a nav {
    height: 30px;
}
.fieldsetMod {
    border: 1px solid #dadde9;
    margin-top: 30px;
    padding: 1px;
    position: relative;
}
.fieldsetMod h2 {
    background-color: #fff;
    display: inline;
    font: bold 12px simsun;
    left: 10px;
    padding: 5px 10px;
    position: absolute;
    top: -13px;
}
.fieldsetMod h2 .icoDot {
    background: rgba(0, 0, 0, 0) url("..public/images/user/sprite.png") no-repeat scroll -260px -60px;
    display: inline-block;
    height: 5px;
    overflow: hidden;
    position: relative;
    right: -10px;
    vertical-align: middle;
    width: 5px;
}
.fieldsetMod .fieldsetBd {
    overflow: hidden;
    padding: 20px;
}
.fieldsetMod h2 {
    background-color: #fff;
    display: inline;
    font: bold 12px simsun;
    left: 10px;
    padding: 5px 10px;
    position: absolute;
    top: -13px;
}
.fieldsetMod h2 .icoDot {
    background: rgba(0, 0, 0, 0) url("..public/images/user/sprite.png") no-repeat scroll -260px -60px;
    display: inline-block;
    height: 5px;
    overflow: hidden;
    position: relative;
    right: -10px;
    vertical-align: middle;
    width: 5px;
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
.part-fieldset .part-fieldset-msg i{
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
.part-fieldset aside {
    color: #666666;
    float: left;
    height: 30px;
    line-height: 30px;
    text-align: right;
    width: 17%;
}
.part-fieldset aside i {
    background: #f1f1f1 none repeat scroll 0 0;
    color: #999999;
    display: inline-block;
    height: 30px;
    line-height: 30px;
    margin-right: 5px;
    text-align: center;
    width: 30px;
}
.part-fieldset-min-textarea aside {
    height: 84px;
    line-height: 84px;
}
.part-fieldset-img aside {
    line-height: 80px;
}
.part-fieldset-img {
    margin-bottom: 14px;
}
.part-fieldset section {
    color: #999;
    display: inline-block;
    padding: 0;
    width: 82%;
}
.part-fieldset-wh-a .part-fieldset aside {
    width: 20%;
}
.part-fieldset-wh-a .part-fieldset section {
    width: 79%;
}
.part-fieldset-wh-b .part-fieldset aside {
    width: 21%;
}
.part-fieldset-wh-b .part-fieldset section {
    width: 78%;
}
.part-fieldset-all-c {
    border: 1px solid #ddd;
    padding: 20px;
}
.part-fieldset-all-c .part-fieldset aside {
    width: 21%;
}
.part-fieldset-all-c .part-fieldset section {
    width: 78%;
}
.part-fieldset .part-fieldset-section .uploadify {
    float: left;
    margin-right: 5px;
}
.part-fieldset .part-fieldset-section .uploadify-queue {
    margin-bottom: 0;
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
.part-fieldset {
    overflow: hidden;
}
.select-style {
    border: 1px solid #ddd;
    color: #999;
    margin-right: 5px;
    outline: medium none;
    padding: 5px 0;
}
.prompt_pass{
    color: #999;
    display: none;
    left: 5px;
    position: absolute;
    top: 5px;
}
.font-simsun {
    font-family: SimSun;
}
.part-fieldset-min-textarea section {
    min-height: 98px;
}
.part-fieldset-footer {
    margin: 40px 0;
    text-align: center;
}
.part-fieldset section {
    color: #999;
    display: inline-block;
    padding: 0;
    width: 82%;
}
.part-fieldset .part-fieldset-text {
    height: 30px;
    line-height: 30px;
    margin-bottom: 13px;
}
.prompt_pass {
    color: #999;
    display: none;
    left: 5px;
    position: absolute;
    top: 5px;
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
<form id="afrm" method="post" action="<?php echo U('Personal/account');?>" novalidate="novalidate">
<div class="perfect-information">
<div class="fn-clear ui-le-ht24"><i class="fn-left icoBul16 fn-mt-5"></i>
<div class="fn-ml-20">完善资料之后，系统将自动给您生成一张名片，名片可以和金融网会员交换。完整的基本资料是会员搜索到您的重要保证，更是让对方能够初步了解您的基础。</div>
</div>
<div class="fn-clear" style="margin-top:-24px;"><a href="/zt/wszl.html" class="ui-btn-small ui-btn-blue fn-right" target="_blank">教你完善会员资料</a></div>
<nav class="fn-mt-15">
<?php if(empty($userinfo['type'])): ?><span class="ui-text-red font-simsun">*</span>会员身份：
<em for="type">
<input name="type" id="type1" value="1" checked="" type="radio"><label for="type1">企业</label>
<input name="type" id="type2" value="3" type="radio"><label for="type2">个人</label>
<input name="type" id="type3" value="2" type="radio"><label for="type3">政府</label></em>
<span class="ui-text-red font-simsun">*</span>提交后不可更改
<?php else: ?>
会员身份：企业<?php endif; ?>                           
</nav>              
</div>

<div class="fieldsetMod">
<h2>企业资料<i class="icoDot"></i></h2>
<div class="fieldsetBd">
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>企业名称：</aside>
<section class="part-fieldset-section">
<input name="company" id="company" class="t_input" value="<?php echo ($userinfo["company"]); ?>" maxlength="50" placeholder="请输入真实名称，保存后不可修改" type="text">

</section>
</article>
<article class="part-fieldset part-fieldset-min-textarea">
<aside>企业简介：</aside>
<section>
<div>
<span class="fn-pr fn-herit">
<textarea name="introduce" class="prompt-pass-style"><?php echo ($userinfo["introduce"]); ?></textarea>
<span class="prompt_pass">公司概况+发展状况+公司文化+公司产品+企业荣誉等内容</span>
</span>
</div>

</section>
</article>
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>所属行业：</aside>
<section class="part-fieldset-section">
<span class="standard_select">
<span class="select_shelter">
<select name="industry_id" id="industry_id" class="select-w126">
<option value="">请选择所属行业</option>
<?php if(is_array($category['industry_id'])): $k = 0; $__LIST__ = $category['industry_id'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($key); ?>" <?php if($userinfo["industry_id"] == $key): ?>selected=""<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</span>
</span>
</section>
</article>
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>注册资本：</aside>
<section class="part-fieldset-section">
<span for="registered_capital">
<span class="standard_select">
<span class="select_shelter">
<select name="registered_capital" id="registered_capital" class="select-w126">
<option value="">请选择注册资本</option>
<?php if(is_array($category['registered_capital'])): $i = 0; $__LIST__ = $category['registered_capital'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($userinfo["registered_capital"] == $key): ?>selected=""<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</span>
</span>
</span>
</section>
</article>
<article class="part-fieldset ">
<aside><span class="ui-text-red font-simsun">*</span>是否有营收：</aside>
<section>

<div class="part-fieldset-label">
<label><input value="1" <?php if($userinfo['is_earnings'] == 1): ?>checked<?php endif; ?> name="is_earnings" type="radio"><span class="fn-vam">是</span></label>&nbsp;&nbsp;
<label><input value="2" id="is_earnings_not" <?php if($userinfo['is_earnings'] == 2 || $userinfo['is_earnings'] == ''): ?>checked<?php endif; ?> name="is_earnings" type="radio"><span class="fn-vam">否</span></label>&nbsp;&nbsp;
</div>

</section>
</article>
<article class="part-fieldset" id="years_revenue_area" <?php if($userinfo['is_earnings'] != 1): ?>style="display:none"<?php endif; ?>>
<aside><span class="ui-text-red font-simsun">*</span>近三年营业收入：</aside>
<section class="part-fieldset-section">
<label for="years_revenue[]">
<input class="t_input w125" placeholder="请填写2014年营业收入" name="years_revenue[]" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($userinfo['years_revenue'][0]); ?>" type="text">
<input class="t_input w125" placeholder="请填写2015年营业收入" name="years_revenue[]" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($userinfo['years_revenue'][1]); ?>" type="text">
<input class="t_input w125" placeholder="请填写2016年营业收入" name="years_revenue[]" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($userinfo['years_revenue'][2]); ?>" type="text">
<span class="standard_select">
<span class="select_shelter">
<select name="years_revenue_unit">
<option <?php if($userinfo['years_revenue_unit'] == 1 || $userinfo['years_revenue_unit'] == ''): ?>selected=""<?php endif; ?> value="1">万元</option>
<option <?php if($userinfo['years_revenue_unit'] == 2): ?>selected=""<?php endif; ?> value="2">亿元</option>
</select>
</span>
</span>
</label>
<label id="_years_revenue-error" class="ui-text-red" style="display: none;"><i class="icoErr16"></i>请填写</label>
</section>
</article>
<article class="part-fieldset" id="years_profit_area" <?php if($userinfo['is_earnings'] != 1): ?>style="display:none"<?php endif; ?>>
<aside><span class="ui-text-red font-simsun">*</span>近三年营业利润：</aside>
<section class="part-fieldset-section">
<label for="years_profit[]">
<input class="t_input w125" placeholder="请填写2014年营业利润" name="years_profit[]" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($userinfo['years_profit'][0]); ?>" type="text">
<input class="t_input w125" placeholder="请填写2015年营业利润" name="years_profit[]" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($userinfo['years_profit'][1]); ?>" type="text">
<input class="t_input w125" placeholder="请填写2016年营业利润" name="years_profit[]" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($userinfo['years_profit'][2]); ?>" type="text">
<span class="standard_select">
<span class="select_shelter">
<select name="years_profit_unit">
<option <?php if($userinfo['net_asset_unit'] == 1 || $userinfo['net_asset_unit'] == ''): ?>selected=""<?php endif; ?> value="1">万元</option>
<option <?php if($userinfo['net_asset_unit'] == 2): ?>selected=""<?php endif; ?> value="2">亿元</option>
</select>
</span>
</span>
</label>
<label id="_years_profit-error" class="ui-text-red" style="display: none;"><i class="icoErr16"></i>请填写</label>
</section>
</article>
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>当前净资产：</aside>
<section class="part-fieldset-section">
<span for="net_asset">
<input id="net_asset" name="net_asset" value="<?php echo ($userinfo["net_asset"]); ?>" class="t_input w125" placeholder="请输入企业当前净资产" type="text">
<span class="standard_select">
<span class="select_shelter">
<select name="net_asset_unit">
<option <?php if($userinfo['net_asset_unit'] == 1 || $userinfo['net_asset_unit'] == ''): ?>selected=""<?php endif; ?>value="1">万元</option>
<option <?php if($userinfo['net_asset_unit'] == 2): ?>selected=""<?php endif; ?>value="2">亿元</option>
</select>
</span>
</span>
</span>
</section>
</article>
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>注册成立日期：</aside>
<section class="part-fieldset-section">
<span for="net_asset">
<script type="text/javascript" src="../public/js/DatePicker/WdatePicker.js"></script>
<input class="t_input w70 c808080 prompt-pass-style" name="company_date" onclick="WdatePicker()" value="<?php if($userinfo['company_date'] != ''): echo date('Y-m-d',$userinfo['company_date']);?>
<?php else: ?>
<?php echo date('Y-m-d',time()); endif; ?>" type="text">请填写营业执照上成立日期
</span>
</section>
</article>

<article class="part-fieldset">
<aside>注册地址：</aside>
<section class="part-fieldset-section select-height">
<span id="divAreaSelectCompany">
</span>
<input id="company_area_id" name="company_area_id" value="<?php echo ($userinfo["company_area_id"]); ?>" type="hidden">
</section>

</article>
<article class="part-fieldset">
<aside></aside>
<section>
<span class="fn-pr fn-herit">
<input name="company_address" value="<?php echo ($userinfo["company_address"]); ?>" class="t_input prompt-pass-style" type="text">
<span class="prompt_pass">请输入详细街道地址。</span>
</span>
</section>
</article>

</div>
</div>
<div class="fieldsetMod">
<h2>联系人资料<i class="icoDot"></i></h2>
<div class="fieldsetBd">
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>姓名：</aside>
<section class="part-fieldset-text">
<span class="fn-pr fn-herit">
<input name="realname" id="contact_name" value="<?php echo ($userinfo["realname"]); ?>" class="t_input prompt-pass-style" maxlength="10" type="text">
<span class="prompt_pass">请输入真实姓名，保存后不可修改</span>
</span>
<label><input name="sex" value="0" <?php if($userinfo['sex'] == 0 || $userinfo['sex'] == ''): ?>checked<?php endif; ?>  type="radio"><span class="fn-vam">先生</span></label>
<label><input name="sex" value="1" type="radio" <?php if($userinfo['sex'] == 1): ?>checked<?php endif; ?>><span class="fn-vam">女士</span></label>
</section>
</article>
<article class="part-fieldset part-fieldset-text">
<aside>联系手机：</aside>
<section class="part-fieldset-text">
<?php echo contact_hide($userinfo['mobile'],2);?><span class="ui-text-red fn-ml-10">[已认证]</span>
</section>
</article>
<article class="part-fieldset">
<aside>职务：</aside>
<section class="part-fieldset-section">
<span class="standard_select">
<span class="select_shelter">
<select name="contact_job" id="contact_job" class="select-w100">
<option value="">请选择职务</option>
<?php if(is_array($category['contact_job']['company'])): $i = 0; $__LIST__ = $category['contact_job']['company'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($userinfo["contact_job"] == $key): ?>selected=""<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</span>
</span>
<input name="contact_job_name" id="contact_job_name" value="" maxlength="6" class="text w160 fn-hide t_input ac_input" style="display: none;" autocomplete="off" type="text">
</section>
</article>
<article class="part-fieldset">
<aside>所在部门：</aside>
<section class="part-fieldset-text">
<span class="fn-pr fn-herit">
<input name="department_name" class="t_input prompt-pass-style" value="<?php echo ($userinfo["department_name"]); ?>" type="text">
<span class="prompt_pass">请输入所在部门</span>
</span>
</section>
</article>

<article class="part-fieldset">
<aside>电话号码：</aside>
<section class="part-fieldset-section">
<input name="phone_cr" value="086" class="t_input w20" maxlength="3" type="text"><span class="fn-mr-5">-</span>
<input name="phone_qh" value="<?php echo ($userinfo["phone_qh"]); ?>" maxlength="4" class="t_input w35" type="text"><span class="fn-mr-5">-</span>
<input name="phone" value="<?php echo ($userinfo["phone"]); ?>" class="t_input w120" maxlength="8" type="text">
</section>
</article>
<article class="part-fieldset">
<aside>QQ号码：</aside>
<section class="part-fieldset-section">
<span class="fn-pr fn-herit">
<input name="qq" value="<?php echo ($userinfo["qq"]); ?>" maxlength="15" class="t_input prompt-pass-style" type="text">
<span class="prompt_pass">请输入常用的QQ号码</span>
</span>
</section>
</article>
<article class="part-fieldset">
<aside><span class="ui-text-red font-simsun">*</span>邮箱地址：</aside>
<section class="part-fieldset-section">
<?php if(empty($userinfo['email'])): ?><span class="fn-pr fn-herit">
<input class="t_input prompt-pass-style" name="email" value="" type="text">
<span class="prompt_pass">请输入常用的邮箱地址</span>
</span>
<?php else: ?>
<section class="part-fieldset-text"><?php echo ($userinfo["email"]); ?></section><?php endif; ?>
</section>
</article>
<article class="part-fieldset">
<aside>联系地址：</aside>
<section class="part-fieldset-section select-height">
<span id="divAreaSelect">
</span>
<input id="last_area_id" name="last_area_id" value="<?php echo ($userinfo["last_area_id"]); ?>" type="hidden">
</section>
</article>
<article class="part-fieldset">
<aside></aside>
<section>
<span class="fn-pr fn-herit">
<input name="reg_address" value="<?php echo ($userinfo["reg_address"]); ?>" maxlength="200" class="t_input prompt-pass-style" type="text">
<span class="prompt_pass">请输入详细街道地址</span>
</span>
</section>
</article>
</div>
</div>
<div class="part-fieldset-footer">
<a id="J-submit" class="ui-btn-big ui-btn-blue fn-mr-10 w100">保存资料</a>
<a id="J-preview-businesscard" class="ui-btn-big ui-btn-red w100">预览名片</a>
</div>
</form>
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
if(typeof($('#company_area_id').val())!="undefined"){
var multiSelect = new MultiSelect('divAreaSelectCompany','company_area_id',dataMultiArea,dataAllArea);
multiSelect.pLabels  = '省,市,县/区';
//multiSelect.pClass   = 'w70 mr5';
multiSelect.pNames  = 'province_id_com,city_id_com,area_id_com';
multiSelect.pStart  = 1;
multiSelect.init(chinese_id);
var initId = $('#company_area_id').val();
if(initId=='' || initId==0)
initId = chinese_id;
multiSelect.select(initId);
$("#divAreaSelectCompany select").each(function(){
$(this).addClass("select-style");
//$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
});
}
</script>
<script>
if(typeof($('#last_area_id').val())!="undefined"){
var multiSelect = new MultiSelect('divAreaSelect','last_area_id',dataMultiArea,dataAllArea);
multiSelect.pLabels  = '省,市,县/区';
//multiSelect.pClass   = 'w70 mr5';
multiSelect.pNames  = 'province_id,city_id,area_id';
multiSelect.pStart  = 1;
multiSelect.init(chinese_id);
var initId = $('#last_area_id').val();
if(initId=='' || initId==0)
initId = chinese_id;
multiSelect.select(initId);
$("#divAreaSelect select").each(function(){
$(this).addClass("select-style");
//$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
});
}
</script>

<script type="text/javascript">
    $('input[name="type"]').bind('click', function(){
        window.location.href='/Personal/account.html?type='+$(this).val();
    });
</script>
<!--
<script type="text/javascript" src="https://cdn.bootcss.com/jquery-validate/1.16.0/jquery.validate.js"></script>
-->
<link href="../public/css/ui-dialog.css" rel="stylesheet" type="text/css" />
<script src="../public/js/jquery.validate.js" type="text/javascript"></script>
<script src="../public/js/popup.js" type="text/javascript"></script>
<script src="../public/js/dialog-config.js" type="text/javascript"></script>
<script src="../public/js/artDialog.js" type="text/javascript"></script>
<script>
    var dialog = artDialog;
</script>
<script src="../public/js/dialog_show.js" type="text/javascript"></script>
<script src="../public/js/personal/account.js" type="text/javascript"></script>
<script type="text/javascript">
/*
var form_publish = $('#afrm');
form_publish.click(function(){
$('#afrm').attr('target','_self').attr('action',"<?php echo U('Personal/account');?>");
});
*/
</script>
</body>
</html>