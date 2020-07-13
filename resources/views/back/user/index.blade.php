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

<h2>@lang('site.users')</h2>


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
                    <th>@lang('site.image')</th>
                    <th>@lang('site.full_name')</th>
                    <th>@lang('site.email')</th>
                    <th>@lang('site.type')</th>
					<th>@lang('site.gender')</th>
                    <th>@lang('site.address')</th>
					<th>@lang('site.action')</th>


				</tr>
			</thead>
			<tbody>
                @foreach($users as $index=>$user)
				<tr>
                    <td>{{++$index}}</td>
                    <td style="width: 10%">
                        <img src="{{$user->getImage()}}" class="img img-responsive">
                    </td>
					<td>{{$user->first_name.' '.$user->second_name.' '.$user->third_name.' '.$user->last_name}}</td>
					<td>{{$user->email}}</td>
					<td class="center">
                      @if($user->type==1)
                      @lang('site.seller')
                      @elseif($user->type==2)
                        @lang('site.provider')
                        @elseif($user->type==3)
                        @lang('site.subworker')
                        @else
                        @lang('site.admin')
                      @endif
                    </td>

                    <td class="center">
                        @if($user->gender==1)
                        @lang('site.male')
                        @else
                          @lang('site.female')
                        @endif
                      </td>
                    <td class="center">{{$user->address}}</td>
                    <td class="center">
                     @canany(['all','create-user'])
                        <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary">@lang('site.edit')</a>
                    @else
                    <button class="btn btn-primary" disabled>@lang('site.edit')</button>

                        @endcan
                        @canany(['all','destroy-user'])

                        <form action="{{route('admin.users.destroy',$user->id)}}" method="post" style="display:inline"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                          @csrf()
                          @method('DELETE')
                      <button  class="btn btn-danger"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                      </form>
                        @else
                        <button  class="btn btn-danger" disabled><i class="fa fa-trash"></i>@lang('site.delete')</button>

                      @endcan
                        <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-info">@lang('site.show')</a>

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
