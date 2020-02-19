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
<link href="../public/css/members/common.css" rel="stylesheet"/>
<link href="../public/css/personal/personal_ajax_dialog.css" rel="stylesheet"/>
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
<div class="reg_com">
<form class="J_passwordalert_group" id="registerForm" action="<?php echo U('members/register');?>" method="post" onkeydown="if(event.keyCode==13){return false;}">
<input type="hidden" name="incode" value="<?php echo ($_GET['incode']); ?>">
<div class="rl J_focus">
<div class="switch_title link_blue"><a href="<?php echo U('members/register',array('utype'=>2));?>">切换为项目方>></a></div>
<div class="regtit">账户信息<span>(用于登录<?php echo C('qscms_site_name');?>)</span></div>
<div class="J_validate_group">
	<div class="td1">
		<input class="input_295_34" name="mobile" id="mobile" type="text" placeholder="请输入手机号码" autocomplete="off" />
	</div>
<div class="td2 J_showtip_box"></div>
</div>
<div class="J_validate_group">
<div class="td1">
<div class="code">
<input class="input_295_34" name="mobile_vcode" id="mobile_vcode" type="text" placeholder="请输入短信验证码" autocomplete="off" />
</div>
<div class="codebtn">
<input type="button" class="btn_yellow J_hoverbut" id="J_getverificode" value="获取验证码" />
<div id="popup-captcha"></div>
<input type="hidden" id="btnCheck" />
</div>
<div class="clear"></div>
</div>
<div class="td2 J_showtip_box"></div>
<div class="clear"></div>
</div>
<div class="J_validate_group">
	<div class="td1">
		<input class="input_295_34 J_passwordalert" name="password" id="password" type="password" placeholder="请输入账户密码" autocomplete="off" />
	</div>
	<div class="td2 J_showtip_box"></div>
</div>
<div class="clear"></div>
<div class="safety">
	<div class="slist t1">危险</div>
	<div class="slist t2">一般</div>
	<div class="slist t3">安全</div>
	<div class="clear"></div>
</div>
<div class="J_validate_group">
	<div class="td1">
		<input class="input_295_34" name="passwordVerify" id="passwordVerify" type="password" placeholder="请确认账户密码" autocomplete="off" />
	</div>
	<div class="td2 J_showtip_box"></div>
</div>
<div class="clear"></div>
<div class="agreement link_blue"><label><input name="agreement" type="checkbox" value="1" checked="checked" />
我已阅读并同意<a href="javascript:;" id="reg_agreement">《<?php echo C('qscms_site_name');?>用户服务协议》</a></label></div>
<div class="btnbox">
	<input name="utype" type="hidden" value="<?php echo ($utype); ?>">
	<input type="hidden" name="reg_type" value="1">
	<input type="hidden" name="landline_tel" id="landline_tel" value="">
	<input name="" id="btnRegister" type="submit" value="注册" class="btn_reg J_hoverbut" />
</div>
</div>
<div class="rr">
<div class="tittxt">已经有<?php echo C('qscms_site_name');?>账号:</div>

<div class="logintxt"><a href="<?php echo U('members/login');?>" class=" J_hoverbut btn_blue btn_inline">直接登录</a></div>
<div class="tittxt">使用以下帐号直接登录:</div>

<div class="loginappimg">
	
  <div class="clear"></div>
  </div>
</div>
<!-- -->
<div class="clear"></div>
<div id="popupCaptcha"></div>
<input type="hidden" id="verifyRegCompany">
</form>
</div>
<input type="hidden" id="J_config_varify_reg" value="<?php echo C('qscms_captcha_config.varify_reg');?>" />
<!--下方阴影 -->
<div class="reg_com_bg">
<div class="bl"></div>
<div class="br"></div>
<div class="clear"></div>
</div>
<?php $tag_text_class = new \Common\qscmstag\textTag(array('列表名'=>'agreement','类型'=>'agreement','cache'=>'0','type'=>'run',));$agreement = $tag_text_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$agreement);?>
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
<script src="../public/js/user_jquery.validate.js"></script>
<script src="../public/js/members/jquery.pwdalert.js"></script>
<script src="../public/js/members/jquery.validate.regcompany.js"></script>
<script src="../public/js/members/jquery.validate.regpersonal.js"></script>
<script src="../public/js/jquery.modal.dialog.js"></script>
<script src="../public/js/emailAutoComplete.js"></script>
<script src="../public/js/jquery.placeholder.min.js"></script>
<script src="../public/js/members/jquery.common.js"></script>
<script>
$('input').placeholder();
//注册协议弹框
$("#reg_agreement").click(function(){
var qsDialog = $(this).dialog({
title: "<?php echo C('qscms_site_name');?>注册协议",
backdrop: false
});
$.getJSON("<?php echo U('Home/Members/agreement');?>",function(result){
if(result.status==1){
	qsDialog.setContent(result.data);
}
});
});
// 默认第一项获得焦点
$('#companyname').focus().addClass('input_focus');
// 是否同意注册协议
$('input[name="agreement"]').die().live('click', function() {
if ($(this).is(':checked')) {
$('#btnRegister').prop('disabled', 0).removeClass('btn_disabled');
} else {
$('#btnRegister').prop('disabled', !0).addClass('btn_disabled');
}
})
</script>
</body>
</html>