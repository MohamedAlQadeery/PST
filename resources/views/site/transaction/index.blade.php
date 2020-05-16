@extends('site.base_layouts.app')
 @section('content') {{--
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    
    
    <section  class="breadcrumb">

        <div class="container">
    
            <div class="row">
	<div style="float:right" class="col-sm-7">

                <h2>  جميع معاملاتك</h2>

                <ol class="breadcrumb bc-3" >
                    <a  class="btn btn-secondary" href="{{route('site.cart.index')}}">
                        <i class="entypo-basket "></i>
                        عربة التسوق
                    </a>			
                     <a>
                         
                        <a class="btn btn-success" href="{{route('site.transaction.index')}}" >
                            <i class="entypo-map"></i>
                            متابعة طلباتك</a>
                    </a>

                </ol>

            </div>
        </div>
    </div>
            
    <hr>


    @if($transactions)
    <div class="container">
        <div class="row">
                <table class="table table-hover">
                    <thead >
                        <tr>
                            <th class="text-right">المزود</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ المعاملة</th>
                            <th class="text-center">إظهار البضائع التي طلبتها</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transactions as $transaction)                            
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    {{-- <a class="thumbnail pull-right" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a> --}}
                                    
                                    <div class="media-body" style="padding-right:12px;" >
                                        
                                        <h4 class="media-heading"><a href="#">مجموعة من البضائع</a></h4>
                                        <h4 class="media-heading"> من المزود:
                                             <a href="">
                                        {{$transaction->provider->first_name}}  {{$transaction->provider->last_name}}</a></h4>
                                            
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-1 col-md-1">
                                @if($transaction->status===0)
                                <a  class="btn btn-warning">
                                    <i class="entypo-hourglass"></i> جاري التوصيل 
                                </a>
                                @else 
                                <a  class="btn btn-success">
                                    <i class="entypo-home"></i> تم التوصيل  
                                </a>
                                @endif
                            </td>
                            <td class="col-sm-1 col-md-1">
                                <a  class="btn btn-danger">
                                    <i class="entypo-calendar"></i> {{$transaction->date}}
                                </a>
                            </td>
                           <td class="col-sm-1 col-md-1">
                                <a href="{{route('site.transaction.show',$transaction->id)}}" class="btn btn-primary">
                                    <i class="entypo-doc-text"></i> إظهار تفاصيل المعاملة
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <a href="{{route('site.products.index')}}" class="btn btn-default">
                                    <span class="entypo-basket"></span> أكمل التسوق
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    @else 
    <div class="container">
        <div class="row">
            <h1 class="text-center" style="color:red;"> <strong> لا يوجد  معاملات </strong>  </h1>
        </div>
    </div>
    @endif

    <hr>
    
    @endsection()