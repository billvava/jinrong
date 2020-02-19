$(function(){

	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

	$('.login').click(function(){
		//var url = $(this).data('url');
		var url="/member/account/login"
		layer.open({
			type: 2,
			title: '会员登录',
			//offset: ['200px'],
			area: ['500px', '350px'],
			fixed: true, //固定
			maxmin: false,
			resize:false,
			scrollbar: false,
			content:url
		});


	});

	$('.register').click(function(){
		parent.layer.closeAll();
		//var url = $(this).data('url');
		var url="/member/account/register"
		parent.layer.open({
			type: 2,
			title: '会员注册',
			shadeClose: true,
			//offset: ['200px'],
			fixed: true, //固定
			shade: 0.4,
			maxmin: false,
			resize:false,
			scrollbar: false,
			area: ['500px','506px'],
			content: url
		});

	});

	$('.zhaopass').click(function(){
		parent.layer.closeAll();
		var url = $(this).data('url');
		parent.layer.open({
			type: 2,
			title: '找回密码',
			shadeClose: true,
			//offset: ['200px'],
			fixed: true, //固定
			shade: 0.4,
			maxmin: false,
			scrollbar: false,
			resize:false,
			area: ['500px','600px'],
			content: url
		});

	});

	$('#kanship').click(function(){
		var url = $(this).data('url');
		layer.open({
			type: 2,
			title: false,
			area: ['710px', '480px'],
			shade: 0.8,
			shadeClose: true,
			content: url,
		});

	});

	$('#guanquanj').click(function() {
		var index = layer.open({
			type: 2,
			title: '全景',
			content: '../vtour/tour.html',
			area: ['320px', '195px'],
			maxmin: true
		});
		layer.full(index);
	});

//

});