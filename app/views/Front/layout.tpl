{*<!--
Author: W3layouts
Author URL: http://w3layouts.com https://p.w3layouts.com/demos/princi_gym/web/index.html
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
*}<!DOCTYPE html>
<html>
<head>
    <title>{{@title}}</title>
    <link href="{{@BASE}}/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{@BASE}}/css/cyber.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{@BASE}}/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- js -->
    <script src="{{@BASE}}/js/jquery-3.2.1.min.js"></script>
    <script src="{{@BASE}}/js/bootstrap.js"></script>
    <!-- //js -->
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Princi_Gym Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{@BASE}}/js/move-top.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/easing.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/cyber.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
    <!--start-top-nav-script-->
    <script>
        $(function() {
            var pull 		= $('#pull');
            menu 		= $('nav ul');
            menuHeight	= menu.height();
            $(pull).on('click', function(e) {
                e.preventDefault();
                menu.slideToggle();
            });
            $(window).resize(function(){
                var w = $(window).width();
                if(w > 320 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });
        });
    </script>
    <!--End-top-nav-script-->

    <script>
        _base = '{{ @BASE }}';
    </script>

</head>

<body>
<!-- header -->
<div class="header">
    <div class="container">
        <div class="header-top-left" id="home">
            <ul>
                <li class="activ"><a href="#">LAST NOTICE</a></li>
                <li>Aliquam sit amet gravida ipsum,v...</li>
            </ul>
        </div>
        <div class="header-top-right">
            <div id="authblock" class="async">
                Loading...
            </div>
            {*<p>Phone Number:<span> 043-234-3453</span></p>*}
        </div>
        <div class="clearfix"> </div>
        <div class="head-logo">
            <a href="index.html"><span> </span></a>
        </div>
        <div class="header-top">

            <div class="navigation">
                <span class="menu"></span>
                <ul class="navig">
                    <repeat group="{{ @menu }}" key="{{ @key }}" value="{{ @item }}">
                        <li{{ isset(@item.items) ? ' class="plan active"' : '' }}>
                            <a href="{{ @BASE }}/{{ @key }}.html"{{ @key == @action ? ' class="act"' : '' }}>{{ @item.label }}</a>
                            <include href="Front/submenu.tpl" if="{{ isset(@item.items)}}" with="items={{ @item.items }}" />
                        </li>
                    </repeat>
                    <div class="clearfix"> </div>
                </ul>

            </div>
            {*<div class="search">*}
                {*<form>*}
                    {*<input type="text" placeholder="Type and search..." required=" ">*}
                {*</form>*}
            {*</div>*}
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- script-for-menu -->
<script>
    $("span.menu").click(function(){
        $(" ul.navig").slideToggle("slow" , function(){
        });
    });
</script>
<!-- script-for-menu -->
<!-- //header -->
<!---728x90--->
{{ @content | raw }}
<!---728x90--->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-icon">
            <a href="#home" class="scroll"><img src="image/row.png" alt=" " /></a>
        </div>
        <div class="footer-social">
            <ul>
                <li><a href="#" class="dribble"> </a></li>
                <li><a href="#" class="facebook"> </a></li>
                <li><a href="#" class="twitter"> </a></li>
                <li><a href="#" class="be"> </a></li>
                <li><a href="#" class="in"> </a></li>
                <li><a href="#" class="fli"> </a></li>
                <li><a href="#" class="rad"> </a></li>
            </ul>
        </div>
        <div class="footer-nav">
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="single.html">ABOUT</a></li>
                <li><a href="news.html" class="foot">NEWS</a></li>
                <li><a href="trainers.html">ARCHIVES</a></li>
                <li><a href="contact.html">CONTACT</a></li>
            </ul>
        </div>
        <p>© 2015 Princi_Gym. All rights reserved | Template by <a href="http://w3layouts.com/">w3layouts</a></p>
    </div>
</div>
<!-- //footer -->
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->
</body>
</html>