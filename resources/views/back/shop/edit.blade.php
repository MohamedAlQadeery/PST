@extends('back.base_layouts.app')

@section('content')
<script>
    jQuery(document).ready(function() {
        jQuery(".myselect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%",
            @if(app()->getLocale()=='ar')
            rtl:true,
            @endif

        });
    });

</script>


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li class="active">

        <strong>@lang('site.edit_shop')</strong>
    </li>
</ol>

<div class="row">
    @include('partials.messages')

    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.edit_shop')</h2>
                    <br>
                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">

                <form action="{{route('admin.shops.update',$shop->id)}}" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
                    @csrf()
                    @method('patch')

                    <div class="form-group">

                        <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

                        <div class="col-sm-5">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="{{$shop->getImage()}}" alt="image">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                        <span class="fileinput-new">@lang('site.profile_image')</span>
                                    <span class="fileinput-exists">@lang('site.edit')</span>
                                    <input type="file" name="image" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">@lang('site.remove')</a>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input  name="name" value="{{$shop->name}}" type="text" class="form-control" placeholder="@lang('site.name')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.address')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-address"></i></span>
                                <input name="address" value="{{$shop->address}}"  type="text" class="form-control" placeholder="@lang('site.address')"> </div>
                            <br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.email')</label>
                        <div class="col-sm-5">
                            <div class="input-group"> <span class="input-group-addon"><i class="entypo-mail"></i></span>
                                <input name="email" value="{{$shop->email}}" type="text" class="form-control" placeholder="@lang('site.email')"> </div>
                            <br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.telephone_number')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-mobile"></i></span>
                                <input  name="telephone_number" value="{{$shop->telephone_number}}" type="text" class="form-control" placeholder="@lang('site.telephone_number')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.facebook')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="facebook" value="{{$shop->facebook}}"  type="text" class="form-control datepicker" placeholder="@lang('site.facebook')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.twitter')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="twitter" value="{{$shop->twitter}}"  type="text" class="form-control datepicker" placeholder="@lang('site.twitter')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.snapchat')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="snapchat" value="{{$shop->snapchat}}"  type="text" class="form-control datepicker" placeholder="@lang('site.snapchat')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.instagram')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="instagram" value="{{$shop->instagram}}"  type="text" class="form-control datepicker" placeholder="@lang('site.instagram')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.website')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="website" value="{{$shop->website}}"  type="text" class="form-control datepicker" placeholder="@lang('site.website')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            <br>
                            <button type="submit" class=" btn btn-success btn-lg">
                                <i class="fa fa-lock fa-lg"></i> @lang('site.update')
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>



@endsection


