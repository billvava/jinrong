<?php if (!defined('THINK_PATH')) exit();?>
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
<link href="../public/css/personal/public.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/icon.css" rel="stylesheet" type="text/css" />
<script src="/static/js/plugin/jquery/1.5.2/jquery.min.js"></script>

<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.form.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/area.js" type="text/javascript" language="javascript"></script>

<script src="../public/js/multiselect.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/check_repair.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript" src="../public/js/dialog-plus-min.js"></script>


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
    'multi':false,
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

function i_attr_del(self,id){
    var o = $(self).parent().hide().parent().parent().prev();
    var val = o.val().split(',');
    var ids = new Array();
    for(var k in val){
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
<input type="hidden" name="info_type" value="1"/>

<?php if(ACTION_NAME=='zjxm_publish'): ?><dl>
<dt class="w150"><i>*</i>信息分类：</dt>
<dd>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>1));?>"' value="1" type="radio" checked=""> 项目融资</label>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>200));?>"' value="200" type="radio"> 资产交易</label>
<label><input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>700));?>"' value="700" type="radio"> 政府招商</label>
<label>
<input onclick='location.href="<?php echo U('Personal/zjxm_publish',array('add'=>2005));?>"' value="2005" type="radio"> 投资理财</label>
</dd>
</dl><?php endif; ?>

<dl>
<dt><i>*</i>信息标题：</dt>
<dd>
<input name="title" id="title" class="text wb70" data-rule="required|min_length[8]|max_length[30]" maxlength="30" min_length_err="请填写标题，8-30个汉字内" max_length_err="请填写标题，8-30个汉字内" holder="举例：广东某食品公司生产项目股权融资10万-2000万元" type="text" value="<?php echo ($info["title"]); ?>">
<em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>请填写信息标题</em>
<div style="color:#dc5c5c">标准：地区+某行业项目+融资方式+金额（附单位）</div></dd>
</dl>

<dl>
<dt><i>*</i>所在地区：</dt>
<dd>
<span id="last_area_iddivAreaSelect"></span>
<input type="text" class="hidea" id="last_area_id" name="last_area_id" value="<?php echo ($info["last_area_id"]); ?>" data-rule="required" btype="change">
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择所在地区</em>
</dd>
</dl>
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
<dl>
<dt>融资主体：</dt>
<dd>
<select name="xmrz_body" id="sel_xmrz_body" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['financing_body'])): foreach($category_list['financing_body'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['xmrz_body'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="xmrz_body_info">
<i class="icoPro16"></i>请选择融资主体</em>
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
<dt><i>*</i>所属行业：</dt>
<dd>
<select name="industry_id" id="sel_industry_id" data-rule="required" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['industry_id'])): foreach($category_list['industry_id'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['industry_id'] == $vo['c_id']): ?>selected=""<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>
</select>
<em class="hide" etype="error_info" id="industry_id_info">
<i class="icoPro16"></i>请选择所属行业</em>
</dd>
</dl>

<dl>
<dt><i>*</i>去年营业额：</dt>
<dd>
<input iname="去年营业额" name="xmrz_revenue" class="text w80 mr10" value="<?php echo ($info["xmrz_revenue"]); ?>" data-rule="required|regexp[num]|max_length[18]|greater[-1]" maxlength="18" type="text">
<select name="xmrz_revenue_unit" data-rule="require" data-merge="xmrz_revenue">
<option value="1" <?php if($info["xmrz_revenue_unit"] == '1' || $info["xmrz_revenue_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["xmrz_revenue_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select>
</dd>
</dl>

<dl>
<dt><i>*</i>企业当前净资产：</dt>
<dd>
<input iname="企业当前净资产" name="xmrz_asset" class="text w80 mr10" value="<?php echo ($info["xmrz_asset"]); ?>" data-rule="required|regexp[num]|max_length[18]" maxlength="18" type="text">
<select name="xmrz_asset_unit" data-rule="require" data-merge="xmrz_asset">
<option value="1" <?php if($info["xmrz_asset_unit"] == '1' || $info["xmrz_asset_unit"] ==''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["xmrz_asset_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select>
</dd>
</dl>

<dl>
<dt><i>*</i>融资用途：</dt>
<dd>
<input name="xmrz_usage" id="xmrz_usage" class="text wb70" value="<?php echo ($info["xmrz_usage"]); ?>" data-rule="required|min_length[4]|max_length[30]" maxlength="30" min_length_err="不少于4个字，末尾以句号结尾" max_length_err="不少于4个字，末尾以句号结尾" type="text"> <em class="pl5 hide" etype="error_info">
<i class="icoPro16"></i>不少于4个字，末尾以句号结尾
</em>
</dd>
</dl>

<dl>
<dt><i>*</i>融资金额：</dt>
<dd>
<input name="amount_interval_min" id="amount_interval_min" maxlength="10" class="text w80 mr5" value="<?php echo ($info["amount_interval_min"]); ?>" data-rule="required|regexp[num]|greater[0]|greater[min_max]|max_length[18]" data-name="amount_interval" data-merge="amount_interval_max,amount_interval_min" type="text">
<select name="amount_interval_min_unit" data-rule="require" data-merge="amount_interval_max,amount_interval_min">
<option value="1" <?php if($info["amount_interval_min_unit"] == '1'): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["amount_interval_min_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select>
-- 
<input name="amount_interval_max" id="amount_interval_max" maxlength="10" class="text w80 ml5 mr10" value="<?php echo ($info["amount_interval_max"]); ?>" data-rule="required|regexp[num]|greater[0]|greater[min_max]|max_length[18]" data-name="amount_interval" iname="融资金额" data-merge="amount_interval_max,amount_interval_min" type="text">
<select name="amount_interval_max_unit" data-rule="require" data-merge="amount_interval_max,amount_interval_min">
<option value="1" <?php if($info["amount_interval_max_unit"] == '1' || $info["amount_interval_max_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["amount_interval_max_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select>
<em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写融资金额</em>
</dd>
</dl>

<dl>
<dt>总投金额：</dt>
<dd>
<input iname="总投金额" name="amount" class="text w80 mr10" value="<?php echo ($info["amount"]); ?>" data-rule="regexp[num]|greater[0]|max_length[18]|greater[amount_interval_max]" maxlength="18" type="text">
<select name="amount_unit" data-rule="require" data-merge="amount">
<option value="1" <?php if($info["amount_unit"] == '1'): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["amount_unit"] == '10000'): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写总投金额</em>
</dd>
</dl>

<dl>
<dt><i>*</i>意向资金：</dt>
<dd>
<div class="pr">
<ul class="av-collapse clearfix" id="ul_list">
<li><label>
<input name="attxmrz_intention_div" value="617" class="checkbox" data-unique="1" type="checkbox">不限</label></li>
<?php if(is_array($category_list['funds_body'])): foreach($category_list['funds_body'] as $key=>$vo): ?><li><label><input name="attxmrz_intention_div" id="<?php echo ($vo["c_id"]); ?>_" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" type="checkbox"><?php echo ($vo["c_name"]); ?></label></li><?php endforeach; endif; ?>
</ul>
<a href="javascript:;" class="av-more" id="av_more">更多</a>
</div>
<input class="hidea" data-rule="required" name="xmrz_intention" id="xmrz_intention" value="<?php echo ($info["xmrz_intention"]); ?>" type="text">
<em class="hide" etype="error_info" id="attxmrz_intention_div-error"><i class="icoPro16"></i>请选择意向资金</em>
<script type="text/javascript">
    var val = $('#xmrz_intention').val();
    var sub_input = $('input[name="attxmrz_intention_div"]');
   sub_input.click(function(){
        if ($(this).attr('data-unique')=='1'){
            $(this).attr('checked') ==true ? sub_input.not('[data-unique=1]').attr('checked',false).attr('disabled', true): sub_input.removeAttr('disabled');
        }
        var _cval = sub_input.filter(':checked').map(function(){return $(this).val()}).get().join(',');
        $('#xmrz_intention').val(_cval);
   });
   var is_extend = false;
    if (val)
    sub_input.each(function(index){
        if ((','+val+',').indexOf(','+$(this).val()+',') >-1) {
            $(this).attr('checked', true);
            if (index>5) is_extend = true;
            if ($(this).attr('data-unique')=='1')
            {
                $(this).attr('checked') ==true ?
                sub_input.not('[data-unique=1]').attr('checked',false).attr('disabled', true)
                : sub_input.removeAttr('disabled');
            }
        }else{
          $(this).attr('checked', false);
        }
    });
    $("#av_more").click(function () {
        if ($(this).attr("class") == "av-more") {
            $("#ul_list").addClass("av-expand");
            $(this).addClass("av-less").text("收起");
        }
        else {
            $("#ul_list").removeClass("av-expand");
            $(this).removeClass("av-less").text("更多");
        }
    }).each(function(){
        if (is_extend === true)$(this).trigger('click');
    });
</script>
<script type="text/javascript">
    $('#J_btnyes_jobtag').live('click', function(event) {
            var checkedArray = $('.J_list_jobtag:checked');
            var codeArray = new Array();
            var titleArray = new Array();
            $.each(checkedArray, function(index, val) {
                codeArray[index] = $(this).data('code');
                titleArray[index] = $(this).data('title');
            });
            $('#J_showmodal_jobtag .J_resultcode_jobtag').val(codeArray.join(','));
            ;
            $('#J_showmodal_jobtag .J_resuletitle_jobtag').text(titleArray.length ? titleArray.join('+') : '请选择');
            $('#J_showmodal_jobtag .J_resuletitle_jobtag').attr('title', titleArray.length ? titleArray.join('+') : '请选择');
            removeModal();
        });
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>融资方式：</dt>
<dd>
<?php if(is_array($category_list['xmrz_type'])): foreach($category_list['xmrz_type'] as $key=>$vo): ?><label for="xmrz_type_<?php echo ($vo["c_id"]); ?>">
<input name="xmrz_type[]" id="xmrz_type_<?php echo ($vo["c_id"]); ?>" 
<?php if(!empty($vo["ext_form_id"])): ?>have_form_category_relative="1" form_category_id="<?php echo ($vo["ext_form_id"]); ?>"<?php endif; ?> value="<?php echo ($vo["c_id"]); ?>" <?php if($vo["data_rule"] == 1): ?>data-rule="required"<?php endif; ?> class="checkbox" type="checkbox"> <?php echo ($vo["c_name"]); ?></label><?php endforeach; endif; ?>
<em class="hide" etype="error_info"><i class="icoPro16"></i>请选择或填写融资方式</em>
<script>
$(function(){
var val = '<?php echo ($info["xmrz_type"]); ?>';
$('input[name="xmrz_type\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<script>
$(function(){
     var _v = $('input[name="xmrz_type\[\]"]');
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

<dl id="cat_5">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt><i>*</i>可承担最高利息：</dt>
<dd>
<input name="S21" id="S21" class="text w80 mr10" value="<?php echo ($info["s21"]); ?>" data-rule="required|regexp[num]|max_length[8]" maxlength="8" type="text"> 
%/年<em class="pl5 hide" etype="error_info" id="S21_info">
<i class="icoPro16"></i>请填写可承担最高利息</em>
</dd>
</dl>

<dl>
<dt><i>*</i>资金占用时长：</dt>
<dd>
<input name="S22_min" class="text w80 mr5" data-rule="required|regexp[intege1]|greater[min_max]|max_length[4]|greater[min_max]" maxlength="4" type="text" value="<?php echo ($info["s22_min"]); ?>"> 
-- 
<input name="S22_max" class="text w80 ml5 mr10" value="<?php echo ($info["s22_max"]); ?>" data-merge="S22_max,S22_min" iname="资金占用时长" data-rule="required|regexp[intege1]|greater[min_max]|max_length[4]|greater[min_max]" maxlength="4" type="text"> 

<select name="S22_unit">
<option value="M360" <?php if($info["s22_unit"] == 'M360'): ?>selected=""<?php endif; ?>>年</option>
<option value="M30" <?php if($info["s22_unit"] == 'M30'): ?>selected=""<?php endif; ?>>月</option>
<option value="M1" <?php if($info["s22_unit"] == 'M1' || $info.s22_unit==''): ?>selected=""<?php endif; ?>>天</option>
</select>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写时长，如1-2年</em>
</dd>
</dl>

<dl>
<dt>可提供风控：</dt>
<dd>

<label for="S23_620">
<input name="S23[]" id="S23_620" have_relative="1" relative_id="rel-23-111" value="620" class="checkbox" type="checkbox">
抵押</label>

<label for="S23_621">
<input name="S23[]" id="S23_621" value="621" class="checkbox" type="checkbox">
担保</label>

<label for="S23_622">
<input name="S23[]" id="S23_622" value="622" class="checkbox" type="checkbox">
信用</label>

<label for="S23_623">
<input name="S23[]" id="S23_623" extra="1" extra_id="extra_S23-623" value="623" class="checkbox" data-rule="" type="checkbox">
其它</label>

<input id="extra_S23-623" name="extra_S23[623]" style="display:none;" value="<?php echo ($info["extra_s23"]); ?>" type="text">
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写可提供风控</em>
</dd>
</dl>
<script>
$(function(){
     var _v = $('input[name="S23\[\]"]');
     if (_v.filter('[data-unique=1]').length >0){
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

<script>
$(function(){
var val = '<?php echo ($info["s23"]); ?>';
$('input[name="S23\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
<div style="display:none;" id="rel-23-111">
<dl>
<dt>抵押物类型：</dt>
<dd>
<label for="S24_624">
<input name="S24[]" id="S24_624" value="624" class="checkbox" type="checkbox">
固定资产</label>
<label for="S24_625">
<input name="S24[]" id="S24_625" value="625" class="checkbox" type="checkbox">
有价证券</label>
<label for="S24_626">
<input name="S24[]" id="S24_626" extra="1" extra_id="extra_S24-626" value="626" class="checkbox" data-rule="" type="checkbox">
其他资产</label>
<input id="extra_S24-626" name="extra_S24[626]" style="display:none;" value="<?php echo ($info["extra_s24"]); ?>" type="text">
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写抵押物类型</em>
<script>
$(function(){
var val = '<?php echo ($info["s24"]); ?>';
$('input[name="S24\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>抵押物市值：</dt>
<dd>
<input iname="抵押物市值" name="S25" class="text w80 mr10" value="<?php echo ($info["s25"]); ?>" data-rule="required|regexp[num]|max_length[18]" maxlength="18" type="text">
<select name="S25_unit" data-rule="require" data-merge="S25">
<option value="1" <?php if($info["s25_unit"] == 1 || $info["s25_unit"] == ''): ?>selected=""<?php endif; ?>>万元</option>
<option value="10000" <?php if($info["s25_unit"] == 10000): ?>selected=""<?php endif; ?>>亿元</option>
</select><em class="pl5 hide" etype="error_info"><i class="icoPro16"></i>请填写抵押物市值</em>
</dd>
</dl>
</div>

<dl>
<dt>还款来源：</dt>
<dd>
<label for="S26_627">
<input name="S26[]" id="S26_627" value="627" class="checkbox" type="checkbox">
销售回款</label>
<label for="S26_628">
<input name="S26[]" id="S26_628" extra="1" extra_id="extra_S26-628" value="628" class="checkbox" data-rule="" type="checkbox">
其它来源</label>
<input id="extra_S26-628" name="extra_S26[628]" style="display:none;" value="<?php echo ($info["extra_s26"]); ?>" type="text">
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写还款来源</em>
<script>
$(function(){
var val = '<?php echo ($info["s26"]); ?>';
$('input[name="S26\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
</dd>
</dl>
</div>
</dd>
</dl>

<dl id="cat_4">
<dt></dt>
<dd>
<div class="itemCase">
<dl>
<dt>项目所处阶段：</dt>
<dd>
<select name="xmgq_period" id="sel_xmgq_period" class="select">
<option value="">请选择</option>
<?php if(is_array($category_list['project_stage'])): foreach($category_list['project_stage'] as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>" <?php if($info['xmgq_period'] == $vo['c_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; ?>

</select>
<em class="hide" etype="error_info" id="xmgq_period_info">
<i class="icoPro16"></i>请选择项目所处阶段</em>
</dd>
</dl>

<dl>
<dt><i>*</i>资金方占股比例：</dt>
<dd>
<input name="S18_min" class="text w80 mr5" value="<?php echo ($info["s18_min"]); ?>" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
-- 
<input name="S18_max" class="text w80 ml5 mr10" value="<?php echo ($info["s18_max"]); ?>" data-merge="S18_max,S18_min" iname="资金方占股比例" data-rule="required|regexp[num]|greater[min_max]|max_length[8]|valmin[0]|valmax[100]" maxlength="8" type="text"> 
<input name="S18_unit" value="%" type="hidden">%
</dd>
</dl>

<dl>
<dt>投资退出方式：</dt>
<dd>
<label for="S19_635">
<input name="S19[]" id="S19_635" value="635" data_code="635" class="checkbox tcfs" type="checkbox">
IPO</label>
<label for="S19_636">
<input name="S19[]" id="S19_636" value="636" code="636" class="checkbox tcfs" type="checkbox">
股权转让</label>
<label for="S19_637">
<input name="S19[]" id="S19_637" value="637" data_code="637" class="checkbox tcfs" type="checkbox">
股份回购</label>
<label for="S19_638">
<input name="S19[]" id="S19_638" value="638" data_code="638" class="checkbox tcfs" type="checkbox">
公司清算</label>
<label for="S19_639">
<input name="S19[]" id="S19_639" extra="1" extra_id="extra_S19-639" value="639" class="checkbox tcfs" data-rule="" type="checkbox">
其它方式</label>
<input id="extra_S19-639" name="extra_S19[639]" style="display:none;margin-top:10px;" value="<?php echo ($info["extra_s19"]); ?>" type="text">
<input type="hidden" name="S19" id="S19" value="<?php echo ($info["s19"]); ?>"/>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写投资退出方式</em>
<?php if($info.s19): ?><script>
$(function(){
var val = '<?php echo ($info["s19"]); ?>';
$('input[name="S19\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script><?php endif; ?>
<script>
$(function(){
     var _v = $('input[name="S19\[\]"]');
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
<script type="text/javascript">
    $('.tcfs').live('click', function(event) {
            var checkedArray = $('.tcfs:checked');
            var codeArray = new Array();
            $.each(checkedArray, function(index, val) {
                codeArray[index] = $(this).val();
            });
            $('#S19').val(codeArray.join(','));
            ;
        });
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>最短退出年限：</dt>
<dd>
<input name="S20" id="S20" class="text w80 mr10" value="<?php echo ($info["s20"]); ?>" data-rule="required|regexp[intege1]|max_length[4]" maxlength="4" type="text"> 
年<em class="pl5 hide" etype="error_info" id="S20_info">
<i class="icoPro16"></i>请填写最短退出年限</em>
</dd>
</dl>
</div>
</dd>
</dl>

<dl>
<dt>可提供资料：</dt>
<dd>
<?php if(is_array($s11)): foreach($s11 as $key=>$vo): ?><label for="S11_<?php echo ($vo["c_id"]); ?>">
<input name="S11[]" id="S11_<?php echo ($vo["c_id"]); ?>" value="<?php echo ($vo["c_id"]); ?>" class="checkbox" type="checkbox">
<?php echo ($vo["c_name"]); ?></label><?php endforeach; endif; ?>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请选择或填写可提供资料</em>
<script>
$(function(){
var val = '<?php echo ($info["s11"]); ?>';
$('input[name="S11\[\]"]').each(function(){
    if ((','+val+',').indexOf(','+$(this).val()+',') >-1)$(this).attr('checked', true).trigger('click').attr('checked', true);
});
})
</script>
</dd>
</dl>

<dl>
<dt><i>*</i>项目概述：</dt>
<dd>
<textarea name="i_overview" rows="6" class="wb70" id="i_overview" data-rule="required|min_length[50]|max_length[1000]" maxlength="1000" min_length_err="必须大于50个并小于1000个汉字" max_length_err="必须大于50个并小于1000个汉字"><?php echo ($info["i_overview"]); ?>
</textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写项目概述</em>
<div style="color:#dc5c5c">项目背景+项目介绍+融资需求+详细用途</div>
</dd>
</dl>

<dl>
<dt>项目优势：</dt>
<dd>
<textarea name="i_introduce" rows="6" class="wb70" id="i_introduce" data-rule="max_length[5000]" maxlength="5000"><?php echo ($info["i_introduce"]); ?></textarea>
</dd>
</dl>

<dl>
<dt>其它备注：</dt>
<dd>
<textarea name="i_other_remark" rows="6" class="wb70" id="i_other_remark"><?php echo ($info['i_other_remark']); ?></textarea>
<em class="hide" etype="error_info">
<i class="icoPro16"></i>请填写其它备注</em></dd>
</dl>

<dl>
<dt>标签：</dt>
<dd>
<input name="i_keywords" id="i_keywords" class="text wb70" value="<?php echo ($info["i_keywords"]); ?>" data-rule="" type="text"><em class="pl5 hide" etype="error_info">
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

</dd>
</dl>

<dl>
<dt>商业计划书：</dt>
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
   if (data.code == 100){
       alert(data.error);
   } else if (data.code == 200) {
       $('#i_att_pic').each(function(){
            var val = $(this).val();
            val = val.split(',');
            val.push(data.aid);
            html = '<div><a href="'+data.file+'" target="_blank">'+file.name+'</a> <a class="m120" href="javascript:void(0);" onclick="i_attr_del(this,'+data.aid+');limiti_att();">删除</a></div>';
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
<input type="hidden" value="<?php echo ($info["i_att_other"]); ?>" name="i_att_other" id="i_att_other_pic" data-rule="regexp[rar]" >
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
$uploadify.fileSizeLimit = '30480';
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