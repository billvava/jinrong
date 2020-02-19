(function($) {
    'use strict';
    // 自定义验证方法，验证是否被注册
    $.validator.addMethod('IsRegistered', function(value, element) {
        var result = false, eletype = element.name;
        $.ajax({
            url: qscms.root + '?m=Home&c=Members&a=ajax_check',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: eletype, param: value },
            success: function(json) {
                if (json && json.status) {
                    result = true;
                } else {
                    result = false;
                }
            }
        });
        return result;
    }, '已被注册');


    // 点击获取验证码先判断是否输入了手机号
    var regularMobile = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/;
    $('#verify').click(function() {
        //alert('正在调试中');
        //return false;
        var mobileValue = $.trim($('#mobile').val());
        if (mobileValue == '') {
            disapperTooltip("remind", "请输入手机号码");
            $('#mobile').focus();
            return false;
        };
        if (mobileValue != "" && !regularMobile.test(mobileValue)) {
            $('#reg-tips').html('请输入正确的手机号码');
            $('#mobile').focus();
            return false;
        }
        $('#reg-tips').css('display','none');
        $.ajax({
            url: qscms.root + '?m=Home&c=Members&a=ajax_check',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: 'mobile', param: mobileValue },
            success: function(json) {
                if (json && json.status) {
                    toSetSms();
                } else {
                    disapperTooltip("remind", "该手机号已被注册，请尝试登录");
                    $('#mobile').focus();
                    return false;
                }
            }
        });
    });

    var register = {
        initialize: function() {
            this.initControl();
        },
        initControl: function() {
            // 手机注册提交
            $('#btnMoilbPhoneRegister').die().live('click', function() {
                $(this).submitForm({
                    beforeSubmit: $.proxy(frmMobilValid.form, frmMobilValid),
                    success: function(data) {
                        if (data.status) {
                            window.location.href = data.data.url;
                        } else {
                            $('#btnMoilbPhoneRegister').val('注册').removeClass('btn_disabled').prop('disabled', 0);
                            disapperTooltip("remind", data.msg);
                        }
                    },
                    clearForm: false
                });
                if (frmMobilValid.valid()) {
                    $('#btnMoilbPhoneRegister').val('注册中...').addClass('btn_disabled').prop('disabled', !0);
                }
                return false;
            });
        }
    }

    // 发送手机验证码
    function toSetSms() {
        $.ajax({
            url: qscms.root+'?m=Home&c=Members&a=reg_send_sms',
            type: 'POST',
            dataType: 'json',
            data: {mobile: $.trim($('#mobile').val()),img_yzm:$.trim($('#img_yzm').val())}
        })
        .done(function(data) {
            if (parseInt(data.status)) {
                setTimeout(function() { 
                    disapperTooltip("success", "验证码已发送，请注意查收");
                },800)
                
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
                        $('#verify').html(countdown + '秒后重新发送');
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

    // 个人手机注册处理程序
    function regPerByMobileHandler() {
        $('#btnMoilbPhoneRegister').val('注册中...').addClass('btn_disabled').prop('disabled', !0);
        $.ajax({
            url: qscms.root+'?m=Home&c=Members&a=register',
            type: 'POST',
            dataType: 'json',
            data: $('#regMobileForm').serialize(),
            success: function (data) {
                if(data.status == 1){
                    window.location.href = data.data.url;
                }else{
                    if ($('#regMobileForm input[name="agreement"]').is(':checked')) {
                        $('#btnMoilbPhoneRegister').val('注册').removeClass('btn_disabled').prop('disabled', 0);
                    }
                    disapperTooltip("remind", data.msg);
                }
            },
            error:function(data){
                if ($('#regMobileForm input[name="agreement"]').is(':checked')) {
                    $('#btnMoilbPhoneRegister').val('注册').removeClass('btn_disabled').prop('disabled', 0);
                }
                disapperTooltip("remind", data.msg);
            }
        });
    }
})(jQuery);