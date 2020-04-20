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
						<img src="{{$provider->getImage()}}" class="img-responsive img-rounded" />
					</a>

					<div class="post-details">

						<h3>
							<a href="blog-post.html">{{$provider->first_name.' '.$provider->last_name}}</a>
						</h3>

						<div class="post-meta">

							<div class="meta-info">
                                <i class="entypo-calendar"></i>{{$provider->address}}
                            </div>

                            <div class="meta-info">
                                <i class="entypo-phone"></i>{{$provider->mobile_number}}
                            </div>


							<div class="meta-info">
								<i class="entypo-comment"></i>
								تقييمه
							</div>

						</div>

						<div class="callout-button">
							<a href="index.html" class="btn btn-secondary">تواصل معه</a>
						</div>

					</div>


					<div class="post-content">

					<p>{{$provider->bio}}</p>
					</div>

					<br />



				</div>

			</div>

            @include('site.provider.sidebar')

			</div>

		</div>

	</div>

</section>

@endsection()
