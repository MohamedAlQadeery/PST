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
								<i class="entypo-star"></i>
								تقييمه
							</div>

							
							<div class="meta-info">
								<i class="entypo-user"></i>
								{{$provider->age}}
							</div>

							<div class="meta-info">
								<i class="entypo-calendar"></i>
								{{$provider->dob}}
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


					{{-- <div class="post-content">

					<p>{{$provider->bio}}</p>
					</div> --}}

					<br />



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

		<div class="row">
			<div class="col-md-12">
				<h3>أضف تقييمك</h3>
			</div>
		</div>

		<br>
		<div class="row">

	<form action="" method="post"  role="form" class="form-horizontal form-groups-bordered">
			@csrf()
			@method('post')		
		<span class="star-rating star-5">
			<input type="radio" name="rating" value="1"><i></i>
			<input type="radio" name="rating" value="2"><i></i>
			<input type="radio" name="rating" value="3"><i></i>
			<input type="radio" name="rating" value="4"><i></i>
			<input type="radio" name="rating" value="5"><i></i>
		</span>

		<div class="row">
			<div class="col-md-12">
				<h3>أضف مراجعتك</h3>
			</div>
		</div>
		<br>

		<textarea name="" id="" cols="30" rows="10">

		</textarea>
		<div class="callout-button">
			<a href="" class="btn btn-success"><i class="entypo-star"></i> تأكيد</a>
		</div>
	</form>

	</div>
</div>
<br>
<br>

<div class="container">

<h3>
	<i class="entypo-chat"></i>
		مراجعات التجار	
</h3>

<div class="sidebar-content">

	<div style="color:gold;font-size:20px" class="details">
		<i class="entypo-star"> عدد النجوم من 5 هنا </i>
	</div>
	<ul class="discussion-list">
		@foreach ($reviewd_providers as $item)
			
			{{-- <a href="{{route('site.providers.show',$item->id)}}" class="thumb">
				<img src="{{$item->getImage()}}" width="43" class="img-circle')}}" />
			</a> --}}

			{{-- <div class="details">
				<a href="{{route('site.providers.show',$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a>
			</div> --}}			
			<hr>
			<br>
			<li>
				<p>	
					<img src="{{$item->getImage()}}" width="43" class="img-circle')}}" />
					<a href="{{route('site.providers.show',$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a>
					<p style="margin-right: 60px">	مراجعة مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
					</p>
				</p>

			</li>
			<li>
				<p>	
					<img src="{{$item->getImage()}}" width="43" class="img-circle')}}" />
					<a href="{{route('site.providers.show',$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a>
					<p style="margin-right: 60px">	مراجعة مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
					</p>
				</p>

			</li>

			<li>
				<p>	
					<img src="{{$item->getImage()}}" width="43" class="img-circle')}}" />
					<a href="{{route('site.providers.show',$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a>
					<p style="margin-right: 60px">	مراجعة مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
						مراجعةمراجعةمراجعةمراجعةمراجعةمراجعةمراجعة	
					</p>
				</p>

			</li>

		@endforeach
	</ul>


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
@endsection()
