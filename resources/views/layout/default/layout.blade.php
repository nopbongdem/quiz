<!DOCTYPE html>
<html lang="vi">
	<head itemscope itemtype="http://schema.org/WebSite">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<link rel="canonical" href="{!! url() !!}" itemprop="url">
		<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
		<link rel="manifest" href="/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<title itemprop='name'>Manga</title>
		{!! HTML::style('/assets/bootstrap-3.3.4-dist/css/bootstrap.min.css') !!}

		{!! FA::css() !!}
		<!-- <link href="{!! asset("assets/font-awesome-4.3.0/css/font-awesome.min.css") !!}" rel="stylesheet"> -->
		<link href="{!! asset("/css/style.css") !!}" rel="stylesheet">

		<!-- Bootstrap CSS -->

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->


	</head>
	<body>
		@include('layout.default.header')


		<div class="contents"> @yield('content') </div>


		@include('layout.default.footer')

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>

		<!-- Bootstrap JavaScript -->
		{!! HTML::script('/assets/bootstrap-3.3.4-dist/js/bootstrap.min.js') !!}

		@yield('script')

	</body>
</html>