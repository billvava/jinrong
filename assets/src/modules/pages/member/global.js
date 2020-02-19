/**
 * 会员中心 公共模块
 */
define(function(require){
    var $=jQuery=require('jquery');
    var dialog=require('component/dialog/dialog');
    var slide=require('component/SuperSlide/SuperSlide');
    var business_card=require('page/member/manage_businesscard');//监听交换名片
    var popover_d = null;//鼠标放在内容上，提示内容
    var isIE6 = !!window.ActiveXObject && !window.XMLHttpRequest;
    var app={
        reqTimer:null,
        last_id:null,
        config:null,
        initialize:function(config){
            this.config=config||{times:5000};
            // 公共组件hover
            $.fn.hoverClass = function (b) {
                var a = this;
                a.each(function (c) {
                    a.eq(c).hover(function () {
                        $(this).addClass(b)
                    }, function () {
                        $(this).removeClass(b)
                    })
                });
                return a
            };
            // 公用选项卡
            $.fn.Tabs = function (options) {
                return this.each(function () {
                    // 处理参数
                    options = $.extend({
                        event: 'mouseover',
                        timeout: 0,
                        auto: 0,
                        callback: null,
                        switchBtn: false
                    }, options);

                    var self = $(this),
                        tabBox = self.children('.ui-tab-cont').children('div'),
                        menu = self.children('.ui-tab-head'),
                        items = menu.find('li'),
                        timer;

                    var tabHandle = function (elem) {
                            elem.siblings('li')
                                .removeClass('ui-tab-head-current')
                                .end()
                                .addClass('ui-tab-head-current');

                            tabBox.siblings('div')
                                .addClass('fn-hide')
                                .end()
                                .eq(elem.index())
                                .removeClass('fn-hide');
                        },

                        delay = function (elem, time) {
                            time ? setTimeout(function () {
                                tabHandle(elem);
                            }, time) : tabHandle(elem);
                        },

                        start = function () {
                            if (!options.auto) return;
                            timer = setInterval(autoRun, options.auto);
                        },

                        autoRun = function (isPrev) {
                            var current = menu.find('li.ui-tab-head-current'),
                                firstItem = items.eq(0),
                                lastItem = items.eq(items.length - 1),
                                len = items.length,
                                index = current.index(),
                                item, i;

                            if (isPrev) {
                                index -= 1;
                                item = index === -1 ? lastItem : current.prev('li');
                            }
                            else {
                                index += 1;
                                item = index === len ? firstItem : current.next('li');
                            }

                            i = index === len ? 0 : index;

                            current.removeClass('ui-tab-head-current');
                            item.addClass('ui-tab-head-current');

                            tabBox.siblings('div')
                                .addClass('fn-hide')
                                .end()
                                .eq(i)
                                .removeClass('fn-hide');
                            if (options.callback) {
                                options.callback.call(self);
                            }
                        };

                    items.bind(options.event, function () {
                        delay($(this), options.timeout);
                        if (options.callback) {
                            options.callback.call(self);
                        }
                    });

                    if (options.auto) {
                        start();
                        self.hover(function () {
                            clearInterval(timer);
                            timer = undefined;
                        }, function () {
                            start();
                        });
                    }

                    if (options.switchBtn) {
                        self.append('<a href="#prev" class="tab-prev">previous</a><a href="#next" class="tab-next">next</a>');
                        var prevBtn = $('.tab-prev', self),
                            nextBtn = $('.tab-next', self);

                        prevBtn.click(function (e) {
                            autoRun(true);
                            e.preventDefault();
                        });

                        nextBtn.click(function (e) {
                            autoRun();
                            e.preventDefault();
                        });
                    }

                });
            };
            //Tab切换(TODO:是否和Tabs合并？)
            $.jqTab = function(tabtit,tab_conbox,event,li,cur,type,first) {
                if( li==undefined || li==""){
                    li="li:not('.part-li-not')" ;
                }
                if( event==undefined || event==""){
                    event="click";
                }
                if( cur==undefined || cur==""){
                    cur="current";
                }
                $(tabtit).find(li).on(event,function(){
                    if(type ==1){
                        $(this).find("input").attr("checked","checked").siblings().attr("checked","");
                    }else{
                        $(this).addClass(cur).siblings(li).removeClass(cur);
                    }
                    var activeindex = $(this).parents(tabtit).find(li).index(this);
                    $(this).parents(tabtit).siblings(tab_conbox).children().eq(activeindex).show().siblings().hide();
                    if(type!=1){
                        return false;
                    }
                });
            };
        },
        listenFriends:function(page){
            if(!page){
                page=1;
            }
            var thatApp=this;
            $.ajax({
                url:'/service/businesscard/friends',
                data:'a=a&page='+page,
                type:'POST',
                dataType:'JSON',
                success:function(res){
                    if (res.code!=0||res.msg=='none') {
                        return;
                    }
                    if(res.data.html){
                        $('.friend-list').html(res.data.html);
                    }
                    if(!($('.toolbar-info .toolbar-info-nav').hasClass("cur"))){
                        $('.toolbar-info').children().eq(1).find(".toolbar-info-nav").siblings(".toolbar-info-part").slideDown().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").show();
                        $(this).parents(".toolbar-info-show").siblings(".toolbar-info-show").children(".toolbar-info-nav").removeClass("cur").siblings(".toolbar-info-part").slideUp().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").hide();
                    }
                    $('.friend-list .business_card_view').off('click');
                    $('.friend-list .business_card_view').on('click',function(){
                        var $this=$(this);
                        var page=$this.data('index');
                        app.listenFriends(page);
                    });
                    $('.friend-list .bottom_send_msg').off('click');
                    $('.friend-list .bottom_send_msg').on('click',function(){
                        var $this=$(this);
                        var url=$this.data('href');
                        $this.attr('href','/manage/private_message/detail/uid/'+url+'.html');
                        return true;
                    });
                }
            });

        },
        listenFollows:function(page){
            if(!page){
                page=1;
            }
            var thatApp=this;
            $.ajax({
                url:'/service/businesscard/follows',
                data:'a=a&page='+page,
                type:'POST',
                dataType:'JSON',
                success:function(res){
                    if (res.code!=0||res.msg=='none') {
                        return;
                    }
                    if(res.data.html){
                        $('.toolbar-info-part2 .follow-list').html(res.data.html);
                        business_card.init_for_toobar();
                    }
                    if(!($('.toolbar-info .toolbar-info-nav').hasClass("cur"))){
                        $('.toolbar-info').children().eq(1).find(".toolbar-info-nav").siblings(".toolbar-info-part").slideDown().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").show();
                        $(this).parents(".toolbar-info-show").siblings(".toolbar-info-show").children(".toolbar-info-nav").removeClass("cur").siblings(".toolbar-info-part").slideUp().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").hide();
                    }
                    $('.follow-list .business_card_view').off('click');
                    $('.follow-list .business_card_view').on('click',function(){
                        var $this=$(this);
                        var page=$this.data('index');
                        app.listenFollows(page);
                    });
                    $('.follow-list .bottom_send_msg').off('click');
                    $('.follow-list .bottom_send_msg').on('click',function(){
                        var $this=$(this);
                        var url=$this.data('href');
                        $this.attr('href','/manage/private_message/detail/uid/'+url+'.html');
                        return true;
                    });
                }
            });
        },
        listenNotice:function(){
            var thatApp=this;
            var times=this.config.times||10000;
            if(this.reqTimer) {
                return;
            }
            this.reqTimer=setTimeout(function(){
                $.ajax({
                    url:'/service/msg/notice.html',
                    data:'a=a&sys=1',
                    type:'POST',
                    dataType:'JSON',
                    success:function(res){
                        if (res.code!=0||res.msg=='none') {
                            return;
                        }
                        if(res.data.newest){
                            $('#toolbar-newest-information').html(res.data.newest);
                            business_card.init_for_toobar();
                        }
                        if(res.data.announcement){
                            $('#toolbar-site-information').html(res.data.announcement);
                        }
                        if(res.data.id){
                            app.last_id=res.data.id;
                        }
                        if(!($('.toolbar-info .toolbar-info-nav').hasClass("cur"))){
                            $('.toolbar-info').children().eq(1).find(".toolbar-info-nav").siblings(".toolbar-info-part").slideDown().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").show();
                            $(this).parents(".toolbar-info-show").siblings(".toolbar-info-show").children(".toolbar-info-nav").removeClass("cur").siblings(".toolbar-info-part").slideUp().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").hide();
                        }
                    }
                });
            },times);
        },
        run:function(){
            //公共导航点击效果
            $.jqTab(".j-tab-all-c",".j-tab-cont");
            $.jqTab(".j-tab-all-c-cur",".j-tab-cont","","","ui-tab-head-current");
            $.jqTab(".j-tab-all-c-1",".j-tab-cont","","","",1);
            $.jqTab(".j-tab-all-m",".j-tab-cont","mouseover");
            $.jqTab(".j-tab-all-m-1",".j-tab-cont","mouseover","","","",1);
            // 公共组件hover
            $.jqhover = function(tabtit) {
                $(tabtit).hover(function(){
                    $(this).addClass("cur")
                },function(){
                    $(this).removeClass("cur")
                });
            };
            $.jqhover('.j-hover-all');
			$.jqhover(".pop-secondary-nav label");
			//表单下拉
			$('.j-fieldset-select .t_input').bind('click', function () {
				if($(this).parent().addClass("cur")){
					return false;
				}
				$(this).parent().addClass("cur");
			});
			$(".j-fieldset-select a").bind('click', function () {
				 $(this).parents(".j-fieldset-select").removeClass("cur");
			});
            //鼠标放在内容上，提示内容
            $(".popover-part").hover(
                function(){
                    var id =$(this).attr("id");
                    var follow = document.getElementById(id);
                    var width_this=$(this).attr("width_this");
                    if(width_this==undefined){
                        width_this="132px";
                    }
                    popover_d = dialog({
                        align: 'bottom',
                        width: width_this,
                        padding:"10px",
                        content: $(this).attr("cont")
                    });
                    popover_d.show(follow);
                },
                function(){
                    popover_d.close().remove();
                }
            );
			//鼠标移上，断线隐藏
		    $(".sn-menu-item").off('mousemove').on('mousemove',function(){
				if($(this).children().hasClass("sn-dropdown"))
				{
				    $(this).prev(".sn-separator").css("border-color","#f1f1f1");
				    $(this).next(".sn-separator").css("border-color","#f1f1f1");
				}
			}).off('mouseleave').on('mouseleave',function(){
			    $(".sn-separator").css("border-color","#999999");
			});

            /*
            // 底部工具栏
            $(window).scroll(function () {
                var toolbar = $("#toolbar");
                var scrollTop = $(document).scrollTop();
                var fp = $('#footer').position().top;
                var wh = $(window).height();
                if (scrollTop + wh > fp) {
                    $(toolbar).css('position', 'static');
                } else {
                    $(toolbar).css('position', isIE6 ? 'absolute' : 'fixed');
                }
            });
            $('a.toolbar-info-nav').on('click',function(){
                $('body,html').animate({scrollTop:0},500);
            });
            // 公告滚动
            $("#notice-roll").slide({
                mainCell: "ul",
                autoPlay: true,
                effect: "topLoop"
            });
            // ie6 顶部导航下拉菜单
            $('.sn-dropdown').hoverClass('sn-dropdown-hover');
            $('.view-project-box').hoverClass('view-project-hover');
            $('.table-part-hover tbody tr').hoverClass('table-hover');
            $('.j-part-hover .news-info-item').hoverClass('j-hover');
            */
            // 信息动态选项卡
            $("#news-info-tab,#graph-tab,.toolbar-info-part").Tabs({timeout: 300});
            //底部 最新消息和人脉点击
            $('.toolbar-info-show').find(".toolbar-info-nav").on('click', function () {
                var $this=$(this),
                    $parent=$this.parent();
                if('friends'==$parent.data('type')){//点击人脉
                    thatApp.listenFriends();
                    thatApp.listenFollows();
                }
                if ($this.hasClass("cur")) {
                    return false;
                }
                $this.addClass("cur").siblings(".toolbar-info-part").slideDown().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").show();
                $this.parents(".toolbar-info-show").siblings(".toolbar-info-show").children(".toolbar-info-nav").removeClass("cur").siblings(".toolbar-info-part").slideUp().siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").hide();
            });
            var thatApp=this;
            $(".toolbar-info-part .close").on('click', function () {
                clearTimeout(thatApp.reqTimer);
                thatApp.reqTimer=null;
                var $info_part=$(this).parents(".toolbar-info-part");
                $info_part.slideUp().removeClass("cur").siblings(".icon-toolbar-arrow-a,.icon-toolbar-arrow-b").hide();
                $info_part.prev().removeClass('cur');
                thatApp.listenNotice();
            });
			//点击表格里的内容下一级内容显示出来
			$(".j-part-search-cont").on('click', function () {
				if($(this).hasClass("cur")){
                    $(this).removeClass("cur").parents("table").next('.part-search-cont-a-msg').toggle();
					 return false;
				}
				var html ='';
				    html +='<div class="part-search-cont-a-msg">'+
                           '<i class="search-msg-arrow-a"></i>'+
                           '<i class="search-msg-arrow-b"></i>'+
                           '<a href="javascript:" class="search-msg-close">×</a>'+
                           '<div class="ui-le-ht24 ui-text-gray-2">'+$(this).attr("cont")+'</div>'+
                           '</div>';
				$(this).addClass("cur").parents("table").after(html);
				$('.search-msg-close').click(function(){
					$(this).parent(".part-search-cont-a-msg").prev().find(".j-part-search-cont").removeClass("cur");
					$(this).parent(".part-search-cont-a-msg").remove();
				});
			});
			
			
        }
    };
    app.initialize({times:10000});
    app.run();
    app.listenNotice();
});