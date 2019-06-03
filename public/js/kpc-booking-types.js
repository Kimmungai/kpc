function select_booking_type(bookingType)
{
  $("#roomTypeSec").addClass('hidden').addClass('d-none');
  switch(bookingType){
    case '1':
      $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
      $("#formTitle").text("Food Ordering Form ");
      $(".chk_in_dateName").text("Date");
    break;

    case '2':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $("#roomTypeSec").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").text("Check in");
    $(".chk_out_dateName").text("Check out");
    $("#formTitle").text("Room Booking Form ");
    break;

    case '3':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").text("Start");
    $(".chk_out_dateName").text("Finish");
    $("#formTitle").text("Tent Hiring Form ");
    break;

    case '4':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").text("Start");
    $(".chk_out_dateName").text("Finish");
    $("#formTitle").text("Meeting Hall Booking Form ");
    break;

    case '5':
    $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
    $(".chk_in_dateName").text("Date");
    $("#formTitle").text("Compound Booking Form ");
    break;

    default:
    $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
    $(".chk_in_dateName").text("Date");
    $("#formTitle").text("Compound Booking Form ");
    break;
  }
}
