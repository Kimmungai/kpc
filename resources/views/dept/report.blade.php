@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<div class="w3l_agileits_breadcrumbs">
						<div class="w3l_agileits_breadcrumbs_inner">
							<ul>
								<li><a href="/home">Home</a> <span>«</span></li>
								<li class="text-capitalize"><a href="/dept-registration/{{$dept->id}}">{{$dept->name}}</a> <span>«</span></li>
								@if( isset($dept) )
								<li class="text-capitalize">{{$dept->name}} Reports</li>
								@endif
							</ul>
						</div>
					</div>
	        <!-- //breadcrumbs -->


					<!--<h1 class="text-uppercase">@if( isset($dept) ) {{$dept->name}} @endif department</h1>-->
          <!-- /w3ls_agile_circle_progress-->
        	<div class="w3ls_agile_circle_progress agile_info_shadow">

						<!--sorting-->
						<div class="container">
							<div class="row">
								<form class="" action="sort-purchases" method="get">
								<div class="col-xs-2">
									<p style="line-height:40px">Sort:</p>
								</div>
								<div class="col-xs-3">
									<select id="filter_sort" class="form-control1" name="filter_sort" >
										<option value="thisMonth" @if(isset($sortBy)) @if($sortBy == 'thisMonth' ) selected @endif @endif >This month</option>
										<option value="thisWeek" @if(isset($sortBy)) @if($sortBy == 'thisWeek' ) selected @endif @endif>This week</option>
										<option value="thisYear" @if(isset($sortBy)) @if($sortBy == 'thisYear' ) selected @endif @endif >This Year</option>
										<option value="today" @if(isset($sortBy)) @if($sortBy == 'today' ) selected @endif @endif >Today</option>
									</select>
								</div>

								<div class="col-xs-2">
									<input type="text" id="filter_from" name="filter_from" class="form-control1" value="" placeholder="Date from">
								</div>
								<div class="col-xs-1">
									<p style="line-height:40px">~</p>
								</div>
								<div class="col-xs-2">
									<input type="text" id="filter_to" name="filter_to" class="form-control1" value="" placeholder="Date to">
								</div>
								<div class="col-xs-2">
									<button type="submit" class="btn btn-xs btn-dark"><i class="fas fa-sort-amount-down"></i> Filter</button>
								</div>
								</form>
							</div>
						</div>
						<!--end sorting-->


						<?php
						//variables
						$costsPercent = 0;$revenuesPercent = 0;$bookingsPercent = 0;$stockPercent = 0;
						$costs = 0;$revenues = 0; ?>

						 @foreach( $dept->purchase as $purchase )
							 <?php $costs += $purchase->amountPaid; ?>
						 @endforeach

						 @foreach( $dept->booking as $booking )
							 <?php $revenues += $booking->bookingAmountReceived; ?>
						 @endforeach

						 <?php
						 //percentages
						 if($dept->targetCosts){$costsPercent = ($costs / $dept->targetCosts) * 100;}
						 if($dept->targetRevenues){$revenuesPercent = ($revenues / $dept->targetRevenues) * 100;}
						 if($dept->bookingCapacity){$bookingsPercent = (count($dept->booking) / $dept->bookingCapacity) * 100;}
						 if($dept->stockCapacity){$stockPercent = (count($dept->product) / $dept->stockCapacity) * 100;}
						  ?>


					@if( $costsPercent && $revenuesPercent && $bookingsPercent && $stockPercent )
            <div class="cir_agile_info " >
            <h3 class="w3_inner_tittle">@if( isset($dept) ) {{$dept->name}} @endif department <strong class="text-danger">{{date('M Y')}}</strong> highlights</h3>
                <div class="skill-grids">
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-0"></div>
                    <p>Costs</p>
                  </div>
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-1"></div>
                    <p>Revenues</p>
                  </div>
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-2"></div>

                    <p>Bookings</p>
                  </div>
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-3"></div>
                    <p>Stock</p>
                  </div>



                 <div class="clearfix"></div>

            </div>
          </div>
					@endif
        </div>
        <!-- /w3ls_agile_circle_progress-->



        <!--/prograc-blocks_agileits-->
         <div class="prograc-blocks_agileits">


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
             <h3 class="w3_inner_tittle two">Recent Purchases</h3>
                   <div class="work-progres">
                     <div class="table-responsive">
                       <table class="table table-hover">
                         <thead>
                         <tr>
                           <th>#</th>
                           <th>Date</th>
                           <th>Supplier</th>

                           <th>Status</th>
                           <th>Action</th>
                         </tr>
                       </thead>
                       <tbody>
                       <tr>
                         <td>1</td>
                         <td>12/12/1990</td>
                         <td>Malorum</td>

                         <td><span class="label label-danger">unpaid</span></td>
                         <td><a href="#">Open</a></td>
                       </tr>
                       <tr>
                         <td>2</td>
                         <td>12/12/1990</td>
                         <td>Evan</td>

                         <td><span class="label label-success">paid</span></td>
                         <td><a href="#">Open</a></td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </div>
           </div>
              <div class="clearfix"></div>
         </div>

           <!--//prograc-blocks_agileits-->

				    <!-- /inner_content_w3_agile_info-->
					<div class="inner_content_w3_agile_info">

							<!-- /w3ls_agile_circle_progress-->
							<div class="w3ls_agile_cylinder chart agile_info_shadow">
							<h3 class="w3_inner_tittle two"> Stock overview</h3>

									 <div id="chartdiv"></div>


							</div>
						<!-- /w3ls_agile_circle_progress-->
						<!-- /chart_agile-->



				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
		@if( $costsPercent && $revenuesPercent && $bookingsPercent && $stockPercent )
		<!-- /circle-->
			 <script type="text/javascript" src="{{url('site-theme/js/circles.js') }}"></script>
							         <script>
										var colors = [
												['#ffffff', '#53d769'], ['#ffffff', '#fc3158'],['#ffffff', '#fd9426'], ['#ffffff', '#147efb']
											];

											var percentages = [{{$costsPercent}},{{$revenuesPercent}},{{$bookingsPercent}},{{$stockPercent}}];

										for (var i = 0; i <= 3; i++) {
											var child = document.getElementById('circles-' + i),
												percentage = percentages[i];

											Circles.create({
												id:         child.id,
												percentage: percentage,
												radius:     80,
												width:      10,
												number:   	percentage / 1,
												text:       '%',
												colors:     colors[i - 1]
											});
										}

						</script>
			<!-- //circle -->
@endif

@endsection
