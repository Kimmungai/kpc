@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a></li>

	              </ul>
	            </div>
	          </div>
	        <!-- //breadcrumbs -->
				    <!-- /inner_content_w3_agile_info-->
					<div class="inner_content_w3_agile_info">
					<!-- /departments start-->
					<h1 class="text-capitalize">All departments</h1>

					 <div class="agile_top_w3_grids">

						 <?php $rows = ceil(count($depts) / 3); ?>
						 <?php $count = 0; $colors=0;?>
						 <?php $departmentsArr = []; ?>

						 @for( $x=0;$x<$rows;$x++ )
							 <ul class="ca-menu">
								@foreach( $depts as $Dept )

									<?php if(!in_array($Dept->id, $departmentsArr)) {$departmentsArr [] = $Dept->id;}else{continue;}?>
									<?php if($colors > 3){$colors =0;} ?>

									 <li style="width:32%">
										 <a href="{{url('dept-registration')}}/{{$Dept->id}}">
											 @if( strtolower($Dept->name) == 'kitchen' )
											 <i class="fa fa-fire" aria-hidden="true"></i>
											 @elseif( strtolower($Dept->name) == 'chapel' )
											 <i class="fa fa-building" aria-hidden="true"></i>
											 @elseif( strtolower($Dept->name) == 'shamba' )
											 <i class="fa fa-leaf" aria-hidden="true"></i>
											 @elseif( strtolower($Dept->name) == 'compound' )
											 <i class="fa fa-umbrella" aria-hidden="true"></i>
											 @elseif( strtolower($Dept->name) == 'administration' )
											 <i class="fa fa-user" aria-hidden="true"></i>
											 @elseif( strtolower($Dept->name) == 'store' )
											 <i class="fa fa-database" aria-hidden="true"></i>
											 @elseif( strtolower($Dept->name) == 'hospitality' )
											 <i class="fa fa-hotel" aria-hidden="true"></i>
											 @else
											 <i class="fa fa-tag" aria-hidden="true"></i>
											 @endif
											 <div class="ca-content">
												 <h4 class="ca-main @if($colors==1) one @elseif($colors==2) two @elseif($colors==3) three @endif text-capitalize">{{count($Dept->booking)}} @if(count($Dept->booking) == 1)<small>booking</small>@else <small>bookings</small> @endif</h4>
												 <h3 class="ca-sub @if($colors==1) one @elseif($colors==2) two @elseif($colors==3) three @endif text-capitalize">{{$Dept->name}}</h3>
											 </div>
										 </a>
									 </li>

									 <?php $count++; $colors++;?>
									 <?php if( $count % 3 == 0 ){break;} ?>

								 @endforeach

							 <div class="clearfix"></div>

						 </ul>
 					 @endfor
					 </div>

					 <!-- //departments end-->
						<!-- /agile_top_w3_post_sections-->
							<!--<div class="agile_top_w3_post_sections">
							       <div class="col-md-6 agile_top_w3_post agile_info_shadow" style="width:100%">
										   <div class="img_wthee_post">
										         <h3 class="w3_inner_tittle">Latest Report</h3>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">65,800,587 </h4><span class="year">Total Companies</span></div>
													<div class="year-info"><p class="text-no">20 </p><span class="year">This Year</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">2,690 </h4><span class="year">Total Companies</span></div>
													<div class="year-info"><p class="text-no">40 </p><span class="year">This Month</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">24,660 </h4><span class="year">Total Companies</span></div>
													<div class="year-info"><p class="text-no">30 </p><span class="year">This Week</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">1,204</h4><span class="year">Total Companies</span></div>
													<div class="year-info"><p class="text-no">10 </p><span class="year">This Day</span></div>
													<div class="clearfix"></div>
												</div>

											</div>
									   </div>

								       <div class="clearfix"></div>
							     </div>-->

						<!-- //agile_top_w3_post_sections-->
							<!-- /w3ls_agile_circle_progress-->
							<!--<div class="w3ls_agile_cylinder chart agile_info_shadow">
							<h3 class="w3_inner_tittle two"> Cylinder chart</h3>

									 <div id="chartdiv"></div>


							</div>-->
						<!-- /w3ls_agile_circle_progress-->
						<!-- /chart_agile-->

						  <!-- /w3ls_agile_circle_progress-->
							<!--<div class="w3ls_agile_circle_progress agile_info_shadow">

								<div class="cir_agile_info ">
								<h3 class="w3_inner_tittle">Circular Progress</h3>
									  <div class="skill-grids">
											<div class="skills-grid text-center">
												<div class="circle" id="circles-1"></div>
												<p>HTML</p>
											</div>
											<div class="skills-grid text-center">
												<div class="circle" id="circles-2"></div>
												<p>PHOTOGRAPHY</p>
											</div>
											<div class="skills-grid text-center">
												<div class="circle" id="circles-3"></div>

												<p>ILLUSTRATOR</p>
											</div>
											<div class="skills-grid text-center">
												<div class="circle" id="circles-4"></div>
												<p>CSS3</p>
											</div>



										 <div class="clearfix"></div>

								</div>
							</div>
						</div>-->
						<!-- /w3ls_agile_circle_progress-->
						 <!--/prograc-blocks_agileits-->
							<!--<div class="prograc-blocks_agileits">


								 <div class="col-md-6 bars_agileits agile_info_shadow">
								   <h3 class="w3_inner_tittle two">Daily Sales</h3>
										<div class='bar_group'>
												<div class='bar_group__bar thin' label='Rating' show_values='true' tooltip='true' value='343'></div>
												<div class='bar_group__bar thin' label='Quality' show_values='true' tooltip='true' value='235'></div>
												<div class='bar_group__bar thin' label='Amount' show_values='true' tooltip='true' value='550'></div>
												<div class='bar_group__bar thin' label='Farming' show_values='true' tooltip='true' value='456'></div>
										</div>
								</div>
								<div class="col-md-6 fallowers_agile agile_info_shadow">
									<h3 class="w3_inner_tittle two">Recent Followers</h3>
												<div class="work-progres">
													<div class="table-responsive">
														<table class="table table-hover">
														  <thead>
															<tr>
															  <th>#</th>
															  <th>Project</th>
															  <th>Manager</th>

															  <th>Status</th>
															  <th>Progress</th>
														  </tr>
													  </thead>
													  <tbody>
														<tr>
														  <td>1</td>
														  <td>Face book</td>
														  <td>Malorum</td>

														  <td><span class="label label-danger">in progress</span></td>
														  <td><span class="badge badge-info">50%</span></td>
													  </tr>
													  <tr>
														  <td>2</td>
														  <td>Twitter</td>
														  <td>Evan</td>

														  <td><span class="label label-success">completed</span></td>
														  <td><span class="badge badge-success">100%</span></td>
													  </tr>
													  <tr>
														  <td>3</td>
														  <td>Google</td>
														  <td>John</td>

														  <td><span class="label label-warning">in progress</span></td>
														  <td><span class="badge badge-warning">75%</span></td>
													  </tr>
													  <tr>
														  <td>4</td>
														  <td>LinkedIn</td>
														  <td>Danial</td>

														  <td><span class="label label-info">in progress</span></td>
														  <td><span class="badge badge-info">65%</span></td>
													  </tr>
													  <tr>
														  <td>5</td>
														  <td>Tumblr</td>
														  <td>David</td>

														  <td><span class="label label-warning">in progress</span></td>
														  <td><span class="badge badge-danger">95%</span></td>
													  </tr>
													  <tr>
														  <td>6</td>
														  <td>Tesla</td>
														  <td>Mickey</td>

														  <td><span class="label label-info">in progress</span></td>
														  <td><span class="badge badge-success">95%</span></td>
													  </tr>
												  </tbody>
											  </table>
											</div>
										</div>
								</div>
									 <div class="clearfix"></div>
							</div>-->

							  <!--//prograc-blocks_agileits-->


				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->

@endsection
