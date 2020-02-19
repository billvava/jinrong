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
	var URL = '/index.php/Admin/Crm',
		SELF = '/index.php?m=Admin&amp;c=Crm&amp;a=personal_customer',
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
  <div class="toptip link_g">
    <h2>提示：</h2>
    <p>
    可见客户是指：审核通过、审核中等能正常显示的客户。<br />
    不可见客户指：审核未通过等网站前台不显示的客户。<br />
</p>
  </div>
<div class="seltpye_y">
  <div class="tit link_lan">
    <strong>客户列表</strong><span>(共找到<?php echo ($total); ?>条)</span>
    <a href="<?php echo U('index');?>">[恢复默认]</a>
    <div class="pli link_bk"><u>每页显示：</u>
      <a href="<?php echo P(array('pagesize'=>6));?>" <?php if(!$_GET['pagesize']|| $_GET['pagesize']== '6'): ?>class="select"<?php endif; ?>>6</a>
      <a href="<?php echo P(array('pagesize'=>20));?>" <?php if($_GET['pagesize']== '20'): ?>class="select"<?php endif; ?>>20</a>
      <a href="<?php echo P(array('pagesize'=>30));?>" <?php if($_GET['pagesize']== '30'): ?>class="select"<?php endif; ?>>30</a>
      <a href="<?php echo P(array('pagesize'=>60));?>" <?php if($_GET['pagesize']== '60'): ?>class="select"<?php endif; ?>>60</a>
      <div class="clear"></div>
    </div>
  </div>
  <div class="list">
    <div class="t">是否分配</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('type'=>0));?>" <?php if($_GET['type']== '' || $_GET['type']== '0'): ?>class="select"<?php endif; ?>>不限<span></span></a>
      <a href="<?php echo P(array('type'=>1));?>" <?php if($_GET['type']== 1): ?>class="select"<?php endif; ?>>未分配<span></span></a>
      <a href="<?php echo P(array('type'=>2));?>" <?php if($_GET['type']== 2): ?>class="select"<?php endif; ?>>已分配<span></span></a>
    </div>
  </div>
  
  <div class="list" >
    <div class="t">添加时间</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('addtimesettr'=>''));?>" <?php if($_GET['addtimesettr']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('addtimesettr'=>'3'));?>" <?php if($_GET['addtimesettr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
      <a href="<?php echo P(array('addtimesettr'=>'7'));?>" <?php if($_GET['addtimesettr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
      <a href="<?php echo P(array('addtimesettr'=>'30'));?>" <?php if($_GET['addtimesettr']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
    </div>
  </div>

  <div class="clear"></div>
</div>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="<?php echo U('transfer_custormer');?>">
  <table id ="table" width="100%" border="0" cellpadding="0" cellspacing="0" class="link_lan">
    <tr>
      <td width="100" class="admin_list_tit admin_list_first">
        <label id="chkAll">
        <input type="checkbox" name="" title="全选/反选" id="chk"/></label>
      uid</td>
      <td align="center" width="15%" class="admin_list_tit">
        客户姓名</td>
        <td align="center" width="140" class="admin_list_tit">负责人</td>
        <td align="center" width="12%"  class="admin_list_tit">性别</td>
        <td align="center" width="12%" class="admin_list_tit">手机号码</td>
        <td align="center" width="12%"  class="admin_list_tit">QQ</td>
        <td align="center"  width="12%"  class="admin_list_tit">电子邮箱</td>
        <td align="center"  width="100"  class="admin_list_tit">注册时间</td>
        <td  align="center"  width="200" class="admin_list_tit">操作</td>
    </tr>
      <?php if(is_array($member_list)): $i = 0; $__LIST__ = $member_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td align="left" class="admin_list admin_list_first">
        <input name="id[]" type="checkbox" id="id" value="<?php echo ($vo['id']); ?>"/>
          <?php echo ($vo['uid']); ?>
          </td>
        <td align="center" class="admin_list">
          <a href="<?php echo ($vo['resume_url']); ?>" target="_blank"><?php echo ($vo['realname']); ?></a>
        </td>
        <td align="center" class="admin_list">
          <?php echo ($vo['vip_kf_name']); ?>
          </td>
          <td align="center"  class="admin_list">
            <?php echo ($vo["sex"]); ?>
          </td>
          <td align="center"  class="admin_list">
              <a href="<?php echo U('Crm/trace_detail',array('mobile'=>$vo['mobile']));?>"><?php echo ($vo["mobile"]); ?></a>
          </td>
          <td align="center"  class="admin_list"><?php if(!empty($vo['qq'])): echo ($vo["qq"]); else: ?>未填写<?php endif; ?></td>
          <td align="center"  class="admin_list"><?php if(!empty($vo['email'])): echo ($vo["email"]); else: ?>未填写<?php endif; ?></td>
      <td align="center"  class="admin_list"><?php echo ($vo["addtime"]); ?>
        </td>
          <td align="center"  class="admin_list">
            <a class="userinfo"  parameter="uid=<?php echo ($vo['uid']); ?>" href="javascript:void(0);" hideFocus="true">管理</a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <span id="OpAudit"></span>
      <span id="OpPhotoresume"></span>
      <span id="OpImportresume"></span>
    </form>
    <?php if(!$member_list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
          <input type="button" class="admin_submit" id="ButAudit" value="转为我的客户" />
          <!--
          <input type="button" class="admin_submit" id="Butrefresh" value="刷新"/>
          <input type="button" class="admin_submit" id="ButDel" value="删除"/>
          -->
        </td>
        <td width="305" align="right">
          <form id="formseh" name="formseh" method="get" action="?">
          <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
          <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
          <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
            <div class="seh">
              <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
              <div class="sbtbox">
                <input type="submit" name="" class="sbt" id="sbt" value="搜索"/>
              </div>
              <div class="clear"></div>
            </div>
          </form>
        </td>
      </tr>
    </table>
    <div class="qspage"><?php if(!empty($count)): ?>共<?php echo ($count); ?>条&nbsp;&nbsp;<?php endif; echo ($page); ?></div>
  </div>
  <div id="AuditSet" style="display: none" >
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30"><strong  style="color:#0066CC; font-size:14px;">将从我的公海转为跟踪客户：</strong></td>
      </tr>
      <tr>
        <td width="40" height="25">&nbsp;</td>
        <td>
          <label>
            <input name="audit" type="radio" value="1" checked="checked" id="success"/>
          转到我的客户</label>
          </td>
        </tr>

        <tr>
          <td height="25">&nbsp;</td>
          <td><span>
            <input type="submit" name="set_audit" value="确定" class="admin_submit">
          </span></td>
        </tr>
      </table>
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
    <script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.entrustinfotip-min.js"></script>
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
    $("#ButAudit").QSdialog({
    DialogAddObj:"#OpAudit",
    DialogTitle:"请选择",
    DialogContent:"#AuditSet",
    DialogContentType:"id"
    });
   $(".userinfo").QSdialog({
  DialogTitle:"管理",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/userinfo');?>&"
  });
  $(".audit_log").QSdialog({
  DialogTitle:"审核日志",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/audit_log');?>&"
  });
    //点击批量删除
    $("#ButDel").click(function(){
    if (confirm('你确定要删除吗？'))
    {
    $("form[name=form1]").attr("action","<?php echo U('resume_delete');?>");
    $("form[name=form1]").submit()
    }
    });
    $("#Butrefresh").click(function(){
    $("form[name=form1]").attr("action","<?php echo U('refresh');?>");
    $("form[name=form1]").submit()
    });
    //纵向列表排序
    $(".listod .txt").each(function(i){
    var li=$(this).children(".select");
    var htm="<a href=\""+li.attr("href")+"\" class=\""+li.attr("class")+"\">"+li.text()+"</a>";
    li.detach();
    $(this).prepend(htm);
    });
    $("#not_audit").click(function(){
    $("#is_del_img").show();
    });
    $("#yes_audit").click(function(){
    $("#is_del_img").hide();
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