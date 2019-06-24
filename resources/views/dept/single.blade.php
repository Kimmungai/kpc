@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a> <span>«</span></li>
                  @if( isset($dept) )
                  <li class="text-capitalize">{{$dept->name}}</li>
                  @endif
	              </ul>
	            </div>
	          </div>
	        <!-- //breadcrumbs -->
					<!--stock options buttons-->
					<!--<div class="container" >
						<div class="row">
							<div class="col-sm-4">
								<div class="button" style="background:#f0ad4e" data-toggle="modal" data-target="#recordPurchasesModal">
								 <p class="btnText">Purchases</p>
								 <div class="btnTwo">
									 <p class="btnText2"><i class="fas fa-money-check-alt"></i></p>
								 </div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="button" style="background:#5bc0de" data-toggle="modal" data-target="#recordBookingsModal">
								 <p class="btnText">Bookings</p>
								 <div class="btnTwo">
									 <p class="btnText2"><i class="fas fa-gift"></i></p>
								 </div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="button" style="background:#337ab7" data-toggle="modal" data-target="#recordTransfersModal">
								 <p class="btnText">Transfers</p>
								 <div class="btnTwo">
									 <p class="btnText2"><i class="fas fa-external-link-alt"></i></p>
								 </div>
								</div>
							</div>

						</div>

					</div>-->
					<!--end stock options buttons-->
					<!--<h1 class="text-uppercase">@if( isset($dept) ) {{$dept->name}} @endif department</h1>-->
          <!-- /w3ls_agile_circle_progress-->
        	<div class="w3ls_agile_circle_progress agile_info_shadow">

            <div class="cir_agile_info ">
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

						<!--/forms-->
				<div class="forms-main_agileits">


							<!--/forms-inner-->
									<div class="forms-inner">


										 <!--/set-3-->

											<div class="wthree_general">


													<div class="grid-1 graph-form agile_info_shadow">
													@if( count($errors) )
														<h3 class="w3_inner_tittle two red-text">There are some errors, please correct them first.</h3>
													@endif
													 <h3 class="w3_inner_tittle two">@if( isset($dept) ) {{$dept->name}} @endif department Registration details </h3>
													 @component( 'components.confirm-modal',[ 'formId' => 'DeptForm', 'heading' => 'Department datails', 'message' => 'Are you sure you want to update department details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please update' ] )

													 @endcomponent

													 @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteDeptForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

													 @endcomponent

													 <form class="form-horizontal" id="DeptForm" action="{{route('dept-registration.update',$dept->id)}}" method="post" enctype="multipart/form-data">
														 @csrf
												     @method('PUT')

														 @component( 'components.dept-reg-form',['dept'=>$dept] )

														 @endcomponent


														 <div class="button" data-toggle="modal" data-target="#confirmModal">
															<p class="btnText">Update?</p>
															<div class="btnTwo">
																<p class="btnText2">GO!</p>
															</div>
														 </div>

														 <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
															<p class="btnText">Delete?</p>
															<div class="btnTwo">
																<p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
															</div>
														 </div>

													 </form>

													 <form class="d-none hidden" id="deleteDeptForm" action="{{route('dept-registration.update',$dept->id)}}" method="post">
												     @csrf
												     @method('DELETE')
												   </form>


											</div>
										</div>
										<!--//set-3-->

									</div>
								<!--//forms-inner-->
							</div>
					<!--//forms-->

				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
		<input id="currentDeptID" type="hidden"  value="@if( isset($dept) ) {{$dept->id}} @endif">

		@component( 'components.purchases-modal',['dept' => $dept] )

		@endcomponent

		@component( 'components.bookings-modal',['dept' => $dept] )

		@endcomponent

		@component( 'components.transfers-modal',['dept' => $dept] )

		@endcomponent

@endsection
