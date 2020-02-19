;(function () {
    // 项目转让详情
    $(function () {
        // 样式
        $('.project-transfer-details .div3 ul li:not(:last-child)')
            .css('margin-right', '10px');

        // 获得第一张图片地址
        $('.project-transfer-details .div3 div img')
            .attr('src', $(".project-transfer-details .div3 li.select img").attr("src"));

        // 滑动
        $('.project-transfer-details .div3 ul li').hover(function () {
            // 切换样式
            $(this).addClass('select').siblings('li').removeClass('select');
            // 滑动切换图片
            $('.project-transfer-details .div3 div img')
                .attr('src', $(this).children('img').attr("src"));
        });

        // 获得当前价格  去除逗号
        var price = $('.project-transfer-details .span1').text().replace(/,/g,'');
        price = parseInt(price);
        // 获得每次加价幅度
        var amplitude = $('.project-transfer-details .amplitude').text();
         if (amplitude) {
            amplitude = parseInt(amplitude);
        } else {
            amplitude = 0;
        }
        var sum = price + amplitude;
        // 将价格赋值
        $('.project-transfer-details .div5 form input').val(sum);

        // 点击加价 减价
        $('.project-transfer-details .adjust span').click(function () {
            // 获得每次加价幅度
            var amplitude = $('.project-transfer-details .amplitude').text();
            amplitude = parseInt(amplitude);
            // 获得当前价格  去除逗号
            var price = $('.project-transfer-details .span1').text().replace(/,/g,'');
            price = parseInt(price);
            // 获得当前出价
            var offer = $('.project-transfer-details .div5 form input').val();
            offer = parseInt(offer);
            // 0 加价  1 减价
            var index = $(this).index();
            if (index == 1) {
                // 价格不能低于最低价
                if (offer - amplitude > sum) {
                    $('.project-transfer-details .div5 form input').val(offer - amplitude);
                }
            } else {
                // 将价格赋值
                $('.project-transfer-details .div5 form input').val(offer + amplitude);
            }
        });

        // 倒计时
        // 获得当前时间 时间戳
        var now_time = Date.parse(new Date());
        // 获得结束时间 时间戳 （假设明天）
        var end_time = new Date(((new Date())/1000+86400*1)*1000);
        end_time = Date.parse(end_time);

        // 获得两者的时间差
        var countdown = end_time - now_time;
        // 将变量绑定为全局
        window.countdown = countdown;
        // 倒计时
        window.projectTransferDetailsTime = function (time_difference) {
            var days = parseInt(time_difference / (1000 * 60 * 60 * 24));
            var hours = parseInt((time_difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = parseInt((time_difference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = parseInt((time_difference % (1000 * 60)) / 1000);
            // 赋值
            $('.project-transfer-details .days').text(days);
            $('.project-transfer-details .hours').text(hours);
            $('.project-transfer-details .minutes').text(minutes);
            $('.project-transfer-details .seconds').text(seconds);
            window.countdown = time_difference - 1000;
        };
        // 定时执行
        projectTransferDetailsTime(window.countdown);
        setInterval('window.projectTransferDetailsTime(window.countdown);', 1000);

        // 选项卡
        $('.project-transfer-details ul.nav li').click(function () {
            $(this).addClass('select').siblings('li').removeClass('select');
        });

        // 滚动触发
        // 获得列表的高度
        var $J_announcement_list = $('#J_announcement_list');
        var J_announcement_list_top = $('#J_announcement_list').offset().top;
        $(document).scroll(function () {
            // 判断滚轮高度 浮动列表
            if ($(document).scrollTop() > J_announcement_list_top) {
                $J_announcement_list.addClass('select');
            } else {
                $J_announcement_list.removeClass('select');
            }
        });

        // 百度地图
    });
})();




