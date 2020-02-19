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
		SELF = '/index.php?m=Admin&amp;c=Crm&amp;a=trace_log',
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
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="<?php echo U('throw_into_sea');?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="link_lan">
    <tr>
      <td width="100" class="admin_list_tit admin_list_first">
        <label id="chkAll">
    <input type="checkbox" name="" title="全选/反选" id="chk"/></label>
      uid</td>
      <td align="center" width="15%" class="admin_list_tit">
        客户姓名</td>
        <td align="center" width="140" class="admin_list_tit">之前负责人</td>
        <td align="center" width="140" class="admin_list_tit">现任负责人</td>
        <td align="center" width="12%" class="admin_list_tit">手机号码</td>
        <td align="center"  width="100"  class="admin_list_tit">跟进情况</td>
        <td align="center"  width="100"  class="admin_list_tit">跟进时间</td>
        <td align="center"  width="100"  class="admin_list_tit">注册时间</td>
        <td align="center"  width="50"  class="admin_list_tit">状态</td>
    </tr>
      <?php if(is_array($trace_log)): $i = 0; $__LIST__ = $trace_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td align="left" class="admin_list admin_list_first">
        <input name="id[]" type="checkbox" id="id" value="<?php echo ($vo['id']); ?>"/>
          <?php echo ($vo['uid']); ?>
          </td>
        <td align="center" class="admin_list">
            <?php if(!empty($vo[name])): echo ($vo['name']); else: echo ($vo['realname']); endif; ?>
        </td>
        <td align="center" class="admin_list">
          <?php echo ($vo['cid']); ?>
          </td>
          <td align="center" class="admin_list">
          <?php echo ($vo['new_cid']); ?>
          </td>
          <td align="center" class="admin_list"><?php echo ($vo["mobile"]); ?></td>
<td align="center" class="admin_list vtip" title="<?php echo ($vo["notes"]); ?>"><?php echo ($vo["notes"]); ?></td>
<td align="center" class="admin_list"><?php echo date('Y-m-d H:i:s',$vo['addtime']);?></td>
<td align="center" class="admin_list"><?php echo date('Y-m-d H:i:s',$vo['reg_time']);?></td>
         <td align="center" class="admin_list"><?php if(vo['is_locked'] == 1): ?><span style="color:#f00;"><?php echo ($vo["is_locked"]); ?></span><?php else: echo ($vo["is_locked"]); endif; ?>
        </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
    </form>

    <?php if(!$trace_log): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
<style type="text/css">
    .tj_trace_log:hover{color:#000;}
</style>
    <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">  
      <tr>
      <td>
          <a style="display: block;text-decoration:none;color:#000;" class="admin_submit tj_trace_log" href="<?php echo U('Crm/trace_detail');?>">添加跟进记录</a>
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
    DialogTitle:"请选择踢进公海客户",
    DialogContent:"#AuditSet",
    DialogContentType:"id"
    });

    $(".custormer_info").QSdialog({
        DialogTitle:"管理",
        DialogContentType:"url",
        DialogContent:"<?php echo U('ajax/custormer_info');?>&"
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
<!--
<script type="text/javascript">
$("#show_trace_detail").click(function(){
$("#form1").css('display','block');
$(this).hide();
$('#trace_record').hide();
});
</script>
-->
</body>
</html>