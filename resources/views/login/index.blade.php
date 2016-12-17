<?php
$versionJs = '?v=' . Config::get('version.js');
$versionCss = '?v=' . Config::get('version.css');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Login</title>

		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css' . $versionCss) }}" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css' . $versionCss) }}" />
        <link rel="stylesheet" href="{{ asset('css/matrix-login.css' . $versionCss) }}" />
        <link href="{{ asset('font-awesome/css/font-awesome.css' . $versionCss) }}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <div id="loginbox">
            <form id="loginform" class="form-vertical" action="{{ route('login.submit') }}" method="POST">
<!--				<div class="control-group normal_text"> <h3>Login to continue</h3></div>-->
				<div class="control-group normal_text"> <h3><img src="{{ asset('img/logo2.png') }}" alt="Logo" /></h3></div>
				@if (isset($errors) && count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" required="" autofocus=""/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" required=""/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
					<div class="controls">
                        <div class="main_input_box">
							<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
						</div>
					</div>
                </div>
            </form>
        </div>

        <script src="{{ asset('js/jquery.min.js' . $versionCss) }}"></script>
        <script src="{{ asset('js/matrix.login.js' . $versionCss) }}"></script>
    </body>

</html>
