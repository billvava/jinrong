define(function(require, exports, module){
require('jquery');
var dialog = require('component/dialog/dialog');
module.exports = {

    dialog: function(){
	    	require('page/common');
			require('jquery.form');
			require('component/jquery.validate.min');
			var dl = dialog({
				title: "请注册",
				lock:true,
				fixed:true,
				width:'480px',
				close: function(){
					dl = null;
				}
			});
			dl.showModal();
		    $.ajax({
				url: '/ajax/reg/dialog',
				type:'POST',
				cache:false,
				data:'_=',
				success: function (data){
					dl.content(data);


					$('#T-reg-mobile-code').each(function(){
						window.mobileCode = new TrjcnMobileCode();
						window.mobileCode.init('mobile');
						window.mobileCode.handmsg=function(msg){
							return window.mobileCode.mobileInfoHand.html('<em class="ui-text-red"><i class="icoErr16"></i>'+msg+'</em>');
						}
					});

					var validate = $("#J_dl_reg_frm").validate({
					rules:{
						mobile:"required",
						mobilecode:"required"
					},
					messages: {
		               	mobile:{required:'<i class="icoErr16"></i>请输入手机号码.'},
		               	mobilecode:{required:'<i class="icoErr16"></i>请输入验证码.'}
		            },errorElement:'em',errorClass:'ui-text-red',errorPlacement:function(error, element) {
		            	var span = element.nextAll('span');
		            	span.html('');
					    error.appendTo(span);
					}});

					$('#J_dl_btn_reg').click(function(){
						if (!validate.form())return;
						var param = $('#J_dl_reg_frm').formSerialize();
						$.ajax({
							url: '/api/reg/submit',
							type:'POST',
							dataType:'json',
							data:param,
							success: function (res){
								if (res.code==200){
									location.reload();
								}
								else
								{
									for(var k in res.data.error_messages){
										$('#J_mobile_info').html('<em class="ui-text-red"><i class="icoErr16"></i>'+res.data.error_messages[k]+'</em>').show();
										break;
									}
								}
							}
						});
					});

				}
			});
		}
  };

});