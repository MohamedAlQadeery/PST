@extends('back.base_layouts.app')

@section('content')


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('admin.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li class="active">

        <strong>@lang('site.'.$page_name)</strong>
    </li>
</ol>

<h2> @lang('site.'.$page_name)</h2>


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
                    <th>@lang('site.provider_name')</th>
                    <th>@lang('site.shop_name')</th>
                    <th>@lang('site.status')</th>
                    <th>@lang('site.isDelivered')</th>
                    <th>@lang('site.type')</th>
                    <th>@lang('site.total')</th>
					<th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach ($transactions as $index =>$transaction)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$transaction->id}}</td>
                    <td>{{$transaction->provider->first_name.' '.$transaction->provider->last_name}}</td>
                    <td>{{$transaction->shop->name}}</td>

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

                    <td>{{$transaction->total}}</td>
                    <td>
                        <a href="{{route('admin.transactions.show',$transaction->id)}}" class="btn btn-info">@lang('site.show')</a>

                        @canany(['all','delete-transaction'])
                        <form action="{{route('admin.transactions.destroy',$transaction->id)}}" method="post" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf()
                            @method('DELETE')
                        <button  class="btn btn-danger"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                        </form>
                        @else
                        <button  class="btn btn-danger" disabled><i class="fa fa-trash"></i>@lang('site.delete')</button>

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
