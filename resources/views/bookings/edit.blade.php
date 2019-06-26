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
                  <li>Booking-@if(isset($booking)){{$booking->id}} @endif</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




					<div class="container" >
						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Booking-@if(isset($booking)){{$booking->id}} @endif </h1>
							@endif
						</div>

						<div class="row">
              <!--booking reg form-->

              <!--general form start-->
              <div class="grid-1 graph-form agile_info_shadow" style="width:100%">

                 <h3 class="w3_inner_tittle two">Basic Information </h3>
                 <form class="form-horizontal">

                   <div class="form-group">
                     <label class="col-md-2 control-label">Booking type</label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-gift"></i>
                         </span>
                         <select name="bookingType" id="bookingType" class="form-control1" onchange="select_booking_type(this.value)">
                           <option value="1" @if( old('bookingType') == 1 || ( isset($booking) && $booking->bookingType == 1 ) ) selected @endif> Food ordering </option>
                           <option value="2" @if( old('bookingType') == 2 || ( isset($booking) && $booking->bookingType == 2 ) ) selected @endif> Room booking </option>
                           <option value="3" @if( old('bookingType') == 3 || ( isset($booking) && $booking->bookingType == 3 ) ) selected @endif> Tent Hiring </option>
                           <option value="4" @if( old('bookingType') == 4 || ( isset($booking) && $booking->bookingType == 4 ) ) selected @endif> Meeting hall booking </option>
                           <option value="5" @if( old('bookingType') == 5 || ( isset($booking) && $booking->bookingType == 5 ) ) selected @endif> Compound booking </option>
                         </select>
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text">
                         @if ($errors->has('bookingType'))
                           {{ $errors->first('bookingType') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div id="roomTypeSec" class="form-group @if(isset($booking)) @if(!$booking->roomType) hidden d-none @endif @endif">
                     <label class="col-md-2 control-label">Room type</label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fas fa-hotel"></i>
                         </span>
                         <select name="roomType" id="roomType" class="form-control1">
                           <option value="1" @if( old('roomType') == 1 || ( isset($booking) && $booking->roomType == 1 ) ) selected @endif> Single </option>
                           <option value="2" @if( old('roomType') == 2 || ( isset($booking) && $booking->roomType == 2 ) ) selected @endif> Double </option>
                           <option value="3" @if( old('roomType') == 3 || ( isset($booking) && $booking->roomType == 3 ) ) selected @endif> Delux </option>
                         </select>
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text">
                         @if ($errors->has('roomType'))
                           {{ $errors->first('roomType') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group" id="numPpleTitle">
                     <label class="col-md-2 control-label">No of People <span class="text-danger">*</span></label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-users"></i>
                         </span>
                         <input name="numPple" id="numPple" type="text" class="form-control1" value="@if( old('numPple') ) {{old('numPple')}} @elseif( isset($booking) ) {{$booking->numPple}} @endif" placeholder="Number of People" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="numPpleHelper">
                         @if ($errors->has('numPple'))
                           {{ $errors->first('numPple') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group" id="chk_in_dateTitle">
                     <label class="col-md-2 control-label chk_in_dateName">Check in <span class="text-danger">*</span></label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                         </span>
                         <input name="chk_in_date" id="chk_in_date" type="text" class="form-control1" value="@if( old('chk_in_date') ) {{old('chk_in_date')}} @elseif( isset($booking) ) {{$booking->chkInDate}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="chk_in_dateHelper">
                         @if ($errors->has('chk_in_date'))
                           {{ $errors->first('chk_in_date') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group @if(isset($booking)) @if(!$booking->chkOutDate) hidden d-none @endif @endif" id="chk_out_dateTitle">
                     <label class="col-md-2 control-label chk_out_dateName">Check out <span class="text-danger">*</span></label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                         </span>
                         <input name="chk_out_date" id="chk_out_date" type="text" class="form-control1" value="@if( old('chk_out_date') ) {{old('chk_out_date')}} @elseif( isset($booking) ) {{$booking->chkOutDate}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="chk_out_dateHelper">
                         @if ($errors->has('chk_out_date'))
                           {{ $errors->first('chk_out_date') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group" id="bookingAmountDueTitle">
                     <label class="col-md-2 control-label">Amount due <span class="text-danger">*</span></label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-money"></i>
                         </span>
                         <input name="bookingAmountDue" id="bookingAmountDue" type="text"  class="form-control1" value="@if( old('bookingAmountDue') ) {{old('bookingAmountDue')}} @elseif( isset($booking) ) {{$booking->bookingAmountDue}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="bookingAmountDueHelper">
                         @if ($errors->has('bookingAmountDue'))
                           {{ $errors->first('bookingAmountDue') }}
                         @endif
                       </p>
                     </div>
                   </div>


                   <div class="form-group" id="modeOfPaymentTitle">
                     <label class="col-md-2 control-label">Payment method</label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-info"></i>
                         </span>
                         <select name="modeOfPayment" id="modeOfPayment"  class="form-control1">
                           <option value="1" @if( old('modeOfPayment') == 1 || ( isset($booking) && $booking->modeOfPayment == 1 ) ) selected @endif>Paid by cash</option>
                           <option value="2" @if( old('modeOfPayment') == 2 || ( isset($booking) && $booking->modeOfPayment == 2 ) ) selected @endif>Paid by cheque</option>
                           <option value="3" @if( old('modeOfPayment') == 3 || ( isset($booking) && $booking->modeOfPayment == 3 ) ) selected @endif>Paid by bank transfer</option>
                           <option value="4" @if( old('modeOfPayment') == 4 || ( isset($booking) && $booking->modeOfPayment == 4 ) ) selected @endif>MPESA</option>
                         </select>
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="modeOfPaymentHelper">
                         @if ($errors->has('modeOfPayment'))
                           {{ $errors->first('modeOfPayment') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group" id="bookingAmountReceivedTitle">
                     <label class="col-md-2 control-label">Amount Received <span class="text-danger">*</span></label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-money"></i>
                         </span>
                         <input name="bookingAmountReceived" id="bookingAmountReceived" type="text"  class="form-control1" value="@if( old('bookingAmountReceived') ) {{old('bookingAmountReceived')}} @elseif( isset($booking) ) {{$booking->bookingAmountReceived}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="bookingAmountReceivedHelper">
                         @if ($errors->has('bookingAmountReceived'))
                           {{ $errors->first('bookingAmountReceived') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group" id="paymentStatusTitle">
                     <label class="col-md-2 control-label">Payment status</label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-hourglass"></i>
                         </span>
                         <select name="paymentStatus" id="paymentStatus"  class="form-control1">
                           <option value="1" @if( old('paymentStatus') == 1 || ( isset($booking) && $booking->paymentStatus == 1 ) ) selected @endif>Paid</option>
                           <option value="2" @if( old('paymentStatus') == 2 || ( isset($booking) && $booking->paymentStatus == 2 ) ) selected @endif>Pending</option>
                         </select>
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="paymentStatusHelper">
                         @if ($errors->has('paymentStatus'))
                           {{ $errors->first('paymentStatus') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group" id="paymentDueDateTitle">
                     <label class="col-md-2 control-label">Payment Due Date</label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                         </span>
                         <input name="paymentDueDate" id="paymentDueDate" type="text" class="form-control1" value="@if( old('paymentDueDate') ) {{old('paymentDueDate')}} @elseif( isset($booking) ) {{$booking->paymentDueDate}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="paymentDueDateHelper">
                         @if ($errors->has('paymentDueDate'))
                           {{ $errors->first('paymentDueDate') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="checkbox" class="col-sm-2 control-label">Board</label>
                     <div class="col-sm-8">
                       <div class="checkbox-inline"><label><input value="2" name="board" type="radio" @if( isset($booking) ) @if($booking->board == 2) checked @endif @endif> Full board</label></div>
                       <div class="checkbox-inline"><label><input value="1" name="board" type="radio" @if( isset($booking) ) @if($booking->board == 1) checked @endif @endif> Half board</label></div>
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="checkbox" class="col-sm-2 control-label">Menu</label>
                     <div class="col-sm-8">
                       <div class="checkbox-inline"><label><input value="1" name="menu" type="radio" @if( isset($booking) ) @if($booking->menu == 1) checked @endif @endif> Ordinary</label></div>
                       <div class="checkbox-inline"><label><input value="2" name="menu" type="radio" @if( isset($booking) ) @if($booking->menu == 2) checked @endif @endif> Special</label></div>
                     </div>
                   </div>

                   <div class="form-group" id="menuDetailsTitle">
                     <label class="col-md-2 control-label">Menu details</label>
                     <div class="col-md-8">
                       <div class="input-group input-icon right">
                         <span class="input-group-addon">
                           <i class="fas fa-utensils"></i>
                         </span>
                         <textarea name="menuDetails" id="menuDetails" class="form-control" rows="5"  placeholder="Enter any details about the menu" onblur="validate(this.id,{required:0,min:3,max:255},this.value)">@if( old('menuDetails') ) {{old('menuDetails')}} @elseif( isset($booking) ) {{$booking->menuDetails}} @endif</textarea>
                       </div>
                     </div>
                     <div class="col-sm-2">
                       <p class="help-block red-text" id="menuDetailsHelper">
                         @if ($errors->has('menuDetails'))
                           {{ $errors->first('menuDetails') }}
                         @endif
                       </p>
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="checkbox" class="col-sm-2 control-label">Other services</label>
                     <div class="col-sm-8">
                       <div class="checkbox-inline"><label><input value="1" name="meetingHall" id="meetingHall" type="checkbox" @if( isset($booking) ) @if($booking->meetingHall == 1) checked @endif @endif> Meeting hall</label></div>
                       <div class="checkbox-inline"><label><input value="1" name="tent" id="tent" type="checkbox" @if( isset($booking) ) @if($booking->tent == 1) checked @endif @endif> Tent</label></div>
                       <div class="checkbox-inline"><label><input value="1" name="paSystem" id="paSystem" type="checkbox" @if( isset($booking) ) @if($booking->paSystem == 1) checked @endif @endif> PA system</label></div>
                       <div class="checkbox-inline"><label><input value="1" name="projector" id="projector" type="checkbox" @if( isset($booking) ) @if($booking->projector == 1) checked @endif @endif> Projector</label></div>
                     </div>
                   </div>



                  </form>

          </div><!--general form end-->

          <!--/start goods-->
          <div class="set-1_w3ls">
              <div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
               <h3 class="w3_inner_tittle two">Other products booked  </h3>

               <div class="input-group search-box">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                <div class="loading hidden d-none">
                  <img src="{{url('images/search-loading.gif')}}" alt="" height="10" width="50">
                </div>
                <input id="search-booked-product"  type="text" class="form-control search-box" name="search" placeholder="Search by name from records..." onkeyup="std_search_product(this.id,this.value,'booked-products-table')">
               </div>
               <div id="search-booked-product-results" class="search-box-results border-1 hidden d-none">

               </div>


                </div>
               <div class="clearfix"> </div>
          </div>
          <!--end goods-->
          <!-- tables -->

          <div class="agile-tables">

          <div class="w3l-table-info agile_info_shadow">
            <table  class="two-axis">
              <input id="purchasesID" type="hidden" name="purchasesID">
            <thead>
              <tr>
              <th>SKU</th>
              <th>Name</th>
              <th>Quantity booked</th>
              <th>Price</th>
              </tr>
            </thead>
            <tbody id="booked-products-table">
              @if( isset($booking) )
                @forelse( $booking->revenue as $revenue)
                <tr data-prod="{{$revenue->product->id}}">
                <td>{{$revenue->product->sku}}</td>
                <td>{{$revenue->product->name}}</td>
                <td class="text-info cursor" id="booked-products-table-booked-prod-qty-{{$revenue->product->id}}" onclick="std_update_amount_due(this.id,'+response.quantity+')">{{$revenue->bookedQuantity}}</td>
                <td id="'booked-products-table-booked-prod-price-{{$revenue->product->id}}" class="text-info cursor" onclick="std_update_amount_due(this.id)">{{$revenue->price}}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4">No products found!</td>
                </tr>
                @endforelse
              @endif

            </tbody>
            </table>


          </div>
       </div>
      <!-- //tables -->
          <!--goods table-->

          <!--/start Customer-->
          <div class="set-1_w3ls">
              <div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
               <h3 class="w3_inner_tittle two">Customer details <span class="text-danger">*</span></h3>
               <div id="booking-search-customer-container">
                 <div class="input-group search-box" >
                  <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                  <div class="loading hidden d-none">
                    <img src="{{url('images/search-loading.gif')}}" alt="" height="10" width="50">
                  </div>
                  <input id="table-booking-contact-input"  type="text" class="form-control" name="search" placeholder="Search by name..." onkeyup="std_search_user(this.value,'table-booking-contact')">

                 </div>
                 <div id="table-booking-contact-results-box" class="search-box-results border-1 hidden d-none">

                 </div>
                 <div class="form-group">
                   <button type="button" class="btn btn-default btn-sm" name="button" onclick="toggleElements('booking-create-user-form-container','booking-search-customer-container')">Create new customer record instead <i class="fa fa-database"></i></button>
                 </div>
               </div>
                    <div class="grid-1 hidden d-none" id="booking-create-user-form-container">
                      <div class="form-body " >
                        <div  data-example-id="simple-form-inline">
                          <form id="booking-create-user-form" class="form-inline " onsubmit="std_create_user(this.id,'table-booking-contact')">

                            <div class="form-group" >
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                  </span>
                                  <input  name="firstName"  type="text" class="form-control1" value="" placeholder="Name..." required />
                              </div>
                            </div>

                            <div class="form-group" >
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                  </span>
                                  <input name="email"  type="email"  class="form-control1" value="" placeholder="Email..." required/>
                              </div>
                            </div>

                            <div class="form-group" >
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </span>
                                  <input name="phoneNumber"  type="number" class="form-control1" value=""  placeholder="Phone Number..." required />
                              </div>
                            </div>

                            <div class="form-group" >
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fas fa-id-card"></i>
                                  </span>
                                  <input name="idNo" type="number" class="form-control" value="" placeholder="ID No..." />
                              </div>
                            </div>

                          <div class="form-group">
                            <button type="submit" class="btn btn-default btn-sm" name="button" >Add</button>
                          </div>


                          </form>

                        </div>

                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-default btn-sm" name="button" onclick="toggleElements('booking-search-customer-container','booking-create-user-form-container')">Search customer from records instead <i class="fa fa-database"></i></button>
                      </div>
                     </div>


                </div>
               <div class="clearfix"> </div>
        </div>
        <!--end customer-->

        <!--customer table-->
        <!-- tables -->

        <div class="agile-tables">

        <div class="w3l-table-info agile_info_shadow">
          <table   class="two-axis">
          <thead>
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>ID No.</th>
            </tr>
          </thead>
          <tbody id="table-booking-contact">
            @if( isset($booking) )
              @if($booking->user)
              <tr>
              <td>{{$booking->user->firstName}}</td>
              <td>{{$booking->user->email}}</td>
              <td>{{$booking->user->phoneNumber}}</td>
              <td>{{$booking->user->idNo}}</td>
              </tr>
              @endif
            @endif
          </tbody>
          </table>


        </div>
     </div>
    <!-- //tables -->
    <input id="bookingDeptID" type="hidden" name="bookingDeptID" value="@if( isset($dept) ) {{$dept->id}} @endif">
    <input id="customerID" type="hidden" name="customerID" value="">

        <!--end customer table-->

          <!--//booking form-->

            <!--end goods table-->
            <div class="button" data-toggle="modal" data-target="#confirmModal">
             <p class="btnText">Update?</p>
             <div class="btnTwo" style="background:green">
               <p class="btnText2" >GO!</p>
             </div>
            </div>

            <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
             <p class="btnText">Delete?</p>
             <div class="btnTwo">
               <p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
             </div>
            </div>
              </div>
              <!--booking reg form-->

						</div>

					</div>

				</div>
		<!-- //inner_content-->
</div>
@component( 'components.delete-confirm-modal',[ 'formId' => 'deleteBookingForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

@endcomponent

<form class="d-none hidden" id="deleteBookingForm" action="{{route('bookings-registration.destroy',$booking->id)}}" method="post">
  @csrf
  @method('DELETE')
</form>
@endsection
