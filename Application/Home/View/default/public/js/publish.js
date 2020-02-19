var t;
$('#publishform .checked').each(function(){
    t = $(this).val();
    $(this).prevAll().find('.checkbox').each(function(){
        var v = $(this).val();
        if (t.indexOf(v) >= 0) {
            $(this).attr('checked',true);
        }
    })
});

$('#publishform .select').each(function(){
    $(this).change(function(){
        $(this).children("option").each(function(){
            var fcd = $(this).attr('form_category_id');
            if (fcd)$("#cat_" + fcd).hide();
            fcd = $(this).attr('extra_id');
            if (fcd)$("#" + extra_id).hide();
        });

        var form_category_id = $(this).find("option:selected").attr('form_category_id');
        if (form_category_id !== undefined) {
            $("#cat_" + form_category_id).show();
        }
        
        var extra_id = $(this).find("option:selected").attr('extra_id');
        if (extra_id !== undefined) {
            $("#" + extra_id).show();
        }
        
    });
});

$('#publishform .checkbox').each(function(){
    var form_category_id = $(this).attr('form_category_id');
    if (form_category_id !== undefined) {
            if ($(this).attr('checked') == true) {
                $("#cat_" + form_category_id).show();
            } else {
                $("#cat_" + form_category_id).hide();
            }
    }

    var have_relative = $(this).attr('have_relative');
        if (have_relative > 0) {
            if ($(this).attr('checked') == true) {
                var relative_id = $(this).attr('relative_id');
                $("#" + relative_id).show();
            } else {
                $("#" + relative_id).hide();
            }
        }
        
    $(this).click(function(){
        var form_category_id = $(this).attr('form_category_id');
        if (form_category_id !== undefined) {
            //alert($(this).attr('checked'));
            if ($(this).attr('checked') == true){
                //alert(111);
                $("#cat_" + form_category_id).show();
            } else {
                
                $("#cat_" + form_category_id).hide();
            }
        }

        var have_relative = $(this).attr('have_relative');
         if (have_relative > 0) {
            var relative_id = $(this).attr('relative_id');
            if ($(this).attr('checked') == true) {
                $("#" + relative_id).show();
            } else {
                $("#" + relative_id).hide();
            }
        }
        
        var have_extra = $(this).attr('extra');
        if (have_extra > 0) {
             var extra_id = $(this).attr('extra_id');
            if ($(this).attr('checked') == true) {
                $("#" + extra_id).show();
            } else {
                $("#" + extra_id).hide();
            }
        }
        
        
    });

});

$('a.T-hand-del').bind('click',function(){
        var toid = $(this).attr('data-id');
        var obj = $(this);
        if(!confirm('是否确认删除这条信息？'))return false;
        $.ajax({
            type: "post",
            data: 'id='+toid,
            url: "/Home/personal/del",
            dataType:'json',
            success: function(res){
                if(res.status==1)
                {
                    obj.parent().parent().parent().parent().remove();
                }
            }
        });
    });