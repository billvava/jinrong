// 账号登录验证
    $('#btn_send_guest_org').live('click',function(){
        var usernameValue = $.trim($('input[name=username]').val());
        var mobileValue = $.trim($('input[name=mobie]').val());
        if (usernameValue == ''){
            $('.part-fieldset-msg-1').text('请输入您的姓名.').css('display','inline-block').addClass('ui-text-red');
            $('#user_name_org').focus();
            return false;
        }
        if (mobileValue == '') {
            $('.part-fieldset-msg-2').text('请输入手机号码.').css('display','inline-block').addClass('ui-text-red');
            $('#login_password').focus();
            return false;
        }
        $('.part-fieldset-msg-1,.part-fieldset-msg-2').css('display','none');
    });