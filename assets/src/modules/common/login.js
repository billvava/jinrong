define(function(require, exports, module){
require('jquery');
require('page/common');
require('jquery.form');
var dialog = require('component/dialog/dialog');
module.exports = {
    dialog: function(){
			var dl = dialog({
				title: "请登录",
				lock:true,
				fixed:true,
				width:'480px',
				close: function(){
					dl = null;
				}
			});
			dl.showModal();
		    $.ajax({
				url: '/ajax/login/dialog',
				type:'POST',
				cache:false,
				data:'_=',
				success: function (data){
					dl.content(data);

					var ologin = new TrjcnLogin();
					ologin.init('J_dl_login_frm');
					ologin.login_tip=function(msg)
					{
						var self = this;
						if (msg)
							self.d('login-msg').html('<i class="icoErr16"></i>'+msg).parents('.part-fieldset').show();
						else
							self.d('login-msg').parents('.part-fieldset').hide();
					}
					ologin.jump=false;
					var dlb = require('module/common/reg');
					$('#J_dl_reg').click(function(){
						dl.remove();
						dlb.dialog();
					});
				}
			});
		}
  };

});