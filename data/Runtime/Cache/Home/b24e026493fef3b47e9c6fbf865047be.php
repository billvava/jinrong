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
<link href="../public/css/member_level.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal.css" rel="stylesheet" type="text/css" />
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<style>
.table-part-all .table-hover td {
    background: #f1f1f1 none repeat scroll 0 0;
}
.userinfo {
    background: #f1f1f1 none repeat scroll 0 0;
    border: 1px solid #ddd;
    height: 150px;
    overflow: hidden;
}
.member-information {
    overflow: hidden;
    position: relative;
    z-index: 11;
}
.member-information .userinfo {
    width: 550px;
}
.vip-progress {
    margin: 0 auto;
    position: relative;
}
.vip-progress.vip-left {
    margin: 0;
}
.vip-progress .vip-progress-font {
    color: #fff;
    left: 0;
    line-height: 12px;
    position: absolute;
    top: 0;
}
.vip-progress-pillar {
    background-position: left top;
    color: #fff;
    line-height: 12px;
    margin: 0;
    text-indent: 3px;
    vertical-align: top;
}
.vip-level-info-text {
    color: #666;
    font-size: 14px;
    padding: 8px 0;
    text-align: center;
}
.vip-level-info .ui-btn-big {
    width: 188px;
}
.vip-progress-small, .vip-progress-pillar-small {
    background: rgba(0, 0, 0, 0) url("../../images/member/progress-bg.png") no-repeat scroll 0 -41px;
    display: inline-block;
    height: 12px;
    overflow: hidden;
    vertical-align: middle;
    width: 50px;
}
.vip-progress-pillar-small {
    background-position: 0 -29px;
    margin: 0;
    vertical-align: top;
}
.user-level {
    border: 1px solid #ddd;
    margin-top: 15px;
}
.user-level-box {
    border-top: 1px solid #ddd;
    margin-top: -1px;
    padding: 10px;
}
.user-level-box h6 {
    background: #e9e9e9 none repeat scroll 0 0;
    color: #666;
    height: 26px;
    line-height: 26px;
    padding-left: 10px;
}
.user-level-cont p {
    color: #666;
    line-height: 24px;
    padding: 5px 10px;
}
.user-level-cont .level-pic-box {
    overflow: hidden;
    padding: 10px 0 20px 26px;
    width: 720px;
}
.user-level-cont .level-pic-box figure {
    float: left;
    margin-right: 48px;
    position: relative;
    text-align: center;
    width: 80px;
}
.user-level-cont .level-pic-box article {
    height: 59px;
    overflow: hidden;
}
.user-level-cont .level-pic-box figcaption {
    font-size: 14px;
    margin-top: 5px;
}
.user-level-cont .level-pic-box div {
    border-bottom: 1px solid #bdbdbd;
    left: 80px;
    position: absolute;
    top: 30px;
    width: 48px;
}
.user-level-cont .level-pic-box .fn-mr-0 {
    margin-right: 0;
}
.user-level-box .table-part-all {
    margin: 15px 10px;
}
.user-level-box table {
    color: #666;
}
.user-level-box table th {
    font-weight: bold;
}
.user-level-cont .level-pic-box figure {
    float: left;
    margin-right: 48px;
    position: relative;
    text-align: center;
    width: 80px;
}
.part-head-all-a {
    background: #f6f6f6 none repeat scroll 0 0;
    overflow: hidden;
    padding-right: 10px;
    position: relative;
}
.part-head-all-a h4 {
    border-bottom: 2px solid #2d395f;
    font-size: 14px;
    font-weight: bold;
    line-height: 28px;
    padding: 0 10px;
    position: relative;
}
.part-head-all-a nav li {
    float: left;
    margin: 5px 0 0 5px;
}
.part-head-all-a nav li a {
    background: #e9e9e9 none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    color: #666;
    display: inline-block;
    height: 24px;
    line-height: 24px;
    padding: 0 15px;
}
.part-head-all-a nav li a:hover {
    text-decoration: none;
}
.part-head-all-a nav .ui-tab-head-current a {
    background: #536290 none repeat scroll 0 0;
    color: #fff;
}
.portrait {
    background-color: #f5f5f5;
    border-right: 1px solid #eee;
    float: left;
    height: 150px;
    position: relative;
    width: 110px;
}
.portrait-pic {
    display: block;
    height: 100px;
    overflow: hidden;
    padding: 10px 5px;
    width: 100px;
}
.portrait-edit {
    color: #666;
    display: block;
    text-align: center;
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
<div class="userinfo fn-clear">
<div class="portrait">
<span class="portrait-pic">
<img id="user_head" src="<?php echo ($visitor['avatars']); ?>?<?php echo time();?>" alt="用户头像" width="100" height="100">
</span>
<span id="edit_user_head_span">
<a href="<?php echo U('personal/user_avatar');?>" id="edit_user_head" class="portrait-edit">修改头像</a>
</span>
<i class="icon-portrait-arrow-a"></i>
<i class="icon-portrait-arrow-b"></i>
</div>
<div class="baseinfo baseinfo-w">
<div class="username">欢迎您，<span class="username-nick"><?php echo ($user_info["realname"]); ?><i class="icoLv16_" title=""></i></span><span class="login-time">最近登录时间: <?php echo date('Y-m-d h:s:i',$user_info['last_login_time']);?></span></div>

<div class="fn-font-14 fn-mt-20">
<h5><span class="fn-vam">会员等级：</span><strong class="ui-text-red fn-vam">注册会员</strong></h5>
<div class="vip-progress vip-left fn-mt-10">
<span class="vip-progress-font">1250/1500</span>
<i class="vip-progress-pillar" style="width: 83.33%"></i>
</div>

<p class="fn-mt-10">
差250成长值升级为青铜勋章</p>
</div>
</div>
</div>
<div class="user-level">
<header class="part-head-all-a">
<h4 class="fn-left">会员介绍</h4>
<nav class="fn-right">
<ul>
<li class="ui-tab-head-current"><a href="javascript:void(0)">会员介绍</a></li>
<li><a href="<?php echo U('MemberLevel/growth');?>">成长值</a></li>
<li><a href="<?php echo U('MemberLevel/growth_record');?>">成长值记录</a></li>
</ul>
</nav>
</header>
<div class="user-level-box">
<div class="user-level-cont">
<h6><strong>会员说明</strong></h6>
<p>1、金融网的会员级别共分为6个等级，分别为：注册会员、青铜勋章、白银勋章、黄金勋章、白金勋章、钻石勋章。<br> 2、会员级别的升降均由系统自动处理，无需申请。<br>3、会员的等级由成长值决定，成长值越高会员等级超高，享受到的会员权益越大。</p>
<div class="level-pic-box">
<figure>
<article><img src="../public/images/member/level/level-pic1.gif"></article>
<figcaption>注册会员</figcaption>
<div></div>
</figure>
<figure>
<article><img src="../public/images/member/level/level-pic6.gif"></article>
<figcaption>青铜勋章</figcaption>
<div></div>
</figure>

<figure>
<article><img src="../public/images/member/level/level-pic2.gif"></article>
<figcaption>白银勋章</figcaption>
<div></div>
</figure>
<figure>
<article><img src="../public/images/member/level/level-pic3.gif"></article>
<figcaption>黄金勋章</figcaption>
<div></div>
</figure>
<figure>
<article><img src="../public/images/member/level/level-pic4.gif"></article>
<figcaption>白金勋章</figcaption>
<div></div>
</figure>
<figure class="fn-mr-0">
<article><img src="../public/images/member/level/level-pic5.gif"></article>
<figcaption>钻石勋章</figcaption>
</figure>
</div>
</div>
<div>
<h6><strong>会员级别规则</strong></h6>
<div class="table-part-all table-part-hover fn-tac table-part-all-f">
<table>
<thead>
<tr>
<th>会员级别</th>
<th>成长值范围</th>
<th>成长值有效</th>
</tr>
</thead>
<tbody>
<tr>
<td>注册会员</td>
<td>0～1499</td>
<td>永久有效 </td>
</tr>
<tr>
<td>青铜勋章</td>
<td>1500～3799</td>
<td>每年3月1日扣除1000成长值，根据剩余成长值重新计算级别 </td>
</tr>
<tr>
<td>白银勋章</td>
<td>3800～11999</td>
<td>每年3月1日扣除2000成长值，根据剩余成长值重新计算级别 </td>
</tr>
<tr>
<td>黄金勋章</td>
<td>12000～25999</td>
<td>每年3月1日扣除4000成长值，根据剩余成长值重新计算级别 </td>
</tr>
<tr>
<td>白金勋章</td>
<td>26000～59999</td>
<td>每年3月1日扣除8000成长值，根据剩余成长值重新计算级别 </td>
</tr>
<tr>
<td>钻石勋章</td>
<td>&gt;=60000</td>
<td>每年3月1日扣除16000成长值，根据剩余成长值重新计算级别 </td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>
</div>

</body>
</html>