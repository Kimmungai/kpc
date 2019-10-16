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
						@if( isset($dept) )

							<div class="row mt-2">
								<form class="" action="dept-filtered-report" method="get">
								<div class="col-sm-2">
									<p style="line-height:40px">Sort:</p>
								</div>
								<div class="col-sm-3" style="overflow:hidden">
									<select  id="duration_sort" class="duration_sort form-control1" name="duration_sort" onchange="set_report_duration(this.value)">
										<option value="thisMonth" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'thisMonth' ) selected @endif @endif >This month</option>
										<option value="thisWeek" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'thisWeek' ) selected @endif @endif>This week</option>
										<option value="thisYear" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'thisYear' ) selected @endif @endif >This Year</option>
										<option value="today" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'today' ) selected @endif @endif >Today</option>
										<option value="dates" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'dates' ) selected @endif @endif >Choose specific dates</option>
									</select>
								</div>
								<div id="specific-dates" class="specific-dates @if(isset($_GET['duration_sort']))  @if($_GET['filter_from']=='' && $_GET['filter_to']=='') d-none hidden  @endif @else d-none hidden @endif">
									<div class="col-sm-2">
										<input type="text" id="filter_from" name="filter_from" class="form-control1" value="@if(isset($_GET['filter_from'])) {{$_GET['filter_from']}} @endif"  onchange="clear_max_field('filter_to')" placeholder="Date from">
									</div>
									<div class="col-sm-1 hidden-xs">
										<p style="line-height:40px">~</p>
									</div>
									<div class="col-sm-2">
										<input type="text" id="filter_to" name="filter_to" class="form-control1" value="@if(isset($_GET['filter_to'])) {{$_GET['filter_to']}} @endif" placeholder="Date to">
									</div>
							  </div>
								<input type="hidden" name="id" value="{{$dept->id}}">
								<div class="col-sm-2">
									<button type="submit" class="btn btn-xs btn-dark"><i class="fas fa-sort-amount-down"></i> Filter</button>
								</div>
							</form>

							</div>

						@endif
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
            <div class="cir_agile_info mt-2" >
            <h3 class="w3_inner_tittle text-center">@if( isset($dept) ) {{$dept->name}} @endif department
							<strong class="text-danger">
							@if(isset($_GET['duration_sort']))
								@if($_GET['duration_sort'] == 'thisWeek')
								{{date('Y')}}	week {{\Carbon\Carbon::now()->weekOfYear}}
								@endif
								@if($_GET['duration_sort'] == 'thisYear')
								{{date('Y')}}
								@endif
								@if($_GET['duration_sort'] == 'today')
								{{date('d M Y')}}
								@endif
								@if($_GET['duration_sort'] == 'dates')
									@if($_GET['filter_from'] != '')
										{{$_GET['filter_from']}}
									@else
									 	{{\Carbon\Carbon::now()->startOfMonth()->format('d/m/Y')}}
									@endif
									@if($_GET['filter_to'] != '')
										to
										{{$_GET['filter_to']}}
									@endif
								@endif
							@else
								{{date('M Y')}}
							@endif
						</strong>
						highlights
					</h3>
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

				 @if( isset($costs) && isset($revenues)  )
            <div class="col-md-6 bars_agileits agile_info_shadow">
              <h3 class="w3_inner_tittle two">Monthly statistics (Ksh.)</h3>
               <div class='bar_group'>
                   <div class='bar_group__bar thin' label='Costs' show_values='true' tooltip='true' value='{{$costs}}'></div>
                   <div class='bar_group__bar thin' label='Revenue' show_values='true' tooltip='true' value='{{$revenues}}'></div>
                   <div class='bar_group__bar thin' label='Profit' show_values='true' tooltip='true' value='{{$revenues - $costs}}'></div>
                   <!--<div class='bar_group__bar thin' label='Farming' show_values='true' tooltip='true' value='456'></div>-->
               </div>
           </div>
					 @endif
					 @if( isset($dept->purchase) )
           <div class="col-md-6 fallowers_agile agile_info_shadow">
             <h3 class="w3_inner_tittle two">Recent Purchases</h3>
                   <div class="work-progres">

                     <div class="resp-table">
                       <table class="">
                         <thead>
                         <tr>
                           <td style="background:#fff;">#</td>
                           <td style="background:#fff;">Date</td>
                           <td style="background:#fff;">Supplier</td>
                           <td style="background:#fff;">Status</td>
                           <td style="background:#fff;">Action</td>
                         </tr>
                       </thead>
                       <tbody>
												 <?php $count = 1; ?>
											@foreach( $dept->purchase as $purchase )
											  <?php if($count>5){break;} ?>
												@if( $purchase->amountDue - $purchase->amountPaid > 0 )
	                       <tr>
	                         <td data-label="#" style="background:#fff;">Purchase-{{$purchase->id}}</td>
	                         <td data-label="Date" style="background:#fff;">{{date('d/m/Y',strtotime($purchase->created_at))}}</td>
	                         <td data-label="Supplier" style="background:#fff;">{{$purchase->user->firstName}}</td>
	                         <td data-label="Status" style="background:#fff;"><span class="label label-danger">unpaid</span></td>
	                         <td data-label="Action" style="background:#fff;"><a href="/purchases-registration/{{$purchase->id}}">Open</a></td>
	                       </tr>
												 @else
	                       <tr>
													 <td data-label="#" style="background:#fff;">Purchase-{{$purchase->id}}</td>
	                         <td data-label="Date" style="background:#fff;">{{date('d/m/Y',strtotime($purchase->created_at))}}</td>
	                         <td data-label="Supplier" style="background:#fff;">{{$purchase->user->firstName}}</td>
	                         <td data-label="Status" style="background:#fff;"><span class="label label-success">paid</span></td>
	                         <td data-label="Action" style="background:#fff;"><a href="/purchases-registration/{{$purchase->id}}">Open</a></td>
	                       </tr>
												 @endif
												 <?php $count++; ?>
											 @endforeach
                     </tbody>
                   </table>
									 @if( isset($dept->purchase) )
										 @if( count($dept->purchase) > 5 )
										 <a class="btn btn-default" href="/purchases-registration">view all purchases</a>
										 @endif
									 @endif
                 </div>

               </div>
           </div>
              <div class="clearfix"></div>
         </div>
				 @endif
           <!--//prograc-blocks_agileits-->

				    <!-- /inner_content_w3_agile_info-->
				@if(isset($dept->product))
					@if(count($dept->product) > 2)
					<div class="inner_content_w3_agile_info">

							<!-- /w3ls_agile_circle_progress-->
							<div class="w3ls_agile_cylinder chart agile_info_shadow">
							<h3 class="w3_inner_tittle two"> Recent Stock level overview</h3>
							<a href="/product-registration" class="btn btn-default">View all products</a>
									 <div id="chartdiv"></div>


							</div>
						<!-- /w3ls_agile_circle_progress-->
						<!-- /chart_agile-->



				    </div>
					@endif
				@endif
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
