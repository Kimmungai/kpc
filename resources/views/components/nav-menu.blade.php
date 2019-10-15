<!-- /w3_agileits_top_nav-->
<!-- /nav-->
<div class="w3_agileits_top_nav">
<ul id="gn-menu" class="gn-menu-main">
       <!-- /nav_agile_w3l -->
  <li class="gn-trigger">
    <a class="gn-icon gn-icon-menu" style="padding:0"><i class="fa fa-bars" aria-hidden="true"></i><span>Menu</span></a>
    <nav class="gn-menu-wrapper">
      <div class="gn-scroller scrollbar1">
        <ul class="gn-menu agile_menu_drop">
          <li><a href="/"> <i class="fas fa-home"></i> Home</a></li>
          <li>
            <a href="/"><i class="fas fa-building" aria-hidden="true"></i> Departments <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              @foreach( $allDepts as $dept )
                @if( strtolower($dept->name) == 'kitchen' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_agile"><a href="/dept-registration/{{$dept->id}}"><i class="fas fa-utensils" aria-hidden="true"></i> Kitchen</a></li>
                @endif
                @if( strtolower($dept->name) == 'chapel' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/{{$dept->id}}"> <i class="fas fa-church" aria-hidden="true"></i> Chapel</a></li>
                @endif
                @if( strtolower($dept->name) == 'shamba' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/{{$dept->id}}"> <i class="fas fa-tractor" aria-hidden="true"></i> Shamba</a></li>
                @endif
                @if( strtolower($dept->name) == 'compound' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/{{$dept->id}}"> <i class="fas fa-umbrella-beach" aria-hidden="true"></i> Compound</a></li>
                @endif
                @if( strtolower($dept->name) == 'administration' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/{{$dept->id}}"> <i class="fas fa-user-tie" aria-hidden="true"></i> Administration</a></li>
                @endif
                @if( strtolower($dept->name) == 'store' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/{{$dept->id}}"> <i class="fas fa-store-alt" aria-hidden="true"></i> Store</a></li>
                @endif
                @if( strtolower($dept->name) == 'hospitality' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/{{$dept->id}}"> <i class="fas fa-bed" aria-hidden="true"></i> Hospitality</a></li>
                @endif
              @endforeach
            </ul>
          </li>
          <!--<li>
            <a href="/users"><i class="fas fa-users" aria-hidden="true"></i> Users <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="/users/2"><i class="fas fa-users" aria-hidden="true"></i> Customers</a></li>
              @if( Auth::user()->type == -1 || Auth::user()->type == 3 )
              <li class="mini_list_w3"><a href="/users/1"> <i class="fas fa-user-tag" aria-hidden="true"></i> Staff</a></li>
              <li class="mini_list_w3"><a href="/users/3"> <i class="fas fa-user-tie" aria-hidden="true"></i> Administrators</a></li>
              @endif
              <li class="mini_list_w3"><a href="/users/4"> <i class="fas fa-user-clock" aria-hidden="true"></i> Casuals</a></li>
            </ul>
          </li>-->
          @if(Auth::check())
            @if(Auth::user()->type == -1 )
          <li>
            <a href="#"> <i class="fas fa-file-alt" aria-hidden="true"></i> Reports <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="{{route('booking-report.index')}}"><i class="fas fa-file-pdf" aria-hidden="true"></i> Booking report</a></li>
              <li class="mini_list_agile"><a href="{{route('procurement-report.index')}}"><i class="fas fa-file-pdf" aria-hidden="true"></i> Procurement report</a></li>
              <li class="mini_list_w3"><a href="{{route('inventory-report.index')}}"><i class="fas fa-file-pdf" aria-hidden="true"></i> Inventory report</a></li>
            </ul>
          </li>
            @endif
          @endif
          <li><a href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout</a></li>

        </ul>
      </div><!-- /gn-scroller -->
    </nav>
  </li>
  <!-- //nav_agile_w3l -->
  <li class="second logo"><h1><a href="/"><i class="fas fa-home" aria-hidden="true"></i>Esteem </a></h1></li>
					<li class="second admin-pic">
				       <ul class="top_dp_agile">
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">
												<span class="prfil-img"><img src="{{url('/images/avatar-male.png')}}" alt="" height="45" width="45"> </span>
											</div>
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
											<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li>
											<li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>

						</ul>
				</li>
				<li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Notifications"><i class="fa fa-bell" aria-hidden="true"></i> <span class="badge blue">4</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>Your Notifications</h3>
												</div>
											</li>
											<li><a href="#">
												<div class="user_img"><img src="{{url('/images/avatar-male.png')}}" alt=""></div>
											   <div class="notification_desc">
											     <h6>John Smith</h6>
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											  <div class="clearfix"></div>
											 </a></li>
											 <li class="odd"><a href="#">
												<div class="user_img"><img src="{{url('/images/avatar-male.png')}}" alt=""></div>
											   <div class="notification_desc">
											     <h6>Jasmin Leo</h6>
												<p>Lorem ipsum dolor</p>
												<p><span>3 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>
											 </a></li>
											 <li><a href="#">
												<div class="user_img"><img src="{{url('/images/avatar-male.png')}}" alt=""></div>
											   <div class="notification_desc">
											     <h6>James Smith</h6>
												<p>Lorem ipsum dolor</p>
												<p><span>2 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>
											 </a></li>
											  <li><a href="#">
												<div class="user_img"><img src="{{url('/images/avatar-male.png')}}" alt=""></div>
											   <div class="notification_desc">
											     <h6>James Smith</h6>
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>
											 </a></li>
											 <li>
												<div class="notification_bottom">
													<a href="#">See all Notifications</a>
												</div>
											</li>
										</ul>
									</li>

						</ul>
				</li>

				<li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
				       <li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Pending tasks"><i class="fa fa-tasks"></i><span class="badge blue">9</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 4 Pending tasks</h3>
												</div>
											</li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Database update</span><span class="percentage">40%</span>
													<div class="clearfix"></div>
												</div>
												<div class="progress progress-striped active">
													<div class="bar yellow" style="width:40%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
												   <div class="clearfix"></div>
												</div>
												<div class="progress progress-striped active">
													 <div class="bar green" style="width:90%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
													<div class="clearfix"></div>
												</div>
											   <div class="progress progress-striped active">
													 <div class="bar red" style="width: 33%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
												   <div class="clearfix"></div>
												</div>
												<div class="progress progress-striped active">
													 <div class="bar  blue" style="width: 80%;"></div>
												</div>
											</a></li>
											<li>
												<div class="notification_bottom">
													<a href="#">See all pending tasks</a>
												</div>
											</li>
										</ul>
									</li>
								</ul>
				</li>

        <li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Go to users"><i class="fas fa-users" aria-hidden="true"></i> </a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>Users</h3>
												</div>
											</li>
											<li><a href="/users/2">
												<div class="user_img"><img src="{{url('/images/fa/customers.png')}}" alt=""></div>
											   <div class="notification_desc">
											     <h6>Customers</h6>
												<p>Click to view customers</p>
												</div>
											  <div class="clearfix"></div>
											 </a></li>
                       <li><a href="/users/1">
 												<div class="user_img"><img src="{{url('/images/fa/staff.png')}}" alt=""></div>
 											   <div class="notification_desc">
 											     <h6>Staff</h6>
 												<p>Click to view staff</p>
 												</div>
 											  <div class="clearfix"></div>
 											 </a></li>
                       <li><a href="/users/4">
 												<div class="user_img"><img src="{{url('/images/fa/casuals.png')}}" alt=""></div>
 											   <div class="notification_desc">
 											     <h6>Casuals</h6>
 												<p>Click to view casuals</p>
 												</div>
 											  <div class="clearfix"></div>
 											 </a></li>
                       <li><a href="/users/5">
                         <div class="user_img"><img src="{{url('/images/fa/suppliers.png')}}" alt=""></div>
                          <div class="notification_desc">
                            <h6>Suppliers</h6>
                         <p>Click to view suppliers</p>
                         </div>
                         <div class="clearfix"></div>
                        </a></li>
											 <li>
                         <li><a href="/users/3">
   												<div class="user_img"><img src="{{url('/images/fa/admins.png')}}" alt=""></div>
   											   <div class="notification_desc">
   											     <h6>Admins</h6>
   												<p>Click to view admins</p>
   												</div>
   											  <div class="clearfix"></div>
   											 </a></li>
                         <li><a href="/users/-1">
   												<div class="user_img"><img src="{{url('/images/fa/super-admins.png')}}" alt=""></div>
   											   <div class="notification_desc">
   											     <h6>Super Admins</h6>
   												<p>Click to view super admins</p>
   												</div>
   											  <div class="clearfix"></div>
   											 </a></li>
												<div class="notification_bottom">
													<a href="{{url('/users')}}">Open all users</a>
												</div>
											</li>
										</ul>
									</li>

						</ul>
				</li>


				<li class="second w3l_search" style="border:0">

						<form action="#" method="post">
							<input type="search" name="search" placeholder="Search here..." required="">
							<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>

				</li>




</ul>
<!-- //nav -->

</div>
<div class="clearfix"></div>
<!-- //w3_agileits_top_nav-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
