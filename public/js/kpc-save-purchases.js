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
        location.reload();
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
      update_products_table(data,cost,quantity);
    });
}




function update_supplier_table(data,amountDue=0,amountPaid=0,method=0)//refresh supplier table
{
  var responseObj = JSON.stringify(data);
  var response = JSON.parse(responseObj);

  if( response.length )//means it is an array
  {
    if( method == 0 )
    {
      method = '<select id="supplier-'+response[1].id+'-payment-method" onchange="update_amount_due('+response[1].id+',this.value,\'paymentMethod\')"><option value="0" disabled>select one</option><option value="1">Paid by cash</option><option value="2">Paid by cheque</option><option value="3">Paid by bank transfer</option><option value="4">MPESA</option></select>'
    }

    $("#table-supplier-info").html('<tr id="supplier-'+response[0].id+'"><td>'+response[0].firstName+'</td><td>'+response[0].email+'</td><td>'+response[0].phoneNumber+'</td><td class="text-info cursor" id="supplier-'+response[0].id+'-amount-due" onclick="update_amount_due('+response[1].id+',this.id,\'amountDue\')"> '+amountDue+'</td><td class="text-info cursor" id="supplier-'+response[0].id+'-amount-paid" onclick="update_amount_due('+response[1].id+',this.id,\'amountPaid\')">'+amountPaid+'</td><td>'+method+'</td></tr>');
    $("#purchasesID").val(response[1].id);
    toggleElements('search-supplier-form-container','purchase-create-supplier-form-container');
  }else{

    if( response.firstName != null){ alert(response.firstName); }
    if( response.email != null){ alert(response.email); }
    if( response.phoneNumber != null){ alert(response.phoneNumber); }
    if( response.amountDue != null){ alert(response.amountDue); }
    if( response.amountPaid != null){ alert(response.amountPaid); }
  }

}

function update_products_table(data,cost=0,qty=1)//refresh products table
{
  var responseObj = JSON.stringify(data);
  var response = JSON.parse(responseObj);

  if( response.length )//means it is an array
  {
    if( !$("#purchases-table-product-" +response[0].id).length ){
      var purchaseID = $("#purchasesID").val();
      $("#purchases-table").append('<tr id="purchases-table-product-'+response[0].id+'"><td>'+response[0].sku+'</td><td>'+response[0].name+'</td><td data-prod="'+response[0].id+'" class="text-info cursor" id="product-'+response[0].id+'" onclick="update_product_quantity('+purchaseID+',this.id,\'suppliedQuantity\')">'+qty+'</td><td data-prod="'+response[0].id+'" class="text-info cursor" id="product-cost-'+response[0].id+'" onclick="update_product_quantity('+purchaseID+',this.id,\'cost\')">'+cost+'</td></tr>');
      toggleElements('purchases-search-product-form-container','purchases-create-product-form-container');
    }else{
      alert("Product already added!");
    }

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

$(document).ajaxStart(function(){
  if( $('#recordPurchasesModal').hasClass('in') ) {
    $(".search-box .loading").removeClass('hidden').removeClass('d-none');
  }
});

$(document).ajaxStop(function(){
  $(".search-box .loading").addClass('hidden').addClass('d-none');
});
