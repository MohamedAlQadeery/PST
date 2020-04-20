@extends('site.base_layouts.app')

@section('content')

	<!-- Breadcrumb -->
<section class="portfolio-item-details">
@if (!is_null($product))

	<div class="container">

		<!-- Title and Item Details -->
		<div dir="ltr" class="row item-title">

			<div class="col-sm-9">
				<h1>
					<a href="#">{{$product->name}}</a>
				</h1>

				<div class="categories">
					<a href="#">{{$product->category->name}}</a>
				</div>
			</div>

			<div class="col-sm-3">

				<div class="text-right">
					<div class="item-detail">
						{{$product_date}}
						<span>: التاريخ</span>
					</div>

					<div class="item-detail">
							<div class="callout-button">
								<a href="index.html" class="btn btn-secondary"> طلب البضاعة</a>
							</div>
					</div>
				</div>

			</div>

		</div>

		<!-- Portfolio Images Gallery -->
		<div class="row">
			<div class="col-md-12">

				<div class="item-images">

					<a href="#">
						<img src="{{$product->getImage()}}" class="img-rounded" />
					</a>

					<div class="next-prev-nav">
						<a href="#" class="prev"></a>
						<a href="#" class="next"></a>
					</div>

					<div class="items-nav">
					</div>
				</div>

			</div>
		</div>

		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$(".item-images").cycle({
					slides: '> a',
					prev: '.next-prev-nav .prev',
					next: '.next-prev-nav .next',
					pager: '.items-nav',
					pagerActiveClass: 'active',
					pagerTemplate: '<a href="#"></a>',
					swipe: true
				});
			});
		</script>

		<!-- Portfolio Description and Other Details -->
		<div class="row item-description">

			<div class="col-sm-8">

				<p class="text-justify">
                    {{$product->description}}
                  </p>


			</div>

			<div dir="ltr" class="col-sm-4">

				<dl>
					<dt>{{$product->user->first_name.' '.$product->user->last_name}}</dt>
					<dd><b>:المزود<b></dd>

						<dt>{{$product->category->name}}</dt>
						<dd><b>:الصنف<b></dd>


							<dt>{{$product->name}}</dt>
							<dd><b>:البضاعة<b></dd>


				</dl>

			</div>

		</div>

	</div>


</section>

<section class="portfolio-container">

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h3>بضائع مشابهة</h3>
			</div>
		</div>

		<div class="row">

          @if(count($related_products) > 1)
          @foreach ($related_products as $item)
          <div class="col-sm-4 col-xs-6">

              <div class="portfolio-item">
                  <a href="{{route('site.products.show',$item->id)}}" class="image">
                      <img src="{{$item->getImage()}}" class="img-rounded" />
                      <span class="hover-zoom"></span>
                  </a>

                  <h4>
                      <a href="#" class="like">
                          <i class="entypo-heart"></i>
                      </a>

                      <a href="{{route('site.products.show',$item->id)}}" class="name">{{$item->name}}</a>
                  </h4>

                  <div class="categories">
                      <a href="{{route('site.products.index',['category_id'=>$item->category->id])}}">{{$item->category->name}}</a>
                  </div>
              </div>

          </div>
          @endforeach
          @else
          <h3 class="text-center">لا يوجد بضائع مشابهة</h3>
          @endif

		</div>

	</div>

</section>

<hr>
@else

    <h3 class="text-center" >البضاعه غير موجودة </h3>
</section>

@endif
@endsection()
