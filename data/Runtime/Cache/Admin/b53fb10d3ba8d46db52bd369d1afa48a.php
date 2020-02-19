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
	var URL = '/index.php/Admin/Navigation',
		SELF = '/index.php?m=Admin&amp;c=Navigation&amp;a=category',
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
        <p>系统内置分类不可以编辑或者删除<br />自定义分类调用名不可以以 “QS_”开头</p>
    </div>
	<table width="100%" border="0" cellpadding="2" cellspacing="0" id="list" class="link_lan">
        <tr>
			<td width="15%" class="admin_list_tit admin_list_first">调用名称</td>
			<td class="admin_list_tit">分类名称</td>
			<td width="15%" align="center" class="admin_list_tit">类型</td>
			<td width="15%" align="center" class="admin_list_tit">编辑</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
				<td class="admin_list admin_list_first"><strong><?php echo ($li["alias"]); ?></strong></td>
				<td class="admin_list">
					<?php echo ($li["categoryname"]); ?>
				</td>
				<td align="center" class="admin_list">
				<?php if($li['admin_set'] == 1): ?><span style="color:#56C6FF">系统内置</span>
				<?php else: ?>
					自定义<?php endif; ?>
				</td>
				<td align="center" class="admin_list">
				<?php if($li['admin_set'] != 1): ?><a href="<?php echo U('navigation/category_edit',array('id'=>$li['id']));?>"  >修改</a>
					&nbsp;&nbsp;&nbsp;
					<a href="<?php echo U('navigation/category_del',array('id'=>$li['id']));?>" onclick="return confirm('你确定要删除吗？')">删除</a>
				<?php else: ?>
					<span style="color:#999999">修改</span>&nbsp;&nbsp;&nbsp;
					<span style="color:#999999">删除</span><?php endif; ?>
				&nbsp;
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
	      <tr>
	        <td>
	 <input type="button" name="Submit22" value="新增类别" class="admin_submit"    onclick="window.location='<?php echo U('navigation/category_add');?>'"/>
			</td>
	        <td width="305" align="right">		
		    </td>
	      </tr>
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