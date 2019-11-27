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
        $("#"+panelID).append('<a id="search-result-'+data[x].id+'" href="#" onclick="event.preventDefault();update_table_with_results(\''+tableID+'\',\''+panelID+'\',\''+data[x].id+'\')">'+data[x].name+'</a>');
      }
    }
  }else{
    $("#"+panelID).append('<a href="#" onclick="event.preventDefault()">No result</a>');
  }
}

/*
*Update a table with search results
*/
function update_table_with_results(tableID,searchPanelID,prodID)
{
  hide_element(searchPanelID);
  $('.search-input').val('');
  var nextRow = $('#'+tableID+' tbody tr').length + 1;

  //get product from server
  $.post("/find-product",
    {
      prodID:prodID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //append row to other booked products table
      if( !product_in_table(tableID,prodID) )
      {
        $('#'+tableID+' tbody').append(booked_prods_table_markup(data,nextRow,tableID));
        sum_booked_prods_table(tableID);
        unhide_element(tableID);
      }
      else
      {
        var con = confirm("Item already in table, would you like to increase its quantity?");

        if(con)
        {
          increase_prod_qty_in_booked_prods_table(tableID, prodID);
        }

      }
    });


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

/*
*Function to append other booked products table with new row
*/
function booked_prods_table_markup(data,nextRow,tableID)
{
  var row =  '<tr id="booked-prods-row-'+nextRow+'" data-product="'+data.id+'">';
      row += '<td id="col_'+nextRow+'_1" data-label="#"><span class="fas fa-times-circle" onclick="remove_row_hide_empty_table( \'booked-prods-row-'+nextRow+'\', \''+tableID+'\' )"></span> &nbsp;&nbsp;&nbsp;'+nextRow+'.</td>';
      row += '<td  data-label="Name"> <span id="col_'+nextRow+'_2"  onclick="toggleShow(this.id,this.id+\'_editor\',2)">'+data.name+'</span>';
      row += edit_booked_prods_col( 'col_'+nextRow+'_2', data.name);
      row += '</td>';
      row += '<td data-label="Description"> <span id="col_'+nextRow+'_3"  onclick="toggleShow(this.id,this.id+\'_editor\',2)">'+data.description+'</span>';
      row += edit_booked_prods_col( 'col_'+nextRow+'_3', data.description );
      row += '</td>';
      row += '<td data-label="Quantity"><span id="col_'+nextRow+'_4"  onclick="toggleShow(this.id,this.id+\'_editor\',2)">1</span>';
      row += edit_booked_prods_col( 'col_'+nextRow+'_4', 1, 'numeric' );
      row += '</td>';
      row += '<td  data-label="Selling price"> <span id="col_'+nextRow+'_5"  onclick="toggleShow(this.id,this.id+\'_editor\',2)">'+data.price+'</span>';
      row += edit_booked_prods_col( 'col_'+nextRow+'_5', data.price, 'numeric' );
      row += '</td>';
      row += '<td id="col_'+nextRow+'_6" data-label="Total"> </td><input type="hidden" name="col_'+nextRow+'_6" value="1">';
  return row;
}

/*
*Function to remove a row of a table and hide table if all rows are removed
*/
function remove_row_hide_empty_table( id, tableID )
{
  $('#'+id).remove();

  if( !$('#'+tableID+' tbody tr').length )
    $('#'+tableID).addClass('hidden');

  sum_booked_prods_table( tableID );

}

/*
*Calculate values in the booked products table
*/
function sum_booked_prods_table( tableID='otherProductsSearchTable' )
{
  var grandTotal = 0;
  var row = 1;

  $('#'+tableID+' tbody tr').each(function(){

    while( !$('#booked-prods-row-'+row+'').length ){ row += 1; }

    var quantity = parseFloat($('#booking-form input[name=col_'+row+'_4]').val());
    var selling_price = parseFloat($('#booking-form input[name=col_'+row+'_5]').val());

    var total = quantity * selling_price;
    $('#booking-form input[name=col_'+row+'_6]').val(total);
    $('#col_'+row+'_6').text(kes_currency(total,'KES'));

    grandTotal += total;
    row += 1;
  });

  $('#booking-form input[name=booked_prods_grand_total]').val(grandTotal);
  $('#booked_prods_grand_total').text(kes_currency(grandTotal,'KES'));

}

/*
*Function to check whether a product is already in table
*/
function product_in_table( tableID, prodID )
{
  var in_table = 0;

  $('#'+tableID+' tbody tr').each(function(){
    if( $(this).data('product') == prodID )
    {
      in_table += 1;
    }
  });

  return in_table;
}

/*
*Function to increase quantity of a product in the booked products table by 1
*/
function increase_prod_qty_in_booked_prods_table(tableID, prodID)
{
  var row = 1;

  $('#'+tableID+' tbody tr').each(function(){

    if( $(this).data('product') == prodID )
    {
      var quantity = parseFloat($('#booking-form input[name=col_'+row+'_4]').val());
      var new_quantity = quantity + 1;
      $('#booking-form input[name=col_'+row+'_4]').val(new_quantity);
      $('#col_'+row+'_4').text(new_quantity);
      sum_booked_prods_table( tableID );
      return false;
    }

    row += 1;
  });
}

/*
*Function to return markup for editing a column in booked products table
*/
function edit_booked_prods_col( id, value='', numeric='',placeholder='' )
{
  var markup  = '<span id="'+id+'_editor" class="hidden">';
      markup += '<input name="'+id+'" type="text" class="form-control '+numeric+'" placeholder="'+placeholder+'" value="'+value+'" onchange="assign_new_val(this.value,\''+id+'\',2)" onfocusout="toggleShow(\''+id+'_editor\',\''+id+'\',2)" >';
      markup += '</span>';

  return  markup;
}
