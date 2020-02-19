;(function () {
    // 重点推荐
    $(function () {
        // 页数跳转
        // 总页数
        var total = 10;
        // 添加页数 默认执行一次 当前第一页 共10页
        showPages(1, total);

        // 分页 传入当前页面以及 总页
        function showPages(page, total) {
            // 转为数字 防止计算出错
            page = parseInt(page);
            total = parseInt(total);
            // 定义数组 用于接受需要添加的节点
            var arr = [];
            arr[0] = getPage(page, 'highly-recommended-select');
            // 拼接选择页数前后两页
            for (var i = 1; i <= 2; i++) {
                if (page - i > 1) {
                    arr.unshift(getPage(page - i));
                }
                if (page + i < total) {
                    arr.push(getPage(page + i));
                }
            }

            // 超过两页显示... 以及首页和尾页
            if (page - 3 > 1) {
                arr.unshift(getPage('...'));
            }

            if (page > 1) {
                arr.unshift(getPage(1));
                arr.unshift(getPage('', 'highly-recommended-back'));
            }

            if (page + 3 < total) {
                arr.push(getPage('...'));
            }
            if (page < total) {
                arr.push(getPage(total));
                arr.push(getPage('', 'highly-recommended-forward'));
            }
            // return arr;
            // console.log(arr);

            // 获取需要添加页数的节点
            var $div4 = $('.highly-recommended .div4');
            // 删除节点
            $div4.html('')
            // 添加节点
            for (var i = 0; i < arr.length; i++) {
                $div4.append(arr[i]);
            }
        }

        // 返回模板
        function getPage(page, class_name) {
            if (class_name) {
                return '<a class="' + class_name + '" href="#">' + page + '</a>';
            } else {
                return '<a href="#">' + page + '</a>';
            }
        }

        // 点击页数切换
        $('.highly-recommended .div4').on('click', 'a', function () {
            var $self = $(this);
            // 点击的是数字则跳转
            if ($self.text() == "") {
                // 判断点击的是向前按钮还是后退按钮
                if ($self.hasClass('highly-recommended-back')) {
                    // 上一页
                    // 获取当前页
                    var $current_page = $('.highly-recommended .highly-recommended-select').text();
                    if ($current_page > 1) {
                        showPages(parseInt($current_page) - 1, total);
                    }
                } else {
                    // 下一页
                    var $current_page = $('.highly-recommended .highly-recommended-select').text();
                    if ($current_page < total) {
                        showPages(parseInt($current_page) + 1, total);
                    }
                }
            } else if (!isNaN($self.text())) {
                showPages(parseInt($self.text()), total);
            }
        });

        // 点击GO跳转页面
        $('.highly-recommended .div3').on('click', 'a', function () {
            // 获取输入的页数
            $go = $('.highly-recommended .div3 input').val();
            // 跳转
            if ($go > 0 && $go <= total) {
                showPages(parseInt($go), total);
            }
        });

        // 定义日历配置
        var calendar_setup = {//添加日期选择功能
            numberOfMonths:1,//显示几个月
            dateFormat: 'yy-mm-dd',//日期格式
            clearText:"清除",//清除日期的按钮名称
            closeText:"关闭",//关闭选择框的按钮名称
            yearSuffix: '年', //年的后缀
            showMonthAfterYear:true,//是否把月放在年的后面
            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
            dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
            dayNamesMin: ['日','一','二','三','四','五','六'],
            onSelect: function(selectedDate) {//选择日期后执行的操作
               console.log(selectedDate);
            }
        };

        // 点击显示日历
        $('.highly-recommended .div6>div').click(function () {
            // event.stopPropagation();
            var $self = $(this);
            // 定义日历回调函数 将选择的日期显示在页面
            calendar_setup.onSelect = function (selectedDate) {
                console.log(selectedDate);
                // 将选择的日期显示在页面
                $self.children('span.appear').text(selectedDate).end()
                    // 隐藏日历
                    .children('.calendar').css('display','none');
            };
            if($self.children('.calendar').css('display') == 'none'){
                $self.children('.calendar').css('display','block').datepicker(calendar_setup);
            } else {
                // 事件冒泡 点击切换月份会关闭日历 所以注释
                // $self.children('.calendar').css('display','none');
            }
        });

        // 点击下拉框
        $('.highly-recommended .div7').click(function () {
            var $self = $(this);
            if($self.children('ul').css('display') == 'none'){
                $self.children('ul').css('display','block');
            } else {
                $self.children('ul').css('display','none');
            }
        }).on('click','li',function () {
            // 点击下拉框中的选项
            var $self = $(this);
            // 将点击内容显示在网页中
            $self.parent('ul').siblings('span').text($.trim($self.text()));
            console.log($self.parent('ul').css('display'));
        });
    });
})();

