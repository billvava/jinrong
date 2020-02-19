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
		SELF = '/index.php?m=Admin&amp;c=Personal&amp;a=member_edit&amp;uid=26038&amp;_k_v=26038',
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
  <div class="toptit">基本信息 <span style="color:#0066CC">(<?php echo ($info["username"]); ?>)</span> </div>
  <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
    <tr>
      <td width="120" height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">注册时间：</td>
      <td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" ><?php echo (date("Y-m-d H:i",$info["reg_time"])); ?></td>
      <td width="120" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >最后登录时间：</td>
      <td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" ><?php echo (date("Y-m-d H:i",$info["last_login_time"])); ?></td>
    </tr>
    <tr>
      <td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">注册IP：</td>
      <td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" ><?php echo ((isset($info["reg_ip"]) && ($info["reg_ip"] !== ""))?($info["reg_ip"]):"- - - -"); ?></td>
      <td align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >最后登录IP：</td>
      <td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" ><?php echo ((isset($info["last_login_ip"]) && ($info["last_login_ip"] !== ""))?($info["last_login_ip"]):"- - - -"); ?></td>
    </tr>
    </table>
    <div class="toptit">基本信息</div>
    <form id="form4" name="form4" method="post" action="<?php echo U('member_edit');?>">
      <table width="700" border="0" cellpadding="4" cellspacing="0"   >
        <tr>
          <td width="120" height="30" align="right"  style=" border-bottom:1px #CCCCCC dashed">用户名：</td>
          <td  style=" border-bottom:1px #CCCCCC dashed;" >
            <input name="username" type="text" class="input_text_200"   maxlength="50" value="<?php echo ($info['username']); ?>"  >
          </td>
        </tr>
        <tr>
          <td width="120" height="30" align="right"  style=" border-bottom:1px #CCCCCC dashed">邮箱：</td>
          <td  style=" border-bottom:1px #CCCCCC dashed;" >
            <input name="email" type="text" class="input_text_200"   maxlength="50" value="<?php echo ($info['email']); ?>"  >
            
            &nbsp;&nbsp;&nbsp;
            <label>
              <input class="email_audit" type="checkbox" value="1" <?php if($info['email_audit'] == '1'): ?>checked="checked"<?php endif; ?> />
            已验证</label>
          </td>
        </tr>
        <tr>
          <td width="120" height="30" align="right"  style=" border-bottom:1px #CCCCCC dashed">手机：</td>
          <td  style=" border-bottom:1px #CCCCCC dashed;" >
            <input name="mobile" type="text" class="input_text_200"   maxlength="50" value="<?php echo ($info['mobile']); ?>"  >
            
            &nbsp;&nbsp;&nbsp;
            <label>
              <input class="mobile_audit" type="checkbox" value="1" <?php if($info['mobile_audit'] == '1'): ?>checked="checked"<?php endif; ?> />
            已验证</label>
          </td>
        </tr>
        <tr>
          <td width="120" height="30" align="right"  style=" border-bottom:1px #CCCCCC dashed">QQ绑定：</td>
          <td  style=" border-bottom:1px #CCCCCC dashed;" >
            <!-- 
            待开发
            <?php if($info['qq_openid']): ?>已绑定QQ账号
            &nbsp;&nbsp;&nbsp;
            <label>
              <input type="checkbox" name="qq_openid" value="1"  />
            取消绑定</label>
            <?php else: ?>
            未绑定QQ帐号<?php endif; ?> -->
          </td>
        </tr>
        <tr>
          <td height="30" align="right"  >&nbsp;</td>
          <td height="50"  >
            <input type="hidden" name="uid"  value="<?php echo ($info['uid']); ?>" />
            <input name="_k_v" type="hidden" value="<?php echo ($_GET['_k_v']); ?>">
            <input type="hidden" name="mobile_audit" value="<?php echo ($info['mobile_audit']); ?>">
            <input type="hidden" name="email_audit" value="<?php echo ($info['email_audit']); ?>">
            <input name="submit32" type="submit" class="admin_submit"    value="确定"/>
            <input name="submit222" type="button" class="admin_submit"    value="返 回" onclick="Javascript:window.history.go(-1)"/>        </td>
          </tr>
        </table>
      </form>
      
      <div class="toptit">用户状态</div>
      <form id="form9" name="form9" method="post" action="<?php echo U('member_edit');?>">
        <table width="100%" border="0" cellpadding="4" cellspacing="0"   >
          <tr>
            <td width="120" height="30" align="right"  style=" border-bottom:1px #CCCCCC dashed">帐号状态：</td>
            <td  style=" border-bottom:1px #CCCCCC dashed;" >
              <label>
                <input name="status" type="radio" value="1"  <?php if($info['status'] == '1'): ?>checked="checked"<?php endif; ?>/>
              正常</label>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="status" value="2" <?php if($info['status'] == '2'): ?>checked="checked"<?php endif; ?>/>
              暂停</label>
            </td>
          </tr>
          <tr>
            <td height="30" align="right"   >&nbsp;</td>
            <td height="60"   ><span style="font-size:14px;">
              <input type="hidden" name="uid"  value="<?php echo ($info['uid']); ?>" />
              <input name="_k_v" type="hidden" value="<?php echo ($_GET['_k_v']); ?>">
              <input name="submit3" type="submit" class="admin_submit"    value="确定"/>
              <input name="submit22" type="button" class="admin_submit"    value="返 回" onclick="Javascript:window.history.go(-1)"/>
            </span></td>
          </tr>
        </table>
      </form>
      
      <div class="toptit">密码修改</div>
      <form id="form1" name="form1" method="post" action="<?php echo U('member_edit');?>">
        <table width="700" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
          
          <tr>
            <td height="30" align="right" bgcolor="#FFFFFF"  >新密码：</td>
            <td bgcolor="#FFFFFF" >
              <input name="password" type="text" class="input_text_200" id="password" maxlength="50" value=""  />        </td>
            </tr>
            <tr>
              <td height="30" align="right" bgcolor="#FFFFFF"  >&nbsp;</td>
              <td  bgcolor="#FFFFFF"  >
                <input type="hidden" name="uid"  value="<?php echo ($info['uid']); ?>" />
                <input name="_k_v" type="hidden" value="<?php echo ($_GET['_k_v']); ?>">
                <input name="submit3" type="submit" class="admin_submit"    value="确定"/>
                <input name="submit22" type="button" class="admin_submit"    value="返 回" onclick="Javascript:window.history.go(-1)"/>
              </td>
            </tr>
            
          </table>
        </form>
        <?php if(!empty($apply['Subsite'])): ?><div class="toptit">所属分站</div>
          <form id="form9" name="form9" method="post" action="<?php echo U('member_edit');?>">
            <table width="100%" border="0" cellpadding="4" cellspacing="0"   >
              <tr>
                <td width="120" height="30" align="right"  style=" border-bottom:1px #CCCCCC dashed">所属分站：</td>
                <td  style=" border-bottom:1px #CCCCCC dashed;" >
                  <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
                  <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><label style="color: rgb(102, 102, 102);">
                        <input name="subsite_id" type="radio" value="<?php echo ($subsite["s_id"]); ?>" <?php if($info['subsite_id'] == $subsite['s_id']): ?>checked="checked"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?>
                      </label>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                  <?php else: ?>
                    <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><label style="color: rgb(102, 102, 102);">
                          <input name="subsite_id" type="radio" value="<?php echo ($subsite["s_id"]); ?>" <?php if($info['subsite_id'] == $subsite['s_id']): ?>checked="checked"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?>
                        </label>&nbsp;&nbsp;&nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                </td>
              </tr>
              <tr>
                <td height="30" align="right"   >&nbsp;</td>
                <td height="60"   ><span style="font-size:14px;">
                  <input type="hidden" name="uid"  value="<?php echo ($info["uid"]); ?>" />
                  <input type="hidden" name="_k_v" value="<?php echo ($_GET['_k_v']); ?>">
                  <input name="submit3" type="submit" class="admin_submit"    value="确定"/>
                  <input name="submit22" type="button" class="admin_submit"    value="返 回" onclick="Javascript:window.history.go(-1)"/>
                </span></td>
              </tr>
            </table>
          </form><?php endif; ?>
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
        $('.email_audit').click(function(){
          var s = $(this).attr('checked')?1:0;
          $('input[name="email_audit"]').val(s);
        });
        $('.mobile_audit').click(function(){
          var s = $(this).attr('checked')?1:0;
          $('input[name="mobile_audit"]').val(s);
        });
    </script>
  </body>
</html>