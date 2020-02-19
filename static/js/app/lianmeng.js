require(['jquery','area','multiselect','formValidator','ajax_form','tooltip'/*,'select'*/], function ($){
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

        $('.create_btn').click(function (){
            publishform = new formValidator();
            publishform.init('stlm-form');
            if (publishform.isValid()) return false;
        });
});










