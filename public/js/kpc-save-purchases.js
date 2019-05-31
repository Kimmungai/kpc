function save_purchases()
{
  //supplier data

  var amountDue = $("#amountDue").val();
  var amountPaid = $("#amountPaid").val();
  var paymentMethod = $("#paymentMethod").val();

  //goods supplied data
}

function create_purchase()//supplier (user table) & purchases details (purchases table)
{
  //grab form inputs
  var firstName = $("#firstName").val();
  var email = $("#email").val();
  var phoneNumber = $("#phoneNumber").val();
  var amountDue = $("#amountDue").val();
  var amountPaid = $("#amountPaid").val();
  var paymentMethod = $("#paymentMethod").val();
  var deptID = $("#deptID").val();
  var method ='cash';
  if( paymentMethod =='2' ){ var method ='Cheque'; }else if( paymentMethod =='3' ){ var method ='Bank transfer'; }else if( paymentMethod =='4' ){ var method ='MPESA'; }
  //send details to server
  $.post("/create-supplier",
    {
      firstName: firstName,
      email: email,
      phoneNumber: phoneNumber,
      dept_id: deptID,
      amountDue:amountDue,
      amountPaid:amountPaid,
      paymentMethod:paymentMethod,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      update_supplier_table(data,amountDue,amountPaid,method);
    });
}


function create_products()//products details (products table)
{

}

function update_supplier_table(data,amountDue,amountPaid,method)//refresh supplier table
{
  var responseObj = JSON.stringify(data);
  var response = JSON.parse(responseObj);

  if( response.length )//means it is an array
  {
    $("#table-supplier-info").html('<tr id="supplier-'+response[0].id+'"><td>'+response[0].firstName+'</td><td>'+response[0].email+'</td><td>'+response[0].phoneNumber+'</td><td>'+amountDue+'</td><td>'+amountPaid+'</td><td>'+method+'</td></tr>');
    $("#purchasesID").val(response[1].id);
  }else{

    if( response.firstName != null){ alert(response.firstName); }
    if( response.email != null){ alert(response.email); }
    if( response.phoneNumber != null){ alert(response.phoneNumber); }
    if( response.amountDue != null){ alert(response.amountDue); }
    if( response.amountPaid != null){ alert(response.amountPaid); }

  }

}

//check if variable is an object
function isObject(val) {
    return (typeof val === 'object');
}
