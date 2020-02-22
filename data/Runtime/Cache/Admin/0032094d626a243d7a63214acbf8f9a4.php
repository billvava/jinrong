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
	var URL = '/index.php/Admin/BaseInfo',
		SELF = '/index.php?m=Admin&amp;c=BaseInfo&amp;a=edit&amp;id=21206',
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
<div class="toptit">信息审核</div>
<form id="form1" name="form1" method="post" action="<?php echo U();?>" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="4" cellspacing="0"  >
<tr>
<td style=" border-bottom:1px #CCCCCC dashed" height="30" align="right">信息置顶：</td>
<td style=" border-bottom:1px #CCCCCC dashed"><label style="color: rgb(0, 153, 0);">
<input name="is_top" type="radio" id="is_top" value="1" <?php if($info['is_top'] == 1): ?>checked="checked"<?php endif; ?>/>是</label>
&nbsp;&nbsp;&nbsp;&nbsp;
<label >
<input type="radio" name="is_top" value="0" <?php if($info['is_top'] == 0): ?>checked="checked"<?php endif; ?>/>否</label>        


</td>
</tr>


<tr>
<td align="right">置顶缩略图：</td>
        <td colspan="2" >
          <?php if($info['top_img']): ?><a href="<?php echo attach($info['top_img'],'images');?>" target="_blank" >
            <img src="<?php echo attach($info['top_img'],'images');?>" border="0"/>
             </a>
             <!--
             <a href="<?php echo U('article/del_img',array('id'=>$info['id']));?>" style="color: #006600">
             [删除重新上传]
             </a>
             -->
          <?php else: ?>
              <input type="file" name="top_img" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false" style="height:21px; width:210px; border:1px #999999 solid" /><?php endif; ?>
</td>
</tr>


<tr>
<td style=" border-bottom:1px #CCCCCC dashed" height="30" align="right">信息审核：</td>
<td style=" border-bottom:1px #CCCCCC dashed"><label style="color: rgb(0, 153, 0);">
<input name="is_open" type="radio" id="is_open" value="1" <?php if($info['is_open'] == 1): ?>checked="checked"<?php endif; ?>/>是</label>
&nbsp;&nbsp;&nbsp;&nbsp;
<label>
<input type="radio" name="is_open" value="2" <?php if($info['is_open'] == 2): ?>checked="checked"<?php endif; ?>/>否</label>        

</td>
</tr>

<tr>
<td height="30" align="right" >&nbsp;</td>
<td>
<input type="hidden" value="<?php echo ($info["id"]); ?>" id="id" name="id">
<input name="submit3" type="submit" class="admin_submit" value="保存"/>
<input name="submit22" type="reset" class="admin_submit" value="重置"/>
</td>
</tr>
</table>
</form>

<div class="toptit mt15">信息留言管理</div>
<form id="form1" name="form1" method="post" action="<?php echo U('article/delete');?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="link_lan" id="list">
<tr>
<td width="50" height="26" class="admin_list_tit admin_list_first" >
<label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>id</label></td>
<td width="100" align="left" class="admin_list_tit">留言内容</td>
<td width="100" align="right"  class="admin_list_tit">留言方式</td>
<td width="120" align="center" class="admin_list_tit">评论时间</td>
<td width="100" align="center" class="admin_list_tit">状态</td>
<td width="100" align="left" class="admin_list_tit">操作</td>
</tr>
<?php if(is_array($msg_list)): $i = 0; $__LIST__ = $msg_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr rel="<?php echo ($vo['id']); ?>">
<td class="admin_list admin_list_first">
<input name="id[]" type="checkbox" id="id" value="<?php echo ($vo['id']); ?>"/>
[<?php echo ($vo["id"]); ?>]
</td>
<td align="left" class="admin_list vtip" title="<?php echo ($vo["content"]); ?>"><?php echo cut_str($vo['content'],50);?></td>
<td align="right" class="admin_list"><?php echo ($vo['public']); ?></td>
<td align="center" class="admin_list"><?php echo date('Y-m-d H-i-s',$vo['addtime']);?></td>
<td align="center"><?php if($vo[is_show] == 1): ?><span rel="1" style="color:#5CB85C" class="changeDefault iconfont icon-duihao"></span><?php else: ?><span rel="0" style="color:#f00" class="changeDefault iconfont icon-cuowu"></span><?php endif; ?></td>
<td><a href="">管理</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</form>

<table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
<tbody>
<tr>
<td>
<input type="button" name="ButAdd" value="编辑" class="admin_submit" id="message_edit">
</td>
</tr>
</tbody>
</table>

<div id="message" style="display: none" >
<table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
<tr>
<td height="30">&nbsp;</td>
<td height="30"><strong  style="color:#0066CC; font-size:14px;">选取留言进行审核：</strong></td>
</tr>
<tr>
<td width="40" height="25">&nbsp;</td>
<td>
<label>
<input name="audit" type="radio" value="1" checked="checked"/>
允许 </label>

<label>
<input name="audit" type="radio" value="0" checked="checked"/>
禁止 </label>

</td>
</tr>
<tr>
<td height="25">&nbsp;</td>
<td><span>
<input type="submit" id="into_sea" name="set_audit" value="确定" class="admin_submit">
</span></td>
</tr>
</table>
</div>
</div>
<script type="text/javascript">
$("#message_edit").QSdialog({
DialogTitle:"留言修改审核",
DialogContent:"#message",
DialogContentType:"id"
});
/*
$("#into_sea").live('click',function(){
$("form[name=form1]").attr("action","/index.php?m=Admin&c=Crm&a=throw_into_sea");
$("form[name=form1]").submit()
});
*/
</script>
<script type="text/javascript">
$(function(){
    $(".changeDefault").live("click",function(){
    var e=$(this);
        var id = e.parent().parent().attr("rel");
        var is_show = e.attr("rel");
        $.post("<?php echo U('Msg/Api/change_status');?>",{'id':id,'is_show':is_show},function(data){
              is_show = data.state;
              if(is_show == "1"){
                    e.parent().empty().html("<span rel='1' style='color:#5CB85C' class='changeDefault iconfont icon-duihao'></span>");
              }else{
                    e.parent().empty().html("<span rel='0' style='color:#f00' class='changeDefault iconfont icon-cuowu'></span>");
              }
        });
    });
});
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