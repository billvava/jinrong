require(['jquery','layer','validate'], function ($){

$(function() {

    //认证表单    //fuyu2017.6.5修改   不需要失去焦点验证了
    //  $('.form-s').validate();

    //
    //      var select =$(".form-s").find("select");
    //      var text = $(".form-s").find("input[type=text]");
    //      var password=$(".form-s").find("input[type=password]");
    //      var pass1=$('.password1 input[type=password]');
    //      var pass2=$('.password2 input[type=password]');
    //      var checkbox =$(".form-s").find("input[type=checkbox]");
    //      var button =$(".form-s").find("input[type=button]");
    //var msg1=$(".form-s").find("span.Jmsg").length;
    //      var a=0;
    //      var b=0;
    //下拉改变
    //  if(select.length){
    //          select.change(function() {
    //          Tongji();
    //      });
    //  }
    //勾选改变
    //   if(checkbox.length){
    //          checkbox.click(function() {
    //          Tongji();
    //      });
    //  }
    //   text.blur(function(){
    //      //console.log(msg1);
    //      //layer.msg(msg1);
    //      Tongji();
    //   });
    //   password.blur(function(){
    //      Tongji();
    //   });
    //土地面积改变
    //  $('.text input[type=text]').bind('input propertychange', function() { 
    //      
    //          Tongji();
    //      
    //  });  
    //手机发生改变的时候重新验证
    //  $('.phone input').bind('input propertychange', function() { 
    //      var phone=$(this).val().length;  
    //      if(phone>=11){
    //          var isphone=$('.phone').validate('submitValidate'); 
    //      }
    //      Tongji();
    //  });

    //自动完成
    //  $('select[name=catid]').change(function() {
    //      completeSelName($(this), 'catid_catname');
    //  });

    //密码验证

    //  password.bind('input propertychange', function() { 
    //      var pass=$(this).val().length;
    //      b=isFocus();
    //      if(pass>=6){
    //          var Passw=$('.password'+b).validate('submitValidate');
    //          if(Passw){
    //              if(pass1.length && pass2.length){
    //                  //console.log(进了)
    //                  if((pass1.val().length>=6)&&(pass2.val().length>=6)){
    //                      Jfocus();
    //                  }   
    //              }else{
    //                  return;
    //              }
    //          }else {
    //              $('.btn3').css('background-color', '#CCCCCC');
    //              $('button').attr('disabled', "true");
    //          }
    //      }else {
    //          $('.btn3').css('background-color', '#CCCCCC');
    //          $('button').attr('disabled', "true");
    //      }
    //      Tongji();   
});


function Jfocus() {
    b = isFocus();
    var msg = $("span.valid_message");
    if(b == 1 && (pass1.val().length == pass2.val().length)) {
        if(pass1.val() != pass2.val()) {
            msg.remove();
            $('.password1').removeClass('success tip error').addClass('error').after('<span class="valid_message">两次输入的密码不一致</span>');
            Tongji();
        }
    } else if(b == 1 && (pass1.val().length > pass2.val().length)) {
        msg.remove();
        $('.password1').removeClass('success tip error').addClass('error').after('<span class="valid_message">两次输入的密码不一致</span>');
        Tongji();

    } else if(b == 2 && (pass2.val().length == pass1.val().length)) {
        if(pass1.val() != pass2.val()) {
            msg.remove();
            $('.password2').removeClass('success tip error').addClass('error').after('<span class="valid_message">两次输入的密码不一致</span>');
            Tongji();
        }
    } else if(b == 2 && (pass2.val().length > pass1.val().length)) {
        msg.remove();
        $('.password2').removeClass('success tip error').addClass('error').after('<span class="valid_message">两次输入的密码不一致</span>');
        Tongji();
    }
}

function isFocus() {
    if(document.activeElement.id == 'Jpassword1') {
        a = 1;
        return a;
    }
    if(document.activeElement.id == 'Jpassword2') {
        a = 2;
        return a;
    }
}

//最后

//自动完成下拉框的值
function completeSelName(e, name) {
    var text = e.find('option:selected').text();
    $('input[name=' + name + ']').val(text);
}

//  统计没有通过验证的个数
//function Tongji() {
//     //console.log("jin");
//      var error =$(".form-s").find("div.error");
//      var num = 0;
//      var num1 = 0;
//      var num2 = 0;
//      var num3 = 0;
//      var num4 = 0;
//      var num5 = 0;
//      var num6 = 0;
//      for(var i = 0; i < text.length; i++) {
//          if(!$(text[i]).val()) {
//              num1++;
//          }
//      }
//      if(checkbox.length && (!checkbox.is(':checked'))){
//              num2++;
//      }
//      if(button.length){
//          num3=0;
//      }
//      for(var i = 0; i < select.length; i++) {
//          if($(select[i]).val() == "-1") {
//              num4++;
//          }
//      }
//      //console.log(error);
//      for(var i = 0; i < error.length; i++) {
//          if(error[i]) {
//              num5++;
//          }
//      }
//      for(var i = 0; i < password.length; i++){
//          if(!$(password[i]).val()) {
//              //console.log(password.length);
//              num6++;
//          }
//      }
//      num = num1 + num2 + num3+ num4 + num5+ num6;
//      //console.log('Tongji',num, num1, num2, num3, num4, num5,num6);
//      if(num <= 0) {
//
//          $('.btn3').css('background-color', '#fe9900');
//          $('button').removeAttr("disabled");
//
//      } else {
//          $('.btn3').css('background-color', '#CCCCCC');
//          $('button').attr('disabled', "true");
//      }
//
//  }
// 
//});


//登录    修改为点击登录时验证码
$('.form-login').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/member/account/login', $('#loginform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                //parent.layer.close(index);
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function login() {

}

//忘记密码
$('.form-forget').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/member/account/forgetpwd', $('#forgetpwdform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function forgetpwd() {
    //console.log($('#forgetpwdform').serialize());
    
}

//注册
$('.form-reg').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/member/account/register', $('#regform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function register() {

}

//村庄预约
$('.form-czyy').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/land/village/appointment', $('#appform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function village_appointment() {
     
}

//我是本村人
$('.form-bcr').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/land/village/memberApply', $('#appform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function village_member_apply() {

}

//需求预约
$('.form-demandapp').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/land/demand/appointment', $('#appform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function demand_appointment() {
    
}

//土地预约
$('.form-app').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/land/land/appointment', $('#appform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function land_appointment() {

}

//委托找地   
$('.form-wt').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/land/land/enlooking', $('#appform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

function land_enlooking() {

}

//委托卖地  之前是直接在onclic调用方法   现在修改为 提交表单时先验证 通过后提交数据
function land_enselling() {

}
//委托卖地
$('.form-s').on('submit', function(event) {
    event.preventDefault();
    if(!$(this).validate('submitValidate')) return;
    $.post('/land/land/enselling', $('#appform').serialize(), function(json) {
        layer.msg(json.msg);

        if(json.code == 1) {
            var index = parent.layer.getFrameIndex(window.name);
            setTimeout(function() {
                parent.location.reload();
            }, 4000);
        }
    }, 'json');

});

});