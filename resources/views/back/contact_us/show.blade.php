@extends('back.base_layouts.app')


@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li>
        <a href="{{route('contactus.index')}}"><i class="fa-home"></i>@lang('site.contact_us')</a>
        </li>

    <li class="active">

        <strong>{{$message->title}}</strong>
    </li>
</ol>


<div class="mail-env">

    <!-- compose new email button -->
    <div class="mail-sidebar-row visible-xs">
        <a href="mailbox-compose.html" class="btn btn-success btn-icon btn-block">
            @lang('site.compose')
            <i class="entypo-pencil"></i>
        </a>
    </div>


    <!-- Mail Body -->
    <div class="mail-body">

        <div class="mail-header">
            <!-- title -->
            <div class="mail-title">
                {{$message->title}}
            </div>


            <!-- links -->
            <div class="mail-links">

                <a href="#" class="btn btn-default">
                    <i class="entypo-print"></i>
                </a>

                <a href="#" class="btn btn-default">
                    <i class="entypo-trash"></i>
                </a>

                <a class="btn btn-primary btn-icon">
                    Reply
                    <i class="entypo-reply"></i>
                </a>

            </div>
        </div>

        <div class="mail-info">

            <div class="mail-sender dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{$message->user->getImage()}}" class="img-circle" width="30" />
                    <span>{{$message->user->first_name.' '.$message->user->last_name}}</span>
                    {{$message->user->email}} to <span>me</span>
                </a>

                <ul class="dropdown-menu dropdown-red">

                    <li>
                        <a href="#">
                            <i class="entypo-user"></i>
                            Add to Contacts
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="entypo-menu"></i>
                            Show other messages
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <i class="entypo-star"></i>
                            Star this message
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="entypo-reply"></i>
                            Reply
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="entypo-right"></i>
                            Forward
                        </a>
                    </li>
                </ul>

            </div>

            <div class="mail-date">
                {{$message->created_at}}
            </div>

        </div>

        <div class="mail-text">

            <p>
                {{$message->body}}
            </p>
        </div>

       @if (!is_null($message->image))
       <div class="mail-attachments">

        <h4>
            <i class="entypo-attach"></i>@lang('site.attachments')</span>
        </h4>

        <ul>
            <li>
                <a href="#" class="thumb">
                    <img src="{{$message->getImage()}}" class="img-rounded" />
                </a>

            </li>

              </ul>

    </div>
       @endif

        <div class="mail-reply">

            <div class="fake-form">
                <div>
                    <a href="mailbox-compose.html">@lang('site.replay')</a>
                </div>
            </div>

        </div>

    </div>

    <div class="mail-sidebar">

        <!-- compose new email button -->
        <div class="mail-sidebar-row hidden-xs">
            <a href="mailbox-compose.html" class="btn btn-success btn-icon btn-block">
                @lang('site.compose')
                <i class="entypo-pencil"></i>
            </a>
        </div>

        <!-- menu -->
        <ul class="mail-menu">
            <li class="active">
                <a href="#">
                    <span class="badge badge-danger pull-right">{{$count_messages}}</span>
                    @lang('site.inbox')
                </a>
            </li>


        </ul>

        <div class="mail-distancer"></div>


    </div>


@endsection


@section('script')

<!-- Imported scripts on this page -->
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-mail.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-chat.js"></script>

@endsection
