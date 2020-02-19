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
	var URL = '/index.php/Admin/Feedback',
		SELF = '/index.php?m=Admin&amp;c=Feedback&amp;a=index',
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
    <div class="seltpye_x">
        <div class="left">分类显示</div>    
        <div class="right">
        <a href="<?php echo P(array('infotype'=>''));?>" <?php if($_GET['infotype']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('infotype'=>1));?>" <?php if($_GET['infotype']== 1): ?>class="select"<?php endif; ?>>意见</a>
        <a href="<?php echo P(array('infotype'=>2));?>" <?php if($_GET['infotype']== 2): ?>class="select"<?php endif; ?>>建议</a>
        <a href="<?php echo P(array('infotype'=>3));?>" <?php if($_GET['infotype']== 3): ?>class="select"<?php endif; ?>>求助</a>
        <a href="<?php echo P(array('infotype'=>4));?>" <?php if($_GET['infotype']== 4): ?>class="select"<?php endif; ?>>投诉</a>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="seltpye_x">
        <div class="left">处理状态</div>    
        <div class="right">
        <a href="<?php echo P(array('audit'=>''));?>" <?php if($_GET['audit']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('audit'=>'1'));?>" <?php if($_GET['audit']== '1'): ?>class="select"<?php endif; ?>>未处理<?php if($count): ?><span>(<?php echo ($count); ?>)</span><?php endif; ?></a>
        <a href="<?php echo P(array('audit'=>2));?>" <?php if($_GET['audit']== 2): ?>class="select"<?php endif; ?>>已处理</a>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="seltpye_x">
        <div class="left">添加时间</div>    
        <div class="right">
        <a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('settr'=>3));?>" <?php if($_GET['settr']== 3): ?>class="select"<?php endif; ?>>三天内</a>
        <a href="<?php echo P(array('settr'=>7));?>" <?php if($_GET['settr']== 7): ?>class="select"<?php endif; ?>>一周内</a>
        <a href="<?php echo P(array('settr'=>30));?>" <?php if($_GET['settr']== 30): ?>class="select"<?php endif; ?>>一月内</a>
        <a href="<?php echo P(array('settr'=>180));?>" <?php if($_GET['settr']== 180): ?>class="select"<?php endif; ?>>半年内</a>
        <a href="<?php echo P(array('settr'=>360));?>" <?php if($_GET['settr']== 360): ?>class="select"<?php endif; ?>>一年内</a>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <form id="form1" name="form1" method="post" action="<?php echo U('feedback/delete');?>">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
            <tr>
            <td width="80" class="admin_list_tit admin_list_first" >
            <label id="chkAll">
            <input type="checkbox" name="" title="全选/反选" id="chk"/>类型</label></td>
            <td width="40%" class="admin_list_tit">内容</td>
            <td width="80" align="center" class="admin_list_tit" >核实情况</td>
            <td align="center" class="admin_list_tit">联系方式</td>
            <td width="120" align="center" class="admin_list_tit">添加时间</td>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                <td   class="admin_list admin_list_first" >
                <input name="id[]" type="checkbox" id="id" value="<?php echo ($list["id"]); ?>"/>
                <?php switch($list['infotype']): case "1": ?>意见<?php break;?>
                    <?php case "2": ?>建议<?php break;?>
                    <?php case "3": ?>求助<?php break;?>
                    <?php case "4": ?>投诉<?php break; endswitch;?> 
                </td>
                <td  class="admin_list vtip" title="<?php echo (nl2br($list["feedback"])); ?>"><?php echo ($list["feedback"]); ?></td>
                <td align="center" class="admin_list">
                    <?php switch($list['audit']): case "1": ?><font color="red">未处理</font><?php break;?>
                        <?php case "2": ?><font color="green">已处理</font><?php break; endswitch;?> 
                </td>
                <td align="center" class="admin_list"><?php echo ($list["tel"]); ?></td>
                <td align="center" class="admin_list"><?php echo date('Y-m-d',$list['addtime']);?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <?php if(empty($list)): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
        <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
            <tr>
                <td>
                <input type="button" class="admin_submit" id="ButSet" value="处理状态"/>
                <input type="submit" class="admin_submit" id="ButDel" value="删除所选"/>
                </td>
                <td width="305" align="right"></td>
            </tr>
        </table>
        <span id="OpSet"></span>
    </form>
    <div class="qspage"><?php echo ($page); ?></div>
</div>
<div style="display:none" id="OpSetLayer">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td width="20" height="30">&nbsp;</td>
      <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选记录设置为：</strong></td>
    </tr>
    
    <tr>
      <td height="25">&nbsp;</td>
      <td>
      <label><input name="audit" type="radio" value="2" checked="checked"/>
        已处理 </label>
        </td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><label>
          <input type="radio" name="audit" value="1" />
        未处理</label></td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><input type="button" name="set_status" id="set_status" value="确定" class="admin_submit"/></td>
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
<script type="text/javascript">
$("#ButSet").QSdialog({
          DialogAddObj:"#OpSet",
          DialogTitle:"请选择",
          DialogContent:"#OpSetLayer",
          DialogContentType:"id"
          });
    $("#set_status").live('click',function(){
            $("#form1").attr('action',"<?php echo U('set_audit');?>");
            $("#form1").submit();
        });
</script>
</body>
</html>