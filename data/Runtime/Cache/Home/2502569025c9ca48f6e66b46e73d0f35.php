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
<link href="../public/css/personal/personal_user.css" rel="stylesheet" type="text/css" />
<link href="../public/css/personal/personal_ajax_dialog.css" rel="stylesheet" type="text/css" />
<script src="../public/js/personal/jquery.common.js" type="text/javascript" language="javascript"></script>
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
			<!--职位切换卡 -->
			<div class="tab">
				<a class="li J_hoverbut" href="<?php echo U('personal/user_info');?>">基本资料</a>
				<a class="li J_hoverbut" href="<?php echo U('personal/user_avatar');?>" >我的头像</a>
				<a class="li select">账号安全</a>
				<a class="li J_hoverbut" href="<?php echo U('personal/user_loginlog');?>">登录日志</a>
			  	<div class="clear"></div>
			</div>
			<!--切换卡结束 -->
			<div class="resume_tip">
				<div class="tiptit">小提示</div>
				<div class="tiptxt link_blue">
					绑定手机号码、完成邮箱验证，可以增加求职反馈的及时性和准确性，从而提高您的求职成功率！
				</div>
			</div>
			<div class="safety J_hoverbut link_blue">
				<div class="td1">用户名</div>
				<div id="J_unameWrap" class="td2"><?php echo ($visitor["username"]); ?></div>
				<div class="td3">&nbsp;</div>
				<div class="td4"><a id="J_edit_uname" href="javascript:;">修改</a></div>
				<div class="clear"></div>
			</div>
			<div class="safety J_hoverbut link_blue">
				<div class="td1 t1">密码</div>
				<div class="td2">上次登录时间：<span><?php echo date('Y-m-d H:i:s',$visitor['last_login_time']);?></span></div>
				<div class="td3"><a href="<?php echo U('personal/user_loginlog');?>">[查看登录日志]</a></div>
				<div class="td4"><a id="J_edit_password" href="javascript:;">修改</a></div>
				<div class="clear"></div>
			</div>
			<div class="safety J_hoverbut link_blue">
				<div class="td1 t2">手机</div>
					<div id="J_mobileWrap" class="td2"><?php if($members_info['mobile']): echo ($members_info["mobile"]); else: ?>手机未填写<?php endif; ?><span>（认证后可使用该手机登录账号、找回密码）</span></div>
				<div id="J_mobileStatus" class="td3">
					<?php if($members_info['mobile_audit']): ?><div class="yes">已认证</div>
					<?php else: ?>
						<div class="no">未认证</div><?php endif; ?>
				</div>
				<div class="td4">
					<a id="J_auth_mobile" href="javascript:;" data-auth="<?php if($members_info['mobile_audit']): ?>1<?php else: ?>0<?php endif; ?>">
						<?php if($members_info['mobile_audit']): ?>修改
						<?php else: ?>
							立即认证<?php endif; ?>
					</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="safety J_hoverbut link_blue">
				<div class="td1 t3">邮箱</div>
				<div id="J_emailWrap" class="td2"><?php if($members_info['email']): echo ($members_info["email"]); else: ?>邮箱未填写<?php endif; ?><span>（认证后可使用该邮箱登录账号、找回密码）</span></div>
				<div id="J_emailStatus" class="td3">
					<?php if($members_info['email_audit']): ?><div class="yes">已认证</div>
					<?php else: ?>
						<div class="no">未认证</div><?php endif; ?>
				</div>
				<div class="td4">
					<a id="J_auth_email" href="javascript:;" data-auth="<?php if($members_info['email_audit']): ?>1<?php else: ?>0<?php endif; ?>">
						<?php if($members_info['email_audit']): ?>修改
						<?php else: ?>
							立即认证<?php endif; ?>
					</a>
				</div>
				<div class="clear"></div>
			</div>
        	<div class="safety_btit">账号绑定<span>（授权绑定后，可使用第三方帐号快速登录）</span></div>
        	<div class="safety_binding">
 				<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i;?><div class="td1">
						<?php if(empty($user_bind[$oauth['alias']])): ?><div class="<?php echo ($oauth["alias"]); ?>"><?php echo ($oauth["name"]); ?></div>
					    	<div class="txt link_blue">
					    		<a id="J_bind_<?php echo ($oauth["alias"]); ?>" href="<?php echo U('callback/index',array('mod'=>$oauth['alias'],'type'=>'bind'));?>">立即绑定</a>
					    	</div>
						<?php else: ?>
							<div class="<?php echo ($oauth["alias"]); ?> ok"><?php echo ($oauth["name"]); ?></div>
							<div class="txt link_blue"><a class="J_unlogin" href="javascript:;" url="<?php echo U('callback/index',array('mod'=>$oauth['alias'],'type'=>'unbind'));?>" name="<?php echo ($oauth["name"]); ?>">解除绑定</a></div><?php endif; ?>
	 		   		</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
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
	<script type="text/javascript">
		$('#J_edit_password').click(function(){
			var qsDialog = $(this).dialog({
        		title: '修改密码',
				loading: true,
				showFooter: false,
				yes: function() {
					var options = {};
					options['oldpassword'] = $('#J_passwordWrap').find('input[name="oldpassword"]').val();
					options['password'] = $('#J_passwordWrap').find('input[name="password"]').val();
					options['password1'] = $('#J_passwordWrap').find('input[name="password1"]').val();
					$.post("<?php echo U('Members/save_password');?>",options,function(r){
						if(r.status == 1){
							disapperTooltip('success',r.msg);
							qsDialog.hide();
						}else{
							disapperTooltip("remind", r.msg);
						}
					},'json');
				}
			});
			$.getJSON("<?php echo U('Members/save_password');?>",function(result){
				if(result.status == 1){
					qsDialog.setCloseDialog(false);
					qsDialog.setContent(result.data.html);
        			qsDialog.showFooter(true);
				}else{
					qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
				}
			});
		});
		var regularUsername = /^(?=[\u4e00-\u9fa5a-zA-Z])(?!\d+)[\u4e00-\u9fa5\w.]{6,18}$/;
		$('#J_edit_uname').click(function(){
			var qsDialog = $(this).dialog({
        		title: '修改用户名',
				loading: true,
				showFooter: false,
				yes: function() {
					var username = $.trim($('#J_usernameInput').val());
					if (!username.length) {
							disapperTooltip("remind", '请填写新用户名');
							$('#J_usernameInput').focus();
							return false;
						}
						if (username.length && !regularUsername.test(username)) {
							disapperTooltip("remind", "用户名中英文开头6-18位，无特殊符号");
							$('#J_usernameInput').focus();
							return false;
						}
					$.post("<?php echo U('Members/save_username');?>",{username:username},function(r){
						if(r.status == 1){
							$('#J_unameWrap').text(username);
							disapperTooltip('success',r.msg);
							qsDialog.hide();
						}else{
							disapperTooltip("remind", r.msg);
						}
					},'json');
				}
			});
			$.getJSON("<?php echo U('Members/save_username');?>",function(result){
				if(result.status == 1){
					qsDialog.setCloseDialog(false);
					qsDialog.setContent(result.data.html);
        			qsDialog.showFooter(true);
				}else{
					qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
				}
			});
		});
		$('#J_auth_mobile').click(function(){
			var f = $(this);
			var auth = f.data('auth');
			var title = '认证手机';
			if(auth == 1){
				title = '修改已认证手机';
			}
			var qsDialog = $(this).dialog({
        		title: title,
				loading: true,
				showFooter: false,
				yes: function() {
					var verifycode  = $.trim($('#J_mobileWrap input[name="verifycode"]').val());
					if(!verifycode){
						disapperTooltip("remind", "请填写验证码！");
						return !1;
					}
					$.post("<?php echo U('Members/verify_mobile_code');?>",{verifycode:verifycode},function(result){
						if(result.status == 1){
							f.text('修改');
							$('#J_mobileStatus').html('<div class="yes">已认证</div>');
							$('#J_mobileWrap').html(result.data.mobile+'<span>（认证后可使用该手机登录账号、找回密码）</span>');
							if(result.data.points){
								disapperTooltip("goldremind", '验证手机号增加'+result.data.points+'<?php echo C('qscms_points_byname');?><span class="point">+'+result.data.points+'</span>');
							}else{
								disapperTooltip('success',result.msg);
							}
							qsDialog.hide();
						}else{
							disapperTooltip('remind',result.msg);
						}
					},'json');
				}
			});
			$.getJSON("<?php echo U('Members/user_mobile');?>",function(result){
	    		if(result.status == 1){
					qsDialog.setCloseDialog(false);
	    			qsDialog.setContent(result.data);
        			qsDialog.showFooter(true);
	    		}else{
	    			qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
	    		}
	    	});
		});
		$('#J_auth_email').click(function(){
			var f = $(this);
			var auth = $(this).data('auth');
			var title = '认证邮箱';
			if(auth == 1){
				title = '修改已认证邮箱';
			}
			var qsDialog = $(this).dialog({
        		title: title,
				loading: true,
				footer: false
			});
			$.getJSON("<?php echo U('Members/user_email');?>",function(result){
	    		if(result.status == 1){
					qsDialog.setCloseDialog(false);
	    			qsDialog.setContent(result.data);
	    		}else{
	    			qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
	    		}
	    	});
		});
		var qrcode_bind_time,
			waiting_weixin_bind = function(){
				$.getJSON("<?php echo U('Members/waiting_weixin_bind');?>",function(result){
					if(result.status == 1){
						location.reload();
					}
				});
			};
		$('#J_bind_weixin').click(function(){
			clearInterval(qrcode_bind_time);
			var qsDialog = $(this).dialog({
        		title: '微信绑定',
				loading: true,
				showFooter: false,
				footer: false
			});
			$.getJSON("<?php echo U('Qrcode/get_weixin_qrcode');?>",{type:'bind'},function(result){
				if(result.status == 1){
					qsDialog.setContent(result.data);
        			qsDialog.showFooter(true);
					qrcode_bind_time=setInterval(waiting_weixin_bind,5000);
				}else{
					qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
				}
			});
			return !1;
		});
		$('.J_unlogin').click(function(){
			var url = $(this).attr('url'),
				name = $(this).attr('name'),
				qsDialog=$(this).dialog({
					title: '取消绑定',
					loading: false,
					border: false,
					content : '<div style="width:350px">当前帐号已绑定<'+name+'>确定解绑吗？</div>',
					yes: function() {
						window.location.href=url;
					}
				});
		});
	</script>
</body>
</html>