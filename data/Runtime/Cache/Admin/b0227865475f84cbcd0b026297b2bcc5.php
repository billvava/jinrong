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
	var URL = '/index.php/Admin/SetCom',
		SELF = '/index.php?m=Admin&amp;c=SetCom&amp;a=index',
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
    <div class="toptit">基本设置</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
				<td width="220" align="right">上传营业执照文件限制：</td>
				<td><input name="certificate_max_size" type="text"  class="input_text_100" id="certificate_max_size" value="<?php echo C('qscms_certificate_max_size');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> kb</td>
			</tr>
			<tr>
				<td align="right">企业LOGO文件限制：</td>
				<td><input name="logo_max_size" type="text"  class="input_text_100" id="logo_max_size" value="<?php echo C('qscms_logo_max_size');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> kb</td>
			</tr>
			<tr>
				<td align="right">职位列表数最大为：</td>
				<td><input name="jobs_list_max" type="text"  class="input_text_100" id="jobs_list_max" value="<?php echo C('qscms_jobs_list_max');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> 条</td>
			</tr>
			<tr>
				<td align="right">关闭职位更新时间：</td>
				<td>
					<label>
					<input name="closetime" type="radio" id="closetime" value="0" <?php if(C('qscms_closetime') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input type="radio" name="closetime" value="1" <?php if(C('qscms_closetime') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
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
	    <div class="toptit">显示设置</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
	 
			<tr>
				<td width="220" align="right">职位显示：</td>
				<td>
					<label>
					<input name="jobs_display" type="radio" value="1" <?php if(C('qscms_jobs_display') == 1): ?>checked="checked"<?php endif; ?>/>先审核再显示</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input name="jobs_display" type="radio" value="2" <?php if(C('qscms_jobs_display') == 2): ?>checked="checked"<?php endif; ?>/>先显示再审核</label>
					 <span class="admin_note">（先显示后审核可提高用户体验和程序执行效率)</span>
				</td>
			</tr>
			<tr>
				<td align="right">企业风采图片：</td>
				<td>
					<label>
					<input name="companyimg_display" type="radio" value="1" <?php if(C('qscms_companyimg_display') == 1): ?>checked="checked"<?php endif; ?>/>先审核再显示</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input name="companyimg_display" type="radio" value="2" <?php if(C('qscms_companyimg_display') == 2): ?>checked="checked"<?php endif; ?>/>先显示再审核</label>
					 <span class="admin_note">（先显示后审核可提高用户体验和程序执行效率)</span>
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
	<div class="toptit">查看联系方式设置</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			
			<tr>
				<td width="220" align="right">Web端允许查看联系方式：</td>
				<td>
					<label><input name="showjobcontact" type="radio" id="showjobcontact" value="0" <?php if(C('qscms_showjobcontact') == 0): ?>checked="checked"<?php endif; ?>/>游客</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showjobcontact" value="1" id="showjobcontact" <?php if(C('qscms_showjobcontact') == 1): ?>checked="checked"<?php endif; ?>/>已登录会员</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showjobcontact" value="2" id="showjobcontact" <?php if(C('qscms_showjobcontact') == 2): ?>checked="checked"<?php endif; ?>/>已登录且发布了有效简历</label>
				</td>
			</tr>
			
			<tr>
				<td align="right">移动端允许查看联系方式：</td>
				<td>
					<label><input name="showjobcontact_wap" type="radio" id="showjobcontact_wap" value="0" <?php if(C('qscms_showjobcontact_wap') == 0): ?>checked="checked"<?php endif; ?>/>游客</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showjobcontact_wap" value="1" id="showjobcontact_wap" <?php if(C('qscms_showjobcontact_wap') == 1): ?>checked="checked"<?php endif; ?>/>已登录会员</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showjobcontact_wap" value="2" id="showjobcontact_wap" <?php if(C('qscms_showjobcontact_wap') == 2): ?>checked="checked"<?php endif; ?>/>已登录且发布了有效简历</label>
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
	<div class="toptit">
		联系方式图形化
		<span class="admin_note" >图形化需要将中文字体文件上传到data/contactimgfont/，字体文件命名为“cn.ttc”</span>
	</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			
			<tr>
				<td width="220" align="right">企业联系方式：</td>
				<td>
					<label><input name="contact_img_com" type="radio" id="contact_img_com" value="1" <?php if(C('qscms_contact_img_com') == 1): ?>checked="checked"<?php endif; ?>/>文字</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="contact_img_com" value="2" id="contact_img_com" <?php if(C('qscms_contact_img_com') == 2): ?>checked="checked"<?php endif; ?>/>图形化</label>
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
	
	
	<div class="toptit">其他设置</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
	        <td align="right">刷新职位时间间隔：</td>
	        <td><input name="refresh_jobs_space" type="text" class="input_text_200" id="refresh_jobs_space" value="<?php echo C('qscms_refresh_jobs_space');?>"  maxlength="10" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/>
	        分钟   <span class="admin_note"  >(0表示不限制)</span></td>
	      </tr>
			<tr>
				<td width="220" align="right">允许公司名称重复：</td>
				<td>
					<label ><input type="radio" name="company_repeat" value="1" id="company_repeat" <?php if(C('qscms_company_repeat') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="company_repeat" value="0" id="company_repeat" <?php if(C('qscms_company_repeat') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
				</td>
			</tr>
			<tr>
				<td width="220" align="right">会员短信费用承担方：</td> 
				<td>
					<label ><input type="radio" name="company_sms" value="1" id="company_sms" <?php if(C('qscms_company_sms') == 1): ?>checked="checked"<?php endif; ?>/>企业承担</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="company_sms" value="0" id="company_sms" <?php if(C('qscms_company_sms') == 0): ?>checked="checked"<?php endif; ?>/>运营者承担</label>
					<span class="admin_note" >（如设置为企业承担，则企业需要在增值服务区购买短信包才能发送各种短信提醒）</span>
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