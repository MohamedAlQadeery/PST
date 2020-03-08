@extends('back.base_layouts.app')

@section('content')

<ol class="breadcrumb bc-3  noPrint" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.invoice')</strong>
    </li>
</ol>

<div class="invoice">

    <div class="row">

        <div class="col-sm-6 invoice-left">

            <a href="#">
                <img src="{{asset('neon-theme/html/neon-rtl')}}/assets/images/laborator@2x.png" width="185" alt="" />
            </a>

        </div>

        <div class="col-sm-6 invoice-right">
                <h3> @lang('site.invoice_number') : {{$invoice->id}}</h3>
                <h5>{{$invoice_date}}</h5>
        </div>

    </div>


    <hr class="margin" />


    <div class="row">


        <div class="col-sm-3 invoice-left">

            <h4>@lang('site.shop_info')</h4>
            {{$invoice->shop->name}}
            <br />
            {{$invoice->shop->address}}
            <br />

        </div>

    </div>

    <div class="margin"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th width="60%">@lang('site.product')</th>
                <th>@lang('site.quantity')</th>
                <th>@lang('site.price')</th>
                <th>@lang('site.total')</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($invoice->items as $index=> $item)
            <tr>
                <td class="text-center">{{++$index}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->product->price_to_sell}}</td>

                <td class="text-right">{{$item->price}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>

    <div class="margin"></div>

    <div class="row">


        <div class="col-sm-6">

            <div class="invoice-left">

                <ul class="list-unstyled">
                    <li>
                       @lang('site.total') :
                        <strong>{{$invoice->total}}</strong>
                    </li>

                </ul>

                <br />


            </div>

        </div>

        <div class="col-sm-6">
            <div class="invoice_right ">

                <a href="javascript:window.print();" class="btn btn-primary btn-icon icon-left hidden-print pull-right">
                    @lang('site.print_invoice')
                    <i class="entypo-doc-text"></i>
                </a>

                &nbsp;

            </div>
        </div>

    </div>

</div>

@endsection
