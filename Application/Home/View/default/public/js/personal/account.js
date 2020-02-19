		//是否营收--begin
		$('input:radio[name="is_earnings"]').bind('click', function(){			
			if($(this).val()==2){
				$('#years_revenue_area').css('display','none');
				$('#years_profit_area').css('display','none');
			}
			else{
				$('#years_revenue_area').css('display','block');
				$('#years_profit_area').css('display','block');
			}
		});
		//是否营收--end

		//职务--begin
		$('#contact_job').change(function(){
	        var self = $(this), jobname = self.parent().parent().next();
	        if (self.val()==99)
	        {
	        	jobname.show().parent().parent().next().show();
	        	if(jobname.val()=='')
	            	jobname.val('经理');
	        }else{
	            if(self.val())jobname.val(self.find('option:selected').text());
	            else jobname.val('');
	            jobname.hide().next().hide();
	        }
	    }).trigger('change');
	    var jobname = $("#contact_job_name");
		
		//职务--end

		//企业类型--begin
		$('#company_type').change(function(){
	        var self = $(this), objname = self.parent().parent().next();
	        if (self.val()==99){
	        	objname.show().parent().parent().next().show();
	        	if(objname.val()=='')
	            	objname.val('咨询');
	        }else{
	            if(self.val())objname.val(self.find('option:selected').text());
	            else objname.val('');
	            objname.hide().next().hide();
	        }
	    }).trigger('change');
		//企业类型--end

		//意向投资行业初始值-begin
		if(typeof($('#tz_industry_all').val())!="undefined")
		{
			var arrTxt = Array();
			$('input[name="tz_industry[]"]:checked').each(function(idx,item){
				if($.inArray($(this).val(), arrTxt)<0)
				{
					arrTxt.push( $(this).attr('text') );
				}
				
			});
			if(arrTxt.length>0)
			{
				$('#tz_industry_all').html(arrTxt.join(' '));
				var tmp = arrTxt.join(', ');
				tmp = tmp.length>20 ? tmp.substring(0, 20)+'..' : tmp;
				$('#tz_industry_span').html(tmp);
			}
		}
		//意向投资行业初始值-end
	
		//请选择意向投资行业-begin
	  	$('.investment-industry').bind('click', function () {
			 var win = dialog({
				title: '请选择意向投资行业',
				width: '680px',
				fixed: true,
				content: document.getElementById('investment-industry')
				 
			});
			win.showModal();
			$('.j-dialog-close').click(function(){
				var arrId = Array();
				var arrTxt = Array();
				$('#tz_industry_span').html('');
				$('#hid_tz_industry').val('');
				
				$('input[name="tz_industry[]"]:checked').each(function(idx,item){
					if($.inArray($(this).val(), arrId)<0)
					{
						arrId.push($(this).val());
						arrTxt.push( $(this).attr('text') );
					}
				});
				if(arrId.length>0)
				{
					$('#hid_tz_industry').val(','+arrId.join(',')+',');
					$('#tz_industry_all').html(arrTxt.join(' '));
					var tmp = arrTxt.join(', ');
					tmp = tmp.length>20 ? tmp.substring(0, 20)+'..' : tmp;
					$('#tz_industry_span').html(tmp);
					$('#tz_industry_info').css('display','none');
				}

			  	win.close();return false;
			});	
	  	});
	  	//请选择意向投资行业-end
	  	

	  	
	  	//意向投资地区初始值-begin
	  	if(typeof($('#tz_area_span').val())!="undefined")
		{
			var arrAreaTxt = Array();
			$('input[name="tz_area[]"]:checked').each(function(idx,item){
				
				if($.inArray($(this).val(), arrAreaTxt)<0)
				{
					arrAreaTxt.push( $(this).attr('text') );
				}
				
			});
			if(arrAreaTxt.length>0)
			{
				var tmp = arrAreaTxt.join(', ');
				tmp = tmp.length>20 ? tmp.substring(0, 20)+'..' : tmp;
				$('#tz_area_span').html(tmp);
			}
		}
		//意向投资地区初始值-end
	  	//意向投资地区-begin
	  	$('.investment-area').bind('click', function () {
			var win = dialog({
				title: '请选择意向投资地区',
				width: '566px',
				fixed: true,
				content: document.getElementById('investment-area')
				 
			});
			win.showModal();
			$('.j-dialog-close').click(function(){
				var arrId = Array();
				var arrTxt = Array();
				$('#tz_area_span').html('');
				$('#hid_tz_area').val('');
				
				$('input[name="tz_area[]"]:checked').each(function(idx,item){
					if($.inArray($(this).val(), arrId)<0)
					{
						arrId.push($(this).val());
						arrTxt.push( $(this).attr('text') );
					}
				});
				
				if(arrId.length>0)
				{
					$('#hid_tz_area').val(','+arrId.join(',')+',');
					var tmp = arrTxt.join(', ');
					tmp = tmp.length>20 ? tmp.substring(0, 20)+'..' : tmp;
					$('#tz_area_span').html(tmp);
					$('#tz_area-error').css('display','none');
				}

				win.close();
				return false;

			});	
		});
		//意向投资地区-end


		//成功案例--begin  +添加一条新的成功案例
		$('.j-btn-more-case').bind('click', function () {
			part_case_num++;
		  	var html = $('#tz_case').html();
		  	html = html.replace(/eg_case\[i\]/g,'case['+part_case_num+']');
		  	$(this).parents(".part-fieldset").before(html);

		  	var obj = $('.j-investment-checkbox').parents(".part-fieldset").siblings(".part-fieldset-case").find(".j-investment-hide");

			$('.fieldsetBd').delegate('.prompt-pass-style','focus',function(){
		  		$(this).next(".prompt_pass").css("display","none");
		  	});
		  	$('.fieldsetBd').delegate('.prompt-pass-style','blur',function(){
		  		if($(this).val()=="")
		  		{
		  			$(this).next(".prompt_pass").css("display","block");
		  		}
		  	});
		  	$(".prompt_pass").bind('click',function() {
				$(this).hide();
				$(this).prev().focus();
			});

			for(i=0;i<$(".t_tz_time").length;i++){        
	        if($(".t_tz_time").eq(i).val() == "")
	          {
	              $(".t_tz_time").eq(i).val("投资时间")
	          }  
	        }
             
           $('.fieldsetBd').delegate('.t_tz_time','focus',function(){
		  		if($(this).val() == "投资时间"){
		  			$(this).val('');
		  		}
		  	});

           if($(".part-fieldset-case").length > 2)
	  			$(".part-fieldset-msg").show();


	  	});

	  	//删除一条新的成功案例
	  	$('.fieldsetBd').delegate('.part-fieldset-msg','click',function(){$(this).parents(".part-fieldset-case").remove();
	  		if($(".part-fieldset-case").length == 2)$(".part-fieldset-msg").hide();
	  	});

	  	//隐藏投资的企业或个人名称
	  	$('.j-investment-checkbox').bind('click', function () {

	  		var obj = $(this).parents(".part-fieldset").siblings(".part-fieldset-case").find(".j-investment-hide");
			if($(this).find("input").attr("checked")=="checked"){
				$('#case_updated').val(1);
				obj.show();
				//$(this).html('<input type="checkbox"><span class="fn-vam">隐藏投资的企业或个人名称</span>');

				var cas_l = $(".j-investment-hide").children(".prompt-pass-style");

				for(i=0;i<cas_l.length;i++){
					if($(".j-investment-hide").children(".prompt-pass-style").eq(i).val()== "")
					{
						$(".j-investment-hide").children(".prompt-pass-style").eq(i).next().show();
					}else{
						$(".j-investment-hide").children(".prompt-pass-style").eq(i).next().hide();
					}
				}
			}else{
				$('#case_updated').val(1);
				//obj.find("input").val("某公司");
				//obj.hide();
				//$(this).html('<input type="checkbox" checked><span class="fn-vam">隐藏投资的企业或个人名称</span>');
			}
	  	});

	  	$('.fieldsetBd').delegate('.part-fieldset-case', 'click', function(){
	  		$('#case_updated').val(1);
	  	});
	  	$('.fieldsetBd').delegate('.part-fieldset-case', 'focus', function(){
	  		$('#case_updated').val(1);
	  	});
	  	//成功案例--end

	  	//兼容<ie8
	  	//$('#qq').val( $('#qq').val()=='输入常用的QQ号码'?'':$('#qq').val() );
	  	//-兼容<ie8
		//验证--begin
		jQuery.validator.addMethod("chinese", function(value, element) {
		    var chinese = /^[\u4e00-\u9fa5]+$/;
		    return this.optional(element) || (chinese.test(value));
	    }, "只能输入中文");
	    jQuery.validator.addMethod("num2", function(value, element) {
		    var num2 = /^\d+\.\d{1,2}$/;
		    return this.optional(element) || /^\d+$/.test(value) || (num2.test(value));
	    }, "只能输入两位小数");
        jQuery.validator.addMethod("numberAndLettersVal",function(value,element){  
         return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);  
        	},$.validator.format("请输入数字或者字母")  
        );  

	    // jQuery.validator.addMethod("tz_industry_required", function(value, element) {
		   //  if(value!="")
		   //  {
		   //  	$('#tz_industry-error').css('display','none');
		   //  }
		   //  return ;
	    // }, "请选择行业");
	    
		if(typeof(_is_personal)=="undefined")
		{
			_is_personal=0;
		}
		var ld = false;
		$("#afrm").validate({
			ignore: "",
			rules: {
				type : "required",
				company : _is_personal?{maxlength:1000}:'required',
				business_license_code : _is_personal?{numberAndLettersVal:true}:{"required":true,numberAndLettersVal:true},
				industry_id : "required",
				registered_capital : "required",
				is_earnings : "required",
				// 'years_revenue[]' : 'required',
				// 'years_profit[]' : 'required',
				net_asset : {
					required:true,number:true,num2:true
				},
				company_date : "required",
				//government
				//last_fiscal_revenue : 'required',
				//unit_address : 'required',
				//fund
				company_type : 'required',
				manage_funds : {
					required:true,digits:true,min:1
				},
				tz_industry : "required",	//tz_industry_
				realname : {
					required:true,chinese:true,minlength:2
				},
				phone_cr:{digits:true},
				phone_qh:{digits:true},
				phone:{digits:true},
				qq: {digits:true},
				email:{required:true,"email":true}
			  
			},
			messages: {
				type: '<i class="icoErr16"></i>请选择会员身份',
			   	company: '<i class="icoErr16"></i>请输入公司名称',
			   	business_license_code:  {
					required :'<i class="icoErr16"></i>请输入营业执照注册号', numberAndLettersVal:'<i class="icoErr16"></i>请正确输入您的营业执照注册号'
				},
			   	industry_id: '<i class="icoErr16"></i>请选择所属行业',
			   	registered_capital: '<i class="icoErr16"></i>请选择注册资本',
			   	is_earnings: '<i class="icoErr16"></i>',
			   	// 'years_revenue[]' : '<i class="icoErr16"></i>',
			   	// 'years_profit[]' : '<i class="icoErr16"></i>',
			   	net_asset : {
					required :'<i class="icoErr16"></i>请输入当前净资产', number:'<i class="icoErr16"></i>请正确输入当前净资产','num2':'<i class="icoErr16"></i>只能输入两位小数'
				},
				company_date: '<i class="icoErr16"></i>',
			   	//government
				//last_fiscal_revenue : '<i class="icoErr16"></i>',
				//unit_address : '<i class="icoErr16"></i>请填写单位地址',
				//fund
				company_type : '<i class="icoErr16"></i>请选择企业类型',
				manage_funds : {
					required :'<i class="icoErr16"></i>请输入管理资金总额', digits:'<i class="icoErr16"></i>请输入正整数',min:'<i class="icoErr16"></i>管理资金总额不能为零'
				},
				tz_industry : '<i class="icoErr16"></i>请选择行业',

			   	realname: {
					required :'<i class="icoErr16"></i>请输入您的真实姓名', chinese:'<i class="icoErr16"></i>请输入您的真实姓名',minlength:'<i class="icoErr16"></i>请输入您的完整姓名'
				},
			   	phone_cr : '<i class="icoErr16"></i>',
			   	phone_qh : '<i class="icoErr16"></i>',
			   	phone : '<i class="icoErr16"></i>请输入正确的电话',
			   	qq : '<i class="icoErr16"></i>请输入正确的qq',
			   	email : '<i class="icoErr16"></i>请输入正确的邮箱'
			},
			//errorClass:"ui-text-red",
			errorElement:"em",
			errorPlacement: function(error, element) { //指定错误信息位置 
				var arrELE = ['years_revenue[]','years_profit[]','net_asset', 'manage_funds'];

				if (element.is(':radio') || element.is(':checkbox') || $.inArray(element.attr('name'), arrELE)>-1 ) { //如果是radio或checkbox 
					var eid = element.attr('name'); //获取元素的name属性 
					error.appendTo(element.parent().parent()); //将错误信息添加当前元素的父结点后面 
				}
				else if (element.is('select')) {
				 	//error.appendTo(element.parent().next());
				 	error.appendTo(element.parent().parent().parent());
				}
				else
				{
					error.insertAfter(element);
				}

			},
			submitHandler:function(form){
	            //alert("submitted");   
	            //form.submit();
	            var bResult = validOther();
				//资金方
				
				if(typeof($('#tz_industry').val())!='undefined')
				{
					// if($('#tz_industry').val()=='')
					// {
					// 	$('#tz_industry_info').css('display','inline-block');
					// 	$('#tz_industry_info').html('<i class="icoErr16"></i>请选择行业');
					// 	bResult = true;
					// }
					// else
					// {
					// 	$('#tz_industry_info').css('display','none');
					// 	bResult = false;
					// }
				}
				if(typeof($('#hid_tz_area').val())!='undefined')
				{
					if($('#hid_tz_area').val()=='')
					{
						$('#tz_area-error').css('display','block');
						bResult = true;
					}
					else{
						$('#tz_area-error').css('display','none');
						bResult = false;
					}
				}

				if(typeof($('#logo').val())!='undefined'){
					if($('#logo').val()==''){
						$('#logo-error').css('display','block');
						bResult = true;
					}
					else if($('#logo').val()!='')
					{
						$('#logo-error').css('display','none');
						bResult = false;
					}
				}

				if(bResult || ld)
					return;
	            var options = { dataType:'json',
					success: function(res) {
						ld = false;
						//console.log(res);
						//return false;
			            if(res.code ==200){
			            	if( $('#initial_step').val() ==2 )
			            	{
			            		window.location.reload();
			            	}
			            	else
			            	{
				                var win = dialog({
				                	id: 'altDialog',
									title: '系统提示',
									width: '200px',
									fixed: true,
									lock:true,
									content: '<div class="popup-msg-a fn-tac"><p class="part-popup-ittext">修改成功</p><footer class="fn-mt-30"><a href="javascript:;" class="ui-btn ui-btn-red T-win-close">关闭</a></footer></div>',
				            		onclose : function(){window.location.href='/Personal/account.html';}
								});
								win.showModal();
							}
			            }else{
			            	var msg = '';
			            	$.each(res.data.error_messages,function(n,value) {  
             
				            	msg +=value+'<br />';
				           
				            });
			            	var win = dialog({
			            		id: 'altDialog',
								title: '系统提示',
								width: '200px',
								fixed: true,
								content: '<div class="popup-msg-a"><p class="part-popup-ittext">请正确填写:<br />'+msg+'</p><footer class="fn-mt-30 fn-tac"><a href="javascript:;" class="ui-btn ui-btn-red T-win-close">关闭</a></footer></div>',
								lock:true
							});
							win.showModal();
			            }
			        }
		    	};
		    	ld = true;
		        $('#afrm').ajaxSubmit(options);
	        }
		});
		
		//验证--end
		$('#J-submit').bind('click',function(){
			validOther();
			$("#afrm").submit();     
	    });

	    function validOther(){
	    	var bResult = false;
            if($('input:radio[name="is_earnings"]:checked').val()==1)		//有营收，以下才必填
 {
            	var bNeed = false;
	            $('input[name="years_revenue[]"]').each(function(idx,item){
					if($.trim($(this).val())=='' || isNaN($(this).val()) ){
						bNeed = true;
						$(this).addClass('part-fieldset-brred');
						$(this).focus();
					}else
						$(this).removeClass('part-fieldset-brred');
				});
				if(bNeed)
				{
					bResult = true;
					$('#_years_revenue-error').css('display','inline-block');
				}else
					$('#_years_revenue-error').css('display','none');
				bNeed = false;
				$('input[name="years_profit[]"]').each(function(idx,item){
					if($.trim($(this).val())=='' || isNaN($(this).val()) )
					{
						bNeed = true;
						$(this).addClass('part-fieldset-brred');
						$(this).focus();
					}
					else
						$(this).removeClass('part-fieldset-brred');
				});
				if(bNeed){
					bResult = true;
					$('#_years_profit-error').css('display','inline-block');
				}else
					$('#_years_profit-error').css('display','none');
			}
			//成功案例case[0][tz_time]
			//if($('input:radio[name="case[0][tz_time]"]').val()=='')
			/*
			$('input:text[name^="case"]').each(function(idx,item){
				if($.trim($(this).val())=='' || $(this).val()=='投资时间')
				{
					$(this).addClass('part-fieldset-brred');
					$(this).focus();
					bResult = true;
				}
				else
					$(this).removeClass('part-fieldset-brred');
			});
			*/
			return bResult;
	    }

		$('#J-preview-businesscard').bind('click', function () {
	        $('#contact_job_name,company,contact_name').each(function(){
	             $('#J-preview-'+$(this).attr('id') ).html($(this).val());
	        });
	        $('#show_userlogo').each(function(){
	             $('#J-preview-'+$(this).attr('id') ).attr('src', $(this).attr('src') );
	        });
	        if($('input:radio[name="contact_sex"]:checked').length>0)
	        {
		        if($('input:radio[name="contact_sex"]:checked').val()==1)
		        	$('#J-preview-sex_name').html('先生');
		        else
		        	$('#J-preview-sex_name').html('女士');
	        }
	        if ($('#select_value_name').html())
	        	$('#T-industry').html($('#select_value_name').html());
	        else
	        	$('#T-industry').html($('#industry_id option:selected').text());
	        var win = dialog({
		        title: '名片预览',
		        width:'320px',
		        lock:true,
		        fixed:true,
		        content:document.getElementById('previewDialog')
	        });
	        win.showModal();
	    });

	    $('#J-del-companylogo').bind('click',function(){
            var picno = $(this).attr('_upId');
            if(picno=='' || typeof(picno)== "undefined") return;
            if (!confirm('确定要删除该图片吗？'))return;
            $("#"+picno).val('');
            $("#show_"+picno).css('display','none');
	    });

	    $('.J-del-img').bind('click',function(){
            var picno = $(this).attr('_upId');
            if(picno=='' || typeof(picno)== "undefined") return;
            if (!confirm('确定要删除该图片吗？'))return;
            $("#"+picno).val('');
            $("#"+$(this).attr('_showId')).css('display','none');
	    });


	/*
	//地区--begin
	// setTimeout(
	// 	function(){
	seajs.use(['jquery'], function ($) {
		seajs.use(['other/area','other/multiselect'],function(){
			//地区--begin
			if(typeof($('#last_area_id').val())!="undefined")
			{
				var multiSelect         = new MultiSelect('divAreaSelect','last_area_id',dataMultiArea,dataAllArea);
			    multiSelect.pLabels  = '省,市,县/区';
			    //multiSelect.pClass   = 'w70 mr5';
			    multiSelect.pNames  = 'province_id,city_id,area_id';
			    multiSelect.pStart  = 1;
			    multiSelect.init(chinese_id);
			    var initId = $('#last_area_id').val();
			    if(initId=='' || initId==0)
			    	initId = chinese_id;
			    multiSelect.select(initId);
			    $("#divAreaSelect select").each(function(){
			    	$(this).addClass("select-style");
		           	//$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
		        });
			}
			//地区--end

			//公司地区--begin
			if(typeof($('#company_area_id').val())!="undefined")
			{
				var multiSelectCom         = new MultiSelect('divAreaSelectCompany','company_area_id',dataMultiArea,dataAllArea);
			    multiSelectCom.pLabels  = '省,市,县/区';
			    //multiSelectCom.pClass   = 'w70 mr5';
			    multiSelectCom.pNames  = 'province_id_com,city_id_com,area_id_com';
			    multiSelectCom.pStart  = 1;
			    multiSelectCom.init(chinese_id);
			    var initIdCom = $('#company_area_id').val();
			    if(initIdCom=='' || initIdCom==0)
			    	initIdCom = chinese_id;
			    multiSelectCom.select(initIdCom);
			    $("#divAreaSelectCompany select").each(function(){
			    	$(this).addClass("select-style");
		           	//$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
		        });
		        if( $("#divAreaSelectCompany").attr('disabled') )
		        {
		        	$("#divAreaSelectCompany select").each(function(){
			           $(this).attr("disabled","disabled");
			        });
		        }
	        }
			//公司地区--end
		});
	});

	// }, 1000);
	//地区--end
	/*
	//上传图片--begin
	seajs.use(['jquery'],function($){
		seajs.use(['page/member/uploadify'],function(app){
			if(upload_param.type){
				app.initialize({
				  	'formData':{
				      "uid" : upload_param.uid,
				      "token" : upload_param.token,
				      "type" : upload_param.type
				  	},
				  	'buttonImage' : upload_param.js_url+'uploadify/button.png',
				  	'swf' : upload_param.js_url+'uploadify/uploadify.swf',
				  	'uploader' : upload_param.upload_url+'/service/upload.uploadimg.html',
				  	'file_post_name' : upload_param.type+'_upload',
				  	'callback':function(file, data, response) {
				        if (!data){
				         alert('上传失败');
				         return;
				        }
				        var upId = upload_param.type;
				        data = data.split('|');
				        if (data[0] == 100){
				          $('#'+upId).nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
				        }else if(data[0] == 200 && data[1]!=''){
				          var path=data[1];
				          
				          $('#'+upId).val(path);
				          $('#'+upId).nextAll('em').css('display','block');
				          $('#'+upId).nextAll('em').html('<i class="icoCor16"></i>');
				          $("#show_"+upId).attr('src','/'+path);
				        }
				    }
			    });
			}

			if(upload_param.type2){
				app.initialize({
				  	'formData':{
				      "uid" : upload_param.uid,
				      "token" : upload_param.token,
				      "type" : upload_param.type2
				  	},
				  	'buttonImage' : upload_param.js_url+'uploadify/button.png',
				  	'swf' : upload_param.js_url+'uploadify/uploadify.swf',
				  	'uploader' : upload_param.upload_url+'/service/upload.uploadimg.html',
				  	'file_post_name' : upload_param.type2+'_upload',

				  	'callback':function(file, data, response) {
				        if (!data){
				         alert('上传失败');
				         return;
				        }
				        var upId = upload_param.type2;
				        data = data.split('|');
				        if (data[0] == 100){
				          $('#'+upId).nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
				        }else if(data[0] == 200 && data[1]!=''){
				          var path=data[1];
				          
				          $('#'+upId).val(path);
				          $('#'+upId).nextAll('em').css('display','block');
				          $('#'+upId).nextAll('em').html('<i class="icoCor16"></i>');
				          $("#show_"+upId).attr('src','/'+path);
				        }
				    }
			    });
			}//-upload_param.type2
			
			if(upload_param.type3){
				app.initialize({
				  	'formData':{
				      "uid" : upload_param.uid,
				      "token" : upload_param.token,
				      "type" : upload_param.type3
				  	},
				  	'buttonImage' : upload_param.js_url+'uploadify/button.png',
				  	'swf' : upload_param.js_url+'uploadify/uploadify.swf',
				  	'uploader' : upload_param.upload_url+'/service/upload.uploadimg.html',
				  	'file_post_name' : upload_param.type3+'_upload',
				  	'callback':function(file, data, response) {
				        if (!data){
				         alert('上传失败');
				         return;
				        }
				        var upId = upload_param.type3;
				        data = data.split('|');
				        if (data[0] == 100){
				          $('#'+upId).nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
				        }else if(data[0] == 200 && data[1]!=''){
				          var path=data[1];
				          $('#'+upId).val(path);
				          $('#'+upId).nextAll('em').css('display','block');
				          $('#'+upId).nextAll('em').html('<i class="icoCor16"></i>');
				        }
				    }
			    });
			}//-upload_param.type3

			if(upload_param.typepic){
				app.initialize({
				  	'formData':{
				      "uid" : upload_param.uid,
				      "token" : upload_param.token,
				      "type" : upload_param.typepic
				  	},
				  	'buttonImage' : upload_param.js_url+'uploadify/button.png',
				  	'swf' : upload_param.js_url+'uploadify/uploadify.swf',
				  	'uploader' : upload_param.upload_url+'/service/upload.companypic.html',
				  	'file_post_name' : upload_param.typepic,

				  	'callback':function(file, data, response) {
				        if (!data){
				         alert('上传失败');
				         return;
				        }
				        var upId = upload_param.typepic;
				        data = data.split('|');
				        if (data[0] == 100){
				          $('#'+upId).parent().parent().find('.'+upId+'-error').html('<i class="icoErr16"></i>'+data[1]);
				        }else if(data[0] == 200 && data[2]!=''){
				          var path=data[2];
				          				         
				          $('#'+upId).nextAll('em').html('');
				          $('#T-company-pic').append('<li><img src="'+path+'"><i class="icoErr16 X-pic-del" data-id="'+data[1]+'"></i></li>');
				          var num = $('#T-company-pic').find('li').length;
				          $("#T-company-pic").width(num*90);
				          if(num>5)
				          {
				          	$(".company-piclist-field").css("padding-left","20px");
				          	$(".sPrev").show();
				          	$(".sNext").show();
				          	$(".sNext").click();
				          }
				        }
				    }
			    });
			}//-upload_param.typepic

			if(upload_param.card){
				app.initialize({
					'formData':{
						"uid" : upload_param.uid,
						"token" : upload_param.token,
						"type" : upload_param.card
					},
					'buttonImage' : upload_param.js_url+'uploadify/button.png',
					'swf' : upload_param.js_url+'uploadify/uploadify.swf',
					'uploader' : upload_param.upload_url+'/service/upload.uploadimg.html',
					'file_post_name' : upload_param.card+'_upload',

					'callback':function(file, data, response) {
						if (!data){
							alert('上传失败');
							return;
						}
						var upId = upload_param.card;
						data = data.split('|');
						if (data[0] == 100){
							$('#'+upId).nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
						}else if(data[0] == 200 && data[1]!=''){
							var path=data[1];

							$('#'+upId).val(path);
							$('#'+upId).nextAll('em').css('display','block');
							$('#'+upId).nextAll('em').html('<i class="icoCor16"></i>');
							$("#show_"+upId).attr('src','/'+path);
						}
					}
				});
			}//-upload_param.card
		});
	});
	//上传图片--end


	//投资行业-begin
	seajs.use(['module/common/industry_popup'],function(industry){
		industry.popup_open(null, 'tz_industry-error');
	});
	//投资行业-end

*/
	//Dialog关闭处理
		$('body').delegate('.T-win-close', 'click', function(){
			var win = dialog.get('altDialog');
			win.close();
			try{
				win.remove();
			}catch(e){}
		});

	
	//-Dialog关闭处理

	/*
	//企业展示图
	seajs.use('jquery',function () {
	    $(function(){
			var l = $(".company-piclist").find("li").length;
			
			if(l > 5){
				$(".company-piclist-field").css("padding-left","20px");
			    $(".company-piclist-field").find("a").css("display","block");	
			}
			
			$(".company-piclist").find("ul").width(90*l);
			$(".company-piclist-field").find(".sNext").click(function(){
				var l = $(".company-piclist").find("li").length;
				if(!$(".company-piclist").find("ul").is(":animated"))
				{
					var ul_left = Math.abs(parseInt($(".company-piclist").find("ul").css("left")));
					if(ul_left < (90*l)-450){
						$(".company-piclist").find("ul").animate({left:-(ul_left+90)+"px"});
					}
				}

			})
			$(".company-piclist-field").find(".sPrev").click(function(){
				var l = $(".company-piclist").find("li").length;
				if(!$(".company-piclist").find("ul").is(":animated"))
				{
					var ul_left = Math.abs(parseInt($(".company-piclist").find("ul").css("left")));
					if(ul_left > 0){
						$(".company-piclist").find("ul").animate({left:-(ul_left-90)+"px"});
					}
				}
				
			});

			$(".company-piclist").delegate('.X-pic-del','click',function(){
				if (!confirm('确定要删除吗？'))return false;
				var id = $(this).attr('data-id');
				var that = $(this).parent();
				that.remove();
				$.post("/service/user.uploadpic_del",{id:id},function(res){
					
				});

				var l = $(".company-piclist").find("li").length;
				$("#T-company-pic").width(90*l);
				if(l < 6){
					$(".company-piclist-field").css("padding-left","0");
					$(".company-piclist-field").find(".sPrev").css("display","none");
					$(".company-piclist-field").find(".sNext").css("display","none");	
					$("#T-company-pic").css("left",0);
			    }
			});


		});
	});
	//-企业展示图

	*/






