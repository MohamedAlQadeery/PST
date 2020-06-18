@extends('back.base_layouts.app')

@section('content')

<script>
    jQuery(document).ready(function() {
        jQuery(".myselect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%",
            @if(app() -> getLocale() == 'ar')
            rtl: true,
            @endif

        });
    });
</script>

<ol class="breadcrumb bc-3">
    <li>
        <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.create_category')</strong>
    </li>
</ol>

<div class="row">
    @include('partials.messages')

    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.create_category')</h2>
                    <br>
                    <br>
                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">
                <form action="{{route('admin.category.store')}}" method="post">
                    @csrf()
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">@lang('site.name')</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="@lang('site.category_name')">
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
