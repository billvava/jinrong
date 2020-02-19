$(function(){
	var je=setInterval(upanddowm,3000);
	var i=1;
	$(".cardBox").each(function(){
        $(this).addClass("menjs"+i);
		moveImg('menjs'+i,1,5);
		i=i+1;
    });
	keybanner();
	var e;
	var k;
	var kk;
});

function upanddowm(){
	if(parseInt($(".numHot ul").css("top"))>-222){
		$(".numHot ul").animate({ top : '-='+74}, 800);
	}else{
		$(".numHot ul").animate({ top : 0}, 800);
	}
}

function moveImg(menjs,pageo,io){
		var leno = $("."+menjs).find('li').length;
		var page_counto = Math.ceil(leno / io) ;   //只要不是整数，就往大的方向取最小的整数
		var none_unit_widtho = $("."+menjs).find("div:eq(0)").width(); //获取框架内容的宽度,不带单位
		var $parento = $("."+menjs).find("div:eq(0)").find('ul:eq(0)');

			//向右 按钮
		$("."+menjs).find("a:eq(1)").click(function(){
				if( !$parento.is(":animated") ){
					if( pageo == page_counto ){  //已经到最后一个版面了,如果再向后，必须跳转到第一个版面。
						$parento.animate({ left : 0}, 800); //通过改变left值，跳转到第一个版面
						pageo = 1;
					}else{
						$parento.animate({ left : '-='+none_unit_widtho}, 800);  //通过改变left值，达到每次换一个版面
						pageo++;
					}
				}
		   });

				//往左 按钮
			$("."+menjs).find("a:eq(0)").click(function(){
				if( !$parento.is(":animated") ){
					if( pageo == 1 ){  //已经到第一个版面了,如果再向前，必须跳转到最后一个版面。
						$parento.animate({ left : '-='+none_unit_widtho*(page_counto-1)}, 800); //通过改变left值，跳转到最后一个版面
						pageo = page_counto;
					}else{
						$parento.animate({ left : '+='+none_unit_widtho }, 800);  //通过改变left值，达到每次换一个版面
						pageo--;
					}
				}
			});
	}

	function banner(i){
		$(".jsimg li").eq(i).fadeIn(300).siblings().hide();
		$(".jsnum li").eq(i).addClass("on").siblings().removeClass("on");
	}

	function keybanner(){
		if($(".jsimg li").length>=2){
			$(".jsimg li").eq(0).show().siblings().hide();
			$(".login_box_wrapper").append('<span class="nextBtn"></span><span class="prevBtn"></span>');
			$(".nextBtn,.prevBtn").hide();
			$(".Outbox").hover(function(){$(".nextBtn,.prevBtn").show();},function(){$(".nextBtn,.prevBtn").hide();});
			var j;
			e=1;
			$(".nextBtn").click(function(){
				if(e>=$(".jsimg li").length){
				    e=1;
				}else{
					e=e+1;
				}
				banner(e-1);
			});
			$(".prevBtn").click(function(){
				if(e<=1){
				    e=$(".jsimg li").length;
				}else{
					e=e-1;
				}
				banner(e-1);
			});
		    for(j=1;j<=$(".jsimg li").length;j++){
				if(j==1){
					$(".jsnum").append("<li class='on'></li>")
			    }else{
					$(".jsnum").append("<li></li>")
				}
			}
			$(".jsnum li").click(function(){
				k=$(this).index();
				e=k+1;
				banner(k);
			});
		}
		kk=setInterval(jinger,3000);
		$(".jsnum li,.nextBtn,.prevBtn").mouseover(function(){
			clearInterval(kk);
		});
		$(".jsnum li,.nextBtn,.prevBtn").mouseout(function(){
			kk=setInterval(jinger,3000);
		});
	}

	function jinger(){
		if(e>=$(".jsimg li").length){
			e=1;
		}else{
			e=e+1;
		}
		banner(e-1);
	}