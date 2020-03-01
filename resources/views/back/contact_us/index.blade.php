@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.'.$page_name)</strong>
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
            <h3 class="mail-title">
                @lang('site.inbox')
                <span class="count">{{count($messages)}}</span>
            </h3>

            <!-- search -->
            <form method="get" role="form" class="mail-search">
                <div class="input-group">
                    <input type="text" class="form-control" name="s" placeholder="Search for mail..." />

                    <div class="input-group-addon">
                        <i class="entypo-search"></i>
                    </div>
                </div>
            </form>
        </div>


        <!-- mail table -->
        <table class="table mail-table">
            <!-- mail table header -->
            <thead>
                <tr>

                    <th colspan="4">


                        <div class="mail-pagination" colspan="2">


                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a>
                                <a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>

            <!-- email list -->
            <tbody>

                @if(count($messages) >0)
                @foreach ($messages as $message)
                <tr class="unread"><!-- new email class: unread -->

                    <td class="col-name">
                        <a href="#" class="star stared">
                            <i class="entypo-star"></i>
                        </a>
                        <a href="{{route('contactus.show',$message->id)}}" class="col-name">{{$message->user->first_name.' '.$message->user->last_name}}</a>
                    </td>
                    <td class="col-subject">
                        <a href="{{route('contactus.show',$message->id)}}">
                            {{$message->title}}
                        </a>
                    </td>
                    <td class="col-options">
                      @if (!is_null($message->image))
                      <a href="{{route('contactus.show',$message->id)}}"><i class="entypo-attach"></i></a>
                      @endif
                    </td>
                    <td class="col-time">{{$message->created_at}}</td>
                </tr>
                @endforeach

                @else
                <tr>
                    <th class="col-subject">
                        <span class="bold">@lang('site.no_data')</span>
                    </th>
                </tr>
                @endif





            </tbody>

            <!-- mail table footer -->
            <tfoot>
                <tr>

                    <th colspan="4">

                        <div class="mail-pagination" colspan="2">

                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a>
                                <a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a>
                            </div>
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Sidebar -->
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
                    <span class="badge badge-danger pull-right">{{count($messages)}}</span>
                    @lang('site.inbox')
                </a>
            </li>


        </ul>

        <div class="mail-distancer"></div>


    </div>

</div>

<hr />
<!-- Footer -->
<footer class="main">

    &copy; 2015 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>

</footer>
</div>


@endsection


@section('script')

<!-- Imported scripts on this page -->
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-mail.js"></script>
	<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-chat.js"></script>

@endsection
