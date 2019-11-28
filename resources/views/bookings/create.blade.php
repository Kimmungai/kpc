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
									<li><a href="/bookings-registration">Bookings</a> <span>«</span></li>
                  <li>New Booking</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">

				<form id="booking-form" class="" action="index.html" method="post">

					 <div class="row mt-2">
				 		<div class="col-sm-12 ">
				 			<button type="submit" class="btn btn-default btn-lg mb-1 pull-right"><span class="fa fa-save"></span> Save</button>
				 		</div>
				 	</div>


						<div class="row">

							<div class="col-sm-7 mb-2">
								<!--booking form-->
								<h4 id="formTitle" class="mb-2 text-bold">Booking form</h4>

								<div class="row">
									<div class="col-sm-12 ">
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-gift"></i></span>
										  <select class="form-control" name="bookingType">
												@if( isset($dept) )
													@if( $dept->DeptBookingTypes )
														@foreach( $dept->DeptBookingTypes as $type )
															<option value="{{$type->price}}"> {{$type->type}} </option>
														@endforeach
													@endif
												@endif
										  </select>
										</div>
										<div id="numPpleTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-users"></i> <i class="text-danger">*</i></span>
										  <input name="numPple" id="numPple" type="number" class="form-control numeric" value="{{old('numPple')}}" placeholder="Number of people" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" required>
										</div>
										<div id="chkInDateTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i> <i class="text-danger">*</i></span>
										  <input type="text" name="chkInDate" id="chkInDate" class="form-control" placeholder="Start Date" onblur="validate(this.id,{required:1,min:3,max:255},this.value)">
										</div>
										<div id="chkOutDateTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i></span>
										  <input type="text" name="chkOutDate" id="chkOutDate" class="form-control" placeholder="End Date" onblur="validate(this.id,{required:0,min:3,max:255},this.value)">
										</div>
										<div id="bookingAmountDueTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-money-bill"></i></span>
										  <input name="bookingAmountDue" id="bookingAmountDue" type="text" class="form-control numeric" value="{{old('bookingAmountDue')}}" placeholder="Amount due" disabled>
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-info-circle"></i></span>
											<select class="form-control" name="modeOfPayment"  id="modeOfPayment">
												<option value="1">Paid in cash</option>
												<option value="2">Paid by cheque</option>
												<option value="3">Paid by bank transfer</option>
												<option value="4">Paid by MPESA</option>
											</select>
										</div>
										<div id="transactionCodeTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-money-check"></i></span>
										  <input type="text" id="transactionCode" class="form-control" name="transactionCode" placeholder="E.g MPESA transaction code, cheque number etc" onblur="validate(this.id,{required:0,min:3,max:255},this.value)">
										</div>
										<div id="bookingAmountReceivedTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-money-bill"></i></span>
										  <input name="bookingAmountReceived" id="bookingAmountReceived" type="number" class="form-control numeric" value="{{old('bookingAmountReceived')}}" placeholder="Amount Received" onblur="validate(this.id,{required:0,min:3,max:255},this.value)"  >
										</div>
										<div id="paymentDueDateTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i></span>
										  <input type="text" name="paymentDueDate" id="paymentDueDate" class="form-control" placeholder="Payment Due Date" onblur="validate(this.id,{required:0,min:3,max:255},this.value)">
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-sm-12 ">
										<h4 class="mb-2 text-bold">Other Booked products</h4>

										<div class="supplier-details box-shdow-4">
											<div class="input-group mb-0" >
											  <span class="input-group-addon" id=""><span class="fa fa-search"></span></span>
											  <input id="otherProductsSearch" type="text" class="form-control search-input" placeholder="Search by product name..." onkeyup="kpc_search(this.value,this.id,@if(isset($dept)){{$dept->id}}@endif,'product')">
											</div>

											<div id="otherProductsSearchPanel" class="search-panel-lg hidden">


											</div>

										</div>



									</div>
								</div>

								<div class="row">

									<div class="col-sm-12">
										<div class="resp-table ">
											<table id="otherProductsSearchTable" class="bg-white hidden" >
												<thead>
													<tr>
														<td>#</td>
														<td>Name</td>
														<td>Description</td>
														<td>Quantity</td>
														<td>Selling price</td>
														<td>Total</td>
													</tr>
												</thead>
												<tbody>

												</tbody>
												<tfoot>
													<tr>
														<td colspan="4"></td>
														<td>Grand Total</td>
														<td id="booked_prods_grand_total" class="text-bold"></td>
														<input type="hidden" name="booked_prods_grand_total" value="">
													</tr>
												</tfoot>
											</table>
									 </div>
									</div>
								</div>



								<!--end booking form-->

							</div>

							<div class="col-sm-5">
								<!--Customer details-->
								<div class="supplier-details box-shdow-1 mb-2 text-center">
									<legend>Total Due</legend>
									<h3 class="text-danger text-bold">KES 50,000</h3>
								</div>

								<div id="bookingCustomerSearchPanel" class="supplier-details box-shdow-1 mb-2">
									<legend>Search</legend>
									<div  class="input-group">
									  <span class="input-group-addon" ><span class="fa fa-search"></span></span>
									  <input type="text" class="form-control" placeholder="Search customer by name..." aria-describedby="basic-addon1">
									</div>
									<a href="#" onclick="event.preventDefault();toggleElements('bookingCustomerRegPanel','bookingCustomerSearchPanel')">Create new customer instead</a>
								</div>

								<div id="bookingCustomerRegPanel" class="supplier-details box-shdow-1 mb-2 hidden">
									<legend>Customer Registration Form</legend>
									<div class="alert alert-danger cust-errors-list hidden" role="alert">
										<h5>Please correct the following errors first</h5>
										<p class="cust-name-error hidden">The name must be atleast 3 characters</p>
										<p class="cust-phone-number-error hidden">The phone number must be numeric and atleast 10 digits</p>
										<p class="cust-email-error hidden">The email must be valid</p>
										<p class="cust-avatar-error hidden">The image must be 1MB or less. Only jpg bmp jpeg png formats allowed.</p>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div id="bookingCustomerNameTitle" class="input-group">
											  <span class="input-group-addon" ><span class="fa fa-user-tag"></span> <i class="text-danger">*</i></span>
											  <input id="bookingCustomerName" type="text" class="form-control" placeholder="Name" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" >
											</div>
										</div>

										<div id="bookingCustomerPhoneTitle" class="col-sm-6">
											<div class="input-group">
											  <span class="input-group-addon" ><span class="fa fa-phone"></span> <i class="text-danger">*</i></span>
											  <input id="bookingCustomerPhone" type="text" class="form-control numeric" placeholder="Phone" onblur="validate(this.id,{required:1,min:10,max:255},this.value)" >
											</div>
										</div>

										<div id="bookingCustomerEmailTitle" class="col-sm-6">
											<div class="input-group">
											  <span class="input-group-addon" ><span class="fa fa-envelope"></span> <i class="text-danger">*</i></span>
											  <input id="bookingCustomerEmail" type="email" class="form-control" placeholder="Email" onblur="validate(this.id,{required:1,min:3,max:255,type:'email'},this.value)" >
											</div>
										</div>

										<div id="bookingCustomerAvatarTitle" class="col-sm-6">
											<div class="input-group">
											  <span class="input-group-addon" ><span class="fa fa-image"></span></span>
											  <input id="bookingCustomerAvatar" type="file" class="form-control" onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)" >
											</div>
										</div>


									</div>

									<button type="button" class="btn btn-default btn-block mb-1" onclick="booking_create_customer()">Submit details</button>


									<a href="#" onclick="event.preventDefault();toggleElements('bookingCustomerSearchPanel','bookingCustomerRegPanel')" >Search customer instead</a>

								</div>

								<div id="bookingCustomerDetails" class="supplier-details box-shdow-1 hidden">

									<div class="row">
										<div class="col-xs-8">
											<legend>Customer details</legend>
											<ul class="pt-1">
												<li id="bookingCustomerNameLabel"><span class="fa fa-user"></span> </li>
												<li id="bookingCustomerPhoneLabel"><span class="fa fa-phone"></span></li>
												<li id="bookingCustomerEmailLabel"><span class="fa fa-envelope"></span> </li>
											</ul>
										</div>
										<div class="col-xs-4">
											<span class="fas fa-times-circle close" onclick="remove_booking_customer()"></span>
											<img class="thumbnail img-responsive" id="bookingCustomerAvatarLabel" src="" alt="" >
										</div>
									</div>

								</div>
								<!--End customer details-->
								@if( isset($dept) )
								@if( count($dept->DeptServices) )

								<div class="supplier-details box-shdow-1 mb-2 mt-1">
									<legend>Other services</legend>
									<div class="row">

										<?php $count = 0; ?>

										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptServices as $service )
													@if( $count % 2 != 0 )
														<li>
															<input id="" type="checkbox" value="{{$service->id}}"> {{$service->service}}
													  </li>
													@endif
													<?php $count++; ?>
												@endforeach
											</ul>
										</div>

										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptServices as $service )
													@if( $count % 2 == 0 )
														<li>
															<input id="" type="checkbox" value="{{$service->id}}"> {{$service->service}}
													  </li>
													@endif
													<?php $count++; ?>
												@endforeach
											</ul>
										</div>


									</div>

								</div>
								@endif
								@endif

								@if( isset($dept) )
								@if( count($dept->DeptMenu) )

								<div class="supplier-details box-shdow-1 mb-2 mt-1">
									<legend>Menu details</legend>
									<div class="row">

										<?php $count = 0; ?>

										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptMenu as $menu )
													@if( $count % 2 != 0 )
														<li>
															<input id="" type="checkbox" value="{{$menu->price}}"> {{$menu->name}}
													  </li>
													@endif
													<?php $count++; ?>
												@endforeach
											</ul>
										</div>

										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptMenu as $menu )
													@if( $count % 2 == 0 )
														<li>
															<input id="" type="checkbox" value="{{$menu->price}}"> {{$menu->name}}
													  </li>
													@endif
													<?php $count++; ?>
												@endforeach
											</ul>
										</div>


									</div>

								</div>
								@endif
								@endif



							</div>
						</div>

						<div class="row mt-2">
							<div class="col-sm-12 ">
								<button type="submit" class="btn btn-default btn-lg mt-1 pull-right"><span class="fa fa-save"></span> Save</button>
							</div>
						</div>

						<input type="hidden" name="user_id" >

</form>
				</div>
		<!-- //inner_content-->
</div>

@endsection
