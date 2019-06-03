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
                        <select name="bookingType" id="bookingType" class="form-control1" onchange="select_booking_type(this.value)">
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
                          <i class="fas fa-hotel"></i>
                        </span>
                        <select name="roomType" id="roomType" class="form-control1">
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
                    <label class="col-md-2 control-label">No of People</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-users"></i>
                        </span>
                        <input name="numPple" id="numPple" type="text" class="form-control1" value="@if( old('numPple') ) {{old('numPple')}} @elseif( isset($user) ) {{$user->numPple}} @endif" placeholder="Number of People" onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
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
                    <label class="col-md-2 control-label chk_in_dateName">Date</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input name="chk_in_date" id="chk_in_date" type="text" class="form-control1" value="@if( old('chk_in_date') ) {{old('chk_in_date')}} @elseif( isset($user) ) {{$user->chk_in_date}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
                    <label class="col-md-2 control-label chk_out_dateName">Date</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input name="chk_out_date" id="chk_out_date" type="text" class="form-control1" value="@if( old('chk_out_date') ) {{old('chk_out_date')}} @elseif( isset($user) ) {{$user->chk_out_date}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
                    <label class="col-md-2 control-label">Amount due</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </span>
                        <input name="bookingAmountDue" id="bookingAmountDue" type="number" min="0" class="form-control1" value="@if( old('bookingAmountDue') ) {{old('bookingAmountDue')}} @elseif( isset($user) ) {{$user->bookingAmountDue}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
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

                  <div class="form-group" id="bookingAmountReceivedTitle">
                    <label class="col-md-2 control-label">Amount Received</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </span>
                        <input name="bookingAmountReceived" id="bookingAmountReceived" type="number" min="0" class="form-control1" value="@if( old('bookingAmountReceived') ) {{old('bookingAmountReceived')}} @elseif( isset($user) ) {{$user->bookingAmountReceived}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
                          <option value="1" @if( old('paymentStatus') == 1 || ( isset($user) && $user->paymentStatus == 1 ) ) selected @endif>Paid</option>
                          <option value="2" @if( old('paymentStatus') == 2 || ( isset($user) && $user->paymentStatus == 2 ) ) selected @endif>Pending</option>
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
                        <input name="paymentDueDate" id="paymentDueDate" type="text" class="form-control1" value="@if( old('paymentDueDate') ) {{old('paymentDueDate')}} @elseif( isset($user) ) {{$user->paymentDueDate}} @endif" placeholder="Choose a date" onchange="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
               <input id="search-product-box"  type="text" class="form-control" name="search" placeholder="Search by name from records...">
              </div>
              <div id="product-results-box" class="search-box-results border-1 hidden d-none">

              </div>

                   <div class="grid-1">
                     <div class="form-body">
                       <div data-example-id="simple-form-inline">
                         <form class="form-inline">
                           <div class="form-group" id="skuTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-info"></i>
                                 </span>
                                 <input name="sku" id="sku"  type="text" class="form-control1" value="@if( old('sku') ) {{old('sku')}} @elseif( isset($user) ) {{$user->sku}} @endif" placeholder="SKU..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>
                           <div class="form-group" id="prodNameTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-info"></i>
                                 </span>
                                 <input name="prodName" id="prodName"  type="text" class="form-control1" value="@if( old('prodName') ) {{old('prodName')}} @elseif( isset($user) ) {{$user->prodName}} @endif" placeholder="Product Name..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>
                           <div class="form-group" id="quantityTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-info"></i>
                                 </span>
                                 <input name="quantity" id="quantity" min="0"  type="number" class="form-control1" value="@if( old('quantity') ) {{old('quantity')}} @elseif( isset($user) ) {{$user->quantity}} @endif" placeholder="Product Quantity..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>
                           <div class="form-group" id="costTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-dollar"></i>
                                 </span>
                                 <input name="cost" id="cost" min="0"  type="number" class="form-control1" value="@if( old('cost') ) {{old('cost')}} @elseif( isset($user) ) {{$user->cost}} @endif" placeholder="Product cost..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                             </div>
                           </div>

                         <div class="form-group">
                           <button type="button" class="btn btn-default btn-sm" name="button" onclick="create_products()">Add</button>
                         </div>
                         </form>
                       </div>
                     </div>
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

             <tr id="booked-prod-1">
               <td>fish001</td><td>Fish</td><td id="booked-prod-qty-1">52</td><td id="booked-prod-price-1">100</td>
             </tr>

             <tr id="booked-prod-2">
               <td>fish001</td><td>Fish</td><td id="booked-prod-qty-2">5252</td><td id="booked-prod-price-2">100</td>
             </tr>

           </tbody>
           </table>


         </div>
      </div>
     <!-- //tables -->
         <!--goods table-->

         <!--/start Customer-->
         <div class="set-1_w3ls">
             <div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
              <h3 class="w3_inner_tittle two">Contact person</h3>
                <div class="input-group search-box">
                 <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                 <div class="loading hidden d-none">
                   <img src="{{url('images/search-loading.gif')}}" alt="" height="10" width="50">
                 </div>
                 <input id="search-supplier-box"  type="text" class="form-control" name="search" placeholder="Search by name...">
                </div>
                <div id="supplier-results-box" class="search-box-results border-1 hidden d-none">

                </div>
                   <div class="grid-1">
                     <div class="form-body">
                       <div data-example-id="simple-form-inline">
                         <form class="form-inline">

                           <div class="form-group" id="contactPsnNameTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-user"></i>
                                 </span>
                                 <input name="contactPsnName" id="contactPsnName" type="text" class="form-control1" value="@if( old('contactPsnName') ) {{old('contactPsnName')}} @elseif( isset($user) ) {{$user->contactPsnName}} @endif" placeholder="Name..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)" />
                             </div>
                           </div>

                           <div class="form-group" id="contactPsnEmailTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-envelope"></i>
                                 </span>
                                 <input name="contactPsnEmail" id="contactPsnEmail" type="email" class="form-control1" value="@if( old('contactPsnEmail') ) {{old('contactPsnEmail')}} @elseif( isset($user) ) {{$user->contactPsnEmail}} @endif" placeholder="Email..." onblur="validate(this.id,{required:0,min:3,max:255,type:'email'},this.value)"/>
                             </div>
                           </div>

                           <div class="form-group" id="contactPsnPhoneNumberTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fa fa-phone"></i>
                                 </span>
                                 <input name="contactPsnPhoneNumber" id="contactPsnPhoneNumber" type="text" class="form-control1" value="@if( old('contactPsnPhoneNumber') ) {{old('contactPsnPhoneNumber')}} @elseif( isset($user) ) {{$user->contactPsnPhoneNumber}} @endif" placeholder="Phone Number..." onblur="validate(this.id,{required:0,min:10,max:13,type:'numeric'},this.value)"/>
                             </div>
                           </div>

                           <div class="form-group" id="contactPsnIdNoTitle">
                               <div class="input-group input-icon right">
                                 <span class="input-group-addon">
                                   <i class="fas fa-id-card"></i>
                                 </span>
                                 <input name="contactPsnIdNo" id="contactPsnIdNo" type="text" class="form-control" value="@if( old('contactPsnIdNo') ) {{old('contactPsnIdNo')}} @elseif( isset($user) ) {{$user->contactPsnIdNo}} @endif" placeholder="ID No..." onblur="validate(this.id,{required:0,min:5,max:10,type:'numeric'},this.value)"/>
                             </div>
                           </div>

                         <div class="form-group">
                           <button type="button" class="btn btn-default btn-sm" name="button" onclick="create_purchase()">Add</button>
                         </div>
                         </form>
                       </div>
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
         <tbody id="table-contact-psn-info">

         </tbody>
         </table>


       </div>
    </div>
   <!-- //tables -->
   <input id="bookingDeptID" type="hidden" name="bookingDeptID" value="@if( isset($dept) ) {{$dept->id}} @endif">
   <input id="customerID" type="hidden" name="customerID" value="1">

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
