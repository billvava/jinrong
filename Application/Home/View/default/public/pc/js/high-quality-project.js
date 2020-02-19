// 优质项目现场推荐
;(function () {
    // 点击出现下划线
    $('.method-payment').click(function () {
        // 将原本的下划线去除
        $('.underline').removeClass('underline');
        // 添加下划线
        $(this).children('span').addClass('underline');
        // 隐藏原本的模块
        $('#variety-pay').children('div').css('display','none')
            // 显示对应的模块
            .eq($(this).index()).css('display','block');
    });

    // 待优化
    // 点击 阅读并同意 《金融网在线服务协议》 网银
    var wangyin_agree = true;
    $('.wangyin .agree').click(function () {
        if (wangyin_agree) {
            $(this).css('background-image','url("../img/icon/icon23.png"');
            wangyin_agree = false;
            // 不同意的时候 将button禁用
            $('#variety-pay .wangyin button').attr('disabled','disabled')
        } else {
            $(this).css('background-image','url("../img/icon/icon22.png"');
            wangyin_agree = true;
            // 同意的时候 button禁用移除
            $('#variety-pay .wangyin button').removeAttr('disabled');
        }
    });

    // 点击 阅读并同意 《金融网在线服务协议》 快捷
    var kuaijie_agree = true;
    $('.kuaijie .agree').click(function () {
        if (kuaijie_agree) {
            $(this).css('background-image','url("../img/icon/icon23.png"');
            kuaijie_agree = false;
            // 不同意的时候 将button禁用
            $('#variety-pay .kuaijie button').attr('disabled','disabled')
        } else {
            $(this).css('background-image','url("../img/icon/icon22.png"');
            kuaijie_agree = true;
            // 同意的时候 button禁用移除
            $('#variety-pay .kuaijie button').removeAttr('disabled');
        }
    });

    // 姓名 失去焦点正则验证
    $('.kuaijie .username').blur(function () {
        if ($(this).val().trim() == '') {
            // 未填写 或者只有空格的情况下 显示错误
            $(this).parent('td').next('td').addClass('error');
        }
    }).focus(function () {
        // 获取焦点 将错误标记去除
        $(this).parent('td').next('td').removeClass('error');
    });

    // 身份证号码验证
    var idcard_reg = /(^\d{15}$)|(^\d{17}([0-9]|X)$)|(^\d{17}([0-9]|x)$)/;
    $('.kuaijie .idcard').blur(function () {
        if (!idcard_reg.test($(this).val())) {
            // 未填写 或者只有空格的情况下 显示错误
            $(this).parent('td').next('td').addClass('error');
        }
    }).focus(function () {
        // 获取焦点 将错误标记去除
        $(this).parent('td').next('td').removeClass('error');
    });

    // 选择银行
    $('.kuaijie .bank').blur(function () {
        if ($(this).val().trim() == '') {
            // 未填写 或者只有空格的情况下 显示错误
            $(this).parent('td').next('td').addClass('error');
        }
    }).focus(function () {
        // 获取焦点 将错误标记去除
        $(this).parent('td').next('td').removeClass('error');
    });

    // 银行卡号码验证
    var bank_reg = /^(\d{16}|\d{19})$/;
    $('.kuaijie .banknumber').blur(function () {
        var banknumber = $(this).val().replace(/\s+/g,"");
        console.log(banknumber);
        if (!bank_reg.test(banknumber)) {
            // 未填写 或者只有空格的情况下 显示错误
            $(this).parent('td').next('td').addClass('error');
        }
    }).focus(function () {
        // 获取焦点 将错误标记去除
        $(this).parent('td').next('td').removeClass('error');
    });

    // 第三方支付
    // 点击 阅读并同意 《金融网在线服务协议》 网银
    var disanfang_agree = true;
    $('.disanfang .agree').click(function () {
        if (disanfang_agree) {
            $(this).css('background-image','url("../img/icon/icon23.png"');
            disanfang_agree = false;
            // 不同意的时候 将button禁用
            $('#variety-pay .disanfang button').attr('disabled','disabled')
        } else {
            $(this).css('background-image','url("../img/icon/icon22.png"');
            disanfang_agree = true;
            // 同意的时候 button禁用移除
            $('#variety-pay .disanfang button').removeAttr('disabled');
        }
    });

    // 点击发送短信出现输入框和发送
    $('.guitai .send').click(function () {
        console.log(666);
        // 将发送短信隐藏
        $(this).css('display','none')
            // 将输入手机按钮显示
            .siblings().css('display','inline-block');
    });

})();








































