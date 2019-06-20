$('#search-product-box').on('keyup', function() {

     if (this.value.length > 2) {
       //send details to server
       $.post("/search-product",
         {
           string:this.value,
           "_token": $('meta[name="csrf-token"]').attr('content'),
         },
         function(data,status){
           //show result box
           update_product_results(data);
         });

     }

});

function update_product_results(data)
{
  $("#product-results-box").html('');
  $("#product-results-box").removeClass('d-none').removeClass('hidden');
  if( data.length )
  {
    for ( var x=0;x<data.length;x++ )
    {
      if( !$("#prod-result-"+data[x].id).length )
      {
        $("#product-results-box").append('<p  id="prod-result-'+data[x].id+'" onclick="update_prod_table(this.id)">'+data[x].name+'<a class="pull-right" href="#" >select</a></p>');
      }
    }
  }else{
    $("#product-results-box").append('<p>No product found!</p>');
  }
}

function update_prod_table(id)
{
  var prodID = id.substring(12);
  var purchaseID = $("#purchasesID").val();
  if ( purchaseID == ''){ alert("please fill in supplier details first");return; }
  //get user from server
  $.post("/get-product",
    {
      prodID:prodID,
      purchaseID:purchaseID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(response,status){
      //show result box
      update_products_table(response);
      $("#product-results-box").addClass('d-none').addClass('hidden');
      $("#product-"+response[0].id).text("0");
    });
}

function update_product_quantity(purchaseID,tdId,field)
{
  var amount = prompt("please enter quantity in  digits only");
  var productID = tdId.substring(8);
  if( isNaN(amount) )
  {
    amount = prompt("Only digits can be entered!");

  }else{
    if( amount == '' ){ amount = 0; }
    //if( field ==='quantity' ){
      //var current_val = parseInt($("#"+tdId).text());
      //var new_val = current_val + parseInt(amount);
      //if(new_val < 0){alert("Not enough items in stock!");return;}
      //$("#"+tdId).html(new_val);
    //}else{
      $("#"+tdId).html(amount);
    //}

    //send details to server
    $.post("/update-product",
      {
        product_id:productID,
        field: field,
        value: parseFloat(amount),
        purchaseID:purchaseID,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        //update_supplier_results(data);
        //alert(data);
      });

  }
  //alert(userID);
}
