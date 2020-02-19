<?php if (!defined('THINK_PATH')) exit();?><div class="admin_management">
<?php if($userinfo[utype] == 1): ?><div style="height:60px;">对 <strong  style="color:#56C6FF"><?php echo ($company_profile['companyname']); ?></strong>进行以下操作&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php echo ($manage_url); ?>">进入会员中心>></a><br />
<span class="admin_note"><br />
用户名：<?php echo ($userinfo['username']); ?>，uid:<?php echo ($userinfo['uid']); ?>，</span></div>

	<div class="clear"></div>
	<div class="mantit">资料管理</div>
	<div class="manitem"><a href="<?php echo U('Home/persoanal/published',array('key'=>$userinfo['uid']));?>">资金信息</a></div>
	<div class="manitem"><a href="<?php echo U('CompanyMembers/edit',array('uid'=>$userinfo['uid']));?>">会员资料</a></div>
	<div class="manitem"><a href="<?php echo U('Personal/member_edit',array('uid'=>$userinfo['uid']));?>">修改密码</a></div>
<div class="manitem"><a href="javascript:;" class="ajax_distribution_customer" parameter="mobile=<?php echo ($userinfo['mobile']); ?>&uid=<?php echo ($userinfo['uid']); ?>">分配客服</a></div>
<div class="manitem"><a href="javascript:;" class="ajax_discard" parameter="mobile=<?php echo ($userinfo['mobile']); ?>&uid=<?php echo ($userinfo['uid']); ?>">丢进公海</a></div>
	<div class="clear"></div>

	<div class="mantit">联系会员<span>（手机:<?php if(!empty($userinfo['mobile'])): echo ($userinfo['mobile']); else: ?>未填写<?php endif; ?>）</span></div>
	<div class="manitem"><a class="ajax_send_sms" href="javascript:;" parameter="mobile=<?php echo ($userinfo['mobile']); ?>&uid=<?php echo ($userinfo['uid']); ?>">发送短信</a></div>
	<div class="manitem"><a class="ajax_send_email" href="javascript:;" parameter="email=<?php echo ($userinfo['email']); ?>&uid=<?php echo ($userinfo['uid']); ?>">发送邮件</a></div>
	<div class="manitem"><a class="ajax_send_pms" href="javascript:;" parameter="tousername=<?php echo ($userinfo['username']); ?>">发站内信</a></div>
	<div class="clear"></div>
<?php else: ?>

	<div style="height:30px;">对 <strong  style="color:#56C6FF"><?php echo ((isset($userinfo["realname"]) && ($userinfo["realname"] !== ""))?($userinfo["realname"]):$userinfo['username']); ?></strong>进行以下操作<span class="admin_note">用户名：<?php echo ($userinfo['username']); ?>，uid:<?php echo ($userinfo["uid"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php echo ($manage_url); ?>">进入会员中心>></a></div>
	<div class="mantit">会员管理</div>
	<div class="manitem"><a target="_blank" href="<?php echo U('Home/personal/published');?>">项目信息</a></div>
	<div class="manitem"><a target="_blank" href="
	<?php echo U('Home/Personal/account');?>">个人资料</a></div>
	<div class="manitem"><a href="<?php echo U('Personal/member_edit',array('uid'=>$userinfo['uid'],'_k_v'=>$userinfo['uid']));?>">修改密码</a></div>
	<div class="manitem"><a href="javascript:;" class="ajax_distribution_customer" parameter="mobile=<?php echo ($userinfo['mobile']); ?>&uid=<?php echo ($userinfo['uid']); ?>">分配客服</a></div>
	<div class="manitem"><a href="javascript:;" class="ajax_discard" parameter="mobile=<?php echo ($userinfo['mobile']); ?>&uid=<?php echo ($userinfo['uid']); ?>">丢进公海</a></div>
	<div class="clear"></div>

	<div class="mantit">联系会员<span>（手机:<?php if(!empty($userinfo['mobile'])): echo ($userinfo['mobile']); else: ?>未填写<?php endif; ?>，邮箱:<?php if(!empty($userinfo['email'])): echo ($userinfo['email']); else: ?>未填写<?php endif; ?>）</span></div>
	<div class="manitem"><a class="ajax_send_sms" href="javascript:;" parameter="mobile=<?php echo ($userinfo['mobile']); ?>&uid=<?php echo ($userinfo['uid']); ?>">发送短信</a></div>
	<div class="manitem"><a class="ajax_send_email" href="javascript:;" parameter="email=<?php echo ($userinfo['email']); ?>&uid=<?php echo ($userinfo['uid']); ?>">发送邮件</a></div>
	<div class="manitem"><a class="ajax_send_pms" href="javascript:;" parameter="tousername=<?php echo ($userinfo['username']); ?>">发站内信</a></div>
	<div class="manitem"><a class="ajax_send_talks" href="javascript:;" parameter="tousername=<?php echo ($userinfo['username']); ?>">发送约谈</a></div>
    <div class="manitem"><a class="ajax_send_talks_inner" href="javascript:;" parameter="tousername=<?php echo ($userinfo['username']); ?>">内部约谈</a></div>
	<div class="clear"></div><?php endif; ?>
</div>
<script type="text/javascript">
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
	$(".ajax_discard").QSdialog({
	  DialogTitle:"丢进公海",
	  DialogContentType:"url",
	  DialogContent:"<?php echo U('Ajax/ajax_discard');?>&"
	  });
	$(".ajax_send_pms").QSdialog({
	  DialogTitle:"发送站内信",
	  DialogContentType:"url",
	  DialogContent:"<?php echo U('Ajax/ajax_send_pms');?>&"
	  });
	$(".ajax_send_talks").QSdialog({
	  DialogTitle:"发送约谈",
	  DialogContentType:"url",
	  DialogContent:"<?php echo U('Ajax/ajax_send_talks');?>&"
	  });
    $(".ajax_send_talks_inner").QSdialog({
      DialogTitle:"内部约谈",
      DialogContentType:"url",
      DialogContent:"<?php echo U('Ajax/ajax_send_talks_inner');?>&"
      });
	$(".ajax_distribution_customer").QSdialog({
	  DialogTitle:"分配专职客服",
	  DialogContentType:"url",
	  DialogContent:"<?php echo U('Ajax/ajax_distribution_customer');?>&"
	  });
</script>