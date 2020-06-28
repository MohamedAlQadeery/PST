@extends('site.base_layouts.app')

@section('content')
	<!-- Blog Separator -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<hr class="no-top-margin" />
		</div>
	</div>
</div>

<!-- Blog Single -->

<section class="blog blog-single">

	<div class="container">

		<div class="row">

			<div class="col-sm-8">

				<div class="blog-post-single">
                    @include('partials.messages')

					<a href="#" class="image">
						<img src="{{$provider->getImage()}}" class="img-responsive img-rounded" width="120px" height="120px"/>
					</a>
				
					<div class="post-details">

						<h3>
							<a href="blog-post.html">{{$provider->first_name.' '.$provider->seconed_name.' '.$provider->third_name.' '.$provider->last_name}}</a>
							
						</h3>
	

						<div class="post-meta">

							<div class="meta-info">
                                <i class="entypo-calendar"></i>{{$provider->address}}
                            </div>

                            <div class="meta-info">
                                <i class="entypo-phone"></i>{{$provider->mobile_number}}
                            </div>

							<div class="meta-info">
								<i class="entypo-user"></i>
								{{$provider->age}}
							</div>

							<div class="meta-info">
								<i class="entypo-calendar"></i>
								{{$provider->dob}}
							</div>

							<div class="meta-info">

								<div  class="stars-outer">
									<div  class="stars-inner"></div>
								  </div>
							</div>
							<br>
							<div class="meta-info">
								<i class="entypo-newspaper"></i>
								{{$provider->bio}}
							</div>
						
						</div>

						<div class="callout-button">
								<a href="index.html" class="btn btn-secondary"><i class="entypo-phone"></i> تواصل معه</a>
						</div>

					</div>

				</div>

			</div>

            @include('site.provider.sidebar')

			</div>

		</div>

	</div>

</section>

<hr>


<section class="portfolio-container">

	<div class="container">
<h3>
	<i class="entypo-chat"></i>
		مراجعات التجار
</h3>

@foreach ($provider->reviews as $review)
<div class="reviews-container">
	{{-- <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:90px"> --}}
	<img src="{{$review->seller->getImage()}}" style="width:90px" class="img-circle')}}" />
	{{-- <a href="#"> </a>	 --}}
	<p><span>{{$review->seller->first_name.' '.$review->seller->last_name}}</span> 
		<div class="stars-outer" style="font-size:20px; margin-right:19px">
			<div style="width:{{$review->stars*20}}%" class="stars-inner"></div>
		</div> 
		<br>
		<br>
		<span style="font-size:15px;margin-right:19px;font-weight:bold">{{$review->body}}</span>
	</p>
	{{-- <p style="margin-right:40px"></p> --}}
</div>
	@endforeach
	
</div>

</section>


<section class="portfolio-container">

		<div class="container">

			<div class="row">
					<h3>أضف تقييمك</h3>
			</div>
	
			<br>
	<div class="row">
	
		<form action="{{route('site.providerReview.store',$provider->id)}}" method="post"
				role="form" class="form-horizontal form-groups-bordered">
				@csrf()
			<span class="star-rating star-5">
				<input type="radio" name="stars" value="1"><i></i>
				<input type="radio" name="stars" value="2"><i></i>
				<input type="radio" name="stars" value="3"><i></i>
				<input type="radio" name="stars" value="4"><i></i>
				<input type="radio" name="stars" value="5"><i></i>
			</span>
	
			<div class="row">
				<div class="col-md-12">
					<h3>أضف مراجعتك</h3>
				</div>
			</div>
			<br>
			<textarea name="body" cols="30" rows="10">
	
			</textarea>
			<div class="callout-button">
				<button type="submit" class="btn btn-success"><i class="entypo-star"></i>تأكيد</button>
	
			</div>
		</form>
	
		</div>
	</div>
	
</section>


<hr>

<section class="portfolio-container">

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h3>البضائع التي يبيعها</h3>
			</div>
		</div>

		<div class="row">

          @if(count($provider->products) >= 1)
         	@foreach ($provider->products as $item)
         	 <div class="col-sm-4 col-xs-6">

              <div class="portfolio-item">
				<div class="index-items">

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

          </div>
          @endforeach
          @else
          <h3 class="text-center">لا يوجد بضائع مشابهة</h3>
		  @endif


		</div>

	</div>

</section>
<hr>


<script>
	var rate = "<?php echo $rate ?>";
	document.querySelector(`.stars-inner`).style.width = `${rate*10}%`; 

// const ratings = {
// 	hotel_a : 2.8,
// 	hotel_b : 3.3,
// 	hotel_c : 1.9,
// 	hotel_d : 4.3,
// 	hotel_e : 4.74
//   };
  
// //   // total number of stars
//   const starTotal = 5;
  
//   for(const rating in ratings) {  
// 	  alert(ratings)
// // 	const starPercentage = (ratings[rating] / starTotal) * 100;
// // 	const starPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;
// // 	document.querySelector(`.${rating} .stars-inner`).style.width = starPercentageRounded; 
//   }

</script>


@endsection()
