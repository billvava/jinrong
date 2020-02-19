;(function () {
    // 金融学院
    $(function () {
        // 点击切换书签
        $('.switch').click(function () {
            // 切换样式
            if ($(this).hasClass('orange')) {
                return;
            }
            $(this).addClass('orange').siblings('.switch').removeClass('orange');
            // 获取点击目标的switch属性
            var switch_attr = $(this).attr('switch');
            // 切换对应的模块
            $('.effect[effect='+switch_attr+']').removeClass('display-no').siblings('.effect').addClass('display-no');
        });
    });
})();