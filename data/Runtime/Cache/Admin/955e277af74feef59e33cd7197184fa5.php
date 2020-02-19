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
	var URL = '/index.php/Admin/SetPer',
		SELF = '/index.php?m=Admin&amp;c=SetPer&amp;a=set_audit',
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
        <p>不同的运营阶段您可以选择不同的设置。</p>
    </div>
    
	<div class="toptit">审核设置</div>
	<form action="<?php echo U('set_audit');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
				<td width="180" align="right">修改简历后审核状态变为：</td>
				<td>
					<label><input name="audit_edit_resume" type="radio" id="audit_edit_resume" value="-1" <?php if(C('qscms_audit_edit_resume') == '-1'): ?>checked="checked"<?php endif; ?>/>保持不变</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="audit_edit_resume" value="2" id="audit_edit_resume" <?php if(C('qscms_audit_edit_resume') == 2): ?>checked="checked"<?php endif; ?>/>审核中</label>
				</td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td height="50"> 
					<input name="submit" type="submit" class="admin_submit"    value="保存修改"/>				</td>
			</tr>
		</table>
	</form>
	<div class="toptit">认证设置</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
				<td width="180" align="right">强制会员认证手机：</td>
				<td>
					<label><input name="login_per_audit_mobile" type="radio" id="login_per_audit_mobile" value="1" <?php if(C('qscms_login_per_audit_mobile') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label><input name="login_per_audit_mobile" type="radio" id="login_per_audit_mobile" value="0" <?php if(C('qscms_login_per_audit_mobile') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
					<span class="admin_note"  >（如要设为强制认证手机需开启短信模块）</span>
				</td>
			</tr>
			 
			<tr>
				<td align="right">&nbsp;</td>
				<td height="50"> 
					<input name="submit" type="submit" class="admin_submit"    value="保存修改"/>
				</td>
			</tr>
		</table>
	</form>
	 
	
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