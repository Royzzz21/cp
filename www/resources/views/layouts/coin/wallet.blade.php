<?php
	$cuser_id = 0;
	if(Auth::check()){ // 로그인 유무 체크
		$cuser_id = Auth::id();
		// $data = session()->all();
		// print_r($data);
		// echo Auth::id(); // 로그인 아이디
		// echo Auth::user(); // 사용자 정보 전체
		// echo Auth::user()->name; // 이메일
	}
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="overflow-y: scroll;">
<head>
	{{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>{{ config('app.name') }} Bitcoin Trading Platform</title>

	{{--favicon--}}
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
	
	<link href="//fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	
	{{--bootstrap--}}
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="{{asset('coin/css/style.css')}}" >
	<script src="{{asset('coin/js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="/res/admin/plugins/bootstrap/js/bootstrap.js"></script>

	{{--trading view--}}
	<script type="text/javascript" src="{{asset('js/tv/charting_library/charting_library.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/tv/charting_library/datafeed/udf/datafeed.js')}}"></script>

	{{--odometer--}}
	<script>
		window.odometerOptions = {
			auto: false, // Don't automatically initialize everything with class 'odometer'
//        selector: '.my-numbers', // Change the selector used to automatically find things to be animated
//        format: '(,ddd).dd', // Change how digit groups are formatted, and how many digits are shown after the decimal point
			format: '(,ddd)', // Change how digit groups are formatted, and how many digits are shown after the decimal point
			duration: 1000, // Change how long the javascript expects the CSS animation to take
			theme: 'car', // Specify the theme (if you have more than one theme css file on the page)
//        theme: 'default', // Specify the theme (if you have more than one theme css file on the page)
			animation: 'count' // Count is a simpler animation method which just increments the value,
							   // use it when you're looking for something more subtle.
		};
	</script>
	<!-- Extra styles for this example -->


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	{{--moment--}}
	<script src="{{asset('js/moment.min.js')}}"></script>
	<script src="{{asset('js/moment-timezone-with-data-2012-2022.min.js')}}"></script>

	{{--toastr--}}
	<script src="{{asset('js/toastr/toastr.min.js')}}"></script>
	<link href="{{asset('js/toastr/toastr.css')}}" rel="stylesheet"/>

	<script src="{{asset('coin/js/lib.js')}}"></script>
	<script src="//<?php if(isset($_SERVER['SERVER_NAME']))echo $_SERVER['SERVER_NAME']; ?>:8080/socket.io/socket.io.js"></script>



	{{--<!-- Waves Effect Css -->--}}
	{{--<link href="/res/admin/plugins/node-waves/waves.css" rel="stylesheet">--}}

	{{--<!-- Animation Css -->--}}
	{{--<link href="/res/admin/plugins/animate-css/animate.css" rel="stylesheet">--}}

	{{--<!-- Bootstrap Material Datetime Picker Css -->--}}
	{{--<link href="/res/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />--}}

	{{--<!-- Wait Me Css -->--}}
	{{--<link href="/res/admin/plugins/waitme/waitMe.css" rel="stylesheet" />--}}

	{{--<!-- Bootstrap Select Css -->--}}
	{{--<link href="/res/admin/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />--}}

	{{--<!-- Morris Chart Css-->--}}
	{{--<link href="/res/admin/plugins/morrisjs/morris.css" rel="stylesheet">--}}

	<!-- Custom Css -->
	<link href="/res/admin/css/style.css" rel="stylesheet">

	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	{{--<link href="/res/admin/css/themes/all-themes.css" rel="stylesheet">--}}





	<style>
		.odometer {
			font-size: 50px;
		}
		body{letter-spacing:-1px;}
	</style>

	{{--blink css--}}
	<style>
		@-webkit-keyframes blink {
			50% {
				background: rgba(204, 204, 204, 0.5);
			}
		}

		@-moz-keyframes blink {
			50% {
				background: rgba(204, 204, 204, 0.5);
			}
		}

		@keyframes blink {
			50% {
				background: rgba(204, 204, 204, 0.5);
			}
		}

		@-webkit-keyframes blink2 {
			50% {
				background: rgba(194, 226, 189, 0.5);
			}
		}

		@-moz-keyframes blink2 {
			50% {
				background: rgba(194, 226, 189, 0.5);
			}
		}

		@keyframes blink2 {
			50% {
				background: rgba(194, 226, 189, 0.5);
			}
		}

		.blink {
			-webkit-animation-direction: normal;
			-webkit-animation-duration: 0.2s;
			-webkit-animation-iteration-count: 1;
			-webkit-animation-name: blink;
			-webkit-animation-timing-function: linear;
			-moz-animation-direction: normal;
			-moz-animation-duration: 0.2s;
			-moz-animation-iteration-count: 1;
			-moz-animation-name: blink;
			-moz-animation-timing-function: linear;
			animation-direction: normal;
			animation-duration: 0.2s;
			animation-iteration-count: 1;
			animation-name: blink;
			animation-timing-function: linear;
		}

		.blink2 {
			-webkit-animation-direction: normal;
			-webkit-animation-duration: 0.2s;
			-webkit-animation-iteration-count: 1;
			-webkit-animation-name: blink2;
			-webkit-animation-timing-function: linear;
			-moz-animation-direction: normal;
			-moz-animation-duration: 0.2s;
			-moz-animation-iteration-count: 1;
			-moz-animation-name: blink2;
			-moz-animation-timing-function: linear;
			animation-direction: normal;
			animation-duration: 0.2s;
			animation-iteration-count: 1;
			animation-name: blink2;
			animation-timing-function: linear;
		}

		/*table {*/
		/*width: 100%;*/
		/*}*/

		/*table tr:nth-child(odd) {*/
		/*background: gray;*/
		/*}*/


	</style>
</head>


<body class="trade" style="background-color:white;">
<div class="" style="padding-top:10px;clear:both;border:0px solid red;"></div>

<div id="toast"></div>


	<?php
		// $data = Session::all(); 
		// print_r($data); 
	?>
	{{-- topbar --}}
	@include('layouts.coin.topbar')

	<div class="" style="padding-top:50px;clear:both;border:0px solid red;">
	</div>






<style>
	.bg-banner {
		width: 100%;
		background-color: #E8E8E8;
	}

	.side-section {
		padding: 20px 0;
	}

	/*table style*/
	.head-table {
		background-color: #E52582;
		text-align: center;
		font-size: 20px;
		color: #ffffff;
		font-weight: bold;
	}

	table {
		width: 230px;
		padding-top: 20px;
	}

	.bordered {
		border: #000 1px solid !important;
	}

	.table tbody tr td, .table tbody tr th {
		border: #000 1px solid !important;
	}

	.style3 {
		background-color: #000000;
		color: #ffffff;
		text-align: center;
	}

	.style3 span {
		color: #f4f442;
		font-size: 16px;
	}

	.sub-title {
		background-color: #F3F3F3;
		text-align: center;
	}

	.quick-menu {
		margin-top: 10px;
	}

	.head-quick {
		background-color: #0A4EA9;
		text-align: center;
		font-size: 20px;
		color: #ffffff;
		font-weight: bold;
	}

	.quick-sub {
		background-color: #F4F4F4;
		text-align: center;
	}

	.quick-sub a {
		color: #0A4CA9;
	}

	.quick-sub a:hover {
		text-decoration: none;
	}

	.quick-list {
		list-style: none;
		font-size: 14px;
	}

	.quick-list li a:hover {
		color: orange;
		text-decoration: none;
	}

	/* Deposit Wallet Navbar*/
	.wallet-bar {
		list-style: none;
		list-style-type: none;
		width: 100%;
	}

	.wallet-bar .wallet-select {
		display: inline;
		width: 25%;

	}

	.wallet-select a {
		font-size: 14px;
		width: 25%;
	}

	div.scrollmenu {
		background-color: #0A4CA9;
		white-space: nowrap;
	}

	div.scrollmenu a {
		display: inline-block;
		color: white;
		text-align: center;
		padding: 20px;
		text-decoration: none;
	}

	div.scrollmenu a:hover {
		background-color: #3b7ce5;


</style>


<style type="text/css">
	<!--
	.bold_font {
		color: #595857 !important;
	}

	.mypage_line01 {
		border-right: 1px solid #d1d1d1;
		border-bottom: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		background-image: url(images/mypage/mypage_list_bg_gr.jpg);
		background-repeat: repeat-x;
		background-position: center top;
		padding-left: 20px;
	}

	.mypage_line_b02 {
		border-right: 1px solid #d1d1d1;
		border-bottom: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		padding: 5px 5px 5px 22px;
	}

	.border_line_btc {
		background: #f5f6f8;
		height: 35px;
		border-right: 1px solid #d0d0d0;
		border-bottom: 1px solid #d0d0d0;
		padding: 5px 5px 5px 15px;
		font-family: 굴림, Tahoma;
		font-size: 12px;
		font-weight: bold;
	}

	.border_line_btc02 {
		border-bottom: 1px solid #d0d0d0;
		padding: 5px 5px 5px 10px;
		font-family: 굴림, Tahoma;
		font-size: 12px;
	}

	-->
</style>

<!----------- 헤지 구매 st ----------------->
<style type="text/css">
	<!--
	body {
		font-family: 굴림, Tahoma;
		font-size: 12px;
		color: #252525;
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}

	a:link, a:visited, a:active {
		text-decoration: none;
		color: #515151;
		font-size: 12px;
	}

	a:hover {
		text-decoration: none;
		color: #ff5f1e;
		font-size: 12px;
	}

	a.txt01:link, a.txt01:visited, a.txt01:active {
		text-decoration: none;
		color: #ffffff;
		font-weight: bold;
		font-size: 12px;
	}

	a.txt01:hover {
		text-decoration: none;
		color: #ecfa0e;
		font-size: 12px;
	}

	.style_box_pink {
		padding: 10 5 5 25px;
		background-color: #e82789;
		border-radius: 0px;
		box-shadow: 0px 0px 0px #d01d78;
	}

	.pink_padding {
		padding: 10px 15px 5px 15px;
	}

	.join_Bg {
		background-image: url('images/m_right_join_count_bg.png');
		background-repeat: no-repeat;
		background-position: center top;
		color: #ffffff;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 16px;
		font-weight: bold;
		padding-top: 2px;

	}

	.style_sns {
		color: #13D4FF;
		font-size: 12px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-weight: bold;
	}

	.style_facebook {
		color: #0e4187;
		font-size: 12px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-weight: bold;
	}

	.style_k_small {
		color: #6c6b6a;
		font-size: 11px;
		letter-spacing: -1px;
	}

	.style_k_small_light {
		color: #a4a4a4;
		font-size: 11px;
		letter-spacing: -1px;
	}

	.style_u_small_b {
		color: #383837;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
		font-weight: bold;
	}

	.style_u_m_b {
		color: #383837;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 19px;
		letter-spacing: -2px;
		font-weight: bold;
	}

	.style_u_small_b_grey {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #929596;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 8px;
	}

	.style1_k {
		color: #0b6ac5;
		font-family: 굴림;
		돋움;
		font-size: 12px;
	}

	.style1_green {
		color: #d2ff22;
		font-family: 굴림;
		돋움;
		font-size: 12px;
	}

	.style_box {
		border: 1px solid #eeeded;
		border-radius: 18px;
		box-shadow: 5x 5px 4px #252525;
	}

	.style_box02 {
		background-color: #031f3a;
		border-radius: 15px;
	}

	.style_box_s_none {
		background-color: #ffffff;
		border-radius: 10px;
		border-right: 1px solid #dedddd;
		border-left: 1px solid #dedddd;
		border-bottom: 1px solid #dedddd;
	}

	.style_box_s_none01 {
		background-color: #ffffff;
		border-radius: 15px;
		border: 1px solid #d7d7d7;
	}

	.style_padding00 {
		padding: 18px 5px 15px 15px;
	}

	.style_padding01 {
		padding: 10px 10px 10px 10px;
	}

	.style_padding02 {
		padding: 5px 5px 5px 5px;
	}

	.line_01 {
		padding: 5px 2px 5px 1px;
		border-right: 1px solid #e5e5e5;
		border-bottom: 1px solid #e5e5e5;
		color: #929596;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 8px;
	}

	.line_02 {
		padding: 5px 2px 5px 1px;
		border-bottom: 1px solid #e5e5e5;
		color: #929596;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 9px;
	}

	.line_03 {
		padding: 5px 2px 5px 1px;
		border-right: 1px solid #e5e5e5;
		color: #929596;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 8px;
	}

	.line_04 {
		padding: 5px 2px 5px 1px;
		color: #929596;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 9px;
	}

	.font_w {
		color: #FFFFFF;
		line-height: 120%;
		font-weight: bold;
		font-size: 12px;
	}

	.mypage_line01 {
		border-right: 1px solid #d1d1d1;
		border-bottom: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		background-image: url(images/mypage/mypage_list_bg_gr.jpg);
		background-repeat: repeat-x;
		background-position: center top;
		padding-left: 20px;
	}

	.mypage_line02 {
		border-right: 1px solid #d1d1d1;
		border-bottom: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		padding: 5px 5px 5px 22px;
		color: #333333;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
	}

	.mypage_line03 {
		border-right: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		padding: 5px 5px 5px 22px;
		color: #333333;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
	}

	.mypage_line_b02 {
		border-right: 1px solid #d1d1d1;
		border-bottom: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		padding: 5px 5px 5px 22px;
	}

	.mypage_line_b03 {
		border-right: 1px solid #d1d1d1;
		border-left: 1px solid #d1d1d1;
		padding: 5px 5px 5px 22px;
		color: #333333;
	}

	.myp_12 {
		font-size: 11px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
	}

	.myp_table {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		font-size: 12px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.myp_table01 {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		font-size: 11px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.myp_table02 {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		border-right: 1px solid #d3d4d6;
		font-size: 12px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.myp_table_b01 {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		font-family: 굴림, Tahoma;
		font-size: 12px;
		color: #2367c3;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.myp_table_b02 {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		border-right: 1px solid #d3d4d6;
		font-family: 굴림, Tahoma;
		font-size: 12px;
		color: #2367c3;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.myp_table_c01 {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		font-family: 굴림, Tahoma;
		font-size: 12px;
		color: #c62136;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.myp_table_c02 {
		border-left: 1px solid #d3d4d6;
		border-bottom: 1px solid #d3d4d6;
		border-right: 1px solid #d3d4d6;
		font-family: 굴림, Tahoma;
		font-size: 12px;
		color: #c62136;
		padding-top: 5px;
		padding-bottom: 5px;
	}

	.border_line_btc {
		border-right: 1px solid #d0d0d0;
		border-bottom: 1px solid #d0d0d0;
		padding: 5px 5px 5px 15px;
		font-family: 굴림, Tahoma;
		font-size: 12px;
		font-weight: bold;
	}

	.border_line_btc02 {
		border-bottom: 1px solid #d0d0d0;
		padding: 5px 5px 5px 10px;
		font-family: 굴림, Tahoma;
		font-size: 12px;
	}

	.style1 {
		color: #F88220;
		font-weight: bold;
	}

	.style2 {
		color: #64A4EE;
		font-weight: bold;
	}

	-->
</style>

<style>
	.txt_w36 {
		font-size: 36px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-weight: bold;
		color: #FFFFFF;
	}

	.style5 {
		font-size: 16px;
		font-weight: bold;
	}

	.text_orange {
		color: #ff4513;
		font-weight: bold;
	}

	.text_grey {
		color: #CCCCCC
	}

	/* 회원정보 변경 */
	.myinfo_input {
		float: left;
		width: 150px;
		font-size: 12px;

		box-shadow: none;
		border: 1px solid #bebebe;
		padding: 5px;
	}


</style>



<div class="container">

	<div class="row bg-banner">
		<div class="col-md-2 col-md-offset-3 centered ">
			<img src="{{asset('images/sub06_01.jpg')}}">
		</div>
	</div>
</div>

<div class="container">
	<div class="row side-section">
		<div class=" col-md-offset-1 col-lg-2">
			{{--Sidebar Table--}}
			@include('layouts.coin.sidebar')
		</div>


		<div class="col-lg-6">
			@yield('content')

		</div>

	</div>

</div>


	{{-- footer --}}
	@include('layouts.coin.foot')
	
	{{-- common script --}}
	@include('layouts.coin.script_common')

	<? if(isset($trade_mode)){ ?>

	<?}?>

</body>
</html>
