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
					<!-- /inner_content_w3_agile_info-->
			 <div class="inner_content_w3_agile_info">
					<!--stock options buttons-->
					<!--<div class="container" >
						<div class="row">
							<div class="col-sm-4">
								<div class="button" style="background:#f0ad4e" >
								 <p class="btnText">Purchases</p>
								 <div class="btnTwo">
									 <p class="btnText2"><i class="fas fa-money-check-alt"></i></p>
								 </div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="button" style="background:#5bc0de" >
								 <p class="btnText">Bookings</p>
								 <div class="btnTwo">
									 <p class="btnText2"><i class="fas fa-gift"></i></p>
								 </div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="button" style="background:#337ab7" >
								 <p class="btnText">Transfers</p>
								 <div class="btnTwo">
									 <p class="btnText2"><i class="fas fa-external-link-alt"></i></p>
								 </div>
								</div>
							</div>

						</div>

					</div>-->
					<!--end stock options buttons-->


					<div class="container" >
						<div class="row">
							<h1 class="text-capitalize mb-2">{{$dept->name}}</h1>
						</div>

						<div class="row">

							<div class="col-sm-4 mb-2">
								<div class="action-tab bg-admin">
										<dl>
											<dt>
												<a href="/purchases-registration"><i class="fas fa-money-check-alt"></i></a>
											</dt>
											<dd>
												<h3><a href="/purchases-registration">Purchases</a></h3>
												<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 spend</p>
												<a href="#" class="btn btn-x-sm  btn-dark" data-toggle="modal" data-target="#recordPurchasesModal">New purchase</a>
											<dd>
										</dl>
									</div>
							</div>

							<div class="col-sm-4 mb-2">
								<div class="action-tab bg-admin">
										<dl>
											<dt>
												<a href="/bookings-registration"><i class="fas fa-gift"></i></a>
											</dt>
											<dd>
												<h3><a href="/bookings-registration">Bookings</a></h3>
												<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>
												<a href="#" class="btn btn-x-sm btn-dark" data-toggle="modal" data-target="#recordBookingsModal">New booking</a>
											<dd>
										</dl>
									</div>
							</div>

							<div class="col-sm-4 mb-2">
								<div class="action-tab bg-admin">
										<dl>
											<dt>
												<a href="{{route('dept report',$dept->id)}}"><i class="fas fa-file"></i></a>
											</dt>
											<dd>
												<h3><a href="{{route('dept report',$dept->id)}}">Reports</a></h3>
												<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>
												<a href="{{route('dept report',$dept->id)}}" class="btn btn-x-sm btn-dark">View reports</a>
											<dd>
										</dl>
									</div>
							</div>

							<div class="col-sm-4 mb-2">
								<div class="action-tab bg-admin">
										<dl>
											<dt>
												<a href="#" data-toggle="modal" data-target="#recordTransfersModal"><i class="fas fa-external-link-alt"></i></a>
											</dt>
											<dd>
												<h3><a href="#" data-toggle="modal" data-target="#recordTransfersModal">Transfers</a></h3>
												<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>
												<a href="#" class="btn btn-x-sm btn-dark" data-toggle="modal" data-target="#recordTransfersModal">Transfer stock</a>
											<dd>
										</dl>
									</div>
							</div>

							<div class="col-sm-4 mb-2">
								<div class="action-tab bg-admin">
										<dl>
											<dt>
												<a href="/dept-registration/{{$dept->id}}/edit"><i class="fas fa-edit"></i></a>
											</dt>
											<dd>
												<h3><a href="/dept-registration/{{$dept->id}}/edit">Dept Details</a></h3>
												<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>
												<a href="/dept-registration/{{$dept->id}}/edit" class="btn btn-x-sm btn-dark">Edit details</a>
											<dd>
										</dl>
									</div>
							</div>

						</div>
					</div>

				</div>
		<!-- //inner_content-->
	</div>
		<input id="currentDeptID" type="hidden"  value="@if( isset($dept) ) {{$dept->id}} @endif">

		@component( 'components.purchases-modal',['dept' => $dept] )

		@endcomponent

		@component( 'components.bookings-modal',['dept' => $dept] )

		@endcomponent

		@component( 'components.transfers-modal',['dept' => $dept] )

		@endcomponent

@endsection
