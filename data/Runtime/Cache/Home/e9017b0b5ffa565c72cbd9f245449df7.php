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
<link href="../public/css/hall_show.css" rel="stylesheet" type="text/css" />
<link href="../public/css/tab.css" rel="stylesheet" type="text/css" />
<link href="../public/css/show.css" rel="stylesheet" type="text/css" />
<link href="../public/css/company/company_show.css" rel="stylesheet" type="text/css" />
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
<div class="rshow" id="content">
<div class="l">
<div class="main">
<!--基本资料 -->
<div class="info">
<div class="inl">
<div class="pic"><img src="<?php if($user_info["photosrc"]==""): ?>../public/images/face/07.png<?php else: echo ($user_info['photosrc']); endif; ?>"/></div>
</div>
<div class="inr">
<div class="exhibition_room">项目方<br>展厅</div>
<div class="name_box">
<div class="name"><span style="font-size: 16px;"><?php echo ($user_info['realname']); ?></span><!--<?php if(user_info['sex'] ==1): ?>男士<?php else: ?> 女士<?php endif; ?>--></div>
<div class="clear"></div>
</div>
<div class="txt shareBtn bdsharebuttonbox">
<a class='ui-btn ui-btn-blue bds_more' data-cmd="more" href="javascript:;"><span>分享</span></a>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</div>

<div class="biz-card-dl-container">
<?php if(!empty($user_info['user_area'])): ?><dl>
<dt>所在地区</dt>
<dd><?php echo ($user_info['province']); ?> <?php echo ($user_info['city']); ?> <?php echo ($user_info['area']); ?></dd>
</dl><?php endif; ?>
<dl>
<dt>意向资金</dt>
<dd>
个人资金、  
企业资金、  
天使投资  
</dd>
</dl>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<div class="items">
<div class="bgFFF top20" id="tab">
<header class="part-nav-tab-a j-tab-all-c">
<nav class="fn-clear">
<ul>
<li class="current"><a href="javascript:;">概况</a></li>
<li><a href="javascript:;">动态</a></li>
<li><a href="javascript:;">人脉(0)</a></li>
<li id="guest_number"><a href="javascript:;">留言(0)</a></li>
</ul>
</nav>
</header>               
<div class="m-detaCont j-tab-cont">
<div class="conet pad30 clearfix" id="user_info"><div class="part-not-cont fn-pb-50"><i class="icoPro16yellow"></i><span class="fn-vam">该用户暂时还没有任何概况信息</span></div></div>
<div class="conet clearfix" style="display:none" id="feed">  
<!--
<div class="m-dtai clearfix">
<div class=" rightArea top15"><span class="col999">04月21日</span></div>
<div class="leftArea">
<p class="bold">TA给&nbsp;<a href="#" target="_blank">重庆市某金融投资公司 吴先生</a>&nbsp;递送了名片</p>
<p class="line24 col666">
所在地：重庆                                                 <i class="line">|</i>
所属行业：金融投资
</p>
</div>
</div>
-->
<div class=" clear"></div>
</div>
<div class="conet clearfix" style="display:none" id="business_all">
<div class="m-rmTit fn-clear" id="bus_tab">
<span class="active" value="">全部</span>
<span value="firends">商友</span>
<span value="myfollow">发出名片</span>
<span value="myfans">收到名片</span>
<input name="back_url" id="back_url" value="/service/company/businesscard" type="hidden">
<input name="act" id="bus_act" value="" type="hidden">
</div>
<div class="j-m-rmCont">
<div class="m-rmCont" style="display:block;">
<ul>
<!--
<li class="clearfix">
<div class="box">
<a href="/company_761854.html"><img src="__RESUME__/default/images/07.png"></a>
<p class="col333 bold"><a href="/company_761854.html">赵先生</a><em></em></p>
<p class="colblue">   </p>
<p class="col999">商友 3  |  发出名片 6  |  收到名片 0  |  信息 1</p>
<p class="top5" data-id="761854">
<a href="javascript:;" event="click.exchange" class="ui-btn-small ui-btn-blue">+加为商友</a>
</p>
</div>
<div class="box">
<a href="/company_702980.html"><img src="__RESUME__/default/images/07.png"></a>
<p class="col333 bold"><a href="/company_702980.html">李先生</a><em></em></p>
<p class="colblue">广西省柳州市某汽车汽配公司   经理</p>
<p class="col999">商友 2  |  发出名片 4  |  收到名片 0  |  信息 1</p>
<p class="top5" data-id="702980">
<a href="javascript:;" event="click.exchange" class="ui-btn-small ui-btn-blue">+加为商友</a>
</p>
</div>
</li>
-->
</ul>
</div>
</div>
</div>
<div class="conet clearfix pad30" style="display:none">
<div class="fn-clear ui-le-ht24">

<p class="fn-left"><span class="font16">用户留言</span>
</p>
<p class="fn-right" id="leave_msg_input_tip">您还可以输入<span class="colye">300</span>个字</p>
</div>
<div class="m-textArea top20">
<div class="fn-pr">
<textarea class="input" maxlength="300" name="leave_msg" id="leave_msg_content" placeholder="提示：严禁发布含有联系方式和广告性质的内容，违者一律删除！"></textarea>
<span class="prompt_pass">提示：严禁发布含有联系方式和广告性质的内容，违者一律删除 !</span>
</div>
<div class="inputArea">
<a href="javascript:alert('留言功能暂时关闭!')" class="ui-btn ui-btn-red btn-publish-leave-msg">发布留言</a>
<div class="m-hykj fn-right right10 j-hover-all">
<span>公开</span>
<ul>
<li><a href="javascript:void(0)" data-scope="0">公开</a></li>
<li><a href="javascript:void(0)" data-scope="1">仅对方可见</a></li>
<li><a href="javascript:void(0)" data-scope="2">会员可见</a></li>
</ul>
</div>
<input id="public" name="public" value="0" type="hidden">
<div id="comment_login_reg" class="fn-hide">
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
<div class="v6-message-all" id="guest">    <div class="part-not-cont fn-pb-30 fn-border-t-gary"><i class="icoPro16yellow"></i><span class="fn-vam">暂时还没有用户留言</span></div>
</div>
</div>
</div>
</div>

</div>
</div>
<div class="clear"></div>
</div>
<div class="down_resum_confirm_box"></div>
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
<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script type="text/javascript" src="../public/js/jquery.listitem.js"></script>
<script type="text/javascript" src="../public/js/jquery.dropdown.js"></script>
<script type="text/javascript" src="../public/js/laydate/laydate.js"></script>
<script type="text/javascript" src="../public/js/personal/jquery.fixed.sidebar.js"></script>
<style>
.bds_more{
background-image: none !important;
color: #fff !important;
float: inherit;
font-size: 14px !important;
height: 30px !important;
line-height: 30px !important;
margin: 0 !important;
padding: 0 8px 0 28px !important;
}
.ui-btn-red {
    background-color: #e94e38;
}
</style>
<script src="../public/js/message.js" type="text/javascript" language="javascript"></script>
<script>
	jQuery.jqtab = function(tabtit,tab_conbox,shijian,li,cur,type,first) {
                if( li==undefined || li==""){
                    li="li:not('.part-li-not')" ;
                }
                if( shijian==undefined || shijian==""){
                    shijian="click";
                }
                if( cur==undefined || cur==""){
                    cur="current";
                }
                $(tabtit).find(li).bind(shijian,function(){
                    if(type ==1){
                        $(this).find("input").attr("checked","checked").siblings().attr("checked","");
                    }else{
                        $(this).addClass(cur).siblings(li).removeClass(cur);
                    }
                    var activeindex = $(this).parents(tabtit).find(li).index(this);
                    $(this).parents(tabtit).siblings(tab_conbox).children().eq(activeindex).show().siblings().hide();
                    if(type!=1){
                        return false;
                    }
                });
            };
            //公共导航点击效果
            $.jqtab(".j-tab-all-c",".j-tab-cont");
            $.jqtab(".j-tab-all-c-cur",".j-tab-cont","","","ui-tab-head-current");
            $.jqtab(".j-tab-all-c-1",".j-tab-cont","","","",1);
            $.jqtab(".j-tab-all-m",".j-tab-cont","mouseover");
            $.jqtab(".j-tab-all-m-1",".j-tab-cont","mouseover","","","",1);
             $.jqtab(".m-title2",".m-detaCont",'','span','active');//外包
            $.jqtab(".m-rmTit",".j-m-rmCont",'','span','active');//外包
            // 公共组件hover
            jQuery.jqhover = function(tabtit) {

                $(tabtit).hover(function(){
                    $(this).addClass("cur")
                },function(){
                    $(this).removeClass("cur")
                });
            };
            $.jqhover('.j-hover-all');
</script>
<script>
var uid='5597859950232f10de3a54dedd3bbb6efb0cc5';
    var act='';
    $.post('/Home/BusinessCard/my', 'uid='+uid+"&act="+act, function(res){
        if (res.code = 200){     
            $("#business_all").html(res.data.html);
            bus.init();
        }
      },"json");
</script>
</body>
</html>