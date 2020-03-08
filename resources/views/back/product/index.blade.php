@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.'.$page_name)</strong>
    </li>
</ol>

@include('partials.messages')

<h2>@lang('site.all_products')</h2>


<div class="row">

    <script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-1' );

			// Initialize DataTable
			$table1.DataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    @if(app()->getLocale()=='ar')
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json"
                    @endif
                },
				"bStateSave": true
			});

			// Initalize Select Dropdown after DataTables is created
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
			});
		} );

        // second table id =2
        jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-2' );

			// Initialize DataTable
			$table1.DataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    @if(app()->getLocale()=='ar')
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json"
                    @endif
                },
				"bStateSave": true
			});

			// Initalize Select Dropdown after DataTables is created
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
			});
		} );
		</script>

		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>#</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.barcode')</th>
                    <th>@lang('site.price_to_sell')</th>
                    <th>@lang('site.price_to_buy')</th>
                    <th>@lang('site.category')</th>
                    <th>@lang('site.quantity')</th>
                    <th>@lang('site.status')</th>
                    <th>@lang('site.owner')</th>
                    <th>@lang('site.owner_type')</th>
                    <th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach($products as $index=>$product)
				<tr>
					<td>{{++$index}}</td>
                    <td>{{$product->name}}</td>
                    <td class="center">{{$product->barcode}}</td>
                    <td class="center">{{$product->price_to_sell}}</td>
                    <td class="center">{{$product->price_to_buy}}</td>
                    <td class="center">{{$product->category->name}}</td>
                    <td class="center">{{$product->quantity}}</td>


                  <td class="center">
                    @if ($product->status==1)

                    <a href="{{route('product.status',$product->id)}}" class="btn btn-danger">@lang('site.un_publish')</a>
                    @else
                    <a href="{{route('product.status',$product->id)}}" class="btn btn-success">@lang('site.publish')</a>
                    @endif
                  </td>
                    {{-- @if($product->user) --}}
                    <td><a href="{{route('users.show',$product->user->id)}}">{{$product->user->first_name.' '.$product->user->last_name}}</a></td>
                    @if($product->user->type === 1)
                        <td class="center">@lang('site.a_seller')</td>
                        @elseif($product->user->type === 2)

                         <td class="center">@lang('site.a_provider')</td>
                        @else
                        <td class="center">@lang('site.admin')</td>
                    @endif
                    {{-- @else --}}
                      {{-- <td class="center">@lang('site.none')</td> --}}
                      {{-- <td class="center">@lang('site.none')</td> --}}
                    {{-- @endif --}}





                    <td class="center">
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-gold">@lang('site.edit')</a>

                        <form action="{{route('products.destroy',$product->id)}}" method="post" style="display:inline"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                          @csrf()
                          @method('DELETE')
                      <button  class="btn btn-danger"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                      </form>
                         <a href="{{route('products.show',$product->id)}}" class="btn btn-info">@lang('site.show')</a>
                    </td>


                </tr>

                @endforeach

			</tbody>

        </table>
</div>

<br>

    <h2>@lang('site.all_products_in_shops')</h2>


        <div class="row">


        <table class="table table-bordered datatable" id="table-2">
			<thead>
				<tr>
					<th>#</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.barcode')</th>
                    <th>@lang('site.price_to_sell')</th>
                    <th>@lang('site.price_to_buy')</th>
                    <th>@lang('site.category')</th>
                    <th>@lang('site.quantity')</th>
                    <th>@lang('site.shop')</th>
                    <th>@lang('site.owner')</th>
                    <th>@lang('site.status')</th>
                    <th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach($shop_products as $index=>$shop_product)
				<tr>
					<td>{{++$index}}</td>
                    <td>{{$shop_product->product->name}}</td>
                    <td class="center">{{$shop_product->product->barcode}}</td>
                    <td class="center">{{$shop_product->product->price_to_sell}}</td>
                    <td class="center">{{$shop_product->product->price_to_buy}}</td>
                    <td class="center">{{$shop_product->product->category->name}}</td>
                    <td class="center">{{$shop_product->product->quantity}}</td>
                    <td class="center">{{$shop_product->shop->name}}</td>

                    <td><a href="{{route('users.show',$shop_product->product->user->id)}}">{{$shop_product->product->user->first_name.' '.$shop_product->product->user->last_name}}</a></td>


                    @if($shop_product->product->status === 1)
                        <td class="center">@lang('site.available')</td>
                    @else
                        <td class="center">@lang('site.not_available')</td>
                    @endif




                    <td class="center">
                        <a href="{{route('products.edit',$shop_product->id)}}" class="btn btn-gold">@lang('site.edit')</a>

                        <form action="{{route('products.destroy',$shop_product->id)}}" method="post" style="display:inline"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                          @csrf()
                          @method('DELETE')
                      <button  class="btn btn-danger"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                      </form>
                         <a href="{{route('products.show',$shop_product->id)}}" class="btn btn-info">@lang('site.show')</a>
                    </td>


                </tr>

                @endforeach

			</tbody>

        </table>
    </div>











@endsection


@section('script')

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

@endif


@endsection
