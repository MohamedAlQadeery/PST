@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3" >
    <li>
        @if (auth()->user()->type !=0)
        <a href="{{route('user.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
        @else
        <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>

        @endif
    </li>
    @if($shop_name != '')
    <li>
        <a href="{{route('admin.shops.index')}}"><i class="fa-home"></i>@lang('site.shops')</a>
        </li>
    @endif
    <li class="active">

        <strong>@lang('site.'.$page_name)</strong>
    </li>
</ol>

<h2> {{$shop_name}} @lang('site.invoices')</h2>


<div class="row">

    @include('partials.messages')

    <script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-1' );

			// Initialize DataTable
			$table1.DataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    @if(app()->getLocale()=='ar')
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json",
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
                    <th>@lang('site.invoice_number')</th>
                    <th>@lang('site.shop_name')</th>
                    <th>@lang('site.total')</th>
					<th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach ($invoices as $index =>$invoice)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$invoice->id}}</td>
                    <td>{{$invoice->shop->name}}</td>
                    <td>{{$invoice->total}}</td>
                    <td>
                        @php
                        if(auth()->user()->type ==0){
                            $user = "admin.";
                        }else{
                            $user = "user.";

                        }
                        @endphp

                        <a href="{{route($user.'invoices.show',$invoice->id)}}" class="btn btn-info">@lang('site.show')</a>



                    @canany(['all','delete-invoice','delete-shopinvoice','all-shoppermissions'])
                        <form action="{{route($user.'invoices.destroy',$invoice->id)}}" method="post" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                            @csrf()
                            @method('DELETE')
                        <button  class="btn btn-danger"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                        </form>
                        @else
                        <button  class="btn btn-danger" disabled >@lang('site.delete')</button>

                        @endcan
                    </td>
                </tr>
                @endforeach
			</tbody>
			<tfoot>

			</tfoot>
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
