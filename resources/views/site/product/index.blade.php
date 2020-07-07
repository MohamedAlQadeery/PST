@extends('site.base_layouts.app')

@section('content')
	<!-- Breadcrumb -->
<section  class="breadcrumb">

	<div class="container">

		<div class="row">

			<div style="float:right" class="col-sm-7">

				<h1>جميع البضائع</h1>

							<ol class="breadcrumb bc-3" >
						<li>
				<a href={{route('site.home')}}><i class="entypo-home"></i>الرئيسية</a>
			</li>

				<li class="active">

							<strong>جميع البضائع</strong>
					</li>
					</ol>

            </div>


			<div class="col-md-12" style="margin: 3%">
				{{-- <div class="btn-group alt-select-field" id="category-filter"> --}}

                <!-- Category Filter -->
                <form action="{{route('site.products.index')}}" method="GET">



                    <div class="form-group col-md-6">
                    <select name="category_id" class="form-control">

                        <ul  class="dropdown-menu" role="menu">
                            <option disabled selected>اختر الصنف</option>

                            @foreach ($shareData['categories'] as $category )
                            <li>
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            </li>
                            @endforeach


                        </ul>
					</select>

                    </div>


                    <div class="form-group col-md-6">
                        <input type="text" name="search" placeholder="ابحث هنا عن اسم البضاعة ..." class="form-control">
                    </div>

					<input type="submit" style="width:80px;margin-left: 2%" value="اختر" class="btn btn-secondary pull-left ">



				</form>

				  {{-- </div> --}}

			</div>




		</div>

	</div>

</section>

<hr>
<section class="portfolio-container">

	<div class="container">

		<div class="row" id="portfolio-items">

            @foreach ($products as $product)
            <div class="item col-sm-4 col-xs-6 filter-design">

				<div class="portfolio-item">
					<a href="{{route('site.products.show',$product->id)}}" class="image">
						<img src="{{$product->getImage()}}" class="img-rounded " />
						<span class="hover-zoom"></span>
					</a>

					<h4>
						<a href="{{route('site.products.show',$product->id)}}" class="name">{{$product->name}}</a>
					</h4>

					<div class="categories">
						<a href="{{route('site.products.index',['category_id'=>$product->category->id])}}">{{$product->category->name}}</a>
						<br>
                    <a href="{{route('site.providers.show',$product->user->id)}}">{{$product->user->first_name .' '.$product->user->last_name}}</a>

					</div>

					<h4>
						<strong style="font-size:20px">₪ {{$product->price_to_sell }}</strong>
						<div style="float:left">
{{--
							<i class="entypo-basket ">
								<a href="index.html" class="btn btn-secondary"> طلب البضاعة</a>
							</i>
							<br>
							<br> --}}
								<a href="{{route('site.products.show',$product->id)}}" class="btn btn-secondary" >
									<i class="entypo-direction">
											عرض
									</i>
								</a>
						</div>
					</h4>


					{{-- <div style="float:left" >

					</div> --}}
					{{-- <br> --}}



				</div>

			</div>

            @endforeach



		</div>

		<div class="row">

			<div class="col-md-12">

				<div class="text-center">

                {{$products->links()}}

				</div>

			</div>

		</div>

	</div>

</section>



{{--
<script type="text/javascript">


jQuery(document).ready(function($)
{
	var $portfolio_items = $("#portfolio-items"),
		$category_filter = $("#category-filter");

	$portfolio_items.isotope({
		itemSelector: '.item',
		columnWidth: 1/4
	});

	$category_filter.on('change', function(ev, o)
	{
		var filter = o.el.data('filter');

		$portfolio_items.isotope({
			filter: o.isDefault ? '.item' : '.filter-' + filter
		});
	});

	$(window).on('neon.resize', function()
	{
		$portfolio_items.isotope('reLayout');
	});

	$portfolio_items.isotope('reLayout');
});



</script> --}}



@endsection()
