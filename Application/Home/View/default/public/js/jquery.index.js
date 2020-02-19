/* ============================================================
 * jquery.index.js  首页js集合
 * ============================================================
 * Copyright 74cms.
 * ============================================================ */
!function($) {

	// 处理圆角
	if (window.PIE) { 
	    $('.pie_about').each(function() {
	        PIE.attach(this);
	    });
	}

	

    // ajax加载登录口内信息
	$.getJSON(qscms.root + '?m=Home&c=index&a=ajax_user_info',function(result){
		if(result.status == 1){
			$('#J_userWrap').html(result.data.html);
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
    $('.J_loginword').bind('keypress', function(event) {
		if (event.keyCode == "13") {
            $(this).closest('.type_box').find('.index_login_btn').click();
		}
	});

    // 手机动态码登录
    var regularMobile = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/; // 验证手机号正则
    $('input[name="mobile"]').keyup(function(event) {
        var $thisTypeBox = $(this).closest('.type_box');
        var mobileValue = $(this).val();
        if (mobileValue.length >= 11) {
            if (mobileValue != "" && !regularMobile.test(mobileValue)) {
                $thisTypeBox.addClass('err');
                $thisTypeBox.find('.J_errbox').text('手机号码格式不正确');
                return false;
            }
            $thisTypeBox.removeClass('err');
            $thisTypeBox.find('.J_errbox').text('');
        }
    });
    
    // 获取验证码
    $('#getVerfyCode').die().live('click', function(event) {
        var mobileValue = $.trim($('input[name="mobile"]').val());
        var $thisTypeBox = $(this).closest('.type_box');
        if (!mobileValue.length) {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('请填写手机号码');
            $('input[name="mobile"]').focus();
            return false;
        }
        if (mobileValue != "" && !regularMobile.test(mobileValue)) {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('手机号码格式不正确');
            $('input[name="mobile"]').focus();
            return false;
        }
        $.ajax({
            url: qscms.root + '?m=Home&c=Members&a=ajax_check',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: 'mobile', param: mobileValue },
            success: function(result) {
                if (!result.status) {
                    $('#J_sendVerifyType').val('1');
                    $("#btnVerifiCode").click();
                } else {
                    $thisTypeBox.addClass('err');
                    $thisTypeBox.find('.J_errbox').text('您输入的手机号未注册会员');
                    return false;
                }
            }
        });
        
    });

	// 账号登录验证
    $('#J_do_login_btn').click(function() {
    	var usernameValue = $.trim($('input[name=username]').val());
    	var passwordValue = $.trim($('input[name=password]').val());
    	var expireValue = $.trim($('input[name=expire]').val());
        var $thisTypeBox = $(this).closest('.type_box');
    	if (usernameValue == '') {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('请输入邮箱/用户名/手机号！');
    		return false;
    	}
    	if (passwordValue == '') {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('请输入密码！');
    		return false;
    	}
    	$thisTypeBox.removeClass('err');
    	if($("#verify_userlogin").val()==1){
            $('#J_sendVerifyType').val('0');
			$("#btnVerifiCode").click();
		}else{
            $('#J_do_login_btn').val('登录中...').addClass('btn_disabled').prop('disabled', !0);
			doLogin();
		}
    });

    // 手机动态码登录验证
    $('#J_do_login_bymobile_btn').click(function() {
        var mobileValue = $.trim($('input[name=mobile]').val());
        var verfyCodeValue = $.trim($('input[name=verfy_code]').val());
        var expireValue = $.trim($('input[name=expire_obile]').val());
        var $thisTypeBox = $(this).closest('.type_box');
        if (mobileValue == '') {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('请输入手机号');
            return false;
        }
        if (mobileValue != "" && !regularMobile.test(mobileValue)) {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('手机号码格式不正确');
            $('input[name="mobile"]').focus();
            return false;
        }
        if (verfyCodeValue == '') {
            $thisTypeBox.addClass('err');
            $thisTypeBox.find('.J_errbox').text('请输入手机验证码');
            return false;
        }
        $thisTypeBox.removeClass('err');
        if($("#verify_userlogin").val()==1){
            $('#J_sendVerifyType').val('0');
            $("#btnVerifiCode").click();
        }else{
            $('#J_do_login_bymobile_btn').val('登录中...').addClass('btn_disabled').prop('disabled', !0);
            doLogin();
        }
    });

    // 账号登录方法
    function doLogin() {
        var loginTypeValue = eval($('#J_loginType').val());
        $('.type_box').eq(loginTypeValue).find('.index_login_btn').val('正在登录中...');
        if (loginTypeValue) {
            var mobileValue = $.trim($('input[name=mobile]').val());
            var verfyCodeValue = $.trim($('input[name=verfy_code]').val());
            var expireValue = $.trim($('input[name=expire_obile]').val());
            var $thisTypeBox = $('#J_do_login_bymobile_btn').closest('.type_box');
            // 提交表单
            $.ajax({
                url: qscms.root+'?m=Home&c=Members&a=login',
                type: "post",
                dataType: "json",
                data: {
                    mobile: mobileValue,
                    mobile_vcode: verfyCodeValue,
                    expire: expireValue,
                    // 二次验证所需的三个值
                    geetest_challenge: $("input[name='geetest_challenge']").val(),
                    geetest_validate: $("input[name='geetest_validate']").val(),
                    geetest_seccode: $("input[name='geetest_seccode']").val()
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
                            }
                        });
                    } else {
                        $thisTypeBox.addClass('err');
                        $thisTypeBox.find('.J_errbox').text(result.msg);
                        $('#J_do_login_bymobile_btn').val('登录').removeClass('btn_disabled').prop('disabled', 0);
                        $("#verify_userlogin").val(result.data);
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
                    // 二次验证所需的三个值
                    geetest_challenge: $("input[name='geetest_challenge']").val(),
                    geetest_validate: $("input[name='geetest_validate']").val(),
                    geetest_seccode: $("input[name='geetest_seccode']").val()
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
                            }
                        });
                    } else {
                        $thisTypeBox.addClass('err');
                        $thisTypeBox.find('.J_errbox').text(result.msg);
                        $('#J_do_login_btn').val('登录').removeClass('btn_disabled').prop('disabled', 0);
                        $("#verify_userlogin").val(result.data);
                    }
                }
            });
        }
    }

    // 极验通过之后需要做的操作
    function validDoSomethig() {
        var toType = eval($('#J_sendVerifyType').val());
        var loginTypeValue = eval($('#J_loginType').val());
        if (toType) { // 1为发送验证码
            var mobileValue = $.trim($('input[name=mobile]').val());
            $.ajax({
                url: qscms.root + '?m=Home&c=Members&a=reg_send_sms',
                cache: false,
                async: false,
                type: 'post',
                dataType: 'json',
                data: { sms_type: 'login', mobile: mobileValue },
                success: function(result) {
                    if (result.status) {
                        $('.type_box').eq(loginTypeValue).removeClass('err');
                        disapperTooltip("success", "验证码已发送，请注意查收");
                        // 开始倒计时
                        var countdown = 180;
                        function settime() {
                            if (countdown == 0) {
                                $('#getVerfyCode').prop("disabled", 0);
                                $('#getVerfyCode').removeClass('btn_disabled');
                                $('#getVerfyCode').val('获取验证码');
                                countdown = 180;
                                return;
                            } else {
                                $('#getVerfyCode').prop("disabled", !0);
                                $('#getVerfyCode').addClass('btn_disabled');
                                $('#getVerfyCode').val('重新发送' + countdown + '秒');
                                countdown--;
                            }
                            setTimeout(function() { 
                                settime()
                            },1000)
                        }
                        settime();
                    } else {
                        $('.type_box').eq(loginTypeValue).addClass('err');
                        $('.type_box').eq(loginTypeValue).find('.J_errbox').text(result.msg);
                        return false;
                    }
                }
            });
        } else {
            doLogin();
        }
    }

    // 顶部回车搜索
	$('#top_search_input').bind('keypress', function(event) {
		if (event.keyCode == "13") {
			$("#top_search_btn").click();
		}
	});

    // 顶部搜索跳转
    $('#top_search_btn').click(function() {
    	var keyValue = $.trim($('#top_search_input').val());
        if(qscms.keyUrlencode==1){
            keyValue = encodeURI(keyValue);
        }
    	var searchType = $('#top_search_type').val();
    	$.getJSON(qscms.root + '?m=Home&c=Index&a=search_location',{act: searchType, key: keyValue},function(result){
    		if(result.status == 1){
    			window.location=result.data;
    		}
    	})
    });
}(window.jQuery);