;(function () {
    $(function () {
        // 点击获取验证码 开始倒计时
        $('.get-code').click(function () {
            var time = 5;
            var self = $(this);
            // 倒计时
            function countdown(){
                self.text(time+'s');
                time--;
                if (time < 0) {
                    time = 5;
                    self.text('获取验证码');
                } else {
                    setTimeout(countdown, 1000);
                }
            }

            if (self.text() == '获取验证码') {
                countdown();
            }
        });
    });
})();