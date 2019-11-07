@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
						<div class="w3l_agileits_breadcrumbs">
							<div class="w3l_agileits_breadcrumbs_inner">
								<ul>
									<li><a href="/home">Home</a><span>«</span></li>
									<li>Users</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->
				    <!-- /inner_content_w3_agile_info-->
					<div class="inner_content_w3_agile_info">

					<!-- /departments start-->
					<h4 class="text-capitalize text-bold mb-1">All users</h4>
					<div class="row">
						<div class="col-md-12">
							<a href="{{url('/user-registration/create')}}" class="btn btn-default pull-right" title="Create new user">New user <span class="fas fa-user-plus"></span></a>
						</div>
					</div>
					   <div class="agile_top_w3_grids">
							 <div class="row">

					          <ul class="ca-menu">
										<div class="col-sm-4">
                    <li >
                      <a href="{{url('users')}}/2">

                        <i class="fas fa-users" aria-hidden="true"></i>
                        <div class="ca-content">
													@if(isset($usersCount['customers']))
                          	<h4 class="ca-main three">{{number_format($usersCount['customers'])}}</h4>
													@endif
                          <h3 class="ca-sub">Customers</h3>
                        </div>
                      </a>
                    </li>
									</div>

									@if(Auth::user()->type == -1 || Auth::user()->type == 3 )
									<div class="col-sm-4">

									<li >
										<a href="{{url('users')}}/1">
										  <i class="fas fa-user-tag" aria-hidden="true"></i>
											<div class="ca-content">
												@if(isset($usersCount['staff']))
													<h4 class="ca-main three">{{number_format($usersCount['staff'])}}</h4>
												@endif
												<h3 class="ca-sub four">Staff</h3>
											</div>
										</a>
									</li>
								</div>
									@endif
									<div class="col-sm-4">

									<li >
	                  <a href="{{url('users')}}/4">

	                    <i class="fas fa-user-clock" aria-hidden="true"></i>
	                    <div class="ca-content">
												@if(isset($usersCount['casuals']))
													<h4 class="ca-main three">{{number_format($usersCount['casuals'])}}</h4>
												@endif
	                      <h3 class="ca-sub one">Casuals</h3>
	                    </div>
	                  </a>
	                </li>
								</div>

								@if(Auth::user()->type == -1 || Auth::user()->type == 3 )
								<div class="col-sm-4">
								<li >
									<a href="{{url('users')}}/5">

										<i class="fas fa-user-check" aria-hidden="true"></i>
										<div class="ca-content">
											@if(isset($usersCount['suppliers']))
												<h4 class="ca-main four">{{number_format($usersCount['suppliers'])}}</h4>
											@endif
											<h3 class="ca-sub ">Suppliers</h3>
										</div>
									</a>
								</li>
							</div>
								@endif

								@if(Auth::user()->type == -1 || Auth::user()->type == 3 )
								<div class="col-sm-4">
								<li >
									<a href="{{url('users')}}/3">
										<i class="fas fa-user-tie" aria-hidden="true"></i>
										<div class="ca-content">
											@if(isset($usersCount['administrators']))
												<h4 class="ca-main three">{{number_format($usersCount['administrators'])}}</h4>
											@endif
											<h3 class="ca-sub four">Administrators</h3>
										</div>
									</a>
								</li>
							</div>
								@endif

								@if(isset($usersCount['super_admins']))
								<div class="col-sm-4">
								<li >
									<a href="{{url('users')}}/-1">
										<i class="fas fa-user-secret" aria-hidden="true"></i>
										<div class="ca-content">

												<h4 class="ca-main three">{{number_format($usersCount['super_admins'])}}</h4>

											<h3 class="ca-sub one">Super Administrators</h3>
										</div>
									</a>
								</li>
							</div>
								@endif
								<div class="clearfix"></div>

							</ul>

							</div>

					   </div>
					 <!-- //departments end-->

				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->

@endsection
