<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
	<title>グルメ案内所</title>
</head>
<body>
	<div id="app">
		<div class="ly_container">
			<router-view></router-view>
		</div>
		<!-- /.ly_container -->
		<footer-component></footer-component>
	</div>
	<!-- /#app -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="{{ mix('/js/app.js') }}" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>