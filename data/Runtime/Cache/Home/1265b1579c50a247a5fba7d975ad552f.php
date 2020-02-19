<?php if (!defined('THINK_PATH')) exit(); if($visitor['utype'] == 1): ?><div class="login-right">
        <dl class="userinfo fn-clear">
            <dt class="portrait"><img src="<?php echo ($visitor['avatars']); ?>" alt="<?php echo ($visitor['username']); ?>" width="80" height="80"></dt>
            <dd class="baseinfo">
                <p class="username">
                    <?php if(!empty($visitor['realname'])): echo ($visitor['realname']); ?>
                        <?php else: ?>先生<?php endif; ?><a href="<?php echo U('Members/logout');?>">[退出]</a></p>
                <p class="integrity">资料完整度<span>73</span>分</p>
                <a href="<?php echo U('Personal/account');?>" class="go-perfect"><i class="icon-edit-perfect"></i>去完善</a> </dd>
        </dl>
        <ul class="message-group fn-clear">
            <li class="message-item"><span class="message-value"><a href="<?php echo U('Personal/system');?>"><?php echo ($msgtip['unread']); ?></a></span><label class="message-label">消息提醒</label></li>
            <li class="message-item"><span class="message-value"><a href="#">0</a></span><label class="message-label">已发信息</label></li>
            <li class="message-item"><span class="message-value"><a href="#">0</a></span><label class="message-label">收到约谈</label></li>
            <li class="message-item"><span class="message-value"><a href="#">0</a></span><label class="message-label">收到留言</label></li>
        </ul>
        <a href="<?php echo U('personal/index');?>" class="btn-login">进入我的金融网</a>
    </div>
    <div class="login-bg"></div>
    <?php else: ?>
    <div class="login-right">
        <dl class="userinfo fn-clear">
            <dt class="portrait"><img src="<?php echo ($visitor['avatars']); ?>" alt="<?php echo ($visitor['username']); ?>" width="80" height="80"></dt>
            <dd class="baseinfo">
                <p class="username">
                    <?php if(!empty($visitor['realname'])): echo ($visitor['realname']); ?>
                        <?php else: ?>先生<?php endif; ?><a href="<?php echo U('Members/logout');?>">[退出]</a></p>
                <p class="integrity">资料完整度<span>73</span>分</p>
                <a href="<?php echo U('Personal/account');?>" class="go-perfect"><i class="icon-edit-perfect"></i>去完善</a> </dd>
        </dl>
        <ul class="message-group fn-clear">

            <li class="message-item"><span class="message-value"><a href="<?php echo U('Personal/system');?>"><?php echo ($msgtip['unread']); ?></a></span><label class="message-label">消息提醒</label></li>
            <li class="message-item"><span class="message-value"><a href="#">0</a></span><label class="message-label">已发信息</label></li>
            <li class="message-item"><span class="message-value"><a href="#">0</a></span><label class="message-label">收到约谈</label></li>
            <li class="message-item"><span class="message-value"><a href="#">0</a></span><label class="message-label">收到留言</label></li>
        </ul>
        <a href="<?php echo U('personal/index');?>" class="btn-login">进入我的金融网</a>
    </div>
    <div class="login-bg"></div><?php endif; ?>