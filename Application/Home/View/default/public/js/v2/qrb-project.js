// 用于项目方服务介绍页面
;(function () {
    $(function () {
        // 购买数量减
        $('.qrb-project-reduce').click(function () {
            var num = $(this).siblings('.qrb-project-num').text();
            if (num>=2) {
                num--;
            }
            $(this).siblings('.qrb-project-num').text(num);
        });
        
        // 购买数量加
        $('.qrb-project-add').click(function () {
            var num = $(this).siblings('.qrb-project-num').text();
            if (num<999) {
                num++;
            }
            $(this).siblings('.qrb-project-num').text(num);
        });
    });
})();