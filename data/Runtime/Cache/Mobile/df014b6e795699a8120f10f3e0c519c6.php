<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name = "format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script src="../public/js/rem.js"></script>
<script src="../public/js/zepto.min.js"></script>
<script>
	var qscms = {
		base : "<?php echo C('SUBSITE_DOMAIN');?>",
		domain : "http://<?php echo ($_SERVER['HTTP_HOST']); ?>",
		root : "/index.php",
		companyRepeat:"<?php echo C('qscms_company_repeat');?>",
		is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
		subsite_level : "<?php echo C('SUBSITE_VAL.s_level');?>"
	};
	if (!!window.ActiveXObject || "ActiveXObject" in window) {
		window.location.href = '<?php echo U('Index/compatibility');?>';
	}
</script>
<link rel="stylesheet" href="../public/css/common.css">
<link rel="stylesheet" href="../public/css/members.css">
</head>
<body>
<div class="headernavfixed">
  <div class="headernav font18">
    <div class="title"><?php echo ((isset($page_seo["header_title"]) && ($page_seo["header_title"] !== ""))?($page_seo["header_title"]):"无标题"); ?><div class="return js-back for-event"></div>
    <div class="rbtn for-event"></div>
    </div>
  </div>
	<div class="qspageso link_gray6">
  <div class="topbg">
		 <input value="<?php echo ($_GET['k']); ?>" type="text" class="soimput" id="J_soinput" placeholder="请输入要搜索的关键词"/>
    	<div class="soselect qs-relative for-event">
		    <span class="for-type-txt"> <?php if($search_type == 'fund' or strtolower(CONTROLLER_NAME) == 'fund'): ?>找资金<?php else: ?>选项目<?php endif; ?></span>
		    <input type="hidden" class="for-type-code" id="search_type" name="search_type" value="<?php if(!empty($search_type)): echo ($search_type); else: if(strtolower(CONTROLLER_NAME) == 'fund'): ?>fund<?php else: ?>item<?php endif; endif; ?>">
	    </div>
	    <div class="so-close js-so-close"></div>
      <div class="rightbtn for-event cancel" id="J_submit">取消</div>
		  <!-- <div class="rightbtn-so for-event">搜索</div> -->
	  <div class="choose-s-type-group">
		  <div class="choose-s-type-cell qs-relative">
			  <div class="qs-center <?php if($search_type == 'fund'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list font14" data-code="fund" data-title="找资金">找资金</div></div>
			  <div class="qs-center <?php if($search_type == 'item'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list sl2 font14" data-code="item" data-title="选项目">选项目</div></div>
		  </div>
	  </div>
  </div>
  <div class="history"></div>
  
  <div class="clearkey  for-event" id="J_cleanhistory" style="display:none;">清空关键字</div>
  <div class="split-block"></div>
  <div class="sohot font12 link_gray6">
  <div class="hottitle font14 ">发现热搜</div>
 		<a href="" class="hotword substring for-event">股权融资</a>
    <a href="" class="hotword substring for-event">企业资金</a>
    <a href="" class="hotword substring for-event">金融投资</a>
    <a href="" class="hotword substring for-event">项目融资</a>
    <a href="" class="hotword substring for-event">资产交易</a>
    <a href="" class="hotword substring for-event">股权融资</a>
  <div class="clear"></div>
  <script src="../public/js/zepto.cookie.min.js"></script>
	  <script>
		  $('.js-so-close').on('click', function () {
			  $(this).closest('.topbg').find('.soimput').val('');
			  $('#J_submit').addClass('rightbtn');
			  $('#J_submit').removeClass('rightbtn-so');
			  $('#J_submit').addClass('cancel');
			  $('#J_submit').html('取消');
		  })
    if($('#J_soinput').val()){
      $('#J_submit').addClass('rightbtn-so');
      $('#J_submit').removeClass('rightbtn');
      $('#J_submit').removeClass('cancel');
      $('#J_submit').html('搜索');
    }
    get_history($('.history'));
    function get_history(d){
      var b = "", hlength = 0;
      var searchHistoryArr = new Array();
      if ($.fn.cookie("searchHistory")) {
        searchHistoryArr = $.fn.cookie("searchHistory").split(",");
      };
      if (searchHistoryArr.length == 0) {
        d.hide();
        return false
      }
      $.each(searchHistoryArr.reverse(), function(index, val) {
        hlength += 1;
        b += '<div class="record"><div class="keyimg history_go" data-self="'+val+'">'+val+'</div><div class="delimg close for-event"></div><div class="clear"></div></div>';
      });
      if (hlength > 0) {
        d.empty().html(b);
        $("#J_cleanhistory").show();
        $(".history_go").on("click", function() {
          searchGo($(this).data("self"));
        });
        $(".record .close").on("click", function() {
          var searchHistoryArr = $.fn.cookie("searchHistory").split(","),
            val = $(this).prev().data("self"),
            index = $.inArray(val,searchHistoryArr);
          if (index >= 0) {
            searchHistoryArr.splice(index,1);
          };
          $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
          $(this).parent().remove();
        });
      } else {
        d.empty();
        $("#J_cleanhistory").hide()
      }
    }
    function add_history(key){
      if (key.length > 0) {
        var searchHistoryArr = new Array();
        if ($.fn.cookie("searchHistory")) {
          searchHistoryArr = $.fn.cookie("searchHistory").split(",");
          var isOnly = true;
          $.each(searchHistoryArr, function(index, val) {
            if (val == key) {
              isOnly = false;
            };
          });
          if (isOnly) {
            if (searchHistoryArr.length >= 5) {
              searchHistoryArr.splice(0,1);
            }
            searchHistoryArr.push(key);
          };
        } else {
          searchHistoryArr.push(key);
        };
        $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
      }
    }
    function searchGo(key) {
      add_history(key);
      var search_type = $('#search_type').val();
      if(search_type=='item'){
        var url = qscms.root+"?m=Mobile&c=Item&a=item_list&k="+key;
      }else{
        var url = qscms.root+"?m=Mobile&c=Fund&a=fund_list&k="+key;
      }
      window.location.href=url;
    }
		  $('.topbg .soselect').on('click', function () {
			  $('.topbg').toggleClass('for-type');
		  })
		  $('.choose-s-type-cell .qs-center').on('click', function () {
			  var stypeCode = $(this).find('.choose-s-type-list').data('code');
		  	var stypeTitle = $(this).find('.choose-s-type-list').data('title');
			  $('.for-type-code').val(stypeCode);
		  	$('.for-type-txt').text(stypeTitle);
			  $('.topbg').toggleClass('for-type');
		  });
      $('#J_submit').on('click',function(){
        if($(this).hasClass('cancel')){
          searchGo('');
        }else{
          searchGo($('#J_soinput').val());
        }
      });
      $("#J_cleanhistory").on("click", function() {
        $(this).hide();
        $(".history").hide();
        $.fn.cookie('searchHistory', null,{ path: '/' });
      });
      $('#J_soinput').on('keyup',function(){
        if($(this).val()!=''){
          $('#J_submit').addClass('rightbtn-so');
          $('#J_submit').removeClass('rightbtn');
          $('#J_submit').removeClass('cancel');
          $('#J_submit').html('搜索');
        }else{
          $('#J_submit').addClass('rightbtn');
          $('#J_submit').removeClass('rightbtn-so');
          $('#J_submit').addClass('cancel');
          $('#J_submit').html('取消');
        }
      });
      $('.hotword').on('click',function(){
        add_history($(this).text());
        window.location.href=$(this).attr('href');
        return false;
      });
	  </script>
</div>
</div>
<!--未登录显示以下 -->
<?php if(!C('visitor')): ?><div class="t-mask"></div>
    <div class="topnavshow">
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Members/login');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">登录/注册</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("fund/fund_list");?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">找资金</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("item/item_list");?>'">
		  <div class="imgbox"><img src="../public/images/196.png" /></div>
		  <div class="tit">找项目</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("Huodong/huodong_list");?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">活动</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_newslist');?>'">
		  <div class="imgbox"><img src="../public/images/202.png" /></div>
		  <div class="tit">金融资讯</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>
<?php elseif(C('visitor.utype') == 1): ?>
	<div class="t-mask"></div>
    <div class="topnavshow">
	   
	  <div class="navlis">
	  	
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Members/login');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">登录/注册</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("fund/fund_list");?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">找资金</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("item/item_list");?>'">
		  <div class="imgbox"><img src="../public/images/196.png" /></div>
		  <div class="tit">找项目</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("Huodong/huodong_list");?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">活动</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_newslist');?>'">
		  <div class="imgbox"><img src="../public/images/202.png" /></div>
		  <div class="tit">金融资讯</div>
		</div>

		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	    <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>	
	

<?php else: ?>
<!--个人已登录显示 -->
	<div class="t-mask"></div>
   <div class="topnavshow">
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Members/login');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">登录/注册</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("fund/fund_list");?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">找资金</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("item/item_list");?>'">
		  <div class="imgbox"><img src="../public/images/196.png" /></div>
		  <div class="tit">找项目</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U("Huodong/huodong_list");?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">活动</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_newslist');?>'">
		  <div class="imgbox"><img src="../public/images/202.png" /></div>
		  <div class="tit">金融资讯</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	   <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div><?php endif; ?>
	<!--搜搜层 -->
</div>
<div class="qs-top-nav x2 list_height">
<div class="n-cell active">手机注册<div class="b-line"></div></div>
<div class="clear"></div>
</div>
<div class="split-block"></div>
<form id="registerForm" method="post">
<div class="loging-input-group">
<div class="group-list mobile">
<input id="mobile" name="mobile" type="text" class="l-input font14" placeholder="请输入手机号码" autocomplete="off">
<a href="javascript:;" id="getVerfyCode" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-border-gray font14">获取验证码</a>
</div>
<div class="group-list verfy">
<input id="mobile_vcode" name="mobile_vcode" type="text" class="l-input font14" placeholder="请输入手机验证码" autocomplete="off">
</div>
<div class="group-list pwd">
<input id="password" name="password" type="password" class="l-input font14" placeholder="请输入账户密码" autocomplete="off">
</div>
<div class="group-list pwd">
<input id="passwordVerify" name="passwordVerify" type="password" class="l-input font14" placeholder="请确认账户密码" autocomplete="off">
</div>
</div>
<div class="split-block"></div>
<div class="btn-spacing btn-spacing-nmb"><a id="btnRegPersonal" href="javascript:;" class="qs-btn qs-btn-blue font18">项目方注册</a></div>
<input type="hidden" name="reg_type" value="1" />
<input type="hidden" name="utype" value="2">
<input type="hidden" id="doType" value="1">
<div id="pop" style="display:none"></div>
</form>
<div class="r-link-box qs-center link_blue"><a href="<?php echo U('members/login');?>">已有账号，立即登录</a></div>
<div class="qsfooter link_gray6">
<div class="txt font10">©www.7ronghui.com&nbsp;&nbsp;&nbsp;&nbsp;电话：<?php echo C('qscms_bootom_tel');?> &nbsp;&nbsp;&nbsp;&nbsp;ICP：<?php echo C('qscms_icp');?></div>
</div>
<!--<div class="bottom-fixed" id="backtop">
	<a href="javascript:;" class="gotop"></a>
</div>-->
<script src="../public/js/fastclick.js"></script>
<script>
    window.addEventListener( "load", function() {
        FastClick.attach(document.body);
    }, false );
</script>
<script src="../public/js/qsToast.js"></script>
<script src="../public/js/QSpopout.js"></script>
<script src="../public/js/QSfilter.js"></script>
<script src="../public/js/zepto.hwSlider.js"></script>
<script src="../public/js/scrollTo.js"></script>
<script>
  $('a[href]').click(function(){
      var f = $(this).attr('href');
      var reg = /\#(\w+)/;
      if(reg.test(f)) return !1
  });
  $('.js-back').on('click', function () {
      history.back();
  });
  $('.rbtn').on('click', function() {
	  forCloseNav();
  })
  $('.t-mask').on('click', function () {
	  forCloseNav();
  })
  $('.h-navclose').on('click', function () {
	  forCloseNav();
  })
  function forCloseNav() {
	  if ($('.topnavshow').hasClass('qs-actionsheet-toggle')) {
		  $('.t-mask').hide();
		  $('.topnavshow').removeClass('qs-actionsheet-toggle');
	  } else {
		  $('.t-mask').show();
		  $('.topnavshow').addClass('qs-actionsheet-toggle');
	  }
  }
  /**
   * 监听鼠标
   */
  if ('ontouchstart' in window) {
      $.EVENT_START = 'touchstart';
      $.EVENT_END = 'touchend';
  } else {
      $.EVENT_START = 'mousedown';
      $.EVENT_END = 'mouseup';
  }
  $('.plist-txt, .qs-btn, .for-event').on($.EVENT_START, function() {
      $(this).addClass('eventactive');
  })
  $('.plist-txt, .qs-btn, .for-event').on($.EVENT_END, function() {
      $(this).removeClass('eventactive');
  })
  $('.logout').on('click', function () {
        var dialog = new QSpopout();
        dialog.setContent('确定退出吗？');
        forCloseNav();
        dialog.show();
        dialog.getPrimaryBtn().on('click', function () {
            window.location.href = "<?php echo U('Members/logout');?>";
        });
    });
	// 处理select
  $('select').on('change', function () {
	  $(this).prev().text($(this).find('option').not(function(){ return !this.selected }).text());
  })
  $('select').each(function () {
	  $(this).prev().text($(this).find('option').not(function(){ return !this.selected }).text());
  })
	// 底部导航栏
	$('.js-b-nav-bar').on('click', function () {
		$(this).closest('.bottom-nav-bar-group').find('.bottom-bar-more-group').fadeIn(200);
	})
  $('.js-b-nav-bar-active').on('click', function () {
	  $(this).closest('.bottom-nav-bar-group').find('.bottom-bar-more-group').fadeOut(200);
  })
  $("#hwslider-bottom").hwSlider({
	  autoPlay: false,
	  dotShow: true,
	  touch: true,
	  arrShow: false
  });

  /**
   * 返回顶部
   */
  var global = {
	  h:$(window).height(),
	  st: $(window).scrollTop(),
	  backTop:function(){
		  global.st > (global.h*0.5) ? $("#backtop").show() : $("#backtop").hide();
	  }
  }
  global.backTop();
  $(window).scroll(function(){
	  global.h = $(window).height();
	  global.st = $(window).scrollTop();
	  global.backTop();
  });
  $(window).resize(function(){
	  global.h = $(window).height();
	  global.st = $(window).scrollTop();
	  global.backTop();
  })
  $("#backtop").on('click', function () {
	  $("body").scrollTo({toT: 0});
  })
</script>
<script>
$('#getVerfyCode').on('click', function() {
sendVerfy();
});

/**
* 发送手机验证码
*/
function sendVerfy() {
var mobileValue = $.trim($('input[name=mobile]').val());
$.ajax({
url: "<?php echo U('Members/regSendSms');?>",
cache: false,
async: false,
type: 'post',
dataType: 'json',
data: { sms_type: 'reg', mobile: mobileValue },
success: function(result) {
$('#pop').hide();
qsToast({type:2,context: result.msg});
if (result.status) {
// 开始倒计时
var countdown = 180;
function settime() {
if (countdown == 0) {
$('#getVerfyCode').removeClass('qs-btn-border-disabled');
$('#getVerfyCode').text('获取验证码');
countdown = 180;
return;
} else {
$('#getVerfyCode').addClass('qs-btn-border-disabled');
$('#getVerfyCode').text('重新发送' + countdown + '秒');
countdown--;
}
setTimeout(function() {
settime()
},1000)
}
settime();
} else {
$('#pop').hide();
qsToast({type:2,context: result.msg});
}
}
});
}

/**
* ajax 提交注册信息
*/
function doAjax() {
var url = "<?php echo U('Members/register');?>";
$.ajax({
url: url,
type: 'POST',
dataType: 'json',
data: $('#registerForm').serialize(),
success: function (data) {
if(data.status==1){
    window.location.href = data.data.url;
}else{
qsToast({type:2,context: data.msg});
$('#pop').hide();
}
}
});
}

var regularMobile = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/;
/**
* 发送手机验证码
*/
$('#getVerfyCode').on('click', function() {
if ($(this).hasClass('qs-btn-border-disabled')) return false;
var mobileValue = $.trim($('input[name=mobile]').val());
if (mobileValue == '') {
qsToast({type:2,context: '请输入手机号码'});
return false;
}
if (mobileValue != "" && !regularMobile.test(mobileValue)) {
qsToast({type:2,context: '手机号码格式不正确'});
return false;
}
if(!remoteValid('mobile',mobileValue)){
qsToast({type:2,context: '该手机号已被注册'});
return false;
}
//$('#pop').show();
})

/**
* 注册验证
*/
$('#btnRegPersonal').on('click', function() {
var configVarifyReg = "<?php echo C('qscms_wap_captcha_config.varify_mobile');?>";// 后台是否开启注册验证
var mobileValue = $.trim($('input[name=mobile]').val());
var verifycodeValue = $.trim($('input[name=mobile_vcode]').val());
var passwordValue = $.trim($('input[name=password]').val());
if (mobileValue == '') {
qsToast({type:2,context: '请输入手机号码'});
return false;
}
if (mobileValue != "" && !regularMobile.test(mobileValue)) {
qsToast({type:2,context: '手机号码格式不正确'});
return false;
}
if(!remoteValid('mobile',mobileValue)){
qsToast({type:2,context: '该手机号已被注册'});
return false;
}
if (verifycodeValue == '') {
qsToast({type:2,context: '请输入手机验证码'});
return false;
}
if (passwordValue == '') {
qsToast({type:2,context: '请输入密码'});
return false;
}
if(!inputRegValiPassword(passwordValue)){
qsToast({type:2,context: '密码长度要求为6-16个字符'});
return false;
}
doAjax();
})

/**
* 验证用户名等是否重复
* @param validType 验证类型
* @param validValue 值
* @returns {boolean|*}
*/

function remoteValid(validType, validValue){
var result = false;
$.ajax({
url: "<?php echo U('Members/ajax_check');?>",
cache: false,
async: false,
type: 'post',
dataType: 'json',
data: { type: validType, param: validValue },
success: function(json) {
if (json && json.status) {
result = true;
} else {
result = false;
}
}
});
return result;
}

/**
* 验证密码长度
* @param value 密码
* @returns {boolean}
*/
function inputRegValiPassword(value){
achoice = true;
if(value.length>16 || value.length<6){
achoice = false;
}
return achoice;
}
</script>
</body>
</html>