<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!doctype html>
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
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<style>
    #create_project {
    color: #333;
    font-size: 14px;
    margin: 0 auto;
    padding-left: 35px;
}
#create_project .submit_error {
    bottom: 70px;
    left: 35px;
}
#create_project .form_item {
    margin-top: 30px;
}
#create_project .form_label {
    margin: 30px 0 8px;
    text-indent: -35px;
}
#create_project .serial_number {
    background-color: #2b2d2e;
    border-radius: 50%;
    color: #fff;
    display: inline-block;
    font-size: 12px;
    height: 20px;
    line-height: 20px;
    margin-right: 10px;
    text-align: center;
    text-indent: 0;
    width: 20px;
}
#create_project .star {
    color: #ee7b70;
    font-size: 18px;
}
#create_project .category_root::before, #create_project .category_root::after {
    content: "";
    display: table;
}
#create_project .category_root::after {
    clear: both;
}
#create_project .category_root li {
    border: 1px solid #dce0e0;
    color: #999;
    cursor: pointer;
    float: left;
    font-size: 14px;
    height: 60px;
    line-height: 60px;
    margin-left: 20px;
    text-align: center;
    width: 119px;
}
#create_project .category_root li.active {
    background-color: #5F8DC9;
    border-color: #5F8DC9;
    color: #fff;
}
#create_project .category_root li:first-child {
    margin-left: 0;
}
#create_project .invalid .form_input, #create_project .invalid .form_input.active {
    border-color: #ed7266;
}
#create_project .form_input {
    background-clip: padding-box;
    border: 1px solid #dce0e0;
    border-radius: 3px;
    box-sizing: border-box;
    font-size: 14px;
    height: 52px;
    line-height: 30px;
    padding: 10px 16px;
    width: 100%;
}
#create_project .form_input.active {
    border-color: #3dca99;
}
#create_project .form_input .tips {
    color: #999;
}
#create_project .form_selected {
    cursor: pointer;
    height: auto;
    min-height: 52px;
    padding-right: 36px;
    position: relative;
}
#create_project .form_selected .arrow {
    border-color: #7d7d7d transparent transparent;
    border-style: solid;
    border-width: 6px;
    display: block;
    height: 0;
    position: absolute;
    right: 16px;
    top: 22px;
    width: 0;
}
#create_project .form_selected.active .arrow {
    border-color: transparent transparent #7d7d7d;
    top: 16px;
}
#create_project .form_selected .result {
}
#create_project .form_selected .result::before, #create_project .form_selected .result::after {
    content: "";
    display: table;
}
#create_project .form_selected .result::after {
    clear: both;
}
#create_project .form_selected .result span {
    background-clip: padding-box;
    background-color: #f0f2f5;
    border-radius: 13px;
    cursor: text;
    display: block;
    float: left;
    height: 26px;
    line-height: 26px;
    margin-bottom: 6px;
    margin-right: 8px;
    padding: 0 10px;
}
#create_project .form_selected .result i {
    color: #000;
    cursor: pointer;
    display: inline-block;
    font-size: 12px;
    margin-left: 9px;
    opacity: 0.3;
    position: relative;
    top: 1px;
}
#create_project #technique_list .form_selected {
    padding-bottom: 4px;
}
#create_project .slide_down {
    background-clip: padding-box;
    background-color: #fff;
    border: 1px solid #dce0e0;
    border-radius: 3px;
    box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.08);
    box-sizing: border-box;
    cursor: pointer;
    margin-top: 2px;
    position: absolute;
    width: 545px;
    z-index: 2;
}
#create_project #category_sub .slide_down {
    max-height: 290px;
    overflow-y: scroll;
}
#create_project .category_sub li {
    line-height: 36px;
    padding: 0 16px;
}
#create_project .category_sub li:hover {
    background-color: #f5f6f8;
}
#create_project .technique_list {
    padding: 0 0 20px 38px;
}
#create_project .technique_list li {
    float: left;
    margin-right: 50px;
    margin-top: 20px;
}
#create_project .technique_list li.active .icons {
    background-color: #3dca99;
    border: 0 none;
    color: #fff;
    font-size: 8px;
    line-height: 14px;
    text-align: center;
    text-indent: 2px;
}
#create_project .technique_list li.tips {
    color: #999;
    float: none;
}
#create_project .technique_list .icons {
    background-clip: padding-box;
    border: 1px solid #dce0e0;
    border-radius: 2px;
    box-sizing: border-box;
    display: inline-block;
    height: 14px;
    margin-right: 8px;
    vertical-align: middle;
    width: 14px;
}
#create_project textarea.form_input {
    height: 184px;
    line-height: 20px;
    resize: none;
}
#create_project .form_desc {
    position: relative;
}
#create_project .form_desc p.error {
    margin-top: 0;
}
#create_project .form_desc .tips {
    box-sizing: border-box;
    color: #999;
    font-size: 12px;
    left: 0;
    line-height: 26px;
    padding: 10px 16px;
    pointer-events: none;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1;
}
#create_project .form_desc .tips span {
    font-size: 14px;
    margin-bottom: 10px;
}
#create_project .show_template {
    color: #999;
    cursor: pointer;
    float: right;
    text-decoration: underline;
}
#create_project .show_template:hover {
    color: #3dca99;
}
#create_project .desc_template {
    cursor: text;
    margin-top: -2px;
    padding: 16px 16px 24px;
}
#create_project .desc_template .down_tips {
    background: rgba(0, 0, 0, 0) url("/parttime-jobs/static/project/modules/common/img/down-tips_ced744f.png") no-repeat scroll 0 0;
    height: 7px;
    position: absolute;
    right: 18px;
    top: -7px;
    width: 16px;
}
#create_project .desc_template h4 {
    font-size: 14px;
}
#create_project .desc_template h4 i {
    background-color: #5F8DC9;
    display: inline-block;
    height: 13px;
    margin: -3px 8px 0 0;
    vertical-align: middle;
    width: 4px;
}
#create_project .desc_template p {
    line-height: 22px;
}
#create_project .liked {
    padding-top: 6px;
}
#create_project .liked::before, #create_project .liked::after {
    content: "";
    display: table;
}
#create_project .liked::after {
    clear: both;
}
#create_project .liked li {
    cursor: pointer;
    float: left;
    margin-right: 80px;
}
#create_project .liked li i {
    background-clip: padding-box;
    border: 1px solid #dce0e0;
    border-radius: 50%;
    box-sizing: border-box;
    display: inline-block;
    height: 20px;
    margin-right: 10px;
    margin-top: -2px;
    vertical-align: middle;
    width: 20px;
}
#create_project .liked li.active i {
    border: 6px solid #5F8DC9;
}
#create_project .create_btn {
    background-clip: padding-box;
    background-color: #5F8DC9;
    border: 0 none;
    border-radius: 24px;
    color: #fff;
    cursor: pointer;
    display: block;
    font-size: 18px;
    height: 46px;
    line-height: 46px;
    margin: 104px auto 0;
    text-align: center;
    width: 212px;
}
.dn {
    display: none;
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
<h1 style="text-align:center;margin-top: 30px;">选择项目方还是资金方</h1>
<div id="create_project">
    <div id="category_root" class="form_item">
        <ul class="category_root">
            <li class="j-hover-all active" rel="2">项目方</li>
            <li class="j-hover-all" rel="1">资金方</li>
        </ul>
        <input id="utype" value="2" type="hidden">
    </div>

<!--
    <div id="category_sub" class="form_item valid touched dirty modified">
        <div class="form_label"><i class="serial_number">2</i> 选择项目的二级类型<i class="star">*</i></div>
        <div class="form_selected form_input">
            <div class="result">
                <b style="">H5开发</b>
                <b style="display: none;">请选择二级类型</b>
            </div>
            <i class="arrow"></i>
        </div>
        <ul class="slide_down category_sub dn">
            <li>小程序开发</li><li>前端开发</li><li>微信开发</li><li class="active">H5开发</li><li>后端开发</li><li>APP开发</li><li>Web网站开发</li><li>项目经理</li><li>其他开发</li>
        </ul>
        <input id="secondType" value="H5开发" type="hidden">
    </div>

    
    <div id="technique_list" class="form_item valid pristine touched">
        <div class="form_label"><i class="serial_number">3</i> 选择所需技能</div>
        <div class="form_selected form_input">
            <div class="result tips">
                <b>请选择所需技能</b>
                
            </div>
            <i class="arrow"></i>
        </div>
        <ul class="slide_down technique_list dn">
            
            
            <li><i class="icons"></i>HTML5</li><li><i class="icons"></i>Grunt.js</li><li><i class="icons"></i>ReactNative</li><li><i class="icons"></i>React</li><li><i class="icons"></i>AngularJS</li><li><i class="icons"></i>Bootstrap</li><li><i class="icons"></i>NodeJS</li><li><i class="icons"></i>jQuery</li><li><i class="icons"></i>JavaScript</li><li><i class="icons"></i>CSS3</li><li><i class="icons"></i>Gulp</li>
        </ul>
        <input value="" type="hidden">
        
        
    </div>

    
    <div class="form_item valid untouched pristine">
        <div class="form_label"><i class="serial_number">4</i> 项目名称<i class="star">*</i></div>
        <input id="projectName" class="form_input" placeholder="输入项目名称，如：电商web网站设计" type="text">
        

    </div>

    
    <div class="form_item valid untouched pristine">
        <div class="form_label"><i class="serial_number">5</i> 项目描述<i class="star">*</i><span class="show_template">查看范例</span></div>
        <div class="slide_down desc_template dn">
            <span class="down_tips"></span>
            <h4><i></i>一、项目描述：</h4>
            <p>直播产品的手机App开发，包括iOS和Android两端，电视节目的同品牌产品，延伸到手机屏幕，为主播们开拓第二个活动现场，为用户简历更多元的观看互动方式。主播门可以开始直播，用户观看及互动，支持在线购买商品，完成闭环支付。</p>
            <h4><i></i>二、主要功能点：</h4>
            <p>直播预告功能、启动直播、参与直播、商品列表、支付功能、消息通知与推送、登录注册</p>
            <h4><i></i>三、可参考产品：</h4>
            <p>咸鱼直播： www.xianyu.com <br>拉勾博客：www.lagou.com</p>
            <h4><i></i>四、人员要求：</h4>
            <p>1、有直播App产品的开发经验；<br>2、精通Java或PHP，熟悉jQuery、Javascript、Maven、Redis等技术，熟练使用MySQL等关系型数据库等；<br>3、良好的沟通能力和契约精神。</p>
        </div>
        <div class="form_desc">
            <textarea id="projectDesc" class="form_input"></textarea>
            <div class="tips">
                <span>详细描述你的项目需求以及对人员的期望，让专家更全面的了解你想要什么。</span><br>
                一、项目描述：<br>
                二、主要功能点：<br>
                三、可参考产品：<br>
                四、人员要求
            </div>
            
        </div>
    </div>

    
    <div id="project_price" class="form_item valid untouched pristine">
        <div class="form_label"><i class="serial_number">6</i> 价格预算<i class="star">*</i></div>
        <div class="form_selected form_input">
            <div class="result tips">
                <b style="display: none;"></b>
                <b>请选择项目的价格预算区间</b>
            </div>
            <i class="arrow"></i>
        </div>
        <ul class="slide_down category_sub dn">
            <li>3000元以下</li><li>3000-5000元</li><li>5000-10000元</li><li>10000-20000元</li><li>20000-30000元</li><li>30000-50000元</li><li>50000元以上</li>
        </ul>
        <input id="projectPrice" value="" type="hidden">

    </div>

    
    <div id="project_times" class="form_item valid untouched pristine">
        <div class="form_label"><i class="serial_number">7</i> 项目周期<i class="star">*</i></div>
        <div class="form_selected form_input">
            <div class="result tips">
                <b style="display: none;"></b>
                <b>请选择项目的时间周期</b>
            </div>
            <i class="arrow"></i>
        </div>
        <ul class="slide_down category_sub dn">
            <li>小于1周</li><li>1-2周</li><li>2-4周</li><li>1-3个月</li><li>3个月以上</li>
        </ul>
        <input id="projectCycle" value="" type="hidden">

    </div>

   
    <div class="form_item valid untouched pristine">
        <div class="form_label"><i class="serial_number">8</i> 公司名称</div>
        <input id="companyName" class="form_input" placeholder="输入你的公司名称" type="text">
        

    </div>

    
    <div id="prefer" class="form_item">
        <div class="form_label"><i class="serial_number">9</i> 倾向让谁完成项目<i class="star">*</i></div>
        <ul class="liked">
            <li class="active"><i></i>没有倾向</li><li><i></i>个人</li><li><i></i>团队 / 工作室</li>
        </ul>
        <input id="teamRequire" value="没有倾向" type="hidden">
    </div>
    -->
    <p class="error submit_error"></p>
    <input class="create_btn" value="选择" type="button">
</div>
</div>
<script type="text/javascript" src="../public/js/jquery.tooltip.js"></script>
<script type="text/javascript" src="../public/js/jquery.disappear.tooltip.js"></script>
<script type="text/javascript">
$(".category_root li").click(function(){
var val = $(this).attr("rel");
$('#utype').val(val);
var idx=$(".category_root li").index(this);
$(this).addClass("active").siblings().removeClass("active");
});

$(".create_btn").live("click",function(){
    var utype_val = $('#utype').val();
    $.ajax({
            url: '/Personal/member_init',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: {utype: utype_val},
            success: function(result) {
                disapperTooltip('success',result.msg);
                setTimeout(function () {
                        window.location = "/Personal/index";
                    }, 2000);
            }
    });
});
</script>
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
</body>
</html>