;(function () {
    // 金融学院
    $(function () {
        // 点击上下按钮切换信息
        $('.qrcollege .roll').click(function () {
            var $self = $(this);
            var $ul = $self.parent('p').siblings('ul');
            // 获取当前ul scrollTop位置
            var scroll_top = $ul.scrollTop();
            // 判断点击的是向下滚动还是向上滚动
            if ($self.hasClass('float-l')) {
                // 往上
                if(parseInt(scroll_top) - 111 < 0){
                    $ul.stop(true,true).animate({scrollTop: '0px'}, 400);
                } else {
                    $ul.stop(true,true).animate({scrollTop: parseInt(scroll_top) - 111 + 'px'}, 400);
                }
            } else {
                // 往下
                $ul.stop(true,true).animate({scrollTop: parseInt(scroll_top) + 111 + 'px'}, 400);
            }
        });

        // 滑动切换图片
        $('.qrcollege .ul1>li').hover(function () {
            var $self = $(this);
            $self.find('.roll.float-l').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list57.png"}).end()
                .find('.roll.float-r').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list58.png"});
            if($self.children('.img1').length>0){
                $self.children('.img1').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list51.png"});
            } else if ($self.children('.img2').length>0) {
                $self.children('.img2').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list52.png"});
            } else if ($self.children('.img3').length>0){
                $self.children('.img3').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list53.png"});
            } else{
                $self.children('.img4').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list54.png"});
            }

        },function () {
            var $self = $(this);
            // 滑出
            $self.find('.roll.float-l').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list55.png"}).end()
                .find('.roll.float-r').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list56.png"});
            if($self.children('.img1').length>0){
                $self.children('.img1').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list47.png"});
            } else if ($self.children('.img2').length>0) {
                $self.children('.img2').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list48.png"});
            } else if ($self.children('.img3').length>0){
                $self.children('.img3').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list49.png"});
            } else{
                $self.children('.img4').attr({src: "/7ronghui/Application/Home/View/default/public/pc/img/picture/list50.png"});
            }
        });

        // 书签滑动效果
        $('.qrcollege li.switch1,.qrcollege li.switch2').mouseenter(function () {
            // 替换背景
            $(this).css('background-image','url("/7ronghui/Application/Home/View/default/public/pc/img/picture/list79.png")')
                .siblings('li').css('background-image','url("/7ronghui/Application/Home/View/default/public/pc/img/picture/list80.png")');
            // 替换内容
            if($(this).hasClass('switch1')){
                $('.qrcollege div.switch1').css('display','block')
                    .siblings('div').css('display','none');
            } else {
                $('.qrcollege div.switch2').css('display','block')
                    .siblings('div').css('display','none');
            }
        });

        // 书签滑动
        $('.qrcollege li.switch3,.qrcollege li.switch4,.qrcollege li.switch5').mouseenter(function () {
            // 替换背景
            $(this).css('background-image','url("/7ronghui/Application/Home/View/default/public/pc/img/picture/list81.png")')
                .siblings('li').css('background-image','url("/7ronghui/Application/Home/View/default/public/pc/img/picture/list82.png")');
            // 替换内容
            if($(this).hasClass('switch3')){
                $('.qrcollege div.switch3').css('display','block')
                    .siblings('div').css('display','none');
            } else if ($(this).hasClass('switch4')) {
                $('.qrcollege div.switch4').css('display','block')
                    .siblings('div').css('display','none');
            }else {
                $('.qrcollege div.switch5').css('display','block')
                    .siblings('div').css('display','none');
            }
        });

        // 书签滑动
        $('.qrcollege li.switch6,.qrcollege li.switch7').mouseenter(function () {
            // 替换背景
            $(this).css('background-image','url("/7ronghui/Application/Home/View/default/public/pc/img/picture/list87.png")')
                .siblings('li').css('background-image','url("/7ronghui/Application/Home/View/default/public/pc/img/picture/list88.png")');
            // 替换内容
            if($(this).hasClass('switch6')){
                $('.qrcollege div.switch6').css('display','block')
                    .siblings('div').css('display','none');
            }else {
                $('.qrcollege div.switch7').css('display','block')
                    .siblings('div').css('display','none');
            }
        });
    });
})();