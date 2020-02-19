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
		SELF = '/index.php?m=Admin&amp;c=Sms&amp;a=testing',
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
	<div class="toptit">发送测试短信</div>
	<span id="submitbox">
		<form action="<?php echo U('sms/testing');?>" method="post"   name="form1" id="form1">
		<table width="700" border="0" cellspacing="10" cellpadding="1" style=" margin-bottom:3px;">
			<?php if($err): ?><tr>
					<td align="right">&nbsp;</td>
					<td><?php echo ($err); ?></td>
				</tr><?php endif; ?>
			<tr>
            <td width="100" align="right">测试接口:</td>
            <td width="560">
			<input name="type" type="radio" value="captcha" checked/>验证码类&nbsp;&nbsp;&nbsp;
			<input name="type" type="radio" value="notice"/>通知类&nbsp;&nbsp;&nbsp;
			<input name="type" type="radio" value="other"/>其他类</td>
          </tr>
          <tr>
            <td width="100" align="right">接收手机:</td>
            <td width="560">
			<input name="mobile" type="text"  class="input_text_200"  value="" maxlength="11"/></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="submit" class="admin_submit" id="check" value="立即测试" /></td>
          </tr>
        </table>
	    </form>
    </span>
	<span id="hide" style="display: none; color: #009900; padding-left:30px; padding-bottom:80px;">
	 正在发送.......<br />
	<br />
	</span>
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
<script type="text/javascript"> 
	$(document).ready(function(){
		$("#check").click(function () {	
			$("#submitbox").hide();
			$("#hide").show();	
		});
	});
</script>
</body>
</html>