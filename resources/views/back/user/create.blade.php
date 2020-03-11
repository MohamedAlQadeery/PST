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
        <a href="{{route('users.index')}}"><i class="fa-home"></i>@lang('site.users')</a>

    </li>
    <li class="active">

        <strong>@lang('site.create_user')</strong>
    </li>
</ol>




<div class="row">
    @include('partials.messages')

    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.create_user')</h2>
                    <br>
                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">

            <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
                    @csrf() 
                    

                    <div class="form-group">

                        <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

                        <div class="col-sm-5">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/200x150" alt="...">
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
                                <input  name="first_name"  type="text" class="form-control" placeholder="@lang('site.first_name')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.second_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input  name="second_name"  type="text" class="form-control" placeholder="@lang('site.second_name')"> </div>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.third_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input name="third_name"   type="text" class="form-control" placeholder="@lang('site.third_name')"> </div>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.last_name')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input  name="last_name"  type="text" class="form-control" placeholder="@lang('site.last_name')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.email')</label>
                        <div class="col-sm-5">
                            <div class="input-group"> <span class="input-group-addon"><i class="entypo-mail"></i></span>
                                <input name="email"  type="text" class="form-control" placeholder="@lang('site.email')"> </div>
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
                                <input  name="mobile_number"  type="text" class="form-control" placeholder="@lang('site.mobile_number')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.dob')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input name="dob"   type="text" class="form-control datepicker" placeholder="@lang('site.dob')"> </div>

                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.age')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input  name="age"  type="text" class="form-control" placeholder="@lang('site.age')"> </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.address')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-address"></i></span>
                                <input name="address"   type="text" class="form-control" placeholder="@lang('site.address')"> </div>
                            <br>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.roles')</label>
                        <div class="col-sm-5">
                            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-users"></i></span>
                                <select name="roles[]"  data-placeholder="@lang('site.roles')"
                                class="form-control myselect" multiple>
                               @foreach ($roles as $role)
                                   <option value="{{$role->id}}">{{$role->name}}</option>
                               @endforeach
                               </select>
                            </div>
                            <br>

                        </div>
                    </div>
                    <br>

                    <div class="col-md-6">
                        <div class="form-group">                      
                        <label class="col-sm-3 control-label">@lang('site.gender')</label>
                        <div class="col-sm-8">

                            <select name="gender"  class="form-control">
                                <option value="#" disabled selected>@lang('site.choose_gender')</option>
                                <option value="1">@lang('site.male')</option>
                                <option value="2">@lang('site.female')</option>
                            </select>

                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="col-sm-3 control-label">@lang('site.type')</label>
                        <div class="col-sm-8">

                            <select name="type"  class="form-control">
                                <option value="#" disabled selected>@lang('site.type')</option>
                                <option value="0">@lang('site.admin')</option>
                                <option value="1">@lang('site.seller')</option>
                                <option value="2">@lang('site.provider')</option>
                
                            </select>
                        </div>
                    </div>
                </div>
              
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            <br>
                            <button type="submit" class=" btn btn-success btn-lg">
                                <i class="fa fa-lock fa-lg"></i> @lang('site.store')
                            </button>
                        </div>
                    </div>
                    

                </form>
            </div>
        </div>
    </div>
</div>




{{-- 
<div class="row">
    @include('partials.messages')
    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
        @csrf()

        <div class="col-md-4 pull-right">
            <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

            <div class="col-sm-5">

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                        <img src="http://placehold.it/200x150" alt="...">
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
          <div class="form-group col-md-8">
              <label for="name" class="control-label">@lang('site.first_name')</label>
              <input id="name" name="first_name" type="text" class="form-control" placeholder="@lang('site.first_name')" >
          </div>

          <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.second_name')</label>
            <input id="name" name="second_name" type="text" class="form-control" placeholder="@lang('site.second_name')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.third_name')</label>
            <input id="name" name="third_name" type="text" class="form-control" placeholder="@lang('site.third_name')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.last_name')</label>
            <input id="name" name="last_name" type="text" class="form-control" placeholder="@lang('site.last_name')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.email')</label>
            <input id="name" name="email" type="text" class="form-control" placeholder="@lang('site.email')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.password')</label>
            <input id="name" name="password" type="password" class="form-control" placeholder="@lang('site.password')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.password')</label>
            <input id="name" name="password_confirmation" type="password" class="form-control" placeholder="@lang('site.password_confirmation')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.mobile_number')</label>
            <input id="name" name="mobile_number" type="text" class="form-control" placeholder="@lang('site.mobile_number')" >
        </div>
			<div class="form-group col-md-8 ">
				<label class="control-label">@lang('site.dob')</label>
					<input type="text" name="dob" class="form-control datepicker" data-start-view="1" placeholder="@lang('site.dob')">

			</div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.age')</label>
            <input id="name" name="age" type="text" class="form-control" placeholder="@lang('site.age')" >
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.address')</label>
            <input id="name" name="address" type="text" class="form-control" placeholder="@lang('site.address')" >
        </div>

        <div class="form-group col-md-8">
            <label class="control-lable">@lang('site.roles')</label>
            <select name="roles[]"  data-placeholder="@lang('site.roles')"
             class="form-control myselect" multiple>
            @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
            </select>
                                </div>

                <div>


        <div class="form-group col-md-6">
            <label for="name" class="control-label">@lang('site.gender')</label>

            <select name="gender"  class="form-control">
                <option value="#" disabled selected>@lang('site.choose_gender')</option>
                <option value="1">@lang('site.male')</option>
                <option value="2">@lang('site.female')</option>
            </select>

        </div>

        <div class="form-group col-md-6">
            <label for="name" class="control-label">@lang('site.type')</label>

            <select name="type"  class="form-control">
                <option value="#" disabled selected>@lang('site.type')</option>
                <option value="0">@lang('site.admin')</option>
                <option value="1">@lang('site.seller')</option>
                <option value="2">@lang('site.provider')</option>

            </select>

        </div>

          <button  type="submit" class="btn btn-lg btn-info btn-block" >
            <i class="fa fa-lock fa-lg"></i>
            @lang('site.create')
        </button>

      </form>
</div> --}}





@endsection


