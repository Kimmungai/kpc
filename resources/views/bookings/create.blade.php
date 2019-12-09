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
				<form id="booking-form" class="" action="{{route('bookings-registration.store')}}" method="post" >
					@csrf
					 <div class="row mt-2">
				 		<div class="col-sm-12 ">
				 			<button type="button" class="btn btn-default btn-lg mb-1 pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Save</button>
				 		</div>
				 	</div>

					<div class="alert alert-danger alert-dismissible @if(!count($errors)) hidden @endif" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h5>The form contains errors. Please correct them first!</h5>
					</div>


						<div class="row">

							<div class="col-sm-7 mb-2">
								<!--booking form-->
								<h4 id="formTitle" class="mb-2 text-bold">Booking form</h4>

								<div class="row">
									<div class="col-sm-12 ">
										<div class="input-group input-group-md @if($errors->has('bookingType')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fas fa-gift"></i></span>
										  <select id="bookingType" class="form-control calc-costs-onchange" name="bookingType">
												<option value="0" data-price="0" selected>Choose a booking type</option>
												@if( isset($dept) )
													@if( $dept->DeptBookingTypes )
														@foreach( $dept->DeptBookingTypes as $type )
															<option value="{{$type->id}}" data-price="{{$type->price}}" @if(old('bookingType') == $type->id) selected @elseif(isset($booking)) @if($booking->bookingType ==$type->id) selected @endif @endif > {{$type->type}} </option>
														@endforeach
													@endif
												@endif
										  </select>
										</div>
										<div id="numPpleTitle" class="input-group input-group-md @if($errors->has('numPple')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fas fa-users"></i> <i class="text-danger">*</i></span>
										  <input name="numPple" id="numPple" type="number" class="form-control numeric calc-costs-onchange" value="@if(old('numPple')){{old('numPple')}}@elseif(isset($booking)) {{$booking->numPple}} @endif" placeholder="Number of people" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" required>
										</div>
										@if( $dept->has_rooms == 1 )<!-- 1 has rooms, -1 no rooms -->
										<div id="roomIdTitle" class="input-group input-group-md @if($errors->has('dept_rooms_id')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fas fa-bed"></i> </span>
											<select id="roomId" class="form-control calc-costs-onchange" name="dept_rooms_id">
												<option value="0" data-price="0" selected>Choose a room type</option>
												@foreach( $dept->DeptRooms as $room )
													<option value="{{$room->id}}" data-price="{{$room->price}}" @if(old('dept_rooms_id') == $room->id) selected @elseif(isset($booking)) @if($booking->dept_rooms_id ==$room->id) selected @endif @endif>{{$room->type}}</option>
												@endforeach
											</select>
										</div>
										@endif
										<div id="chkInDateTitle" class="input-group input-group-md @if($errors->has('chkInDate')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i> <i class="text-danger">*</i></span>
										  <input type="text" name="chkInDate" id="chkInDate" class="form-control calc-costs-onchange" placeholder="Start Date" onblur="validate(this.id,{required:0,min:3,max:255},this.value)" value="@if(old('chkInDate')){{old('chkInDate')}}@elseif(isset($booking)) {{$booking->chkInDate}} @endif" required>
										</div>
										<div id="chkOutDateTitle" class="input-group input-group-md @if($errors->has('chkOutDate')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i></span>
										  <input type="text" name="chkOutDate" id="chkOutDate" class="form-control calc-costs-onchange" placeholder="End Date" onblur="validate(this.id,{required:0,min:3,max:255},this.value)" value="@if(old('chkOutDate')){{old('chkOutDate')}}@elseif(isset($booking)) {{$booking->chkOutDate}} @endif" >
										</div>
										<!--<div id="bookingAmountDueTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-money-bill"></i></span>
										  <input name="bookingAmountDue" id="bookingAmountDue" type="text" class="form-control numeric" value="{{old('bookingAmountDue')}}" placeholder="Amount due" disabled>
										</div>-->
										<div class="input-group input-group-md @if($errors->has('modeOfPayment')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fas fa-info-circle"></i></span>
											<select class="form-control" name="modeOfPayment"  id="modeOfPayment">
												<option value="1" @if(old('modeOfPayment') == 1) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==1) selected @endif @endif>Paid in cash</option>
												<option value="2" @if(old('modeOfPayment') == 2) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==2) selected @endif @endif>Paid by cheque</option>
												<option value="3" @if(old('modeOfPayment') == 3) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==3) selected @endif @endif>Paid by bank transfer</option>
												<option value="4" @if(old('modeOfPayment') == 4) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==4) selected @endif @endif>Paid by MPESA</option>
											</select>
										</div>
										<div id="transactionCodeTitle" class="input-group input-group-md @if($errors->has('transactionCode')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fas fa-money-check"></i></span>
										  <input type="text" id="transactionCode" class="form-control" name="transactionCode" placeholder="E.g MPESA transaction code, cheque number etc" onblur="validate(this.id,{required:0,min:3,max:255},this.value)" value="@if(old('transactionCode')){{old('transactionCode')}}@elseif(isset($booking)) {{$booking->transactionCode}} @endif">
										</div>
										<div id="bookingAmountReceivedTitle" class="input-group input-group-md @if($errors->has('bookingAmountReceived')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fas fa-money-bill"></i></span>
										  <input name="bookingAmountReceived" id="bookingAmountReceived" type="number" class="form-control numeric" value="@if(old('bookingAmountReceived')){{old('bookingAmountReceived')}}@elseif(isset($booking)) {{$booking->bookingAmountReceived}} @endif" placeholder="Amount Received" value="0" onblur="validate(this.id,{required:0,min:1,max:255},this.value)"  value="{{old('bookingAmountReceived')}}">
										</div>
										<div id="paymentDueDateTitle" class="input-group input-group-md @if($errors->has('paymentDueDate')) has-error @endif">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i></span>
										  <input type="text" name="paymentDueDate" id="paymentDueDate" class="form-control" placeholder="Payment Due Date" onblur="validate(this.id,{required:0,min:3,max:255},this.value)" value="@if(old('paymentDueDate')){{old('paymentDueDate')}}@elseif(isset($booking)) {{$booking->paymentDueDate}} @endif">
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-sm-12 ">
										<h4 class="mb-2 text-bold">Other Booked products</h4>

										<div id="booked-prods-error" class="alert alert-danger alert-dismissible hidden" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h5>Please enter correct values for the fields in red.</h5>
										</div>

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
											<table id="otherProductsSearchTable" class="bg-white @if(!old('no_products'))  hidden @elseif(isset($booking)) @if(!$booking->no_products) hidden @endif @endif" >
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
													<!---<input name="col__2" type="text" class="form-control" placeholder="" min="" max="" value="'+value+'" onchange="assign_new_val(this.value,\'col__2\',2)" onfocusout="toggleShow(\'col__2_editor\',\'col__2\',2)" onkeyup="max_field_input(this)"> FOR QUANTITY-->

													@if(old('no_products'))
														@for( $x = 1; $x <= old('no_products'); $x++ )
														<tr id="booked-prods-row-{{$x}}" data-product="{{old('col_'.$x.'_7')}}">
															<td id="col_{{$x}}_1" data-label="#"><span class="fas fa-times-circle" onclick="remove_row_hide_empty_table('booked-prods-row-{{$x}}', 'otherProductsSearchTable' )"></span> &nbsp;&nbsp;&nbsp;{{$x}}</td>
															<td  data-label="Name"> <span id="col_{{$x}}_2"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_2')}}</span>
																<span id="col_{{$x}}_2_editor" class="hidden">
																	<input name="col_{{$x}}_2" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_2')}}" onchange="assign_new_val(this.value,'col_{{$x}}_2',2)" onfocusout="toggleShow('col_{{$x}}_2_editor','col_{{$x}}_2',2)" >
																</span>
															</td>
															<td  data-label="Description"> <span id="col_{{$x}}_3"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_3')}}</span>
																<span id="col_{{$x}}_3_editor" class="hidden">
																	<input name="col_{{$x}}_3" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_3')}}" onchange="assign_new_val(this.value,'col_{{$x}}_3',2)" onfocusout="toggleShow('col_{{$x}}_3_editor','col_{{$x}}_3',2)" >
																</span>
															</td>
															<td  data-label="Quantity"> <span id="col_{{$x}}_4"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_4')}}</span>
																<span id="col_{{$x}}_4_editor" class="hidden">
																	<input name="col_{{$x}}_4" type="number" class="form-control numeric" placeholder="" min="1" max="{{old('col_'.$x.'_4_max')}}" value="{{old('col_'.$x.'_4')}}" onchange="assign_new_val(this.value,'col_{{$x}}_4',2)" onfocusout="toggleShow('col_{{$x}}_4_editor','col_{{$x}}_4',2)" onkeyup="max_field_input(this)">
																	<input name="col_{{$x}}_4_max" type="hidden" value="{{old('col_'.$x.'_4_max')}}">
																</span>
															</td>
															<td  data-label="Selling price"> <span id="col_{{$x}}_5"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_5')}}</span>
																<span id="col_{{$x}}_5_editor" class="hidden">
																	<input name="col_{{$x}}_5" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_5')}}" onchange="assign_new_val(this.value,'col_{{$x}}_5',2)" onfocusout="toggleShow('col_{{$x}}_5_editor','col_{{$x}}_5',2)" >
																</span>
															</td>
															<td  data-label="Total"> <span id="col_{{$x}}_6"  onclick="toggleShow(this.id,this.id+'_editor',2)">KES {{number_format(old('col_'.$x.'_6'),2)}}</span>
																<span id="col_{{$x}}_6_editor" class="hidden">
																	<input name="col_{{$x}}_6" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_6')}}" onchange="assign_new_val(this.value,'col_{{$x}}_6',2)" onfocusout="toggleShow('col_{{$x}}_6_editor','col_{{$x}}_6',2)" >
																</span>
															</td>
															<input type="hidden" name="col_{{$x}}_7" value="{{old('col_'.$x.'_7')}}">

														@endfor
													@elseif(isset($booking))
													@endif
												</tbody>
												<tfoot>
													<tr>
														<td colspan="4"></td>
														<td>Grand Total</td>
														<td id="booked_prods_grand_total" class="text-bold">@if(old('booked_prods_grand_total'))KES {{number_format(old('booked_prods_grand_total'),2)}}@elseif(isset($booking)) code mada desu @endif</td>
														<input type="hidden" id="booked_prods_grand_total" name="booked_prods_grand_total" value="@if(old('booked_prods_grand_total')){{old('booked_prods_grand_total')}}@elseif(isset($booking)) 0 @endif">
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
									<h3 id="booking-total-cost" class="text-danger text-bold">KES 0.00</h3>
									<strong class="hidden days-label">For <span class="booking-num-days"></span> day(s) </strong>
								</div>

								<div id="no-user-error" class="alert alert-danger alert-dismissible @if(!$errors->has('user_id'))hidden @endif" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5>Please add a customer to the booking</h5>
								</div>


								<div id="bookingCustomerSearchPanel" class="supplier-details box-shdow-1 mb-2">
									<legend>Search</legend>
									<div  class="input-group mb-0">
									  <span class="input-group-addon" ><span class="fa fa-search"></span></span>
									  <input id="customerSearch" type="text" class="form-control search-input" placeholder="Search customer by name..." onkeyup="kpc_cust_search(this.value,this.id)">
									</div>

									<div id="customerSearchPanel" class="search-panel-lg hidden">


									</div>
									<br>
									<a href="#"  onclick="event.preventDefault();toggleElements('bookingCustomerRegPanel','bookingCustomerSearchPanel')">Create new customer instead</a>
								</div>

								<div id="bookingCustomerRegPanel" class="supplier-details box-shdow-1 mb-2 hidden">
									<legend>Customer Registration Form</legend>
									<div class="alert alert-danger alert-dismissible cust-errors-list hidden" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
											  <input id="bookingCustomerAvatar" type="file" class="form-control search-input" onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)" >
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
												<li><span class="fa fa-user"></span> <span id="bookingCustomerNameLabel"></span></li>
												<li><span class="fa fa-phone"></span> <span id="bookingCustomerPhoneLabel"></span></li>
												<li><span class="fa fa-envelope"></span> <span id="bookingCustomerEmailLabel"></span></li>
											</ul>
										</div>
										<div class="col-xs-4">
											<span class="fas fa-times-circle close" onclick="remove_booking_customer()"></span>
											<div class="profile-img"><img  id="bookingCustomerAvatarLabel" src="" alt="" ></div>
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
													@if( $count % 2 == 0 )
														<li>
															<input name="other_services[]" class="booking-service" type="checkbox" value="{{$service->id}}" data-price="{{$service->cost}}" @if(is_array(old('other_services'))) @if(in_array($service->id,old('other_services'))) checked @endif @endif> {{$service->service}}
													  </li>
													@endif
													<?php $count++; ?>
												@endforeach
											</ul>
										</div>
										<?php $count = 0; ?>
										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptServices as $service )
													@if( $count % 2 != 0 )
														<li>
															<input name="other_services[]"  class="booking-service" type="checkbox" value="{{$service->id}}" data-price="{{$service->cost}}" @if(is_array(old('other_services'))) @if(in_array($service->id,old('other_services'))) checked @endif @endif> {{$service->service}}
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
													@if( $count % 2 == 0 )
														<li>
															<input name="booking_menu[]" class="booking-service" type="checkbox" value="{{$menu->id}}" data-price="{{$menu->price}}" @if(is_array(old('booking_menu'))) @if(in_array($menu->id,old('booking_menu'))) checked @endif @endif> {{$menu->name}}
													  </li>
													@endif
													<?php $count++; ?>
												@endforeach
											</ul>
										</div>
										<?php $count = 0; ?>
										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptMenu as $menu )
													@if( $count % 2 != 0 )
														<li>
															<input name="booking_menu[]" class="booking-service" type="checkbox" value="{{$menu->id}}" data-price="{{$menu->price}}" @if(is_array(old('booking_menu'))) @if(in_array($menu->id,old('booking_menu'))) checked @endif @endif> {{$menu->name}}
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
								<button type="button" class="btn btn-default btn-lg mt-1 pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Save</button>
							</div>
						</div>

						<input type="hidden" name="user_id" >
						<input type="hidden" name="booking_num_days" >
						<input type="hidden" name="bookingAmountDue" >
						<input type="hidden" name="no_products" >
						<input type="hidden" name="dept_id" value="@if(isset($dept)){{$dept->id}}@endif">
						@component( 'components.confirm-modal',[ 'formId' => 'booking-form', 'heading' => 'Booking form', 'message' => 'Are you sure you want to sunmit booking form?', 'closeBtn' => 'No ', 'saveBtn' => 'Yes' ] )@endcomponent

</form>
				</div>
		<!-- //inner_content-->
</div>

@endsection
