
			<div class="col-sm-4">

				<!-- List Sidebar -->
<div class="sidebar">

	<h3>
		<i class="entypo-list"></i>
		الأصناف
	</h3>


	<div class="sidebar-content">

		<ul>
			@foreach ($shareData['categories'] as $category)
            <li>
				<a href="#">{{$category->name}} </a>
			</li>

            @endforeach
		</ul>

	</div>

</div>

<!-- Comments Sidebar -->
<div class="sidebar">

	<h3>
		<i class="entypo-chat"></i>
		أفضل المزودين
	</h3>

	<div class="sidebar-content">

		<ul class="discussion-list">
			@foreach ($reviewd_providers as $item)
            <li>
				<a href="{{route('site.providers.show',$item->id)}}" class="thumb">
					<img src="{{$item->getImage()}}" width="43" class="img-circle')}}" />
				</a>

				<div class="details">
					<a href="{{route('site.providers.show',$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a>
					<p>{{Str::limit($item->bio,20)}}</p>
				</div>
			</li>
            @endforeach

		</ul>

	</div>

</div>
			</div>
