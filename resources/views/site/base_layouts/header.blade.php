<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="{{asset('front/neon-frontend/assets/images/favicon.ico')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">

    <style>
        .droid-arabic-kufi {
            font-family: 'Droid Arabic Kufi', serif;
        }
    </style>
    <title>وصلة</title>

    <link rel="stylesheet" href="{{asset('front/neon-frontend/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('front/neon-frontend/assets/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="{{asset('front/neon-frontend/assets/css/neon.css')}}">
    {{-- font awosome link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('front/neon-frontend/assets/js/jquery-1.11.3.min.js')}}"></script>

</head>

<body class="droid-arabic-kufi">

    <div class="wrap">

        <!-- Logo and Navigation -->
        <div class="site-header-container container">

            <div class="row">

                <div class="col-md-12">

                    <header class="site-header">

                        <section class="site-logo">

                            <a href="{{route('site.home')}}">
                                <img src="{{asset('uploads/wasla.png')}}" width="120" />
                            </a>

                        </section>

                        <nav class="site-nav">

                            <ul class="main-menu hidden-xs" id="main-menu">
                                <li>
                                    <a href="{{route('site.home')}}">
                                        <span>الرئيسية</span>
                                    </a>
                                </li>

{{--
                                <li class="has-sub is-root">
                                    <a href="#">
                                        <span>الأصناف</span>
                                    </a>

                                    <ul>
                                        @foreach ($shareData['categories'] as $category)
                                        <li>
                                            <a href="{{route('site.products.index',['category_id'=>$category->id])}}">
                                                <span>{{$category->name}}</span>
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </li>  --}}
                                <li>
                                    <a href="{{route('site.products.index')}}">
                                        <span>تصفح البضائع</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('site.providers.index')}}">
                                        <span>تصفح المزودين</span>
                                    </a>
                                </li>
                                {{--
                                <li>
                                    <a href="contact.html">
                                        <span>Contact</span>
                                    </a>
                                </li> --}}

                            </ul>

                            @if (auth()->check())
                            <div style="float:left">

                              @php
                                  if(auth()->user()->type==0){
                                    $user = "admin.";
                                  }else{
                                    $user = "user.";

                                  }
                              @endphp
                                <a href="{{route($user.'dashboard')}}"><img src="{{auth()->user()->getImage()}}" alt="Avatar" class="avatar">
                                 @if(auth()->user()->type ===1)
                                <h4 style="display: inline-block;"> المحل:{{auth()->user()->shop->name}} </h4>
                                @elseif(auth()->user()->type ===2)
                                <h4 style="display: inline-block;"> المزود:{{auth()->user()->first_name}} </h4>
                                @else
                                <h4 style="display: inline-block;"> الأدمن:{{auth()->user()->first_name}} </h4>
                                </a>
                                 @endif &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp

                                <a href="#" onclick="event.preventDefault();
			document.getElementById('logout-form').submit();">
                                    <i class="entypo-logout right btn btn-secondary">	تسجيل خروج</i> </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

									<a href="{{route('site.cart.index')}}" class="btn btn-secondary">
										<i class="entypo-basket">
                                            @if(Cart::getContent()->count())
                                            <span style="background-color: red" class="badge">{{Cart::getContent()->count()}}<span>
                                            @endif
                                        </i>
                                    </a>

                            </div>

                            @else
                            <div style="float:left">
                                <a href="{{route('login')}}"> <i class="entypo-login right btn btn-primary">تسجيل دخول	</i></a>

                            </div>
                            @endif

                            <div class="visible-xs">

                                <a href="#" class="menu-trigger">
                                    <i class="entypo-menu"></i>
                                </a>

                            </div>
                        </nav>

                    </header>

                </div>

            </div>

        </div>
