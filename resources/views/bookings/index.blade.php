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
                  <li class="text-capitalize"><a href="/dept-registration/{{$dept->id}}">{{$dept->name}}</a> <span>«</span></li>
                  @endif
									<li>Bookings</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">
						<div class="container">
							<div class="row">
								<form class="" action="sort-bookings" method="get">
								<div class="col-xs-2">
									<p style="line-height:40px">Sort:</p>
								</div>
								<div class="col-xs-3">
									<select id="filter_sort" class="form-control1" name="filter_sort" >
										<option value="newOld" @if(isset($sortBy)) @if($sortBy == 'newOld' ) selected @endif @endif >New-Old</option>
										<option value="oldNew" @if(isset($sortBy)) @if($sortBy == 'oldNew' ) selected @endif @endif>Old-New</option>
										<option value="paidOnly" @if(isset($sortBy)) @if($sortBy == 'paidOnly' ) selected @endif @endif >Paid only</option>
										<option value="pendingOnly" @if(isset($sortBy)) @if($sortBy == 'pendingOnly' ) selected @endif @endif >Pending only</option>
										<option value="overPaidOnly" @if(isset($sortBy)) @if($sortBy == 'overPaidOnly' ) selected @endif @endif >Overpaid only</option>
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
	        <!-- //breadcrumbs -->



					<div class="container" >
						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Bookings </h1>
							<h4 class="pull-right  p-1 results-info">Showing: @if(isset($bookings)) {{count($bookings)}} of {{$bookings->total()}}@endif @if(isset($startDate))<span>from {{date('d-m-y',strtotime($startDate))}}</span>@endif @if(isset($endDate))<span>to {{date('d-m-y',strtotime($endDate))}}</span>@endif</h4>
							@endif
						</div>

						<div class="row">

							@if(isset($bookings))
								@foreach($bookings as $booking)
								<div class="col-sm-4 mb-2">
									<div class="action-tab bg-admin">
											<dl>
												<dt>
													<a href="{{route('bookings-registration.show',$booking->id)}}"><i class="fas fa-gift"></i></a>
													@if( $booking->bookingAmountDue - $booking->bookingAmountReceived <= 0 )
													<div class="status-sec">Paid <span class="fa fa-circle text-success"></span></div>
													@else
													<div class="status-sec">Pending <span class="fa fa-circle text-danger"></span></div>
													@endif

												</dt>
												<dd>
													<h3><a href="{{route('bookings-registration.show',$booking->id)}}">Booking-{{$booking->id}}</a></h3>
													@if( $booking->user )
													<p>Customer: <strong>{{$booking->user->firstName}}</strong></p>
													@endif
													<p>Date: <strong>{{date('d/m/Y',strtotime($booking->created_at))}}</strong></p>
													<p>Paid: <strong>Ksh. @if( !$booking->bookingAmountReceived ) 0 @else {{$booking->bookingAmountReceived}} @endif</strong></p>
													<p>Pending: <strong>Ksh. @if( !$booking->bookingAmountDue ) 0 @else {{$booking->bookingAmountDue - $booking->bookingAmountReceived}} @endif</strong></p>
													<a href="{{route('bookings-registration.show',$booking->id)}}" class="btn btn-x-sm  btn-dark" >Open</a>
												<dd>
											</dl>
										</div>
								</div>
								@endforeach
							@endif

						</div>
						<div class="row">
							@if(isset($bookings))
								{{$bookings->appends(request()->except('page'))->links()}}
							@endif
						</div>
					</div>

				</div>
		<!-- //inner_content-->
</div>

@endsection
