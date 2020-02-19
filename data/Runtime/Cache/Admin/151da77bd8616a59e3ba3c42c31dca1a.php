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
	var URL = '/index.php/Admin/Menu',
		SELF = '/index.php?m=Admin&amp;c=menu&amp;a=edit&amp;id=240',
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
        <p>点击“继续添加”按钮，可同时添加多个分类！</p>
    </div>
    <div class="toptit">新增分类</div>
	<form id="form1" name="form1" method="post" action="<?php echo U('menu/edit');?>">
		<div id="html_tpl">
			<table width="100%" border="0" cellspacing="6" cellpadding="0" style="border-bottom:1px #93AEDD  dashed">
				<tr>
					<td width="120" align="right">所属分类:</td>
					<td>
						<select name="pid">
							<option value="0" <?php if($_GET['pid']== 0): ?>selected="selected"<?php endif; ?>>顶级菜单</option>
							<?php if(is_array($menus['parent'])): $i = 0; $__LIST__ = $menus['parent'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($parent["id"]); ?>" <?php if($parent['id'] == $info['pid']): ?>selected="selected"<?php endif; ?>><?php echo ($parent["name"]); ?></option>
								<?php if(is_array($menus['sub'][$parent['id']])): $i = 0; $__LIST__ = $menus['sub'][$parent['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sub["id"]); ?>" <?php if($sub['id'] == $info['pid']): ?>selected="selected"<?php endif; ?>>├─<?php echo ($sub["name"]); ?></option>
									<?php if(is_array($menus['sub'][$sub['id']])): $i = 0; $__LIST__ = $menus['sub'][$sub['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><option value="<?php echo ($child["id"]); ?>" <?php if($child['id'] == $info['pid']): ?>selected="selected"<?php endif; ?>>︱ ├─<?php echo ($child["name"]); ?></option>
										<?php if(is_array($menus['sub'][$child['id']])): foreach($menus['sub'][$child['id']] as $key=>$sub2): ?><option value="<?php echo ($sub2["id"]); ?>" <?php if($sub2['id'] == $info['pid']): ?>selected="selected"<?php endif; ?>>︱ ︱ ├─<?php echo ($sub2["name"]); ?></option><?php endforeach; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">菜单名称:</td>
					<td>
						<input name="name" type="text" class="input_text_200" value="<?php echo ($info["name"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">模块名:</td>
					<td>
						<input name="module_name" type="text" class="input_text_200" value="<?php echo ($info["module_name"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">控制器名:</td>
					<td>
						<input name="controller_name" type="text" class="input_text_200" value="<?php echo ($info["controller_name"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">方法名:</td>
					<td>
						<input name="action_name" type="text" class="input_text_200" value="<?php echo ($info["action_name"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">附加参数:</td>
					<td>
						<input name="data" type="text" class="input_text_200" value="<?php echo ($info["data"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">菜单类型 :</td>
					<td>
						<label><input type="radio" name="menu_type" class="radio_style" value="1" <?php if($info["menu_type"] == 1): ?>checked="checked"<?php endif; ?>>导航&nbsp;&nbsp;</label>
						<label><input type="radio" name="menu_type" class="radio_style" value="0" <?php if($info["menu_type"] == 0): ?>checked="checked"<?php endif; ?>>按钮或功能</label>
					</td>
				</tr>
				<tr id="J_stat">
					<td width="120" align="right">待处理事务:</td>
					<td>
						<input name="stat" type="text" class="input_text_200" value="<?php echo ($info["stat"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">备注:</td>
					<td>
						<textarea name="remark" id="remark" cols="70" rows="3" style="font-size:12px;"><?php echo ($info["remark"]); ?></textarea><br/>
						<span style="color:#666666">注：只三级分类添加范例即可</span>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">排序:</td>
					<td>
						<input name="ordid" type="text" class="input_text_200" value="<?php echo ($info["ordid"]); ?>"/>
					</td>
				</tr>
				<tr>
					<td width="120" align="right">是否显示 :</td>
					<td>
						<label><input type="radio" name="display" class="radio_style" value="1" <?php if($info["display"] == 1): ?>checked="checked"<?php endif; ?>> 是&nbsp;&nbsp;</label>
						<label><input type="radio" name="display" class="radio_style" value="0" <?php if($info["display"] == 0): ?>checked="checked"<?php endif; ?>> 否</label>
					</td>
				</tr>
			</table>
		</div>
		<table width="100%" border="0" cellspacing="6" cellpadding="0">
			<tr>
				<td width="120"></td>
				<td>
					<input type="submit" name="addsave" value="保存" class="admin_submit"/>
					<input name="submit22" type="button" class="admin_submit" value="返 回" onclick="window.location='<?php echo U('menu/index');?>'"/>
				</td>
			</tr>
		</table>
		<input name="id" type="hidden" value="<?php echo ($info["id"]); ?>">
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
<script type="text/javascript">
    $(document).ready(function(){
		$('input[name="menu_type"]').click(function(){
			if($(this).val() == 1){
				$('#J_stat').show();
			}else{
				$('#J_stat').hide();
			}
		});
	});
</script>
</body>
</html>