@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('user.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li class="active">

        <strong>@lang('site.'.$page_name)</strong>
    </li>
</ol>

<h2> {{auth()->user()->first_name.' '.auth()->user()->last_name}} @lang('site.transactions')</h2>


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
                    <th>@lang('site.transaction_number')</th>
                    @if(auth()->user()->type===1)
                    <th>@lang('site.provider_name')</th>
                    @else
                    <th>@lang('site.shop_name')</th>
                    @endif
                    <th>@lang('site.status')</th>
                    <th>@lang('site.isDelivered')</th>
                    <th>@lang('site.type')</th>
                    <th>@lang('site.total')</th>
                    <th>@lang('site.date')</th>

					<th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach ($transactions as $index =>$transaction)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$transaction->id}}</td>
                    @if(auth()->user()->type===1)
                    <td>{{$transaction->provider->first_name.' '.$transaction->provider->last_name}}</td>
                    @else
                    <td>{{$transaction->shop->name}}</td>
                    @endif

                    <td>
                        @if($transaction->is_paid === 0)
                        <a class="btn btn-danger">@lang('site.not_paid')</a>
                        @else
                        <a class="btn btn-success">@lang('site.paid')</a>
                        @endif
                    </td>

                    <td>
                        @if($transaction->status === 0)
                        <a class="btn btn-orange"><i class="entypo-hourglass">@lang('site.delivering')</i></a>
                        @else
                        <a class="btn btn-success"><i class="entypo-home">@lang('site.delivered')</i></a>
                        @endif
                    </td>

                    <td>
                        @if($transaction->type === 0)
                        <a class="btn btn-gold">@lang('site.debt')</a>
                        @else
                        <a class="btn btn-success">@lang('site.cash')</a>
                        @endif
                    </td>

                    <td>{{$transaction->created_at->diffForHumans()}}</td>

                    <td>{{$transaction->total}}</td>
                    <td>
                        <a href="{{route('user.transactions.show',$transaction->id)}}" class="btn btn-info">@lang('site.show')</a>



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
