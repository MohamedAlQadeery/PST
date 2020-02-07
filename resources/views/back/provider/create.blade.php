<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()== 'ar' ? 'rtl': 'ltr'}}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="{{asset('neon-theme/html/neon')}}/assets/images/favicon.ico">
    <title>Neon | Register</title>

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
	<!--[if lt IE 9]><script src="{{asset('neon-theme/html/neon')}}/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    @else
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/bootstrap.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/neon-core.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/neon-theme.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/neon-forms.css">
	<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/css/custom.css">

    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jquery-1.11.3.min.js"></script>
	<!--[if lt IE 9]><script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

@endif

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
				<img src="{{asset('neon-theme/html/neon')}}/assets/images/logo@2x.png" width="120" alt="" />
			</a>

			<p class="description">@lang('site.register_description')</p>

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

        @include('partials._errors')

		<div class="login-content">

			<form role="form" id="form_register" method="post" action="{{route('provider.store')}}" enctype="multipart/form-data">
                @csrf


				<div class="form-steps">

					<div class="step current" id="step-1">

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="text" class="form-control" name="first_name" placeholder="@lang('site.first_name')"  />
							</div>
						</div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="text" class="form-control" name="second_name"  placeholder="@lang('site.second_name')"  />
							</div>
						</div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="text" class="form-control" name="third_name"  placeholder="@lang('site.third_name')"  />
							</div>
						</div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="text" class="form-control" name="last_name" placeholder="@lang('site.last_name')"  />
							</div>
                        </div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="text" class="form-control" name="email"  placeholder="@lang('site.email')"  />
							</div>
                        </div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="password" class="form-control" name="password"  placeholder="@lang('site.password')"  />
							</div>
                        </div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="password" class="form-control" name="password_confirmation"  placeholder="@lang('site.password_confirmation')"  />
							</div>
                        </div>






						<div class="form-group">
							<button type="button" data-step="step-2" class="btn btn-primary btn-block btn-login">
								<i class="entypo-right-open-mini"></i>
								@lang('site.next')
							</button>
						</div>

						<div class="form-group">
							@lang('site.register_steps12')
						</div>

					</div>

					<div class="step" id="step-2">

                        <div class="form-group ">
                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                    <input type="hidden" value="" name="...">
                                    <span class="btn btn-primary btn-file ">
                                         <span class="fileinput-new">@lang('site.profile_image')</span>
                                         <span class="fileinput-exists">@lang('site.edit')</span>
                                          <input type="file" name="image" > </span>
                                          <span class="fileinput-filename"></span>
                                          <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> </div>

                        </div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								<input type="text" class="form-control"  name="mobile_number" placeholder="@lang('site.mobile_number')" />
							</div>
                        </div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								<input type="text" class="form-control"  name="address" placeholder="@lang('site.address')" />
							</div>
                        </div>


                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<input type="text" class="form-control" data-mask="99" name="age" placeholder="@lang('site.age')"  />
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								<input type="text" class="form-control" data-mask="d/m/y" name="dob" placeholder="@lang('site.dob')" />
							</div>
                        </div>

                        <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
                                </div>
                                <select name="gender"  class="form-control">
                                    <option value="#" disabled selected>@lang('site.choose_gender')</option>
                                    <option value="1">@lang('site.male')</option>
                                    <option value="2">@lang('site.female')</option>
                                </select>
    							</div>
                        </div>




                        <div class="form-group">
							<button type="button" data-step="step-1" class="btn btn-primary btn-block btn-login">
								<i class="entypo-left-open-mini"></i>
								@lang('site.back')
							</button>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-success btn-block btn-login">
                                <i class="entypo-right-open-mini"></i>
                                @lang('site.complete_register')
    							</button>
						</div>

                        <div class="form-group">
							@lang('site.register_steps22')
						</div>
                    </div>

				</div>

			</form>


			<div class="login-bottom-links">

				<a href="{{route('login')}}" class="link">
					<i class="entypo-lock"></i>
					@lang('site.login_page')
				</a>

				<br />


			</div>

		</div>

	</div>

</div>


    <!-- Bottom scripts (common) -->
    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-register.js"></script>

    @if(app()->getLocale()=='en')
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/gsap/TweenMax.min.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/bootstrap.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/joinable.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/resizeable.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/neon-api.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery.validate.min.js"></script>
	<script src="{{asset('neon-theme/html/neon')}}/assets/js/jquery.inputmask.bundle.js"></script>


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
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jquery.inputmask.bundle.js"></script>
    <script src="https://demo.neontheme.com/assets/js/fileinput.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-demo.js"></script>


@endif
</body>
</html>
