@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3">
    <li>
        <a href="{{route('user.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li>
        <a href="{{route('user.contactus.index')}}"><i class="fa-home"></i>@lang('site.contact_us')</a>
        </li>

    <li class="active">

        <strong>{{$message->title}}</strong>
    </li>
</ol>
@include('partials.messages')


<div class="col-md-12">
    <div class="mail-env ">



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



                    <form action="{{route('user.contactus.destroy',$message->id)}}" method="post" style="display: inline-block"
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


                <div class="mail-sender">
                   <span> {{$message->user->first_name.' '.$message->user->last_name}}</span>
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






            @if(!is_null($message->replies))
            @foreach ($message->replies as $replay )



                <div class="mail-info">

                    <div class="mail-sender dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           @if (auth()->user()->id !=$replay->user_id)
                           <span>@lang('site.admin')</span>
                           @else
                           <span>{{$replay->user->first_name.' '.$replay->user->last_name}}</span>
                           @endif

                        </a>

                    </div>

                    {{-- check if the auth user is the one who created the message --}}

                    @if(auth()->user()->id ==$replay->user_id)

                    <form action="{{route('user.contactus.destroy',$replay->id)}}" method="post" style="display: inline-block"
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

                <form id="form" method="post" role="form" action="{{route('user.contactus.store')}}">
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


    </div>

</div>

@endsection



@section('script')

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
