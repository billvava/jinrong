var afterAjax = function(){
   qrh.cache.loading = false;
   if (qrh.cache.btn)qrh.cache.btn.html(qrh.cache.btn.attr('data-label'));
}

$(function(){
if (window.qrh_Config.page=='publish'){
qrh.cache.publishform = new formValidator();
qrh.cache.publishform.init('publishform');
qrh.cache.publishform.okhide = true;
$('#form_publish').click(function() {
    if (qrh.cache.publishform.isValid()) return false;
    var frm_temp=$('#publishform').serialize();
    if(typeof(frmData) != "undefined" && frmData==frm_temp)
    {
        alert('您尚未修改信息，请修改后再发布');
        return;
    }
    $('#publishform').submit();
});
}

});