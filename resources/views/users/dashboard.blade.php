@extends('back.base_layouts.app')

@section('content')


    <div class="row">
        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-picture"></i></div>
                <div class="num" data-start="0" data-end="{{$card1}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>@lang('site.products')</h3>
                <p>@lang('site.provider_products_count')</p>
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num" data-start="0" data-end="{{$card2}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>@lang('site.transactions')</h3>
                <p>@lang('site.provider_transactions_count')</p>
            </div>

        </div>

        <div class="clear visible-xs"></div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-aqua">
                <div class="icon"><i class="entypo-mail"></i></div>
                <div class="num" data-start="0" data-end="{{$card3}}" data-postfix="" data-duration="1500" data-delay="1200">0</div>

                <h3>@lang('site.messages')</h3>
                <p>@lang('site.provider_messages_count')</p>
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-basket"></i></div>
                <div class="num" data-start="0" data-end="{{$card4}}" data-postfix="" data-duration="1500" data-delay="1800">0</div>

                <h3>@lang('site.sold_products')</h3>
                <p>@lang('site.provider_sold_products_count')</p>
            </div>

        </div>
    </div>




    <div class="row">
            <div class="panel panel-primary panel-table">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>@lang('site.topSolledProducts')</h3>
                        <span>@lang('site.sellerTopSolledProducts_desc')</span>
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive no-margin">
                        <thead>
                            <tr>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.buyers_count')</th>
                                <th class="text-center">Graph</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($topSolledProducts as $item)
                            <tr>
                                @if(auth()->user()->type==2)
                                <td>{{$item->name}}</td>
                                @else
                                <td>{{$item->product->name}}</td>

                                @endif
                                <td>{{$item->sell_count}}</td>
                                <td class="text-center"><span class="top-apps">
                                @for ($i = 1; $i < 10; $i++)
                                    {{Arr::random( [1, 2, 3, 4, 5,6,7,8,9])}},
                                @endfor

                                </span></td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>


    </div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">@lang('site.world_map')</div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-3" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <!-- panel body -->
            <div class="panel-body no-padding">
                <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        (function() {
                            var myCustomColors = {
                                {{-- 'GR': '#f04239',
                                'ES': '#f04239',
                                'PT': '#f04239',
                                'SE': '#f04239',
                                'SI': '#f04239',
                                'DK': '#f04239',
                                'DE': '#f04239',
                                'NL': '#f04239',
                                'BE': '#f04239',
                                'LU': '#f04239',
                                'BG': '#f04239',
                                'FR': '#f04239',
                                'GB': '#f04239',
                                'IE': '#f04239',
                                'IT': '#f04239',
                                'HR': '#f04239',
                                'RO': '#f04239',
                                'EE': '#f04239',
                                'LV': '#f04239',
                                'LT': '#f04239',
                                'PL': '#f04239',
                                'AT': '#f04239',
                                'HU': '#f04239',
                                'SK': '#f04239',
                                'CZ': '#f04239',
                                'LT': '#f04239',
                                'FI': '#f04239',
                                'CY': '#f04239', --}}

                                // Arab League
                                 'SA': '#06b53c',
                                 {{--'SO': '#06b53c',
                                'DZ': '#06b53c',--}}
                                'EG': '#06b53c',
                                {{-- 'LY': '#06b53c',
                                'TN': '#06b53c',
                                'YE': '#06b53c',
                                'QA': '#06b53c',
                                'JO': '#06b53c',
                                'KW': '#06b53c',
                                'OM': '#06b53c',
                                'LB': '#06b53c',
                                'SY': '#06b53c', --}}
                                'PS': '#06b53c',
                                {{-- 'IQ': '#06b53c',
                                'MA': '#06b53c',
                                'MR': '#06b53c',
                                'DJ': '#06b53c', --}}
                                'AE': '#06b53c',
                                {{-- 'BH': '#06b53c',
                                'KM': '#06b53c', --}}

                                {{-- // NFATA
                                'US': '#2b303a',
                                'CA': '#2b303a',
                                'MX': '#2b303a', --}}
                            };

                            map = new jvm.WorldMap({
                                map: 'world_mill_en',
                                container: $('#worldmap'),
                                backgroundColor: '#CCC',
                                series: {
                                    regions: [{
                                        attribute: 'fill'}]
                                }
                            });

                            map.series.regions[0].setValues(myCustomColors);
                        })();
                    });

                </script>
                <div id="worldmap" style="height:450px;width:100%;" class="map"></div>


            </div>






@endsection


@section('script')
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="{{asset('neon-theme/html/neon-rtl')}}/assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script>
    // Sparkline Charts
			$(".top-apps").sparkline('html', {
			    type: 'line',
			    width: '50px',
			    height: '15px',
			    lineColor: '#ff4e50',
			    fillColor: '',
			    lineWidth: 2,
			    spotColor: '#a9282a',
			    minSpotColor: '#a9282a',
			    maxSpotColor: '#a9282a',
			    highlightSpotColor: '#a9282a',
			    highlightLineColor: '#f4c3c4',
			    spotRadius: 2,
			    drawNormalOnTop: true
			 });
</script>


@endsection
