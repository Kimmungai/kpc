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

					<!--end stock options buttons-->


					 <h4 class="text-bold text-capitalize">{{$dept->name}} department</h4>

						<div class="row">

							<div class="col-sm-4 mt-2 mb-2">
								<div class="action-tab ">
										<dl>
											<dt>
												<a href="/purchases-registration"><i class="fas fa-money-bill-wave"></i></a>
											</dt>
											<dd>
												<h3><a href="/purchases-registration">Purchases</a></h3>
												<p class="text-underline">This month</p>
												@if( isset($dept->purchase) )
												<?php $totalAmountPaid=0;//get total amountPaid  ?>
												@foreach( $dept->purchase as $purchase )
													<?php $totalAmountPaid += $purchase->amountPaid; ?>
												@endforeach
													<p><strong>{{count($dept->purchase)}}</strong> @if(count($dept->purchase)==1) purchase @else purchases @endif</p>
													<p>Ksh. <strong>{{number_format($totalAmountPaid,2)}}</strong> spent</p>
												@endif
												<a href="{{route('requisition.create')}}" class="btn btn-x-sm  btn-default mt-1" >New purchase</a>
												<!--<a href="#" class="btn btn-x-sm  btn-default" data-toggle="modal" data-target="#recordPurchasesModal">New purchase</a>-->
											<dd>
										</dl>
									</div>
							</div>

							<div class="col-sm-4 mt-2 mb-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="/bookings-registration"><i class="fa fa-gift"></i></a>
											</dt>
											<dd>
												<h3><a href="/bookings-registration">Bookings</a></h3>
												<p class="text-underline">This month</p>
												@if( isset($dept->booking) )
													<?php $totalAmountReceived=0;//get total amountPaid  ?>
													@foreach( $dept->booking as $booking )
														<?php $totalAmountReceived += $booking->bookingAmountReceived; ?>
													@endforeach
													<p><strong>{{count($dept->booking)}}</strong> @if(count($dept->booking)==1) booking @else bookings @endif</p>
													<p>Ksh. <strong>{{number_format($totalAmountReceived,2)}}</strong> made</p>
												@endif
												<!--<a href="#" class="btn btn-x-sm btn-default" data-toggle="modal" data-target="#recordBookingsModal">New booking</a>-->

												<a href="/bookings-registration/create" class="btn btn-x-sm btn-default mt-1">New booking</a>
											<dd>
										</dl>
									</div>
							</div>
							@if( Auth::user()->type == -1 || Auth::user()->type == 3 )
							<div class="col-sm-4 mt-2 mb-2" >
								<div class="action-tab ">
										<dl>
											<dt>
												<a href="{{route('dept report',$dept->id)}}"><i class="fa fa-file"></i></a>
													@if( ($totalAmountReceived - $totalAmountPaid)  > 0 )
													<div class="status-sec">Profit <span class="fa fa-circle text-success"></span></div>
													@elseif( ($totalAmountReceived - $totalAmountPaid)  == 0  )
													<div class="status-sec">balanced <span class="fa fa-circle text-warning"></span></div>
													@else
													<div class="status-sec">Loss <span class="fa fa-circle text-danger"></span></div>
													@endif
											</dt>
											<dd>
												<h3><a href="{{route('dept report',$dept->id)}}">Reports</a></h3>
												<p class="text-underline">This month</p>
												@if( $dept->purchase && $dept->booking )
													<p><strong>{{count($dept->purchase)}}</strong> @if(count($dept->purchase)==1) purchase @else purchases @endif</p>
													<p><strong>{{count($dept->booking)}} </strong>@if(count($dept->booking)==1) booking @else bookings @endif</p>
												@endif
												<a href="{{route('dept report',$dept->id)}}" class="btn btn-x-sm btn-default mt-1">View reports</a>
											<dd>
										</dl>
									</div>
							</div>
							@endif

							<div class="col-sm-4 mb-2 mt-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="{{route('expenditure.index')}}"><i class="fas fa-chevron-circle-down"></i></a>
											</dt>
											<dd>
												<h3 class="mb-2"><a href="{{route('expenditure.index')}}">Expenses</a></h3>
												<!--<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>-->
												<!--<a href="#" class="btn btn-x-sm btn-default" data-toggle="modal" data-target="#recordTransfersModal">Transfer stock</a>-->
												<a href="{{route('expenditure.create')}}" class="btn btn-x-sm btn-default" >New expense</a>

											<dd>
										</dl>
									</div>
							</div>
							<div class="col-sm-4 mb-2 mt-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="{{route('revenue.index')}}"><i class="fas fa-chevron-circle-up"></i></a>
											</dt>
											<dd>
												<h3 class="mb-2"><a href="{{route('revenue.index')}}">Revenue</a></h3>
												<!--<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>-->
												<a href="{{route('revenue.create')}}" class="btn btn-x-sm btn-default">New revenue</a>
											<dd>
										</dl>
									</div>
							</div>
							<div class="col-sm-4 mb-2 mt-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="{{route('sale.index')}}"><i class="fas fa-chart-line"></i></a>
											</dt>
											<dd>
												<h3 class="mb-2"><a href="{{route('sale.index')}}">Sales</a></h3>
												<!--<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>-->
												<a href="{{route('product-registration.index')}}" class="btn btn-x-sm btn-default">New sale</a>
											<dd>
										</dl>
									</div>
							</div>

							<div class="col-sm-4 mb-2 mt-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="/product-registration/"><i class="fa fa-database"></i></a>
											</dt>
											<dd>
												<h3 @if( Auth::user()->type != 1  ) class="mb-2" @endif><a href="/dept-registration/{{$dept->id}}/edit">Stock</a></h3>
												@if( Auth::user()->type == 1  )
												<p class="text-underline">Click to view</p>
												<p>Available stock</p>
												<p>Edit products</p>
												@endif
												<a href="/product-registration/" class="btn btn-x-sm btn-default">Open</a>
											<dd>
										</dl>
									</div>
							</div>

							@if( Auth::user()->type == -1 || Auth::user()->type == 3 )
							<div class="col-sm-4 mb-2 mt-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="{{route('transfer',$dept->id)}}" ><i class="fas fa-external-link-alt"></i></a>
											</dt>
											<dd>
												<h3 class="mb-2"><a href="{{route('transfer',$dept->id)}}" >Transfers</a></h3>
												<!--<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>-->
												<!--<a href="#" class="btn btn-x-sm btn-default" data-toggle="modal" data-target="#recordTransfersModal">Transfer stock</a>-->
												<a href="{{route('transfer',$dept->id)}}" class="btn btn-x-sm btn-default" >Transfer stock</a>

											<dd>
										</dl>
									</div>
							</div>
							@endif
							@if( Auth::user()->type == -1 || Auth::user()->type == 3 )
							<div class="col-sm-4 mb-2 mt-2">
								<div class="action-tab">
										<dl>
											<dt>
												<a href="/dept-registration/{{$dept->id}}/edit"><i class="fa fa-edit"></i></a>
											</dt>
											<dd>
												<h3 class="mb-2"><a href="/dept-registration/{{$dept->id}}/edit">Details</a></h3>
												<!--<p class="text-underline">This month</p>
												<p>50 purchases</p>
												<p>Ksh. 50,0000 made</p>-->
												<a href="/dept-registration/{{$dept->id}}/edit" class="btn btn-x-sm btn-default">Edit details</a>
											<dd>
										</dl>
									</div>
							</div>
							@endif




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
