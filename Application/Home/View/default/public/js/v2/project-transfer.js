;(function () {
    // 项目转让
    $(function () {
        // 点击更多
        $('.project-transfer .div1 .li3').click(function () {
            if($(this).text() == '更多'){
                $(this).text('收起').css('background-image', 'url("../img/icon/icon59.png")')
                    .parent('ul').css('height','auto');
            } else {
                $(this).text('更多').css('background-image', 'url("../img/icon/icon58.png")')
                    .parent('ul').css('height','30px');
            }
        });

        // 点击选项
        $('.project-transfer .div1 a').click(function () {
            $(this).addClass('select').siblings('a').removeClass('select');
            //return false;
        });

        // 点击选项卡
        $('.project-transfer .div2 span').click(function () {
            $(this).addClass('select').siblings('span').removeClass('select');
        });

        // 为li添加边距
        $('.project-transfer .ul1 li:not(:nth-child(4n))').css('margin-right', '20px');


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
            arr[0] = getPage(page, 'project-transfer-select');
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
                arr.unshift(getPage('', 'project-transfer-back'));
            }

            if (page + 3 < total) {
                arr.push(getPage('...'));
            }
            if (page < total) {
                arr.push(getPage(total));
                arr.push(getPage('', 'project-transfer-forward'));
            }
            // return arr;
            // console.log(arr);

            // 获取需要添加页数的节点
            var $div7 = $('.project-transfer .div7');
            // 删除节点
            $div7.html('')
            // 添加节点
            for (var i = 0; i < arr.length; i++) {
                $div7.append(arr[i]);
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
        $('.project-transfer .div7').on('click', 'a', function () {
            var $self = $(this);
            // 点击的是数字则跳转
            if ($self.text() == "") {
                // 判断点击的是向前按钮还是后退按钮
                if ($self.hasClass('project-transfer-back')) {
                    // 上一页
                    // 获取当前页
                    var $current_page = $('.project-transfer .project-transfer-select').text();
                    if ($current_page > 1) {
                        showPages(parseInt($current_page) - 1, total);
                    }
                } else {
                    // 下一页
                    var $current_page = $('.project-transfer .project-transfer-select').text();
                    if ($current_page < total) {
                        showPages(parseInt($current_page) + 1, total);
                    }
                }
            } else if (!isNaN($self.text())) {
                showPages(parseInt($self.text()), total);
            }
        });

        // 点击GO跳转页面f
        $('.project-transfer .div6').on('click', 'a', function () {
            // 获取输入的页数
            $go = $('.project-transfer .div6 input').val();
            // 跳转
            if ($go > 0 && $go <= total) {
                showPages(parseInt($go), total);
            }
        });
    });
})();