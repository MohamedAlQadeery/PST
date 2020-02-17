@extends('back.base_layouts.app')

@section('content')

<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li>
        <a href="{{route('users.index')}}"><i class="fa-home"></i>@lang('site.users')</a>

    </li>
    <li class="active">

        <strong>{{$user->first_name.' '. $user->last_name}}</strong>
    </li>
</ol>

<div class="row">

    <div class="col-md-12">

        <div class="member-entry">

            <a href="extra-timeline.html" class="member-img">
            <img src="{{$user->getImage()}}" class="img-rounded">
            </a>
            <div class="member-details">
                <h4> {{$user->first_name}} {{$user->last_name}} </h4>
                <div class="row info-list">
                    <div class="col-sm-4"> <i class="entypo-briefcase"></i> @lang('site.co_Founder_at'): <a href="#">
                        @if($user->shop)
                        <b>{{$user->shop->name}}</b>
                        @else
                        <b>@lang('site.none')</b>
                        @endif
                    </a> </div>


                      <div class="col-sm-4"> <i class="entypo-twitter"></i> <a href="#">@isset($user->shop->twitter)
                        $user->shop->twitter
                      @endisset</a> </div>
                    <div class="col-sm-4"> <i class="entypo-facebook"></i> <a href="#">@isset($user->shop->facebook)
                        $user->shop->facebook
                      @endisset</a> </div>
                    <div class="clear"></div>
                    <div class="col-sm-4"> <i class="entypo-location"></i> <a href="#">{{$user->address}}</a> </div>
                    <div class="col-sm-4"> <i class="entypo-mail"></i> <a href="#">{{$user->email}}</a> </div>
                    <div class="col-sm-4"> <i class="entypo-linkedin"></i> <a href="#">johnkennedy</a> </div>
                </div>
            </div>
        </div>


        <hr>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title"><h1>@lang('site.user_info')</h1></div>
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
                        <tr>
                            <td class="padding-lg">
                                <div class="list-group">
                                    <li  class="list-group-item active">  @lang('site.personal_info')
                                    </li>
                                    <li style="font-size:15px"  class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.first_name'):</div>  {{$user->first_name}}
                                    </li>
                                    <li style="font-size:15px"   class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.second_name'):</div> {{$user->second_name}}
                                    </li>
                                    <li style="font-size:15px"  class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.third_name'):</div> {{$user->third_name}}
                                    </li>
                                    <li style="font-size:15px"  class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.last_name'):</div> {{$user->last_name}}
                                    </li>
                                    <li style="font-size:15px"  class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.gender'):</div> {{($user->gender=='1'?__('site.male'):__('site.female'))}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.age'):</div> {{$user->age}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default">@lang('site.dob'):</div> {{$user->dob}}
                                    </li>


                                </div>
                            </td>

                            <td class="padding-lg">
                                <div class="list-group">
                                    <li style="font-size:15px" class="list-group-item active">  @lang('site.contact_info')
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.mobile_number'):  </div>{{$user->mobile_number}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.email'): </div> {{$user->email}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.address'):</div> {{$user->address}}
                                    </li>

                                </div>
                            </td>
                        </tr>

                        @if($user->shop)

                        <tr>
                            <td class="padding-lg" colspan="2">
                                <div class="list-group">
                                    <li style="font-size:15px" class="list-group-item active">  @lang('site.shop_info')
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.name'):</div>  {{$user->shop->name}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.address'):</div>  {{$user->shop->address}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.telephone_number'):</div> {{$user->shop->telephone_number}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.email'):</div> {{$user->shop->email}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.website'):</div> {{$user->shop->website}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.facebook'):</div> {{$user->shop->facebook}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.twitter'):</div> {{$user->shop->twitter}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.instagram'):</div> {{$user->shop->instagram}}
                                    </li>
                                    <li style="font-size:15px" class="list-group-item"> <div style="font-size:15px" class="label label-default"> @lang('site.snapchat'):</div> {{$user->shop->snapchat}}
                                    </li>



                                </div>
                            </td>
                        </tr>

                       @endif

                    </tbody>
                </table>
            </div>
        </div>
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
