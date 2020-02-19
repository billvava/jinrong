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
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
<script src="../public/js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
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
<div class="userbox">
<div class="td1 substring" style="width: 205px;"><strong><?php if(date('a') == 'am'): ?>上午<?php else: ?>下午<?php endif; ?>好，<?php echo ($user_info['username']); ?></strong></div>
<div class="update_time">上次登录时间:
<!--<?php echo fdate($user_info['last_login_time']);?>--><?php echo date('Y-m-d H:i:s',$visitor['last_login_time']);?>
</div>
<?php if(!empty($wx_status)): if(empty($qrcode)): ?><div class="td4 ok link_blue"><a href="<?php echo U('personal/user_safety');?>">已绑定微信</a></div>
<?php else: ?>
<div class="td4 link_gray6">
<a href="javascript:;" class="bind_wx">未绑定微信</a>
<div class="popWeixin" id="J_popWeixin">
<div><div class="qrarrow"></div></div>
<div><a class="close" href="javascript:void(0)">×</a></div>
<div class="qrimg"><?php echo ($qrcode); ?></div>
<div class="clear"></div>
</div>
</div><?php endif; endif; ?>
<div class="clear"></div>
</div>
<!--结束 -->

<div class="infobox">
<div class="picbox">
<div class="photo"><a href="<?php echo U('personal/user_avatar');?>"><img src="<?php echo ($visitor['avatars']); ?>?<?php echo time();?>" border="0"/></a></div>
<div class="txt link_blue">头像修改</div>
</div>
<div class="clear"></div>

<div class="fl w300">
<ul>
<li><label class="baseinfo-label">资料完整度：</label>
<span class="baseinfo-value baseinfo-integrity">
<strong class="popover-part ui-text-blue" id="Data-integrity" cont=" 低于8%的同行，请尽快完善资料。">
73分</strong>
<a href="<?php echo U('home/personal/account');?>">完善</a>
</li>
<!--
<li><label class="baseinfo-label">认证状态：</label><span class="baseinfo-value baseinfo-authenticate">
<a href="<?php echo U('home/UserCert/index');?>" class="icon-auth-16-2" title="手机认证"></a>
<a href="/manage/user_cert/index.html" class="icon-auth-16-3-no" title="个人身份认证"></a>
<a href="/manage/user_cert/index.html" class="icon-auth-16-4-no" title="企业身份认证"></a>
<a href="/manage/user_cert/index.html" class="icon-auth-16-7-no" title="个人职务证明"></a>
<a href="/manage/user_cert/index.html" class="icon-auth-16-10-no" title="成功案例"></a>
<a href="/manage/user_cert/index.html" class="icon-auth-16-1-no" title="邮箱认证"></a>
<a href="/manage/user_cert/index.html" class="icon-auth-16-11-no" title="名片认证"></a>
-->
</span></li>
<li><label class="baseinfo-label">增值服务：</label><span class="baseinfo-value baseinfo-services" title="">
<a href="<?php echo U('Services/index');?>">升级为VIP</a>

</span></li>
<li><label class="baseinfo-label">消息提醒：</label><span class="baseinfo-value baseinfo-message">
<a href="<?php echo U('Personal/talks');?>"><i class="icon-info-deliver"></i>收到的约谈(<strong><?php if(!empty($user_talk_num)): echo ($user_talk_num); else: ?>0<?php endif; ?></strong>)</a>
<a href="<?php echo U('Personal/msg_pms');?>"><i class="icon-info-message"></i>系统消息(<strong><?php if(!empty($user_message_num)): echo ($user_message_num); else: echo ($msgtip['unread']); endif; ?></strong>)
</a>
</span></li>
<li></li>
</ul>
</div>

<!--
<div class="td5 J_hoverbut" onclick="window.location='<?php echo U('personal/attention_me',array('resume_id'=>$resume_info['id']));?>'"><div class="val"><?php echo ($resume_info['views']); ?></div>已发布信息</div>
<div class="td5 J_hoverbut" onclick="window.location='<?php echo U('personal/attention_me',array('resume_id'=>$resume_info['id']));?>'"><div class="val"><?php echo ($resume_info['views']); ?></div>投递次数</div>
<div class="td5 J_hoverbut" onclick="window.location='<?php echo U('personal/attention_me',array('resume_id'=>$resume_info['id']));?>'"><div class="val"><?php echo ($resume_info['views']); ?></div>最近30天浏览</div>
-->

<div class="fr">
<div class="td5 J_hoverbut" onclick="window.location='<?php echo U('personal/talks');?>'"><div class="val"><?php if(!empty($user_talk_num)): echo ($user_talk_num); else: ?>0<?php endif; ?></div>收到的约谈</div>
<div class="td5 J_hoverbut" onclick="window.location='<?php echo U('personal/receive');?>'"><div class="val"><?php if(!empty($user_message_num)): echo ($user_message_num); else: ?>0<?php endif; ?></div>收到留言</div>
</div>
<div class="clear"></div>
</div>


<!--
<div class="resumeinfo">
<div class="linfo">	
<div class="td1">
审核状态：<?php switch($resume_info['_audit']): case "1": ?><span class="font_green">审核通过</span><?php break;?>
<?php case "2": ?><span class="font_yellow">审核中</span><?php break;?>
<?php case "3": ?><span class="font_red">审核未通过</span><?php break; endswitch;?>
<br />
更新时间：<?php echo fdate($resume_info['refreshtime']);?><br />
</div>
<div class="td2">


<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

<div class="rinfo">
<div class="goldtxt link_blue">
我的<?php echo C('qscms_points_byname');?>：<span class="my_points_num"><?php echo ((isset($points) && ($points !== ""))?($points):0); ?></span><br />
<?php if(!empty($apply['Mall'])): ?><a href="<?php echo url_rewrite('QS_mall_index');?>" target="_blank">兑换礼品</a><br /><?php endif; ?>
<a href="<?php echo U('PersonalService/task');?>" target="_blank">做任务赚<?php echo C('qscms_points_byname');?></a>
</div>
<div class="sign"><a id="J_sign_in" href="javascript:;" class="J_hoverbut btn_inline <?php if($issign): ?>btn_lightgray<?php else: ?>	btn_yellow<?php endif; ?>"><?php if($issign): ?>已签到<?php else: ?>未签到<?php endif; ?></a></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
-->

<!--
<div class="tabindex">
<div class="li J_tab select" data-ajaxtype="recommend_jobs" ajaxpage="2">收到的消息</div>
<div class="li J_tab" data-ajaxtype="nearby_jobs" ajaxpage="2">谁看过我</div>
<div class="li J_tab" data-ajaxtype="new_jobs" ajaxpage="2">谁收藏我</div>

<div class="li J_tab" data-ajaxtype="new_jobs" ajaxpage="2">收到的名片</div>

<div class="clear"></div>
</div>

<div class="tabshow J_tab_menu" style="display:block" >
<div class="ajax_loading"><div class="ajaxloadtxt"></div></div>
<div class="J_tab_menu_html">
<?php if(!empty($jobs_list)): if(is_array($jobs_list)): $i = 0; $__LIST__ = $jobs_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="list_cell_box">
<div class="td1">
<div class="jobname link_blue substring"><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>" title="<?php echo ($jobs["jobs_name"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
<div class="edu_wage substring">
<div class="education">经验<?php echo ($jobs["experience_cn"]); ?> / <?php echo ($jobs["education_cn"]); ?></div>
<div class="wage font_yellow"><?php echo ($jobs["wage_cn"]); ?></div>
<div class="clear"></div>
</div>


<div class="cname link_gray9 substring"><a target="_blank" href="<?php echo ($jobs["company_url"]); ?>" title="<?php echo ($jobs["companyname"]); ?>"><?php echo ($jobs["companyname"]); ?></a></div>


<div class="cname link_gray9 substring"><a target="_blank" href="<?php echo ($jobs["company_url"]); ?>" title="<?php echo ($jobs["companyname"]); ?>"><?php echo ($jobs["companyname"]); ?></a></div>
</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="clear"></div>
<?php else: ?>
<div class="empty_tipstxt link_blue"></div><?php endif; ?>
</div>
</div>
<div class="tabshow J_tab_menu"><div class="ajax_loading"><div class="ajaxloadtxt"></div></div><div class="J_tab_menu_html"></div></div>
<div class="tabshow J_tab_menu"><div class="ajax_loading"><div class="ajaxloadtxt"></div></div><div class="J_tab_menu_html"></div></div>
</div>
<div class="clear"></div>
</div>
-->
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