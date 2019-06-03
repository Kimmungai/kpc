function save_booking()
{
  //get form inputs
  bookingType = $("#bookingType").val();
  roomType = $("#roomType").val();
  numPple = $("#numPple").val();
  chkInDate = $("#chk_in_date").val();
  chkOutDate = $("#chk_out_date").val();
  bookingAmountDue = $("#bookingAmountDue").val();
  modeOfPayment = $("#modeOfPayment").val();
  bookingAmountReceived = $("#bookingAmountReceived").val();
  paymentStatus = $("#paymentStatus").val();
  paymentDueDate = $("#paymentDueDate").val();
  board = $('input[name=board]:checked').val();
  menu = $('input[name=menu]:checked').val();
  menuDetailsDate = $("#menuDetailsDate").val();
  meetingHall = true ? $("#meetingHall").is(":checked") : false;
  tent = true ? $("#tent").is(":checked") : false;
  paSystem = true ? $("#paSystem").is(":checked") : false;
  projector = true ? $("#projector").is(":checked") : false;

  contactPsnName = $("#contactPsnName").val();
  contactPsnIdNo = $("#contactPsnIdNo").val();
  contactPsnPhoneNumber = $("#contactPsnPhoneNumber").val();
  contactPsnEmail = $("#contactPsnEmail").val();

  var bookedProds = {};

  $('#booked-products-table tr').each(function(){
    prodID = this.id.substring(12);
    prodQty = $("#booked-prod-qty-"+prodID).text();
    prodPrice = $("#booked-prod-price-"+prodID).text();
    bookedProds += {id:prodID, qty:prodQty, price:prodPrice};
  });

  

}
