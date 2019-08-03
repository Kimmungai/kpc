function save_booking(tableID='booked-products-table',update=0)
{

  //get form inputs
  var bookingID = $('#bookingID').val();
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

  $('#'+tableID+' tr').each(function(){
    var prodID = $("#"+this.id).data('prod');//this.id.substring(12);
    var prodQty = $("#"+tableID+"-booked-prod-qty-"+prodID).text();
    var prodPrice = $("#"+tableID+"-booked-prod-price-"+prodID).text();
    bookedProds.push({id:prodID,qty:prodQty,price:prodPrice});
  });

  var con = confirm( "Are you sure you want to save the booking details?" );
  if( !con ){ return; }
  var route = "/save-booking";
  if(update){ route = "/update-booking";}

  $.post(route,//send details to server
    {
      dept_id:deptID,
      bookingID:bookingID,
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
      {
        alert("Success!");
        location.reload();
      }
      else
      {
        alert("Failed!")
      }
    });
    if( !update ){
    $('#recordBookingsModal').modal('hide');
    $('#table-booking-contact').html('');
    $('#booked-products-table').html('');
    clear_booking_form();
  }


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
