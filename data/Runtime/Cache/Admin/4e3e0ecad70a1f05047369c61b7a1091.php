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
	var URL = '/index.php/Admin/Index',
		SELF = '/index.php?m=Admin&amp;c=index&amp;a=panel',
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
<span id="version"></span>
<?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i; if($message['type'] == 'warning'): ?><table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#990000"  style=" margin-bottom:6px; color:#FFFFFF">
    <tr>
      <td bgcolor="#CC0000">&nbsp;<?php echo ($message["content"]); ?></td>
    </tr>
  </table>
  <?php else: ?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#FF9900"  style=" margin-bottom:6px;">
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;<?php echo ($message["content"]); ?></td>
      </tr>
    </table><?php endif; endforeach; endif; else: echo "" ;endif; ?>
<script type="text/javascript">
		var tsTimeStamp= new Date().getTime();
		$.getJSON("<?php echo U('index/total');?>",function(result){
				for(var i in result.data){
				if(result.data[i]==0)
				{
				 $("#"+i).html(result.data[i]);
				}
				else
				{
				 $("#"+i).html('+'+result.data[i]);
				}
         
        }
		});
</script>
</td>
  </tr>
</table>
<div class="toptit">系统信息</div>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td style="  color:#666666; padding-left:15px;line-height:220%;">
	<table width="600" border="0" cellpadding="0" cellspacing="0" class="link_lan">
      <tr>
        <td width="300"  >操作系统：<?php echo ($system_info["server_os"]); ?></td>
        <td  >PHP 版本：<?php echo ($system_info["php_version"]); ?></td>
      </tr>
      <tr>
        <td  >服务器软件：<?php echo ($system_info["web_server"]); ?><br /></td>
        <td  >MySQL 版本：<?php echo ($system_info["mysql_version"]); ?></td>
      </tr>
    </table></td>
  </tr>
</table>
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