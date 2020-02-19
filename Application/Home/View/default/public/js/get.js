function buttonClick($el){
    $('.btn-publish-leave-msg').click(function(){
        layer.open({
            type: 1,
            title: '温馨提示',
            skin: 'layui-layer-rim',
            area: ['520px','173px'],
            content: '<form class="layerContent fn-tac ui-dialog-body">' +
            '<p class="part-popup-ittext">留言内容不能为空</p>'+
            '<footer class="fn-mt-30"><a href="javascript:;" id="J_dialog_close" class="ui-btn ui-btn-orange">确定</a></footer>'+
            '</form>'
        });
    });
}
