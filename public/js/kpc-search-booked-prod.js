function std_search_product(id,value)
{
  if (value.length > 2) {
    //send details to server
    $.post("/search-product",
      {
        string:value,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        //update_product_results(data);
        std_update_product_results(data,id+"-results");
      });
    }
}

function std_update_product_results(data,id,tableID)
{
  $("#"+id).html('');
  $("#"+id).removeClass('d-none').removeClass('hidden');
  if( data.length )
  {
    for ( var x=0;x<data.length;x++ )
    {
      if( !$("#"+id+"-"+data[x].id).length )
      {
        $("#"+id).append('<p  id="'+id+'-'+data[x].id+'" onclick="std_update_prod_table(this.id)">'+data[x].name+'<a class="pull-right" href="#" >select</a></p>');
      }
    }
  }else{
    $("#"+id).append('<p>No product found!</p>');
  }
}

function std_update_products_table(data,cost=0,tableID='booked-products-table')//refresh products table
{
  //var responseObj = JSON.stringify(data);
  //var response = JSON.parse(responseObj);
  var response = data;

  if( isObject(response) )
  {
    if( !$("#prod-result-"+response.id).length )
    {
      $("#"+tableID).append('<tr id="prod-result-'+response.id+'"><td>'+response.sku+'</td><td>'+response.name+'</td><td class="text-info cursor" id="result-prod-qty-'+response.id+'" onclick="std_update_amount_due(this.id)">1</td><td id="result-prod-price-'+response.id+'" class="text-info cursor" onclick="std_update_amount_due(this.id)">'+response.price+'</td></tr>');
    }else{
      alert("Item already added!")
    }
    $(".search-box-results").addClass('d-none').addClass('hidden');

  }else{

    if( response.sku != null){ alert(response.sku); }
    if( response.name != null){ alert(response.name); }
    if( response.quantity != null){ alert(response.quantity); }
    if( response.cost != null){ alert(response.cost); }

  }
}

function std_update_prod_table(id)
{
  var prodID = id.substring(30);
//  alert(prodID);return;
  //var purchaseID = $("#purchasesID").val();
  //if ( purchaseID == ''){ alert("please fill in supplier details first");return; }
  //get user from server
  $.post("/get-product",
    {
      prodID:prodID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(response,status){
      //alert(response)
      //show result box
      std_update_products_table(response);
      //$("#product-results-box").addClass('d-none').addClass('hidden');
      //$("#product-"+response[0].id).text("0");
    });
}

function std_update_amount_due(tdId)
{
    var amount = prompt("please enter amount in  digits only");
    if( amount == '' ){ amount=0; }

  if( isNaN(amount) )
  {
    alert("Only digits can be entered! Please try again.");

  }else{

    $("#"+tdId).html(amount);
  }
  //alert(userID);
}

function booking_create_products()//products details (products table)
{
  //grab form inputs
  var sku = $("#bookingSku").val();
  var name = $("#bookiProdName").val();
  var quantity = $("#bookingQuantity").val();
  var cost = $("#bookiCost").val();
  var deptID = $("#deptID").val();
  alert(deptID);return;

  //send details to server
  $.post("/create-product",
    {
      sku: sku,
      name: name,
      quantity: quantity,
      cost: cost,
      dept_id: deptID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //update_products_table(data,cost);
    });
}
