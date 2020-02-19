<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico"/>
	<title>金融网</title>
	<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("li").first().addClass("hover");
			$("li>a").click(function(){
				$("li").removeClass("hover");
				$(this).parent().addClass("hover");
				$(this).blur();
			});
		});
	</script>
</head>
<body>
	<div  class="admin_left_box">
		<ul>
			<?php if(empty($menuid)): ?><li><a href="<?php echo U('index/panel');?>" target="mainFrame">管理中心首页</a></li><?php endif; ?>
			<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li <?php if($menuid && $key == 0): ?>class="hover"<?php endif; ?>><a href="<?php echo U($menu['module_name'].'/'.$menu['controller_name'].'/'.$menu['action_name']); echo ($menu["data"]); ?>"  target="mainFrame" title="<?php echo ($menu["name"]); ?>" <?php if($menu['stat']): ?>stat="<?php echo ($menu["stat"]); ?>"<?php endif; ?>><?php echo ($menu["name"]); if($menu['para'] == 1): ?><span id="new_custormer"></span><?php endif; ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(empty($menuid)): ?><li><a href="<?php echo U('index/logout');?>" target="_top">退出登录</a></li><?php endif; ?>
		</ul>
	</div>
<script>
$(function(){
	$.getJSON("<?php echo U('Ajax/get_news_custorm');?>",function(result){
		if(result){
			$('#new_custormer').html(result);
		}else{
			$('#new_custormer').hide();
		}
	});
});
</script>
</body>
</html>