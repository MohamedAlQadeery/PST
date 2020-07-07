
			<div class="col-sm-4">

				<!-- List Sidebar -->
<div class="sidebar">

	<h3>
		<i class="entypo-list"></i>
		البحث عن مزود
	</h3>


	<div class="sidebar-content">

      <form action="{{route('site.providers.index')}}" class="get">
        <div class="form-group">
            <input type="text" name="search" placeholder="ابحث هنا عن اسم المزود ..." class="form-control">
        </div>
        <input type="submit" value="ابحث" class="btn btn-secondary">

      </form>

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
