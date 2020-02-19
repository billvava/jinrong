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
	var URL = '/index.php/Admin/Personal',
		SELF = '/index.php?m=Admin&amp;c=Personal&amp;a=member_add',
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
  <div class="toptit">添加个人会员</div>
  <form id="form1" name="form1" method="post" action="<?php echo U('member_add');?>">
    <table width="100%" border="0" cellpadding="4" cellspacing="0"  >
      <tr>
        <td width="120" height="30" align="right" style=" border-bottom:1px #CCCCCC dashed">用户名：</td>
        <td style=" border-bottom:1px #CCCCCC dashed"> <input name="username" type="text" class="input_text_200" id="username" maxlength="25" value=""/> <label></label></td>
      </tr>
      <tr>
        <td height="30" align="right" style=" border-bottom:1px #CCCCCC dashed">手机号：</td>
        <td style=" border-bottom:1px #CCCCCC dashed" ><input name="mobile" type="text" class="input_text_200" id="mobile" maxlength="25" value=""/><label></label></td>
      </tr>
      <tr>
        <td style=" border-bottom:1px #CCCCCC dashed" height="30" align="right">会员类型：</td>
        <td style=" border-bottom:1px #CCCCCC dashed"><label style="color: rgb(0, 153, 0);">
          <input class="utype" name="utype" value="1"  type="radio">
        资金方会员</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color: rgb(102, 102, 102);">
        <input class="utype" name="utype" value="2" type="radio" checked="checked">项目方会员</label></td>
      </tr>

      <tr>
        <td style=" border-bottom:1px #CCCCCC dashed" height="30" align="right">金融网内部会员：</td>
        <td style=" border-bottom:1px #CCCCCC dashed">
        <label style="color: rgb(0, 153, 0);">
          <input class="inner" name="inner" value="1" type="checkbox">
        内部会员</label>
        </td>
      </tr>


      <tr>
        <td height="30" align="right" >登录密码：</td>
        <td style=" border-bottom:1px #CCCCCC dashed" ><input name="password" type="password" class="input_text_200" id="password" maxlength="25" value=""/><label></label></td>
      </tr>
      <tr>
        <td height="30" align="right" >再次输入密码：</td>
        <td  ><input name="repassword" type="password" class="input_text_200" id="repassword" maxlength="25" value=""/><label></label></td>
      </tr>
      <?php if(!empty($apply['Subsite'])): ?><tr>
          <td align="right">添加在：</td>
          <td colspan="4">
            <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
            <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><label style="color: rgb(102, 102, 102);">
                  <input name="subsite_id" type="radio" value="<?php echo ($subsite["s_id"]); ?>" <?php if($i == 1): ?>checked="checked"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?>
                </label>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
              <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><label style="color: rgb(102, 102, 102);">
                    <input name="subsite_id" type="radio" value="<?php echo ($subsite["s_id"]); ?>" <?php if($k == 0): ?>checked="checked"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?>
                  </label>&nbsp;&nbsp;&nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
         </td>
        </tr><?php endif; ?>
      <tr>
        <td height="30" align="right" >&nbsp;</td>
        <td   >
          <input type="hidden" id="utype" name="utype"  value="2"/>
          <input name="submit3" type="submit" class="admin_submit" value="添加"/>
          <input name="submit22" type="button" class="admin_submit" value="返 回" onclick="window.location.href='<?php echo U('member_list');?>'"/>
        </td>
      </tr>
    </table>
  </form>
</div>
<script type="text/javascript">
$('.utype').click(function() {
   var utype_val = $(this).val();
   //$("input[name='utype']").val(utype_val); 
   $("#utype").val(utype_val); 
   
})
</script>
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