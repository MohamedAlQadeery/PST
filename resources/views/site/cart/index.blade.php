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

                <h2>  المزودين اللذين طلبت منهم</h2>

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

                    {{-- <a href="{{route('site.products.index')}}" class="btn btn-default">
                        <i class="entypo-basket"></i> أكمل التسوق
                    </a> --}}
            </ol>

            </div>
        </div>
    </div>
            
    <hr>

    {{-- {{dd(Cart::session(auth()->user()->id)->isEmpty())}} --}}

    @if(!Cart::isEmpty())
    <div class="container">
        <div class="row">
                <table class="table table-hover">
                    <thead >
                        <tr>
                            <th class="text-right">المزود</th>
                            {{-- <th class="text-center">الكمية</th> --}}
                            {{-- <th class="text-center">السعر</th> --}}
                            <th class="text-center">إظهار البضائع التي طلبتها</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($providers as $product)                            
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-right" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                                    
                                    <div class="media-body" style="padding-right:12px;" >
                                        
                                        <h4 class="media-heading"><a href="#">مجموعة من البضائع</a></h4>
                                    <h4 class="media-heading"> من المزود: <a href="{{route('site.cart.showItems',['id'=>$product->user_id])}}">
                                        {{$product->user->first_name}}  {{$product->user->last_name}}</a></h4>
                                       
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="col-sm-1 col-md-1" style="text-align: center">
                                <input type="number" class="form-control" id="exampleInputEmail1" min="1" max="10">
                            </td> --}}
                            {{-- <td style="font-size:16px;padding-top:15px" class="col-sm-1 col-md-1 text-center"><strong>$4.87</strong></td> --}}
                            {{-- <td style="font-size:16px;padding-top:15px"  class="col-sm-1 col-md-1 text-center"><strong>$14.61</strong></td> --}}
                            <td  class="col-sm-1 col-md-1">
                                <a href="{{route('site.cart.showItems',['id'=>$product->user_id])}}" class="btn btn-success">
                                    <i class="entypo-bag"></i> إظهار البضائع التي طلبتها
                                </a>
                            </td>
                        </tr>
                        @endforeach

                      
                        {{-- checkout here  --}}
                        {{-- <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <h5>Subtotal</h5></td>
                            <td class="text-right">
                                <h5><strong>$24.59</strong></h5></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <h5>Estimated shipping</h5></td>
                            <td class="text-right">
                                <h5><strong>$6.94</strong></h5></td>
                        </tr> --}}
                        {{-- <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <h3>المجموع</h3></td>
                            <td  class="text-right">
                                <h3><strong>$31.53</strong></h3></td>
                        </tr> --}}
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
            <h1 class="text-center" style="color:red;"> <strong> لا يوجد بضائع في السلة</strong>  </h1>
        </div>
    </div>
    @endif

    <hr>
    
    @endsection()