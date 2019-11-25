/*$('#search-product-box').on('keyup', function() {

     if (this.value.length > 2) {
       var deptID = $("#currentDeptID").val();

       //send details to server
       $.post("/search-product",
         {
           string:this.value,
           deptID:deptID,
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
  new_clear_prod_search();
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
  event.preventDefault();
  var prodID = id.substring(12);
  var purchaseID = $("#purchasesID").val();
  if ( purchaseID == ''){ alert("please fill in supplier details first");return; }
  if( $("#purchases-table-product-" +prodID).length ){alert("Product already added!");new_clear_prod_search();return;}
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
  var productID = $("#"+tdId).data('prod');//tdId.substring(13);
  while( isNaN(amount) )
  {
    amount = prompt("Only digits can be entered!");

  }

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


  //alert(userID);
}
function new_clear_prod_search(){
  $("#product-results-box").html('');
  $("#product-results-box").removeClass('d-none').removeClass('hidden');
}*/

/*
*Function to search
*/
function kpc_search( string, inputID, deptID, model='all' )
{
  if( string.length < 3 || inputID == '' || deptID == '' )
    return;

    //send details to server
    $.post( kpc_get_search_route(model),
      {
        string:string,
        deptID:deptID,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        update_search_panel( data, inputID+'Panel', inputID+'Table' );
      });

    unhide_element(inputID+'Panel');

}

/*
*Function to update search panel
*/
function update_search_panel( data, panelID, tableID )
{
  $("#"+panelID).html('');
  $("#"+panelID).append('<span class="close" onclick="hide_element(\''+panelID+'\')"><i class="fa fa-times-circle"></i></span>')

  if( data.length )
  {
    for ( var x=0;x<data.length;x++ )
    {
      if( !$("#search-result-"+data[x].id).length )
      {
        $("#"+panelID).append('<a id="search-result-'+data[x].id+'" href="#" onclick="event.preventDefault();update_table_with_results(\''+tableID+'\')">'+data[x].name+'</a>');
      }
    }
  }else{
    $("#"+panelID).append('<a href="#" onclick="event.preventDefault()">No result</a>');
  }
}

/*
*Update a table with search results
*/
function update_table_with_results(tableID)
{
  $('#'+tableID+' tbody').html('');//suzuki
}

/*
*Function to return correct search route
*/
function kpc_get_search_route(model)
{
  switch ( model ) {

    case 'product':
      return '/search-product';
    break;

    default:
      return '/search-product';
    break;

  }
}
