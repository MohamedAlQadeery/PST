@extends('site.base_layouts.app') @section('content')
<style>
    .icon {
        width: 50px;
        height: 50px;
        /* margin-right: 15px */
    }
    
    .icon-content {
        width: 23.4%;
        padding-top: 30px;
        padding-bottom: 20px;
        display: inline-block;
        text-align: center;
    }
</style>


<hr>
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


<div class="container ">
    <div class="row ">
        <div class="card">
            <div class="row">
                <div>
                    <h3>الطلب رقم <strong class="text-primary font-weight-bold">#{{$transaction->id}}</strong></h3>
                </div>
                <div style="float:left" class="d-flex flex-column text-sm-right">
                    <h4 class="mb-0">تاريخ الطلب  :<strong>{{$transaction_date}}</strong></h4>
                    <h4 class="mb-0">من المزود  :<strong>{{$transaction->provider->first_name}}</strong></h4> 
                    @if($transaction->type===0)
                    <h4 class="mb-0">فاتورة:<strong class="btn btn-success">كاش</strong></h4>
                    @else
                    <h4 class="mb-0">فاتورة:<strong class="btn btn-secondary">دين</strong></h4>
                    @endif
                </div>
            </div>
            <!-- Add class 'active' to progress -->
            <hr>

            <ol class="progtrckr" data-progtrckr-steps="4">
                <li class="progtrckr-done">تم التأكيد </li>
                <li class="progtrckr-done">تم الشحن</li>
                <li class="progtrckr-done">جاري التوصيل </li>
                @if($transaction->status===0)
                <li class="progtrckr-todo">تم التوصيل</li>
                @else 
                <li class="progtrckr-done">تم التوصيل</li>
                @endif
            </ol>

            <div class="row">
                <div class="icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                    <div class="">
                        {{--
                        <p class="">Order
                            <br>Processed</p> --}}
                    </div>
                </div>
                <div class="icon-content "> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                    <div class="">
                        {{--
                        <p class="">Order
                            <br>Shipped</p> --}}
                    </div>
                </div>
                <div class="icon-content "> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                    <div class="">
                        {{--
                        <p class="">Order
                            <br>En Route</p> --}}
                    </div>
                </div>
                <div style=" margin-left:6px;" class="icon-content "> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                    <div class="">
                        {{--
                        <p class="">Order
                            <br>Arrived</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <hr>
    <table id="myTable" class="table table-hover">
        <thead>
            <tr>
                <th class="text-right">البضاعة</th>
                <th class="text-center">الكمية</th>
                <th class="text-center">السعر</th>
                <th class="text-center">المجموع</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($transaction->items as $item)
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-right" href="#"> <img class="media-object" src="{{$item->product->getImage()}}" style="width: 72px; height: 72px;"> </a>

                        <div class="media-body" style="padding-right:12px;">

                            <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                            <span>الصنف: </span><span class="text-success"><strong>{{$item->product->category->name}}</strong></span>

                        </div>
                    </div>
                </td>
                <td class="col-sm-3 col-md-3" style="text-align: center">
                    <h4 class="media-heading"><a href="#">{{$item->quantity}}</a></h4>
                </td>
                <td style="font-size:16px;padding-top:15px" class="col-sm-1 col-md-1 text-center">
                    <strong> ₪{{$item->product->price_to_sell}} </strong>
                </td>
                <td style="font-size:16px;padding-top:15px" class="col-sm-1 col-md-1 text-center">
                    <strong> ₪{{$item->price}} </strong>
                </td>
            </tr>
            @endforeach 
            <tr>
                <td>   </td>
                <td>   </td>
                <td>
                    <h3>المجموع</h3></td>
                <td class="text-right">
                    <h3 id="total"><strong>₪{{$transaction->total}}</strong></h3>
                </td>
            </tr>
           
        </tbody>
    </table>
</div>
<hr>

@endsection()