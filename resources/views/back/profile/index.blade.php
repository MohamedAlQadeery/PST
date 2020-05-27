@extends('back.base_layouts.app')

@section('content')
@include('partials.messages')

<div class="profile-env">
    <header class="row">
       <div class="col-sm-2"> <a  class="profile-picture"> <img src="{{$user->getImage()}}" width="115px" height="115px" class="img-responsive img-circle"> </a> </div>
       <div class="col-sm-7">
          <ul class="profile-info-sections">
             <li>
             <div class="profile-name"> <strong> <a href="#">{{$user->first_name}} {{$user->last_name}}</a> <a href="#" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
            </strong> <span><a href="#">
               {{$type}}
            </a></span> </div>
             </li>
             {{-- <li>
                <div class="profile-stat">
                   <h3>643</h3>
                   <span><a href="#">followers</a></span>
                </div>
             </li>
             <li>
                <div class="profile-stat">
                   <h3>108</h3>
                   <span><a href="#">following</a></span>
                </div>
             </li> --}}
          </ul>
       </div>
       <div class="col-sm-3">
          <div class="profile-buttons">
              {{-- <a href="#" class="btn btn-default"> <i class="entypo-user-add"></i>
             Follow
             </a> --}}
              <a href="{{route('contactus.index')}}" class="btn btn-default"> <i class="entypo-mail"></i> @lang('site.inbox')</a>
          </div>
       </div>
    </header>
    <section class="profile-info-tabs">
       <div class="row">
          <div class="col-sm-offset-2 col-sm-10">
             <ul class="user-details">
                <li> <a> <i class="entypo-location"></i>
                   {{$user->address}}
                   </a>
                </li>
                <li> <a > <i class="entypo-suitcase"></i>
                @lang('site.work_as') <span>
               {{$type}}
                  </span> </a>
                  </li>
                <li> <a > <i class="entypo-calendar"></i>
                    {{$user->dob}}
                   </a>
                </li>
             </ul>
             <!-- tabs for the profile links -->
             <ul class="nav nav-tabs">
                <li class="active"><a href="{{route('profile.show',$user->id)}}">@lang('site.profile')</a></li>
                @canany(['all','all-shoppermissions'])
            <li><a href="{{route('profile.edit',$user->id)}}">@lang('site.edit') @lang('site.profile')</a></li>
                @endcan
             </ul>
          </div>
       </div>
    </section>

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

                </tbody>
            </table>
        </div>
    </div>




@endsection
