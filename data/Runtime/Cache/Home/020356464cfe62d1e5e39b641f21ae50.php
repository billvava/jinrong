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
<link href="../public/css/members/common.css" rel="stylesheet" type="text/css" />
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
            <?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'10','分类'=>'1','排序'=>'addtime:desc','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"会员登录","keywords"=>"","description"=>"","header_title"=>""),$notice_list);?>
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

<div class="user_head_bg">
	<div class="user_head">
		<div class="logobox">
			<a href="/"><img src="<?php if(C('qscms_logo_home')): echo attach(C('qscms_logo_home'),'resource'); else: ?>../public/images/logo.gif<?php endif; ?>" border="0"/></a>
		</div>
		<div class="logotxt">
			|&nbsp;&nbsp;
			<?php if(ACTION_NAME == 'login'): ?>会员登录
			<?php else: ?>
				<?php if($utype == 0): ?>会员注册<?php endif; ?>
				<?php if($utype == 1): ?>资金方注册<?php endif; ?>
				<?php if($utype == 2): ?>项目方注册<?php endif; endif; ?>
		</div>
		<div class="reg">
			<?php if(ACTION_NAME == 'login'): ?>还没有账号？ <a href="<?php echo U('members/register');?>" class="btn_blue J_hoverbut btn_inline">立即注册</a>
			<?php else: ?>
				已经有账号？ <a href="<?php echo U('members/login');?>" class="btn_blue J_hoverbut btn_inline">立即登录</a><?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
	<div class="ban_box">
    <!--
		<div class="banner_list banner_list2"></div>
		<div class="banner_list banner_list3"></div>
        -->
		<div class="banner_list banner_list1"></div>
		<div class="maind">
			<div class="login">
				<!--用户名密码登录 -->
				<div class="mob j_mob_show">
					<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="righttab J_hoverbut J_mob" title="微信扫码登录"></div><?php endif; ?>
  					<div class="tit">
  						<span class="switch_txt active">会员登录</span>
  						<!--<?php if(C('qscms_sms_open') == 1): ?><span class="switch_txt">手机动态码登录</span><?php endif; ?>-->
  						<div id="forAccountLogin" class="switch_account link_blue" data-index="0"><a href="javascript:;">切换为账号登录</a></div>
  					</div>
					<div class="type_box active">
				    	<div class="err J_errbox"></div>
				        <div class="inputbox J_focus">
							<div class="imgbg"></div>
				        	<input type="text" class="input_login" name="username" id="username" placeholder="手机号/会员名/邮箱"/> 
				        </div>
						<div class="inputbox J_focus">
						    <div class="imgbg pwd"></div>
							<input type="password" class="input_login pwd J_loginword" name="password" id="password" placeholder="请输入密码"  />
						</div>
						<div class="txtbox link_gray6">
							<div class="td1"><label><input name="expire" class="J_expire" checked="checked" type="checkbox" value="1" /> 7天内自动登录</label></div>				
							<div class="td2"><a href="<?php echo U('members/user_getpass');?>">忘记密码?</a></div>
						</div>
		 		        <div class="btnbox">
		 		        	<input class="btn_login J_hoverbut" type="button" id="J_dologin" value="登录" />
		 		        </div>

                        <!--
	        			<div class="qqbox">
						  	<div class="qtit">
						  		<?php if(C('qscms_sms_open') == 1): ?><div class="qtit_left">使用合作账号登录</div>
                                    <!--
							  		<div class="qtit_right link_blue"><a id="forMobileLogin" href="javascript:;" data-index="1">使用手机动态码登录</a></div>
							  		<div class="clear"></div><?php endif; ?>
						  	</div>
						  	<div class="appsparent">
							    <div class="apps">
							    	<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a class="ali <?php echo ($key); ?>" href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" title="<?php echo ($oauth["name"]); ?>账号登录"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
					  		<div class="clear"></div>
						</div>
					</div>
                    -->
					<div class="type_box">
				    	<div class="err J_errbox"></div>
				        <div class="inputbox J_focus">
							<div class="imgbg"></div>
				        	<input type="text" class="input_login" name="mobile" id="mobile" placeholder="请输入手机号"/> 
				        </div>
						<div class="inputbox J_focus">
						    <div class="imgbg pwd"></div>
							<input type="text" class="input_login pwd code J_loginword" name="verfy_code" id="verfy_code" placeholder="请输入手机验证码"  />
							<input class="btn_login code J_hoverbut" type="button" id="getVerfyCode" value="获取验证码" />
						</div>
						<div class="txtbox link_gray6">
							<div class="td1"><label><input name="expire_obile" class="J_expire" checked="checked" type="checkbox" value="1" /> 7天内自动登录</label></div>					
							<div class="td2"><a href="<?php echo U('members/user_getpass');?>">忘记密码?</a></div>
						</div>
		 		        <div class="btnbox">
		 		        	<input class="btn_login J_hoverbut" type="button" id="J_dologinByMobile" value="登录" />
		 		        </div>

<!--
	        			<div class="qqbox">
						  	<div class="qtit">
						  		<div class="qtit_left">使用合作账号登录</div>
						  		<div class="qtit_right link_blue"></div>
						  		<div class="clear"></div>
						  	</div>
					  		<div class="appsparent">
							    <div class="apps">
							    	<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a class="ali <?php echo ($key); ?>" href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" title="<?php echo ($oauth["name"]); ?>账号登录"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
-->

					  		<div class="clear"></div>
						</div>
					</div>
				</div>
				<!--二维码的登录 -->
				<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="qr_code J_qr_code_show">
					    <div class="righttab J_hoverbut J_qr_code" title="账号密码登录"></div>
						<div class="tit">微信扫码，安全登录</div>
					    <div id="J_weixinQrCode" class="code"></div>
					    <div class="txt">打开 手机微信 <br /> 扫一扫登录</div>
					</div><?php endif; ?>
			</div>
		</div>
	</div>
	<input type="hidden" id="J_loginType" value="0">
	<input type="hidden" id="verify_userlogin" value="<?php echo ($verify_userlogin); ?>">
	<input type="button" id="btnCheck" style="display:none;">
	<input type="hidden" id="J_sendVerifyType" value="0">
	<div id="popup-captcha"></div>
	<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="/">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"会员登录","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
	<script type="text/javascript" src="../public/js/jquery.login.js"></script>
	<script src="../public/js/members/jquery.common.js" type="text/javascript" language="javascript"></script>
</body>
</html>