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
                        <select name="boookingType" id="boookingType" class="form-control1" onchange="select_booking_type(this.value)">
                          <option value="1" @if( old('boookingType') == 1 || ( isset($user) && $user->boookingType == 1 ) ) selected @endif> Food ordering </option>
                          <option value="2" @if( old('boookingType') == 2 || ( isset($user) && $user->boookingType == 2 ) ) selected @endif> Room booking </option>
                          <option value="3" @if( old('boookingType') == 3 || ( isset($user) && $user->boookingType == 3 ) ) selected @endif> Tent Hiring </option>
                          <option value="4" @if( old('boookingType') == 4 || ( isset($user) && $user->boookingType == 4 ) ) selected @endif> Meeting hall booking </option>
                          <option value="5" @if( old('boookingType') == 5 || ( isset($user) && $user->boookingType == 5 ) ) selected @endif> Compound booking </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block red-text">
                        @if ($errors->has('boookingType'))
                          {{ $errors->first('boookingType') }}
                        @endif
                      </p>
                    </div>
                  </div>

                  <div class="form-group hidden d-none">
                    <label class="col-md-2 control-label">Room type</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fas fa-hotel"></i>
                        </span>
                        <select name="roomType" id="roomType" class="form-control1" onchange="select_booking_type()">
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
                        <input name="numPple" id="numPple" type="text" class="form-control1" value="@if( old('numPple') ) {{old('numPple')}} @elseif( isset($user) ) {{$user->numPple}} @endif" placeholder="Number of People" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
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

                  <div class="form-group" id="amountDueTitle">
                    <label class="col-md-2 control-label">Amount due</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </span>
                        <input name="amountDue" id="amountDue" type="number" min="0" class="form-control1" value="@if( old('amountDue') ) {{old('amountDue')}} @elseif( isset($user) ) {{$user->amountDue}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block red-text" id="amountDueHelper">
                        @if ($errors->has('amountDue'))
                          {{ $errors->first('amountDue') }}
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
                          <option value="1" @if( old('modeOfPayment') == 1 || ( isset($user) && $user->modeOfPayment == 1 ) ) selected @endif>Cheque</option>
                          <option value="2" @if( old('modeOfPayment') == 2 || ( isset($user) && $user->modeOfPayment == 2 ) ) selected @endif>Mpesa</option>
                          <option value="3" @if( old('modeOfPayment') == 3 || ( isset($user) && $user->modeOfPayment == 3 ) ) selected @endif>Bank transfer</option>
                          <option value="4" @if( old('modeOfPayment') == 4 || ( isset($user) && $user->modeOfPayment == 4 ) ) selected @endif>Cash</option>
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

                  <div class="form-group" id="amountReceivedTitle">
                    <label class="col-md-2 control-label">Amount Received</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </span>
                        <input name="amountReceived" id="amountReceived" type="number" min="0" class="form-control1" value="@if( old('amountReceived') ) {{old('amountReceived')}} @elseif( isset($user) ) {{$user->amountReceived}} @endif" placeholder="Enter a number" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block red-text" id="amountReceivedHelper">
                        @if ($errors->has('amountReceived'))
                          {{ $errors->first('amountReceived') }}
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
                      <div class="checkbox-inline"><label><input value="1" name="board" type="radio"> Half board</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="board" type="radio"> Full board</label></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="checkbox" class="col-sm-2 control-label">Menu</label>
                    <div class="col-sm-8">
                      <div class="checkbox-inline"><label><input value="1" name="board" type="radio"> Ordinary</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="board" type="radio"> Special</label></div>
                    </div>
                  </div>

                  <div class="form-group" id="menuDetailsDateTitle">
                    <label class="col-md-2 control-label">Menu details</label>
                    <div class="col-md-8">
                      <div class="input-group input-icon right">
                        <span class="input-group-addon">
                          <i class="fas fa-utensils"></i>
                        </span>
                        <textarea name="menuDetailsDate" id="menuDetailsDate" class="form-control" rows="5"  placeholder="Enter any details about the menu" onblur="validate(this.id,{required:0,min:3,max:255},this.value)">@if( old('menuDetailsDate') ) {{old('menuDetailsDate')}} @elseif( isset($user) ) {{$user->menuDetailsDate}} @endif</textarea>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block red-text" id="menuDetailsDateHelper">
                        @if ($errors->has('menuDetailsDate'))
                          {{ $errors->first('menuDetailsDate') }}
                        @endif
                      </p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="checkbox" class="col-sm-2 control-label">Other services</label>
                    <div class="col-sm-8">
                      <div class="checkbox-inline"><label><input value="1" name="meetingHall" type="checkbox"> Meeting hall</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="tent" type="checkbox"> Tent</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="paSystem" type="checkbox"> PA system</label></div>
                      <div class="checkbox-inline"><label><input value="1" name="projector" type="checkbox"> Projector</label></div>
                    </div>
                  </div>

                 </form>
         </div><!--general form end-->

<!--contact person start-->
         <div class="grid-1 graph-form agile_info_shadow">

            <h3 class="w3_inner_tittle two">Contact person </h3>
            <form class="form-horizontal">

              <div class="form-group" id="firstNameTitle">
                <label class="col-md-2 control-label">Name</label>
                <div class="col-md-8">
                  <div class="input-group input-icon right">
                    <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                    <input name="firstName" id="firstName" type="text" class="form-control1" value="@if( old('firstName') ) {{old('firstName')}} @elseif( isset($user) ) {{$user->firstName}} @endif" placeholder="Contact person name..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)" />
                  </div>
                </div>
                <div class="col-sm-2">
                  <p class="help-block red-text" id="firstNameHelper">
                    @if ($errors->has('firstName'))
                      {{ $errors->first('firstName') }}
                    @endif
                  </p>
                </div>
              </div>




              <div class="form-group" id="idNoTitle">
                <label class="col-md-2 control-label">ID No</label>
                <div class="col-md-8">
                  <div class="input-group input-icon right">
                    <span class="input-group-addon">
                      <i class="fas fa-id-card"></i>
                    </span>
                    <input name="idNo" id="idNo" type="text" class="form-control" value="@if( old('idNo') ) {{old('idNo')}} @elseif( isset($user) ) {{$user->idNo}} @endif" placeholder="ID No..." onblur="validate(this.id,{required:0,min:5,max:10,type:'numeric'},this.value)"/>
                  </div>
                </div>
                <div class="col-sm-2">
                  <p class="help-block red-text" id="idNoHelper">
                    @if ($errors->has('idNo'))
                      {{ $errors->first('idNo') }}
                    @endif
                  </p>
                </div>
              </div>



              <div class="form-group" id="phoneNumberTitle">
                <label class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-8">
                  <div class="input-group input-icon right">
                    <span class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </span>
                    <input name="phoneNumber" id="phoneNumber" type="text" class="form-control1" value="@if( old('phoneNumber') ) {{old('phoneNumber')}} @elseif( isset($user) ) {{$user->phoneNumber}} @endif" placeholder="Phone Number..." onblur="validate(this.id,{required:0,min:10,max:13,type:'numeric'},this.value)"/>
                  </div>
                </div>
                <div class="col-sm-2">
                  <p class="help-block red-text" id="phoneNumberHelper">
                    @if ($errors->has('phoneNumber'))
                      {{ $errors->first('phoneNumber') }}
                    @endif
                  </p>
                </div>
              </div>

              <div class="form-group" id="emailTitle">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-8">
                  <div class="input-group input-icon right">
                    <span class="input-group-addon">
                      <i class="fa fa-envelope"></i>
                    </span>
                    <input name="email" id="email" type="email" class="form-control1" value="@if( old('email') ) {{old('email')}} @elseif( isset($user) ) {{$user->email}} @endif" placeholder="Email..." onblur="validate(this.id,{required:0,min:3,max:255,type:'email'},this.value)"/>
                  </div>
                </div>
                <div class="col-sm-2">
                  <p class="help-block red-text" id="emailHelper">
                    @if ($errors->has('email'))
                      {{ $errors->first('email') }}
                    @endif
                  </p>
                </div>
              </div>

             </form>
     </div><!--contact person end-->

         </div>
         <!--//booking form-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success btn-lg" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
