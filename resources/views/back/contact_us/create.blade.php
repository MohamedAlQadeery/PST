@extends('back.base_layouts.app')


@section('content')




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
                Compose Mail <i class="entypo-pencil"></i>
            </div>

            <!-- links -->
            <div class="mail-links">

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

            </div>
        </div>


        <div class="mail-compose">

            <form method="post" role="form">

                <div class="form-group">
                    <label for="to">To:</label>
                    <input type="text" class="form-control" id="to" tabindex="1" />

                    <div class="field-options">
                        <a href="javascript:;" onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();">CC</a>
                        <a href="javascript:;" onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();">BCC</a>
                    </div>
                </div>

                <div class="form-group hidden">
                    <label for="cc">CC:</label>
                    <input type="text" class="form-control" id="cc" tabindex="2" />
                </div>

                <div class="form-group hidden">
                    <label for="bcc">BCC:</label>
                    <input type="text" class="form-control" id="bcc" tabindex="2" />
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" tabindex="1" />
                </div>


                <div class="compose-message-editor">
                    <textarea class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="sample_wysiwyg" id="sample_wysiwyg"></textarea>
                </div>

            </form>

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
                {{--  <span class="badge badge-danger pull-right">{{$count_messages}}</span>  --}}
                @lang('site.inbox')
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

@endsection
