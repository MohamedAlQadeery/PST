<div class="row  noPrint">

    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

        <ul class="user-info pull-left pull-right-xs pull-none-xsm">


            <li class="notifications dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                    <i class="entypo-bell"></i>
                    <span class="badge badge-info">{{count(auth()->user()->unreadNotifications()->get() )}}</span>
                </a>

                <ul class="dropdown-menu">

                    <li>
                        <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: currentcolor none medium;" tabindex="5001">

                          @foreach(auth()->user()->notifications()->get() as $notification)
                            <li class="notification">

                                {{--  contact message notification  --}}
                              @if($notification->type=="App\Notifications\ContactMessage")
                              <a href="{{route('admin.contactus.show',$notification->data['contact_message_id'])}}"
                                   class="mark-as-read" data-id="{{ $notification->id }}">
                                <i class="entypo-comment pull-right"></i>

                                <span class="line">
                                    @if(is_null($notification->read_at))
                                    <strong>{{$notification->data['user_fullname']}} @lang('site.sent_you_message')</strong>
                                    @else
                                    {{$notification->data['user_fullname']}} @lang('site.sent_you_message')

                                     @endif
                                </span>

                                <span class="line small">
                                    {{$notification->created_at->diffForHumans()}}
                                </span>
                            </a>

                              @elseif($notification->type=="App\Notifications\TransactionNotification")
                              <a href="{{route('user.transactions.show',$notification->data['transaction_id'])}}"
                                   class="mark-as-read" data-id="{{ $notification->id }}">
                                <i class="entypo-basket pull-right"></i>

                                <span class="line">
                                    @if(is_null($notification->read_at))
                                    <strong>{{$notification->data['shop_name']}} @lang('site.request_transaction')</strong>
                                    @else
                                    {{$notification->data['shop_name']}} @lang('site.request_transaction')

                                     @endif
                                </span>

                                <span class="line small">
                                    {{$notification->created_at->diffForHumans()}}
                                </span>
                            </a>

                            @elseif($notification->type=="App\Notifications\PaidNotification")
                            <a href="{{route('user.transactions.show',$notification->data['transaction_id'])}}"
                                 class="mark-as-read" data-id="{{ $notification->id }}">
                              <i class="entypo-tag pull-right"></i>

                              <span class="line">
                                  @if(is_null($notification->read_at))
                                  <strong>{{$notification->data['provider_name']}} @lang('site.paid_confirm') {{$notification->data['transaction_id']}}</strong>
                                  @else
                                  {{$notification->data['provider_name']}} @lang('site.paid_confirm')

                                   @endif
                              </span>

                              <span class="line small">
                                  {{$notification->created_at->diffForHumans()}}
                              </span>
                          </a>
                          @elseif($notification->type=="App\Notifications\DeliveredProductNotification")
                          <a href="{{route('user.transactions.show',$notification->data['transaction_id'])}}"
                               class="mark-as-read" data-id="{{ $notification->id }}">
                            <i class="entypo-location pull-right"></i>

                            <span class="line">
                                @if(is_null($notification->read_at))
                                <strong>{{$notification->data['shop_name']}} @lang('site.product_received') {{$notification->data['transaction_id']}}</strong>
                                @else
                                {{$notification->data['shop_name']}} @lang('site.product_received')

                                 @endif
                            </span>

                            <span class="line small">
                                {{$notification->created_at->diffForHumans()}}
                            </span>
                        </a>
                        @elseif($notification->type=="App\Notifications\MessageNotification")
                        <a href="{{route('user.messages.show',$notification->data['message_id'])}}"
                             class="mark-as-read" data-id="{{ $notification->id }}">
                          <i class="entypo-mail pull-right"></i>

                          <span class="line">
                              @if(is_null($notification->read_at))

                              {{-- if its a replay or new message --}}
                                @if ($notification->data['replay'] ==0 )
                                <strong>{{$notification->data['username']}} @lang('site.sent_you_message')</strong>
                                @else
                                <strong>{{$notification->data['username']}} @lang('site.replied_to_message')</strong>
                                @endif

                              @else
                              @if ($notification->data['replay'] ==0 )
                              {{$notification->data['username']}} @lang('site.sent_you_message')
                              @else
                              {{$notification->data['username']}} @lang('site.replied_to_message')
                              @endif

                               @endif
                          </span>

                          <span class="line small">
                              {{$notification->created_at->diffForHumans()}}
                          </span>
                      </a>
                              @endif

                            </li>
                            @endforeach



                        </ul>
                    </li>


                <div id="ascrail2001" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; cursor: default; position: absolute; top: 41.2px; left: 358.8px; height: 290px; display: none; opacity: 0;"><div style="position: relative; top: 0px; float: right; width: 5px; height: 240px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-radius: 1px;"></div></div><div id="ascrail2001-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: 324.2px; left: 0.799988px; position: absolute; cursor: default; display: none; width: 358px; opacity: 0;"><div style="position: relative; top: 0px; height: 5px; width: 368px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-radius: 1px;"></div></div></ul>

            </li>

        </ul>
    </div>
    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">
        <ul class="list-inline links-list pull-right">
            <li class="dropdown language-selector">
                @lang('site.language') :{{app()->getLocale()}} &nbsp;
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">

                <img src={{app()->getLocale()=='en'? url('/neon-theme/html/neon/assets/images/flags/flag-uk.png') :url('/neon-theme/html/neon/assets/images/flags/flag-ar.png') }} style="border-radius:15px" width="16" height="16">

                    </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                    <a href="{{route('local.change',['lang'=>'ar'])}}"> <img style="border-radius:15px" src="{{ url('/neon-theme/html/neon/assets/images/flags/flag-ar.png')}}" width="16" height="16"> <span>Arabic</span> </a>
                    </li>
                    <li class="active">
                        <a href="{{route('local.change',['lang'=>'en'])}}"> <img src="{{url('/neon-theme/html/neon/assets/images/flags/flag-uk.png')}}" width="16" height="16"> <span>English</span> </a>
                    </li>

                </ul>
            </li>
            {{-- <li class="sep"></li>
            <li>
                <a href="#" data-toggle="chat" data-collapse-sidebar="1"> <i class="entypo-chat"></i> Chat
                    <span class="badge badge-success chat-notifications-badge">3</span> </a>
            </li> --}}
            <li class="sep"></li>
            <li>
                <a href="#" style="color: crimson" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    @lang('site.log_out') <i class="entypo-logout right"></i> </a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

</li>
        </ul>
    </div>
</div>

<hr/>

{{-- <script type="text/javascript">
    jQuery(document).ready(function($)
    {
        $('.pie').sparkline('html', {
            type: 'pie',
            borderWidth: 0,
            sliceColors: ['#3d4554', '#ee4749','#00b19d']
        });


        $(".chart").sparkline([1,2,3,1], {
            type: 'pie',
            barColor: '#485671',
            height: '110px',
            barWidth: 10,
            barSpacing: 2});

        var map = $("#map");

        map.vectorMap({
            map: 'europe_merc_en',
            zoomMin: '3',
            backgroundColor: '#00a651',
            focusOn: { x: 0.5, y: 0.8, scale: 3 }
        });



        // Rickshaw
        var seriesData = [ [], [] ];

        var random = new Rickshaw.Fixtures.RandomData(50);

        for (var i = 0; i < 90; i++)
        {
            random.addData(seriesData);
        }

        var graph = new Rickshaw.Graph( {
            element: document.getElementById("rickshaw-chart-demo-2"),
            height: 217,
            renderer: 'area',
            stroke: false,
            preserve: true,
            series: [{
                    color: '#359ade',
                    data: seriesData[0],
                    name: 'Page Views'
                }, {
                    color: '#73c8ff',
                    data: seriesData[1],
                    name: 'Unique Users'
                }, {
                    color: '#e0f2ff',
                    data: seriesData[1],
                    name: 'Bounce Rate'
                }
            ]
        } );

        graph.render();

        var hoverDetail = new Rickshaw.Graph.HoverDetail( {
            graph: graph,
            xFormatter: function(x) {
                return new Date(x * 1000).toString();
            }
        } );

        var legend = new Rickshaw.Graph.Legend( {
            graph: graph,
            element: document.getElementById('rickshaw-legend')
        } );

        var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
            graph: graph,
            legend: legend
        } );

        setInterval( function() {
            random.removeData(seriesData);
            random.addData(seriesData);
            graph.update();

        }, 500 );

    });
    </script> --}}
