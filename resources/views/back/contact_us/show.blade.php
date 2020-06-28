@extends('back.base_layouts.app')


@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li>
        <a href="{{route('admin.contactus.index')}}"><i class="fa-home"></i>@lang('site.contact_us')</a>
        </li>

    <li class="active">

        <strong>{{$message->title}}</strong>
    </li>
</ol>

@include('partials.messages')



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


                @canany(['all','delete-contactus'])
                <form action="{{route('admin.contactus.destroy',$message->id)}}" method="post" style="display: inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this message?');">
                  @csrf()
                  @method('DELETE')
              <button class="btn btn-danger" ><i class="entypo-trash"></i></button>
              </form>
              @else
              <button class="btn btn-default" disabled ><i class="entypo-trash"></i></button>

              @endcan


                <a href="#form" class="btn btn-primary btn-icon">
                    @lang('site.replay')
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

        {{--  <div class="mail-reply">

            <div class="fake-form">
                <div>
                    <a href="mailbox-compose.html">@lang('site.replay')</a>
                </div>
            </div>

        </div>  --}}



        @if(!is_null($message->replies))
        @foreach ($message->replies as $replay )



            <div class="mail-info">

                <div class="mail-sender dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{$replay->user->getImage()}}" class="img-circle" width="30" />
                        <span>{{$replay->user->first_name.' '.$replay->user->last_name}}</span>
                    </a>

                </div>



                    <form action="{{route('admin.contactus.destroy',$replay->id)}}" method="post" style="display: inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this message?');">
                      @csrf()
                      @method('DELETE')
                  <button class="btn btn-danger " ><i class="entypo-trash"></i></button>
                  </form>






                <div class="mail-date">
                    {{$replay->created_at}}
                </div>

            </div>

            <div class="mail-text">

                <p>
                    {!!$replay->body!!}
                </p>
            </div>

           @if (!is_null($replay->image))
           <div class="mail-attachments">

            <h4>
                <i class="entypo-attach"></i>@lang('site.attachments')</span>
            </h4>

            <ul>
                <li>
                    <a href="#" class="thumb">
                        <img src="{{$replay->getImage()}}" class="img-rounded" />
                    </a>

                </li>

                  </ul>

                </div>
        @endif
        @endforeach
        @endif

        <br><hr>
        <h2>@lang('site.replay')</h2>
        @canany(['all','create-contactus'])
        <div class="mail-compose">

            <form id="form" method="post" role="form" action="{{route('admin.contactus.store',$message->id)}}">
                @csrf

                <div class="compose-message-editor">
                    <textarea name="body" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css"  id="sample_wysiwyg"></textarea>
                </div><br>

                <button class="btn btn-success btn-icon pull-right">
                    @lang('site.send')
                    <i class="entypo-mail"></i>
                </button>

            </form>

        </div>
        @else
        <h2> <span class="label label-danger">@lang('site.no_permission')</span></h2>
@endcan
    </div>

    <div class="mail-sidebar">

        {{--  <!-- compose new email button -->
        <div class="mail-sidebar-row hidden-xs">
            <a href="mailbox-compose.html" class="btn btn-success btn-icon btn-block">
                @lang('site.compose')
                <i class="entypo-pencil"></i>
            </a>
        </div>  --}}

        <!-- menu -->
        <ul class="mail-menu">
            <li class="active">
                <a href="{{route('admin.contactus.index')}}">
                    <span class="badge badge-danger pull-right">{{$count_messages}}</span>
                    @lang('site.inbox')
                </a>
            </li>


        </ul>

        <div class="mail-distancer"></div>


    </div>


@endsection


@section('script')

<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/wysihtml5/bootstrap-wysihtml5.css">
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>

	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-mail.js"></script>
    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-chat.js"></script>


@endsection
