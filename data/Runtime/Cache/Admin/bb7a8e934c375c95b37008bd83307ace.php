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
		SELF = '/index.php?m=Admin&amp;c=Menu&amp;a=index',
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
        <p>非专业人员不得修改菜单信息。<br />删除顶级菜单将会自动删除此菜单下的子菜单。<br /></p>
    </div>
	<div class="seltpye_x">
        <div class="left">菜单类型</div>    
        <div class="right">
	        <a href="<?php echo P(array('type'=>''));?>" <?php if($_GET['type']== ''): ?>class="select"<?php endif; ?>>全部</a>
	        <a href="<?php echo P(array('type'=>1));?>" <?php if($_GET['type']== 1): ?>class="select"<?php endif; ?>>只显示菜单</a>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="classification_th">
	  <div class="th1">
	  <label><input type="checkbox" name=" " title="全选/反选" id="J_checkall" />系统菜单</label>
	  </div>
	  
	  <div class="th2">
  			<div class="thorder">排序</div>
			<div class="thedit">操作</div>
			 <div class="clear"></div>
	  </div>
	  <div class="clear"></div>
	</div>
    <form id="form1" name="form1" method="post" action="<?php echo U('menuAllSave');?>">
<div class="classification">

<?php if(is_array($menu_list)): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><div class="menubg">
	  <div class="linput">
	    <div class="td1"><input type="checkbox" name="id[]" value="<?php echo ($menu["id"]); ?>" id="<?php echo ($menu["id"]); ?>" class="J_select"/></div>
		 <input name="save_id[]" type="hidden" value="<?php echo ($menu["id"]); ?>"/>
		<div class="J_show td2" id="<?php echo ($menu["id"]); ?>" level="1"></div>
		<div class="td3"><input name="name[]" type="text" value="<?php echo ($menu["name"]); ?>" class="input_text_150"  /></div>
		<div class="td4 grey">(id:<strong><?php echo ($menu["id"]); ?></strong>controller:<strong><?php echo ($menu["controller_name"]); ?></strong>action:<strong><?php echo ($menu["action_name"]); ?></strong>)</div>
	  <div class="clear"></div>
	  </div>
	  <div class="edit">
				<div class="order"><input name="ordid[]" type="text"  value="<?php echo ((isset($menu["ordid"]) && ($menu["ordid"] !== ""))?($menu["ordid"]):"0"); ?>" class="input_text_50"/></div>
				<div class="edittxt link_lan">
						  <a href="<?php echo U('menu/add',array('pid'=>$menu['id']));?>">此类下加子类</a>
							<a href="<?php echo U('menu/edit',array('id'=>$menu['id']));?>">修改</a>
							<a href="<?php echo U('menu/delete',array('id'=>$menu['id']));?>" onclick="return confirm('你确定要删除吗？')">删除</a>
				</div>
				<div class="clear"></div>
	  </div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="menubg">
	<div class="add J_add"  level="1" parentid="0">添加顶级分类</div>
</div>


</div>
 <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
<tr>
        <td>
    <input name="ButSave" type="submit" class="admin_submit" id="ButSave" value="保存分类"/>
        <input name="ButADD" type="button" class="admin_submit" id="ButADD" value="添加分类"  onclick="window.location='<?php echo U('menu/add');?>'"/>
    </td>
        <td width="305" align="right">
    
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
<script type="text/javascript">
$(document).ready(function(){
	$("#ButSave").click(function(){

	});
var Maxlevel=5;//最多分类层数
var menu_type = "<?php echo ($_GET['type']); ?>";
//打开子菜单	
$(".J_show").live('click',function()
        {
			var infobox=$(this).closest(".menubg").next('.j_smalldiv');
			var level=$(this).attr('level');
			infobox.is(':visible')?$(this).removeClass("close"):$(this).addClass("close");	
			if (infobox.length == 0 && level<Maxlevel)
			{
			 get_menu($(this).attr('id'),$(this).closest(".menubg"),level);
			}
			else
			{
			infobox.toggle();		
			}
          
});
//子菜单全选
$(".J_select").live('click',function()
{
	var infobox=$(this).closest(".menubg,.j_smalldiv").next('.j_smalldiv');
	if (infobox.length > 0)
	{
   infobox.find("input[type=checkbox]").attr("checked",this.checked);
   }
});
//全选所有项目
$("#J_checkall").live('click',function()
{
   $(".classification").find("input[type=checkbox]").attr("checked",this.checked);
});
//添加分类
$(".J_add").live('click',function()
{
	var level=$(this).attr('level');
	var parentid=$(this).attr('parentid');
	var html='';
	html+="<div class=\"menubg\">"; 
	html+="<div class=\"linput\">";
	if (level>1)
	{
	html+="<div class=\"sbg l"+level+"\"></div>";
	}
	html+="<div class=\"td1\"><input type=\"checkbox\" name=\"id[]\" value=\"\"/></div>"; 
	html+="<div class=\"J_show td2\"></div>"; 
	html+="<div class=\"td3\"><input name=\"add_name[]\" type=\"text\"  class=\"input_text_150\"   /></div>";
	html+="<input name=\"add_pid[]\" type=\"hidden\" value=\""+parentid+"\"/>";  
	html+="<div class=\"td4\"></div>"; 
	html+="<div class=\"clear\"></div>"; 
	html+="</div>"; 
	html+="<div class=\"edit\">"; 
	html+="<div class=\"order\"><input name=\"add_ordid[]\" type=\"text\"  class=\"input_text_50\"/></div>"; 
	html+="<div class=\"edittxt link_lan\">"; 
	html+="</div>"; 
	html+="<div class=\"clear\"></div>"; 
	html+="</div>"; 
	html+="</div>";
	$(this).parent().before(html);
});
//生成分类
function get_menu(pid,thisobj,level)
{
            var tsTimeStamp= new Date().getTime();
            $.getJSON("<?php echo U('menu/index');?>", {"pid":pid,'type':menu_type},function(result){  
                    if (result.status==1){
					 var html="";
					 var leftbg="";
                     var i=1;
					 level++;
                        for (x in result.data)
						{
                     		html+="<div class=\"menubg\">"; 
							html+="<div class=\"linput\">";
							html+="<div class=\"sbg l"+level+"\"></div>";
							html+="<div class=\"td1\"><input type=\"checkbox\" name=\"id[]\" value=\""+result.data[x]['id']+"\" id=\""+result.data[x]['id']+"\"  class=\"J_select\"/></div>"; 
							html+="<input name=\"save_id[]\" type=\"hidden\" value=\""+result.data[x]['id']+"\"/>"; 
							html+="<div class=\"J_show td2\" id=\""+result.data[x]['id']+"\" level=\""+level+"\"></div>"; 
							html+="<div class=\"td3\"><input name=\"name[]\" type=\"text\" value=\""+result.data[x]['name']+"\" class=\"input_text_150\"  /></div>"; 
							html+="<div class=\"td4 grey\">(id:<strong>"+result.data[x]['id']+"</strong>controller:<strong>"+result.data[x]['controller_name']+"</strong>action:<strong>"+result.data[x]['action_name']+"</strong>)</div>"; 
							html+="<div class=\"clear\"></div>"; 
							html+="</div>"; 
							html+="<div class=\"edit\">"; 
							html+="<div class=\"order\"><input name=\"ordid[]\" type=\"text\"  value=\""+result.data[x]['ordid']+"\" class=\"input_text_50\"/></div>"; 
							html+="<div class=\"edittxt link_lan\">"; 
							html+="<a href=\"<?php echo U('menu/add');?>&pid="+result.data[x]['id']+"\">此类下加子类</a>"; 
							html+="<a href=\"<?php echo U('menu/edit');?>&id="+result.data[x]['id']+"\">修改</a>"; 
							html+="<a href=\"<?php echo U('menu/delete');?>&id="+result.data[x]['id']+"\" onclick=\"return confirm('你确定要删除吗？')\" >删除</a>"; 
							html+="</div>"; 
							html+="<div class=\"clear\"></div>"; 
							html+="</div>"; 
							html+="</div>";
                            i++;
                        }
						html+="<div class=\"smalladd l"+level+"\"><div class=\"J_add adds \" level=\""+level+"\" parentid=\""+pid+"\">添加分类</div></div>";
						thisobj.after('<div class="j_smalldiv">'+html+'</div>');  
				
						  
                    }
                 }
            );
}
});
</script>
</body>
</html>