function save_purchases()//make purchases records visible by nulling the deleted_at field
{
  var purchasesID = $("#purchasesID").val();
  var deptID = $("#deptID").val();
  if( purchasesID === '' || deptID ===''){alert("Please fill in the form first!");return;}
  var con = confirm( "Are you sure you want to save details?" );
  if( con )
  {
    var purchasesID = $("#purchasesID").val();
    //send details to server
    $.post("/restore-purchases",
      {
        purchases_id:purchasesID,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        clear_inputs();
        alert("Details successfully saved!");
        $('#recordPurchasesModal').modal('hide');
      });
  }
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
  //grab form inputs
  var sku = $("#sku").val();
  var name = $("#prodName").val();
  var quantity = $("#quantity").val();
  var cost = $("#cost").val();
  var purchasesID = $("#purchasesID").val();
  var deptID = $("#deptID").val();

  if( purchasesID === '' ){ alert("Please fill in the supplier details first!");return; }
  //send details to server
  $.post("/create-product",
    {
      sku: sku,
      name: name,
      quantity: quantity,
      cost: cost,
      purchases_id:purchasesID,
      dept_id: deptID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      update_products_table(data);
    });
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

function update_products_table(data)//refresh products table
{
  var responseObj = JSON.stringify(data);
  var response = JSON.parse(responseObj);

  if( response.length )//means it is an array
  {
    $("#purchases-table").append('<tr><td>'+response[0].sku+'</td><td>'+response[0].name+'</td><td>'+response[0].quantity+'</td><td>'+response[0].cost+'</td></tr>')

  }else{

    if( response.sku != null){ alert(response.sku); }
    if( response.name != null){ alert(response.name); }
    if( response.quantity != null){ alert(response.quantity); }
    if( response.cost != null){ alert(response.cost); }

  }
}

function clear_inputs()
{
  $("#purchases-table").html('');
  $("#table-supplier-info").html('');
  $("#sku").val('');
  $("#prodName").val('');
  $("#quantity").val('');
  $("#cost").val('');
  $("#purchasesID").val('');
  $("#deptID").val('');
  $("#firstName").val('');
  $("#email").val('');
  $("#phoneNumber").val('');
  $("#amountDue").val('');
  $("#amountPaid").val('');
  $("#paymentMethod").val('');
  $("#deptID").val('');
}

//check if variable is an object
function isObject(val) {
    return (typeof val === 'object');
}