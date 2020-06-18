@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.cashier')</strong>
    </li>
</ol>


<div class="col-md-12">

    <div class="panel panel-primary" data-collapsed="0">

        <div class="panel-heading">
            <div class="panel-title">
               @lang('site.cashier')
            </div>

            <div class="panel-options">
                <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <span>@lang('site.show_shop_info')</span>
            <form role="form" class="form-horizontal form-groups-bordered">

                <br />

                <div class="form-group">
                    <label class="col-sm-3 control-label">@lang('site.shops')</label>

                    <div class="col-sm-5">
                        <select name="shop_id" class="select2" data-allow-clear="true" data-placeholder="@lang('site.choose_shop')">
                            <option></option>
                            {{--  <optgroup label="United States">

                            </optgroup>  --}}
                            @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                            @endforeach
                        </select>


                    </div>
                    <button type="button" class="btn btn-primary shopButton ">
                    @lang('site.show')
                    </button>
                </div>
</div>

@endsection




@section('script')

@if(app()->getLocale()=='en')

<!-- Imported styles on this page -->

<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/js/select2/select2.css">

<!-- Imported scripts on this page -->
<script src="{{asset('neon-theme/html/neon')}}/assets/js/select2/select2.min.js"></script>

@else
<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/select2/select2.css">

<!-- Imported scripts on this page -->
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/select2/select2.min.js"></script>
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-chat.js"></script>

@endif

<script>

$('.shopButton').click(function () {
    var shop_id = $("select[name='shop_id']").val();
    if (shop_id == null) {
        alert('error');
    } else {
        location.href='http://localhost:8000/back/cashier/'+shop_id;

    }
})

</script>




@endsection
