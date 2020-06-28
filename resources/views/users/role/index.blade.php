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

<h2>@lang('site.roles')</h2>


<div class="row">

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
                    <th>@lang('site.name')</th>
                    <th>@lang('site.permissions')</th>
					<th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach ($roles as $index =>$role)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        @if(count($role->permissions()->get()) >0)
                        <ul>
                           @foreach ($role->permissions()->get() as $permission )
                            <li>{{$permission->name}}</li>
                           @endforeach
                        </ul>
                        @endif
                    </td>
                    <td>
                        @canany(['all-shoppermissions','update-shoproles'])
                        <a href="{{route('user.shoprole.edit',$role->id)}}" class="btn btn-info">@lang('site.edit')</a>
                        @else
                        <button class="btn btn-info" disabled>@lang('site.edit')</button>
                        @endcan
                      @canany(['all-shoppermissions','delete-shoproles'])
                      <form action="{{route('user.shoprole.destroy',$role->id)}}" method="post" style="display:inline"
                        onsubmit="return confirm('Are you sure you want to delete this role?');">
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
