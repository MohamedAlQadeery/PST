@extends('back.base_layouts.app')

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="member-entry">

            <a href="#" class="member-img">
            <img src="{{$product->getImage()}}" alt="image" class="img-rounded">
            </a>
            <div class="member-details">
                <div style="font-size:25px" class="label label-default">{{$product->name}}</div>
                <div class="row info-list">
                    {{-- <div class="col-sm-4"> <i class="entypo-briefcase"></i>
                    {{$product->user->first_name.' '.$product->user->last_name}}
                        <a href="#"></a>
                    </div> --}}

        
            @if(!count($shop_products) >0)
            <br>
            <br>
            <br>
                <div style="color:red" class="col-sm-4"> <i class="entypo-briefcase"></i> @lang('site.not_in_any_shop')</div>              
            @endif

                </div>
            </div>
        </div>


        <hr>

        <br><br>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title"><h1>@lang('site.product_info')</h1></div>
                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg">
                        <i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                         <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body with-table" style="display: block;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th width="50%">@lang('site.personal_info')</th>
                            <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="padding-lg" colspan="2">
                                <div class="list-group">
                                    <li style="font-size:15px" class="list-group-item active"> @lang('site.product_info')
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.name'): </div>{{$product->name}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.barcode'): </div>{{$product->barcode}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.category'): </div>{{$product->category->name}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.price_to_sell'): </div>{{$product->price_to_sell}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.price_to_buy'): </div>{{$product->price_to_buy}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.quantity'): </div>{{$product->quantity}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.status'): </div>
                                        @if($product->status===1)
                                         <div style="font-size:15px" class="label label-success"> @lang('site.available')</div>
                                        @else
                                        <div style="font-size:15px" class="label label-danger"> @lang('site.not_available')</div>
                                        @endif
                                    </li>
                                    



                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>



        {{-- Shops info --}}
        @if(count($shop_products) >0)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title"><h1>@lang('site.products_shop')</h1></div>
                <div class="panel-options"> <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> </div>
            </div>
            <div class="panel-body with-table" style="display: block;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th width="50%">@lang('site.personal_info')</th>
                            <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        {{-- loop over here  --}}
                        @foreach($shop_products as $shop)
                        <div class="member-entry">

                            <a href="extra-timeline.html" class="member-img">
                            <img src="{{$shop->shop->getImage()}}" alt="image" class="img-rounded">
                            </a>

                            <div class="member-details">
                                <h4>{{$shop->shop->name}}</h4>
                                <div class="row info-list">
                                    <div class="col-sm-4"> <i class="entypo-briefcase"></i>
                                    {{$shop->shop->user->first_name.' '.$shop->shop->user->last_name}}
                                        <a href="#"></a>
                                    </div>                
                                    <div class="col-sm-4"> <i class="entypo-twitter"></i> <a href="#">@isset($shop->shop->twitter)
                                        $shop->shop->twitter
                                      @endisset</a> </div>
                                    <div class="col-sm-4"> <i class="entypo-facebook"></i> <a href="#">@isset($shop->shop->facebook)
                                        $shop->shop->facebook
                                      @endisset</a> </div>
                               <div class="clear"></div>
                                    <div class="col-sm-4"> <i class="entypo-location"></i> {{$shop->shop->address}} </div>
                                    <div class="col-sm-4"> <i class="entypo-mail"></i> {{$shop->shop->email}} </div>
                            </div>
                        </div>
                        @endforeach


                        <div class="row">
                            <button type="button" style="margin-right:30px; margin-bottom:10px" class="btn btn-blue pull-right">@lang('site.show_all')</button>
                        </div>

                    </tbody>

                </table>
            </div>
        </div>
@endif

    </div>
</div>

@endsection


@section('script')
{{--
@if(app()->getLocale()=='en')

<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/js/datatables/datatables.css">
<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="{{asset('neon-theme/html/neon')}}/assets/js/select2/select2.css">

<!-- Imported scripts on this page -->
<script src="{{asset('neon-theme/html/neon')}}/assets/js/datatables/datatables.js"></script>
<script src="{{asset('neon-theme/html/neon')}}/assets/js/select2/select2.min.js"></script>
<script src="{{asset('neon-theme/html/neon')}}/assets/js/neon-chat.js"></script>

@else
<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/datatables/datatables.css">
<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="{{asset('neon-theme/html/neon-rtl')}}/assets/js/select2/select2.css">

<!-- Imported scripts on this page -->
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/datatables/datatables.js"></script>
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/select2/select2.min.js"></script>
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/neon-chat.js"></script>

@endif --}}


@endsection
