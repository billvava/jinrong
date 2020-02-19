;(function () {
    // 登录成功
    // 添加样式
    $('.registered-success .registered-success-main-line-list li:even')
        .css('margin-right', '20px');
    $('.registered-success .registered-success-main-line-list>p span:eq(4),.registered-success .registered-success-main-line-list>p span:eq(9)')
        .css('background', 'none');
    // 切换样式
    $('.switch').click(function () {
        var $self = $(this);
        var switch_sum = $self.attr('switch');
        // 切换样式
        $self.addClass('registered-success-main-select').siblings('.switch').removeClass('registered-success-main-select');
        $('.effect[effect=' + switch_sum + ']').removeClass('display-no').siblings('.effect').addClass('display-no');
    });
    // 点击设置密码
    $('.get-password').click(function () {
        $('.set-password').removeClass('display-no');
    });
    // 取消设置密码
    $('.set-password-back').click(function () {
        $('.set-password').addClass('display-no');
    });
    // 判断两次输入的密码是否一致
    // 失去焦点触发
    $('input[name="again_password"]').blur(function () {
        var $self = $('input[name="again_password"]');
        var reset_password = $('input[name="reset_password"]').val();
        var again_password = $self.val();
        if (reset_password == again_password) {
            // 正确
            $self.parent('td').next('td').addClass('set-password-correct')
        } else {
            // 错误
            $self.parent('td').next('td').addClass('set-password-error')
                .text('再次输入的密码不一致')
        }
    });
    // 获取焦点初始化
    $('.set-password-main input').focus(function () {
        $(this).parent('td').next('td').removeClass().text('');
    });
    // 点击立即加入
    $('.get-immediately-join').click(function () {
        var $self = $(this);
        var sign = $(this).attr('get-immediately-join');
        // 获得需要操作的节点
        var $join_time = $('.immediately-join[immediately-join=' + sign + ']')
            // 出现
            .removeClass('display-no').find('.immediately-join-time');
        // 倒计时
        var time = 3;
        $join_time.text('（' + time + 's）');
        var count_down_switch = setInterval(countDown, 1000);
        function countDown() {
            time--;
            $join_time.text('（' + time + 's）');
            if (time == 0) {
                // 清空
                $join_time.text('');
                // 添加class
                $join_time.parent('a').addClass('immediately-join-select');
                clearInterval(count_down_switch);
            }
        }
    });

    // 点击重新选择
    $('.immediately-join-back').click(function () {
        $(this).parents('.immediately-join').addClass('display-no');
    });
    // 点击确认
    $('.immediately-join-main').on('click', '.immediately-join-select', function () {
        // 处理确认
        console.log('确认');
    });
})();




























