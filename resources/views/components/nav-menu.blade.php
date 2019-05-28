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
          <li><a href="main-page.html"> <i class="fa fa-tachometer"></i> Dashboard</a></li>
          <li>
            <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> UI Components <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="buttons.html"><i class="fa fa-caret-right" aria-hidden="true"></i> Buttons</a></li>
              <li class="mini_list_w3"><a href="grids.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Grids</a></li>
            </ul>
          </li>
          <li>
            <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i>Forms <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="input.html"><i class="fa fa-caret-right" aria-hidden="true"></i> Inputs</a></li>
              <li class="mini_list_w3"><a href="validation.html"><i class="fa fa-caret-right" aria-hidden="true"></i> Validation</a></li>
            </ul>
          </li>
          <li><a href="table.html"> <i class="fa fa-table" aria-hidden="true"></i> Tables</a></li>
          <li><a href="#"><i class="fa fa-list" aria-hidden="true"></i>Short Codes <i class="fa fa-angle-down" aria-hidden="true"> </i></a>
                <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="typo.html"><i class="fa fa-caret-right" aria-hidden="true"></i> Typography</a></li>
              <li class="mini_list_w3"><a href="icons.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Icons</a></li>

            </ul>
          </li>

          <li><a href="charts.html"> <i class="fa fa-line-chart" aria-hidden="true"></i> Charts</a></li>
          <li><a href="maps.html"><i class="fa fa-map-o" aria-hidden="true"></i> Maps</a></li>
          <li class="page">
            <a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
               <ul class="gn-submenu">

              <li class="mini_list_agile"> <a href="signin.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Sign In</a></li>
               <li class="mini_list_w3"><a href="signup.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Sign Up</a></li>
               <li class="mini_list_agile error"><a href="404.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Error 404 </a></li>

              <li class="mini_list_w3_line"><a href="calendar.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Calendar</a></li>
            </ul>
          </li>
          <li>
            <a href="#"> <i class="fa fa-suitcase" aria-hidden="true"></i>More <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="faq.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Faq</a></li>
              <li class="mini_list_w3"><a href="blank.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Blank Page</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /gn-scroller -->
    </nav>
  </li>
  <!-- //nav_agile_w3l -->
  <li class="second logo"><h1 style="font-size:14px;"><a href="/home"><i class="fa fa-graduation-cap" aria-hidden="true"></i>{{env('APP_NAME')}}</a></h1></li>
    <li class="second admin-pic">
         <ul class="top_dp_agile">
            <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img">
                  <span class="prfil-img"><img src="{{Auth::user()->avatar}}" alt="" height="50" width="50"> </span>
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
              <a href="{{url('/user-registration')}}" class="dropdown-toggle"  aria-expanded="true" title="See all users"><i class="fa fa-users" aria-hidden="true"></i> </a>

            </li>

      </ul>
  </li>
  <li class="second top_bell_nav">
     <ul class="top_dp_agile ">
            <li class="dropdown head-dpdn">
              <a href="{{url('/dept-registration/create')}}" class="dropdown-toggle"  aria-expanded="true" title="Add new department"><i class="fa fa-plus-square" aria-hidden="true"></i></a>

            </li>

      </ul>
  </li>
  <li class="second top_bell_nav">
     <ul class="top_dp_agile ">
         <li class="dropdown head-dpdn">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">9</span></a>
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

  <li class="second w3l_search">

      <form action="#" method="post">
        <input type="search" name="search" placeholder="Search here..." required="">
        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>

  </li>
  <li class="second full-screen">
    <section class="full-top">
      <button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
    </section>
  </li>

</ul>
<!-- //nav -->

</div>
<div class="clearfix"></div>
<!-- //w3_agileits_top_nav-->
