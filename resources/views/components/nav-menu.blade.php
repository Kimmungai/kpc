<!-- /w3_agileits_top_nav-->
<!-- /nav-->
<div class="w3_agileits_top_nav">

  <ul id="gn-menu" class="gn-nav-menu-main">
    <div class="row">

      <div class="col-sm-1" >
        <li class="trigger-btn">
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
      </div>

      <div class="col-sm-3"  style="padding-top:20px">
        <li class="app-title"><h1><a href="/">{{env('APP_NAME')}} </a></h1></li>
      </div>

      <div class="col-xs-3  col-sm-1" style="padding-bottom: 5px;">
        <li class="second admin-pic" style="padding:0;margin:0">
             <ul class="">
               @if(Auth::check())
                <li class="dropdown profile_details_drop">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <div class="profile_img">
                      @if(Auth::user()->avatar)
                        <span class="prfil-img"><img src="{{Auth::user()->avatar}}" alt="" height="45" width="45"> </span>
                      @else
                        <span class="prfil-img"><img src="@if(Auth::user()->gender == 1) {{url('/images/avatar-male.png')}} @else {{url('/images/avatar-female.png')}} @endif" alt="" height="45" width="45"> </span>
                      @endif
                    </div>
                  </a>
                  <ul class="dropdown-menu drp-mnu">
                    <li> <a href="{{url('/user-registration')}}/{{Auth::id()}}/edit"><i class="fa fa-cog"></i> Settings</a> </li>
                    <li> <a href="{{route('profile',Auth::id())}}"><i class="fa fa-user"></i> Profile</a> </li>
                    <li> <a href="#" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i> Logout</a> </li>
                  </ul>
                </li>
                @endif
          </ul>
      </li>
      </div>


      <div class="col-xs-3 col-sm-1" style="padding-bottom:5px;">
        <li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Notifications"><i class="fa fa-bell" aria-hidden="true"></i> <span class="badge blue">4</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>Bookings Notifications</h3>
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
													<a href="{{route('notifications.index')}}">See all Notifications</a>
												</div>
											</li>
										</ul>
									</li>

						</ul>
				</li>
      </div>
    @if(Auth::check())
      @if( Auth::user()->type == -1 || Auth::user()->type == 3 )
      <div class="col-xs-3 col-sm-1" style="padding-bottom:5px;">
        <li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
				       <li class="dropdown head-dpdn">
                   <?php $notificationCount = 0 ?>
                    @foreach( Auth::user()->unreadNotifications as $notification )
                      @if( $notification->type == 'App\Notifications\RequisitionRequest' )
                        <?php $notificationCount++ ?>
                      @endif
                    @endforeach
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Pending tasks"><i class="fa fa-tasks"></i>@if( $notificationCount )<span class="badge blue">{{$notificationCount}}</span>@endif</a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have {{$notificationCount}} Requisition Requests</h3>
												</div>
											</li>
                      <?php $count = 1 ?>
                      @foreach( Auth::user()->unreadNotifications as $notification )
                      <?php if( $count > 3){break;} ?>
                        @if( $notification->type == 'App\Notifications\RequisitionRequest' )
                          <li><a href="{{route( 'requisition.show', $notification->data['requisition_id'] )}}">
                          <div class="user_img"><img src="{{$notification->data['requester_avatar']}}" alt=""></div>
                           <div class="notification_desc">
                             <h6>{{$notification->data['requester_name']}}</h6>
                          <p>From {{$notification->data['dept_name']}} department</p>
                          <p><span>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span></p>
                          </div>
                           <div class="clearfix"></div>
                         </a></li>
                         <?php $count++ ?>
                        @endif
                      @endforeach


											<li>
												<div class="notification_bottom">
													<a href="{{route('requisition.index')}}">See all Requisition Requests</a>
												</div>
											</li>
                      
										</ul>
									</li>
								</ul>
				</li>
      </div>
      @elseif( Auth::user()->type == 1  )
      <div class="col-xs-3 col-sm-1" style="padding-bottom:5px;">
        <li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
				       <li class="dropdown head-dpdn">
                   <?php $notificationCount = 0 ?>
                    @foreach( Auth::user()->unreadNotifications as $notification )
                      @if( $notification->type == 'App\Notifications\RequisitionApproved' ||  $notification->type == 'App\Notifications\RequisitionRejected' )
                        <?php $notificationCount++ ?>
                      @endif
                    @endforeach
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Pending tasks"><i class="fa fa-tasks"></i>@if( $notificationCount )<span class="badge blue">{{$notificationCount}}</span>@endif</a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>Requisition request feedback</h3>
												</div>
											</li>
                      <?php $count = 1 ?>
                      @foreach( Auth::user()->unreadNotifications as $notification )
                      <?php if( $count > 3){break;} ?>
                        @if( $notification->type == 'App\Notifications\RequisitionApproved' ||  $notification->type == 'App\Notifications\RequisitionRejected' )
                          <li><a href="{{route( 'requisition.show', $notification->data['requisition_id'] )}}">
                          <div class="user_img"><img src="{{$notification->data['approver_avatar']}}" alt=""></div>
                           <div class="notification_desc">
                             <h6>{{$notification->data['approver_name']}}</h6>
                          <p>@if($notification->type == 'App\Notifications\RequisitionApproved') Approved @else Rejected @endif requisition {{$notification->data['requisition_id']}}</p>
                          <p><span>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span></p>
                          </div>
                           <div class="clearfix"></div>
                         </a></li>
                         <?php $count++ ?>
                        @endif
                      @endforeach


											<li>
												<div class="notification_bottom">
													<a href="{{route('requisition.index')}}">See all Requisition Requests</a>
												</div>
											</li>

										</ul>
									</li>
								</ul>
				</li>
      </div>
      @endif
    @endif



      <div class="col-xs-3 col-sm-1" style="padding-bottom:5px;">
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

                       <li><a href="/users/5">
                         <div class="user_img"><img src="{{url('/images/fa/suppliers.png')}}" alt=""></div>
                          <div class="notification_desc">
                            <h6>Suppliers</h6>
                         <p>Click to view suppliers</p>
                         </div>
                         <div class="clearfix"></div>
                        </a></li>
											 <li>


												<div class="notification_bottom">
													<a href="{{url('/users')}}">Open all users</a>
												</div>
											</li>
										</ul>
									</li>

						</ul>
				</li>
      </div>

      <div class="col-sm-3">
        <!--<li class="second w3l_search" style="border:0">

						<form action="#" method="post">
							<input type="search" name="search" placeholder="Search here..." required="">
							<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>

				</li>-->
        <div class="input-group" style="margin:15px 0 5px 0;">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-danger" type="button">Go!</button>
          </span>
        </div><!-- /input-group -->


      </div>

    </div>
  </ul>

</div>
<div class="clearfix"></div>
<!-- //w3_agileits_top_nav-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
