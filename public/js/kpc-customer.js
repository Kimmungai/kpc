/*
*Function to create a booking's customer
*/
function booking_create_customer()
{
  //customer details
  var name = $("#bookingCustomerName").val();
  var phoneNumber = $("#bookingCustomerPhone").val();
  var email = $("#bookingCustomerEmail").val();
  var avatar = 'bookingCustomerAvatar';//id of the file input

  if( validate_booking_customer_details(name, phoneNumber, email, avatar) )
  {
    //send customer data to server
      var file = $('#'+avatar)[0].files[0]
      var fd = new FormData();

      if( file )
        fd.append('avatar', file);

      fd.append('name', name);
      fd.append('email', email);
      fd.append('phoneNumber', phoneNumber);
      $.ajax({
          url: '/create-customer',
          type: 'POST',
          processData: false,
          contentType: false,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: fd,
          success: function (data, status, jqxhr) {
            if( data.id )
              handle_cust_object_from_server(data)
            else
              handle_cust_form_error_from_server(data)
          },
          error: function (jqxhr, status, msg) {
              alert('Error: '+msg)
          }
      });

  }


}

/*
*Function to validate booking customer details
*/
function validate_booking_customer_details(name, phoneNumber, email, avatar)
{
  if( name == '' || phoneNumber == '' || email == '' ){ alert("Please fill in all required fields(*)");return;}

  if( !email_valid( email ) ){$(".cust-email-error").removeClass('hidden');}else{$(".cust-email-error").addClass('hidden');}
  if( !phone_valid( phoneNumber ) ){$(".cust-phone-number-error").removeClass('hidden');}else{$(".cust-phone-number-error").addClass('hidden');}
  if( !name_valid( name ) ){$(".cust-name-error").removeClass('hidden');}else{$(".cust-name-error").addClass('hidden');}
  if( !image_valid( avatar ) ){$(".cust-avatar-error").removeClass('hidden');}else{$(".cust-avatar-error").addClass('hidden');}

  if( !email_valid( email ) || !phone_valid( phoneNumber ) || !name_valid( name ) || !image_valid( avatar )){
    $(".cust-errors-list").removeClass('hidden');
    return 0;
  }else{
    $(".cust-errors-list").addClass('hidden');
    return 1;
  }
}
/*
*Function to check whether email is valid
*/
function email_valid( email )
{
  var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  if( pattern.test(email) )
    return 1;

  return 0;
}

/*
*Function to check whether phoneNumber is valid
*/
function phone_valid( phoneNumber )
{
  if( isNaN( phoneNumber ) || phoneNumber.length < 10 )
    return 0;

  return 1;
}

/*
*Function to check whether name is valid
*/
function name_valid( name )
{
  if( name.length < 3 )
    return 0;

  return 1;
}

/*
*Function to check whether image is valid
*/
function image_valid( image_input_id, size=1, can_be_null=1 )
{


  var reg = /(.*?)\.(jpg|bmp|jpeg|png)$/;
  var uploadedFile = document.getElementById(image_input_id);

  if( can_be_null && uploadedFile.files.length == 0 )
    return 1

  var fileSize = uploadedFile.files[0].size / 1024 / 1024; //size in mb
  var val = $("#"+image_input_id).val();

  if( !val.match(reg) )
    return 0;

  if( fileSize > size )
    return 0;

  return 1;
}

/*
*Function to handle customer object from server
*/
function handle_cust_object_from_server(data)
{
  toggleElements('bookingCustomerSearchPanel','bookingCustomerRegPanel');

  $("#bookingCustomerNameLabel").text(data.name);
  $("#bookingCustomerPhoneLabel").text(data.phoneNumber);
  $("#bookingCustomerEmailLabel").text(data.email);
  $('#bookingCustomerAvatarLabel').attr('src',data.avatar);
  //customer id in hidden field
  $('#booking-form input[name=user_id]').val(data.id)

  $('#bookingCustomerDetails').removeClass('hidden');

  reset_booking_cust_reg_form();

}

/*
*Function to handle customer form error from server
*/
function handle_cust_form_error_from_server(data)
{
  if( data.email ){$(".cust-email-error").removeClass('hidden');$(".cust-email-error").text(data.email);}else{$(".cust-email-error").addClass('hidden');}
  if( data.phoneNumber ){$(".cust-phone-number-error").removeClass('hidden');$(".cust-phone-number-error").text(data.phoneNumber);}else{$(".cust-phone-number-error").addClass('hidden');}
  if( data.name ){$(".cust-name-error").removeClass('hidden');$(".cust-name-error").text(data.name);}else{$(".cust-name-error").addClass('hidden');}
  if( data.avatar ){$(".cust-avatar-error").removeClass('hidden');$(".cust-avatar-error").text(data.avatar);}else{$(".cust-avatar-error").addClass('hidden');}

  if( data.email || data.name || data.avatar || data.phoneNumber )
    $(".cust-errors-list").removeClass('hidden');
  else
    $(".cust-errors-list").addClass('hidden');

}

/*
*Function to remove booking customer
*/
function remove_booking_customer()
{
  var id = $('#booking-form input[name=user_id]').val();
  if(!id){alert("Error!");return;}
  var con = confirm("Are you sure you want to delete this customer?")
  if(!con){return;}
  
  //send details to server
  $.post( '/remove-customer',
    {
      id:id,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      $('#bookingCustomerDetails').addClass('hidden');
    });

}

/*
*Function to reset booking customer registration form
*/
function reset_booking_cust_reg_form()
{
  $("#bookingCustomerName").val('');
  $("#bookingCustomerPhone").val('');
  $("#bookingCustomerEmail").val('');
  $('#bookingCustomerAvatar').val('');
}
