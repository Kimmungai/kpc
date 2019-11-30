/*function select_booking_type(bookingType)
{
  $("#roomTypeSec").addClass('hidden').addClass('d-none');
  switch(bookingType){
    case '1':
      $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
      $("#chkOutDateTitle").addClass('hidden').addClass('d-none');
      $("#formTitle").text("Food Ordering Form ");
      $(".chk_in_dateName").html("Date<span class='text-danger'>*</span>");
      $("#chkInDate").attr("placeholder", "Date");
      $("#chkOutDate").attr("placeholder", "Date");
    break;

    case '2':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $("#chkOutDateTitle").removeClass('hidden').removeClass('d-none');
    $("#roomTypeSec").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").html("Check in<span class='text-danger'>*</span>");
    $(".chk_out_dateName").html("Check out<span class='text-danger'>*</span>");
    $("#formTitle").text("Room Booking Form ");
    $("#chkInDate").attr("placeholder", "Check in date");
    $("#chkOutDate").attr("placeholder", "Check out date");
    break;

    case '3':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $("#chkOutDateTitle").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").html("Start<span class='text-danger'>*</span>");
    $(".chk_out_dateName").html("Finish<span class='text-danger'>*</span>");
    $("#formTitle").text("Tent Hiring Form ");
    $("#chkInDate").attr("placeholder", "Start date");
    $("#chkOutDate").attr("placeholder", "End date");
    break;

    case '4':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $("#chkOutDateTitle").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").html("Start<span class='text-danger'>*</span>");
    $(".chk_out_dateName").html("Finish<span class='text-danger'>*</span>");
    $("#formTitle").text("Meeting Hall Booking Form ");
    $("#chkInDate").attr("placeholder", "Start date");
    $("#chkOutDate").attr("placeholder", "End date");
    break;

    case '5':
    $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
    $("#chkOutDateTitle").addClass('hidden').addClass('d-none');
    $(".chk_in_dateName").html("Date<span class='text-danger'>*</span>");
    $("#formTitle").text("Compound Booking Form ");
    $("#chkInDate").attr("placeholder", "Date");
    $("#chkOutDate").attr("placeholder", "Date");
    break;

    default:
    $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
    $("#chkOutDateTitle").addClass('hidden').addClass('d-none');
    $(".chk_in_dateName").text("Date<span class='text-danger'>*</span>");
    $("#formTitle").text("Compound Booking Form ");
    $("#chkInDate").attr("placeholder", "Date");
    $("#chkOutDate").attr("placeholder", "Date");
    break;
  }
}*/

/*
*Function to calculate the total booking costs
*/
function calculate_booking_costs()
{
  var booking_type_price = numeric_values( $('#bookingType') );
  var num_pple = numeric_values( $('#numPple') );
  var room_price =  parseFloat($('#roomId').find(':selected').data('price'));
  var num_days = num_days_two_dates( $('#chkInDate'), $('#chkOutDate') );
  var booked_prods_total = numeric_values($('#booking-form input[name=booked_prods_grand_total]'));
  var service_costs = booking_services_costs();

  if( $('#roomId').length )
    var booking_total_cost = (booking_type_price * num_pple) + (num_days * room_price) + booked_prods_total + service_costs;
  else
    var booking_total_cost = (booking_type_price * num_pple) + booked_prods_total + service_costs;

  if( room_price )
    $('.days-label').removeClass('hidden');
  else
    $('.days-label').addClass('hidden');

  $('#booking-total-cost').text( kes_currency( booking_total_cost, 'KES' ) );
  $('input[name=bookingAmountDue]').val( booking_total_cost );

}

$(".calc-costs-onchange, .booking-service").change(function(){
  calculate_booking_costs();
});

/*
*Function to return numeric values of inputs
*/
function numeric_values( input )
{
  if( !input.length )
    return 0

  if( input.val() == '' )
    return 0
  else
    return parseFloat(input.val())
}

/*
*Function to return number of days between booking's startDate and end date
*/
function num_days_two_dates( startDateInput, endDateInput )
{
  var days = 1;
  if( startDateInput.val() && endDateInput.val() )
    days = (Date.parse(endDateInput.val()) - Date.parse(startDateInput.val())) / 86400000;
  if( days < 1 )
    days = 1;

  $('.booking-num-days').text( days );
  $('input[name=booking_num_days]').val( days );

  return days;
}

/*
*Function to calculate the total value of check boxes with class booking-service
*/
function booking_services_costs()
{
  var service_cost = 0;
  $('#booking-form .booking-service').each(function(){

    if( $(this).is(":checked") )
      service_cost += parseFloat($(this).val());

  });
  return service_cost;
}

/*
*Funtion to validate booking form before submission
*/
function validate_booking( formId )
{
  var error = 0;

  if( !customer_added_to_booking( formId ) ){
    required_booking_fields( formId )
    error += 1;
  }

  if( !required_booking_fields( formId ) ){
    customer_added_to_booking( formId )
    error += 1;
  }

  //if( !other_booked_prods_fields( formId ) ){
  //  error += 1;
  //}
  alert( $('#'+formId+'  input[name=col_1_2]').val() )//suzuki

  if( error )
    return



  $('#'+formId+'  input[name=no_products]').val($("#otherProductsSearchTable tbody tr").length);
  $("#"+formId).submit();
}

/*
*check if booking customer has been added
*/
function customer_added_to_booking( formId )
{
  if( $('#'+formId+'  input[name=user_id]').val() === '' )
  {
    $("#no-user-error").removeClass('hidden');
    return 0;
  }
  else
  {
    $("#no-user-error").addClass('hidden')
    return 1;
  }
}

/*
*check if booking customer has been added
*/
function required_booking_fields( formId )
{
  var error = 0;

  if( $('#'+formId+'  input[name=numPple]').val() === '' ){
    $("#numPpleTitle").addClass('has-error');
    error += 1;
  }
  if( $('#'+formId+'  input[name=chkInDate]').val() === '' ){
    $("#chkInDateTitle").addClass('has-error');
    error += 1;
  }

  if( error )
    return 0
  else
    return 1
}

/*
*check if the other booked table is correct
*/
function other_booked_prods_fields( formId )
{
  var row = 1;
  var error = 0;

  /*$("#otherProductsSearchTable tbody tr").each(function(){

    if( $("#"+id+" input[name='col_"+row+"_2']").val() == '' )
    {
    //  $("#col_"+row+"_2").css('color','red');
      error += 1;
      alert("hete")
    }
    /*if( $("#"+id+" input[name='col_"+row+"_4']").val() == '' || isNaN($("#"+id+" input[name='col_"+row+"_4']").val()) )
    {
      error += 1;
    }
    if( $("#"+id+" input[name='col_"+row+"_5']").val() == '' || isNaN($("#"+id+" input[name='col_"+row+"_5']").val()) )
    {
      error += 1;
    }*/


  /*  row += 1;
  });

  if( error )
  {
    return 0
  }
  else
  {
    return 1
  }*/

}
