          define(function(require,exports,module){
            exports.init=function(){
                var $ = require('jquery');
                var businesscard=require('page/member/businesscard');
                var dialog=require('module/common/dialog');
                    $('#seen_me_btn').off('click').on('click',function(){
                          if($("#keyword").val()==$("#keyword").attr("placeholder"))
                          {
                            $("#keyword").val('');
                          }
                          $('#search_form').submit();
                     });

                   var a = $('.news-info-control a');
                   a.filter('[event="click.unfollow"]').off('click').on('click',function(){
                        var _this   = $(this);
                        businesscard.unfollow( _this.parent().attr('data-id'),function(ret){
                            _this.parents('li').remove();
                        } );
                  });

                  a.filter('[event="click.exchange"]').off('click').on('click',function(){
                      var _this   = $(this);
                        businesscard.exchange( _this.parent().attr('data-id'),function(res){
                            if (res.data.status==1)
                            {
                               _this.parent().html('<a href="/manage/private_message/detail/uid/'+_this.parent().attr('data-id')+'.html" class="ui-btn-small ui-btn-blue">发送私信</a>');
                            }
                            else
                            {
                              _this.html('已递送名片');
                              _this.css('cursor','default');
                              _this.unbind();
                              _this.attr('class','ui-btn-small ui-btn-gray');
                            }

                            
                      } )
                  });


                a.filter('[event="click.sendCompany"]').off('click').on('click',function(){
                  var _this   = $(this);
                    businesscard.sendCompany( _this.parent().attr('data-id'),function(res){
                        
                  } )
              });



             a.filter('[event="click.getcontact"]').off('click').on('click',function(){
                      var _this   = $(this);
                        businesscard.getcontact( _this.parent().attr('data-id'),function(res){

                             var $userinfo=res['data'];
                             var html='<div class="popup-msg-a">'+
                                '<p class="fn-font-14 ui-le-ht24"><span class="ui-text-gray">'+
                                  '查看过联系方式的会员保存在“商友与联系人”-“已查看联系方式”中'+
                                  '</span><br/><span class="part-popup-name">'+
                                  '<em>'+$userinfo["contact_name"]+'</em>'+$userinfo["contact_sex_name"]+'</span>';
                              
                            
                              html+=$userinfo["company"];
                              if($userinfo.contact_job_name)
                              {
                                  html+='<span class="ui-text-gray">['+$userinfo.contact_job_name+']</span>';
                              }
                              if($userinfo["company"] || $userinfo.contact_job_name)
                              {
                                html+='<br/>';
                              }

                              html+='手机：'+$userinfo.mobile+'<br/>';

                              if($userinfo.phone)
                              {
                                html+='电话：'+$userinfo.phone+'<br/>';
                              }
                              
                              if($userinfo.email)
                              {
                                html+='邮箱：'+$userinfo.email;
                              }   
                              
                              html+='</p>';
                              html+='<footer class="fn-mt-30 fn-tac"><a href="javascript:;" id="J_dialog_close" class="ui-btn ui-btn-red">确定</a></footer></div>'; 

                             window.contact_dl=dialog.dialog({title:'查看联系方式',content:html});
                              $('#J_dialog_close').click(function(){
                                    try
                                    {
                                       window.contact_dl.close().remove();
                                    }
                                    catch(e)
                                    {

                                    }
                              });
                              _this.html('已查看联系方式');
                        },view_num);
                  });

            var a= $('.table-part-all a');
              a.filter('[event="click.sendZjxm"]').off('click').on('click',function(){
                  var _this   = $(this);
                    businesscard.sendZjxm( _this.parent().attr('data-id'),function(res){
                        
                  } )
              });
          };

          exports.init_for_toobar=function()
          {
            var businesscard=require('page/member/businesscard');
              var a = $('#toolbar a');
              
              a.filter('[event="click.exchange"]').off('click').on('click',function(){
                   var _this   = $(this);
                    businesscard.exchange( _this.parent().attr('data-id'),function(res){
                        if (res.data.status==1)
                        {
                           _this.parent().html('<a href="/manage/private_message/detail/uid/'+_this.parent().attr('data-id')+'.html" class="swapBtn">发送私信</a>');
                        }
                        
                  } )
                });
          }

          exports.init();
    }); 
