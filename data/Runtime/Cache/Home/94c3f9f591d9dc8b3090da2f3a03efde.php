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
<link href="../public/css/personal/personal.css" rel="stylesheet" type="text/css" />
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<style type="text/css">
.ui-tab-headd {
    height: 26px;
}
.ui-tab-headd ul {
    float: left;
}
.ui-tab-headd li {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 3px 3px 0 0;
    color: #666;
    cursor: pointer;
    display: inline-block;
    float: left;
    height: 24px;
    line-height: 24px;
    margin-right: 5px;
    padding: 0 15px;
    border-bottom:0;
}
.ui-tab-headd li.ui-tab-head-current {
    background-color: #fff;
    color: #333;
    height: 25px;
    position: relative;
}
.ui-tab-headd li a {
    margin: 0 -15px;
    padding: 0 15px;
    white-space: nowrap;
}
.ui-tab-headd li a:hover {
    text-decoration: none;
}
.table-part-all-f table {
    color: #000;
}
.table-part-all table {
    width: 100%;
}
.table-part-all table th, .table-part-all table td {
    border: 1px solid #ddd;
    padding: 10px;
}
.table-part-all-f table th {
    background: #f8f8f8 none repeat scroll 0 0;
    text-align: center;
    white-space: nowrap;
}
.table-part-all .table-hover td {
    background: #f1f1f1 none repeat scroll 0 0;
}
.table-part-all-f table td {
    background: #fff none repeat scroll 0 0;
    overflow-wrap: break-word;
    word-break: break-all;
}
.table-part-all .btn-text a {
    color: #3b4a82;
    white-space: nowrap;
}
.table-part-th-b th {
    font-weight: bold;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
th {
    text-align: inherit;
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
.u-part-cont-box {
    border-top: 1px dashed #a5a5a5;
    margin-top: -1px;
    overflow: hidden;
    padding: 20px 0;
}
.u-part-cont-box aside {
    background: rgba(0, 0, 0, 0) url("../../images/sprite.png") no-repeat scroll 0 0;
    display: block;
    height: 31px;
    width: 40px;
}
.u-part-cont-box .icon-big-sprite1 {
    background-position: 0 -4px;
}
.u-part-cont-box .icon-big-sprite2 {
    background-position: -40px -4px;
}
.u-part-cont-box section {
    line-height: 24px;
    margin: 0 10px 0 50px;
}
.u-part-cont-box h5 {
    color: #666;
    font-weight: bold;
}
.part-detailed-box {
    border: 1px solid #d9dce8;
    font-size: 14px;
    margin-top: 10px;
}
.part-detailed-box h5 {
    background: #e3eaff none repeat scroll 0 0;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding-left: 10px;
}
.part-detailed-box section {
    background: #fff none repeat scroll 0 0;
    color: #666;
    overflow: hidden;
    padding: 0 20px;
}
.part-detailed-box section p {
    padding: 20px 0;
}
.part-detailed-box section p span {
    margin-right: 25px;
    vertical-align: middle;
}
.part-detailed-box .part-detailed-list p {
    border-top: 1px dashed #c2c2c2;
    margin-top: -1px;
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
<div class="main" id="news-info-tab">

<div class="ui-tab-headd ui-tab-head-p ui-tab-head-box">
<ul>
<li class="ui-tab-head-current"><a href="/home/personal/order" class="button do_hover">未完成订单</a></li>
<li><a href="/home/personal/tongbao" class="button do_hover">已完成的订单</a></li>

</ul>
</div>

<div class="ui-tab-cont table-part-all table-part-hover fn-tac table-part-all-f">
<div>
<table>
<thead>
<tr>
<th width="13%">订单编号</th>
<th width="18%">服务名称</th>
<th width="10%">产品周期</th>
<th width="10%">订单金额</th>
<th width="10%">购买数量</th>
<th width="19%">下单时间</th>
<th width="33%">操作</th>
</tr>
</thead>
<tbody>
<!--
<tr class="">
<td><a href="/manage/order/detail/448807.html" target="_blank">20170210175342164393</a></td>
<td>易融宝</td>
<td>2个月</td>
<td>15800.00</td>
<td>--</td>
<td>2017-02-10 17:53:42</td>
<td class="ac btn-text" data-id="448807b2c599847eafc25f8f969fd3d0d352db">
<a href="/manage/order/detail/448807.html" target="_blank">查看</a>
<a href="javascript:void(0);" class="upload_dialog fn-mr-5">上传汇款凭证</a>                                                            <a href="/order/success/448807b2c599847eafc25f8f969fd3d0d352db.html" target="_blank" class="ml5 fn-mr-5">继续支付</a><a href="javascript:;" class="ml5 J-order-close fn-mr-5">取消订单</a>
</td>
</tr>
-->
</tbody>
</table>
<footer class="table-page-part ">
<div class="paging"></div>
</footer>
</div>
</div>
<!--
<div class="user-level">
<header class="part-head-all-a">
<h4 class="fn-left">订单常见问题</h4>
</header>
<div class="u-part-cont-all">
<div class="u-part-cont-box">
<aside class="fn-left icon-big-sprite1"></aside>

<section>
<h5 class="fn-font-14 fn-mb-5 fn-mt-5">订单管理常见问题</h5>
<h5><a href="/help/detail_72755.html" target="_blank">我忘记拿银行给我的汇款单了，怎么办？</a></h5>
<div class="ui-text-gray">
答：请记住汇款时间、银行以及相应的分行等详细汇款信息，并及时与客服取得联系，进行反映。
</div>
</section>
</div>
<div class="u-part-cont-box">
<aside class="fn-left icon-big-sprite2"></aside>
<section>
<h5 class="fn-font-14 fn-mb-5 fn-mt-5">付款方式常见问题</h5>
<h5><a href="/help/detail_72747.html" target="_blank">未完成的订单怎么在线支付？</a></h5>
<div class="ui-text-gray">
答：点击未完成订单右侧“继续支付”按钮，<br>
<p align="center"><img src="/uploads/attached/image/20130808/20130808162333_97907.png" alt=""></p>
<p>跳转进入“网银在线支付”页面，选择所要付款的银行</p>
<p align="center"><img src="/uploads/attached/image/20130808/20130808162348_88585.png" alt=""></p>
<p>点击“下一步”，进入银行页面，进行付款操作，</p>
<p align="center"><img src="/uploads/attached/image/20130808/20130808162422_66698.png" alt=""></p>
<p>完成付款，点击“支付成功”。</p>
<p align="center"><img src="/uploads/attached/image/20130808/20130808162439_23561.png" alt=""></p>
</div>
</section>
</div>
</div>
</div>
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
</body>
</html>