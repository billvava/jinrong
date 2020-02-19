<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8">
<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
<meta name="copyright" content="74cms.com" />
<title>金融网</title>
<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.min.js"></script>
<link href="__ADMINPUBLIC__/font/iconfont.css" rel="stylesheet" type="text/css" />
<script>
	var URL = '/index.php/Admin/SmsTemplates',
		SELF = '/index.php?m=Admin&amp;c=SmsTemplates&amp;a=index',
		ROOT_PATH = '/index.php/Admin',
		APP	 =	 '/index.php';
</script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.QSdialog.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.vtip-min.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.grid.rowSizing.pack.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/common.js"></script>
</head>
<body style="background-color:#E0F0FE">
	<div class="admin_main_nr_dbox">
	    <div class="pagetit">
	        <div class="ptit"> <?php if($sub_menu['pageheader']): echo ($sub_menu["pageheader"]); else: ?>欢迎登录 <?php echo C('qscms_site_name');?> 管理中心！<?php endif; ?></div>
	        <?php if(!empty($sub_menu['menu'])): ?><div class="topnav">
			        <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; if($_GET['_k_v']): ?>&_k_v=<?php echo ($_GET['_k_v']); endif; ?>" class="<?php echo ($val["class"]); ?>"><u><?php echo ($val["name"]); ?></u></a><?php endforeach; endif; else: echo "" ;endif; ?>
				    <div class="clear"></div>
				</div><?php endif; ?>
	        <div class="clear"></div>
	    </div>
	<div class="toptip">
		<h2>提示：</h2>
		<p>短信模板请勿添加HTML。短信内容不能超过60个字符，超过将会自动删除多余字符。</p>
		<p>短信模版编辑仅用于统一各服务商的短信模版，短信发送生效需前往“服务商接入”下短信服务商相应的模版配置单独配置。</p>
	</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
		<tr>
			<td width="160" class="admin_list_tit admin_list_first">模板名称</td>
			<td width="110" class="admin_list_tit">模板标识</td>
			<td width="80" align="center" class="admin_list_tit">排序</td>
			<td width="80" align="center" class="admin_list_tit">状态</td>
			<td width="230" class="admin_list_tit">模板内容</td>
			<td width="160" align="center" class="admin_list_tit">更新时间</td>
			<td width="110" align="center" class="admin_list_tit">操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
				<td class="admin_list admin_list_first"><?php echo ($list["name"]); ?></td>
				<td class="admin_list"><?php echo ($list["alias"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["ordid"]); ?></td>
				<td class="admin_list" align="center">
					<img src="__ADMINPUBLIC__/images/toggle_<?php if($list["status"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" />
				</td>
				<td class="admin_list"><?php echo ($list["value"]); ?></td>
				<td class="admin_list" align="center"><?php echo date("Y-m-d H:i:s",$list['update_time']);?></td>
				<td class="admin_list" align="center">
					<a href="<?php echo U('SmsTemplates/edit',array('id'=>$list['id']));?>" >编辑</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="qspage"><?php echo ($page); ?></div>
</div>
<div class="admin_frameset" >
  <div class="open_frame" title="全屏" id="open_frame"></div>
  <div class="close_frame" title="还原窗口" id="close_frame"></div>
</div>
<script type="text/javascript">
    $('part-top-allnav-list li:last').remove();
</script>
</body>
</html>
</body>
</html>