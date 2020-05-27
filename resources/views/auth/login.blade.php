<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()== 'ar' ? 'rtl': 'ltr'}}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="{{asset('neon-theme/html/neon')}}/assets/images/favicon.ico">

	<title>وصلة | تسجيل الدخول</title>
    @if(app()->getLocale()=='en')

	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/css/bootstrap.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/css/neon-core.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/css/neon-theme.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/css/neon-forms.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/css/custom.css">

    <script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery-1.11.3.min.js"></script>
    @else
    <link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/bootstrap.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/neon-core.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/neon-theme.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/neon-forms.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/custom.css">

    <script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery-1.11.3.min.js"></script>

@endif
	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">

	<div class="login-header login-caret">

		<div class="login-content">

			<a href="index.html" class="logo">
				<img src="{{ url('/uploads/wasla.png')}}" width="120" alt="" />
			</a>

			<p class="description">@lang('site.login_description')</p>

			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>

        <ul class="list-inline links-list  text-center">
            <li class="dropdown language-selector">
                Language:{{app()->getLocale()}} &nbsp;
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">

                <img src={{app()->getLocale()=='en'? url('/neon-theme/html/neon/assets/images/flags/flag-uk.png') :url('/neon-theme/html/neon/assets/images/flags/flag-ar.png') }} style="border-radius:15px" width="16" height="16">

                    </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                    <a href="{{route('local.change',['lang'=>'ar'])}}"> <img style="border-radius:15px" src="{{ url('/neon-theme/html/neon/assets/images/flags/flag-ar.png')}}" width="16" height="16"> <span>Arabic</span> </a>
                    </li>
                    <li class="active">
                        <a href="{{route('local.change',['lang'=>'en'])}}"> <img src="{{url('/neon-theme/html/neon/assets/images/flags/flag-uk.png')}}" width="16" height="16"> <span>English</span> </a>
                    </li>

                </ul>
            </li>
        </ul>
	</div>

	<div class="login-progressbar">
		<div></div>
	</div>

	<div class="login-form">

        @include('sweetalert::alert')
        @include('partials._errors')

        @if(session()->has('logged_out'))

        <div class="row">
            <div class="alert alert-success col-md-4 col-md-offset-4" align="center">

                {{ session('logged_out') }}
        </div>

        </div>

    @endif


		<div class="login-content">


			<form method="post" action="{{route('login')}}" role="form" id="form_login">
                @csrf
				<div class="form-group">

					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>

						<input type="text" class="form-control" name="email" placeholder="@lang('site.email')" />
					</div>

				</div>

				<div class="form-group">

					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>

						<input type="password" class="form-control" name="password"  placeholder="@lang('site.password')" />
					</div>

				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						@lang('site.login')
					</button>
				</div>







			</form>


			<div class="login-bottom-links">

                <a href="{{route('seller.create')}}" class="link">@lang('site.seller_register')</a><br>
                <a href="{{route('provider.create')}}" class="link">@lang('site.provider_register')</a>


				<br />

			</div>

		</div>

	</div>

</div>


    <!-- Bottom scripts (common) -->
    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-login.js"></script>

    @if(app()->getLocale()=='en')

	<script src="{{asset('neon-theme/html/neon')}}/assets/js/gsap/TweenMax.min.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/bootstrap.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/joinable.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/resizeable.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/neon-api.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery.validate.min.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
    <script src="{{asset('neon-theme/html/neon')}}/assets/js/neon-demo.js"></script>
    @else
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/gsap/TweenMax.min.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/bootstrap.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/joinable.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/resizeable.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-api.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jquery.validate.min.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-demo.js"></script>
    @endif
</body>
</html>
