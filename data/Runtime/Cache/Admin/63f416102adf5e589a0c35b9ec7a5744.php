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
		SELF = '/index.php?m=Admin&amp;c=Navigation&amp;a=add',
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
		<p>
		如果是本站的网址，可缩写为与根目录相对地址，如 index.php<br />
		其他情况都应该输入完整的网址，如：http://www.74cms.com/bbs；
		</p>
    </div>
    <div class="toptit">新增导航栏</div>
	<form action="<?php echo U('navigation/add');?>" method="post" enctype="multipart/form-data"  name="FormData" id="FormData" >
		<table border="0" cellspacing="5" cellpadding="1" >
		<tr>
            <td width="100" align="right">类型：</td>
            <td>
			<label><input name="urltype" type="radio" value="0" checked="checked"    />系统内容</label>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<label><input name="urltype" type="radio" value="1"    />其他链接</label>
			</td>
		</tr>
          <tr>
            <td width="100" align="right">栏目名称(必填)：</td>
            <td><input name="title" type="text"  class="input_text_200" id="title" value="" maxlength="30"/></td>
          </tr>
          <tr class="http" style=" display:none">
            <td align="right">链接地址：</td>
            <td><input name="url" type="text"  class="input_text_200" id="url" value="" maxlength="180"/>
     </td>
          </tr>
		  <tr class="sys">
            <td align="right">系统页面：</td>
            <td>
			<select name="systemalias" style="width:205px; font-size:12px;"  onchange="selChangesystemalias(this.value)">
        <?php if(is_array($page_list)): $i = 0; $__LIST__ = $page_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$page): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>,<?php echo ($page["tag"]); ?>"><?php echo ($page["pname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
			  
			</td>
          </tr>
		   <tr class="sys">
            <td align="right">系统页面ID：</td>
            <td><input name="pagealias" type="text" value="" class="input_text_200" /></td>
          </tr>
		  <tr class="sys">
            <td align="right">分类ID：</td>
            <td><input name="list_id" type="text" value="" class="input_text_200" /> 如该栏目为信息列表页则需要填写分类ID</td>
          </tr>
		  <tr >
            <td align="right">类别：</td>
            <td>
			 <?php if(is_array($categroy)): $i = 0; $__LIST__ = $categroy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$categroy): $mod = ($i % 2 );++$i;?><label>
              <input name="alias" type="radio" value="<?php echo ($key); ?>" <?php if($i == 1): ?>checked="checked"<?php endif; ?>/>
              <?php echo ($categroy); ?></label>
              &nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
			</td>
          </tr>
          <tr>
            <td align="right">打开方式：</td>
            <td><label>
              <input name="target" type="radio" value="_blank" checked="checked" />
              新窗口</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label>
                <input name="target" type="radio" value="_self">
                当前窗口</label></td>
          </tr>
          <tr>
            <td align="right">显示顺序：</td>
            <td><input name="navigationorder" type="text"  class="input_text_200" id="navigationorder" value="0" maxlength="3"  />            </td>
          </tr>
          <tr>
            <td align="right">是否显示：</td>
            <td><label>
              <input name="display" type="radio" value="1"  checked="checked" />
              显示</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label>
                <input name="display" type="radio" value="0">
                隐藏</label>            </td>
          </tr>
		       <tr>
            <td align="right">显示颜色：</td>
            <td>
			<div class="color_layer">	
			 <input type="text" name="color" id="tit_color" style="display:none">
	<div id="color_box" onclick="color_box_display()" ></div>
	<div id="select_color_box">
	<div class="color_title">选择标题颜色：</div>
	<div class="color_box_close" onclick="color_box_display()">关闭</div>
	<div class="clear"></div>
	<a onclick="set_color('');color_box_display()" href="javascript:void(0);" style="background-image:url(../public/images/color_box_bg.gif)"></a>
	<a onclick="set_color('#000000');color_box_display()" href="javascript:void(0);" style=" background-color:#000000"></a>
	<a onclick="set_color('#333333');color_box_display()" href="javascript:void(0);" style=" background-color:#333333"></a>
	<a onclick="set_color('#666666');color_box_display()" href="javascript:void(0);" style=" background-color:#666666"></a>
	<a onclick="set_color('#000099');color_box_display()" href="javascript:void(0);" style=" background-color:#000099"></a>
	<a onclick="set_color('#0066FF');color_box_display()" href="javascript:void(0);" style=" background-color:#0066FF"></a>
	<a onclick="set_color('#9900FF');color_box_display()" href="javascript:void(0);" style=" background-color:#9900FF"></a>
	<a onclick="set_color('#990000');color_box_display()" href="javascript:void(0);" style=" background-color:#990000"></a>
	<a onclick="set_color('#FF0000');color_box_display()" href="javascript:void(0);" style=" background-color:#FF0000"></a>
	<a onclick="set_color('#56C6FF');color_box_display()" href="javascript:void(0);" style=" background-color:#56C6FF"></a>
	<a onclick="set_color('#669900');color_box_display()" href="javascript:void(0);" style=" background-color:#669900"></a>
	<a onclick="set_color('#336600');color_box_display()" href="javascript:void(0);" style=" background-color:#336600"></a>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	function set_color(x){
		var rgb=x;
		if (rgb==""){
			document.getElementById('color_box').style.background='url(../public/images/color_box_bg.gif)';
		}else{
			document.getElementById('color_box').style.background=rgb;
		}
		//alert(rgb);
		document.getElementById('tit_color').value= rgb;
	}
	function color_box_display(){
		target=document.getElementById('select_color_box');
		if (target.style.display=="block"){
			target.style.display="none";
		} else {
			target.style.display="block";
		}
		//document.bgColor =rgb;
	}
</script>
	</div>
			</td>
          </tr>
		  <tr>
            <td align="right">导航关联标记：</td>
            <td>
 <input name="tag" type="text"  class="input_text_200" id="tag" value="" maxlength="30"/>
			</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td height="80">
			<input type="submit" name="Submit3" value="确定提交" class="admin_submit"   />
<input name="submit222" type="button" class="admin_submit"    value="返 回" onclick="window.location='<?php echo U('navigation/index');?>'"/></td>
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
<script type="text/javascript">
$(document).ready(function()
{
 
	$(":radio[name='urltype']").click(function(){
	if ($(":radio[name='urltype'][checked]").val()=="0")
	{
		$(".sys").show();
		$(".http").hide();
	}
	else
	{
		$(".sys").hide();
		$(".http").show();
	}
 
	})
})
</script>
<script>
function selChangesystemalias(obj)
{
var str=obj.split(",");
$('input[name="pagealias"]').val(str[0]);
$('input[name="tag"]').val(str[1]);
}
selChangesystemalias($('select[name="systemalias"] option:first').attr('value'));
//////-----
</script>
</body>
</html>