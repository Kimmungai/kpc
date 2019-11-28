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
    //go ahead register customer
    
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
function image_valid( image_input_id, size=1 )
{
  var reg = /(.*?)\.(jpg|bmp|jpeg|png)$/;
  var uploadedFile = document.getElementById(image_input_id);
  var fileSize = uploadedFile.files[0].size / 1024 / 1024; //size in mb
  var val = $("#"+image_input_id).val();

  if( !val.match(reg) )
    return 0;

  if( fileSize > size )
    return 0;

  return 1;
}
