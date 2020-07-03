@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3">
    <li>
        <a href="{{route('user.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.contact_us')</strong>
    </li>
</ol>

<div class="row">
    @include('partials.messages')

    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.contact_us')</h2>
                    <br>
                    <br>
                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">
                <form action="{{route('user.contactus.store')}}" method="post">
                    @csrf()
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">@lang('site.title')</label>
                        <input id="title" name="title" type="text" class="form-control" placeholder="@lang('site.title')">
                    </div>

                    <div class="form-group">
                        <label for="body" class="control-label mb-1">@lang('site.body')</label>
                        <textarea name="body" class="form-control"></textarea><br>
                    </div>


                    <div>
                        <button id="payment" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i> @lang('site.create')
                        </button>
                    </div>
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
