<?php if (!defined('THINK_PATH')) exit(); $tag_help_category_class = new \Common\qscmstag\help_categoryTag(array('列表名'=>'info','小类'=>$_GET['id'],'cache'=>'0','type'=>'run',));$info = $tag_help_category_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$info);?>
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
<link href="../public/css/common.css" rel="stylesheet" type="text/css" />
<link href="../public/css/header.css" rel="stylesheet" type="text/css" />
<link href="../public/css/help.css" rel="stylesheet" type="text/css" />
<script src="../public/js/jquery.common.js" type="text/javascript" language="javascript"></script>
</head>
<body>
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
            <?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'10','分类'=>'1','排序'=>'addtime:desc','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$notice_list);?>
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
                <?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','数量'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
                <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if( MODULE_NAME == C( 'DEFAULT_MODULE') ): if($nav[ 'tag'] == strtolower(CONTROLLER_NAME) ): ?>select hover<?php endif; else: if($nav[ 'tag'] == strtolower(MODULE_NAME) ): ?>select hover<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="help_banner"></div>
<div class="helplist">
  <div class="l">
	<div class="catbox">
	<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'category_info','类型'=>'QS_help','cache'=>'0','type'=>'run',));$category_info = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$category_info);?>
	<?php $tag_help_category_class = new \Common\qscmstag\help_categoryTag(array('列表名'=>'category','大类'=>'0','cache'=>'0','type'=>'run',));$category = $tag_help_category_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$category);?>
	<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="J_helplist help_category <?php if($category_info[$_GET['id']]['parentid'] == $vo['id'] or ($_GET['id'] == '' and $i == 1)): ?>open<?php endif; ?>">
	  <div class="titl J_helplistT"><?php echo ($vo['title_']); ?></div>
	  <ul class="link_gray6 help_category_list J_helplistG">
	  <?php $tag_help_category_class = new \Common\qscmstag\help_categoryTag(array('列表名'=>'subcate','大类'=>$vo['id'],'cache'=>'0','type'=>'run',));$subcate = $tag_help_category_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$subcate);?>
	  <?php if(is_array($subcate)): $i = 0; $__LIST__ = $subcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a <?php if($v['id'] == $_GET['id']): ?>class="select"<?php endif; ?> href="<?php echo ($v['url']); ?>"><?php echo ($v['title_']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	  </ul>
	  </div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
  </div>
  <div class="r">
  
    <div class="main">
    <?php if($_GET['key']!= ''): ?><div class="titl">与 <font color="red"><?php echo (urldecode(urldecode($_GET['key']))); ?></font> 有关的帮助信息</div>
	<?php else: ?>
		<div class="titl"><?php echo ($info['title_']); ?></div><?php endif; ?>
	  <?php $tag_help_list_class = new \Common\qscmstag\help_listTag(array('列表名'=>'list','分页显示'=>'1','小类'=>$_GET['id'],'关键字'=>$_GET['key'],'cache'=>'0','type'=>'run',));$list = $tag_help_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$list);?>
	  <?php if(!empty($list['list'])): if(is_array($list['list'])): $i = 0; $__LIST__ = $list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list link_gray6">
        <div class="tit"><a href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title_']); ?></a></div>
		<div class="clear"></div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
	  <div class="qspage"><?php echo ($list['page']); ?></div>
	  <?php else: ?>
	  <div class="list_empty_group">
			<div class="list_empty">
				<div class="list_empty_left"></div>
				<div class="list_empty_right">
					<div class="sorry_box">对不起，没有找到相应的信息！</div>
				</div>
				<div class="clear"></div>
			</div>
		</div><?php endif; ?>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="/">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"帮助 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
<script type="text/javascript">
	// 左侧菜单展开收起
	$('.J_helplistT').click(function() {
		var $thisParent = $(this).closest('.J_helplist');
		$thisParent.toggleClass('open');
		if ($thisParent.hasClass('open')) {
			$('.J_helplist.open').not($thisParent).each(function(index, el) {
				$(this).removeClass('open');
			});
		};
	});
</script>
</body>
</html>