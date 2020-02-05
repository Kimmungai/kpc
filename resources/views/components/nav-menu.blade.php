<!-- /w3_agileits_top_nav-->
<!-- /nav-->
<div  class="w3_agileits_top_nav">

  <ul id="gn-menu" class="gn-nav-menu-main">
    <div class="row">

      <div class="col-sm-1" >
        <li class="trigger-btn">
          <a class="gn-icon gn-icon-menu" style="padding:0"><i class="fa fa-bars" aria-hidden="true"></i><span>Menu</span></a>
          <nav class="gn-menu-wrapper">
            <div class="gn-scroller scrollbar1">
              <ul class="gn-menu agile_menu_drop">
                <li><a href="/"> <i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{route('bank.show',1)}}"> <i class="fas fa-wallet"></i> Bank</a></li>
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
                    <li class="mini_list_w3"><a href="{{route('profit-loss-report.index')}}"><i class="fas fa-file-pdf" aria-hidden="true"></i> P & L report</a></li>
                    <li class="mini_list_w3"><a href="{{route('balance-sheet-report.index')}}"><i class="fas fa-file-pdf" aria-hidden="true"></i> Balance sheet report</a></li>
                    <li class="mini_list_w3"><a href="{{route('sales-report.index')}}"><i class="fas fa-chart-line" aria-hidden="true"></i> Sales report</a></li>
                    <li class="mini_list_w3"><a href="{{route('expenditure-report.index')}}"><i class="fas fa-chart-bar" aria-hidden="true"></i> Total expenditure report</a></li>
                    <li class="mini_list_w3"><a href="{{route('revenue-report.index')}}"><i class="fas fa-chart-pie" aria-hidden="true"></i> Total revenue report</a></li>
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

      @if(Auth::check())
        @if( Auth::user()->type == -1 || Auth::user()->type == 3 || Auth::user()->type == 1 )
      <div class="col-xs-3 col-sm-1" style="padding-bottom:5px;">
        <li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
             <?php $notificationCount = 0 ?>
              @foreach( Auth::user()->unreadNotifications as $notification )
                @if( $notification->type == 'App\Notifications\NewBooking' )
                  <?php $notificationCount++ ?>
                @endif
              @endforeach
									<li id="app" class="dropdown head-dpdn">
										<notification-component :id="{{Auth::id()}}" :unreads="{{Auth::user()->unreadNotifications}}"></notification-component>
										<ul id="bookings-notification-dropdown" class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have {{$notificationCount}} new bookings notifications</h3>
												</div>
											</li>
                      <?php $count = 0 ?>
                      @foreach( Auth::user()->unreadNotifications as $notification )

                        @if( $notification->type == 'App\Notifications\NewBooking' )
                        <?php $count++ ?>
    											<li><a href="{{route('bookings-registration.show',$notification->data['booking_id'])}}">
    												<div class="user_img"><img src="{{url('/images/avatar-male.png')}}" alt=""></div>
    											   <div class="notification_desc">
                               <h6>By: {{$notification->data['booker_name']}}</h6>
                            <p>In: {{$notification->data['dept_name']}} department</p>
                            <p><span>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span></p>
    												</div>
    											  <div class="clearfix"></div>
    											 </a></li>
                          @endif
                          <?php if($count > 2){break;} ?>
                        @endforeach



											 <li>
												<div class="notification_bottom">
													<a href="{{route('bookings-registration.index')}}">See all Bookings</a>
												</div>
											</li>
										</ul>
									</li>

						</ul>
				</li>
      </div>
      @endif
    @endif

    @if(Auth::check())
      @if( Auth::user()->type == -1 || Auth::user()->type == 3 || Auth::user()->type == 1 )
    <!--<div class="col-xs-3 col-sm-1" style="padding-bottom:5px;">
      <li class="second top_bell_nav">
         <ul class="top_dp_agile ">
           <?php $notificationCount = 0 ?>
            @foreach( Auth::user()->unreadNotifications as $notification )
              @if( $notification->type == 'App\Notifications\NewBooking' )
                <?php $notificationCount++ ?>
              @endif
            @endforeach
                <li class="dropdown head-dpdn">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="Notifications"><i class="fas fa-external-link-alt" aria-hidden="true"></i> @if($notificationCount) <span class="badge blue">{{$notificationCount}}</span> @endif</a>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="notification_header">
                        <h3>You have {{$notificationCount}} transfer notifications</h3>
                      </div>
                    </li>
                    @foreach( Auth::user()->unreadNotifications as $notification )
                      @if( $notification->type == 'App\Notifications\NewBooking' )
                        <li><a href="{{route('bookings-registration.show',$notification->data['booking_id'])}}">
                          <div class="user_img"><img src="{{url('/images/avatar-male.png')}}" alt=""></div>
                           <div class="notification_desc">
                             <h6>By: {{$notification->data['booker_name']}}</h6>
                          <p>In: {{$notification->data['dept_name']}} department</p>
                          <p><span>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span></p>
                          </div>
                          <div class="clearfix"></div>
                         </a></li>
                        @endif
                      @endforeach



                     <li>
                      <div class="notification_bottom">
                        <a href="{{route('bookings-registration.index')}}">See all Bookings</a>
                      </div>
                    </li>
                  </ul>
                </li>

          </ul>
      </li>
    </div>-->
    @endif
  @endif

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
                          <p>@if($notification->type == 'App\Notifications\RequisitionApproved') Approved @else Rejected @endif requisition @if(isset($notification->data['requisition_number'])){{$notification->data['requisition_number']}}@endif</p>
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

<!--<div class="aa-input-container" id="aa-input-container">
    <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search" name="search"
        autocomplete="off" />
    <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
        <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
    </svg>
</div>-->
        <!--<div class="input-group" style="margin:15px 0 5px 0;">
          <input type="text" class="form-control" placeholder="Search department">
          <span class="input-group-btn">
            <button class="btn btn-danger" type="button">Go!</button>
          </span>
        </div>--><!-- /input-group -->


      </div>

    </div>
  </ul>

</div>
<div class="clearfix"></div>
<!-- //w3_agileits_top_nav-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
