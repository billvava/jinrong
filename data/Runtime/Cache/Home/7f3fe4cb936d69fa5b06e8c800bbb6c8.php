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
<link href="../public/css/common.css" rel="stylesheet" type="text/css" />
<link href="../public/css/header.css" rel="stylesheet" type="text/css" />
<link href="../public/css/common_ajax_dialog.css" rel="stylesheet" type="text/css" />
<link href="../public/css/jquery.ui.tooltip.css" rel="stylesheet" type="text/css" />
<link href="../public/css/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="../public/job/js/baiduTemplate.js" type="text/javascript"></script>
<style>
.container::after {
    clear: both;
    content: " ";
    display: block;
    font-size: 0;
    height: 0;
    visibility: hidden;
}
.header_wrapper{
    background: #fff
}
.part-money-text-list span {
    display: block;
    float: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 180px;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, input, button, textarea, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summargy, time, margk, audio, video {
    margin: 0;
    padding: 0;
}
div, p, li, dt, dd, h5, h6 {
    word-break: break-all;
}
.ui-text-gray-2 {
    color: #666;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
.part-money-list-a, .part-instituional-list {
    line-height: 24px;
}
div, p, li, dt, dd, h5, h6 {
    word-break: break-all;
}
body {
    color: #333;
    font: 12px/150% "微软雅黑";
}
body, button, input, select, textarea {
    font: 12px/1.5 tahoma,arial,"Microsoft Yahei","Hiragino Sans GB",宋体;
}
html {
    color: #333;
}
.fn-mt-30 {
    margin-top: 30px !important;
}
.fn-mb-20 {
    margin-bottom: 20px !important;
}
.container {
    margin-left: auto;
    margin-right: auto;
    min-width: 1000px;
    width: 1000px;
}
.m-mainRight {
    float: right;
    overflow: hidden;
    width: 240px;
}
.m-mainLeft {
    display: inline;
    float: left;
    overflow: hidden;
    width: 740px;
}
.bgFFF {
    background-color: #fff;
}
.pad30 {
    padding: 30px;
}
.detail-info {
    padding: 20px;
}
.detail-left dl {
    display: inline-block;
    float: left;
    line-height: 1.8em;
    overflow: hidden;
    padding: 0 10px;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 320px;
}
.detail-left dt {
    color: #999;
    float: left;
    overflow: hidden;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 100px;
}
.detail-left dd {
    color: #333;
    float: left;
    overflow: hidden;
    text-align: left;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 220px;
}
.detail-left dd a {
    color: #333;
}
.bor_btm_da {
    border-bottom: 1px dashed #ccc;
}
.m-title1 .title-span {
    border-bottom: 2px solid #e94e38;
    display: inline-block;
    font-size: 16px;
    height: 56px;
    padding: 0 30px;
}
a {
    color: #666;
    cursor: pointer;
}
ins, a {
    text-decoration: none;
}
.btm20 {
    margin-bottom: 20px;
}
.fn-pb-20 {
    padding-bottom: 20px !important;
}
.fn-pt-20 {
    padding-top: 20px !important;
}
.m-smMenu {
    background-color: #e94e38;
    color: #fff;
    font-size: 14px;
    padding: 3px 5px;
}
.project-pt-fd {
    background: #f4f0e4 none repeat scroll 0 0;
    border-bottom: 1px solid #ddd;
    padding: 20px 30px;
}
.fn-pr {
    position: relative;
}
.ui-btn-orange, .ui-btn-red {
    color: #fff !important;
}
.ui-btn-orange {
    background-color: #f06612 !important;
}
.ui-btn-big {
    font-size: 14px;
    height: 40px;
    line-height: 40px;
    padding: 0 10px;
}
.w100 {
    width: 100px !important;
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
.project-pt-fd h5 {
    font-size: 22px;
    font-weight: bold;
}
.m-title1 {
    border-bottom: 1px solid #ddd;
    height: 56px;
    line-height: 56px;
}
.m-hyxm {
    background-color: #76aedf;
}
.m-hyxm a {
    color: #fff !important;
}
.colfff, .colfff a {
    color: #fff;
    text-decoration: none;
}
.pad20 {
    padding: 20px;
}
.top10 {
    margin-top: 10px;
}
.font16 {
    font-size: 16px;
}
.center {
    text-align: center;
}
.m-mainRight .m-title3 .ui-btn-blue {
    background: #4a9adf none repeat scroll 0 0 !important;
}
.ui-btn-small-icon {
    height: 20px;
    line-height: 1em;
    padding-top: 4px;
}
.fn-mt-20 {
    margin-top: 20px !important;
}
.m-mainLeft .m-ico5 {
    color: #fff;
    font-size: 12px;
    line-height: 13px;
    margin-left: 5px;
    text-align: center;
    text-indent: 2px;
}
body{
    background-color: #eee;
}
.bgFFF {
    background-color: #fff;
}
.verMid {
    vertical-align: middle;
}
.font16b {
    font-size: 16px;
    font-weight: bold;
}
.ui-text-blue-2 {
    color: #3b4a82;
}
.ui-text-yellow-2 {
    color: #56C6FF;
}
.fn-left {
    float: left;
}
.fn-right {
    float: right;
}
.m-eeesc-box {
    display: inline-block;
    float: left;
    margin: 8px 10px 0 0;
    position: relative;
}
.fn-clear::after {
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
.fn-mt-30 {
    margin-top: 30px !important;
}
.fn-mb-20 {
    margin-bottom: 20px !important;
}
.col666, .col666 a {
    color: #666;
    text-decoration: none;
}
.bor_btm_da {
    border-bottom: 1px dashed #ccc;
}
.pad20RL {
    padding: 0 20px;
}
.font14 {
    font-size: 14px;
}
.top20 {
    margin-top: 20px;
}
.m-title1 {
    border-bottom: 1px solid #ddd;
    height: 56px;
    line-height: 56px;
}
.bgFa {
    background-color: #fafafa;
}
.top20 {
    margin-top: 20px;
}
.clearfix::before, .clearfix::after {
    content: "";
    display: table;
    line-height: 0;
}
.clearfix::before, .clearfix::after {
    content: "";
    display: table;
    line-height: 0;
}
.clearfix::after {
    clear: both;
}
.clearfix::before, .clearfix::after {
    content: "";
    display: table;
    line-height: 0;
}
.clearfix::after {
    clear: both;
}
.fn-mr-30 {
    margin-right: 30px !important;
}
.fn-clear::after {
    clear: both;
    content: " ";
    display: block;
    font-size: 0;
    height: 0;
    visibility: hidden;
}
.clearfix::before, .clearfix::after {
    content: "";
    display: table;
    line-height: 0;
}
.fn-mt-10 {
    margin-top: 10px !important;
}
.ui-btn-red {
    background-color: #e94e38;
}
.m-hyxm .ui-btn {
    color: #fff !important;
}
.m-hyxm a {
    color: #fff !important;
}
.colfff, .colfff a {
    color: #fff;
    text-decoration: none;
}
.ui-btn-orange, .ui-btn-red {
    color: #fff !important;
}
.ui-btn {
    font-size: 14px;
    height: 30px;
    line-height: 30px;
    padding: 0 8px;
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
.w180 {
    width: 180px !important;
}
.btn-hall {
    background: #5d7992 none repeat scroll 0 0;
    border: 1px solid #a2a2a2;
    border-radius: 3px;
    color: #fff !important;
    display: block;
    font-size: 14px;
    height: 28px;
    line-height: 28px;
    text-align: center;
    width: 198px;
}
.fn-hide {
    display: none;
}
.m-title3 .title-span {
    border-bottom: 2px solid #fff;
    display: inline-block;
    float: left;
    font-size: 16px;
    height: 46px;
    line-height: 56px;
    padding: 0 20px;
}
.m-hyxm img {
    border-radius: 49px;
    height: 98px;
    width: 98px;
}
fieldset, img {
    border: 0 none;
}
.m-title3 {
    border-bottom: 1px solid #ddd;
    height: 46px;
}
.fn-mt-15 {
    margin-top: 15px !important;
}
.fn-mr-5 {
    margin-right: 5px !important;
}
.ui-btn-small {
    height: 24px;
    line-height: 24px;
    padding: 0 6px;
}
.bor_btm_so {
    border-bottom: 1px solid #ddd;
}
.fn-br-b0 {
    border-bottom: 0 none !important;
}
.fn-tac {
    text-align: center;
}
.ui-dialog-body {
    padding: 15px;
    text-align: center;
}
.part-popup-ittext {
    color: #333;
    font-size: 14px;
    line-height: 32px;
}
.ui-le-ht26 {
    line-height: 26px;
}
.ui-btn, .popup-msg .ui-btn {
    width: 130px;
}
</style>
<style media="print" type="text/css">
.noprint{visibility:hidden}
</style>
</head>
<body>
<div class="noprint">
<link href="../public/css/theme.css" rel="stylesheet" type="text/css" />
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

<div class="header_wrapper">
    <div class="index_head">
        <div class="logobox" style="text-align:center;">
            <a href="/"><img src="../public/images/logo.png" border="0" /></a>
        </div>
        <div class="index_nav">
            <ul class="link_gray6 nowrap">
                <?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','数量'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
                <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if( MODULE_NAME == C( 'DEFAULT_MODULE') ): if($nav[ 'tag'] == strtolower(CONTROLLER_NAME) ): ?>select hover<?php endif; else: if($nav[ 'tag'] == strtolower(MODULE_NAME) ): ?>select hover<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<div class="container fn-mb-20 fn-mt-30">
<p class="btm20">
<i class="small-icon small-icon-12 right10"></i>
<span class="colblue verMid">
<a href="/">首页</a>&gt;<a href="<?php echo U('Item/item_list');?>">选项目</a>
&gt;<?php echo ($info["title"]); ?></span>
</p>
<div class="fn-clear">
<div class="m-mainRight ">
<div class="m-hyxm colfff">
<div class="m-title3">
<h2 class="title-span">会员名片</h2>
<div class="fn-right fn-mt-15 fn-mr-5" data-id="1486769">
<a href="javascript:void(0);" class="ui-btn-small ui-btn-blue ui-btn-small-icon" alt="交换名片" id="exchange">
<i class="small-icon small-icon-21"></i><span class="fn-vam">交换名片</span>
</a>
</div>
</div>
<p class="center top20">

<?php if(!empty($info['realname'])): ?><a href="/Company/show/company_id/<?php echo ($info['trj_company_id']); ?>.html"><img src="../public/images/face/<?php echo ($info["sex_cn"]); ?>1.gif"></a>
<?php else: ?>
<img src="../public/images/face/<?php echo ($info["sex_cn"]); ?>1.gif"><?php endif; ?>

</p>
<p class="top10 font16 center" id="J_view_contact_name"><span class="fn-vab"><?php if(empty($member_info['surname'])): ?>某<?php else: echo ($member_info["surname"]); endif; if(empty($member_info['sex'])): ?>先生<?php else: endif; echo ($member_info["sex"]); ?></span></p>
<div class="pad20">
<p class="line24">
<?php if(!empty($info['company_name'])): ?>所在公司：<span id="J_view_company_name"><?php echo ($info['company_name']); ?></span><br><?php endif; ?>
<?php if(!empty($info['job'])): ?>职位：<?php echo ($info['job']); ?><br><?php endif; ?>
<?php if(!empty($info['user_area'])): ?>所在地区：<?php echo ($info['user_area']); ?><br><?php endif; ?>
<?php if(!empty($info['company_name'])): ?>关注行业：
<a href="" target="_blank">节能环保</a>
<br><?php endif; ?>
</p>
<p class="top10" data-id="">
<a href="javascript:void(0);" class="ui-btn ui-btn-orange w180" id="getcontact">查看联系方式</a>
</p>
<?php if(!empty($info['realname'])): ?><p class="top10"><a href="/Company/show/company_id/<?php echo ($info['trj_company_id']); ?>.html" class="btn-hall">进入展厅</a></p>
<?php else: ?>
<p class="top10">咨询客服人员 </p><?php endif; ?>
</div>
</div>
<div class=" m-title1 bgFa top20">
<span class="title-span">相似的资金</span>
</div>
<div class="bgFFF pad20RL clearfix col666">
<div class="bor_btm_da top20">
<p class="font14"><a href="#"><?php echo ($info["title"]); ?></a></p>
<p class="top10">投资金额：1000万-5000万</p>
<p class="line20 top10 btm20">股权投资  |  成长期,扩张期,成熟期   |    北京</p>
</div>
<div class="bor_btm_da top20">
<p class="font14"><a href="#">成都投资公司500万内找智能制造、大数据、大健康等项目合作</a></p>
<p class="top10">投资金额：500万</p>
<p class="line20 top10 btm20">股权投资  |  种子期,初创期,成长期   |    四川省</p>
</div>
<div class="bor_btm_da top20">
<p class="font14"><a href="#">四川某投资公司5000万元寻医疗等项目合作</a></p>
<p class="top10">投资金额：5000万</p>
<p class="line20 top10 btm20">股权投资  |  成长期,扩张期,成熟期   |    四川省</p>
</div>
<div class=" top20">
<p class="font14"><a href="#">四川某投资公司200万-1亿元寻大健康等项目合作</a></p>
<p class="top10">投资金额：200万-1亿</p>
<p class="line20 top10 btm20">股权投资  |  成长期,扩张期,成熟期   |    四川省</p>
</div>
</div>
</div>

<div class="m-mainLeft">
<div class="bgFFF clearfix">
<div class="pad30 bgFFF">
<p><a href="javascript:void(0);" class="font16b verMid ui-text-yellow-2"><?php echo ($info["title"]); ?></a></p>
<div class="fn-clear">
<div class="fn-left fn-mt-10 ui-text-gray"><time class="fn-mr-30"><?php echo date('Y-m-d',$info['updatetime']);?>
</time>浏览数：<?php echo ($info["click"]); ?>人</div>
<div class="fn-right">
<span class="m-eeesc-box">
<i class="small-icon small-icon-28"></i>
<a href="javascript:void(0);" id="send_to_email" title="发送至邮箱">免费发送至邮箱</a>
</span>
<span class="m-eeesc-box">
<i class="m-icoAll m-ico7"></i>
<a href="javascript:void(0);" id="addfav" title="收藏">收藏</a>

</span>
<span class="m-eeesc-box">
<i class="m-icoAll m-ico8"></i>
<a href="javascript:void(0);" id="complaints" title="举报">举报</a>
</span>
<span class="shareBtn bdsharebuttonbox m-eeesc-box bdshare-button-style1-16" data-bd-bind="1488283054076">
<i class="m-icoAll m-ico9"></i>
<a href="javascript:void(0);" class="bds_more" data-cmd="more" title="分享">分享</a>
</span>

</div>
</div>

</div>
<p class="bor_btm_so"></p>
<div class="pad30 detail-info">
<div class="detail-left">
<dl class="detail-info-dl">
<dt>项目类型：</dt>
<dd title="<?php echo ($info["info_type"]); ?>">
<a href="" target="_blank"><?php echo ($info["info_type"]); ?></a>
</dd>
</dl>
<dl class="detail-info-dl">
<dt>所在地区：</dt>
<dd title="<?php echo ($info["area"]); ?>"><?php echo ($info["area"]); ?></dd>
</dl>
<?php if($info["xmrz_body"] != ''): ?><dl class="detail-info-dl">
<dt>融资主体：</dt>
<dd title="">
<!--
<a href="/list_1000.html?y=13" target="_blank">房地产</a>,
-->
<?php echo ($info["xmrz_body"]); ?>
</dd>
</dl><?php endif; ?>

<?php if($info["industry_id"] != ''): ?><dl class="detail-info-dl">
<dt>所属行业：</dt>
<dd title="<?php echo ($info["industry_id"]); ?>">
<?php echo ($info["industry_id"]); ?></dd>
</dl><?php endif; ?>

<?php if($info["industry_id"] != ''): ?><dl class="detail-info-dl">
<dt>融资用途：</dt>
<dd title="<?php echo ($info["xmrz_usage"]); ?>">
<?php echo ($info["xmrz_usage"]); ?></dd>
</dl><?php endif; ?>

<?php if($info["industry_id"] != ''): ?><dl class="detail-info-dl">
<dt>融资金额：</dt>
<dd title="<?php echo ($info["amount_interval_min"]); ?>
<?php echo ($info["amount_interval_min_unit"]); ?>
<?php if($info["amount_interval_max"] != ''): ?>-<?php echo ($info["amount_interval_max"]); echo ($info["amount_interval_max_unit"]); endif; ?>">
<?php echo ($info["amount_interval_min"]); ?>
<?php echo ($info["amount_interval_min_unit"]); ?>
<?php if($info["amount_interval_max"] != ''): ?>-<?php echo ($info["amount_interval_max"]); echo ($info["amount_interval_max_unit"]); endif; ?>
</dd>
</dl><?php endif; ?>

<?php if($info["s11"] != ''): ?><dl class="detail-info-dl">
<dt>可提供资料：</dt>
<dd title="<?php echo ($info["s11"]); ?>">
<?php echo ($info["s11"]); ?></dd>
</dl><?php endif; ?>

<div class="fn-clear"></div>
</div>
</div>
<p class="bor_btm_da"></p>
<?php if($info["zjf_tz_type"] !=''): ?><div class="pad30 detailInf">
<p>
<span class="m-smMenu">股权投资</span></p>
<div class="detail-ul-list-container fn-mt-20">
<div class="detail-left">

<dl class="detail-info-dl">
<dt>股权投资类型：</dt>
<dd title="<?php echo ($info["zjf_tz_type"]); ?>"><?php echo ($info["zjf_tz_type"]); ?></dd>
</dl>

<dl class="detail-info-dl">
<dt>投资阶段：</dt>
<dd title="<?php echo ($info["zjf_tz_period"]); ?>"><?php echo ($info["zjf_tz_period"]); ?></dd>
</dl>

<dl class="detail-info-dl">
<dt>投资期限：</dt>
<dd title="<?php echo ($info["s110_max"]); ?> - <?php echo ($info["s110_min"]); echo ($info["s110_unit"]); ?>"><?php echo ($info["s110_max"]); ?> - <?php echo ($info["s110_min"]); echo ($info["s110_unit"]); ?></dd>
</dl>

<!--
<dl class="detail-info-dl">
<dt>参股比例：</dt>
<dd title="20 - 30 %">20 - 30 %</dd>
</dl>
-->
<div class="fn-clear"></div>
</div>
</div>
</div><?php endif; ?>

<!--
<div class="project-pt-fd">
<table width="100%">
<tbody><tr>
<td width="120"><img src="../public/images/new-deliver.png" alt="投递项目"></td>
<td>
<article>
<h5>昨日投资人发出约谈共计1611次</h5>
<p class="fn-mt-5">立对该项目感兴趣？快来约谈项目方吧，让项目方主动联系您！</p>
</article>
</td>
<td class="fn-pr" width="116"><a href="javascript:void(0);" data-title="成都某投资公司400万-9亿元寻化学化工等优质项目合作" data-zjxm-id="541882" data-user-id="1486769" class="ui-btn-big ui-btn-orange w100" title="约谈项目方">约谈项目方</a>
</td>
</tr>
</tbody></table>
</div>
-->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</div>


<?php if($info["i_pic"] != ''): ?><div id="i-zjxm-pic" class="bgFFF top20 j-ret">
<div class="m-title1">
<span class="title-span">项目图片</span>
</div>
<div class="m-ppd clearfix pad30 ">
<div class="part-imgViewWap-hd">
<div class="part-imgViewWap-img">
<div>
<img src="<?php echo ($info['i_pic'][0]['path']); ?>" id="J_pic_view">
</div>
</div>
</div>

<div class="part-imgViewWap-bd" id="J_pic_list">
<div>
<a class="sPrev" href="javascript:void(0)"></a>
<a class="sNext" href="javascript:void(0)"></a>
</div>
<div class="part-imgViewWap-list">
<ul>
<?php if(is_array($info['i_pic'])): $i = 0; $__LIST__ = $info['i_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($vo['path']); ?>" alt="<?php echo ($vo['title']); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="../public/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript">
var J_pic_view = $("#J_pic_view");
$("#J_pic_list").slide({
            mainCell: "ul",
            vis: 4,
            prevCell: ".sPrev",
            nextCell: ".sNext",
            effect: "leftLoop"
}),

$("#J_pic_list li").on("mouseover",
    function() {
        J_pic_view.attr("src", $(this).find("img").attr("src"));
    });

</script>
<style type="text/css">
.part-imgViewWap-hd {
    display: table;
    height: 1%;
    overflow: hidden;
    width: 658px;
}
.part-imgViewWap-img {
    border: 1px solid #ddd;
    display: table-cell;
    height: 360px;
    min-height: 360px;
    min-width: 658px;
    padding: 10px;
    position: relative;
    text-align: center;
    vertical-align: middle;
    width: 658px;
}
.part-imgViewWap-img div {
    top: 50%;
}
.part-imgViewWap-hd img {
    left: -50%;
    max-height: 358px;
    max-width: 658px;
    overflow: hidden;
    top: -50%;
}
.part-imgViewWap-bd {
    background-color: #fbfbfb;
    border: 1px solid #ddd;
    margin-top: 10px;
    position: relative;
}
.part-imgViewWap-list {
    margin: 0 auto;
    overflow: hidden;
    padding: 10px 0;
    width: 558px;
}
.part-imgViewWap-bd ul {
    overflow: hidden;
    width: 10000px;
}
.part-imgViewWap-bd li {
    border: 1px solid #ddd;
    cursor: pointer;
    float: left;
    height: 72px;
    margin-right: 10px;
    padding: 5px;
    width: 120px;
}
.part-imgViewWap-bd img {
    display: block;
    height: 72px;
    width: 120px;
}
.part-imgViewWap-bd a {
    background: rgba(0, 0, 0, 0) url("../public/images/sp.png") no-repeat scroll 0 0;
    display: block;
    height: 27px;
    position: absolute;
    top: 32px;
    width: 15px;
    z-index: 20;
}
.part-imgViewWap-bd .sPrev {
    background-position: 0 -23px;
    left: 20px;
}
.part-imgViewWap-bd .sNext {
    background-position: -15px -23px;
    left: 640px;
}
</style><?php endif; ?>

<?php if($info["i_overview"] != ''): ?><div id="i_overview" class="bgFFF top20 j-ret" style="">
<div class="m-title1">
<span class="title-span">项目概述 </span>
</div>
<div class="pad30 line22">
<div class="txt2em">
<p><?php echo ($info["i_overview"]); ?></p>
</div>
</div>
</div><?php endif; ?>



<?php if($info["i_introduce"] != ''): ?><div id="i_introduce" class="bgFFF top20 j-ret">
<div class="m-title1">
<span class="title-span">项目优势</span>
</div>
<div class="pad30 line22">
<div class="txt2em">
<p>
<?php echo ($info["i_introduce"]); ?>
</p>
</div>
</div>
</div><?php endif; ?>

<?php if($info["i_other_remark"] != ''): ?><div id="i_other_remark" class="bgFFF top20 j-ret">
<div class="m-title1">
<span class="title-span">其他备注 </span>
</div>
<div class="pad30 line22">
<div class="txt2em">
<p><?php echo ($info["i_other_remark"]); ?></p>
</div>
</div>
</div><?php endif; ?>

<?php if($info["i_keywords"] != ''): ?><div class="bgFFF top20 clearfix ">
<div class="m-xxfj clearfix">
<div class="col999 pad30">标签：
<!--
<a href="" target="_blank">成都</a>，
<a href="" target="_blank">投资公司</a>，
<a href="">化学化工</a>，
<a href="">股权投资</a>
-->
<?php echo ($info["i_keywords"]); ?>
</div>
</div>
</div><?php endif; ?>

<div id="i-zjxm-comment" class="bgFFF top20 clearfix j-ret">
<a name="cm" id="cm"></a>
<div class="pad30">
<div class="fn-clear ui-le-ht24">
<p class="fn-left"><span class="font16">用户留言</span>
</p>
<p class="fn-right" id="leave_msg_input_tip">还可输入<span class="orange">300</span>个字</p>
</div>
<div class="m-textArea top20">
<div class="fn-pr">
<textarea class="input" maxlength="300" name="leave_msg" id="leave_msg_content" placeholder="提示：严禁发布含有联系方式和广告性质的内容，违者一律删除！"></textarea>
<span class="prompt_pass">提示：严禁发布含有联系方式和广告性质的内容，违者一律删除 !</span>
</div>
<div class="inputArea">
<a href="javascript:void(0);" class="ui-btn ui-btn-orange btn-publish-leave-msg">发布留言</a>
<div class="m-hykj fn-right right10 j-hover-all">
<span>公开</span>
<ul>
<li><a href="javascript:void(0)" data-scope="0">公开</a></li>
<li><a href="javascript:void(0)" data-scope="1">仅对方可见</a></li>
<li><a href="javascript:void(0)" data-scope="2">会员可见</a></li>
</ul>
</div>
<input id="public" name="public" value="0" type="hidden">
<div id="comment_login_reg" class="<?php if(C("visitor.uid") != ""): ?>fn-hide<?php endif; ?>">
<input id="reg_or_login" name="reg_or_login" type="hidden">
<form id="frmRegOrLogin" name="frmRegOrLogin" method="post">
<div class="fn-left fn-pr">
<input id="J_name" name="name" class="input width-name" placeholder="姓名" type="text">
<span class="prompt_pass">姓名</span>
</div>
<div class="fn-left fn-pr">
<input id="J_mobile_msg" name="mobile" class="input width-tel log_reg_code" placeholder="手机号码" type="text">
<span class="prompt_pass">手机号码</span>
</div>
<div class="fn-left prompt">输入姓名与电话留言后方便对方与您联系!</div>
</form>
</div>
</div>
</div>
<p class="pad20TB" id="J_mobile_msg_info"></p>                          
<div class="v6-message-all" id="leave_messages">
<ul>
<script type="text/html" id="msg_list">
<%for(var i=0;i<data.length;i++){%>
<li>
    <aside class="fn-left">
    <img src="../public/images/face/nan2.gif">
    </aside>
<article>
    <section>
    <div class="fn-right col999"><%=data[i].addtime%></div>
    <h6 class="fn-left">
    <a rel="nofollow" href="#" class="font16 colblue" target="_blank"><%=data[i].realname%></a>
    <span class="left20">&nbsp;</span>
    </h6>
    </section>
    <p class="fn-text-overflow col999"></p>
    <p class="top10 line20 col666"><%=data[i].content%></p>
<!--
<div class="message-reply">
<i class="part-icon-arrow-a"></i>
<dl>
<dt>回复：</dt>
<dd>
我这边条件是不讲价的！能接受就联系我吧</dd>
</dl>
</div>
-->
</article>
</li>
<%}%>
</script>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<style type="text/css">
.v6-message-all li {
    border-top: 1px solid #ddd;
    overflow: hidden;
    padding: 30px 0;
}
.pad20TB {
    padding: 20px 0;
}
* {
    border: 0 none;
    margin: 0;
    padding: 0;
}
.m-textArea .inputArea {
    background: #fbfbfb none repeat scroll 0 0;
    border-radius: 0 0 3px 3px;
    border-top: 1px solid #ddd;
    height: 25px;
    padding: 5px;
}
.v6-message-all li section {
    line-height: 24px;
    margin-bottom: 10px;
    overflow: hidden;
}
.v6-message-all li img {
    border-radius: 10em;
    display: block;
    height: 60px;
    width: 60px;
}
.v6-message-all li article {
    margin-left: 80px;
}
.fn-left {
    float: left;
}
.m-textArea {
    border: 1px solid #ddd;
    border-radius: 3px;
}
.pad30 {
    padding: 30px;
}
.top20 {
    margin-top: 20px;
}
.top10 {
    margin-top: 10px;
}
.line20 {
    line-height: 20px;
}
.fn-clear::after {
    clear: both;
    content: " ";
    display: block;
    font-size: 0;
    height: 0;
    visibility: hidden;
}
.fn-left {
    float: left;
}
.orange {
    color: #f60;
    font-weight: bold;
}
.m-textArea .inputArea .input.width-name {
    width: 50px;
}
.m-textArea .inputArea .input {
    border: 1px solid #ddd;
    height: 17px;
    line-height: 17px;
    margin-right: 10px;
    padding: 3px 8px;
    vertical-align: middle;
    width: 80px;
}
input, select, textarea {
    font-size: 100%;
}
.m-textArea .inputArea .ui-btn {
    border-radius: 0 0 3px;
    float: right;
    height: 36px;
    line-height: 36px;
    margin: -6px -6px 0 5px;
    width: 100px;
}
.ui-btn-orange, .ui-btn-red {
    color: #fff;
}
.ui-btn-orange{
    background-color: #f60;
}
.ui-btn {
    font-size: 14px;
    height: 30px;
    line-height: 30px;
    padding: 0 8px;
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
.ui-btn, .ui-btn-small, .ui-btn-big {
    color: #fff;
}
.prompt_pass {
    color: #999;
    display: none;
    left: 5px;
    position: absolute;
    top: 3px;
}
.m-hykj {
    background: rgba(0, 0, 0, 0) url("../public/images/v6/hykjBg.png") no-repeat scroll center center;
    cursor: pointer;
    display: inline-block;
    height: 24px;
    line-height: 24px;
    padding-left: 5px;
    position: relative;
    width: 98px;
}
.right10 {
    margin-right: 10px;
}
.m-textArea .inputArea .prompt {
    color: #999999;
    line-height: 25px;
}
.m-hykj ul {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-color: currentcolor #ddd #ddd;
    border-image: none;
    border-style: none solid solid;
    border-width: medium 1px 1px;
    display: none;
    left: 0;
    position: absolute;
    top: 24px;
    width: 101px;
}
.font16 {
    font-size: 16px;
}
.fn-right {
    float: right;
}
.ui-le-ht24 {
    line-height: 24px;
}
.col666, .col666 a {
    color: #666;
    text-decoration: none;
}
.col999, .col999 a {
    color: #999;
    text-decoration: none;
}
.fn-text-overflow {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.fn-pr {
    position: relative;
}
.m-textArea textarea {
    border: 0 none;
    height: 95px;
    margin: 10px 0 0 10px;
    overflow: auto;
    width: 660px;
}
textarea {
    resize: none;
}
.m-hykj.cur ul {
    display: block;
}
.m-hykj ul li {
    height: 24px;
    line-height: 24px;
}
.m-hykj ul li a {
    display: block;
    text-decoration: none;
    text-indent: 5px;
}
.m-hykj ul li a:hover {
    background-color: #f60;
    color: #fff;
}
.m-hyxm a {
    color: #fff;
}
.popup-msg-a .ui-btn, .popup-msg-e .ui-btn {
    width: 130px;
}
.ui-btn-orange, .ui-btn-red {
    color: #fff;
}
.ui-btn-red {
    background-color: #e94e38;
}
.ui-btn-orange {
    background-color: #f60;
}
.ui-btn {
    font-size: 14px;
    height: 30px;
    line-height: 30px;
    padding: 0 8px;
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
.layui-layer-content .layui-layer-close {
    position: static;
}
</style>
<div class="noprint">
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="/">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$list);?>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>|   <a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	|   <a target="_blank" href="<?php echo url_rewrite('QS_suggest');?>">意见建议</a> 
	</div>
	<div class="txt">
		联系地址：<?php echo C('qscms_address');?>      联系电话：<?php echo C('qscms_bootom_tel');?><br />
		<?php echo C('qscms_bottom_other');?>     <a href="http://www.miibeian.gov.cn"><?php echo C('qscms_icp');?></a>
		<?php echo htmlspecialchars_decode(C('qscms_statistics'));?>
	</div>
</div>

<div class="">
	<div class=""></div>
</div>
<!--[if lt IE 9]>
	<script type="text/javascript" src="__HOMEPUBLIC__/js/PIE.js"></script>
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
<script type="text/javascript" src="__HOMEPUBLIC__/js/jquery.disappear.tooltip.js"></script>
<div class="floatmenu">
  <div class="item mobile">
    <div class="popover popover1">
    </div>
  </div>
  <div class="item ask">
    <a class="blk" target="_blank" href="<?php echo url_rewrite('QS_suggest');?>"></a>
  </div>
  <div id="backtop" class="item backtop" style="display: none;"><a class="blk"></a></div>
</div>
<script>
var global = {
    h:$(window).height(),
    st: $(window).scrollTop(),
    backTop:function(){
      global.st > (global.h*0.5) ? $("#backtop").show() : $("#backtop").hide();
    }
  }
  $('#backtop').on('click',function(){
    $("html,body").animate({"scrollTop":0},500);
  });
  global.backTop();
  $(window).scroll(function(){
      global.h = $(window).height();
      global.st = $(window).scrollTop();
      global.backTop();
  });
  $(window).resize(function(){
      global.h = $(window).height();
      global.st = $(window).scrollTop();
      global.backTop();
  })
</script>
</div>
<script type="text/javascript">
$.get("<?php echo U('Msg/Api/msg_list',['id'=>$info['id'],'uid'=>C('visitor.uid'),'pos'=>1]);?>", function(data){
    if(data.code==200){
        $('#leave_messages').html(baidu.template('msg_list',data));
    }
});
</script>
<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script type="text/javascript" src="../public/js/jquery.listitem.js"></script>
<script type="text/javascript" src="../public/js/jquery.dropdown.js"></script>
<script type="text/javascript" src="../public/js/laydate/laydate.js"></script>
<!-- <script type="text/javascript" src="../public/js/favorites.js"></script> -->
<script type="text/javascript" src="../public/js/personal/jquery.fixed.sidebar.js"></script>
<script type="text/javascript" src="../public/js/dialog.js"></script>
<script type="text/javascript" src="../public/js/layer/layer.js"></script>
<script type="text/javascript">
var login_uid = "<?php echo C('visitor.uid');?>";
// 公共组件hover
jQuery.jqhover = function(tabtit) {
    $(tabtit).hover(function(){
        $(this).addClass("cur")
    },function(){
        $(this).removeClass("cur")
    });
};
$.jqhover('.j-hover-all');
$(".j-hover-all ul").on("click",
    function(li){
        var ul = $(this),
        span = ul.prev(),
        a = $(li.target),
        val = a.data("scope");
        $("#public").attr("value",val),
        span.text(a.text())
});

$("#leave_msg_content").on("keyup",
function() {
var a = $(this),
c = a.attr("maxlength") || 300,
d = c - a.val().length,
e = $("#leave_msg_input_tip");
e && (0 > d ? e.html('<span class="orange">您输入的内容，已超过' + c + "个字，请重新编辑</span>") : 0 != d ? e.html('还可输入<span class="orange">' + d + "</span>个字") : e.html("已经" + c + "个字了"))
}),

qrh.Util = {
    isMobile: function(a) {
        return /^1(3[0-9]|4[0-9]|5[0-9]|7[0|1|3|5|6|7|8]|8[0-9])\d{8}$/.test(a)
    },
    isChinese: function(a) {
        return /^[\u4E00-\u9FA5\uF900-\uFA2D]+$/.test(a)
    },
    isEmail: function(a) {
        return /^\w+((-\w+)|(\.\w+))*\@\w+((\.|-)\w+)*\.\w+$/.test(a)
    },
    isEmpty: function(a) {
        switch (typeof a) {
        case "string":
            return 0 == $.trim(a).length ? !0 : !1;
        case "number":
            return 0 == a;
        case "object":
            return null == a;
        case "array":
            return 0 == a.length;
        default:
            return ! 0
        }
    }
}

dialog_ok = function (msg){
            layer.open({
                type: 1,
                title: '温馨提示',
                skin: 'layui-layer-rim',
                area: ['520px','173px'],
                //move:false,
                content: '<form class="layerContent fn-tac ui-dialog-body">' +
                '<p class="part-popup-ittext">'+msg+'</p>'+
                '<footer class="fn-mt-30"><a href="javascript:;" id="dialog_close" class="ui-btn ui-btn-orange layui-layer-close">确定</a></footer>'+
                '</form>'
            });
        }

$(".btn-publish-leave-msg").on("click",function(){
    var content = $("#leave_msg_content"),
    leave_msg_content = content.val(),
    content_length = leave_msg_content.length;
    if (0 == content_length){
        dialog_ok('留言内容不能为空');
        return false;
    }
    if (content_length >= 300){
        dialog_ok("留言内容最多只能300个字符");
        return false;
    }

    if(!login_uid){
        var name = $("#J_name"),
        name_val = name.val();
        if (!name_val || "姓名" == name_val){
            dialog_ok('请输入姓名');
            return false;
        }
        if (!qrh.Util.isChinese(name_val)){
            dialog_ok('请输入您的中文姓名');
            name.focus();
            return false;
        }
        var mobile = $("#J_mobile_msg");
        mobile_val = mobile.val();
        if (!mobile_val || "手机号码" == mobile_val){
            dialog_ok("请输入您的手机号码");
            return false;
        }
        if (!qrh.Util.isMobile(mobile_val)) {
            dialog_ok("请输入您的真实手机号码");
            mobile.focus();
            return false;
        }
        $.ajax({
            url: qscms.root + '?m=Home&c=Members&a=ajax_check',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: 'mobile', param:mobile_val},
            success: function(result) {
                if (!result.status) {
                    dialog_ok("您已是注册会员，请登录后操作");
                    return window.result = false; 
                }else{
                   return window.result =  true; 
                }
            }
        });
    }

    if(login_uid){
            $.ajax({
                url: "<?php echo U('Msg/save');?>",
                type: "post",
                dataType: "json",
                data: {
                    content: leave_msg_content,
                    info_uid: <?php echo ($info["uid"]); ?>,
                    uid: "<?php echo C('visitor.uid');?>",
                    info_id:<?php echo ($info["id"]); ?>,
                    public:$("#public").val(),
                },
                success: function (result){
                    if(result.code==1){
                        dialog_ok("您的留言已提交成功，请等待审核！");
                    }    
                }
            });
    }else{
        if(window.result===false){
            return false;  
        }
        $.ajax({
                url: "<?php echo U('Msg/guest_submit');?>",
                type: "post",
                dataType: "json",
                data:{
                content: leave_msg_content,
                name: name_val,
                mobile: mobile_val,
                info_id:<?php echo ($info["id"]); ?>,
                public:$("#public").val(),
                },
                success: function (result){
                    if(result.code==1){
                        dialog_ok("您的留言已提交成功，请等待审核！");
                    } 
                }
        });
    }
});
</script>
<script>
$(".detail-info-dl dd").tooltip({track:!0,tooltipClass:"custom-tooltip-style"});
</script>
<script type="text/javascript">
$('#send_to_email').live("click",function(){
var qsDialog = $(this).dialog({
title: '邮件发送',
loading: true,
showFooter: false,
yes: function() {
}
});
$.getJSON("/index.php?m=&c=Common&a=send_email&info_id=<?php echo ($info["id"]); ?>",function(result){
if(result.status == 1){
    qsDialog.setContent(result.data);
}else{
    qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
}
});
});
</script>
<script>
    $('#getcontact').click(function(){
        var qsDialog = $(this).dialog({
        title: '请登录',
        loading: true,
        showFooter: false,
        yes: function() {
        }
    });
    $.getJSON("/index.php?m=&c=AjaxPersonal&a=show_contact",function(result){
    if(result.status == 1){
        qsDialog.setContent(result.data);
    //qsDialog.showFooter(true);
    }else{
    qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
    }
    });
    });
</script>
<script>
    $('body #J_dialog_close').live("click",function(){
        $('.modal,.modal_backdrop').remove();
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    //右侧固定侧边栏
    $('#navRight').stickySidebar({
        sidebarTopMargin: 0,
        footerThreshold: 100
    });
});
</script>
<script>
var uid ='<?php echo C("visitor.uid");?>'
    $('#addfav').click(function(){
        if(!uid){
            var qsDialog = $(this).dialog({
                title: '请登录',
                loading: true,
                showFooter: false,
                yes: function() {
                }
            });
            $.getJSON("<?php echo U('AjaxPersonal/show_login');?>",function(result){
                if(result.status == 1){
                    qsDialog.setContent(result.data);
                }else{
                qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                }
            });
        }else{
            info_id = <?php echo ($info['id']); ?>;
            info_type = <?php echo ($info['type']); ?>;
            $.ajax({
                url:"<?php echo U('AjaxCommon/collection');?>",
                data:{'info_id':info_id,'uid':uid,'info_type':info_type},
                type:"post",
                dataType:"json",
                success:function(result){
                    if(result.status.msg==1){
                        var qsDialog = $(this).dialog({
                            title: '收藏',
                            loading: true,
                            showFooter: false,
                            yes: function() {
                            }
                        });
                        $.getJSON("<?php echo U('AjaxCommon/collection',array('status'=>1));?>",function(result){
                            if(result.status == 1){
                                qsDialog.setContent(result.data);
                            }else{
                            qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                            }
                        });
                    }else{
                        var qsDialog = $(this).dialog({
                            title: '收藏',
                            loading: true,
                            showFooter: false,
                            yes: function() {
                            }
                        });
                        $.getJSON("<?php echo U('AjaxCommon/collection',array('status'=>0));?>",function(result){
                            if(result.status == 1){
                                qsDialog.setContent(result.data);
                            }else{
                            qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                            }
                        });
                    }
                },
                error:function(err){
                    alert(err);
                }
            });
        }
    });

     $('#complaints').click(function(){
        if(!uid){
            var qsDialog = $(this).dialog({
                title: '请登录',
                loading: true,
                showFooter: false,
                yes: function() {
                }
            });
            $.getJSON("<?php echo U('AjaxPersonal/show_login');?>",function(result){
                if(result.status == 1){
                    qsDialog.setContent(result.data);
                }else{
                qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                }
            });
        }else{
            window.open("<?php echo U('Complaints/complaints',array('name_id'=>$info['uid'],'info_id'=>$info['id']));?>");  
        }
    });

</script>
<script>
    $('#exchange').click(function(){
        if(!uid){
            var qsDialog = $(this).dialog({
                title: '请登录',
                loading: true,
                showFooter: false,
                yes: function() {
                }
            });
            $.getJSON("<?php echo U('AjaxPersonal/show_login');?>",function(result){
                if(result.status == 1){
                    qsDialog.setContent(result.data);
                }else{
                qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                }
            });
        }else{
            friend_id = <?php echo ($info['uid']); ?>;
            $.ajax({
                url:"<?php echo U('AjaxCommon/exchange');?>",
                data:{'uid':uid,'friend_id':friend_id},
                type:"post",
                dataType:"json",
                success:function(result){
                    if(result.status.msg==1){
                        var qsDialog = $(this).dialog({
                            title: '收藏',
                            loading: true,
                            showFooter: false,
                            yes: function() {
                            }
                        });
                        $.getJSON("<?php echo U('AjaxCommon/exchange',array('status'=>1));?>",function(result){
                            if(result.status == 1){
                                qsDialog.setContent(result.data);
                            }else{
                            qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                            }
                        });
                    }else{
                        var qsDialog = $(this).dialog({
                            title: '收藏',
                            loading: true,
                            showFooter: false,
                            yes: function() {
                            }
                        });
                        $.getJSON("<?php echo U('AjaxCommon/exchange',array('status'=>0));?>",function(result){
                            if(result.status == 1){
                                qsDialog.setContent(result.data);
                            }else{
                            qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
                            }
                        });
                    }
                },
                error:function(err){
                    alert(err);
                }
            });
        }
        
    });
</script>
</body>
</html>