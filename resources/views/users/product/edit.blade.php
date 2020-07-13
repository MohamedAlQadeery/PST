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
    <a href="{{route('user.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li>
        <a href="{{route('user.products.index')}}"><i class="fa-home"></i>@lang('site.products')</a>

    </li>
    <li class="active">

        <strong>@lang('site.edit_product')</strong>
    </li>
</ol>
@include('partials.messages')

@if($product->user_id==auth()->user()->id)



<div class="row">

    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>@lang('site.edit_product')</h2><br>

                </div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body">

    <form action="{{route('user.products.update',$product->id)}}" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
        @csrf()
        @method('patch')


        <div class="form-group">

            <label class="col-sm-3 control-label">@lang('site.image_upload')</label>

            <div class="col-sm-5">

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                        <img src="{{$product->getImage()}}" alt="image">
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
                    <input  name="name" value="{{$product->name}}" type="text" class="form-control" placeholder="@lang('site.name')"> </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">@lang('site.description')</label>
            <div class="col-sm-5">
                    <textarea name="description" class="form-control">
                    {!!$product->description!!}
                    </textarea><br>


                <br>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label">@lang('site.barcode')</label>
            <div class="col-sm-5">
                <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-vcard"></i></span>
                    <input  name="barcode" value="{{$product->barcode}}"  type="text" class="form-control" placeholder="@lang('site.barcode')"> </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">@lang('site.price_to_sell')</label>
            <div class="col-sm-5">
                <div class="input-group"> <span class="input-group-addon">₪</span>
                    <input type="text" value="{{$product->price_to_sell}}" name="price_to_sell" class="form-control"  placeholder="@lang('site.price_to_sell')"> <span class="input-group-addon">.00</span> </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label">@lang('site.price_to_buy')</label>
            <div class="col-sm-5">
                <div class="input-group"> <span class="input-group-addon">₪</span>
                    <input type="text" value="{{$product->price_to_buy}}" name="price_to_buy" class="form-control"  placeholder="@lang('site.price_to_buy')"> <span class="input-group-addon">.00</span> </div>
            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-3 control-label">@lang('site.quantity')</label>
            <div class="col-sm-5">
                <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-bag"></i></span>
                    <input  name="quantity"  value="{{$product->quantity}}" type="text" class="form-control" placeholder="@lang('site.quantity')"> </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">@lang('site.category')</label>
            <div class="col-sm-5">
                <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-tag"></i></span>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                           <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                   </select>
                </div>
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

@endif


@if (auth()->user()->type==1)

<div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <h2>@lang('site.edit_shop_product')</h2><br>

            </div>
            <div class="panel-options">
                <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                 <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                  <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
        </div>
        <div class="panel-body">

<form action="{{route('user.shopproducts.update',$product->id)}}" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
    @csrf()
    @method('patch')




    <div class="form-group">
        <label class="col-sm-3 control-label">@lang('site.quantity')</label>
        <div class="col-sm-5">
            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-bag"></i></span>
                <input  name="quantity" type="text" class="form-control" placeholder="@lang('site.quantity')"> </div>
            <br>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label">@lang('site.price')</label>
        <div class="col-sm-5">
            <div class="input-group"> <span class="input-group-addon">₪</span>
                <input type="text"  name="price" class="form-control"  placeholder="@lang('site.price_to_sell')"> <span class="input-group-addon">.00</span> </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">@lang('site.status')</label>
        <div class="col-sm-5">
            <div class="input-group minimal"> <span class="input-group-addon"><i class="entypo-eye"></i></span>
                <select name="status" class="form-control">
                    <option selected disabled>@lang('site.choose_status')</option>
                    <option value="0">@lang('site.not_available')</option>
                     <option value="1">@lang('site.available')</option>

            </select>
            </div>
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
@endif



@endsection



@section('script')

<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
<script>
  var route_prefix = "/filemanager";
  var base_url = "{{url('/')}}";

  $('textarea[name=description]').ckeditor({
    height: 100,
    filebrowserImageBrowseUrl:base_url+route_prefix + '?type=Images',
    filebrowserImageUploadUrl:base_url+route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl:base_url+ route_prefix + '?type=Files',
    filebrowserUploadUrl: base_url+route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

@endsection

