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
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li>
        <a href="{{route('profile.index')}}"><i class="fa-home"></i>@lang('site.profile')</a>

    </li>
    <li class="active">

        <strong>@lang('site.edit_user')</strong>
    </li>
</ol>

<div class="row">
    @include('partials.messages')

    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.edit_user')</h2>
                    <br>
                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">

                <form action="{{route('profile.update',$user->id)}}" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
                    @csrf() 
                    @method('patch')

                    <div class="form-group">

                        <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

                        <div class="col-sm-5">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="{{$user->getImage()}}" alt="image">
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
                        <label class="col-sm-3 control-label">@lang('site.first_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input  name="first_name" value="{{$user->first_name}}" type="text" class="form-control" placeholder="@lang('site.first_name')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.second_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input  name="second_name" value="{{$user->second_name}}" type="text" class="form-control" placeholder="@lang('site.second_name')"> </div>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.third_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input name="third_name" value="{{$user->third_name}}"  type="text" class="form-control" placeholder="@lang('site.third_name')"> </div>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.last_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input  name="last_name" value="{{$user->last_name}}" type="text" class="form-control" placeholder="@lang('site.last_name')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.email')</label>
                        <div class="col-sm-5">
                            <div class="input-group"> <span class="input-group-addon"><i class="entypo-mail"></i></span>
                                <input name="email" value="{{$user->email}}" type="text" class="form-control" placeholder="@lang('site.email')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.password')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-lock"></i></span>
                                <input name="password"   type="password" class="form-control" placeholder="@lang('site.password')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.password_confirmation')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-lock"></i></span>
                                <input name="password_confirmation"  type="password" class="form-control" placeholder="@lang('site.password_confirmation')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.mobile_number')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-mobile"></i></span>
                                <input  name="mobile_number" value="{{$user->mobile_number}}" type="text" class="form-control" placeholder="@lang('site.mobile_number')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.dob')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="dob" value="{{$user->dob}}"  type="text" class="form-control datepicker" placeholder="@lang('site.dob')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.age')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input  name="age" value="{{$user->age}}" type="text" class="form-control" placeholder="@lang('site.age')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.address')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-address"></i></span>
                                <input name="address" value="{{$user->address}}"  type="text" class="form-control" placeholder="@lang('site.address')"> </div>
                            <br>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.roles')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-users"></i></span>
                            <select name="roles[]" data-placeholder="@lang('site.roles')" class="form-control myselect" multiple>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{in_array($role->id,$selectedRoles) ?'selected':''}}>{{$role->name}}</option>
                                @endforeach
                            </select></div>
                            <br>

                        </div>
                    </div>
                    <br>

                    <div class="col-md-6">
                        <div class="form-group">                      
                        <label class="col-sm-3 control-label">@lang('site.gender')</label>
                        <div class="col-sm-8">

                            <select name="gender" class="form-control">
                                <option value="#" disabled>@lang('site.choose_gender')</option>
                                <option value="1" {{$user->gender =='1'?'selected':''}}>@lang('site.male')</option>
                                <option value="2" {{$user->gender =='1'?'selected':''}}>@lang('site.female')</option>
                            </select>

                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.type')</label>
                        <div class="col-sm-8">

                            <select name="type" class="form-control">
                                <option value="#" disabled>@lang('site.type')</option>
                                <option value="0" {{$user->type =='0'?'selected':''}}>@lang('site.admin')</option>
                                <option value="1" {{$user->type =='1'?'selected':''}}>@lang('site.seller')</option>
                                <option value="2" {{$user->type =='2'?'selected':''}}>@lang('site.provider')</option>

                            </select>
                        </div>
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


