@extends('site.base_layouts.app')

@section('content')

<hr>
<!-- Blog -->
<section class="blog">

	<div class="container">

		<div class="row">

			<div class="col-sm-8">

				<div class="blog-posts">

					<!-- Blog Post -->

                    @foreach ($providers as $provider)
                    <div class="blog-post">

						<div class="post-thumb">

							<a href="{{route('site.providers.show',$provider->id)}}">
								
								<img  src="{{$provider->getImage()}}" class="img-rounded" />
								<span class="hover-zoom"></span>
							</a>

						</div>

						<div class="post-details">

							<h3>
							<a href="{{route('site.providers.show',$provider->id)}}">{{$provider->first_name.' '.$provider->last_name}}</a>
							</h3>

							<div class="post-meta">

								<div class="meta-info">
									<i class="entypo-location"></i>{{$provider->address}}</div>

									<br>
									<div class="meta-info">
										<i class="entypo-phone"></i>{{$provider->mobile_number}}</div>
	
										<br>
								<div class="meta-info">
									<i class="entypo-star"></i>التقييم</div>

									<br>
								<div class="meta-info">
                                    <i class="entypo-newspaper"> 
										<p>{{Str::limit($provider->bio,50,'...')}}</p>
									</i>
								</div>

							</div>



						</div>

					</div>

                    @endforeach



					<!-- Blog Pagination -->
					<div class="text-center">

						{{$providers->links()}}
					</div>

				</div>

			</div>

            @include('site.provider.sidebar')

		</div>

	</div>

</section>

<hr>
@endsection()
