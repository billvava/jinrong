require(['jquery','area','multiselect','formValidator','ajax_form','tooltip'], function ($){
    
    // 申请贷款
    $(function () {
        
        setTimeout(function () {
            $('.apply-loan-table').css('display','block');
        }, 500);
        


        /*
        if(qrh.uid){
            $('#J_loanList li:nth-child(2)').addClass('select')
                .siblings('li').removeClass('select');
            $('.basics').css('display', 'none');
            $('.additional-information').css('display', 'block');
        }
        */
        
        
        // 点击申请贷款
        $('#J_getLoan').click(function () {
            //window.location.href="/index.php/loan/2.html";
            // 打开基本资料
            $('.basics').css('display', 'block');
            $('.additional-information').css('display', 'none');
            $('.view-results').css('display', 'none');
            // 更换选项卡
            $('#J_loanList li:nth-child(1)').addClass('select')
                .siblings('li').removeClass('select');
            // 回到基本资料
            $('.apply-loan-table').css('display','block');
            
        });


        // 点击关闭
        $('#J_close').click(function () {
            $('.apply-loan-table').css('display','none');
        });

        // 点击输入姓名
        $('#J_username').focus(function () {
            $(this).addClass('select');
        }).blur(function () {
            $(this).removeClass('select');
            // 对输入值进行验证
            if ($.trim($(this).val())=='') {
                $(this).siblings('span').removeClass('select');
            } else {
                $(this).siblings('span').addClass('select');
            }
        });


    //发送手机验证码
    function toSetSms() {
        $.ajax({
            url: qrh.root+'?m=Home&c=Members&a=reg_send_sms',
            type: 'POST',
            dataType: 'json',
            data: {mobile: $.trim($('#mobile').val())}
        }).done(function(data) {
            if (parseInt(data.status)) {
                setTimeout(function() { 
                    disapperTooltip("success", "验证码已发送，请注意查收");
                },300);
                // 开始倒计时
                var countdown = 180;
                function settime() {
                    if (countdown == 0) {
                        $('#verify').prop("disabled", 0);
                        $('#verify').removeClass('btn_disabled');
                        $('#verify').val('获取验证码');
                        countdown = 180;
                        return;
                    } else {
                        $('#verify').prop("disabled", !0);
                        $('#verify').addClass('btn_disabled');
                        $('#verify').val('重新发送' + countdown + '秒');
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

        // 点击输入手机号
        $('#J_mobile').focus(function () {
            $(this).addClass('select');
        }).blur(function () {
            $(this).removeClass('select');
            // 对输入值进行验证
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if (!myreg.test($.trim($(this).val()))) {
                $(this).siblings('span').removeClass('select');
            } else {
                $(this).siblings('span').addClass('select');
            }
        });

        // 点击输入验证码
        $('#J_code').focus(function () {
            $(this).addClass('select');
        }).blur(function () {
            $(this).removeClass('select');
        });

        // 点击获取验证码
        $('#getcode').click(function (){
        var mobileValue = $.trim($('#mobile').val());
        if (mobileValue == '') {
            setTimeout(function() { 
                disapperTooltip("remind", "请输入手机号码");
            },800)
            $('#mobile').focus();
            return false;
        };
        var regularMobile = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/;
        if (mobileValue != "" && !regularMobile.test(mobileValue)) {
            setTimeout(function() { 
                disapperTooltip("remind", "手机号码格式不正确");
            },500)
            $('#mobile').focus();
            return false;
        }
        $.ajax({
            url: qrh.root + '?m=Home&c=Members&a=ajax_check',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: 'mobile', param: mobileValue },
            success: function(json) {
                if (json && json.status) {
                    toSetSms();
                } else {
                    setTimeout(function() { 
                    disapperTooltip("remind", "该手机号已被注册，联系400电话,开通新业务");
                     },1500)
                    $('#mobile').focus();
                    return false;
                }
            }
        });
        });
        var res = false;
        // 基本资料 点击下一步 提交表单
        $('#J_basicsNextStep').click(function (){ 
            publishform = new formValidator();
            publishform.init('publishform');
            if (publishform.isValid()) return false;
            $("#publishform").serialize();
            //$('#publishform').submit();
            $.ajax({
            url: qrh.root+'?m=Home&c=Loan&a=apply_loan',
            type: 'post',
            dataType: 'json',
            data: $("#publishform").serialize(),
            success: function (result) {
                if(result.status == 1){
                    //window.location.href = result.data.url;
                    disapperTooltip("remind", result.msg);
                    res = true;
                    return res;
                }else{
                    disapperTooltip("remind", result.msg);
                    res = false;
                    return res;
                }
            },
            error:function(result){
                res = false;
                disapperTooltip("remind", result.msg);
                if(result.code == 1){
                    res = true;
                }
                return res;
            }
        });
        if(res == true){
            $('.basics').css('display', 'none');
            $('.additional-information').css('display', 'block');
        }else{
            return false;
        }

        // 基本资料 点击下一步 提交表单
        $('#J_informationNextStep').click(function (){
            publishform = new formValidator();
            publishform.init('publishform2');
            if (publishform.isValid()) return false;
            $("#publishform2").serialize();
            //$('#publishform').submit();
            $.ajax({
            url: qrh.root+'?m=Home&c=Loan&a=apply_loan',
            type: 'post',
            dataType: 'json',
            data: $("#publishform2").serialize(),
            success: function (result) {
                if(result.status == 1){
                    //window.location.href = result.data.url;
                    disapperTooltip("remind", result.msg);
                }else{
                    disapperTooltip("remind", result.msg);
                }
            },
            error:function(result){
                disapperTooltip("remind", result.msg);
            }
        });
        });

        // 更换选项卡
        $('#J_loanList li:nth-child(2)').addClass('select')
                .siblings('li').removeClass('select');
            return false;
        });

        // 下拉框获得焦点时更改样式
        $('.apply-loan-table select').focus(function () {
            $(this).addClass('select');
        }).blur(function () {
            $(this).removeClass('select');
        });

        // 补充资料下拉框样式
        $('.additional-information select').change(function () {
            if($(this).val() == '请选择'){
                // 获得更在select 之后span
                $($(this).nextAll('span')[0]).removeClass('select');
                console.log();
            } else {
                $($(this).nextAll('span')[0]).addClass('select');
            }
        });

        // 补充资料 点击下一步 提交表单
        $('#J_informationNextStep').click(function () {
            $('.additional-information').css('display', 'none');
            $('.view-results').css('display', 'block');
            // 更换选项卡
            $('#J_loanList li:nth-child(3)').addClass('select')
                .siblings('li').removeClass('select');
            return false;
        });

        // 点击查看结果的完成
        $('.view-results a').click(function () {
            // 触发关闭
            $('#J_close').click();
        });

        // 文本框样式
        $('textarea').focus(function () {
            $(this).addClass('select');
        }).blur(function () {
            $(this).removeClass('select');
        });
        var MultiSelectChange = function(cls){
            $('#'+cls.hdId).trigger('blur');
        }
        var multiSelect = new MultiSelect('last_area_iddivAreaSelect','last_area_id',dataMultiArea,dataAllArea);
        multiSelect.pLabels  = '省,市,县/区';
        multiSelect.pClass   = 'mr5';
        multiSelect.pNames  = 'province_id,city_id,area_id';
        multiSelect.pStart  = 1;
        multiSelect.init(chinese_id);
        multiSelect.select(qrh.last_area_id);
    });

});










