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
	<link href="/css/bootstrap-datepicker3.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>


	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


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
	<div style="padding-top:90px;">

	</div>
	<div style="padding:25px;max-height:130px;background-color:#f7f7f7;text-align:center;">
		<span>
			<p style="font-size:32px;color:#222222;font-weight:bolder;"><?=glo()->page_obj->page_name?></p>
			<p style="font-size:15px;color:#666666;"><?=glo()->page_obj->page_desc?></p>
		</span>

	</div>
	<div style="padding-top:0px;padding-bottom:0px;max-width:1200px;margin:0 auto;">




	@yield('content')
	</div>
	{{-- footer --}}
	@include('layouts.coin.foot')

	<a class="go-top" href="#" style="z-index:99999;"><img src="/img/go_top.png" alt="go-top"></a>


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


	<script src="/js/bootstrap-datepicker.min.js"></script>


</body>
</html>
