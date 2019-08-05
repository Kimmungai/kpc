function std_search_product(id,value,tableID)
{
  if (value.length > 2) {
    var deptID = $("#currentDeptID").val();

    //send details to server
    $.post("/search-product",
      {
        string:value,
        deptID:deptID,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        //update_product_results(data);
        std_update_product_results(data,id+"-results",tableID);
      });
    }else
    {
      $(".search-box-results").addClass('d-none').addClass('hidden');
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
        $("#"+id).append('<p data-prod="'+data[x].id+'"  id="'+id+'-'+data[x].id+'" onclick="std_update_prod_table(this.id,\''+tableID+'\')">'+data[x].name+'<a class="pull-right" href="#" >select</a></p>');
      }
    }
  }else{
    $("#"+id).append('<p>No product found!</p>');
  }
}

function std_update_products_table(data,cost=0,tableID='booked-products-table')//refresh products table
{
  event.preventDefault();
  //var responseObj = JSON.stringify(data);
  //var response = JSON.parse(responseObj);
  var response = data;

  if( isObject(response) )
  {
    if( !$("#"+tableID+"-prod-result-"+response.id).length )
    {
      $("#"+tableID).append('<tr data-prod="'+response.id+'" id="'+tableID+'-prod-result-'+response.id+'"><td>'+response.sku+'</td><td>'+response.name+'</td><td class="text-info cursor" id="'+tableID+'-booked-prod-qty-'+response.id+'" onclick="std_update_amount_due(this.id,'+response.quantity+')">1</td><td id="'+tableID+'-booked-prod-price-'+response.id+'" class="text-info cursor" onclick="std_update_amount_due(this.id)">'+response.price+'</td></tr>');
    }else{
      alert("Item already added!")
    }
    $(".search-box-results").addClass('d-none').addClass('hidden');
    $(".search-box").val('');

  }else{

    if( response.sku != null){ alert(response.sku); }
    if( response.name != null){ alert(response.name); }
    if( response.quantity != null){ alert(response.quantity); }
    if( response.cost != null){ alert(response.cost); }

  }
}

function std_update_prod_table(id,tableID='booked-products-table')
{
  event.preventDefault();
  //var prodID = id.substring(30);
  var prodID = $("#"+id).data('prod');
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
      std_update_products_table(response,response.price,tableID);
      //$("#product-results-box").addClass('d-none').addClass('hidden');
      //$("#product-"+response[0].id).text("0");
    });
}

function std_update_amount_due(tdId,qty=0)
{
    var amount = prompt("please enter amount in  digits only");
    if( amount == '' ){ amount=0; }

  while( isNaN(amount) )
  {
    amount = prompt("Only digits can be entered! Please try again.");
  }

  if( qty != 0 && ( qty < amount)){ alert("Not enough in stock. Maximum available is "+qty);return; }

  if( amount !== null)
  {
    $("#"+tdId).html(amount);
  }


  //alert(userID);
}

/*function booking_create_products()//products details (products table)
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
}*/

function std_search_user(value,tableID)
{
  if (value.length > 2) {

    //send details to server
    $.post("/search-any-user",
      {
        string:value,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        std_update_user_results(data,tableID);
      });

  }
}

function std_update_user_results(data,tableID)
{

  $("#"+tableID+"-results-box").html('');
  $("#"+tableID+"-results-box").removeClass('d-none').removeClass('hidden');
  if( data.length )
  {
    for ( var x=0;x<data.length;x++ )
    {
      if( !$("#"+tableID+"user-result-"+data[x].id).length )
      {
        $("#"+tableID+"-results-box").append('<p data-user="'+data[x].id+'" id="'+tableID+'user-result-'+data[x].id+'" onclick="std_update_user_table(this.id,\''+tableID+'\')">'+data[x].firstName+'<a class="pull-right" href="#" >select</a></p>');
      }
    }
  }else{
    $("#"+tableID+"-results-box").append('<p> No records found!</p>');
  }
}

function std_update_user_table(id,tableID)
{
  var userID = $("#"+id).data('user');
  //get user from server
  $.post("/get-user",
    {
      userID:userID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //show result box
      std_update_users_table(data,tableID);
      $("#"+tableID+"-results-box").addClass('d-none').addClass('hidden');
      $("#"+tableID+"-input").val('');
    });
}


function std_update_users_table(data,tableID)//refresh users table
{

  if( isObject(data) )//means it is an object
  {
    $("#customerID").val(data.id);
    $("#"+tableID).html('<tr id="user-'+data.id+'"><td>'+data.firstName+'</td><td>'+data.email+'</td><td>'+data.phoneNumber+'</td><td> '+data.idNo+'</td></tr>');

  }

}


function std_create_user(formID,tableID)
{
  event.preventDefault();
  //grab form inputs
  var firstName = $("#"+formID).find('input[name="firstName"]').val();
  var email = $("#"+formID).find('input[name="email"]').val();
  var phoneNumber = $("#"+formID).find('input[name="phoneNumber"]').val();
  var idNo = $("#"+formID).find('input[name="idNo"]').val();
  var deptID = $("#deptID").val();
  //send details to server
  $.post("/create-user",
    {
      type:2,
      org_id:1,
      firstName: firstName,
      email: email,
      phoneNumber: phoneNumber,
      idNo:idNo,
      dept: deptID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      if( data.id )
      {
        std_update_users_table(data,tableID);
        std_clear_inputs(formID);
      }
      else{

        if( data.firstName != null){ alert(data.firstName); }
        if( data.email != null){ alert(data.email); }
        if( data.phoneNumber != null){ alert(data.phoneNumber); }
        if( data.idNo != null){ alert(data.idNo); }

      }
    });

  function  std_clear_inputs(formID)
    {
      $("#"+formID).find('input[name="firstName"]').val('');
      $("#"+formID).find('input[name="email"]').val('');
      $("#"+formID).find('input[name="phoneNumber"]').val('');
      $("#"+formID).find('input[name="idNo"]').val('');
    }
}
