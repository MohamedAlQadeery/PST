@extends('back.base_layouts.app')

@section('content')

<ol class="breadcrumb bc-3">
    <li>
        <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.settings')</strong>
    </li>
</ol>

<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="" novalidate="novalidate">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        General Settings
                    </div>
                    <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Site title</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="field-1" value="Neon" aria-invalid="false"> </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Select Skin</label>
                        <div class="col-sm-5">
                            <select class="form-control">
                                <option><a href="https://demo.neontheme.com/skins/white/"><span class="title">White Skin</span></a> </option>
                                <option>asasas</option>
                                <option>asasas</option>
                            </select>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        settings
                    </div>
                    <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> </div>
                </div>
                <div class="panel-body">
                    <label class="col-sm-5 control-label">Select Language</label>

                    <div class="col-md-6 col-sm-4 ">
                        <ul class="list-inline links-list pull-right">
                            <li class="dropdown language-selector">
                                Language:{{app()->getLocale()}} &nbsp;
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">

                                    <img src={{app()->getLocale()=='en'? url('/neon-theme/html/neon/assets/images/flags/flag-uk.png') :url('/neon-theme/html/neon/assets/images/flags/flag-ar.png') }} style="border-radius:15px" width="16" height="16">

                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{route('local.change',['lang'=>'ar'])}}"> <img style="border-radius:15px" src="{{ url('/neon-theme/html/neon/assets/images/flags/flag-ar.png')}}" width="16" height="16"> <span>Arabic</span> </a>
                                    </li>
                                    <li class="active">
                                        <a href="{{route('local.change',['lang'=>'en'])}}"> <img src="{{url('/neon-theme/html/neon/assets/images/flags/flag-uk.png')}}" width="16" height="16"> <span>English</span> </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group default-padding">
        <button type="submit" class="btn btn-success">Save Changes</button>
        <button type="reset" class="btn">Reset Previous</button>
    </div>
</form>

@endsection

@section('script')
@endsection
