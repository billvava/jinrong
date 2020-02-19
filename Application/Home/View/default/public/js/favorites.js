    // 申请、收藏职位
    //jobSomething('.J_applyForJob', '申请成功！', true);
    addfav('#J_addfav', '收藏成功！', false);

    function addfav (trigger, successMsg, iscreate) {
        $(trigger).click(function() {
            var batch = '';
            var url = $(this).data('data_url');
            alert(url);
            return;
            var jidValue = '';
            if (batch) { // 是否是批量
                if (listCheckEmpty()) {
                    disapperTooltip('remind','您还没有选择职位！');
                    return false;
                } else {
                    var listCheckedObjs = $('.J_allListBox .J_allList.select');
                    var jidArray = new Array();
                    $.each(listCheckedObjs, function(index, val) {
                        jidArray[index] = $(this).closest('.J_jobsList').data('jid');
                    });
                    jidValue = jidArray.join(',');
                }
            } else {
                //jidValue = $(this).closest('.J_jobsList').data('jid');
            }

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {jid: jidValue}
            })
            .done(function(data) {
                if (parseInt(data.status)) {
                    if(data.data.html){
                        $(this).dialog({
                            title: '申请职位',
                            border: false,
                            content:data.data.html
                        });
                    } else {
                        disapperTooltip('success', successMsg);
                    }
                }
                else if(data.data==1){
                    location.href=qscms.root+"?m=Home&c=Personal&a=resume_add";
                }
                 else {
                    if (eval(data.dialog)) {
                        var qsDialog = $(this).dialog({
                            loading: true,
                            footer: false,
                            header: false,
                            border: false,
                            backdrop: false
                        });
                        if (iscreate) { // 申请职位
                            if (eval(qscms.smsTatus)) {// 是否开启短信
                                var creatsUrl = qscms.root + '?m=Home&c=AjaxPersonal&a=resume_add_dig';
                                $.getJSON(creatsUrl,{jid:jidValue}, function(result){
                                    if(result.status==1){
                                        qsDialog.hide();
                                        var qsDialogSon = $(this).dialog({
                                            content: result.data.html,
                                            footer: false,
                                            header: false,
                                            border: false
                                        });
                                        qsDialogSon.setInnerPadding(false);
                                    } else {
                                        qsDialog.hide();
                                        disapperTooltip("remind", result.msg);
                                    }
                                });
                            } else {
                                var loginUrl = qscms.root + '?m=Home&c=AjaxCommon&a=get_login_dig';
                                $.getJSON(loginUrl, function(result){
                                    if(result.status==1){
                                        qsDialog.hide();
                                        var qsDialogSon = $(this).dialog({
                                            title: '会员登录',
                                            content: result.data.html,
                                            footer: false,
                                            border: false
                                        });
                                        qsDialogSon.setInnerPadding(false);
                                    } else {
                                        qsDialog.hide();
                                        disapperTooltip("remind", result.msg);
                                    }
                                });
                            }
                        } else {
                            var loginUrl = qscms.root + '?m=Home&c=AjaxCommon&a=get_login_dig';
                            $.getJSON(loginUrl, function(result){
                                if(result.status==1){
                                    qsDialog.hide();
                                    var qsDialogSon = $(this).dialog({
                                        title: '会员登录',
                                        content: result.data.html,
                                        footer: false,
                                        border: false
                                    });
                                    qsDialogSon.setInnerPadding(false);
                                } else {
                                    qsDialog.hide();
                                    disapperTooltip("remind", result.msg);
                                }
                            });
                        }
                    } else {
                        disapperTooltip("remind", data.msg);
                    }
                }
            })
        });
}