@extends('back.base_layouts.app')


@section('content')



@include('partials.messages')

<div class="mail-env">

    <!-- compose new email button -->
    <div class="mail-sidebar-row visible-xs">
        <a href="mailbox-compose.html" class="btn btn-success btn-icon btn-block">
            Compose Mail
            <i class="entypo-pencil"></i>
        </a>
    </div>


    <!-- Mail Body -->
    <div class="mail-body">

        <div class="mail-header">
            <!-- title -->
            <div class="mail-title">
               @lang('site.create_message') <i class="entypo-pencil"></i>
            </div>

            <!-- links -->
            {{-- <div class="mail-links">

                <a href="#" class="btn btn-default">
                    <i class="entypo-cancel"></i>
                </a>

                <a href="#" class="btn btn-default btn-icon">
                    Draft
                    <i class="entypo-tag"></i>
                </a>

                <a class="btn btn-success btn-icon">
                    Send
                    <i class="entypo-mail"></i>
                </a>

            </div> --}}
        </div>


        <div class="mail-compose">

            <form method="post" role="form" action="{{route('user.messages.store')}}">
                @csrf
                <div class="form-group">
                    <label for="to">To:</label>
                    <input type="text" name="to" class="form-control" id="to" tabindex="1" placeholder="@lang('site.email')" />

                    {{-- <div class="field-options">
                        <a href="javascript:;" onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();">CC</a>
                        <a href="javascript:;" onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();">BCC</a>
                    </div> --}}
                </div>

                {{-- <div class="form-group hidden">
                    <label for="cc">CC:</label>
                    <input type="text" class="form-control" id="cc" tabindex="2" />
                </div>

                <div class="form-group hidden">
                    <label for="bcc">BCC:</label>
                    <input type="text" class="form-control" id="bcc" tabindex="2" />
                </div> --}}

                <div class="form-group">
                    <label for="subject">@lang('site.title')</label>
                    <input type="text" name="title" class="form-control" id="subject" tabindex="1" />
                </div>


                <textarea name="body" class="form-control"></textarea><br>

                <button class="btn btn-success btn-icon pull-right">
                    @lang('site.send')
                    <i class="entypo-mail"></i>
                </button>
            </form>

        </div>

    </div>


    <div class="mail-sidebar">

        <div class="mail-sidebar-row hidden-xs">
            <a href="{{route('user.messages.create')}}" class="btn btn-success btn-icon btn-block">
                @lang('site.compose')
                <i class="entypo-pencil"></i>
            </a>
        </div>

        <!-- menu -->
        <ul class="mail-menu">
            <li class="active">
                <a href="{{route('user.messages.index')}}">
                    <span class="badge badge-danger pull-right">{{$inbox_messages_count}}</span>
                    @lang('site.inbox')
                </a>
            </li>

            <li >
                <a href="{{route('user.messages.sentIndex')}}">
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
