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
<link rel="stylesheet" href="../public/css/index.css">
</head>
<body>
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
<div class="indextop">
<div class="logo"><img src="../public/images/02.png"></div>
<div class="user"><a href="<?php echo U('Members/login');?>"><img src="../public/images/03.png"></a></div>
<div class="clear"></div>
<div class="index-slider">
<div id="hwslider-count" class="hwslider hwslider-count">
<ul class="count">
<li class="active">6万多投资人手持3万亿 正在这里寻找优秀项目</li>
<li>本网已帮助2万多家项目方成功融资</li>
</ul>
</div>
</div>
<div class="sbox font14 js-show-qspageso"><span>请输入您想搜索的内容</span>
<script>
// 显示搜索层
$('.js-show-qspageso').on('click', function(){
$('.qspageso').toggle();
});
</script>
</div>
</div>
<div class="index-slider">
<div id="hwslider" class="hwslider">
<ul>
<li>
<a href="<?php echo U('Fund/fund_list');?>"><dl class="l1"><dt class="zijin for-event"></dt><dd class="font12">找资金</dd></dl></a>
<a href="<?php echo U('Item/item_list');?>"><dl class="l1"><dt class="xiangmu for-event"></dt><dd class="font12">选项目</dd></dl></a>
<a href="<?php echo U('news/news_list',array('id'=>95));?>"><dl class="l1"><dt class="jihuashu for-event"></dt><dd class="font12">商业计划书</dd></dl></a>
<a href="<?php echo U('huodong/huodong_list');?>"><dl class="l1"><dt class="huodong"></dt><dd class="font12 for-event">活动</dd></dl></a>
<a href="<?php echo U('Case/index');?>"><dl class="l1"><dt class="anli for-event"></dt><dd class="font12">案例</dd></dl></a>
<a href="<?php echo U('News/news_list',array('id'=>11));?>"><dl class="l1"><dt class="baogao for-event"></dt><dd class="font12">融资报告</dd></dl></a>
<a href="<?php echo U('School/index');?>"><dl class="l1"><dt class="xueyuan for-event"></dt><dd class="font12">投资学院</dd></dl></a>
<a href="<?php echo U('Services/index');?>"><dl class="l1"><dt class="services"></dt><dd class="font12 for-event">投资服务</dd></dl></a>
<div class="clear"></div>
</li>
<?php if($apply['Jobfair'] || $apply['Mall']): ?><li>
<?php if(!empty($apply['Mall'])): ?><a href="<?php echo url_rewrite('QS_mall_index');?>"><dl class="l1"><dt class="shop"></dt><dd class="font12 for-event"><?php echo C('qscms_points_byname');?>商城</dd></dl></a><?php endif; ?>
<?php if(!empty($apply['Jobfair'])): ?><a href="<?php echo url_rewrite('QS_jobfairlist');?>"><dl class="l1"><dt class="zhaoph"></dt><dd class="font12 for-event">招聘会</dd></dl></a><?php endif; ?>
<div class="clear"></div>
</li><?php endif; ?>
</ul>
</div>
</div>
<div class="indexnotice">
<div class="leftimg"><img src="../public/images/11.png"></div>
<?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'10','分类'=>'1','排序'=>'addtime:desc','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>"首页"),$notice_list);?>
<ul class="txt ul-upscroll">
<?php if(is_array($notice_list['list'])): $i = 0; $__LIST__ = $notice_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notice): $mod = ($i % 2 );++$i;?><li class="" onClick="javascript:location.href='<?php echo ($notice["url"]); ?>'"><?php echo ($notice["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div class="clear"></div>
</div>

<div class="split-block"></div>
<div class="indexhot font12 link_gray6">
<div class="info_head">
<div class="hottitle font14 ">精选资金</div>
<div class="icon-more"><a href="<?php echo U('fund/fund_list');?>">更多</a></div>
</div>
<div class="clear"></div>
<ul>
<?php if(is_array($fund_list)): $i = 0; $__LIST__ = $fund_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="clearfix">
<span>[<?php echo ($info_type[$vo['info_type']]); ?>]</span>
<a href="<?php echo U('fund/fund_show',array('id'=>$vo['id']));?>" class="hotword substring for-event"><?php echo ($vo["title"]); ?></a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div class="clear"></div>
</div>
<div class="split-block"></div>

<div class="split-block"></div>
<div class="indexhot font12 link_gray6">
<div class="info_head">
<div class="yzxm font14 ">优质项目</div>
<div class="icon-more"><a href="<?php echo U('item/item_list');?>">更多</a></div>
</div>
<div class="clear"></div>
<ul>
<?php if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="clearfix">
<span>[<?php echo ($info_type[$vo['info_type']]); ?>]</span>
<a href="<?php echo U('item/item_show',array('id'=>$vo['id']));?>" class="hotword substring for-event"><?php echo ($vo["title"]); ?></a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div class="clear"></div>
</div>
<div class="split-block"></div>
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
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?8686bf66886b49f68f9f60c29f745fbd";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script src="../public/js/zepto.hwSlider.js"></script>
<script src="../public/js/fx.js"></script>
<script src="../public/js/touch-0.2.14.min.js"></script>
<script src="../public/js/zepto.textSlider.js"></script>
<script>
// 职位、简历数量动态效果
var jobCount = '<?php echo ($jobs_count); ?>';
var resumeCount = '<?php echo ($resume_count); ?>';
window.setTimeout(function() {
$('.jobs-roll-count').empty();
peopleRoll(jobCount, '.jobs-roll-count');
}, 300)
window.setTimeout(function() {
$('.resume-roll-count').empty();
peopleRoll(resumeCount, '.resume-roll-count');
}, 5600)
function peopleRoll(a, container) {
function b(a) {
for (var b = 0; b < a.length; b++) {
var e = a.charAt(b);
d.push(e)
}
c()
}
function c() {
var a = 0;
$(container).append("<span></span>");
var b = window.setInterval(function() {
$(container + " span").eq(e).text(a), a == d[e] && (window.clearInterval(b), e++, d[e] && c()), a++
}, 30)
}
var d = [],
e = 0,
f = a + "";
b(f)
}

// 职位简历数滚动
$('#hwslider-count').hwSlider({
autoPlay: true,
dotShow: false,
touch: false,
interval: 5000,
arrShow: false
});

// 滚动更多
$("#hwslider").hwSlider({
autoPlay: false,
dotShow: true,
touch: true,
arrShow: false
});

$(".ul-upscroll").textSlider({line:1,speed:500,timer:3000});
</script>
</body>
</html>