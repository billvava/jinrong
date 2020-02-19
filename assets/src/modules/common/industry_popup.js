define(function(require, exports, module){
    require('jquery');
    require('page/common');
    var dialog = require('component/dialog/dialog');
    module.exports = {
    	popup_open:function(max_madesel_num,error_info_id){
    		$('#select_tz_industry').click(function(){
    			var win = dialog({
    		        title: '请选择投资行业',
    		        width:'690px',
    		        lock:true,
    		        fixed:true,
    		        cancelValue:'关闭',
    		        content:document.getElementById('pop_tz_industry')
    			});
    			win.showModal();
    			
    			$('input',$('nav')).change(function(){
    				if($(this).prop('checked') == false){
    					var tempid = $(this).val();
    					$('input[value='+tempid+']',$('.pop-secondary-nav')).attr('checked',false);
    					$(this).parents('label').remove();
    					tz_industry_arr.splice($.inArray(tempid,tz_industry_arr),1);
    				}
    			});
    			
    			//点击确认
    			$('.pop-msg-limit').click(function(){
    				var industry_id_arr = Array();
    				var	industry_name_arr = Array();
    				$('input[name=industry]:checked').each(function(){
    					industry_id_arr.push($(this).val());
    					industry_name_arr.push($(this).attr('txt'));
    				});
    				if(industry_id_arr.length > 0){
    					if(error_info_id){
    						$('#'+error_info_id).html('');
    					}else{
    						$('#tz_industry_info').html('');
    					}
    				}
    				var industry_ids = industry_id_arr.join(',');
    				var industry_names = industry_name_arr.join(', ');
    				if($('input[name=tz_industry]').val() == undefined){
    					$('#select_tz_industry').after('<input class="tz_industry" name="tz_industry" type="hidden" value="'+industry_ids+'">');
    				}else{
    					$('input[name=tz_industry]').val(industry_ids);
    				}
    				if(!max_madesel_num){
    					industry_names = industry_names.length > 20 ? industry_names.substring(0, 20)+'...' : industry_names;
    				}
    				$('#select_value_name').html(industry_names);
    				
    				$('input:checkbox',$('nav')).not('input:checked').parents('label').remove();
    				
    				win.close();
    			});
    		});
    		
    		tz_industry_arr = tz_industry.split(',');
    		max_madesel_num = max_madesel_num?parseInt(max_madesel_num):0;
    		
    		//点击一级分类，出子弹窗
    		$('.pop-primary-nav').click(function(){
    			var thisclk = $(this);
    			var data_id = thisclk.attr('data-id');
    			var param = 'id='+data_id;
    			var success = function(res){
    				var secondary_nav = $('#secondary-nav'+data_id);
    				var data_name = thisclk.find('a').html();
    				if(res.code == 200){//有数据
    					if(secondary_nav.html() == undefined){//第一次出
    						var str = '<div class="fn-pr"><div class="pop-secondary-nav" id="secondary-nav'+data_id+'"><label class="fn-font-b">';
    						if($.inArray(data_id, tz_industry_arr) < 0){
    							str = str + '<input type="checkbox" value="'+data_id+'" value_name="'+data_name+'"/>';
    						}else{
    							str = str + '<input type="checkbox" value="'+data_id+'" value_name="'+data_name+'" checked/>';
    						}
    						str = str + data_name+'</label>';
    						for(var k in res.data){
    							if($.inArray(res.data[k].id, tz_industry_arr) < 0){
    								str += '<label><input type="checkbox" value="'+res.data[k].id+'" value_name="'+res.data[k].name+'"/>'+res.data[k].name+'</label>';
    							}else{
    								str += '<label><input type="checkbox" value="'+res.data[k].id+'" value_name="'+res.data[k].name+'" checked/>'+res.data[k].name+'</label>';
    							}
    						}
    						str += '</div></div>';
    						thisclk.before(str);
    						
    						//点里面显示，点外面隐藏
    						$('.pop-secondary-nav').click(function(event){    
    						    event=event||window.event;    
    						    event.stopPropagation();    
    						});    
    						$(document).click(function(event){                         
    							$('.pop-secondary-nav').hide();    
    						});
    						
    						//移上去变背景色
    						$('.pop-secondary-nav label').hover(function(){
    				            $(this).addClass('cur');
    				        },function(){
    				            $(this).removeClass('cur');
    				        });
    						
    						//选中、取消选中
    						$('input[type=checkbox]',$('#secondary-nav'+data_id)).change(function(){
    							var child_id = $(this).val();
    							var child_name = $(this).attr('value_name');
    							if($(this).prop('checked') == true){
    								if(max_madesel_num){
    									if($('input:checked',$('nav')).length >= max_madesel_num){
    										alert('VIP会员最多可选择'+max_madesel_num+'个行业');
    										$(this).attr('checked',false);
    										return false;
    									}
    								}
    								handle_selected_industry(child_id,child_name);//操作选中
    							}else{
    								$('#selected'+child_id).remove();
    							}
    							if($(this).parents('label.fn-font-b').html() != undefined){//一级分类
    								$('#secondary-nav'+data_id+' input[type=checkbox]').each(function(){
    									var temp_id = $(this).val();
    									if(temp_id != child_id){
    										$(this).attr('checked',false);
    										$('#selected'+temp_id).remove();
    									}
    								});
    							}else{//二级分类
    								$('#secondary-nav'+data_id+' label.fn-font-b input').attr('checked',false);
    								var pid = $('#secondary-nav'+data_id+' label.fn-font-b input').val();
    								$('#selected'+pid).remove();
    							}
    						});
    					}else{//第二次出只是显示
    						secondary_nav.show();
    					}
    				}else{//没有数据
    					if(secondary_nav.html() == undefined){//第一次出
    						var str = '<div class="fn-pr"><div class="pop-secondary-nav" id="secondary-nav'+data_id+'"><label class="fn-font-b">';
    						if($.inArray(data_id, tz_industry_arr) < 0){
    							str = str + '<input type="checkbox" value="'+data_id+'" value_name="'+data_name+'"/>';
    						}else{
    							str = str + '<input type="checkbox" value="'+data_id+'" value_name="'+data_name+'" checked/>';
    						}
    						str = str + data_name+'</label></div></div>';
    						
    						thisclk.before(str);
    						
    						//移上去变背景色
    						$('.pop-secondary-nav label').hover(function(){
    				            $(this).addClass('cur');
    				        },function(){
    				            $(this).removeClass('cur');
    				        });
    						
    						//选中、取消选中
    						$('input[type=checkbox]',$('#secondary-nav'+data_id)).change(function(){
    							var child_id = $(this).val();
    							var child_name = $(this).attr('value_name');
    							if($(this).prop('checked') == true){
    								if(max_madesel_num){
    									if($('input:checked',$('nav')).length >= max_madesel_num){
    										alert('VIP会员最多可选择'+max_madesel_num+'个行业');
    										$(this).attr('checked',false);
    										return false;
    									}
    								}
    								handle_selected_industry(child_id,child_name);//操作选中
    							}else{
    								$('#selected'+child_id).remove();
    							}
    						});
    					}else{//第二次出只是显示
    						secondary_nav.show();
    					}
    				}
    			};
    			Trjcn.Ajax.post("/capital/get_industry_child.html", param, success);
    		});
    		
    		function handle_selected_industry(child_id,child_name){
    			if($('label:last',$('nav')).html() == undefined){
    				var selected_point = $('#selected_industry');
    			}else{
    				var selected_point = $('label:last',$('nav'));
    			}
    			selected_point.after('<label id="selected'+child_id+'"><input name="industry" value="'+child_id+'" txt="'+child_name+'" type="checkbox" checked>'+child_name+'</label>');
    			$('input[txt="'+child_name+'"]',$('nav')).change(function(){
    				if($(this).prop('checked') == true){
    					$('input[value='+child_id+']',$('.pop-secondary-nav')).prop("checked",true);
    				}else{
    					$('input[value='+child_id+']',$('.pop-secondary-nav')).attr('checked',false);
    					$(this).parents('label').remove();
    				}
    			});
    		}   
        }
    }
});