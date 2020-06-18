@extends('back.base_layouts.app')

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="member-entry">

            <a href="#" class="member-img">
            <img src="{{$shop->getImage()}}" alt="image" class="img-rounded">
            </a>
            <div class="member-details">
                <h4>{{$shop->name}}</h4>
                <div class="row info-list">
                    <div class="col-sm-4"> <i class="entypo-briefcase"></i>
                    {{$shop->user->first_name.' '.$shop->user->last_name}}
                        <a href="#"></a>
                    </div>


                    <div class="col-sm-4"> <i class="entypo-twitter"></i> <a href="#">@isset($shop->twitter)
                        $shop->twitter
                      @endisset</a> </div>
                    <div class="col-sm-4"> <i class="entypo-facebook"></i> <a href="#">@isset($shop->facebook)
                        $shop->facebook
                      @endisset</a> </div>
               <div class="clear"></div>
                    <div class="col-sm-4"> <i class="entypo-location"></i> {{$shop->address}} </div>
                    <div class="col-sm-4"> <i class="entypo-mail"></i> {{$shop->email}} </div>
                    {{-- <div class="col-sm-4"> <i class="entypo-linkedin"></i> <a href="#">johnkennedy</a> </div> --}}
                </div>
            </div>
        </div>


        <hr>
        <a href="{{route('admin.shop_invoices.index',$shop->id)}}" class="btn-lg btn-green">@lang('site.show_invoices')</a>
        <br><br>

      <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title"><h3>@lang('site.shop_info')</h3></div>
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
                                    <li style="font-size:15px" class="list-group-item active"> @lang('site.shop_info')
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.name'):</div>{{$shop->name}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.address'):</div>{{$shop->address}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.telephone_number'):</div>{{$shop->telephone_number}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.email'):</div>{{$shop->email}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.website'):</div>{{$shop->website}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.facebook'):</div>{{$shop->facebook}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.twitter'):</div>{{$shop->twitter}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.instagram'):</div>{{$shop->instagram}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"><div style="font-size:15px" class="label label-default"> @lang('site.snapchat'):</div> {{$shop->snapchat}}
                                    </li>



                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
      </div>


        <div class="col-sm-6">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><h3>@lang('site.workers')</h3></div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body with-table"><table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.role')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($shop->workers as $index=>$user)
                                @if ($index==6)
                                    @break
                                @endif
                        <tr>
                            <td>{{++$index}}</td>
                            <td><img src="{{$user->getImage()}}" width="54px" height="54px" alt="image" class="img-rounded"></td>
                            <td>{{$user->first_name.' '.$user->last_name}}</td>
                            <td>
                                @if(count($user->roles()->get()) >0)
                                <ul style="margin-left: 20px">
                                   @foreach ($user->roles()->get() as $role )
                                    <li>{{$role->name}}</li>
                                   @endforeach
                                </ul>
                                @endif
                            </td>

                            <td>
                                <a href="{{route('profile.show',$user->id)}}" class="btn btn-info">@lang('site.show')</a>

                            </td>
                        </tr>
                        @endforeach




                    </tbody>
                </table></div>
            </div>

        </div>
    </div>


        {{-- products --}}
        @if(count($shop_products) >0)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title"><h1>@lang('site.shop_products')</h1></div>
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
                        @foreach($shop_products as $product)
                        <div class="member-entry">

                            <a href="extra-timeline.html" class="member-img">
                            <img src="{{$product->product->getImage()}}" alt="image" class="img-rounded">
                            </a>

                            <div class="member-details">
                                <h4>{{$product->name}}</h4>
                                <div class="row info-list">
                                    <div style="font-weight:bold; color:black;" class="col-sm-4"> <i class="entypo-vcard"></i> @lang('site.barcode'):{{$product->product->barcode}}</div>
                                    <div style="font-weight:bold; color:black;" class="col-sm-4"> <i class="entypo-tag"></i>@lang('site.category'): {{$product->product->category->name}} </div>
                                    <div style="font-weight:bold; color:black;" class="col-sm-4"> <i class="entypo-credit-card"></i> @lang('site.price_to_sell'):{{$product->product->price_to_sell}}</div>
                                    <div style="font-weight:bold; color:black;" class="col-sm-4"> <i class="entypo-credit-card"></i> @lang('site.price_to_buy'):{{$product->product->price_to_buy}}</div>
                                    <div style="font-weight:bold; color:black;" class="col-sm-4"> <i class="entypo-basket"></i>  @lang('site.quantity'):{{$product->quantity}}</div>
                                </div>
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
