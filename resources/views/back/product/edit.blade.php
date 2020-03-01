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
        <a href="{{route('users.index')}}"><i class="fa-home"></i>@lang('site.products')</a>

    </li>
    <li class="active">

        <strong>@lang('site.edit_product')</strong>
    </li>
</ol>

<h2>@lang('site.edit_product')</h2><br>



<div class="row">
    @include('partials.messages')

    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf()
        @method('patch')
        <div class="col-md-4 pull-right">
            <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

            <div class="col-sm-5">

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                    <img src="{{$product->getImage()}}" alt="image">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                    <div>
                        <span class="btn btn-white btn-file">
                            <span class="fileinput-new">@lang('site.product_image')</span>
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
              <input id="name" name="name" type="text" class="form-control" placeholder="@lang('site.product_name')" value="{{$product->name}}">
          </div>

          <div class="form-group col-md-8">
            <label for="barcode" class="control-label">@lang('site.barcode')</label>
            <input id="barcode" name="barcode" type="text" class="form-control" placeholder="@lang('site.barcode')" value="{{$product->barcode}}">
        </div>
        
        <div class="form-group col-md-8">
            <label for="price_to_sell" class="control-label">@lang('site.price_to_sell')</label>
            <input id="price_to_sell" name="price_to_sell" type="number" class="form-control" placeholder="@lang('site.price_to_sell')" value="{{$product->price_to_sell}}">
        </div>

        <div class="form-group col-md-8">
            <label for="price_to_buy" class="control-label">@lang('site.price_to_buy')</label>
            <input id="price_to_buy" name="price_to_buy" type="number" class="form-control" placeholder="@lang('site.price_to_buy')" value="{{$product->price_to_buy}}">
        </div>

       

        <div class="form-group col-md-8">
            <label for="quantity" class="control-label">@lang('site.quantity')</label>
            <input id="quantity" name="quantity" type="number" class="form-control" placeholder="@lang('site.quantity')" value="{{$product->quantity}}">
        </div>

        <div class="form-group col-md-8">
            <label for="category_id" class="control-label">@lang('site.category')</label>
                 <select name="category_id" class="form-control">
                     @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option> 
                     @endforeach
                </select> 
        </div>

        <div class="form-group col-md-8">
            <label for="status" class="control-label">@lang('site.status')</label>
                 <select name="status" class="form-control">
                     @if ($product->status === 1 )
                        <option selected value="1">@lang('site.available')</option> 
                        <option value="0">@lang('site.not_available')</option> 
                    @else 
                         <option value="1">@lang('site.available')</option> 
                         <option selected value="0">@lang('site.not_available')</option> 
                    @endif

                </select> 
        </div>

          <button type="submit" class="btn btn-lg btn-info btn-block" >
            <i class="fa fa-lock fa-lg"></i>
            @lang('site.update')
        </button>

      </form>
</div>





@endsection


