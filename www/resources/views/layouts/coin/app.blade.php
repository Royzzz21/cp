<!DOCTYPE html>
<html lang="ko">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Tibab</title>
	<link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/css/creative.css" rel="stylesheet">
	<link href="/css/reset.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


	{{--<script src="/vendor/jquery/jquery.js"></script>--}}
	<script src="/js/jquery.min.js"></script>


	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/js/jquery.easing.min.js"></script>
	<script src="/vendor/scrollreveal/scrollreveal.min.js"></script>
	<script src="/js/jquery.countdown.min.js"></script>


	<link rel="stylesheet" href="/ladda/ladda-themeless.min.css">
	<script src="/laddaspin.min.js"></script>
	<script src="/ladda/ladda.min.js"></script>

</head>


<body id="page-top">

	{{-- topbar --}}
	@include('layouts.coin.topbar')

	@yield('content')

	{{-- footer --}}
	@include('layouts.coin.foot')

	<a class="go-top" href="#" style="z-index:99999;"><img src="/img/go_top.png" alt="go-top"></a>

{{--
	<div class="sidebar" style="z-index:99999;">
		<ul>
			<li><a href="https://blog.naver.com/tibabio" target="_blank"><img src="img/blog_icon.png" alt="blog"></a></li>
			<li><a href="https://open.kakao.com/o/gr8rlIZ" target="_blank"><img src="img/kakaotalk_icon.png" alt="kakaotalk"></a></li>
			<li><a href="https://twitter.com/TiBAB11" target="_blank"><img src="img/twitter_icon.png" alt="twitter"></a></li>
			<li><a href="https://www.facebook.com/tibab.tibab.12" target="_blank"><img src="img/facebook_icon.png" alt="facebook"></a></li>
			<li><a href="https://www.instagram.com/tibab.io/" target="_blank"><img src="img/instagram_icon.png" alt="instargram"></a></li>
		</ul>
	</div>


--}}


	<script src="/js/creative.min.js"></script>


	<script>
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 500) {
                    $('.go-top').fadeIn();
                } else {
                    $('.go-top').fadeOut();
                }
            });

            $(".go-top").click(function() {
                $('html, body').animate({
                    scrollTop : 0
                }, 400);
                return false;
            });
        });
	</script>


</body>
</html>
