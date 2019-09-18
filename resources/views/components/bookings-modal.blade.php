<!-- Purchases Modal -->
  <div class="modal fade" id="recordBookingsModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record a booking</h4>
        </div>
        <div class="modal-body">
          <!--/booking form-->

          <h2 id="formTitle" class="w3_inner_tittle">Food Ordering Form </h3>

           <div class="wthree_general">

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
                        <select name="bookingType" id="bookingType" class="form-control" onchange="select_booking_type(this.value)">
                          <option value="1" @if( old('bookingType') == 1 || ( isset($user) && $user->bookingType == 1 ) ) selected @endif> Food ordering </option>
                          <option value="2" @if( old('bookingType') == 2 || ( isset($user) && $user->bookingType == 2 ) ) selected @endif> Room booking </option>
                          <option value="3" @if( old('bookingType') == 3 || ( isset($user) && $user->bookingType == 3 ) ) selected @endif> Tent Hiring </option>
                          <option value="4" @if( old('bookingType') == 4 || ( isset($user) && $user->bookingType == 4 ) ) selected @endif> Meeting hall booking </option>
                          <option value="5" @if( old('bookingType') == 5 || ( isset($user) && $user->bookingType == 5 ) ) selected @endif> Compound booking </option>
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

                  <div id="roomTypeSec" class="form-group hidden d-none">
                    <label class="col-md-2 control-label">Room type</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-hotel"></i>
                        </span>
                        <select name="roomType" id="roomType" class="form-control">
                          <option value="1" @if( old('roomType') == 1 || ( isset($user) && $user->roomType == 1 ) ) selected @endif> Single </option>
                          <option value="2" @if( old('roomType') == 2 || ( isset($user) && $user->roomType == 2 ) ) selected @endif> Double </option>
                          <option value="3" @if( old('roomType') == 3 || ( isset($user) && $user->roomType == 3 ) ) selected @endif> Delux </option>
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
                        <input name="numPple" id="numPple" type="text" class="form-control" value="@if( old('numPple') ) {{old('numPple')}} @elseif( isset($user) ) {{$user->numPple}} @endif" placeholder="Number of People" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
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
                    <label class="col-md-2 control-label chk_in_dateName">Date <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <div class="input-group-field input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input name="chk_in_date" id="chk_in_date" type="text" class="form-control" value="@if( old('chk_in_date') ) {{old('chk_in_date')}} @elseif( isset($user) ) {{$user->chk_in_date}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
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

                  <div class="form-group hidden d-none" id="chk_out_dateTitle">
                    <label class="col-md-2 control-label chk_out_dateName">Date <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <div class="input-group-field input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input name="chk_out_date" id="chk_out_date" type="text" class="form-control" value="@if( old('chk_out_date') ) {{old('chk_out_date')}} @elseif( isset($user) ) {{$user->chk_out_date}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
                          <i class="fas fa-money-bill"></i>
                        </span>
                        <input name="bookingAmountDue" id="bookingAmountDue" type="number" min="0" class="form-control" value="@if( old('bookingAmountDue') ) {{old('bookingAmountDue')}} @elseif( isset($user) ) {{$user->bookingAmountDue}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
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
                          <i class="fa fa-info-circle"></i>
                        </span>
                        <select name="modeOfPayment" id="modeOfPayment"  class="form-control">
                          <option value="1" @if( old('modeOfPayment') == 1 || ( isset($user) && $user->modeOfPayment == 1 ) ) selected @endif>Paid by cash</option>
                          <option value="2" @if( old('modeOfPayment') == 2 || ( isset($user) && $user->modeOfPayment == 2 ) ) selected @endif>Paid by cheque</option>
                          <option value="3" @if( old('modeOfPayment') == 3 || ( isset($user) && $user->modeOfPayment == 3 ) ) selected @endif>Paid by bank transfer</option>
                          <option value="4" @if( old('modeOfPayment') == 4 || ( isset($user) && $user->modeOfPayment == 4 ) ) selected @endif>MPESA</option>
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

                  <div class="form-group" id="transactionCodeTitle">
                    <label class="col-md-2 control-label">Code </label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fas fa-money-check"></i>
                        </span>
                        <input name="transactionCode" id="transactionCode" type="text" min="0" class="form-control" value="@if( old('transactionCode') ) {{old('transactionCode')}} @elseif( isset($user) ) {{$user->transactionCode}} @endif" placeholder="E.g MPESA transaction code, cheque number etc" onblur="validate(this.id,{required:0,min:1,max:255},this.value)" />
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block red-text" id="transactionCodeHelper">
                        @if ($errors->has('transactionCode'))
                          {{ $errors->first('transactionCode') }}
                        @endif
                      </p>
                    </div>
                  </div>

                  <div class="form-group" id="bookingAmountReceivedTitle">
                    <label class="col-md-2 control-label">Amount Received <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fas fa-money-bill"></i>
                        </span>
                        <input name="bookingAmountReceived" id="bookingAmountReceived" type="number" min="0" class="form-control" value="@if( old('bookingAmountReceived') ) {{old('bookingAmountReceived')}} @elseif( isset($user) ) {{$user->bookingAmountReceived}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
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



                  <div class="form-group" id="paymentDueDateTitle">
                    <label class="col-md-2 control-label">Payment Due Date</label>
                    <div class="col-md-8">
                      <div class="input-group-field input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input name="paymentDueDate" id="paymentDueDate" type="text" class="form-control" value="@if( old('paymentDueDate') ) {{old('paymentDueDate')}} @elseif( isset($user) ) {{$user->paymentDueDate}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
                      <div class="checkbox-inline"><label><input value="2" name="board" type="radio" checked> Full board</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="board" type="radio"> Half board</label></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="checkbox" class="col-sm-2 control-label">Menu</label>
                    <div class="col-sm-8">
                      <div class="checkbox-inline"><label><input value="1" name="menu" type="radio" checked> Ordinary</label></div>
                      <div class="checkbox-inline"><label><input value="2" name="menu" type="radio"> Special</label></div>
                    </div>
                  </div>

                  <div class="form-group" id="menuDetailsTitle">
                    <label class="col-md-2 control-label">Menu details</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fas fa-utensils"></i>
                        </span>
                        <textarea name="menuDetails" id="menuDetails" class="form-control" rows="5"  placeholder="Enter any details about the menu" onblur="validate(this.id,{required:0,min:3,max:255},this.value)">@if( old('menuDetails') ) {{old('menuDetails')}} @elseif( isset($user) ) {{$user->menuDetails}} @endif</textarea>
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
                      <div class="checkbox-inline"><label><input value="1" name="meetingHall" id="meetingHall" type="checkbox"> Meeting hall</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="tent" id="tent" type="checkbox"> Tent</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="paSystem" id="paSystem" type="checkbox"> PA system</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="projector" id="projector" type="checkbox"> Projector</label></div>
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

                   <!--<div class="grid-1">
                     <div class="form-body">
                       <div data-example-id="simple-form-inline">
                         <form class="form-inline">
                           <div class="form-group" id="skuTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-info"></i>
                                 </span>
                                 <input name="sku" id="bookingSku"  type="text" class="form-control" value="@if( old('sku') ) {{old('sku')}} @elseif( isset($user) ) {{$user->sku}} @endif" placeholder="SKU..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>
                           <div class="form-group" id="prodNameTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-info"></i>
                                 </span>
                                 <input name="prodName" id="bookingProdName"  type="text" class="form-control" value="@if( old('prodName') ) {{old('prodName')}} @elseif( isset($user) ) {{$user->prodName}} @endif" placeholder="Product Name..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>
                           <div class="form-group" id="quantityTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-info"></i>
                                 </span>
                                 <input name="quantity" id="bookingQuantity" min="0"  type="number" class="form-control" value="@if( old('quantity') ) {{old('quantity')}} @elseif( isset($user) ) {{$user->quantity}} @endif" placeholder="Product Quantity..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>
                           <div class="form-group" id="costTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-dollar"></i>
                                 </span>
                                 <input name="cost" id="bookingCost" min="0"  type="number" class="form-control" value="@if( old('cost') ) {{old('cost')}} @elseif( isset($user) ) {{$user->cost}} @endif" placeholder="Product cost..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>

                         <div class="form-group">
                           <button type="button" class="btn btn-default btn-sm" name="button" onclick="booking_create_products()">Add</button>
                         </div>
                         </form>
                       </div>
                     </div>
                   </div>-->
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
                 <input id="table-booking-contact-input"  type="text" class="form-control" name="search" placeholder="Search by name..." onkeyup="std_search_user(this.value,'table-booking-contact',2)">

                </div>
                <div id="table-booking-contact-results-box" class="search-box-results border-1 hidden d-none">

                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-warning btn-sm" name="button" onclick="toggleElements('booking-create-user-form-container','booking-search-customer-container')">Create new customer record instead <i class="fa fa-database"></i></button>
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
                                 <input  name="firstName"  type="text" class="form-control" value="" placeholder="Name..." required />
                             </div>
                           </div>

                           <div class="form-group" >
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-envelope"></i>
                                 </span>
                                 <input name="email"  type="email"  class="form-control" value="" placeholder="Email..." required/>
                             </div>
                           </div>

                           <div class="form-group" >
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-phone"></i>
                                 </span>
                                 <input name="phoneNumber"  type="number" class="form-control" value=""  placeholder="Phone Number..." required />
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

         </tbody>
         </table>


       </div>
    </div>
   <!-- //tables -->
   <input id="bookingDeptID" type="hidden" name="bookingDeptID" value="@if( isset($dept) ) {{$dept->id}} @endif">
   <input id="customerID" type="hidden" name="customerID" value="">

       <!--end customer table-->

         </div>
         <!--//booking form-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success btn-lg"  onclick="save_booking()">Save</button>
        </div>
      </div>
    </div>
  </div>
