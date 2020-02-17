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
        <a href="{{route('users.index')}}"><i class="fa-home"></i>@lang('site.shops')</a>

    </li>
    <li class="active">

        <strong>@lang('site.edit_shop')</strong>
    </li>
</ol>

<h2>@lang('site.edit_shop')</h2><br>



<div class="row">
    @include('partials.messages')
    <form action="{{route('shops.update',$shop->id)}}" method="post" enctype="multipart/form-data">
        @csrf()
        @method('patch')
        <div class="col-md-4 pull-right">
            <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

            <div class="col-sm-5">

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                    <img src="{{$shop->getImage()}}" alt="image">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                        <span class="btn btn-white btn-file">
                            <span class="fileinput-new">@lang('site.shop_image')</span>
                            <span class="fileinput-exists">@lang('site.edit')</span>
                            <input type="file" name="image" accept="image/*">
                        </span>
                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">@lang('site.remove')</a>
                    </div>
                </div>

            </div>

        </div>
          <div class="form-group col-md-8">
              <label for="name" class="control-label">@lang('site.name')</label>
              <input id="name" name="name" type="text" class="form-control" placeholder="@lang('site.shop_name')" value="{{$shop->name}}">
          </div>

          <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.address')</label>
            <input id="name" name="address" type="text" class="form-control" placeholder="@lang('site.address')"  value="{{$shop->address}} ">
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.email')</label>
            <input id="name" name="email" type="text" class="form-control" placeholder="@lang('site.email')"  value="{{$shop->email}}">
        </div>


        <div class="form-group col-md-8">
            <label for="telephone_number" class="control-label">@lang('site.telephone_number')</label>
            <input id="telephone_number" name="telephone_number" type="text" class="form-control" placeholder="@lang('site.telephone_number')"  value="{{$shop->telephone_number}} ">
        </div>


        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.facebook')</label>
            <input id="name" name="facebook" type="text" class="form-control" placeholder="@lang('site.facebook')"  value="{{$shop->facebook}}">
        </div>

        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.twitter')</label>
            <input id="name" name="twitter" type="text" class="form-control" placeholder="@lang('site.twitter')"  value="{{$shop->twitter}}">
        </div>
        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.snapchat')</label>
            <input id="name" name="snapchat" type="text" class="form-control" placeholder="@lang('site.snapchat')"  value="{{$shop->snapchat}}">
        </div>
        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.instagram')</label>
            <input id="name" name="instagram" type="text" class="form-control" placeholder="@lang('site.instagram')"  value="{{$shop->instagram}}">
        </div>
        <div class="form-group col-md-8">
            <label for="name" class="control-label">@lang('site.website')</label>
            <input id="name" name="website" type="text" class="form-control" placeholder="@lang('site.website')"  value="{{$shop->website}}">
        </div>




          <button  type="submit" class="btn btn-lg btn-info btn-block" >
            <i class="fa fa-lock fa-lg"></i>
            @lang('site.update')
        </button>

      </form>
</div>





@endsection


