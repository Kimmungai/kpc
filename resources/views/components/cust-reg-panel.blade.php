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
