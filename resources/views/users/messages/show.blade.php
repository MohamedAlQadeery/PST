@extends('back.base_layouts.app')


@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li>
        <a href="{{route('messages.index')}}"><i class="fa-home"></i>@lang('site.messages')</a>
        </li>

    <li class="active">

        <strong>{{$message->title}}</strong>
    </li>
</ol>

@include('partials.messages')



<div class="mail-env">

    <!-- compose new email button -->
    <div class="mail-sidebar-row visible-xs">
        <a href="{{route('messages.create')}}" class="btn btn-success btn-icon btn-block">
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



                <form action="{{route('messages.destroy',$message->id)}}" method="post" style="display: inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this message?');">
                  @csrf()
                  @method('DELETE')
              <button class="btn btn-default" ><i class="entypo-trash"></i></button>
              </form>


                <a href="#form" class="btn btn-primary btn-icon">
                    @lang('site.replay')
                    <i class="entypo-reply"></i>
                </a>

            </div>
        </div>

        <div class="mail-info">

            <div class="mail-sender dropdown">
                <span>{{$message->from->first_name.' '. $message->from->last_name}}</span> @lang('site.to')
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{$message->user->getImage()}}" class="img-circle" width="30" />
                    <span>{{$message->user->first_name.' '.$message->user->last_name}}</span>
                    {{$message->user->email}}
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
                {!!$message->body!!}
            </p>
        </div>



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
                        <img src="{{$replay->from->getImage()}}" class="img-circle" width="30" />
                        <span>{{$replay->from->first_name.' '.$replay->from->last_name}}</span>

                    </a>

                </div>


                @if(auth()->user()->id ==$replay->from->id)

                <form action="{{route('messages.destroy',$replay->id)}}" method="post" style="display: inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this message?');">
                  @csrf()
                  @method('DELETE')
              <button class="btn btn-danger " ><i class="entypo-trash"></i></button>
              </form>


                @endif




                <div class="mail-date">
                    {{$replay->created_at}}
                </div>

            </div>

            <div class="mail-text">

                <p>
                    {!!$replay->body!!}
                </p>
            </div>


        @endforeach
        @endif

        <br><hr>
        <h2>@lang('site.replay')</h2>

        <div class="mail-compose">

            <form id="form" method="post" role="form" action="{{route('messages.store')}}">
                @csrf

                <textarea name="body" class="form-control"></textarea><br>
                <input type="hidden" name="replay" value="1">
                <input type="hidden" name="parent_id" value="{{$message->id}}">

                <button class="btn btn-success btn-icon pull-right">
                    @lang('site.send')
                    <i class="entypo-mail"></i>
                </button>

            </form>

        </div>

    </div>


    <div class="mail-sidebar">

        <div class="mail-sidebar-row hidden-xs">
            <a href="{{route('messages.create')}}" class="btn btn-success btn-icon btn-block">
                @lang('site.compose')
                <i class="entypo-pencil"></i>
            </a>
        </div>

        <!-- menu -->
        <ul class="mail-menu">
            <li class="active">
                <a href="{{route('messages.index')}}">
                    <span class="badge badge-danger pull-right">{{$inbox_messages_count}}</span>
                    @lang('site.inbox')
                </a>
            </li>

            <li >
                <a href="{{route('messages.sentIndex')}}">
                    <span class="badge badge-danger pull-right">{{$sent_messages_count}}</span>
                    @lang('site.sent')
                </a>
            </li>


        </ul>

        <div class="mail-distancer"></div>


    </div>
</div>



@endsection

@section('script')

<!-- Imported scripts on this page -->
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-mail.js"></script>
    <script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-chat.js"></script>


    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
  <script>
    var route_prefix = "/filemanager";
    var base_url = "{{url('/')}}";

    $('textarea[name=body]').ckeditor({
      height: 100,
      filebrowserImageBrowseUrl:base_url+route_prefix + '?type=Images',
      filebrowserImageUploadUrl:base_url+route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl:base_url+ route_prefix + '?type=Files',
      filebrowserUploadUrl: base_url+route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
    });
  </script>


@endsection

