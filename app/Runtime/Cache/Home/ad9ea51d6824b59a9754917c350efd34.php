<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>工程动态</title>
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/boke/Public/css/bootstrap.min.css">
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="/boke/Public/css/hero-slider-style.css">
    <!-- Hero slider style (https://codyhouse.co/gem/hero-slider/) -->
    <link rel="stylesheet" href="/boke/Public/css/magnific-popup.css">
    <!-- Magnific popup style (http://dimsemenov.com/plugins/magnific-popup/) -->
    <link rel="stylesheet" href="/boke/Public/css/templatemo-style.css">
    <!-- Templatemo style -->
    <link rel="stylesheet" type="text/css" href="/boke/Public/css/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

<body onload="getTime()">
    <div id="top_txt" class="top_txt">
        <ul>
            <li>
                <p>欢迎访问嘉兴市原水投资有限公司！</p>
            </li>
        </ul>
    </div>
    <div class="ys_head"><img src="/boke/Public/img/head.jpg">
        <div class="search">
            <span class="s_con"><input type="text" class="content" placeholder="请输入搜索内容"><i class="clear" id="clear" style="display: inline;"></i></span>
            <span class="s_btn">搜索</span>
        </div>
    </div>
    <!-- Content -->
    <div class="cd-hero">
        <!-- Navigation -->
        <div class="cd-slider-nav">
            <nav class="navbar">
                <div class="tm-navbar-bg">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                        &#9776;
                    </button>
                    <div class="collapse navbar-toggleable-md text-xs-center text-uppercase tm-navbar" id="tmNavbar">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo U('index/index');?>" data-no="1">网站首页 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo U('index/about');?>" data-no="2">公司概况</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo U('company/news');?>"" data-no="3">公司动态</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo U('index/partyBuilding');?>" data-no="4">党建动态</a>
                            </li>
                            <li class="nav-item  active selected">
                                <a class="nav-link" href="<?php echo U('index/engineering');?>" data-no="5">工程动态</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo U('index/personnel');?>" data-no="6">人事信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo U('index/contactus');?>" data-no="6">联系我们</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- .cd-hero -->
    <div class="ys_banner"><img src="/boke/Public/img/slide1.jpg"></div>
    <section class="warp1250">
        <div class="ys_time">
            <div id="dateTime" style="margin-left: 34px"></div>
        </div>
        <section>
            <div class="content_310"><img src="/boke/Public/img/Engineering_bg.jpg"></div>
            <div class="content_924">
                <div class="ys_line">
                    <p>当前位置：<a href="">首页</a>><a href="">工程动态</a></p>
                </div>
                 <section class="ys_page">
                    <h2><?php echo ($list['title']); ?></h2>
                     <h3><?php echo ($list['subtitle']); ?></h3>
                     <div class="page_line">
                         来源：<?php echo ($list['author']); ?>  发布时间：<?php echo ($list['createtime']); ?> 浏览量：<?php echo ($list['clicknum']); ?>
                     </div>
                     <div class="brush:php;"><?php echo htmlspecialchars_decode($list['content']); ?></div>
                </section>
            </div>
        </section>
        <section class="content_2">
            <ul class="friendly">
                <li><img src="/boke/Public/img/001.jpg"></li>
                <li><img src="/boke/Public/img/002.jpg"></li>
                <li><img src="/boke/Public/img/002-1.jpg"></li>
                <li><img src="/boke/Public/img/002-2.jpg"></li>
                <li><img src="/boke/Public/img/003.jpg"></li>
                <li><img src="/boke/Public/img/004.jpg"></li>
            </ul>
        </section>
    </section>
    <!-- 底部 -->
    <footer id="footer_area" class="ys_foot">
        <div class="container">
            <div class="row">
                <div class="col-sm-2" style="text-align: center;">
                    <div class="company_logo wow slideInDown">
                        <div><img src="/boke/Public/img/qcode.jpg"></div>
                        <h2 style="margin-top: 10px">手机扫描访问</h2>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="company_address wow slideInDown">
                        <p>网站导航：<a href="">公司概况</a><a href="">公司概况</a><a href="">公司概况</a><a href="">公司概况</a><a href="">公司概况</a><a href="">公司概况</a></p>
                        <p>嘉兴市原水投资有限公司</p>
                        <p>地址：嘉兴市洪兴路875号兴禺大厦8F</p>
                        <p>电话：0573-82815976</p>
                        <p>传真：0573-82815976</p>
                        <p>邮箱：master@jxrawwarter.com</p>
                        <p>CopyRight © 2017 嘉兴市原水投资有限公司 版权所有 All Rights Reserved.浙ICP备23514871号  建议使用IE8.0以上浏览器，屏幕分辨率1440*900以上显示器访问本网站
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="/boke/Public/js/jquery-1.11.3.min.js"></script>
    <!-- jQuery (https://jquery.com/download/) -->
    <script src="/boke/Public/js/tether.min.js"></script>
    <!-- Tether for Bootstrap (http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h) -->
    <script src="/boke/Public/js/bootstrap.min.js"></script>
    <!-- Bootstrap js (v4-alpha.getbootstrap.com/) -->
    <script src="/boke/Public/js/hero-slider-main.js"></script>
    <!-- Hero slider (https://codyhouse.co/gem/hero-slider/) -->
    <script src="/boke/Public/js/jquery.magnific-popup.min.js"></script>
    <!-- Magnific popup (http://dimsemenov.com/plugins/magnific-popup/) -->
    <!-- search -->
    <script type="text/javascript">
    $('.content').on('keyup', function() {
        $('.clear').show();
    });
    $('.clear').click(function() {
        $('.content').val('');
    });
    </script>
    <script>
    function adjustHeightOfPage(pageNo) {

        var offset = 80;
        var pageContentHeight = 0;

        var pageType = $('div[data-page-no="' + pageNo + '"]').data("page-type");

        if (pageType != undefined && pageType == "gallery") {
            pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .tm-img-gallery-container").height();
        } else {
            pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .js-tm-page-content").height();
        }

        if ($(window).width() >= 992) { offset = 120; } else if ($(window).width() < 480) { offset = 40; }

        // Get the page height
        var totalPageHeight = 15 + $('.cd-slider-nav').height() +
            pageContentHeight + offset +
            $('.tm-footer').height();

        // Adjust layout based on page height and window height
        if (totalPageHeight > $(window).height()) {
            $('.cd-hero-slider').addClass('small-screen');
            $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", totalPageHeight + "px");
        } else {
            $('.cd-hero-slider').removeClass('small-screen');
            $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", "100%");
        }
    }
    </script>
    <!-- 轮播图 -->
    <script type="text/javascript">
    function getTime() {

        var dateObj = new Date();

        var year = dateObj.getFullYear(); //年
        var month = dateObj.getMonth() + 1; //月  (注意：月份+1)
        var date = dateObj.getDate(); //日
        var day = dateObj.getDay();
        var weeks = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
        var week = weeks[day]; //根据day值，获取星期数组中的星期数。
        var hours = dateObj.getHours(); //小时
        var minutes = dateObj.getMinutes(); //分钟
        var seconds = dateObj.getSeconds(); //秒

        if (month < 10) {
            month = "0" + month;
        }
        if (date < 10) {
            date = "0" + date;
        }
        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        var newDate = "今天是" + year + "年" + month + "月" + date + "日" + hours + ":" + minutes + ":" + seconds + "&nbsp &nbsp" + week;
        document.getElementById("dateTime").innerHTML = newDate; //在div中写入时间
        setTimeout('getTime()', 500); //每隔500ms执行一次getTime()
    }
    </script>
</body>

</html>