<div class="sidebar-menu">
    <div class="sidebar-menu-inner">
        <header class="logo-env">
            <!-- logo -->
            <div class="logo" >
				<a href="dashboard/main/" >
					 <img src="{{ url('/workImages/logo.png')}}" width="120" alt="">
				</a>
            </div>
            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon">
                    <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --><i class="entypo-menu"></i> </a>
            </div>
            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation">
                    <!-- add class "with-animation" to support animation --><i class="entypo-menu"></i> </a>
            </div>
		</header>

		<div class="sidebar-user-info">

			<div class="sui-normal">
				<a href="#" class="user-link">
					<img src="{{url('/neon-theme/html/neon/assets/images/thumb-1@2x.png')}}" width="55" alt="" class="img-circle" />

					<span>Welcome,</span>
					<strong>Art Ramadani</strong>
				</a>
			</div>

			<div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->
				<a href="#">
					<i class="entypo-pencil"></i>
					New Page
				</a>

				<a href="mailbox.html">
					<i class="entypo-mail"></i>
					Inbox
				</a>

				<a href="extra-lockscreen.html">
					<i class="entypo-lock"></i>
					Log Off
				</a>

				<span class="close-sui-popup">&times;</span><!-- this is mandatory -->
			</div>
		</div>

        <ul id="main-menu" class="main-menu">

			{{-- <li class="active active has-sub root-level"> <a href=""><i class="entypo-gauge"></i><span class="title">Dashboard</span></a>
				<ul class="">
					<li class="active"> <a href=""><span class="title">Dashboard 1</span></a> </li>
					<li> <a href=""><span class="title">Dashboard 2</span></a> </li>
					<li> <a href=""><span class="title">Dashboard 3</span></a> </li>
					<li class="has-sub"> <a href=""><span class="title">Skins</span></a>
						<ul style="">
							<li> <a href=""><span class="title">Black Skin</span></a> </li>
							<li> <a href=""><span class="title">White Skin</span></a> </li>
							<li> <a href=""><span class="title">Purple Skin</span></a> </li>
							<li> <a href=""><span class="title">Cafe Skin</span></a> </li>
							<li> <a href=""><span class="title">Red Skin</span></a> </li>
							<li> <a href=""><span class="title">Green Skin</span></a> </li>
							<li> <a href=""><span class="title">Yellow Skin</span></a> </li>
							<li> <a href=""><span class="title">Blue Skin</span></a> </li>
							<li> <a href=""><span class="title">Facebook Skin</span><span class="badge badge-secondary badge-roundless">New</span></a> </li>
						</ul>
					</li>
					<li> <a href=""><span class="title">Whats New</span><span class="badge badge-success badge-roundless">v2.0</span></a> </li>
				</ul>
			</li> --}}

            <li class="active active has-sub root-level"> <a href=""><i class="entypo-gauge"></i><span class="title"  style="font-size: 17px">@lang('site.users')</span></a>
				<ul class="">
					<li> <a href="{{route('users.create')}}"><span class="title"><i  class="entypo-gauge" ></i><span  style="font-size: 17px">@lang('site.create_user')</span></a> </li>
                    <a href="{{route('users.index')}}"><i  class="entypo-gauge" ></i><span style="font-size: 17px">@lang('site.users')</span></a>

				</ul>
            </li>



            <li class="active active has-sub root-level"> <a href=""><i class="entypo-gauge"></i><span class="title"  style="font-size: 17px">@lang('site.roles')</span></a>
				<ul class="">
					<li> <a href="{{route('role.create')}}"><span class="title"><i  class="entypo-gauge" ></i><span  style="font-size: 17px">@lang('site.create_role')</span></a> </li>
                    <a href="{{route('role.index')}}"><i  class="entypo-gauge" ></i><span style="font-size: 17px">@lang('site.roles')</span></a>

				</ul>
            </li>


            <li class="active">
                <a href="{{route('shops.index')}}"><i  class="entypo-gauge" ></i><span style="font-size: 17px">@lang('site.shops')</span></a>

            </li>


            <li class="active">
                <a href="{{route('cashier.index')}}"><i  class="entypo-gauge" ></i><span style="font-size: 17px">@lang('site.cashier')</span></a>

            </li>



			{{-- <li class="has-sub root-level"> <a href="https://demo.neontheme.com/layouts/layout-api/"><i class="entypo-layout"></i><span class="title">Layouts</span></a>
				<ul style="">
					<li> <a href="https://demo.neontheme.com/layouts/layout-api/"><span class="title">Layout API</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/collapsed-sidebar/"><span class="title">Collapsed Sidebar</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/fixed-sidebar/"><span class="title">Fixed Sidebar</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/chat-open/"><span class="title">Chat Open</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/horizontal-menu-boxed/"><span class="title">Horizontal Menu Boxed</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/horizontal-menu-fluid/"><span class="title">Horizontal Menu Fluid</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/mixed-menus/"><span class="title">Mixed Menus</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/right-sidebar/"><span class="title">Right Sidebar</span></a> </li>
					<li> <a href="https://demo.neontheme.com/layouts/both-menus-right-sidebar/"><span class="title">Both Menus (Right Sidebar)</span></a> </li>
					<li class="has-sub"> <a href="https://demo.neontheme.com/layouts/page-transition-fade/"><span class="title">Page Enter Transitions</span></a>
						<ul style="">
							<li> <a href="https://demo.neontheme.com/layouts/page-transition-fade/"><span class="title">Fade Scale</span></a> </li>
							<li> <a href="https://demo.neontheme.com/layouts/page-transition-left-in/"><span class="title">Left In</span></a> </li>
							<li> <a href="https://demo.neontheme.com/layouts/page-transition-right-in/"><span class="title">Right In</span></a> </li>
							<li> <a href="https://demo.neontheme.com/layouts/page-transition-fade-only/"><span class="title">Fade Only</span></a> </li>
						</ul>
					</li>
					<li> <a href="https://demo.neontheme.com/layouts/boxed/"><span class="title">Boxed Layout</span></a> </li>
				</ul>
			</li> --}}

        </ul>
    </div>
</div>
