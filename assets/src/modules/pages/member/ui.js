define(function(require,exports,module){
        var $ = require('jquery');
        var dialog=require('module/common/dialog');


        exports.cache=null;
         exports.success=function(message){
            dialog.dialog_ok(message);
         };
         exports.alert=function(message){
            this.success(message);
         };
         exports.error=function(message){
            this.success(message);
         };
         exports.confirm=function(message,btn_text,callback)
         {
            dialog.confirmDialog(message,'',btn_text,callback);
         }

         exports.loading=function()
         {
            var win = dialog({
               title: '',
               lock:true,
               width: '746px',
               fixed: true
            });
            win.showModal();
            exports.cache=win;
         }

         exports.sendCompany=function(cont)
         {
            exports.cache.content(cont);
         }

         var show=function(cont,callback,padding){
            if(!padding)
               padding='20px';
            var win = dialog({
               title: '温馨提示',
               width: '400px',
               padding: padding,
               fixed: true,
               content: cont
            });
            win.showModal();
            $('.j-dialog-close').click(function(){win.close();return false;});

            if (typeof(callback) == 'function')
            {

               $('.j-dialog-confirm').click(function(){callback();});
            }
         }

       

});