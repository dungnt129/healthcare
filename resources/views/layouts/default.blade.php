<?php
$versionJs = '?v=' . Config::get('version.js');
$versionCss = '?v=' . Config::get('version.css');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>{{ $pageTitle or 'Admin' }}</title>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--Common stylesheet-->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css' . $versionCss) }}" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css' . $versionCss) }}" />
		<link rel="stylesheet" href="{{ asset('css/uniform.css' . $versionCss) }}" />
		<link rel="stylesheet" href="{{ asset('css/select2.css' . $versionCss) }}" />
		<link rel="stylesheet" href="{{ asset('css/matrix-style.css' . $versionCss) }}" />
		<link rel="stylesheet" href="{{ asset('css/matrix-media.css' . $versionCss) }}" />
		<link href="{{ asset('font-awesome/css/font-awesome.css' . $versionCss) }}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

		<!--Stylesheet for each page-->
		@yield('style')
	</head>

	<body>

		<!--Header-part-->
		@include('layouts.elements.header')

		<!--Sidebar-menu-->
		@include('layouts.elements.sidebar')

		<div id="content">
			<!--Content-header-->
			@include('layouts.elements.content_header')

			<!--Content-->
			<div class="container-fluid">
				<hr>
				<div class="row-fluid">
					<div class="span12">
						@yield('content')
					</div>
				</div>
			</div>
		</div>

		<!--Footer-part-->
		@include('layouts.elements.footer')
		<!--end-Footer-part-->

		<!--Common script-->
		<script src="{{ asset('js/jquery.min.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/jquery.ui.custom.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/bootstrap.min.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/jquery.uniform.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/select2.min.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/jquery.dataTables.min.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/matrix.js' . $versionCss) }}"></script>
		<script src="{{ asset('js/matrix.tables.js' . $versionCss) }}"></script>

		<!--Script for each page-->
		@yield('script')
	</body>
</html>
