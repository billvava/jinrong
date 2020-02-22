<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>金融网</title>
<meta name="keywords" content="项目融资,融资,天使投资,投资,投资项目,投资公司,项目,股权融资,债权融资,投融资,融资平台,金融网"/>
<meta name="description"
          content="金融网（7ronghui.com）是中国最大的融资服务平台，拥有超百万的投融资机构、企业与个人用户入驻。金融网通过线上＋线下、标准化  ＋个性化的服务体系，为客户提供针对性的投融资信息对接和项目撮配服务，成功对接融资千余亿元。金融网凭借其强大、便捷的平台信息整合能力，大大提高企业投融资活动成功率，为中小微企业解决融资难问题。"/>
<link rel="stylesheet" href="../public/css/v2/font/iconfont.css">
<link rel="stylesheet" href="../public/css/v2/common.css"/>
<link rel="stylesheet/less" type="text/css" href="../public/css/v2/less/combination/item_list2.less"/>
<script src="../public/css/v2/less/less_all.js"></script>
</head>
<body>
<header id="header">
    <div class="top container-full">
        <div class="container">
            <p id="top-fast-login" class="<?php if($visitor['uid'] != ''): ?>display-none<?php endif; ?>">
                欢迎登录金融网！请
                <a href="<?php echo U('members/login');?>">登录</a> 或
                <a href="<?php echo U('members/register');?>">免费注册</a>
            </p>
            <p style="padding-left:20px;" class="<?php if($visitor['uid'] == ''): ?>display-none<?php endif; ?>">
                <a href="<?php echo U('members/index');?>">
                    <?php if(empty($visitor['realname'])): echo ($visitor['mobile']); ?>
                        <?php else: echo ($visitor['realname']); endif; ?>
                </a>，您好，欢迎光临金融网！
                <a href="<?php echo U('members/logout');?>">[退出]</a>
            </p>
            <div>
                <a href="/">
                    <i class="iconfont icon-home"></i>
                    网站首页
                </a>
                <span></span>
                <a href="/help/help_list/id/3">
                    <i class="iconfont icon-question-mark"></i>
                    新手指导
                </a>
                <span></span>
                <a href="<?php echo U('Home/Index/shortcut');?>">
                    <i class="iconfont icon-computer"></i>
                    保存到桌面
                </a>
                <span></span>
                <div class="qrh_mobile">
                    <i class="iconfont icon-mobile"></i>
                    手机金融网
                    <div>
                        <img src="../public/images/v2/picture/mobile-qrcode.png" alt="">
                        <p>扫描我，立刻打开触屏站</p>
                        <p>手机触屏站：</p>
                        <p>m.jinrong.xiaba666.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main container-full">
        <div class="container">
            <div class="logo clearfix">
                <a href="/">
                    <img src="../public/images/v2/picture/logo.png" alt="logo">
                </a>
                <div>
                    <a href="/members/register/utype/2">发布项目信息</a>
                    <a href="/members/register/utype/1">资本机构入驻</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <nav>
                <?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','数量'=>'9','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"项目融资  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
                <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><a class="<?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>" href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </nav>
        </div>
    </div>
</header>
<div class="container-full" id="nav">
    <div class="container clearfix">
        <div>
            <a <?php if($_GET['info_type']== '' || $_GET['info_type']== 1): ?>class="select"<?php endif; ?> href="<?php echo U('Item/item_list',array('info_type'=>1));?>">项目融资</a>
            <a <?php if($_GET['info_type']== 200): ?>class="select"<?php endif; ?> href="<?php echo U('Item/item_list',array('info_type'=>200));?>">资产交易</a>
            <a <?php if($_GET['info_type']== 700): ?>class="select"<?php endif; ?> href="<?php echo U('Item/item_list',array('info_type'=>700));?>">政府招商</a>
            <a <?php if($_GET['info_type']== 2005): ?>class="select"<?php endif; ?> href="<?php echo U('Item/item_list',array('info_type'=>2005));?>">投资理财</a>
        </div>
    </div>
</div>
<div class="item_list2 container-full">
    <div class="container">
        <div class="choose">
            <div class="result clearfix <?php if(select_condition()): else: ?>display-none<?php endif; ?>">
                <span>已选条件：</span>
                <p result="result">

                <?php if($_GET['industry_id']!= ''): ?><a choose="industry" href="javascript:;" onclick="window.location='<?php echo P(array('industry_id'=>''));?>';"><?php echo ($category['industry_id'][$_GET['industry_id']]); ?><i class="iconfont icon-error"></i></a><?php endif; ?>

                <?php if($_GET['province_id']!= ''): ?><a choose="region" href="javascript:;" onclick="window.location='<?php echo P(array('province_id'=>''));?>';"><?php echo ($category['province'][$_GET['province_id']]); ?><i class="iconfont icon-error"></i></a><?php endif; ?>

                <?php if($_GET['xmrz_type']!= ''): ?><a choose="financing-way" href="javascript:;" onclick="window.location='<?php echo P(array('xmrz_type'=>''));?>';"><?php echo ($category['xmrz_type'][$_GET['xmrz_type']]); ?><i class="iconfont icon-error"></i></a><?php endif; ?>

                <?php if($_GET['mo']!= ''): ?><a choose="financing-money" href="javascript:;" onclick="window.location='<?php echo P(array('mo'=>''));?>';"><?php echo ($category['range'][$_GET['mo']]); ?><i class="iconfont icon-error"></i></a><?php endif; ?>
                
                </p>
                <span class="J_clear">清除 <i class="iconfont icon-clear"></i></span>
            </div>
            <div class="industry">
                <span>所属行业：</span>
                <p choose="industry">
                    <a <?php if($_GET['industry_id']== ''): ?>class="select"<?php endif; ?> href="<?php echo P(array('industry_id'=>''));?>">不限</a>
                    <?php if(is_array($category['industry_id'])): $k = 0; $__LIST__ = $category['industry_id'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a <?php if($_GET['industry_id']== $key): ?>class="select"<?php endif; ?> href="<?php echo P(array('industry_id'=>$key));?>"><?php echo ($vo); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </p>

            </div>
            <div class="region">
                <span>所在地区：</span>
                <p choose="region">
                    <a <?php if($_GET['province_id']== ''): ?>class="select"<?php endif; ?> href="<?php echo P(array('province_id'=>''));?>">不限</a>
                    <?php if(is_array($category['province'])): $i = 0; $__LIST__ = $category['province'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($_GET['province_id']== $key): ?>class="select"<?php endif; ?> href="<?php echo P(array('province_id'=>$key));?>"><?php echo ($vo); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </p>
            </div>
            <div class="financing-way">
                <span>融资方式：</span>
                <p choose="financing-way">
                    <a <?php if($_GET['xmrz_type']== ''): ?>class="select"<?php endif; ?> href="<?php echo P(array('xmrz_type'=>''));?>">不限</a>
                    <?php if(is_array($category['xmrz_type'])): $k = 0; $__LIST__ = $category['xmrz_type'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a <?php if($_GET['xmrz_type']== $key): ?>class="select"<?php endif; ?> href="<?php echo P(array('xmrz_type'=>$key));?>"><?php echo ($vo); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </p>
            </div>
            <div class="financing-money">
                <span>融资金额：</span>
                <p choose="financing-money">
                    <a <?php if($_GET['mo']== ''): ?>class="select"<?php endif; ?> href="<?php echo P(array('mo'=>''));?>">不限</a>
                    <?php if(is_array($category['range'])): $i = 0; $__LIST__ = $category['range'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($_GET['mo']== $key): ?>class="select"<?php endif; ?> href="<?php echo P(array('mo'=>$key));?>"><?php echo ($vo); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </p>
            </div>
        </div>

        <div class="item_title clearfix">
            <div>
                <a class="<?php if($_GET['sort']== ''): ?>select<?php endif; ?>" href="<?php echo P(array('sort'=>''));?>">
                    综合排序
                    <i class="iconfont icon-pull-down2"></i>
                </a>
                <a class="<?php if($_GET['sort']== 'rtime'): ?>select<?php endif; ?>" href="<?php echo P(array('sort'=>'rtime'));?>">
                    更新时间
                    <i class="iconfont icon-shrink2"></i>
                </a>
                <div>
                    <form id="item_form" action="/Item/item_list">
                    <a href="javascript:;" class="item_search">
                        <i class="iconfont icon-search"></i>
                    </a>
                    <input type="text" name="k" class="placeholder" tip="请输入搜索内容" value='<?php if($_GET['k']!= ''): echo ($_GET['k']); else: ?>请输入搜索内容<?php endif; ?>'>
                    </form>
                </div>
            </div>
            <div>优质项目推荐</div>
        </div>

        <div class="item_main clearfix">
            <ul>
                <?php if(!empty($info_list)): if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <div class="motif clearfix">
                        <div>
                            <h3><a href="<?php echo U('Home/Item/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></h3>
                            <p>融资资金： <span><?php echo ($vo["amount_interval_min"]); echo ($vo["amount_interval_min_unit"]); if($vo["amount_interval_max"] != ''): ?>-<?php echo ($vo["amount_interval_max"]); echo ($vo["amount_interval_max_unit"]); endif; ?></span></p>
                        </div>
                        <div>
                        <!--
                            <h4>姚先生</h4>
                            <p>江苏省泰州市某行政事业机构</p>
                            -->
                        <h4>该信息已委托金融网代发布</h4>
                        </div>
                        <div>
                            <p><?php if(empty($vo['updatetime'])): echo ($vo["addtime"]); else: echo ($vo["updatetime"]); endif; ?></p>
                            <a href="javascript:;" class="onekey_pull_to_itemer">约谈项目方</a>
                        </div>
                    </div>
                    <div class="message">
                        <span><i class="iconfont icon-region"></i>所在地区：<?php echo ($vo["province_id"]); ?></span>
                        <span><i class="iconfont icon-Industry-owned"></i>所属行业：<?php echo ($vo["industry_id"]); ?></span>
                        <span><i class="iconfont icon-financing"></i>融资方式：<?php echo ($vo["xmrz_type"]); ?></span>
                        <span><i class="iconfont icon-Industry-owned"></i>开发商排名：<?php echo ($vo["developer_rank"]); ?></span>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <footer class="table-page-part table-page-part-a">
                    <p class="fn-left ui-le-ht26">
                        共有&nbsp;<span class="ui-text-orange">
                <?php echo ($count); ?></span>&nbsp;个符合要求的项目信息
                    </p>
                    <div class="page_wrap clearfix">
                        <?php echo ($page); ?>
                    </div>
                </footer>
            </ul>

            <ul>
                <?php if(is_array($recommend_item)): $k = 0; $__LIST__ = $recommend_item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
                    <a class="recommend" href="<?php echo U('Item/show',array('id'=>$vo['id']));?>" target="_blank">
                        <img src="<?php if(!empty($vo["top_img"])): echo attach($vo['top_img'],'images'); else: ?>../public/images/v2/picture/item_list_recommend1.png<?php endif; ?>" alt="<?php echo ($vo['title']); ?>" title="<?php echo ($vo['title']); ?>"/>
                        <span><?php echo ($vo["title"]); ?></span>
                        <span>
                            <span>所在地区：<?php echo ($category['province'][$vo['province_id']]); ?></span>
                            <span>所属行业：<?php echo ($category['industry_id'][$vo['industry_id']]); ?></span>
                        </span>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>

<footer class="container-full" id="footer2">
    <div class="container">
        <ul class="menu clearfix">
            <li>
                <h3>金融网</h3>
                <a href="<?php echo U('Index/about');?>">关于我们</a>
                <a href="<?php echo U('Explain/explain_show',array('id'=>8));?>">招贤纳士</a>
                <a href="<?php echo U('Explain/explain_show',array('id'=>7));?>">联系我们</a>
            </li>
            <li>
                <h3>新手指导</h3>
                <a href="#">免费注册生成名片</a>
                <a href="#">免费发布投融资信息</a>
                <a href="<?php echo U('Help/help_list',array('id'=>3));?>">常见问题解答</a>
            </li>
            <li>
                <h3>企业服务</h3>
                <a href="#">金融宝</a>
                <a href="#">委托刷新</a>
                <a href="#">投递项目</a>
            </li>
            <li>
                <h3>平台保障</h3>
                <a href="#">信息审核及关闭</a>
                <a href="#">会员认证</a>
                <a href="#">隐私保护</a>
                <a href="#">违规处罚</a>
            </li>
            <li>
                <h3>加盟合作</h3>
                <a href="<?php echo U('Lianmeng/locate');?>">金融网投资生态联盟</a>
                <a href="<?php echo U('Loan/apply_loan');?>">线下机构加盟合作</a>
            </li>
        </ul>
        <div class="friendly_link">
            <p>友链互换:<a href="<?php echo U('suggest/index');?>">交换友链</a></p>
        }
        </div>
        <div class="record clearfix">
            <div>
                <p>&copy; 2012-2017 7ronghui.com. All rights reserved 金融网</p>
                <p class="beian_number">网站备案 : <a href="http://www.miibeian.gov.cn"></a></p>
                <div class="clearfix">
<a href="http://bbs.7ronghui.com">官方论坛</a>
<a class="bottom_erweima" href="javascript:;">
<i class="iconfont icon-weixin"></i>
<div class="weixin" style="background-color:#fff">
<img src="../public/images/v2/weixin_erweima.jpg" width="120px" height="120px">
</div>
</a>

<a href="http://weibo.com/u/6212990189">
<i class="iconfont icon-weibo"></i>
</a>

<a href="https://jq.qq.com/?_wv=1027&k=4ANgZ8X">
    <i class="iconfont icon-qq"></i>
</a>

                </div>
            </div>
            <div>
                <div>
                    <p>微信 : 扫描二维码咨询在线客服</p>
                    <p>邮箱 : </p>
                    <p>400电话 : </p>
                    <p>时间 : 9:00-18:00</p>
                </div>
                <img src="../public/images/v2/picture/weixin_erweima.jpg" alt="微信关注">
            </div>
        </div>
    </div>

</footer>
<script src="../public/js/v2/lib/jquery-1.12.4.min.js"></script>
<script src="../public/js/jquery.modal.dialog.js"></script>
<script src="/static/js/plugin/require/2.2.0/require.min.js" data-main="/static/js/config.min"></script>
<script>
require(['common']);
</script>
<script>
    $(function () {
    $('.onekey_pull').click(function(){
        var qsDialog = $(this).dialog({
        title: '请登录',
        loading: true,
        showFooter: false,
        yes: function() {
        }
    });

    $.getJSON("/index.php?m=&c=AjaxPersonal&a=arrange_itemer",function(result){
    if(result.status == 1){
        qsDialog.setContent(result.data);
    //qsDialog.showFooter(true);
    }else{
    qsDialog.setContent('<div class="confirm">' + result.msg + '</div>');
    }
    });
    });


        (function () {
            // 添加更多按钮
            // 获得需要添加的数组
            var $div = $('.choose>div:not(.result)');
            for(var i = 0; i<$div.length;i++){
                var current_height = $div.eq(i).children('p').height();
                var auto_height = $div.eq(i).children('p').css('height', 'auto').height();
                $div.eq(i).children('p').height(current_height+'px');
                if(auto_height>current_height){
                    $div.eq(i).append('<span class="J_more">更多 <i class="iconfont icon-pull-down"></i></span>')
                }
            }
        })();

        // 点击更多
        $('.J_more').click(function () {
            // 获得需要动画的盒子原始高度和最终高度
            var $p = $(this).prev('p');
            var auto_height = $p.css('height', 'auto').height();
            if ($(this).text() == '更多 ') {
                $(this).text('收起 ').append('<i class="iconfont icon-shrink"></i>');
                // 显示全部
                $p.height('40px').animate({height: auto_height}, 300);
                // 将别的数据收起
                $('.J_more').not($(this))
                        .text('更多 ').append('<i class="iconfont icon-pull-down"></i>')
                        .prev('p').animate({height: '40px'}, 300);
            } else {
                $(this).text('更多 ').append('<i class="iconfont icon-pull-down"></i>');
                // 显示全部
                $p.height(auto_height).animate({height: '40px'}, 300);
            }
        });

        // 点击过滤条件
        $('.choose>div:not(.result) a').click(function () {
            // 添加选中样式
            $(this).addClass('select').siblings('a').removeClass('select');
            // 获得选中的文本
            var a_text = $(this).text();
            // 获取父级choose属性值
            var p_choose = $(this).parent('p').attr('choose');
            // 如果点击的是不限 那么结果栏的选项内容消失
            if ($(this).text() == '不限') {
                $('a[choose=' + p_choose + ']').detach();
            } else {
                // 判断是否已经选择条件
                if ($('a[choose=' + p_choose + ']').length > 0) {
                    $('a[choose=' + p_choose + ']').text(a_text).append('<i class="iconfont icon-error"></i>');
                } else {
                    $('p[result="result"]').append(
                            '<a choose=' + p_choose + ' href="#">' + a_text + '<i class="iconfont icon-error"></i></a>'
                    );
                }
            }
            // 将结果栏显示
//            $('.result').removeClass('display-none');
        });

        // 点击单个删除
        $('p[result="result"]').on('click', 'a>i', function () {
            // 触发 不限的点击事件
            var a_choose = $(this).parent('a').attr('choose');
            $('p[choose=' + a_choose + '] a').eq(0).click();
            return false;
        });

        // 点击清除
        $('.J_clear').click(function () {
            // 将选择元素清除
            $(this).prev('p').text('');
            // 触发 不限的点击事件
            $('p[choose] a:first-child').click();
            window.location="<?php echo url_rewrite('item');?>";
            // 将结果栏隐藏
            // $('.result').addClass('display-none');
        });


    });
</script>
</body>
</html>