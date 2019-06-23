function select_booking_type(bookingType)
{
  $("#roomTypeSec").addClass('hidden').addClass('d-none');
  switch(bookingType){
    case '1':
      $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
      $("#formTitle").text("Food Ordering Form ");
      $(".chk_in_dateName").html("Date<span class='text-danger'>*</span>");
    break;

    case '2':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $("#roomTypeSec").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").html("Check in<span class='text-danger'>*</span>");
    $(".chk_out_dateName").html("Check out<span class='text-danger'>*</span>");
    $("#formTitle").text("Room Booking Form ");
    break;

    case '3':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").html("Start<span class='text-danger'>*</span>");
    $(".chk_out_dateName").html("Finish<span class='text-danger'>*</span>");
    $("#formTitle").text("Tent Hiring Form ");
    break;

    case '4':
    $("#chk_out_dateTitle").removeClass('hidden').removeClass('d-none');
    $(".chk_in_dateName").html("Start<span class='text-danger'>*</span>");
    $(".chk_out_dateName").html("Finish<span class='text-danger'>*</span>");
    $("#formTitle").text("Meeting Hall Booking Form ");
    break;

    case '5':
    $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
    $(".chk_in_dateName").html("Date<span class='text-danger'>*</span>");
    $("#formTitle").text("Compound Booking Form ");
    break;

    default:
    $("#chk_out_dateTitle").addClass('hidden').addClass('d-none');
    $(".chk_in_dateName").text("Date<span class='text-danger'>*</span>");
    $("#formTitle").text("Compound Booking Form ");
    break;
  }
}
