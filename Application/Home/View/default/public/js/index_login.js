// 账号登录验证
    $('#login').click(function(){
        var usernameValue = $.trim($('input[name=username]').val());
        var passwordValue = $.trim($('input[name=password]').val());
        var expireValue = $.trim($('input[name=expire]').val());
        if (usernameValue == '') {
            $('#login-msg').text('请输入用户名！').css('display','block');
            $('#login_username').focus();
            return false;
        }
        if (passwordValue == '') {
            $('#login-msg').text('请输入密码！').css('display','block');
            $('#login_password').focus();
            return false;
        }
        $('#login-msg').css('display','none');
        if($("#verify_userlogin").val()==1){
            $('#J_sendVerifyType').val('0');
            $("#btnVerifiCode").click();
        }else{
            $('#J_do_login_btn').val('登录中...').addClass('btn_disabled').prop('disabled', !0);
            doLogin();
        }
    });


// 账号登录方法
    function doLogin() {
        var loginTypeValue = eval($('#logintype').val());
        $('#btn-login').val('正在登录中...');
        if (loginTypeValue) {
            var username = $.trim($('input[name=username]').val());
            var password = $.trim($('input[name=password]').val());
            //var expireValue = $.trim($('input[name=expire_obile]').val());
            // 提交表单
            $.ajax({
                url: qscms.root+'?m=Home&c=Members&a=login',
                type: "post",
                dataType: "json",
                data: {
                    mobile: username,
                    password: password,
                    //expire: expireValue,
                },
                success: function (result) {
                    if (parseInt(result.status)) {
                        // ajax加载登录口内信息
                        $.getJSON(qscms.root + '?m=Home&c=Index&a=ajax_user_info',function(result){
                            if(result.status == 1){
                                $('#J_userWrap').html(result.data.html);
                                $.getJSON(qscms.root + "?m=Home&c=AjaxCommon&a=get_header_min",function(result){
                                    if(result.status == 1){
                                        $('#J_header').html(result.data.html);
                                    }
                                });
                                $('.loginno').css('display','none');
                                $('.loginyes').css('display','block');
                            }
                        });
                    } else {
                        //disapperTooltip("remind",result.msg);
                        $thisTypeBox.addClass('err');
                        $thisTypeBox.find('.J_errbox').text(result.msg);
                        $('#J_do_login_bymobile_btn').val('登录').removeClass('btn_disabled').prop('disabled', 0);
                        $("#verify_userlogin").val(result.msg);
                    }
                }
            });
        } else {
            var usernameValue = $.trim($('input[name=username]').val());
            var passwordValue = $.trim($('input[name=password]').val());
            var expireValue = $.trim($('input[name=expire]').val());
            var $thisTypeBox = $('#J_do_login_btn').closest('.type_box');
            // 提交表单
            $.ajax({
                url: qscms.root+'?m=Home&c=Members&a=login',
                type: "post",
                dataType: "json",
                data: {
                    username: usernameValue,
                    password: passwordValue,
                    expire: expireValue,
                },
                success: function (result) {
                    if (parseInt(result.status)) {
                        // ajax加载登录口内信息
                        $.getJSON(qscms.root + '?m=Home&c=Index&a=ajax_user_info',function(result){
                            if(result.status == 1){
                                $('.loginBox').html(result.data.html);
                                $.getJSON(qscms.root + "?m=Home&c=AjaxCommon&a=get_header_min",function(result){
                                    if(result.status == 1){
                                        $('#J_header').html(result.data.html);
                                    }
                                });
                             $('.loginno').css('display','none');
                             $('.loginyes').css('display','block');
                            }
                        });
                    } else {
                        disapperTooltip("remind",result.msg);
                        /*$thisTypeBox.addClass('err');
                        $thisTypeBox.find('.J_errbox').text(result.msg);
                        $('#J_do_login_btn').val('登录').removeClass('btn_disabled').prop('disabled', 0);
                        $("#verify_userlogin").val(result.data);
                        */
                    }
                }
            });
        }
    }

    // ajax加载登录口内信息
    $.getJSON(qscms.root + '?m=Home&c=index&a=ajax_user_info',function(result){
        if(result.status == 1){
            $('.loginBox').html(result.data.html);
        }
    });

    // 是否自动登录
    $('.J_expire').click(function() {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });


    // 回车登录
    $('#login_password').bind('keypress', function(event) {
        if (event.keyCode == "13") {
            $(this).closest('#login-form').find('.btn-login').click();
        }
    });