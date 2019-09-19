<!-- /w3_agileits_top_nav-->
<!-- /nav-->
<div class="w3_agileits_top_nav">
<ul id="gn-menu" class="gn-menu-main">
       <!-- /nav_agile_w3l -->
  <li class="gn-trigger">
    <a class="gn-icon gn-icon-menu"><i class="fa fa-bars" aria-hidden="true"></i><span>Menu</span></a>
    <nav class="gn-menu-wrapper">
      <div class="gn-scroller scrollbar1">
        <ul class="gn-menu agile_menu_drop">
          <li><a href="/"> <i class="fas fa-home"></i> Home</a></li>
          <li>
            <a href="/users"><i class="fas fa-building" aria-hidden="true"></i> Departments <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              @foreach( $allDepts as $dept )
                @if( strtolower($dept->name) == 'kitchen' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_agile"><a href="/dept-registration/1"><i class="fas fa-utensils" aria-hidden="true"></i> Kitchen</a></li>
                @endif
                @if( strtolower($dept->name) == 'chapel' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/2"> <i class="fas fa-church" aria-hidden="true"></i> Chapel</a></li>
                @endif
                @if( strtolower($dept->name) == 'shamba' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/3"> <i class="fas fa-tractor" aria-hidden="true"></i> Shamba</a></li>
                @endif
                @if( strtolower($dept->name) == 'compound' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/4"> <i class="fas fa-umbrella-beach" aria-hidden="true"></i> Compound</a></li>
                @endif
                @if( strtolower($dept->name) == 'administration' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/5"> <i class="fas fa-user-tie" aria-hidden="true"></i> Administration</a></li>
                @endif
                @if( strtolower($dept->name) == 'store' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/6"> <i class="fas fa-store-alt" aria-hidden="true"></i> Store</a></li>
                @endif
                @if( strtolower($dept->name) == 'hospitality' && ( Auth::user()->type == -1 || Auth::user()->dept == $dept->id ) )
                  <li class="mini_list_w3"><a href="/dept-registration/7"> <i class="fas fa-bed" aria-hidden="true"></i> Hospitality</a></li>
                @endif
              @endforeach
            </ul>
          </li>
          <li>
            <a href="/users"><i class="fas fa-users" aria-hidden="true"></i> Users <i class="fas fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="/users/2"><i class="fas fa-users" aria-hidden="true"></i> Customers</a></li>
              @if( Auth::user()->type == -1 || Auth::user()->type == 3 )
              <li class="mini_list_w3"><a href="/users/1"> <i class="fas fa-user-tag" aria-hidden="true"></i> Staff</a></li>
              <li class="mini_list_w3"><a href="/users/3"> <i class="fas fa-user-tie" aria-hidden="true"></i> Administrators</a></li>
              @endif
              <li class="mini_list_w3"><a href="/users/4"> <i class="fas fa-user-clock" aria-hidden="true"></i> Casuals</a></li>
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
  <!-- //nav_agile_w3l -->
  <li class="second logo"><h1 style="font-size:14px;"><a href="/home"><i class="fa fa-graduation-cap" aria-hidden="true"></i>{{env('APP_NAME')}}</a></h1></li>
    <!--<li class="second admin-pic">
         <ul class="top_dp_agile">
            <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img">
                  @if(Auth::check())
                    <span class="prfil-img"><img src="{{Auth::user()->avatar}}" alt="" height="50" width="50"> </span>
                  @endif
                </div>
              </a>
              <ul class="dropdown-menu drp-mnu">
                <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li>
                <li> <a href="#" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a> </li>
              </ul>
            </li>

      </ul>
  </li>-->
  <li class="second top_bell_nav">
    <ul class="top_dp_agile ">
           <li class="dropdown head-dpdn">
             <a href="{{url('/')}}" class="dropdown-toggle"  aria-expanded="true" title="Go to home page"><i class="fa fa-home" aria-hidden="true"></i> </a>

           </li>

     </ul>
  </li>

 @if( Auth::user()->type == -1 ||  Auth::user()->type == 3 || Auth::user()->type == 1 )
  <li class="second top_bell_nav">
     <ul class="top_dp_agile ">
            <li class="dropdown head-dpdn">
              <a href="{{url('/users')}}" class="dropdown-toggle"  aria-expanded="true" title="See all users"><i class="fa fa-users" aria-hidden="true"></i> </a>

            </li>

      </ul>
  </li>
  @endif

  @if( Auth::user()->type == -1 )
  <li class="second top_bell_nav">
     <ul class="top_dp_agile ">
            <li class="dropdown head-dpdn">
              @if( Request::is('/') || Request::is('dept-registration/*') )
                <a href="{{url('/dept-registration/create')}}" class="dropdown-toggle"  aria-expanded="true" title="Add new department"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
              @elseif( Request::is('user-registration') || Request::is('user-registration/*') || Request::is('users') || Request::is('users/*'))
                <a href="{{url('/user-registration/create')}}" class="dropdown-toggle"  aria-expanded="true" title="Create new user"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
              @endif
            </li>

      </ul>
  </li>
  @endif

  <li  class="second w3l_search" style="border:0">
    <form action="#" method="post">
      <input type="search" name="" value="">
    </form>
  </li>

  <li class="second top_bell_nav">
     <ul class="top_dp_agile ">
         <li class="dropdown head-dpdn">
              <a href="#" class="dropdown-toggle"  aria-expanded="false" title="Logout" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i><!--<span class="badge blue">9</span>--></a>
              <!--<ul class="dropdown-menu">
                <li>
                  <div class="notification_header">
                    <h3>Quick links</h3>
                  </div>
                </li>
                @if( isset($dept) )
                @if( $dept != null )
                <li><a href="/bookings-registration">
                  <div class="task-info">
                    <span class="task-desc">{{$dept->name}} bookings</span><span class="percentage"></span>
                     <div class="clearfix"></div>
                  </div>
                  <div class="progress progress-striped active">
                     <div class="bar green" style="width:100%;"></div>
                  </div>
                </a></li>
                <li><a href="/purchases-registration">
                  <div class="task-info">
                    <span class="task-desc">{{$dept->name}} purchases</span><span class="percentage"></span>
                    <div class="clearfix"></div>
                  </div>
                   <div class="progress progress-striped active">
                     <div class="bar red" style="width: 100%;"></div>
                  </div>
                </a></li>
                @endif
                @endif
                <li><a href="/users">
                  <div class="task-info">
                    <span class="task-desc">Users</span><span class="percentage"></span>
                     <div class="clearfix"></div>
                  </div>
                  <div class="progress progress-striped active">
                     <div class="bar  blue" style="width: 100%;"></div>
                  </div>
                </a></li>
                <li><a href="/users/2">
                  <div class="task-info">
                    <span class="task-desc">Customers</span><span class="percentage"></span>
                    <div class="clearfix"></div>
                  </div>
                  <div class="progress progress-striped active">
                    <div class="bar yellow" style="width:100%;"></div>
                  </div>
                </a></li>
              </ul>-->
            </li>
          </ul>
  </li>

  <!--<li class="second w3l_search" style="border:0">

      <form action="#" method="post">-->
        <!--<input type="search" name="search" placeholder="Search here..." required="">-->
        <!--<select class="" name="">
          <option value="" disabled selected> Choose Report </option>

          @if(isset($dept))
            @if($dept)
              <option value="{{$dept->id}}">{{$dept->name}} Profit & Loss</option>
              <option value="{{$dept->id}}">{{$dept->name}} Balance sheet</option>
            @endif
          @endif

          @if(Auth::check())
            @if(Auth::user()->type == 3 )
              <option>Overall Profits & Loss</option>
              <option>Overall Balance Sheet</option>
            @endif
          @endif

        </select>
        <button class="btn btn-default" type="submit"><i class="fa fa-download" aria-hidden="true"></i></button>
      </form>

  </li>-->
  <!--<li class="second full-screen">
    <section class="full-top">
      <button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
    </section>
  </li>-->

</ul>
<!-- //nav -->

</div>
<div class="clearfix"></div>
<!-- //w3_agileits_top_nav-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
