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
	var URL = '/index.php/Admin/Sms',
		SELF = '/index.php?m=Admin&amp;c=sms&amp;a=edit&amp;id=1',
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
        <p>通过短信接口设置，您可以自行配置第三方短信接口；</p>
    </div>
    <div class="toptit">修改短信接口</div>
	<form id="form1" name="form1" method="post" action="<?php echo U('sms/edit');?>">
		<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
			<tr>
				<td width="120" height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">接口名称：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">
					<input name="name" type="text" class="input_text_200" id="admin_name" maxlength="30" value="<?php echo ($info["name"]); ?>"/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">接口标识：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="alias" type="text" class="input_text_200" id="old_emailpwd" maxlength="40" value="<?php echo ($info["alias"]); ?>"/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">appkey：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="config[appkey]" type="text" class="input_text_200" id="old_emailpwd" maxlength="40" value="<?php echo ($info["config"]["appkey"]); ?>"/>（短信接口帐号）
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">secretKey：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="config[secretKey]" type="text" class="input_text_200" id="old_emailpwd" maxlength="50" value="<?php echo ($info["config"]["secretKey"]); ?>"/>（短信接口密钥）
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">signature：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="config[signature]" type="text" class="input_text_200" id="old_emailpwd" maxlength="40" value="<?php echo ($info["config"]["signature"]); ?>"/>（短信接口签名）
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">接口描述：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<textarea name="remark" id="remark" cols="70" rows="3" style="font-size:12px;"><?php echo ($info["remark"]); ?></textarea>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">排序：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="ordid" type="text" class="input_text_200" value="<?php echo ($info["ordid"]); ?>"/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
				<td height="50" bgcolor="#FFFFFF" >
					<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
					<input type="submit" class="admin_submit"    value="保存"/>
					<input type="button" class="admin_submit"    value="返回" onclick="window.location='<?php echo U('sms/index');?>'"/>
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