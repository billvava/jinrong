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
		SELF = '/index.php?m=Admin&amp;c=Personal&amp;a=member_list',
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
<style>
  #vtip img{width: 180px;}
</style>
  <div class="seltpye_x">
    <div class="left">验证类型</div>
    <div class="right">
      <a href="<?php echo P(array('verification'=>''));?>" <?php if($_GET['verification']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('verification'=>'3'));?>" <?php if($_GET['verification']== '3'): ?>class="select"<?php endif; ?>>手机已验证</a>
      <a href="<?php echo P(array('verification'=>'4'));?>" <?php if($_GET['verification']== '4'): ?>class="select"<?php endif; ?>>手机未验证</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="seltpye_x">
    <div class="left">注册时间</div>
    <div class="right">
      <a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('settr'=>'3'));?>" <?php if($_GET['settr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
      <a href="<?php echo P(array('settr'=>'7'));?>" <?php if($_GET['settr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
      <a href="<?php echo P(array('settr'=>'30'));?>" <?php if($_GET['settr']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
      <a href="<?php echo P(array('settr'=>'180'));?>" <?php if($_GET['settr']== '180'): ?>class="select"<?php endif; ?>>半年内</a>
      <a href="<?php echo P(array('settr'=>'360'));?>" <?php if($_GET['settr']== '360'): ?>class="select"<?php endif; ?>>一年内</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  
  <div class="seltpye_x">
    <div class="left">用户类型</div>
    <div class="right">
      <a href="<?php echo P(array('utype'=>''));?>" <?php if($_GET['utype']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('utype'=>'1'));?>" <?php if($_GET['utype']== '1'): ?>class="select"<?php endif; ?>>资金方会员</a>
      <a href="<?php echo P(array('utype'=>'2'));?>" <?php if($_GET['utype']== '2'): ?>class="select"<?php endif; ?>>项目方会员</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>


  <form id="form1" name="form1" method="post" action="<?php echo U('member_delete');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
      <tr>
        <td  width="20%" class="admin_list_tit admin_list_first" >
          <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>用户名</label></td>
          <td  width="20%" class="admin_list_tit">email</td>
          <td  align="center" width="120"  class="admin_list_tit">手机</td>
          <td align="center"   class="admin_list_tit">注册时间</td>
          <td    align="center"   class="admin_list_tit">注册IP</td>
          <td    align="center"   class="admin_list_tit">注册地址</td>
          <td   align="center"   class="admin_list_tit">最后登录时间</td>
          
          <td width="13%"  align="center"  class="admin_list_tit" >操作</td>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td class="admin_list admin_list_first">
            <input name="tuid[]" type="checkbox"   value="<?php echo ($vo['uid']); ?>"/>
            <?php echo ($vo['username']); ?>
            <?php if($vo['avatars'] != ''): ?><span style="color: #009900"  class="vtip" title="<img src='<?php echo attach($vo['avatars'],'avatar');?>'  border=0  align=absmiddle>">[照片]</span><?php endif; ?>
          </td>
            <td class="admin_list">
			
			<span  <?php if($vo['email_audit'] == '1'): ?>style="color:#009900"<?php endif; ?>><?php echo ((isset($vo['email']) && ($vo['email'] !== ""))?($vo['email']):"未填写"); ?></span>
             <?php if($vo['email']): ?><span class="emailtip ajax_send_email" title="发送邮件" parameter="email=<?php echo ($vo['email']); ?>&uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php endif; ?>
              
            </td>
            <td align="center" class="admin_list">
              <?php if($vo['mobile']): ?><span <?php if($vo['mobile_audit'] == '1'): ?>style="color:#009900"<?php endif; ?>> <?php echo ($vo['mobile']); ?></span>
			  <span class="smstip ajax_send_sms" title="发送短信" parameter="mobile=<?php echo ($vo['mobile']); ?>&uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php else: ?>未填写<?php endif; ?>
           
            </td>
            <td align="center" class="admin_list">
            <?php echo (date("Y-m-d H:i",$vo['reg_time'])); ?>   </td>
            <td align="center" class="admin_list">
            <?php echo ((isset($vo['reg_ip']) && ($vo['reg_ip'] !== ""))?($vo['reg_ip']):" - - - -"); ?></td>
            <td align="center" class="admin_list"><?php echo ($vo['ipAddress']); ?></td>
            <td align="center" class="admin_list">
              <?php if($vo['last_login_time']): echo (date("Y-m-d H:i",$vo['last_login_time'])); ?>
              <?php else: ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;从未登录<?php endif; ?>
			  <span class="view login_log" title="最新5次登录记录" parameter="id=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td align="center" class="admin_list">
              <a href="<?php echo U('member_edit',array('uid'=>$vo['uid'],'_k_v'=>$vo['uid']));?>">编辑</a>
              &nbsp;
              <a class="userinfo"  parameter="uid=<?php echo ($vo['uid']); ?>" href="javascript:void(0);" hideFocus="true">管理</a>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <span id="DelSel"></span>
       <span id="OpPhotoresume"></span>
      </form>
      <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
      <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
        <tr>
          <td>
            <input type="button" name="ButAdd" value="添加会员" class="admin_submit"  onclick="window.location.href='<?php echo U('member_add');?>'"/>
            <input type="button" name="ButDel"  id="ButDel" value="删除会员" class="admin_submit"/>
          </td>
          <td width="305" align="right">
            <form id="formseh" name="formseh" method="get" action="?">
              <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
              <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
              <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
              <div class="seh">
                <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
                <div class="selbox">
                  <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):'手机号'); ?>" readonly="true"/>
                  <div>
                    <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"4"); ?>" />
                    <div id="sehmenu" class="seh_menu">
                      <ul>
                      <li id="4" title="手机号">手机号</li>
                      <li id="2" title="uid">uid</li>
                      <li id="1" title="用户名">用户名</li>
                      <li id="5" title="信息id">info_id</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="sbtbox">
                  <input type="submit" name="" class="sbt" id="sbt" value="搜索"/>
                </div>
                <div class="clear"></div>
              </div>
            </form>
          </td>
        </tr>
      </table>
      <div class="qspage"><?php echo ($page); ?></div>
      <div id="GetDelInfo" style="display: none" >
        <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
          <tr>
            <td width="30" height="30">&nbsp;</td>
            <td height="30"><strong  style="color:#0066CC; font-size:14px;">你确定要删除吗？</strong></td>
          </tr>
          <tr>
            <td width="27" height="25">&nbsp;</td>
            <td><label>
              <input name="delete_user" type="checkbox" id="delete_user" value="yes" checked="checked" />
            删除此会员 <span style="color:#666666">(删除后此会员将无法登录，无法管理已发布的信息等)<span></label></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td><input type="submit" name="delete" value="确定删除" class="admin_submit"/></td>
          </tr>
        </table>
      </div>
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
  $(".ajax_send_sms").QSdialog({
    DialogTitle:"发送短信",
    DialogContentType:"url",
    DialogContent:"<?php echo U('Ajax/ajax_send_sms');?>&"
    });
  $(".ajax_send_email").QSdialog({
    DialogTitle:"发送邮件",
    DialogContentType:"url",
    DialogContent:"<?php echo U('Ajax/ajax_send_email');?>&"
    });
  showmenu("#key_type_cn","#sehmenu","#key_type");
$("#ButDel").QSdialog({
DialogAddObj:"#DelSel",
DialogTitle:"请选择",
DialogContent:"#GetDelInfo",
DialogContentType:"id",
DialogWidth:"500"
});
 $(".userinfo").QSdialog({
  DialogTitle:"管理",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/userinfo');?>&"
  });
 $(".login_log").QSdialog({
  DialogTitle:"最新5次登录记录",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/login_log');?>&"
  });
  $("#ButPhotoresume").QSdialog({
  DialogAddObj:"#OpPhotoresume",
  DialogTitle:"请选择",
  DialogContent:"#PhotoresumeSet",
  DialogContentType:"id"
  });
    $("#photo_submit").live('click',function(){
      $("form[name=form1]").attr("action","<?php echo U('set_photoaudit');?>");
      $("form[name=form1]").submit();
    });
    $('input[name="photoaudit"]').live('click',function(){
      if($(this).val() == 3){
        $('#is_del_img').show();
      }else{
        $('#is_del_img').hide();
      }
    });
});
</script>

<script type="text/javascript" src="../public/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="../public/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../public/js/jquery.ui.position.js"></script>
<script type="text/javascript" src="../public/js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript">
$(function(){
$("#key").autocomplete({
    source: "<?php echo U('Ajax/ajax_kefu');?>",
    minLength: 1,
    autoFocus: true
});
});
</script>
  </body>
</html>