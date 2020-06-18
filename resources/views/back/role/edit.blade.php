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
    <li>
        <a href="{{route('admin.role.index')}}"><i class="fa-home"></i>@lang('site.roles')</a>

    </li>
    <li class="active">

        <strong>@lang('site.edit_role')</strong>
    </li>
</ol>

<div class="row">
    @include('partials.messages')

    <div class="col-md-8">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.edit_role')</h2>
                    <br>
                    <br>
                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">
                <form action="{{route('admin.role.update',$role->id)}}" method="post">
                    @csrf() @method('patch')
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">@lang('site.name')</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="@lang('site.role_name')" value="{{$role->name}}">
                    </div>
                    <div class="form-group">
                        <label class="control-lable mb-1">@lang('site.permissions')</label>
                        <select name="permissions[]" data-placeholder="@lang('site.select_permissions')" class="form-control myselect" multiple>
                            @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}" {{in_array($permission->id,$selectedPermissions) ? 'selected':''}}>{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button id="payment" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i> @lang('site.update')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    @endsection
