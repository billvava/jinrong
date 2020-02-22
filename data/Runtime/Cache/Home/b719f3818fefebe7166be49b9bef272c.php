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
<link href="../public/css/personal/tzlc.css" rel="stylesheet" type="text/css" />
<link href="../public/css/fund_base.css" rel="stylesheet" type="text/css" />
<script src="/static/js/plugin/jquery/1.5.2/jquery.min.js"></script>
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/area.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/multiselect.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/check_repair.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/base.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.artDialog.js" type="text/javascript" language="javascript"></script>
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
<input type="hidden" name="info_type" value="2005"/>
<?php if(ACTION_NAME=='zjxm_publish'): ?><dl>
<dt class="w150"><i>*</i>信息分类：</dt>
<dd>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>1));?>"' value="1" type="radio"> 项目融资</label>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>200));?>"' value="200" type="radio"> 资产交易</label>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>700));?>"' value="700" type="radio"> 政府招商</label>
<label>
<input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>2005));?>"' value="2005" type="radio" checked=""> 投资理财</label>
</dd>
</dl><?php endif; ?>

<dl>
<dt><i>*</i>标题：</dt>
<dd>
<input name="title" id="title" class="text wb70" value="<?php echo ($info["title"]); ?>" data-rule="required|min_length[8]|max_length[30]" maxlength="30" min_length_err="请填写标题，8-30个汉字内" max_length_err="请填写标题，8-30个汉字内" holder="举例：广东某公司稳健型信托产品30万元起投，年化收益率9.7%" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写标题</em>
<div style="color:#dc5c5c">标准：地区+某公司+风险偏好+理财产品+产品投资门槛，预期收益</div></dd>
</dl>

<dl>
<dt><i>*</i>产品类型：</dt>
<dd>
<select name="tzlc_type" id="sel_tzlc_type" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['tzlc_type'])): foreach($category_list['tzlc_type'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" form_category_id="<?php echo ($vo["ext_form_id"]); ?>" <?php if($info['tzlc_type'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="tzlc_type_info">
<i class="icoPro16"></i>请选择产品类型</em>
<script>
$(function(){
$('#sel_tzlc_type').trigger('change');
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


<dl style="display:none;" id="cat_36">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>发行时间：</dt>
<dd>
<script type="text/javascript" src="../public/js/DatePicker/WdatePicker.js"></script>
<input name="S141_min" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s141_min"]); ?>" type="text">--<input name="S141_max" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s141_max"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择发行时间</em>
</dd>
</dl>

<dl>
<dt><i>*</i>发行机构：</dt>
<dd>
<select name="S142" id="sel_S142" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S142'])): foreach($category_list['S142'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s142'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
<option value="921" extra="1" extra_id="extra_S142-921">
其它信托
</option>
</select>

<input id="extra_S142-921" name="extra_S142[921]" style="display:none;" value="<?php echo ($info["extra_s142"]); ?>" type="text">
<em class="hide" etype="error_info" id="S142_info">
<i class="icoPro16"></i>请选择发行机构</em>
</dd>
</dl>

<dl>
<dt><i>*</i>预期收益率：</dt>
<dd>
<label for="S145_691">
<input name="S145[]" id="S145_691" have_relative="1" relative_id="rel-145-289" value="691" class="checkbox" type="checkbox">固定值</label>
<label for="S145_692">
<input name="S145[]" id="S145_692" have_relative="1" relative_id="rel-145-290" value="692" class="checkbox" data-rule="required" type="checkbox">浮动范围</label>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写预期收益率</em>
<?php if($info["s145"] != ''): ?><script>
$(function(){
var val = '<?php echo ($info["s145"]); ?>';
$('input[name="S145\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script><?php endif; ?>
<script>
$(function(){
     var _v = $('input[name="S145\[\]"]');
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
<div style="display:none;" id="rel-145-289">
<dl>
<dt><i>*</i>固定值：</dt>
<dd>
<input name="S143" id="S143" class="text w80 mr10" value="<?php echo ($info["s143"]); ?>" data-rule="required|regexp[num]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
%/年<em class="pl5 hide" etype="error_info" id="S143_info">
<i class="icoPro16"></i>请填写固定值</em>
</dd>
</dl>
</div>

<div style="display:none;" id="rel-145-290">
<dl>
<dt><i>*</i>浮动范围：</dt>
<dd>
<input name="S144_min" class="text w80 mr5" value="<?php echo ($info["s144_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S144_max" class="text w80 ml5 mr10" value="<?php echo ($info["s144_max"]); ?>" data-merge="S144_max,S144_min" iname="浮动范围" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text">
<input name="S144_unit" value="%/年" type="hidden">%/年
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写浮动范围</em>
</dd>
</dl>
</div>

<dl>
<dt>托管银行：</dt>
<dd>
<input name="S150" id="bank-S150" class="text wb30 ac_input" value="<?php echo ($info["s150"]); ?>" data-rule="max_length[20]" maxlength="20" autocomplete="off" type="text"> 
<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写托管银行</em>
<script type="text/javascript" src="../public/js/personal/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="../public/css/personal/jquery.autocomplete.css">
</dd>
</dl>

<dl>
<dt><i>*</i>发行规模：</dt>
<dd>
<select name="S151" id="sel_S151" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S151'])): foreach($category_list['S151'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s151'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S151_info">
<i class="icoPro16"></i>请选择发行规模</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_38">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>发行机构：</dt>
<dd>
<select name="S152" id="sel_S152" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S142'])): foreach($category_list['S142'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s152'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S152_info">
<i class="icoPro16"></i>请选择发行机构</em>
<script>
$(function(){
$('#sel_S152').trigger('change');
})
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>产品类型：</dt>
<dd>
<select name="S153" id="sel_S153" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S153'])): foreach($category_list['S153'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s153'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S153_info">
<i class="icoPro16"></i>请选择产品类型</em>
</dd>
</dl>

<dl>
<dt><i>*</i>投资方式：</dt>
<dd>
<select name="S154" id="sel_S154" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S154'])): foreach($category_list['S154'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s154'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S154_info">
<i class="icoPro16"></i>请选择投资方式</em>
</dd>
</dl>

<dl>
<dt>资金投向：</dt>
<dd>
<?php if(is_array($category_list['S155'])): foreach($category_list['S155'] as $key=>$vo): ?><label for="S155_<?php echo ($vo["c_id"]); ?>">
<input name="S155[]" id="S155_<?php echo ($vo["c_id"]); ?>" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" <?php if($vo["data_rule"] == 1): ?>data-rule=""<?php endif; ?> type="checkbox"><?php echo ($vo["c_name"]); ?></label><?php endforeach; endif; ?>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写资金投向</em>
<?php if($info["s155"] != ''): ?><script>
$(function(){
var val = '<?php echo ($info["s155"]); ?>';
$('input[name="S155\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script><?php endif; ?>
<script>
  $(function(){
     var _v = $('input[name="S155\[\]"]');
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
<dt><i>*</i>预期收益：</dt>
<dd>
<label for="S156_691">
<input name="S156[]" id="S156_691" have_relative="1" relative_id="rel-156-379" value="691" class="checkbox" type="checkbox">
固定值</label>
<label for="S156_692">
<input name="S156[]" id="S156_692" have_relative="1" relative_id="rel-156-380" value="692" class="checkbox" data-rule="required" type="checkbox">
浮动范围</label>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写预期收益</em>
<?php if($info["s156"] != ''): ?><script>
  $(function(){
  var val = '<?php echo ($info["s156"]); ?>';
  $('input[name="S156\[\]"]').each(function(){
      if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
  });
  })
</script><?php endif; ?>
<script>
  $(function(){
     var _v = $('input[name="S156\[\]"]');
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
<div style="display:none;" id="rel-156-379">
<dl>
<dt><i>*</i>固定值：</dt>
<dd>
<input name="S188" id="S188" class="text w80 mr10" value="<?php echo ($info["s188"]); ?>" data-rule="required|regexp[intege1]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
%/年<em class="pl5 hide" etype="error_info" id="S188_info">
<i class="icoPro16"></i>请填写固定值</em>
</dd>
</dl>
</div>

<div style="display:none;" id="rel-156-380">
<dl>
<dt><i>*</i>浮动范围：</dt>
<dd>
<input name="S189_min" class="text w80 mr5" value="<?php echo ($info["s189_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S189_max" class="text w80 ml5 mr10" value="<?php echo ($info["s189_max"]); ?>" data-merge="S189_max,S189_min" iname="浮动范围" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 

<input name="S189_unit" value="%/年" type="hidden">%/年
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写浮动范围</em>
</dd>
</dl>
</div>

<dl>
<dt><i>*</i>发行规模：</dt>
<dd>
<select name="S200" id="sel_S200" data-rule="required" class="select">
<?php if(is_array($category_list['S160'])): foreach($category_list['S160'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s200'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S200_info">
<i class="icoPro16"></i>请选择发行规模</em>
</dd>
</dl>

<dl>
<dt><i>*</i>发行时间：</dt>
<dd>
<input name="S157_min" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s157_min"]); ?>" type="text">
--
<input name="S157_max" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s157_max"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择发行时间</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_39">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>发行时间：</dt>
<dd>
<input type="text" name="S158_min" data-rule="required" class="text w80 mr10" readonly="" onClick="WdatePicker()" value="<?php echo ($info["s158_min"]); ?>">
--
<input type="text" name="S158_max" data-rule="required" class="text w80 mr10" readonly="" onClick="WdatePicker()" value="<?php echo ($info["s158_max"]); ?>">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择发行时间</em></dd>
</dl>

<dl>
<dt><i>*</i>预期收益率：</dt>
<dd>
<label for="S159_691">
<input name="S159[]" id="S159_691" type="checkbox" have_relative="1" relative_id="rel-159-385" value="691" class="checkbox"/> 固定值</label>
<label for="S159_692">
<input name="S159[]" id="S159_692" type="checkbox" have_relative="1" relative_id="rel-159-386" value="692" class="checkbox" data-rule="required"/> 浮动范围</label>
<em class="hide" etype="error_info" >
<i class="icoPro16"></i>请选择或填写预期收益率</em>
<script>
  $(function(){
    var val = '<?php echo ($info["s159"]); ?>';
    $('input[name="S159\[\]"]').each(function(){
        if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
    });
  })
</script>
<script>
$(function(){
     var _v = $('input[name="S159\[\]"]');
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

<div style="display:none;" id="rel-159-385">
<dl>
<dt><i>*</i> 固定值：</dt>
<dd>
<input type="text" name="S190" id="S190" class="text w80 mr10" value="<?php echo ($info["s190"]); ?>"  data-rule="required|regexp[num]|max_length[8]|valmin[0]|valmax[100]" maxlength=8> 
%/年<em class="pl5 hide" etype="error_info" id="S190_info">
<i class="icoPro16"></i>请填写固定值</em>
</dd>
</dl>
</div>

<div style="display:none;" id="rel-159-386">
<dl>
<dt><i>*</i>浮动范围：</dt>
<dd>
<input type='text' name="S191_min" class="text w80 mr5" value="<?php echo ($info["s191_min"]); ?>"  data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength=8 /> 
-- 
<input type="text" name="S191_max" class="text w80 ml5 mr10" value="<?php echo ($info["s191_max"]); ?>"  data-merge="S191_max,S191_min" iname="浮动范围"  data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength=8 /> 

<input type="hidden" name="S191_unit" value="%/年" />%/年
<em class="hide" etype="error_info" >
<i class="icoPro16"></i>请填写浮动范围</em>
</dd>
</dl>
</div>
            
<dl>
<dt>发行规模：</dt>
<dd>
<select name="S160" id="sel_S160"  class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S160'])): foreach($category_list['S160'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s160'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S160_info">
<i class="icoPro16"></i>请选择发行规模</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_40">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>发行时间：</dt>
<dd>
<input name="S161_min" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php if(!empty($info['s161_min'])): echo ($info["s161_min"]); endif; ?>" type="text">
--
<input name="S161_max" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s161_max"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择发行时间</em>
</dd>
</dl>

<dl>
<dt><i>*</i>产品种类：</dt>
<dd>
<select name="S162" id="sel_S162" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S162'])): foreach($category_list['S162'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s162'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S162_info">
<i class="icoPro16"></i>请选择产品种类</em>
</dd>
</dl>

<dl>
<dt><i>*</i>发行机构：</dt>
<dd>
<select name="S163" id="sel_S163" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S142'])): foreach($category_list['S142'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s163'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S163_info">
<i class="icoPro16"></i>请选择发行机构</em>
</dd>
</dl>

<dl>
<dt><i>*</i>管理形式：</dt>
<dd>
<select name="S164" id="sel_S164" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S164'])): foreach($category_list['S164'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s164'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S164_info">
<i class="icoPro16"></i>请选择管理形式</em>
</dd>
</dl>

<dl>
<dt><i>*</i>投资策略：</dt>
<dd>
<select name="S165" id="sel_S165" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S165'])): foreach($category_list['S165'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s165'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>

<em class="hide" etype="error_info" id="S165_info">
<i class="icoPro16"></i>请选择投资策略</em>
</dd>
</dl>

<dl>
<dt><i>*</i>封闭期：</dt>
<dd>
<input name="S166" id="S166" class="text w80 mr10" value="<?php echo ($info["s166"]); ?>" data-rule="required|regexp[intege1]|max_length[4]" maxlength="4" type="text">

<select name="S166_unit">
<option value="M30" <?php if($info["s166_unit"] == '' || $info["s66"] == 'M30'): ?>selected=""<?php endif; ?>>月</option>
<option value="M360" <?php if($info["s166_unit"] == 'M360'): endif; ?>>年</option>
</select>

<em class="pl5 hide" etype="error_info" id="S166_info">
<i class="icoPro16"></i>请填写封闭期</em>
</dd>
</dl>

<dl>
<dt>管理费率：</dt>
<dd>
<input name="S167" id="S167" class="text w80 mr10" value="<?php echo ($info["s167"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S167_info">
<i class="icoPro16"></i>请填写管理费率</em>
</dd>
</dl>

<dl>
<dt>托管银行：</dt>
<dd>
<input name="S168" id="S168" class="text w80 mr10" value="<?php echo ($info["s168"]); ?>" data-rule="max_length[20]" maxlength="20" type="text"> 
<em class="pl5 hide" etype="error_info" id="S168_info">
<i class="icoPro16"></i>请填写托管银行</em>
</dd>
</dl>

<dl>
<dt>银行保管费率：</dt>
<dd>
<input name="S169" id="S169" class="text w80 mr10" value="<?php echo ($info["s169"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S169_info">
<i class="icoPro16"></i>请填写银行保管费率</em>
</dd>
</dl>

<dl>
<dt>认购费率：</dt>
<dd>
<input name="S170" id="S170" class="text w80 mr10" value="<?php echo ($info["s170"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S170_info">
<i class="icoPro16"></i>请填写认购费率</em>
</dd>
</dl>

<dl>
<dt>赎回费率：</dt>
<dd>
<input name="S171" id="S171" class="text w80 mr10" value="<?php echo ($info["s171"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S171_info">
<i class="icoPro16"></i>请填写赎回费率</em>
</dd>
</dl>

<dl>
<dt>浮动管理费用：</dt>
<dd>
<input name="S172" id="S172" class="text w80 mr10" value="<?php echo ($info["s172"]); ?>" data-rule="regexp[num]|max_length[4]" maxlength="4" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S172_info">
<i class="icoPro16"></i>请填写浮动管理费用</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_41">
<dt></dt>
<dd>
<div class="itemCase">

<dl>
<dt><i>*</i>发行时间：</dt>
<dd>
<input name="S173_min" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s173_min"]); ?>" type="text">
--
<input name="S173_max" data-rule="required" class="text w80 mr10" readonly="" onclick="WdatePicker()" value="<?php echo ($info["s173_max"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择发行时间</em>
</dd>
</dl>

<dl>
<dt><i>*</i>预期收益率：</dt>
<dd>
<label for="S174_691">
<input name="S174[]" id="S174_691" have_relative="1" relative_id="rel-174-474" value="691" class="checkbox" type="checkbox">
    固定值</label>
<label for="S174_692">
    <input name="S174[]" id="S174_692" have_relative="1" relative_id="rel-174-475" value="692" class="checkbox" data-rule="required" type="checkbox">
    浮动范围</label>
<em class="hide" etype="error_info" data-msg="
请选择或填写预期收益率" style="display: none;"><i class="icoPro16"></i>请选择或填写预期收益率</em>
<script>
$(function(){
var val = '<?php echo ($info["s174"]); ?>';
$('input[name="S174\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
$(function(){
     var _v = $('input[name="S174\[\]"]');
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

<div style="display: none;" id="rel-174-474">
<dl>
<dt><i>*</i>固定值：</dt>
<dd>
<input name="S192" id="S192" class="text w80 mr10" value="<?php echo ($info["s192"]); ?>" data-rule="required|regexp[num]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
%/年<em class="pl5 hide" etype="error_info" id="S192_info">
<i class="icoPro16"></i>请填写固定值</em>
 </dd>
</dl>
</div>

<div style="display: none;" id="rel-174-475">
<dl>
<dt><i>*</i>浮动范围：</dt>
 <dd>
<input name="S193_min" class="text w80 mr5" value="<?php echo ($info["s193_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S193_max" class="text w80 ml5 mr10" value="<?php echo ($info["s193_max"]); ?>" data-merge="S193_max,S193_min" iname="浮动范围" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
<input name="S193_unit" value="%/年" type="hidden">%/年
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写浮动范围</em></dd>
</dl>
</div>

<dl>
<dt><i>*</i>基金规模：</dt>
<dd>
<input iname="基金规模" name="S175" class="text w80 mr10" value="<?php echo ($info["s175"]); ?>" data-rule="required|regexp[num]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="S175_unit" data-rule="require" data-merge="S175">
<option value="1" <?php if($info["s175_unit"] == 1 || $info["s175_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["s175_unit"] == 10000): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写基金规模</em>
</dd>
</dl>

<dl>
<dt><i>*</i>投资类型：</dt>
<dd>
<?php if(is_array($category_list['S176'])): foreach($category_list['S176'] as $key=>$vo): ?><label for="S176_<?php echo ($vo["c_id"]); ?>">
<input name="S176[]" id="S176_<?php echo ($vo["c_id"]); ?>" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" type="checkbox" <?php if($vo['data_rule'] == 1): ?>data-rule="required"<?php endif; ?>>
<?php echo ($vo["c_name"]); ?></label><?php endforeach; endif; ?>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写投资类型</em>
<script>
$(function(){
var val = '<?php echo ($info["s176"]); ?>';
$('input[name="S176\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
$(function(){
     var _v = $('input[name="S176\[\]"]');
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
<dt><i>*</i>投资行业：</dt>
<dd>
<a href="javascript:void(0);" id="S177_select_dialog" class="gBtn22"><i class="gBtn22Inner">选择投资行业</i></a>
<span id="S177_span"></span>
<div class="selectDialog hide" id="S177_selectDialog">
<ul class="clearfix">
<?php if(is_array($category_list['industry_id'])): foreach($category_list['industry_id'] as $key=>$vo): ?><li><label for="<?php echo ($vo["c_id"]); ?>_">
<input name="attS177_div" id="<?php echo ($vo["c_id"]); ?>_" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" type="checkbox"><?php echo ($vo["c_name"]); ?></label>
</li><?php endforeach; endif; ?>
</ul>

<div class="btnWrap pt10"><a href="javascript:void(0);" class="bBtn22"><i class="bBtn22Inner">确 定</i></a><a href="#" class="gBtn22 ml10"><i class="gBtn22Inner">取消</i></a></div>
</div>
<input class="hidea" data-rule="required" name="S177" id="S177" value="<?php echo ($info["s177"]); ?>" type="text">
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择投资行业</em>
<script>
$(function() {
    var _vinput = $('input[name="attS177_div"]');
    if (_vinput.filter('[data-unique=1]').length > 0)
    {
        _vinput.click(function(){
            if ($(this).attr('data-unique')=='1')
            {
                $(this).attr('checked') ==true ?
                _vinput.not('[data-unique=1]').attr('checked',false).attr('disabled', true)
                : _vinput.removeAttr('disabled');
            }
        });
    }
    $('#S177_select_dialog').bind('click', function () {
        qrh.cache.dialog=$.dialog({
        title: '选择投资行业',
        width:'240px',
        lock:true,
        fixed:true,
        content: document.getElementById('S177_selectDialog')
        });
        checkbox_selected();
    });
    $('#S177_selectDialog .btnWrap>.bBtn22').click(function(){
            var _val = new Array();
            var _txt = '';
            $('input[name="attS177_div"]').filter(':checked').each(function(){
                _val.push($(this).val());
                _txt += $(this).parent().text()+' ';
            });
            $('#S177').val(_val.length>0 ? (',' + _val.join(',') + ',') : '').trigger('blur');
            $('#S177_span').html(_txt).show();
            qrh.cache.dialog.close();
            return false;
        });
        $('#S177_selectDialog .btnWrap>.gBtn22').click(function(){checkbox_selected();qrh.cache.dialog.close();return false;});
        checkbox_selected();
});

function checkbox_selected() {
    var val = $('#S177').val();
    var _txt = '';
    _vinput = $('input[name="attS177_div"]');
    _vinput.each(function(){
        if ((','+val+',').indexOf(','+$(this).val()+',') >-1) {
            $(this).attr('checked', true);
            if ($(this).attr('data-unique')=='1')
                {
                    $(this).attr('checked') ==true ?
                    _vinput.not('[data-unique=1]').attr('checked',false).attr('disabled', true)
                    : _vinput.removeAttr('disabled');
                }
            _txt += $(this).parent().text();
        }else{
            $(this).attr('checked', false);
        }
    });
    $('#S177_span').html(_txt).show();
}
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>投资地区：</dt>
<dd>
<a href="javascript:void(0);" id="S178_select_dialog" class="gBtn22"><i class="gBtn22Inner">选择投资地区</i></a>
<span id="S178_span" style=""></span>
<div class="selectDialog hide" id="S178_selectDialog">
<ul class="clearfix">
<?php if(is_array($category_list['invest_area'])): foreach($category_list['invest_area'] as $key=>$vo): ?><li><label for="S178_<?php echo ($vo["c_id"]); ?>"><input name="S178_area[]" id="S178_<?php echo ($vo["c_id"]); ?>" value="<?php echo ($vo["c_id"]); ?>" type="checkbox"><?php echo ($vo["c_name"]); ?></label></li><?php endforeach; endif; ?>
</ul>
<div class="btnWrap pt10"><a href="javascript:void(0);" class="bBtn22"><i class="bBtn22Inner">确 定</i></a><a href="#" class="gBtn22 ml10"><i class="gBtn22Inner">取消</i></a></div>
</div>
<input class="hidea" id="S178" name="S178" data-rule="required" value="<?php echo ($info["s178"]); ?>" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择投资地区</em>
<script>
$(function(){
var _sel_container = $('#S178_span');
var _sel_input = $('#S178');
var _input_indu =  $('input[name="S178_area\[\]"]');

    $('#S178_select_dialog').bind('click', function () {
         qrh.cache.dialog=$.dialog({
        title: '选择投资地区',
        width:'240px',
        lock:true,
        fixed:true,
        content: document.getElementById('S178_selectDialog')
        });
        provSelectDialog();
    });

    $('#S178_selectDialog .btnWrap>.bBtn22').click(function(){
        var _val = new Array();
        var _sel = '';
        _input_indu.each(function(){
            if ($(this).attr('checked') == true) {
                _val.push($(this).val());
                _sel += $(this).parent().text()+'&nbsp;&nbsp;';
            }
        });
        _sel_container.html(_sel).show();
        _sel_input.val(_val.length>0 ? (',' + _val.join(',') + ',') : '').trigger('blur');
        qrh.cache.dialog.close();
        return false;
    });
    $('#S178_selectDialog .btnWrap>.gBtn22').click(function(){provSelectDialog();qrh.cache.dialog.close();return false;});

function provSelectDialog()
{
    _input_indu.removeAttr('checked');
    var val = _sel_input.val();
    var html = '';
    _input_indu.each(function(){
        if ((','+val+',').indexOf(','+$(this).val()+',') >-1) {
             $(this).attr('checked', true).trigger('click').attr('checked', true);
            html += $(this).parent().text()+'&nbsp;&nbsp;';
        }
    _sel_container.html(html).show();
    });
}
provSelectDialog();
})
</script>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_42">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>产品类型：</dt>
<dd>
<select name="S179" id="sel_S179" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S179'])): foreach($category_list['S179'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s179'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S179_info"><i class="icoPro16"></i>请选择产品类型</em>
</dd>
</dl>

<dl>
<dt>管理公司：</dt>
<dd>
<input name="S180" id="S180" class="text wb70" value="<?php echo ($info["s180"]); ?>" data-rule="max_length[30]" maxlength="30" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写管理公司</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_43">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>预期收益率：</dt>
<dd>
<label for="S181_691">
<input name="S181[]" id="S181_691" have_relative="1" relative_id="rel-181-491" value="691" class="checkbox" type="checkbox">
固定值</label>
<label for="S181_692">
<input name="S181[]" id="S181_692" have_relative="1" relative_id="rel-181-492" value="692" class="checkbox" data-rule="required" type="checkbox">
浮动范围</label>
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择或填写预期收益率</em>
<script>
$(function(){
var val = '<?php echo ($info["s181"]); ?>';
$('input[name="S181\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
  $(function(){
     var _v = $('input[name="S181\[\]"]');
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

<div style="display:none;" id="rel-181-491">
<dl>
<dt><i>*</i>固定值：</dt>
<dd>
<input name="S198" id="S198" class="text w80 mr10" value="<?php echo ($info["s198"]); ?>" data-rule="required|regexp[num]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
%/年<em class="pl5 hide" etype="error_info" id="S198_info">
<i class="icoPro16"></i>请填写固定值</em>
</dd>
</dl>
</div>

<div style="display:none;" id="rel-181-492">
<dl>
<dt><i>*</i>浮动范围：</dt>
<dd>
<input name="S199_min" class="text w80 mr5" value="<?php echo ($info["s199_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S199_max" class="text w80 ml5 mr10" value="<?php echo ($info["s199_max"]); ?>" data-merge="S199_max,S199_min" iname="浮动范围" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text">
<input name="S199_unit" value="%/年" type="hidden">%/年
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写浮动范围</em>
</dd>
</dl>
</div>

<dl>
<dt><i>*</i>产品类型：</dt>
<dd>
<select name="S182" id="sel_S182" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['S182'])): foreach($category_list['S182'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['s182'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="S182_info">
<i class="icoPro16"></i>请选择产品类型</em>
</dd>
</dl>

<dl>
<dt><i>*</i>托管费：</dt>
<dd>
<input name="S183" id="S183" class="text w80 mr10" value="<?php echo ($info["s183"]); ?>" data-rule="required|regexp[num]|max_length[8]" maxlength="8" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S183_info">
<i class="icoPro16"></i>请填写托管费</em>
</dd>
</dl>

<dl>
<dt>客户服务费用：</dt>
<dd>
<input name="S184" id="S184" class="text w80 mr10" value="<?php echo ($info["s184"]); ?>" data-rule="regexp[num]|max_length[8]" maxlength="8" type="text"> 
%<em class="pl5 hide" etype="error_info" id="S184_info">
<i class="icoPro16"></i>请填写客户服务费用</em>
</dd>
</dl>

<dl>
<dt>产品管理人：</dt>
<dd>
<input name="S185" id="S185" class="text w80 mr10" value="<?php echo ($info["s185"]); ?>" data-rule="max_length[10]" maxlength="10" type="text"> 
<em class="pl5 hide" etype="error_info" id="S185_info">
<i class="icoPro16"></i>请填写产品管理人</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_44">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>预期收益率：</dt>
<dd>
<label for="S186_691">
<input name="S186[]" id="S186_691" have_relative="1" relative_id="rel-186-493" value="691" class="checkbox" type="checkbox">
固定值</label>
<label for="S186_692">
<input name="S186[]" id="S186_692" have_relative="1" relative_id="rel-186-494" value="692" class="checkbox" data-rule="required" type="checkbox">
浮动范围</label>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写预期收益率</em>
<script>
$(function(){
var val = '<?php echo ($info["s186"]); ?>';
$('input[name="S186\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
  $(function(){
     var _v = $('input[name="S186\[\]"]');
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

<div style="display:none;" id="rel-186-493">
<dl>
<dt><i>*</i>固定值：</dt>
<dd>
<input name="S194" id="S194" class="text w80 mr10" value="<?php echo ($info["s194"]); ?>" data-rule="required|regexp[num]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> %/年
<em class="pl5 hide" etype="error_info" id="S194_info"><i class="icoPro16"></i>请填写固定值</em>
</dd>
</dl>
</div>


<div style="display:none;" id="rel-186-494">
<dl>
<dt><i>*</i>浮动范围：</dt>
<dd>
<input name="S195_min" class="text w80 mr5" value="<?php echo ($info["s195_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S195_max" class="text w80 ml5 mr10" value="<?php echo ($info["s195_max"]); ?>" data-merge="S195_max,S195_min" iname="浮动范围" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 

<input name="S195_unit" value="%/年" type="hidden">%/年
<em class="hide" etype="error_info"><i class="icoPro16"></i>请填写浮动范围</em>
</dd>
</dl>
</div>
</div>
</dd>
</dl>

<dl style="display:none;" id="cat_45">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>预期收益率：</dt>
<dd>
<label for="S187_691">
<input name="S187[]" id="S187_691" have_relative="1" relative_id="rel-187-495" value="691" class="checkbox" type="checkbox">
固定值</label>
<label for="S187_692">
<input name="S187[]" id="S187_692" have_relative="1" relative_id="rel-187-496" value="692" class="checkbox" data-rule="required" type="checkbox">
浮动范围</label>
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择或填写预期收益率</em>
<script>
  $(function(){
  var val = '<?php echo ($info["s187"]); ?>';
  $('input[name="S187\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
  });
  })
</script>
<script>
  $(function(){
     var _v = $('input[name="S187\[\]"]');
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

<div style="display:none;" id="rel-187-495">
<dl>
<dt><i>*</i>固定值：</dt>
<dd>
<input name="S196" id="S196" class="text w80 mr10" value="<?php echo ($info["s196"]); ?>" data-rule="required|regexp[num]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
%/年<em class="pl5 hide" etype="error_info" id="S196_info">
<i class="icoPro16"></i>请填写固定值</em></dd>
</dl>
</div>

<div style="display:none;" id="rel-187-496">
<dl>
<dt><i>*</i>浮动范围：</dt>
<dd>
<input name="S197_min" class="text w80 mr5" value="<?php echo ($info["s197_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S197_max" class="text w80 ml5 mr10" value="<?php echo ($info["s197_max"]); ?>" data-merge="S197_max,S197_min" iname="浮动范围" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text">
<input name="S197_unit" value="%/年" type="hidden">%/年
<em class="hide" etype="error_info"><i class="icoPro16"></i>请填写浮动范围</em>

</dd>
</dl>
</div>
</div>
</dd>
</dl>

<dl>
<dt><i>*</i>所在地区：</dt>
<dd>
<span id="last_area_iddivAreaSelect"></span>
<input class="hidea" id="last_area_id" name="last_area_id" value="<?php echo ($info["last_area_id"]); ?>" data-rule="required" btype="change" type="text">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择所在地区</em>
<script type="text/javascript">
var MultiSelectChange = function(cls){
$('#'+cls.hdId).trigger('blur');
}
var multiSelect         = new MultiSelect('last_area_iddivAreaSelect','last_area_id',dataMultiArea,dataAllArea);
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
<dt><i>*</i>风险偏好：</dt>
<dd>
<select name="xmlc_fxph" id="sel_xmlc_fxph" data-rule="required" class="select">
<option value="">请选择</option>
<option value="676" <?php if($info["xmlc_fxph"] == 676): ?>selected=""<?php endif; ?>>稳健性</option>
<option value="677" <?php if($info["xmlc_fxph"] == 677): ?>selected=""<?php endif; ?>>进取型</option>
</select>
<em class="hide" etype="error_info" id="xmlc_fxph_info">
<i class="icoPro16"></i>请选择风险偏好</em>
</dd>
</dl>

<dl>
<dt><i>*</i>投资门槛：</dt>
<dd>
<input iname="投资门槛" name="xmlc_tzmk" class="text w80 mr10" value="<?php echo ($info["xmlc_tzmk"]); ?>" data-rule="required|regexp[intege1]|greater[0]|max_length[18]" maxlength="18" type="text">
<select name="xmlc_tzmk_unit" data-rule="require" data-merge="xmlc_tzmk">

<option value="1" <?php if($info["xmlc_tzmk_unit"] == 1 || $info["xmlc_tzmk_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["xmlc_tzmk_unit"] == 10000): ?>selected=""<?php endif; ?>>亿元</option>

</select>
<em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写投资门槛</em>
</dd>
</dl>

<dl>
<dt><i>*</i>投资期限：</dt>
<dd>
<input name="xmlc_tzqx" id="xmlc_tzqx" class="text w80 mr10" value="<?php echo ($info["xmlc_tzqx"]); ?>" data-rule="required|regexp[intege1]" type="text"> 
<select name="xmlc_tzqx_unit">
<option value="M1" <?php if($info["xmlc_tzqx_unit"] == 'M1' || $info["xmlc_tzqx_unit"] == ''): ?>selected=""<?php endif; ?>>天</option>
<option value="M30" <?php if($info["xmlc_tzqx_unit"] == 'M30'): ?>selected=""<?php endif; ?>>月</option>
<option value="M360" <?php if($info["xmlc_tzqx_unit"] == 'M360'): ?>selected=""<?php endif; ?>>年</option>
</select>
<em class="pl5 hide" etype="error_info" id="xmlc_tzqx_info">
<i class="icoPro16"></i>请填写投资期限</em>
</dd>
</dl>

<dl>
<dt><i>*</i>产品概述：</dt>
<dd>
<textarea name="i_overview" rows="6" class="wb70" id="i_overview" data-rule="required|min_length[50]|max_length[1000]" maxlength="1000" min_length_err="必须大于50个并小于1000个汉字" max_length_err="必须大于50个并小于1000个汉字"><?php echo ($info["i_overview"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>
请填写产品概述</em>
<div style="color:#dc5c5c">产品规模+年化收益+资金用途+还款来源+风控措施</div></dd>
</dl>

<dl>
<dt>其它信息：</dt>
<dd>
<textarea name="i_other_remark" rows="6" class="wb70" id="i_other_remark" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["i_other_remark"]); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写其它信息</em>
</dd>
</dl>

<dl>
<dt>标签：</dt>
<dd>
<input name="i_keywords" id="i_keywords" class="text wb70" value="<?php echo ($info["i_keywords"]); ?>" data-rule="max_length[50]" maxlength="50" type="text">
<em class="pl5 hide" etype="error_info">
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

<dl><dt>附件：</dt>
<dd>
<div style="float:right;margin-right:450px;display:inline;">
注：附件大小2M以内
</div>
<input type="file" id="i_att" class="hide">
<input type="hidden" value="<?php echo ($info["i_att"]); ?>" name="i_att" id="i_att_pic"  data-rule="regexp[rar]" >
<div id="i_att_div" class="<?php if(empty($info['ext_i_att'])): ?>hide<?php endif; ?>">
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
$("#av_more").click(function (){
if ($(this).attr("class") == "av-more") {
    $("#ul_list").addClass("av-expand");
    $(this).addClass("av-less").text("收起");
}
else {
    $("#ul_list").removeClass("av-expand");
    $(this).removeClass("av-less").text("更多");
}
});
</script>
</body>
</html>