@extends('site.base_layouts.app')
 @section('content') {{--
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->


    <section  class="breadcrumb">

        <div class="container">

            <div class="row">
	<div style="float:right" class="col-sm-8">

            <h2>البضاعة التي طلبتها من المزود {{$provider->first_name}} {{$provider->last_name}}</h2>

                    <ol class="breadcrumb bc-3" >
                            <a  class="btn btn-secondary" href="{{route('site.cart.index')}}">
                                <i class="entypo-basket "></i>
                                عربة التسوق
                            </a>
						     <a>

                                <a class="btn btn-success" >
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

    @if(!Cart::isEmpty())

    {{-- small loop to get the total price of all items --}}
    <?php $total = 0 ?>
    @foreach ($products as $product)
    <?php $total += $product->price_to_sell ?>
    @endforeach
    <input hidden id="initTotal" value="{{$total}}">



    <div class="container">
        <div class="row">
                <table id="myTable" class="table table-hover">
                    <thead >
                        <tr>
                            <th class="text-right">البضاعة</th>
                            <th class="text-center">الكمية</th>
                            <th class="text-center">السعر</th>
                            <th class="text-center">المجموع</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                <a class="thumbnail pull-right" href="#"> <img class="media-object" src="{{$product->getImage()}}" style="width: 72px; height: 72px;"> </a>

                                    <div class="media-body" style="padding-right:12px;" >

                                        <div class="productId" hidden>{{$product->id}}</div> {{-- for the JS loop --}}
                                        <h4 class="media-heading"><a href="#">{{$product->name}}</a></h4>
                                        <h5 class="media-heading"> من المزود: <a href="#">{{$product->user->first_name}}</a></h5>
                                        <span>الصنف: </span><span class="text-success"><strong>{{$product->category->name}}</strong></span>
                                        <br>
                                        <span>الحالة: </span><span class="text-success"><strong>
                                        @if($product->quantity !==0)
                                        متاح في المخزن
                                        @else
                                         نفذت الكمية
                                        @endif
                                        </strong></span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-3 col-md-3" style="text-align: center">
                                <input hidden id="{{$product->id}}max-quantity" value="{{$product->quantity}}">

                            @if($product->quantity !==0)
                                <button type="button" id="{{$product->id}}decrease" onclick="decreaseValue({{$product->id}})" class="btn btn-secondary btn btn-info btn-sm">-</button>
                                <input class="productQuantity" {{-- for the JS loop --}} type="number" value="1" disabled class="size-1 input-sm"  min="1" max="{{$product->quantity}}" id="{{$product->id}}quantity">
                                <button  type="button" id="{{$product->id}}increase" onclick="increaseValue({{$product->id}})" class="btn btn-success btn btn-info btn-sm">+</button>

                              @else
                              <input type="number" disabled min="1" max="{{$product->quantity}}">

                              @endif
                            </td>
                            <input hidden id="{{$product->id}}price" value="{{$product->price_to_sell}}">
                            <td style="font-size:16px;padding-top:15px"   class="col-sm-1 col-md-1 text-center"><strong> ₪{{$product->price_to_sell}} </strong></td>
                            <td style="font-size:16px;padding-top:15px" id="{{$product->id}}product-price" class="col-sm-1 col-md-1 text-center">₪<strong class="productTotal" >{{$product->price_to_sell}}</strong></td>
                            <td  class="col-sm-1 col-md-1">
                                <a href="{{route('site.cart.remove',['id'=>$product->id])}}" class="btn btn-danger">
                                    <i class="entypo-cancel"></i> إزالة
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
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <h3>المجموع</h3></td>
                            <td class="text-right">
                                <h3 id="total"></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <button id="saveCash" type="submit" class="btn btn-success">
                                    فاتورة كاش <span class="entypo-tag"></span>
                                </button>
                            </td>
                            <td>
                                <button id="saveDept" type="submit" class="btn btn-warning">
                                    فاتورة دين <span class="entypo-tag"></span>
                                </button>
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

<script>



function increaseValue(id) {

  document.getElementById(id+'decrease').disabled = false; //default enabling the buttoun

  var maxQuantity = parseInt(document.getElementById(id+'max-quantity').value, 10); //get the max quantity of the product

  var value = parseInt(document.getElementById(id+'quantity').value, 10); // the value of the quantity input
  value = isNaN(value) ? 1 : value; //check if its a number ot not
  value++;


  // check first if the quantity is more than the given to disable the buttuon
  if(value > maxQuantity){
    document.getElementById(id+'increase').disabled = true;
    return;
  }else
    document.getElementById(id+'increase').disabled = false;


  document.getElementById(id+'quantity').value = value;
  var p=document.getElementById(id+'price').value;
  price = `₪<strong class="productTotal">${p * value}</strong>`;
  document.getElementById(id+'product-price').innerHTML=price;

    //increase total
    // entry = parseFloat((p * value)-total);
    entry = parseFloat(p);
    total += entry;
    document.getElementById('total').empty;
    document.getElementById('total').innerHTML =`<h3><strong>₪${total}</strong></h3>`;
}



function decreaseValue(id) {

  document.getElementById(id+'increase').disabled = false; //default enabling the buttoun


  var maxQuantity = parseInt(document.getElementById(id+'max-quantity').value, 10); //get the max quantity of the product

  var value = parseInt(document.getElementById(id+'quantity').value, 10);
  value = isNaN(value) ? 1 : value;
  value < 1 ? value = 1 : '';
  value--;

   // check first if the quantity is more than the given to disable the buttuon
   if(value <= 0){
    document.getElementById(id+'decrease').disabled = true;
    return;
  }else
    document.getElementById(id+'decrease').disabled = false;


  document.getElementById(id+'quantity').value = value;
  var p=document.getElementById(id+'price').value;
  price = `₪<strong class="productTotal">${p * value}</strong>`;
  document.getElementById(id+'product-price').innerHTML=price;

  //decrease total
//   entry = parseFloat(p * value);
  entry = parseFloat(p);
  total -= entry;
  document.getElementById('total').empty;
  document.getElementById('total').innerHTML =`<h3><strong>₪${total}</strong></h3>`;
}

// var total =0;
var total =parseFloat(document.getElementById('initTotal').value);
document.getElementById('total').innerHTML=`<h3><strong>₪${total}</h3></strong>`;



$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

// save cash bill function
document.querySelector("#saveCash").addEventListener("click", e => {

    var txt;
  var r = confirm("هل أنت متأكد من اتمام الطلب !");

  if (r == true) {
    var arrData=getTabelContent(); // getting the table rows content
    console.log(arrData);

    $.ajax({
        type:'POST',
        url:'{{route("site.transaction.store",[$provider->id,1])}}',
        data:{data:arrData},
        success:function(data){
           if(data.error==0){
            // console.log(data.product);
            window.location.href = "http://localhost:8000/site/transaction";
           }else{
               console.log(data.error);
               alert('Error in quantity/مشكله في الكميه');
           }
        },error:function(data){
            console.log(data.status);
         }
     });
    } else {
    return;
         }
    });

// save bill dept function
document.querySelector("#saveDept").addEventListener("click", e => {
  var txt;
  var r = confirm("هل أنت متأكد من اتمام الطلب !");

  if (r == true) {
    var arrData= getTabelContent(); // getting the table rows content
    console.log(arrData);

    $.ajax({
        type:'POST',
        url:'{{route("site.transaction.store",[$provider->id,0])}}',
        data:{data:arrData},
        success:function(data){
           if(data.error==0){
            // console.log(data.product);
            window.location.href = "http://localhost:8000/site/transaction";
            // window.open('http://localhost:8000/site/cart');
           }else{
               console.log(data.error);
               alert('Error in quantity/مشكله في الكميه');
           }
        },error:function(data){
            console.log(data.status);
         }
     });

  } else {
    return;
  }


});


// collecting the tabel conten
    function getTabelContent(){
        var arrData=[];
   // loop over each table row (tr)
   $("#myTable tr").each(function(){

        var currentRow=$(this);

        var col1_value=currentRow.find(".productId").text();
        var col2_value=currentRow.find(".productQuantity").val();
        var col3_value=currentRow.find(".productTotal").text();
        // var col3_value=currentRow.find("td:eq(2)").text();

         var obj={};
         obj['productId'] =col1_value;
         obj['productQuantity'] =col2_value;
         obj['productTotal'] =col3_value;
        // obj.col1=col1_value;
        // obj.col2=col2_value;
        // obj.col3=col3_value;
        // if(!(obj.col1=="" && obj.col2== undefined && obj.col1=="")){
        if(!(obj['productId']=="" && obj['productQuantity']== undefined && obj['productTotal']=="")){
            arrData.push(obj);
        }
    });
    return arrData;
    }



    </script>

    @endsection()
