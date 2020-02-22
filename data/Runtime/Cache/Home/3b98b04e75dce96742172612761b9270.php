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
<link href="../public/css/personal/public.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/icon.css" rel="stylesheet" type="text/css" />
<script src="/static/js/plugin/jquery/1.5.2/jquery.min.js"></script>
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/area.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/multiselect.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/check_repair.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.form.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/base.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/zjxm.publish.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../public/js/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="../public/js/uploadify/uploadify.css">
<script>window.qrh_Config={page:'publish'};</script>
<script>
var $uploadify = {
    'formData'     : {
        "token" : "<?php echo md5($info['id'].time());?>",
        "times" : "<?php echo time();?>",
        'PHPSESSID':'<?php echo session_id();?>'
    },
    'auto':true,
    'multi'    : false,
    'removeTimeout' : 0,
    'fileSizeLimit' : '1024KB',
    'fileTypeDesc' : '上传文件',
    'fileTypeExts' : '*.gif;*.jpg;*.png,*.jpeg',
     'buttonImage' : '../public/js/uploadify/button.png',
     'height':22,
     'width':61,
    'swf': '../public/js/uploadify/uploadify.swf',
    'uploader' : '',
    'onUploadSuccess' : function(){}
};
function i_attr_del(self,id)
{
    var o = $(self).parent().hide().parent().parent().prev();
    var val = o.val().split(',');
    var ids = new Array();
    for(var k in val)
    {
        if (val[k] == id)continue;
        ids.push(val[k]);
    }
    o.val(ids.join(','));
}
</script>
<!--
<style>
.publicForm dl dd {
    padding-left: 110px;
}
</style>
-->
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
<div class="trjStep_no2">
<div class="trjStep">
<ol class="cols2 fn-clear">
<li class="step_1"><span>1.填写信息类型</span></li>
<li class="step_2"><span>2.填写详细信息</span></li>
</ol>
</div>
</div>
<div class="pri_info_ct">
<a href="#" class="fn-right ui-btn-small ui-btn-blue" target="_blank">发布信息指南</a>
<i class="icoBul16"></i>温馨提示：
<p class="pri_info_list">
1、为了保证您的信息能顺利通过我们的审核，请将信息的真实情况尽可能全面的发布出来！<br>
2、根据我们的长期跟踪统计，信息完整度越高，越容易获得目标客户的关注！<br>
3、信息完整度越高，将在我们的平台搜索结果排序靠前、获得推荐机会，以及享受增值服务试用机会！<br>
</p>
</div>
<div id="T-body">
<div class="p10">
<div class="publicForm">
<form action="<?php if(ACTION_NAME=='edit'): echo U('Home/personal/edit'); else: echo U('Home/personal/publish'); endif; ?>" accept-charset="utf-8" name="publishform" id="publishform" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
<input type="hidden" name="info_type" value="200"/>
<?php if(ACTION_NAME=='zjxm_publish'): ?><dl>
<dt class="w150"><i>*</i>信息分类：</dt>
<dd>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>1));?>"' value="1" type="radio"> 项目融资</label>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>200));?>"' value="200" type="radio" checked=""> 资产交易</label>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>700));?>"' value="700" type="radio"> 政府招商</label>
<label>
<input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>2005));?>"' value="2005" type="radio"> 投资理财</label>
</dd>
</dl><?php endif; ?>

<dl>
<dt><i>*</i>信息标题：</dt>
<dd>
<input name="title" id="title" class="text wb70" value="<?php echo ($info["title"]); ?>" data-rule="required|min_length[8]|max_length[30]" maxlength="30" min_length_err="请填写标题，8-30个汉字内" max_length_err="请填写标题，8-30个汉字内" holder="举例：广东某个人专利整体转让20万元；浙江某公司风力发电项目整体转让500万元" type="text">
<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写信息标题</em>
<div style="color:#dc5c5c">标准：地区+某资产主类型（公司/个人）+资产类别+转让方式+转让金额</div></dd>
</dl>

<dl>
<dt><i>*</i>所在地区：</dt>
<dd>
<span id="last_area_iddivAreaSelect"></span>
<input type="text" class="hidea" id="last_area_id" name="last_area_id" value="<?php echo ($info["last_area_id"]); ?>" data-rule="required" btype="change">
<em class="hide" etype="error_info" ><i class="icoPro16"></i>请选择所在地区</em>
<script type="text/javascript">
var MultiSelectChange = function(cls){
$('#'+cls.hdId).trigger('blur');
}
var multiSelect = new MultiSelect('last_area_iddivAreaSelect','last_area_id',dataMultiArea,dataAllArea);
multiSelect.pLabels  = '省,市,县/区';
multiSelect.pClass   = 'mr5';
multiSelect.pNames  = 'province_id,city_id,area_id';
multiSelect.pStart  = 1;
multiSelect.init(chinese_id);
multiSelect.select(<?php echo ($info["last_area_id"]); ?>);
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>交易类别：</dt>
<dd>
<select name="xmzc_type" id="sel_xmzc_type" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['trade_category'])): foreach($category_list['trade_category'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" form_category_id="<?php echo ($vo["ext_form_id"]); ?>" <?php if($info['xmzc_type'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="xmzc_type_info">
<i class="icoPro16"></i>请选择交易类别</em>
<script>
$(function(){
    $('#sel_xmzc_type').trigger('change');
})
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>开发商排名：</dt>
<dd>
<select name="developer_rank" id="sel_funds_body" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['developer_rank'])): foreach($category_list['developer_rank'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['developer_rank'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="funds_body_info">
<i class="icoPro16"></i>请选择开发商排名</em>
</dd>
</dl>

<dl>
<dt><i>*</i>开发商最高资质：</dt>
<dd>
<select name="developer_qualification" id="sel_funds_body" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['developer_qualification'])): foreach($category_list['developer_qualification'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['developer_qualification'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="funds_body_info">
<i class="icoPro16"></i>请选择开发商最高资质</em>
</dd>
</dl>

<dl>
<dt><i>*</i>开发所属阶段：</dt>
<dd>
<select name="development_phase" id="sel_funds_body" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['development_phase'])): foreach($category_list['development_phase'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['development_phase'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="funds_body_info">
<i class="icoPro16"></i>请选择开发所属阶段</em>
</dd>
</dl>

<dl>
<dt><i>*</i>项目获取方式：</dt>
<dd>
<select name="project_acquisition" id="sel_funds_body" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['project_acquisition'])): foreach($category_list['project_acquisition'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['project_acquisition'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="funds_body_info">
<i class="icoPro16"></i>请选择项目获取方式</em>
</dd>
</dl>

<dl>
<dt><i>*</i>交易方式：</dt>
<dd>
<?php if(is_array($category_list['trade_way'])): foreach($category_list['trade_way'] as $key=>$vo): ?><label for="trade_way_<?php echo ($vo["c_id"]); ?>">
<input name="trade_way[]" id="trade_way_<?php echo ($vo["c_id"]); ?>" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" <?php if($vo["data_rule"] == 1): ?>data-rule="required"<?php endif; ?> type="checkbox">
<?php echo ($vo["c_name"]); ?></label><?php endforeach; endif; ?>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写交易方式</em>
<script>
$(function(){
var val = '<?php echo ($info["trade_way"]); ?>';
$('input[name="trade_way\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<style>
.itemCase dl dd .wb70 {
    width: 300px;
}
</style>
<script>
$(function(){
     var _v = $('input[name="trade_way\[\]"]');
     if (_v.filter('[data-unique=1]').length > 0)
     {
           _v.click(function(){
                if ($(this).attr('data-unique')=='1')
                {
                    $(this).attr('checked') ==true ?
                    _v.not('[data-unique=1]').attr('checked',false).attr('disabled', true)
                    : _v.removeAttr('disabled');
                }
           });
      }
})
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>转让范围：</dt>
<dd>
<label for="transfer_type_648">
<input name="transfer_type[]" id="transfer_type_648" value="648" class="checkbox" type="checkbox">
整体</label>
<label for="transfer_type_649">
<input name="transfer_type[]" id="transfer_type_649" value="649" class="checkbox" data-rule="required" type="checkbox">
部份</label>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写转让范围</em>
<script>
$(function(){
var val = '<?php echo ($info["transfer_type"]); ?>';
$('input[name="transfer_type\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
$(function(){
     var _v = $('input[name="transfer_type\[\]"]');
     if (_v.filter('[data-unique=1]').length > 0)
     {
           _v.click(function(){
                if ($(this).attr('data-unique')=='1')
                {
                    $(this).attr('checked') ==true ?
                    _v.not('[data-unique=1]').attr('checked',false).attr('disabled', true)
                    : _v.removeAttr('disabled');
                }
           });
      }
})
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>资产估价：</dt>
<dd>
<input iname="资产估价" name="xmzc_assass" class="text w80 mr10" value="<?php echo ($info["xmzc_assass"]); ?>" data-rule="required|regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="xmzc_assass_unit" data-rule="require" data-merge="xmzc_assass">
<option value="1" <?php if($info["xmzc_assass_unit"] == 1 || $info["xmzc_assass_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["xmzc_assass_unit"] == 10000): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写资产估价</em>
</dd>
</dl>

<dl>
<dt><i>*</i>转让价格：</dt>
<dd>
<input iname="转让价格" name="transfer_price" class="text w80 mr10" value="<?php echo ($info["transfer_price"]); ?>" data-rule="required|regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="transfer_price_unit" data-rule="require" data-merge="transfer_price">
<option value="1" <?php if($info["transfer_price_unit"] == '1' || $info["transfer_price_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["transfer_price_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写转让价格</em>
</dd>
</dl>

<dl>
<dt><i>*</i>截止时间：</dt>
<dd>
<input name="transfer_dateend" data-rule="required|regexp[todaylate]" readonly="" class="text" onclick="WdatePicker()" value="<?php echo ($info["transfer_dateend"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择截止时间</em>
</dd>
</dl>

<dl style="display:none;" id="cat_10">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>用途：</dt>
<dd>
<?php if(is_array($category_list['S38'])): foreach($category_list['S38'] as $key=>$vo): ?><label for="S38_<?php echo ($vo["c_id"]); ?>">
<input name="S38[]" id="S38_<?php echo ($vo["c_id"]); ?>" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" <?php if($vo["data_rule"] == 1): ?>data-rule=""<?php endif; ?> type="checkbox">
<?php echo ($vo["c_name"]); ?></label><?php endforeach; endif; ?>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写用途</em>
<script>
$(function(){
var val = '<?php echo ($info["s38"]); ?>';
$('input[name="S38\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
$(function(){
     var _v = $('input[name="S38\[\]"]');
     if (_v.filter('[data-unique=1]').length > 0)
     {
           _v.click(function(){
                if ($(this).attr('data-unique')=='1')
                {
                    $(this).attr('checked') ==true ?
                    _v.not('[data-unique=1]').attr('checked',false).attr('disabled', true)
                    : _v.removeAttr('disabled');
                }
           });
      }
})
</script>
</dd>
</dl>

<dl>
<dt>建筑面积：</dt>
<dd>
<input name="S39" id="S39" class="text w80 mr10" value="<?php echo ($info["s39"]); ?>" data-rule="regexp[num]|max_length[8]" maxlength="8" type="text"> 
㎡<em class="pl5 hide" etype="error_info" id="S39_info">
<i class="icoPro16"></i>请填写建筑面积</em>
</dd>
</dl>

<dl>
<dt>周边环境：</dt>
<dd>
<textarea name="S40" rows="6" class="wb70" id="S40" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["s40"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写周边环境</em>
</dd>
</dl>

<dl>
<dt>配套设施：</dt>
<dd>
<textarea name="S41" rows="6" class="wb70" id="S41" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["s41"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写配套设施</em>
</dd>
</dl>

<dl>
<dt>使用年限：</dt>
<dd>
<input name="S42" id="S42" class="text w80 mr10" value="<?php echo ($info["s42"]); ?>" data-rule="regexp[intege1]|max_length[4]" maxlength="4" type="text"> 
年<em class="pl5 hide" etype="error_info" id="S42_info">
<i class="icoPro16"></i>请填写使用年限</em>
</dd>
</dl>

<dl>
<dt>建设时间：</dt>
<dd>
<script type="text/javascript" src="../public/js/DatePicker/WdatePicker.js"></script>
<input name="S43" data-rule="" class="text" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s43"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择建设时间</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_11">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>土地性质：</dt>
<dd>
<input name="S44" id="S44" class="text wb70" value="<?php echo ($info["s44"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写土地性质</em>
</dd>
</dl>

<dl>
<dt>土地类型：</dt>
<dd>
<input name="S45" id="S45" class="text wb70" value="<?php echo ($info["s45"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写土地类型</em>
</dd>
</dl>

<dl>
<dt>规划用途：</dt>
<dd>
<input name="S46" id="S46" class="text wb70" value="<?php echo ($info["s46"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写规划用途</em>
</dd>
</dl>

<dl>
<dt>土地面积：</dt>
<dd>
<input name="S47" id="S47" class="text wb70" value="<?php echo ($info["s47"]); ?>" data-rule="regexp[num]|max_length[30]" maxlength="30" type="text"> ㎡<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写土地面积</em>
</dd>
</dl>

<dl>
<dt>周边环境：</dt>
<dd>
<textarea name="S48" rows="6" class="wb70" id="S48" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["s48"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写周边环境</em>
</dd>
</dl>

<dl>
<dt>配套设施：</dt>
<dd>
<textarea name="S49" rows="6" class="wb70" id="S49" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["s49"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写配套设施</em>
</dd>
</dl>

<dl>
<dt>使用年限：</dt>
<dd>
<input name="S50" id="S50" class="text wb70" value="<?php echo ($info["s50"]); ?>" data-rule="regexp[intege1]|max_length[4]" maxlength="4" type="text"> 年<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写使用年限</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_12">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>用途：</dt>
<dd>
<input name="S51" id="S51" class="text wb70" value="<?php echo ($info["s51"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写用途</em>
</dd>
</dl>

<dl>
<dt>类别：</dt>
<dd>
<input name="S52" id="S52" class="text wb70" value="<?php echo ($info["s52"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写类别</em></dd>
</dl>

<dl>
<dt>购买时间：</dt>
<dd>
<input name="S53" data-rule="" class="text" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s53"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择购买时间</em>
</dd>
</dl>

<dl>
<dt>行驶里程：</dt>
<dd>
<input name="S54" id="S54" class="text wb70" value="<?php echo ($info["s54"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写行驶里程</em>
</dd>
</dl>

</div>
</dd>
</dl>
<dl style="display:none;" id="cat_13">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>设备用途：</dt>
<dd>
<select name="S55" id="sel_S55" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S55'])): foreach($category_list['S55'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s55'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S55_info">
<i class="icoPro16"></i>请选择设备用途</em>
</dd>
</dl>

<dl>
<dt>规格：</dt>
<dd>
<input name="S56" id="S56" class="text wb70" value="<?php echo ($info["s56"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写规格</em>
</dd>
</dl>

<dl>
<dt>数量：</dt>
<dd>
<input name="S57" id="S57" class="text wb70" value="<?php echo ($info["s57"]); ?>" data-rule="regexp[intege1]|max_length[30]" maxlength="30" type="text">
<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写数量</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_14">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>面值：</dt>
<dd>
<input iname="面值" name="S58" class="text w80 mr10" value="<?php echo ($info["s58"]); ?>" data-rule="regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="S58_unit" data-rule="require" data-merge="S58">
<option value="1" <?php if($info["s58_unit"] == '' || $info["s58_unit"] == 1): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["s58_unit"] == 10000): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写面值</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_15">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>票据面值：</dt>
<dd>
<input iname="票据面值" name="S59" class="text w80 mr10" value="<?php echo ($info["s59"]); ?>" data-rule="regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="S59_unit" data-rule="require" data-merge="S59">
<option value="1" <?php if($info["s59_unit"] == '1' || $info["s59unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["s59_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select>
<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写票据面值</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_16">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>面值：</dt>
<dd>
<input iname="面值" name="S60" class="text w80 mr10" value="<?php echo ($info["s60"]); ?>" data-rule="regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="S60_unit" data-rule="require" data-merge="S60">
<option value="1" <?php if($info["s60_unit"] == '1' || $info["s60_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["s60_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select>
<em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写面值</em>
</dd>
</dl>

<dl>
<dt>分类：</dt>
<dd>
<select name="S61" id="sel_S61" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S61'])): foreach($category_list['S61'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s61'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S61_info">
<i class="icoPro16"></i>请选择分类</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_17">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>分类：</dt>
<dd>
<select name="S62" id="sel_S62" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S62'])): foreach($category_list['S62'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s62'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S62_info">
<i class="icoPro16"></i>请选择分类</em>
</dd>
</dl>

</div>
</dd>
</dl>
<dl style="display:none;" id="cat_18">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>受让方资格：</dt>
<dd>
<input name="S63" id="S63" class="text wb70" value="<?php echo ($info["s63"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写受让方资格</em>
</dd>
</dl>

<dl>
<dt>资产性质：</dt>
<dd>
<input name="S64" id="S64" class="text wb70" value="<?php echo ($info["s64"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写资产性质</em>
</dd>
</dl>

<dl>
<dt>转让份额：</dt>
<dd>
<input name="S65" id="S65" class="text wb70" value="<?php echo ($info["s65"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写转让份额</em>
</dd>
</dl>

</div>
</dd>
</dl>
<dl style="display:none;" id="cat_19">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>采矿权证：</dt>
<dd>
<input name="S66" id="S66" class="text wb70" value="<?php echo ($info["s66"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写采矿权证</em></dd>
</dl>

<dl>
<dt>探矿权证：</dt>
<dd>
<input name="S67" id="S67" class="text wb70" value="<?php echo ($info["s67"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写探矿权证</em></dd>
</dl>

<dl>
<dt>报告储量：</dt>
<dd>
<input name="S69" id="S69" class="text wb70" value="<?php echo ($info["s69"]); ?>" data-rule="regexp[num]|max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写报告储量</em></dd>
</dl>

<dl>
<dt>实际储量：</dt>
<dd>
<input name="S70" id="S70" class="text wb70" value="<?php echo ($info["s70"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写实际储量</em></dd>
</dl>

<dl>
<dt>保有储量：</dt>
<dd>
<input name="S71" id="S71" class="text wb70" value="<?php echo ($info["s71"]); ?>" data-rule="regexp[num]|max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写保有储量</em></dd>
</dl>

<dl>
<dt>分类：</dt>
<dd>
<select name="S72" id="sel_S72" class="select">
<option value="">请选择</option>
<option value="528" <?php if($info["s72"] == 528): ?>selected=''<?php endif; ?>>金属</option>
<option value="529" <?php if($info["s72"] == 529): ?>selected=''<?php endif; ?>>非金属</option>
</select>
<em class="hide" etype="error_info" id="S72_info">
<i class="icoPro16"></i>请选择分类</em>
</dd>
</dl>


</div>
</dd>
</dl>
<dl style="display:none;" id="cat_20">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>使用期限：</dt>
<dd>
<input name="S73" id="S73" class="text w80 mr10" value="<?php echo ($info["s73"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
<select name="S73_unit">
<option value="M30" <?php if($info["s73_unit"] == 'M30' || $info["s73_unit"] == ''): ?>selected=""<?php endif; ?>>月</option>
<option value="M360" <?php if($info["s73_unit"] =='M360'): ?>selected=""<?php endif; ?>>年</option>
</select>
<em class="pl5 hide" etype="error_info" id="S73_info">
<i class="icoPro16"></i>请填写使用期限</em>
</dd>
</dl>

<dl>
<dt>面积：</dt>
<dd>
<input name="S74" id="S74" class="text w80 mr10" value="<?php echo ($info["s74"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
㎡<em class="pl5 hide" etype="error_info" id="S74_info">
<i class="icoPro16"></i>请填写面积</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_21">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>规格：</dt>
<dd>
<input name="S75" id="S75" class="text wb70" value="<?php echo ($info["s75"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写规格</em></dd>
</dl>

<dl>
<dt>数量：</dt>
<dd>
<input name="S76" id="S76" class="text wb70" value="<?php echo ($info["s76"]); ?>" data-rule="regexp[intege1]|max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写数量</em></dd>
</dl>

<dl>
<dt>生产时间：</dt>
<dd>
<input name="S77" data-rule="" class="text" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s77"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择生产时间</em>
</dd>
</dl>

<dl>
<dt>分类：</dt>
<dd>
<select name="S78" id="sel_S78" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S78'])): foreach($category_list['S78'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s78'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S78_info">
<i class="icoPro16"></i>请选择分类</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_22">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>市场估值：</dt>
<dd>
<input iname="市场估值" name="S79" class="text w80 mr10" value="<?php echo ($info["s79"]); ?>" data-rule="regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="S79_unit" data-rule="require" data-merge="S79">
<option value="1" <?php if($info["s79_unit"] == '' || $info["s79_unit"] == 1): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["s79_unit"] == 10000): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写市场估值</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_23">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>经营期限：</dt>
<dd>
<input name="S80" id="S80" class="text w80 mr10" value="<?php echo ($info["s80"]); ?>" data-rule="regexp[intege1]|max_length[4]" maxlength="4" type="text"> 
<select name="S80_unit">
<option value="M360"<?php if($info["s80_unit"] == 'M360'): ?>selected=""<?php endif; ?>>年</option>
<option value="M30"<?php if($info["s80_unit"] == 'M30'): ?>selected=""<?php endif; ?>>月</option>
</select>
<em class="pl5 hide" etype="error_info" id="S80_info">
<i class="icoPro16"></i>请填写经营期限</em>
</dd>
</dl>

</div>
</dd>
</dl>

<dl>
<dt><i>*</i>资产概况：</dt>
<dd>
<textarea name="i_overview" rows="6" class="wb70" id="i_overview" data-rule="required|min_length[50]|max_length[1000]" maxlength="1000" min_length_err="必须大于50个并小于1000个汉字" max_length_err="必须大于50个并小于1000个汉字"><?php echo ($info["i_overview"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写资产概况</em>
<div style="color:#dc5c5c">请介绍具体内容（比如：专利、经营权、具体项目等情况）</div></dd>
</dl>

<dl>
<dt>其它备注：</dt>
<dd>
<textarea name="i_other_remark" rows="6" class="wb70" id="i_other_remark" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["i_other_remark"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写其它备注</em></dd>
</dl>

<dl>
<dt>标签：</dt>
<dd>
<input name="i_keywords" id="i_keywords" class="text wb70" value="<?php echo ($info["i_keywords"]); ?>" data-rule="" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写关键词多个以“，”隔开
</em>
</dd>
</dl>

<dl>
<dt>缩略图：</dt>
<dd>
<div style="float:right;margin-right:450px;display:inline;">
注：图片大小1M以内
</div>
<input type="file" id="i_pic" class="hide">
<input type="hidden" value="<?php echo ($info["i_pic"]); ?>" name="i_pic" id="i_pic_pic"  data-rule="regexp[picture]" >
<div id="i_pic_div" class="<?php if(empty($info['ext_i_pic'])): ?>hide<?php endif; ?>">
<span>
<?php if(is_array($info['ext_i_pic'])): $i = 0; $__LIST__ = $info['ext_i_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div><a href="<?php echo ($vo["path"]); ?>" target="_blank"><?php echo ($vo["memo"]); ?></a><a class="m120" href="javascript:void(0);" onclick="i_attr_del(this,<?php echo ($vo["id"]); ?>)">删除</a></div><?php endforeach; endif; else: echo "" ;endif; ?>
</span>
</div>
<em class="alert ml10 error_info" etype="error_info" id="i_pic_info"></em>
<script type="text/javascript">
var i_picuploadLimit = 10;
function limiti_pic(){
  }
$(function(){

$uploadify.formData.filename = 'i_pic';
$uploadify.formData.attach_type = 'zjxm_image';
$uploadify.fileTypeExts = '*.jpg;*.bmp;.gif;*.jpeg;*.png';
$uploadify.fileSizeLimit='1024KB';
$uploadify.uploader = "<?php echo U('Upload/attach_upload');?>";
$uploadify.uploadLimit=i_picuploadLimit;

$uploadify.onSWFReady = function(){
  limiti_pic();
}
$uploadify.onUploadSuccess = function(file, data, response) {
   if (!data) {
       alert('上传失败');
       return;
   }
   data = $.parseJSON(data);
   if (data.code == 100) {
       alert(data.error);
   } else if (data.code == 200) {
       $('#i_pic_pic').each(function(){
            var val = $(this).val();
            val = val.split(',');
            val.push(data.aid);
            html = '<div><a href="'+data.file+'" target="_blank">'+file.name+'</a> <a  class="m120" href="javascript:void(0);" onclick="i_attr_del(this,'+data.aid+');limiti_pic();">删除</a></div>';
            val = val.join(',');
            $(this).val(/^[\d|,]+$/.test(val) ? val : '').next().show().find('span').append(html);
       });
       limiti_pic();
   }
};
$('#i_pic').uploadify($uploadify);

})
</script>
</dd>
</dl>

<dl>
<dt>商业计划书：</dt>
<dd>
 <div style="float:right;margin-right:450px;display:inline;">
注：附件大小2M以内
</div>
<input type="file" id="i_att" class="<?php if(empty($info['ext_i_att'])): ?>hide<?php endif; ?>">
<input type="hidden" value="<?php echo ($info["i_att"]); ?>" name="i_att" id="i_att_pic"  data-rule="regexp[rar]" >
<div id="i_att_div" class="hide">
<span>
<?php if(is_array($info['ext_i_att'])): $i = 0; $__LIST__ = $info['ext_i_att'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div><a href="<?php echo ($vo["path"]); ?>" target="_blank"><?php echo ($vo["memo"]); ?></a><a class="m120" href="javascript:void(0);" onclick="i_attr_del(this,<?php echo ($vo["id"]); ?>)">删除</a></div><?php endforeach; endif; else: echo "" ;endif; ?>
</span>
</div>
<em class="alert ml10 error_info" etype="error_info" id="i_att_info"></em>
<script type="text/javascript">
var i_attuploadLimit = 3;
function limiti_att(){
  }
$(function(){

$uploadify.formData.filename = 'i_att';
$uploadify.formData.attach_type = 'zjxm_file';
$uploadify.fileTypeExts = '*.zip;*.rar;.tgz;*.doc;*.docx;*.xls;*.xlsx;*.pdf;*.ppt;*.pptx';
$uploadify.fileSizeLimit='2048KB';
$uploadify.uploader = "<?php echo U('Upload/attach_upload');?>";
$uploadify.uploadLimit=i_attuploadLimit;

$uploadify.onSWFReady = function(){
  limiti_att();
}
$uploadify.onUploadSuccess = function(file, data, response) {
   if (!data) {
       alert('上传失败');
       return;
   }
   data = $.parseJSON(data);
   if (data.code == 100) {
       alert(data.error);
   } else if (data.code == 200) {
       $('#i_att_pic').each(function(){
            var val = $(this).val();
            val = val.split(',');
            val.push(data.aid);
            html = '<div><a href="'+data.file+'" target="_blank">'+file.name+'</a> <a  class="m120" href="javascript:void(0);" onclick="i_attr_del(this,'+data.aid+');limiti_att();">删除</a></div>';
            val = val.join(',');
            $(this).val(/^[\d|,]+$/.test(val) ? val : '').next().show().find('span').append(html);
       });
       limiti_att();
   }
};
$('#i_att').uploadify($uploadify);

})
</script>
</dd>
</dl>

<dl>
<dt>路演PPT：</dt>
<dd>
<div style="float:right;margin-right:450px;display:inline;">
注：附件大小2M以内
</div>
<input type="file" id="i_att_ppt" class="hide">
<input type="hidden" value="<?php echo ($info["i_att_ppt"]); ?>" name="i_att_ppt" id="i_att_ppt_pic"  data-rule="regexp[rar]" >
<div id="i_att_ppt_div" class="<?php if(empty($info['ext_i_att_ppt'])): ?>hide<?php endif; ?>">
<span>
<?php if(is_array($info['ext_i_att_ppt'])): $i = 0; $__LIST__ = $info['ext_i_att_ppt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div><a href="<?php echo ($vo["path"]); ?>" target="_blank"><?php echo ($vo["memo"]); ?></a><a class="m120" href="javascript:void(0);" onclick="i_attr_del(this,<?php echo ($vo["id"]); ?>)">删除</a></div><?php endforeach; endif; else: echo "" ;endif; ?>
</span>
</div>
<em class="alert ml10 error_info" etype="error_info" id="i_att_ppt_info"></em>
<script type="text/javascript">
var i_att_pptuploadLimit = 3;
function limiti_att_ppt(){
  }
$(function(){

$uploadify.formData.filename = 'i_att_ppt';
$uploadify.formData.attach_type = 'zjxm_file';
$uploadify.fileTypeExts = '*.zip;*.rar;.tgz;*.doc;*.docx;*.xls;*.xlsx;*.pdf;*.ppt;*.pptx';
$uploadify.uploader = "<?php echo U('Upload/attach_upload');?>";
$uploadify.uploadLimit=i_att_pptuploadLimit;

$uploadify.onSWFReady = function(){
  limiti_att_ppt();
}
$uploadify.onUploadSuccess = function(file, data, response) {
   if (!data) {
       alert('上传失败');
       return;
   }
   data = $.parseJSON(data);
   if (data.code == 100) {
       alert(data.error);
   } else if (data.code == 200) {
       $('#i_att_ppt_pic').each(function(){
            var val = $(this).val();
            val = val.split(',');
            val.push(data.aid);
            html = '<div><a href="'+data.file+'" target="_blank">'+file.name+'</a> <a  class="m120" href="javascript:void(0);" onclick="i_attr_del(this,'+data.aid+');limiti_att_ppt();">删除</a></div>';
            val = val.join(',');
            $(this).val(/^[\d|,]+$/.test(val) ? val : '').next().show().find('span').append(html);
       });
       limiti_att_ppt();
   }
};
$('#i_att_ppt').uploadify($uploadify);

})
</script>
</dd>
</dl>

<dl>
<dt>其他附件：</dt>
<dd>
<div style="float:right;margin-right:450px;display:inline;">
注：附件大小2M以内
</div>
<input type="file" id="i_att_other" class="hide">
<input type="hidden" value="<?php echo ($info["i_att_other"]); ?>" name="i_att_other" id="i_att_other_pic"  data-rule="regexp[rar]" >
<div id="i_att_other_div" class="<?php if(empty($info['ext_i_att_other'])): ?>hide<?php endif; ?>">
<span>
<?php if(is_array($info['ext_i_att_other'])): $i = 0; $__LIST__ = $info['ext_i_att_other'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div><a href="<?php echo ($vo["path"]); ?>" target="_blank"><?php echo ($vo["memo"]); ?></a><a class="m120" href="javascript:void(0);" onclick="i_attr_del(this,<?php echo ($vo["id"]); ?>)">删除</a></div><?php endforeach; endif; else: echo "" ;endif; ?>
</span>
</div>
<em class="alert ml10 error_info" etype="error_info" id="i_att_other_info"></em>
<script type="text/javascript">
var i_att_otheruploadLimit = 3;
function limiti_att_other(){

}
$(function(){
$uploadify.formData.filename = 'i_att_other';
$uploadify.formData.attach_type = 'zjxm_file';
$uploadify.fileTypeExts = '*.zip;*.rar;.tgz;*.doc;*.docx;*.xls;*.xlsx;*.pdf;*.ppt;*.pptx';
$uploadify.uploader = "<?php echo U('Upload/attach_upload');?>";
$uploadify.uploadLimit=i_att_otheruploadLimit;
$uploadify.onSWFReady = function(){
  limiti_att_other();
}
$uploadify.onUploadSuccess = function(file, data, response) {
   if (!data) {
       alert('上传失败');
       return;
   }
   data = $.parseJSON(data);
   if (data.code == 100) {
       alert(data.error);
   } else if (data.code == 200) {
       $('#i_att_other_pic').each(function(){
            var val = $(this).val();
            val = val.split(',');
            val.push(data.aid);
            html = '<div><a href="'+data.file+'" target="_blank">'+file.name+'</a> <a  class="m120" href="javascript:void(0);" onclick="i_attr_del(this,'+data.aid+');limiti_att_other();">删除</a></div>';
            val = val.join(',');
            $(this).val(/^[\d|,]+$/.test(val) ? val : '').next().show().find('span').append(html);
       });
       limiti_att_other();
   }
};
$('#i_att_other').uploadify($uploadify);
})
</script>
</dd>
</dl>

<dl>
<dt></dt>
<dd class="mt10 mb10">
<a href="javascript:void(0);" class="ui-btn-big ui-btn-blue fn-mr-10" id="form_publish">立即发布项目信息</a>
<!--
<a href="javascript:void(0);" id="form_publish_preview" class="ui-btn-big ui-btn-preview fn-mr-10">
预 览
</a>
<a href="javascript:void(0);" id="form_publish_status" class="ui-btn-big ui-btn-gray">
保存暂不发布
</a>
-->
</dd>
</dl>
<input id="delfiles" name="delfiles" type="hidden">
</form>
</div>
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
<script src="../public/js/publish.js"></script>
<script type="text/javascript">
$(function(){
     frmData=$('#publishform').serialize();
});
</script>
</body>
</html>