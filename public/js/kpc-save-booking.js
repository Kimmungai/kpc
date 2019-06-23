function save_booking()
{

  //get form inputs
  var deptID = $("#bookingDeptID").val();
  var bookingType = $("#bookingType").val();
  var roomType = $("#roomType").val();
  var numPple = $("#numPple").val();
  var chkInDate = $("#chk_in_date").val();
  var chkOutDate = $("#chk_out_date").val();
  var bookingAmountDue = $("#bookingAmountDue").val();
  var modeOfPayment = $("#modeOfPayment").val();
  var bookingAmountReceived = $("#bookingAmountReceived").val();
  var paymentStatus = $("#paymentStatus").val();
  var paymentDueDate = $("#paymentDueDate").val();
  var board = $('input[name=board]:checked').val();
  var menu = $('input[name=menu]:checked').val();
  var menuDetails = $("#menuDetails").val();
  var meetingHall = true ? $("#meetingHall").is(":checked") : false;
  var tent = true ? $("#tent").is(":checked") : false;
  var paSystem = true ? $("#paSystem").is(":checked") : false;
  var projector = true ? $("#projector").is(":checked") : false;
  var customerID = $("#customerID").val();

  //data validation
  if( customerID == '' || numPple == '' || chkInDate == '' || bookingAmountDue  == '' || bookingAmountReceived == '' )
  {
    alert("Please fill in all required fields *");
    return;
  }


  //var contactPsnName = $("#contactPsnName").val();
  //var contactPsnIdNo = $("#contactPsnIdNo").val();
  //var contactPsnPhoneNumber = $("#contactPsnPhoneNumber").val();
//  var contactPsnEmail = $("#contactPsnEmail").val();


  var bookedProds = [];

  $('#booked-products-table tr').each(function(){
    var prodID = $("#"+this.id).data('prod');//this.id.substring(12);
    var prodQty = $("#booked-prod-qty-"+prodID).text();
    var prodPrice = $("#booked-prod-price-"+prodID).text();
    bookedProds.push({id:prodID,qty:prodQty,price:prodPrice});
  });

  var con = confirm( "Are you sure you want to save the booking details?" );
  if( !con ){ return; }

  $.post("/save-booking",//send details to server
    {
      dept_id:deptID,
      user_id:customerID,
      bookingType:bookingType,
      roomType:roomType,
      numPple:numPple,
      chkInDate:chkInDate,
      chkOutDate:chkOutDate,
      bookingAmountDue:bookingAmountDue,
      modeOfPayment:modeOfPayment,
      bookingAmountReceived:bookingAmountReceived,
      paymentStatus:paymentStatus,
      paymentDueDate:paymentDueDate,
      board:board,
      menu:menu,
      menuDetails:menuDetails,
      meetingHall:meetingHall,
      tent:tent,
      paSystem:paSystem,
      projector:projector,
      bookedProds:bookedProds,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      if( data == 1 )
        alert("Success!")
      else
        alert("Failed!")
    });

    $('#recordBookingsModal').modal('hide');
    $('#table-booking-contact').html('');
    $('#booked-products-table').html('');
    clear_booking_form();


}
function clear_booking_form()
{
  $("#numPple").val('');
  $("#chk_in_date").val('');
  $("#chk_out_date").val('');
  $("#bookingAmountDue").val('');
  $("#bookingAmountReceived").val('');
  $("#paymentDueDate").val('');
  $("#menuDetails").val('');
  $(".form-group").removeClass('has-success').removeClass('has-error');
}
