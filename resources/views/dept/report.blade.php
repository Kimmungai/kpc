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

            <div class="cir_agile_info " >
            <h3 class="w3_inner_tittle">@if( isset($dept) ) {{$dept->name}} @endif department</h3>
                <div class="skill-grids">
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-1"></div>
                    <p>Purchases</p>
                  </div>
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-2"></div>
                    <p>Sales</p>
                  </div>
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-3"></div>

                    <p>Profit / loss</p>
                  </div>
                  <div class="skills-grid text-center">
                    <div class="circle" id="circles-4"></div>
                    <p>Workers</p>
                  </div>



                 <div class="clearfix"></div>

            </div>
          </div>
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
		<!--<input id="currentDeptID" type="hidden"  value="@if( isset($dept) ) {{$dept->id}} @endif">

		@component( 'components.purchases-modal',['dept' => $dept] )

		@endcomponent

		@component( 'components.bookings-modal',['dept' => $dept] )

		@endcomponent

		@component( 'components.transfers-modal',['dept' => $dept] )

		@endcomponent-->

@endsection
