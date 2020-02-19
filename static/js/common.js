define(function(require) {

$("input.placeholder").focus(function(){
var cur=$(this);
cur.val()==cur.attr("tip")&&cur.val("").css({color:"#333"})}).blur(function(){
var cur=$(this);""==cur.val()&&cur.val(
        cur.attr("tip")).css({color:"#999"})}).css({color:"#999"}
);

$("button.J_search_submit").click(function(){
    var b=$(this).prev(".placeholder");
    b.val()==b.attr("tip")&&b.val("");
});

$(".item_search").on('click', function() {
    $('#item_form').submit();
});


$('.onekey_pull_to_funder').click(function(){
var funder_id = $(this).attr('data-funder-id');
var user_id = $(this).attr('data-user-id');

$.getJSON("/index.php?m=&c=AjaxPersonal&a=senditem&funder_id="+funder_id+'&user_id='+user_id,function(result){
if(result.status == 1){
require(['layer'], function (layer){
layer.open({
type: 1,
title: '请登录',
shadeClose: true,
area: ['auto','240px'], //宽高
content: result.data
});
});
}else{

layer.open({
type: 1,
title: '请登录',
shadeClose: true,
content: result.msg
});

}
});
});


$('.onekey_pull_to_itemer').click(function(){
var funder_id = $(this).attr('data-funder-id');
var user_id = $(this).attr('data-user-id');

$.getJSON("/index.php?m=&c=AjaxPersonal&a=senditem&funder_id="+funder_id+'&user_id='+user_id,function(result){
if(result.status == 1){
require(['layer'], function (layer){
layer.open({
type: 1,
title: '请登录',
shadeClose: true,
area: ['auto','240px'], //宽高
content: result.data
});
});
}else{

layer.open({
type: 1,
title: '请登录',
shadeClose: true,
content: result.msg
});

}
});
});



/*
return {

};
*/

});

