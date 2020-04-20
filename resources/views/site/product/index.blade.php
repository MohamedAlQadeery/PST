@extends('site.base_layouts.app')

@section('content')
	<!-- Breadcrumb -->
<section dir="ltr" class="breadcrumb">

	<div class="container">

		<div  dir="ltr"  class="row">

			<div class="col-sm-7">

				<h1>جميع البضائع</h1>

							<ol class="breadcrumb bc-3" >
						<li>
				<a href={{route('site.home')}}><i class="fa-home"></i>الرئيسية</a>
			</li>

				<li class="active">

							<strong>جميع البضائع</strong>
					</li>
					</ol>

			</div>

			<div  class="col-sm-5">

                <!-- Category Filter -->
                <form action="{{route('site.products.index')}}" method="GET">
                  <div class="form-group">
                    <select name="category_id" class="form-control">

                        <ul dir="rtl" class="dropdown-menu" role="menu">
                            <option disabled selected>اختر الصنف</option>

                            @foreach ($shareData['categories'] as $category )
                            <li>
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            </li>
                            @endforeach


                        </ul>

                    </div>
                    <div class=" form-group">
                        <input type="submit" value="اختر" class="btn btn-info pull-right ">

                    </div>

                  </div>
                  </select>

                </form>


			</div>

		</div>

	</div>

</section>


<section class="portfolio-container">

	<div class="container">

		<div class="row" id="portfolio-items">

            @foreach ($products as $product)
            <div class="item col-sm-4 col-xs-6 filter-design">

				<div class="portfolio-item">
					<a href="{{route('site.products.show',$product->id)}}" class="image">
						<img src="{{$product->getImage()}}" class="img-rounded" />
						<span class="hover-zoom"></span>
					</a>

					<h4>
						<a href="" class="like liked">
							<i class="entypo-heart"></i>
						</a>

						<a href="{{route('site.products.show',$product->id)}}" class="name">{{$product->name}}</a>
					</h4>

					<div class="categories">
						<a href="{{route('site.products.index',['category_id'=>$product->category->id])}}">{{$product->category->name}}</a>
						<br>
                    <a href="{{route('site.providers.show',$product->user->id)}}">{{$product->user->first_name .' '.$product->user->last_name}}</a>
					</div>
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

<hr>
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
</script>

@endsection()
