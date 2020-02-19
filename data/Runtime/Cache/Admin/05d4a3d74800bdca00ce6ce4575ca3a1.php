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
		SELF = '/index.php?m=Admin&amp;c=SetPer&amp;a=search',
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
您可以根据网站的数据量来选择搜索方式。<br />
全文搜索效率更高，精准搜索更加精准。<br />
职位精准搜索只能搜索职位名称和公司名称。<br />
全文搜索能搜索更多的内容，但搜索关键字取决于关键字的字典，字典位置：data/scws/dict.utf8.xdb， 您可以调整字典词语来优化全文搜索。
</p>
</div>
<div class="toptit">基本设置</div>
<form action="<?php echo U('search');?>" method="post"  name="form1" id="form1">
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
	<tr>
      <td width="140" align="right">关键字搜索首选类型：</td>
      <td>
       <label><input type="radio"   value="1" name="resumesearch_key_first_choice" <?php if(C('qscms_resumesearch_key_first_choice') == '1' || C('qscms_resumesearch_key_first_choice') == '2'): ?>checked="checked"<?php endif; ?>/>精准搜索</label>
         &nbsp;&nbsp;&nbsp;&nbsp; 
       <label ><input type="radio"   value="0" name="resumesearch_key_first_choice" <?php if(C('qscms_resumesearch_key_first_choice') == '0'): ?>checked="checked"<?php endif; ?>/>全文搜索</label>
	    <span class="admin_note">（全文搜索结果更多，精准搜索更精准，请根据不同的运营阶段设置不同的选项)</span>
     </td>
    </tr>
   <tr>
      <td width="150" align="right">关键字搜索开启职位分类：</td>
      <td>
       <label><input type="radio"   value="1" name="resumesearch_key_open_jobcategory" <?php if(C('qscms_resumesearch_key_open_jobcategory') == '1' || C('qscms_resumesearch_key_open_jobcategory') == '2'): ?>checked="checked"<?php endif; ?>/>开启</label>
         &nbsp;&nbsp;&nbsp;&nbsp; 
       <label ><input type="radio"   value="0" name="resumesearch_key_open_jobcategory" <?php if(C('qscms_resumesearch_key_open_jobcategory') == '0'): ?>checked="checked"<?php endif; ?>/>关闭</label>
	    <span class="admin_note">（建议关闭，开启后搜索结果会变少)</span>
     </td>
    </tr>
	</table>
	 
	 <table width="100%" border="0" cellspacing="5" cellpadding="5" >
         <tr>
           <td width="140" align="right">&nbsp;</td>
           <td height="50"> 
           
             <input name="submit" type="submit" class="admin_submit"    value="保存"/>             
           </td>
      </tr>
  </table>
  </form>
  <div class="toptit">全文搜索</div>
  <form action="<?php echo U('search');?>" method="post"  name="form1" id="form1">
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
    <tr id="resumesearch_full_text_wrap">
      <td width="150" align="right">全文搜索类型：</td>
      <td>
       <label><input type="radio" class="resumesearch_type" name="resumesearch_type" value="1" <?php if(C('qscms_resumesearch_type') == '1'): ?>checked="checked"<?php endif; ?>/>系统内置</label>
         &nbsp;&nbsp;&nbsp;&nbsp;
            <label ><input <?php if($apply['Sphinx'] == ''): ?>disabled<?php endif; ?> type="radio" class="resumesearch_type" name="resumesearch_type" value="3" <?php if(C('qscms_resumesearch_type') == '2'): ?>checked="checked"<?php endif; ?>/>Sphinx</label>
            <span class="admin_note" style="color: rgb(153, 153, 153);">如要设为 Sphinx 系统需安装Sphinx模块，<a style="color:#009900" href="http://www.74cms.com" target="_blank">点击获取</a></span>
     </td>
    </tr>
         <tr>
           <td align="right">&nbsp;</td>
           <td height="50"> 
            <input type="submit" class="admin_submit" value="保存"/>             
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