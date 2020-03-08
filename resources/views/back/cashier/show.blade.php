@extends('back.base_layouts.app')

@section('content')

<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li class="active">

        <a href="{{route('cashier.index')}}">@lang('site.cashier')</a>
    </li>

    <li class="active">

        <strong>{{$shop->name}} @lang('site.cashier')</strong>
    </li>
</ol>
<h2></h2>

<div class="row">

    @include('partials.messages')

    {{-- Invoice  --}}

    <div class="col-sm-6">

        <div id="register">
            <div id="ticket">
              <h1>@lang('site.bill')</h1>
              <table id="billTable">
                <thead>
                  <tr>
                    <td id="name">@lang('site.name')</td>
                    <td id="quantity">@lang('site.quantity')</td>
                    <td id="product_price">@lang('site.price')</td>
                    <td style="display:none;" id="product_id"></td>
                    <td id="price">@lang('site.total')</td>
                    <td >@lang('site.delete')</td>

                  </tr>
                </thead>

                <tbody id="entries">
                </tbody>

                <tfoot>
                  <tr>
                    <th>@lang('site.total')</th>
                    <th></th>
                    <th></th>
                    <th id="total">₪0.00</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <form id="entry" class="text-center">
              <button id="save" type="button" class="btn btn-success"> @lang('site.save')</button>
              <button onclick="empty()" type="button" class="btn btn-info">@lang('site.new_bill')</button>
              <button onclick="empty()" type="button" class="btn btn-danger">@lang('site.cancel')</button>
            </form>
          </div>

    </div>

    {{-- Products --}}
    <div class="col-sm-6">
        <h3>@lang('site.shop_products') {{$shop->name }}</h3>
        <table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
                    <th data-hide="phone">@lang('site.name')</th>
					<th data-hide="phone">@lang('site.quantity') </th>
					<th data-hide="phone,tablet">@lang('site.image')</th>
					<th>@lang('site.action') </th>
				</tr>
			</thead>
			<tbody>
        @foreach ($products as $product)
        <tr class="odd gradeX">
					<td>{{$product->product->name}}</td>
					<td><div class="input-spinner">
                        <button type="button" class="btn btn-info btn-sm">-</button>
                        <input id="{{$product->product_id}}quantity" type="text" class="form-control size-1 input-sm" value="1">
                        <button type="button" class="btn btn-info btn-sm">+</button>
                    </div></td>
					<td class="center"><img src="{{$product->product->getImage()}}" width="54px" height="54px" alt="image" class="img-rounded"></td>
                        <td><button onclick="itemChoose({{$product->product_id}})" class="btn btn-success"> @lang('site.add') </button></td>
				</tr>
        @endforeach


			</tbody>

		</table>
    </div>

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





<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


var total = 0;


// get the choosen item from the table
function itemChoose(product_id) {
// ajax request here to get all the product info
url = window.location.href;
// url = url.replace('/cashier', '');
$.ajax({
    url: url + '/product/' + product_id
}).done(function(data) {
    product_name = data.product.product.name;
    single_product_price = data.product.product.price_to_sell;
    product_quantity = document.getElementById(product_id + 'quantity').value; // get the selected quantity from the user
    product_price = product_quantity * single_product_price; //multply the price by the quantity to get the total item price
    // after the ajax request fill the Bill record
    var entry = parseFloat(product_price); //convert the price format
    //  currency = currencyFormat(entry); //convert the price format

    document.getElementById('entries').innerHTML += '<tr><td>' + product_name + '</td><td>' + product_quantity +
        '</td><td>'+single_product_price+'</td><td style="display:none;">'+product_id +'</td><td>'+entry+'</td>'+
        '<td id="'+product_id+'product"><button type="button" onclick="deleteRow(this,'+entry+')" style="padding:1px;" class="btn btn-danger">'+
        '<i class="entypo-cancel"></i> </button></td></tr>';

    total += entry;
    document.getElementById('total').innerHTML =total;
});
}

// Delete row on delete button click and reduce the balance
function deleteRow(btn,entry) {

  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);

  total -= entry;
  document.getElementById('total').innerHTML =total;

}





// convert the number to currency Format
// function currencyFormat(number) {
//   var currency = parseFloat(number);
//   currency = currency.toFixed(2);
//   currency = '₪' + currency;
//   return currency;
// }


//Run saveInventory function on Save
document.querySelector("#save").addEventListener("click", e => {
      saveInventory();
    });
   //function to save the bill records
    function saveInventory() {
    //Loop over th and crate column Header array
      const columnHeader = Array.prototype.map.call(
        document.querySelectorAll("#billTable thead td"),
        th => {
          return th.id;
        }
      );
    //Loop over tr elements inside table body and create the object with key being the column header and value the table data.
      const tableContent = Object.values(
        document.querySelectorAll("#billTable tbody tr")
      ).map(tr => {
        const tableRow = Object.values(tr.querySelectorAll("td")).reduce(
          (accum, curr, i) => {
            const obj = { ...accum };
            obj[columnHeader[i]] = curr.innerHTML;
            return obj;
          },
          {}
        );
        return tableRow;
      });
      // this array object contain the saved content from the bill
      // check first if the bill data is emapty or not
      if(tableContent.length===0){
        alert('Empty bill / الفاتورة خاوية');
        return;
      }
      console.log(tableContent);
      empty()
      $.ajax({
        type:'POST',
        url:'{{route("cashier.store",$shop->id)}}',
        data:{data:tableContent},
        success:function(data){
           if(data.error==0){
            window.open('http://localhost:8000/back/invoice/'+data.id,'_blank');
           }else{
               console.log(data.error);
               alert('Error in quantity/مشكله في الكميه');
           }
        },error:function(data){
            console.log(data.status);
         }
     });
    }
//function to empty the bill records
function empty(){
 //reset the var total to zero
 total = 0;
 document.getElementById('entries').innerHTML='';
 document.getElementById('total').innerHTML = '₪0.00';
}
// table script
		jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-1' );
			// Initialize DataTable
			$table1.DataTable( {
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": true,
                "language": {
                    @if(app()->getLocale()=='ar')
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json",
                    @endif
                },
			});
			// Initalize Select Dropdown after DataTables is created
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
			});
		} );
</script>



@endsection
