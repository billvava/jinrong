var qrh={};
qrh.Util = {
    isMobile: function(a) {
        return /^1(3[0-9]|4[0-9]|5[0-9]|7[0|1|3|5|6|7|8]|8[0-9])\d{8}$/.test(a)
    },
    isChinese: function(a) {
        return /^[\u4E00-\u9FA5\uF900-\uFA2D]+$/.test(a)
    },
    isEmail: function(a) {
        return /^\w+((-\w+)|(\.\w+))*\@\w+((\.|-)\w+)*\.\w+$/.test(a)
    },
    isEmpty: function(a) {
        switch (typeof a) {
        case "string":
            return 0 == $.trim(a).length ? !0 : !1;
        case "number":
            return 0 == a;
        case "object":
            return null == a;
        case "array":
            return 0 == a.length;
        default:
            return ! 0
        }
    }
},

// 账号登录验证
    $('#register').click(function(){
        var mobile = $.trim($('input[name=mobile]').val());
        var img_yzm = $.trim($('input[name=img_yzm]').val());
        var yzm = $.trim($('input[name=yzm]').val());
        if (mobile == '') {
            $('#reg-tips').html('请输入您的手机号码').css('display','block');
            $('.InforBox').css('height','300px');
            $('#login_username').focus();
            return false;
        }
        if (!qrh.Util.isMobile(mobile)) {
            $('#reg-tips').html('请输入正确的手机号码').css('display','block');
            $('.InforBox').css('height','300px');
            $('#login_username').focus();
            return false;
        }
        if (img_yzm == '') {
            $('#reg-tips').html('请输入图形验证码').css('display','block');
            $('#img_yzm').focus();
            return false;
        }
        if (yzm == '') {
            $('#reg-tips').html('请输入验证码').css('display','block');
            $('#verify_code').focus();
            return false;
        }
        $('#reg-tips').css('display','none').css('height','280px');
            doRegister();
    });

    // 回车登录
    $('#login_password').bind('keypress', function(event) {
        if (event.keyCode == "13") {
            $(this).closest('#login-form').find('.btn-login').click();
        }
    });

    // 发送手机验证码
    function toSetSms() {
        $.ajax({
            url: qscms.root+'?m=Home&c=Members&a=reg_send_sms',
            type: 'POST',
            dataType: 'json',
            data: {mobile: $.trim($('#mobile').val())}
        })
        .done(function(data) {
            if (parseInt(data.status)) {
                setTimeout(function() { 
                    disapperTooltip("success", "验证码已发送，请注意查收");
                },800);
                // 开始倒计时
                var countdown = 180;
                function settime() {
                    if (countdown == 0) {
                        $('#verify').prop("disabled", 0);
                        $('#verify').removeClass('btn_disabled');
                        $('#verify').html('获取验证码');
                        countdown = 180;
                        return;
                    } else {
                        $('#verify').prop("disabled", !0);
                        $('#verify').addClass('btn_disabled');
                        $('#verify').html('重新发送' + countdown + '秒');
                        countdown--;
                    }
                    setTimeout(function() { 
                        settime()
                    },1000)
                }
                settime();
            } else {
                setTimeout(function() { 
                    disapperTooltip("remind", data.msg);
                },1500)
            }
        });
    }

    //注册处理程序
    function doRegister() {
        $('#Register').val('注册中...').addClass('btn_disabled').prop('disabled', !0);
        $.ajax({
            url: qscms.root+'?m=Home&c=Members&a=index_register',
            type: 'POST',
            dataType: 'json',
            data: $('#register-form').serialize(),
            success: function (data) {
                if(data.status == 1){
                    disapperTooltip("success", data.msg);
                    setTimeout(function () {
                        window.location = "/Personal/index";
                    }, 2000);
                }
            }
        });
    }
