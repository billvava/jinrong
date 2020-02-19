define(function(require,exports,module){
        var $ = require('jquery');
        var Trjcn = new Object();
        var isExec=0;
        Trjcn.ui=require('page/member/ui');
        function U(url)
        {
            return '/'+url;
        }
        
        Trjcn.Ajax={}

        Trjcn.Ajax.post=function(url,data,success,error)
        {
            exports.post(url,data,success,error);
        }

       exports.post=function(url,data,success,error)
       {
            $.ajax({url:url,data:data,success:success,error:error,dataType:"json",type:"post"});
       }

       exports.unfollow=function(uid, callback){

         Trjcn.Ajax.post(U('service/businesscard.unfollow'),'uid='+uid,function(res){
            if (res.code==200)
            {
                if ( typeof callback == 'function' )
                {   
                    callback(res);
                }
                Trjcn.ui.success('关注取消成功');

            }else
            {
                Trjcn.ui.alert(res.data.message || '关注取消失败，请重试');
            }
        });
     }

        exports.exchange=function(uid, callback){
            if(isExec)
            {
                return;
            }
            isExec=1;
            Trjcn.Ajax.post(U('service/businesscard/exchange'),'uid='+uid,function(res){
                isExec=0;
                if (res.code==200)
                {
                    if ( typeof callback == 'function' )
                    {
                       if (res.data.message)Trjcn.ui.alert(res.data.message);
                       callback(res);return;
                    }
                    Trjcn.ui.success('交换名片申请成功');
                }
                else if(res.code==500)
                {
                    var dl = require('module/common/login');
                    dl.dialog();
                }
                else{
                    if(res.code == -2){
                        Trjcn.ui.alert(res.data.error_message||res.data.message);
                        //Trjcn.Auth.sendBox(2,'交换名片');
                    }else{
                        Trjcn.ui.alert(res.data.error_message ||res.data.message|| '交换失败，请重试');
                   }
                }
            },function(){
                isExec=0;
                Trjcn.ui.error('系统错误');
            });
        }


        exports.getcontact=function(uid, callback,view_num){

        /*
         if(!view_num)
         {
            Trjcn.ui.confirm('升级成为VIP会员即可查看对方联系方式。',function(){window.location.href='/service.html';});
            return;
         }
        */
        if(isExec)
        {
            return;
        }
        isExec=1;
         Trjcn.Ajax.post(U('service/businesscard/getcontact'), 'uid='+uid,function(res){
              isExec=0;
              var host='http://www'+window.location.host.substring(location.host.indexOf('.'),location.host.length);
                if (res.code == 200)
                {
                        if ( typeof callback == 'function' )
                        {
                           callback(res);return;
                        }
                }
                else if(res.code==500)
                {
                    var dl = require('module/common/login');
                    dl.dialog();
                }
                else if(res.code==201)
                {
                    Trjcn.ui.confirm(res.error,"了解VIP会员",function(){window.location.href=host+'/service_B_RONGZI.html';});
                }
                else if(res.code==202)
                {
                    Trjcn.ui.confirm(res.error,"了解VIP会员",function(){window.location.href=host+'/service_B_TOUZI.html';});
                }
                else
                {
                    Trjcn.ui.alert(res.data.error_message||res.error);
                }
            },function(){
                isExec=0;
                Trjcn.ui.error('系统错误');
            });
        }

        exports.getzjxmcontact=function(uid, callback,view_num){
        if(isExec)
        {
            return;
        }
        isExec=1;
         Trjcn.Ajax.post(U('service/businesscard/getzjxmcontact'), 'zjxmid='+uid,function(res){
              isExec=0;
              var host='http://www'+window.location.host.substring(location.host.indexOf('.'),location.host.length);
                if (res.code == 200)
                {
                        if ( typeof callback == 'function' )
                        {
                           callback(res);return;
                        }
                }
                else if(res.code==500)
                {
                    var dl = require('module/common/login');
                    dl.dialog();
                }
                else if(res.code==201)
                {
                    Trjcn.ui.confirm(res.error,"了解VIP会员",function(){window.location.href=host+'/service_B_RONGZI.html';});
                }
                else if(res.code==202)
                {
                    Trjcn.ui.confirm(res.error,"申请实地认证",function(){window.location.href=host+'/zt/certification.html';});
                }
                else
                {
                    Trjcn.ui.alert(res.data.error_message||res.error);
                }
            },function(){
                isExec=0;
                Trjcn.ui.error('系统错误');
            });
        }

        exports.sendCompany=function(toid,fun)
        {
            Trjcn.ui.loading();
            Trjcn.Ajax.post('/service/deliveryCompany/fbox_for_manage', 'company='+ toid+'&type=1',function (res) {
                if (res.code ==200)
                {
                    Trjcn.ui.sendCompany(res.data);
                    fun();
                }else
                {
                    Trjcn.ui.alert(res.data);
                }
                if (res.code==500)Trjcn.ui.alert('您的登录已失效，请刷新重新登录');
            });
        }

        exports.sendZjxm=function(toid,fun)
        {
            Trjcn.Ajax.post('/service/deliveryZjxm/fbox_for_manage', 'zjxm='+ toid+'&type=1',function (res) {
                if (res.code ==200)
                {
                    Trjcn.ui.sendCompany(res.data);
                    fun();
                }else
                {
                    Trjcn.ui.alert(res.data);
                }
                if (res.code==500)Trjcn.ui.alert('您的登录已失效，请刷新重新登录');
            });
        }


        /**
         * 发送私信
         * message_to 接收用户名
         * message_content 发送内容
         * callback 回调函数
         */
        exports.sendMessage = function(message_to, message_content, callback){
            if(message_to == "") {
                Trjcn.ui.alert("收信人不能为空");
                return false;
            }
            if(message_content == "") {
                Trjcn.ui.alert("内容不可为空");
                return false;
            }
            if(isExec)
            {
                return;
            }
            isExec=1;
            Trjcn.Ajax.post(U('msg/save'),{uid:message_to,fid:0,f_type:0,type:2,msg:message_content},function(res){
                isExec=0;
                if (res.code==0)
                {
                    if ( typeof callback == 'function' )
                    {
                        callback(res);return;
                    }
                    Trjcn.ui.success('发送成功');
                }else
                {
                        Trjcn.ui.alert(res.msg);

                }
            },function(){
                isExec=0;
                Trjcn.ui.error('发送失败');
            });

        }

        /**
         * 删除我的私信对话
         * id 单条对话编号
         * callback 回调函数
         */
         exports.delMsg = function(id, callback){
            if(id == "") {
                Trjcn.ui.alert("请选择要删除的对话！");
                return false;
            }
            if ( ! Trjcn.Core.isLogin() )return;

            Trjcn.ui.confirm('确定要删除该条私信吗？', function () {
                 Trjcn.Ajax.post(U('service/message.delmsg'),{id:id},function(res){
                    if (res.code==200)
                    {
                        if ( typeof callback == 'function' )
                        {
                            callback(res);return;
                        }
                        Trjcn.ui.success('删除成功');
                    }else
                    {
                        Trjcn.ui.alert('删除失败');
                    }
                },function(){
                    Trjcn.ui.error('删除失败');
                });
           });



        }

        /**
         * 删除我的私信对话列表
         * list_id  对话列表编号
         * callback 回调函数
         */
         exports.delList = function(list_id, callback){
            if(list_id == "") {
                Trjcn.ui.alert("请选择要删除的私信！");
                return false;
            }
            if ( ! Trjcn.Core.isLogin() )return;
            Trjcn.ui.confirm('确定要删除该条私信吗？', function () {
                 Trjcn.Ajax.post(U('service/message.dellist'),{list_id:list_id},function(res){
                    if (res.code==200)
                    {
                        if ( typeof callback == 'function' )
                        {
                            callback(res);return;
                        }
                        Trjcn.ui.success('删除成功');
                    }else
                    {
                        Trjcn.ui.alert('删除失败');
                    }
                },function(){
                    Trjcn.ui.error('删除失败');
                });
           });



        }

});