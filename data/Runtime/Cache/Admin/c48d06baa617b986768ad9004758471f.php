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
	var URL = '/index.php/Admin/Ad',
		SELF = '/index.php?m=Admin&amp;c=Ad&amp;a=index',
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
        <p>系统将自动下架到期广告。<br />按广告位显示广告请点击右下角按钮
        </p>
    </div>
    <div class="seltpye_y">
        <div class="tit link_lan">
            <strong>广告列表</strong>
            <span>(共找到<?php echo ($total); ?>条)</span>
            <a href="<?php echo U('MembersLog/index');?>">[恢复默认]</a>
            <div class="pli link_bk">
                <u>每页显示：</u>
                <a href="<?php echo P(array('pagesize'=>10));?>" <?php if($pagesize == 10): ?>class="select"<?php endif; ?>>10</a>
                <a href="<?php echo P(array('pagesize'=>20));?>" <?php if($pagesize == 20): ?>class="select"<?php endif; ?>>20</a>
                <a href="<?php echo P(array('pagesize'=>30));?>" <?php if($pagesize == 30): ?>class="select"<?php endif; ?>>30</a>
                <a href="<?php echo P(array('pagesize'=>60));?>" <?php if($pagesize == 60): ?>class="select"<?php endif; ?>>60</a>
                <div class="clear"></div>
            </div>
        </div>
        <?php if(!empty($apply['Subsite'])): ?><div class="list" >
          <div class="t">所属分站</div>
          <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
          <div class="txt link_lan">
            <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id'] or ( $_GET['subsite_id']== 0 and $key == 0 )): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
              <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
          </div>
        </div><?php endif; ?>
        <div class="list">
            <div class="t">到期时间</div>     
            <div class="txt link_lan">
                <a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
                <a href="<?php echo P(array('settr'=>0));?>" <?php if($_GET['settr']== '0'): ?>class="select"<?php endif; ?>>已经到期</a>
                <a href="<?php echo P(array('settr'=>3));?>" <?php if($_GET['settr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
                <a href="<?php echo P(array('settr'=>7));?>" <?php if($_GET['settr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
            </div>
        </div>
        <div class="list">
            <div class="t">显示状态</div>     
            <div class="txt link_lan">
                <a href="<?php echo P(array('is_display'=>''));?>" <?php if($_GET['is_display']== ''): ?>class="select"<?php endif; ?>>不限</a>
                <a href="<?php echo P(array('is_display'=>1));?>" <?php if($_GET['is_display']== '1'): ?>class="select"<?php endif; ?>>正常</a>
                <a href="<?php echo P(array('is_display'=>0));?>" <?php if($_GET['is_display']== '0'): ?>class="select"<?php endif; ?>>停止</a>
            </div>
        </div>
        <div class="list">
            <div class="t">广告位</div>     
            <div class="txt link_lan">
                <a href="<?php echo P(array('alias'=>''));?>" <?php if($_GET['alias']== ''): ?>class="select"<?php endif; ?>>不限</a>
                <?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('alias'=>$category['alias']));?>" <?php if($_GET['alias']== $category['id']): ?>class="select"<?php endif; ?>><?php echo ($category["categoryname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <form id="form1" name="form1" method="post" action="<?php echo U('Ad/delete');?>">
        <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
        <tr>
          <td   class="admin_list_tit admin_list_first">
         <label id="chkAll"><input type="checkbox" name="" title="全选/反选" id="chk"/>广告标题</label>
         </td>
          <td width="16%"  class="admin_list_tit">所属广告位</td>
          <td width="7%" align="center"  class="admin_list_tit">类型</td>
          <td width="9%" align="center"  class="admin_list_tit">开始时间</td>
          <td width="9%" align="center"  class="admin_list_tit">到期时间</td>     
          <td width="7%" align="center"  class="admin_list_tit">状态</td>
          <td width="6%" align="center"  class="admin_list_tit">排序</td>
          <td width="10%" align="center"  class="admin_list_tit">操作</td>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
              <td   class="admin_list admin_list_first">
             <input type="checkbox" name="id[]"  value="<?php echo ($list["id"]); ?>"/>
            <a href="<?php echo U('Ad/edit',array('id'=>$list['id']));?>" <?php if($list['text_color']): ?>style="color:<?php echo ($list["text_color"]); endif; ?> <?php if($list['type_id'] == 1): ?>class="vtip" title="<?php echo ($list["content"]); ?>"<?php endif; ?> <?php if($list['type_id'] == 2): ?>class="vtip" title='<img src="<?php echo attach($list['content'],'ads');?>"/>'<?php endif; ?>><?php echo ($list["title"]); ?></a>
              <?php if($list['note'] != ''): ?><img src="__ADMINPUBLIC__/images/comment_alert.gif" border="0"  class="vtip" title="<?php echo ($list["note"]); ?>"/><?php endif; ?>   
             </td>
              <td  class="admin_list">
              <?php echo ($category_list[$list['alias']]['categoryname']); ?>
              </td>
              <td align="center"  class="admin_list">
                  <?php switch($list['type_id']): case "1": ?>文字<?php break;?>
                      <?php case "2": ?>图片<?php break;?>
                      <?php case "3": ?>代码<?php break;?>
                      <?php case "4": ?>FLASH<?php break;?>
                      <?php case "5": ?>浮动<?php break;?>
                      <?php case "6": ?>视频<?php break; endswitch;?>
              </td>
              <td align="center"  class="admin_list">
                <?php if($list['starttime'] == 0): ?>无限制
                <?php else: ?>
                    <?php echo date('Y-m-d',$list['starttime']); endif; ?>
             </td>
              <td align="center"  class="admin_list">
                <?php if($list['deadline'] == 0): ?>无限制
                <?php elseif($list['deadline'] <= time()): ?>
                    <span style="color:#56C6FF">已经到期</span>
                <?php else: ?>
                    <?php echo date('Y-m-d',$list['deadline']); endif; ?>
                </td>   
              <td align="center"  class="admin_list">
                <?php if($list['is_display'] == 1): ?>正常
                <?php else: ?>
                    <span style="color:#999999">暂停</span><?php endif; ?>
              </td>
              <td align="center"  class="admin_list"><?php echo ($list["show_order"]); ?></td>
              <td align="center"  class="admin_list">
              <a href="<?php echo U('Ad/edit',array('id'=>$list['id']));?>">修改</a>
              &nbsp; &nbsp; 
              <a href="<?php echo U('Ad/delete',array('id'=>$list['id']));?>"  onclick="return confirm('你确定要删除吗？')">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
    </form>
    <?php if(empty($list)): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
    <tr>
        <td>
        <input type="button" class="admin_submit" id="ButADD" value="添加广告"  onclick="window.location='<?php echo U('Ad/add');?>'"/>
        <input type="button" class="admin_submit" id="ButDel"  value="删除"/>
        </td>
        <td width="305" align="right">
            <form id="formseh" name="formseh" method="get" action="">  
                <div class="seh">
                    <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
                    <div class="selbox">
                        <input id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"广告标题"); ?>" readonly="true"/>
                        <div>
                            <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
                            <div id="sehmenu" class="seh_menu">
                                <ul>
                                    <li id="1" title="广告标题">广告标题</li>
                                </ul>
                            </div>
                        </div>              
                    </div>
                    <div class="sbtbox">
                        <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
                        <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
                        <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
                        <input type="submit" name="" class="sbt" id="sbt" value="搜索"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </td>
      </tr>
    </table>
    <div class="qspage"><?php echo ($page); ?></div>
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
    showmenu("#key_type_cn","#sehmenu","#key_type");
 //点击批量删除   
    $("#ButDel").click(function(){
        if (confirm('你确定要删除吗？'))
        {
            $("form[name=form1]").submit()
        }
    });
    //纵向列表排序
    $(".listod .txt").each(function(i){
    var li=$(this).children(".select");
    var htm="<a href=\""+li.attr("href")+"\" class=\""+li.attr("class")+"\">"+li.text()+"</a>";
    li.detach();
    $(this).prepend(htm);
    });    
});
</script>
</body>
</html>