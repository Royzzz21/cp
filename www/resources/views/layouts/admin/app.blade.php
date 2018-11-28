<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="overflow-y: scroll;">
<head>
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>

	<!--Bootstrap-->
	<link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-datepicker3.css" rel="stylesheet">

	<!--Costum CSS-->
	<link href="{{ asset('res/admin/css/admin.css') }}" rel="stylesheet">
	<link href="{{ asset('res/admin/css/metisMenu.min.css') }}" rel="stylesheet">


	<script src="/js/jquery.min.js"></script>
	<script src="/js/jquery-sortable.js" ></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




	<!--[if lt IE 9]>

	<![endif]-->
	<script>
        // import Echo from "laravel-echo";

        // window.Echo = new Echo({
        // broadcaster: 'socket.io',
        // host: window.location.hostname + ':8080'
        // });

        // const socket = io("http://{{ Request::getHost() }}:8080");
	</script>
	<!--

	<script>
	$(document).ready(function(){
		// 소켓
		var socket           = io.connect('http://192.168.2.32:8080', {'sync disconnect on unload' : true});
	});
	</script>
	-->
</head>


<body>
<div id="wrapper">

	<!-- Navigation -->

	@include('layouts.admin.navbar')
	<div id="page-wrapper">

		@yield('content')
	</div>


</div>

<!-- /#wrapper -->
<!-- Scripts




<!-- Bootstrap Date-Picker Plugin -->
<script src="/js/bootstrap-datepicker.min.js"></script>

<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/metisMenu.min.js') }}"></script>

<!-- Bootstrap Date-Picker Function -->
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })
</script>




</body>
</html>
