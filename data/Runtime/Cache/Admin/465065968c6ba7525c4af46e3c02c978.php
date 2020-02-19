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
		SELF = '/index.php?m=Admin&amp;c=SetPer&amp;a=index',
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
				<td width="220" align="right">个人会员允许发布简历：</td>
				<td><input name="resume_max" type="text"  class="input_text_100" id="resume_max" value="<?php echo C('qscms_resume_max');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> 份</td>
			</tr>
			<tr>
				<td align="right">每天允许申请职位：</td>
				<td><input name="apply_jobs_max" type="text"  class="input_text_100" id="apply_jobs_max" value="<?php echo C('qscms_apply_jobs_max');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> 个</td>
			</tr>
			<tr>
				<td align="right">上传简历照片大小不能超过：</td>
				<td><input name="resume_photo_max" type="text"  class="input_text_100" id="resume_photo_max" value="<?php echo C('qscms_resume_photo_max');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> KB</td>
			</tr>
			<tr>
				<td align="right">简历列表数最大为：</td>
				<td><input name="resume_list_max" type="text"  class="input_text_100" id="resume_list_max" value="<?php echo C('qscms_resume_list_max');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> 条<span class="admin_note" style="color: rgb(153, 153, 153);">0为不限制</span></td>
			</tr>
			<tr>
				<td align="right">刷新简历时间间隔：</td>
				<td><input name="per_refresh_resume_space" type="text"  class="input_text_100" id="per_refresh_resume_space" value="<?php echo C('qscms_per_refresh_resume_space');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> 分钟<span class="admin_note" style="color: rgb(153, 153, 153);">0为不限制</span></td>
			</tr>
			<tr>
				<td align="right">每天刷新简历次数限制：</td>
				<td><input name="per_refresh_resume_time" type="text"  class="input_text_100" id="per_refresh_resume_time" value="<?php echo C('qscms_per_refresh_resume_time');?>" maxlength="30" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/> 次<span class="admin_note" style="color: rgb(153, 153, 153);">0为不限制</span></td>
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
				<td width="220" align="right">简历显示：</td>
				<td>
					<label>
					<input name="resume_display" type="radio" value="1" <?php if(C('qscms_resume_display') == 1): ?>checked="checked"<?php endif; ?>/>先审核再显示</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input name="resume_display" type="radio" value="2" <?php if(C('qscms_resume_display') == 2): ?>checked="checked"<?php endif; ?>/>先显示再审核</label>
					 <span class="admin_note">（先显示后审核可提高用户体验和程序执行效率)</span>
				</td>
			</tr>
			<tr>
				<td align="right">简历照片/作品：</td>
				<td>
					<label>
					<input name="resume_img_display" type="radio" value="1" <?php if(C('qscms_resume_img_display') == 1): ?>checked="checked"<?php endif; ?>/>先审核再显示</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input name="resume_img_display" type="radio" value="2" <?php if(C('qscms_resume_img_display') == 2): ?>checked="checked"<?php endif; ?>/>先显示再审核</label>
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
	<div class="toptit">简历联系方式设置</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			
			<tr>
				<td width="220" align="right">Web端允许查看联系方式：</td>
				<td>
					<label><input name="showresumecontact" type="radio" id="showresumecontact" value="0" <?php if(C('qscms_showresumecontact') == 0): ?>checked="checked"<?php endif; ?>/>游客</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showresumecontact" value="1" id="showresumecontact" <?php if(C('qscms_showresumecontact') == 1): ?>checked="checked"<?php endif; ?>/>已登录会员</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showresumecontact" value="2" id="showresumecontact" <?php if(C('qscms_showresumecontact') == 2): ?>checked="checked"<?php endif; ?>/>下载后可见</label>
					<span class="admin_note" style="color: rgb(153, 153, 153);">(如此项为“游客可见”或“已登录会员可见”，网站将会失去重要赢利点)</span>
				</td>
			</tr>
			
			<tr>
				<td align="right">移动端允许查看联系方式：</td>
				<td>
					<label><input name="showresumecontact_wap" type="radio" id="showresumecontact_wap" value="0" <?php if(C('qscms_showresumecontact_wap') == 0): ?>checked="checked"<?php endif; ?>/>游客</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showresumecontact_wap" value="1" id="showresumecontact_wap" <?php if(C('qscms_showresumecontact_wap') == 1): ?>checked="checked"<?php endif; ?>/>已登录会员</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="showresumecontact_wap" value="2" id="showresumecontact_wap" <?php if(C('qscms_showresumecontact_wap') == 2): ?>checked="checked"<?php endif; ?>/>下载后可见</label>
					<span class="admin_note" style="color: rgb(153, 153, 153);">(如此项为“游客可见”或“已登录会员可见”，网站将会失去重要赢利点)</span>
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
		<span class="admin_note" style="color: rgb(153, 153, 153);">图形化需要将中文字体文件上传到data/contactimgfont/，字体文件命名为“cn.ttc”</span>
	</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			
			<tr>
				<td width="220" align="right">简历联系方式：</td>
				<td>
					<label><input name="contact_img_resume" type="radio" id="contact_img_resume" value="1" <?php if(C('qscms_contact_img_resume') == 1): ?>checked="checked"<?php endif; ?>/>文字</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="contact_img_resume" value="2" id="contact_img_resume" <?php if(C('qscms_contact_img_resume') == 2): ?>checked="checked"<?php endif; ?>/>图形化</label>
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
		简历下载设置
	</div>
	<form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			
			<tr>
				<td width="220" align="right">简历下载要求：</td>
				<td>
					<label ><input type="radio" name="down_resume_limit" value="2" id="down_resume_limit" <?php if(C('qscms_down_resume_limit') == 2): ?>checked="checked"<?php endif; ?>/>已登录的企业可下载</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label><input name="down_resume_limit" type="radio" id="down_resume_limit" value="1" <?php if(C('qscms_down_resume_limit') == 1): ?>checked="checked"<?php endif; ?>/>已登录且有发布职位的企业可下载</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="down_resume_limit" value="3" id="down_resume_limit" <?php if(C('qscms_down_resume_limit') == 3): ?>checked="checked"<?php endif; ?>/>已认证企业可下载</label>
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