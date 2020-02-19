;(function () {
    $(function () {
        // 点击7天自动登录
        var automatic_login = true;
        $('.home2 .automatic-login').click(function () {
            if (automatic_login) {
                // 替换背景
                $(this).css('background-image','url("../img/icon/icon54.png")');
                automatic_login = false;
            } else {
                $(this).css('background-image','url("../img/icon/icon53.png")');
                automatic_login = true;
            }
        });

        // 获取焦距时更换边框颜色
        $('.home2 form input').focus(function () {
            $(this).css('border-color', '#56C6FF');
            // 输入用户名时出现x
            $(this).filter('input[name="username"]').keyup(function () {
                // 用户名存在 x出现
                if ($(this).val()) {
                    $('.home2 .cancel').css('display','block');
                }
            });
        }).blur(function () {
            $(this).css('border-color', '#ccc');
        });

        // 点击x清除输入的账号和密码
        $('.home2 .cancel').click(function () {
            // 删除账号密码
            $('.home2 form input').val('')
                // 输入账号获得焦点
                .filter('input[name="username"]').focus();
            // 隐藏x
            $(this).css('display','none');
        });

        // 进去页面获得焦距
        $('.home2 form input[name="username"]').focus();
    });
})();