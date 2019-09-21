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



  <li class="second top_bell_nav">
     <ul class="top_dp_agile ">
         <li class="dropdown head-dpdn">
              <a href="#" class="dropdown-toggle"  aria-expanded="false" title="Logout" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i><!--<span class="badge blue">9</span>--></a>

            </li>
          </ul>
  </li>



</ul>
<!-- //nav -->

</div>
<div class="clearfix"></div>
<!-- //w3_agileits_top_nav-->
