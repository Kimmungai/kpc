/*
*Function to toggle input of a field in  requisition form
*/
function toggleShow(IdToHide,IdToShow)
{
  $("#"+IdToHide).addClass('hidden');
  $("#"+IdToShow).removeClass('hidden');

  if($("#"+IdToHide+" input").length){
    newValue = $("#"+IdToHide+" input").val();
    assign_new_val(newValue,IdToShow);
  }

}

/*
*Function to assign input value to a field title in the requisition form
*/
function assign_new_val(newValue,IdToAssign)
{
  if( newValue == '' ) { newValue = 'null'; }
  $("#"+IdToAssign).text(newValue);
  req_calculate_product_table_total();
}

/*
*Function to assign value to an input by name
*/
function assign_new_val_to_input( newValue, inputName )
{
  $('#requisitionForm input[name='+inputName+']').val( newValue );
}

/*
*Function to add a new product row on the requisition form table
*/
function add_prod_table_row( tableID )
{
  var numRows = $("#"+tableID+" tbody tr").length;
  $("#"+tableID+" tbody").append( product_row( numRows ) );

}

/*
*Function to return mark up for product in requisition form table
*/
function product_row( numRows )
{
  var cols = 6;
  var nextRow = numRows + 1;

  var row = '<tr id="row-'+nextRow+'" data-row="'+nextRow+'">';
      row += '<td><span class="fas fa-times-circle" onclick="remove_table_row(\'row-'+nextRow+'\')"></span></td>';
      for( var col = 1; col <= cols; col++ )
      {
        row +=  product_col( nextRow, col );
      }
      row += '</tr>';

  return row;
}

/*
*Function to return column of a row in requisition form table
*/
function product_col( nextRow, col )
{
  var hidden_last_col = 'hidden';
  var hidden_other_col = '';
  if( col == 6 ){ hidden_last_col = ''; hidden_other_col = 'hidden';}

  var numeric = '';
  var value = '';
  var placeholder = get_col_label( col );

  if( col == 3 || col == 4 || col == 5 || col == 6 ){ numeric = 'numeric'; value = 0; placeholder = 'Numbers only';}

  var td = '<td data-label="'+get_col_label( col )+'">';
        td += '<span id="col-'+nextRow+'-'+col+'" data-col=\''+nextRow+'.'+col+'\' class="'+hidden_last_col+'" onclick="toggleShow(\'col-'+nextRow+'-'+col+'\',\'col-'+nextRow+'-'+col+'-edit\')"></span>';
        td +=   '<span id="col-'+nextRow+'-'+col+'-edit" class="'+hidden_other_col+'">';

        if( col == 1 ){//if first column, include product search event on key up
          td +=     '<input name="col-'+nextRow+'-'+col+'" type="text" class="form-control" placeholder="'+placeholder+'" value="" onchange="assign_new_val(this.value,\'col-'+nextRow+'-'+col+'\')" onfocusout="toggleShow(\'col-'+nextRow+'-'+col+'-edit\',\'col-'+nextRow+'-'+col+'\')" onkeyup="search_product(this.value,\'col-'+nextRow+'-'+col+'\','+nextRow+')">';
        }
        else{
          td +=     '<input name="col-'+nextRow+'-'+col+'" type="text" class="form-control '+numeric+'" placeholder="'+placeholder+'" value="'+value+'" onchange="assign_new_val(this.value,\'col-'+nextRow+'-'+col+'\')" onfocusout="toggleShow(\'col-'+nextRow+'-'+col+'-edit\',\'col-'+nextRow+'-'+col+'\')" >';
        }
        td +=  '</span>';

        if( col == 1 ){
          td += get_table_search_panel_markup( nextRow, col );
        }

      td += '</td>';

  return td;
}

/*
*Function to remove a row of the table in the requisition form
*/
function remove_table_row( id )
{
  $('#'+id).remove();
}

/*
*Function to search for a product in requisition form
*/
function search_product( string, parentID, row )
{
  if( string.length < 3 ) //start searching when charaters are 3 or more
    return

    //Send search request to server
    var deptID = $("#currentDeptID").val();

    if( !deptID )
      return

    $.post("/search-product",
      {
        string:string,
        deptID:deptID,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        update_requisition_product_results ( data, parentID, row );
      });

    //unhide results box and clear any contents inside it
    unhide_element( parentID+'-search-panel' );
    clear_html( parentID+'-search-panel' );
}

/*
*Function to get column label of a responsive table of the requisition form
*/
function get_col_label( col )
{
  switch ( col ) {
    case 1:
      return 'Item';
    break;

    case 2:
      return 'Description';
    break;

    case 3:
      return 'Sale price';
    break;

    case 4:
      return 'Cost / unit';
    break;

    case 5:
      return 'Quantity';
    break;

    case 6:
      return 'Total Cost';
    break;

    default:
      return 'Item';
    break;

  }
}

/*
*Function to return search panel mark up for product table
*/
function get_table_search_panel_markup( nextRow, col )
{
  var mark_up = '<div id="col-'+nextRow+'-'+col+'-search-panel" class="search-panel hidden">';
      //mark_up += '<span class="close" onclick="hide_element(\'col-'+nextRow+'-'+col+'-search-panel\')"><i class="fa fa-times-circle"></i></span>';
      //mark_up += '<a href="#">wajuiwajui</a>';
      mark_up += '</div>';

      return mark_up;
}

/*
*Function to hide element by its ID
*/
function hide_element( id )
{
  $('#'+id).addClass('hidden');
}

/*
*Function to unhide element by its ID
*/
function unhide_element( id )
{
  $('#'+id).removeClass('hidden');
}

/*
*Function to update the result panel in the requisition form
*/
function update_requisition_product_results ( data, parentID, row )
{
  if( data.length )
  {
    for ( var x=0;x<data.length;x++ )
    {
      if( !$("#req-prod-result-"+data[x].id+parentID).length )
      {
        $("#"+parentID+'-search-panel').append('<a href="#" id="req-prod-result-'+data[x].id+parentID+'" data-id="'+data[x].id+'" onclick="event.preventDefault();req_update_product_table(this.id,\''+parentID+'\','+row+')">'+data[x].name+'</a>');
      }
    }
  }
  else
  {
    hide_element( parentID+'-search-panel' );
  }

}

/*
*Function to clear all HTML from an element
*/
function clear_html( elementID )
{
  $("#"+elementID ).html( '' );
}



/*
*Function to update requisition table with search result option
*/
function req_update_product_table( colID, parentID, row )
{
  hide_element( parentID+'-search-panel' );
  var prodID = $("#"+colID).data('id');

  //get product from server
  $.post("/find-product",
    {
      prodID:prodID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){

      var col_1 = 'col-'+row+'-1';
      assign_new_val( data.name, col_1 );
      assign_new_val_to_input( data.name, col_1 );
      $("#"+col_1+"-edit").addClass('hidden');
      $("#"+col_1).removeClass('hidden');

      var col_2 = 'col-'+row+'-2';
      assign_new_val( data.description, col_2 );
      assign_new_val_to_input( data.description, col_2 );
      $("#"+col_2+"-edit").addClass('hidden');
      $("#"+col_2).removeClass('hidden');

      var col_3 = 'col-'+row+'-3';
      assign_new_val( data.price, col_3 );
      assign_new_val_to_input( data.price, col_3 );
      $("#"+col_3+"-edit").addClass('hidden');
      $("#"+col_3).removeClass('hidden');

      var col_4 = 'col-'+row+'-4';
      assign_new_val( data.cost, col_4 );
      assign_new_val_to_input( data.cost, col_4 );
      $("#"+col_4+"-edit").addClass('hidden');
      $("#"+col_4).removeClass('hidden');

      var col_5 = 'col-'+row+'-5';
      assign_new_val( data.lowStockAlert, col_5 );
      assign_new_val_to_input( data.lowStockAlert, col_5 );
      $("#"+col_5+"-edit").addClass('hidden');
      $("#"+col_5).removeClass('hidden');

    });

}

/*
*Function to calculate the total cost of a row in the requisition form
*/
function req_calculate_product_table_total( )
{
  var subTotal = 0;

  $("#products-table tbody tr").each(function(){
    var sum = 0;
    var row = $(this).data('row');
    var cost_field = parseFloat($('#requisitionForm input[name=col-'+row+'-4]').val());
    var quantity_field = parseFloat($('#requisitionForm input[name=col-'+row+'-5]').val());

    if( isNaN(cost_field) || isNaN(quantity_field) ){return;}

    sum = ( cost_field * quantity_field )

    $('#col-'+row+'-6').text( kes_currency(sum,'KES') )
    $('#requisitionForm input[name=col-'+row+'-6]').val(sum)

    subTotal += sum;

  });

  $('#req_subtotal').text(kes_currency(subTotal,'KES'));
  $('#requisitionForm input[name=req_subtotal]').val(subTotal);

  var vat = parseFloat($('#requisitionForm input[name=vat_percent]').val());
  var vatTotal = vat * subTotal *0.01;

  $('#req-vat').text(kes_currency(vatTotal,'KES'));
  $('#requisitionForm input[name=vat_total]').val(vatTotal);

  var grandTotal = subTotal + vatTotal;

  $('#req_grandtotal').text(kes_currency(grandTotal,'KES'));
  $('#requisitionForm input[name=req_grandtotal]').val(grandTotal);

}

/*
*Currency formatter
*/
function kes_currency(value,currency)
{
  var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: currency,
  });

  return formatter.format(value);
}

/*
*function to count number of rows in the requisition form table and assign to a hidden input
*/
function req_num_rows()
{
  $('#requisitionForm input[name=no_products]').val($("#products-table tbody tr").length);
}

/*
*function to validate requisition form before submitiion
*/
function validate_requisition_form( id )
{
  var row = 1;
  var error = 0;

  $("#products-table tbody tr").each(function(){

    if( $("#"+id+" input[name='col-"+row+"-1']").val() == '' )
    {
      error += 1;
    }

    if( $("#"+id+" input[name='col-"+row+"-3']").val() == '' || $("#"+id+" input[name='col-"+row+"-3']").val() == 0 )
    {
      error += 1;
    }

    if( $("#"+id+" input[name='col-"+row+"-4']").val() == '' || $("#"+id+" input[name='col-"+row+"-4']").val() == 0 )
    {
      error += 1;
    }

    if( $("#"+id+" input[name='col-"+row+"-5']").val() == '' || $("#"+id+" input[name='col-"+row+"-5']").val() == 0 )
    {
      error += 1;
    }

    row += 1;
  });

  if( error )
  {
    $('#'+id+'Alert').removeClass('hidden');
  }
  else
  {
    $("#"+id).submit();
  }
}

/*
*Function to approve requisition form
*/
function requisition_approval_change(requisition_id)
{
  var status = $('#req-approval-' + requisition_id).is(":checked");

  if( status == true ){ status = 1; }else{ status = 0;}

  //send details to server
  $.post("/requisition-approval",
    {
      requisition_id:requisition_id,
      status:status,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      if( data == 1 )
        alert("Update succesfull!");
      else
        alert("Error!");
    });
    
}

$(document).ajaxStop(function(){

  req_calculate_product_table_total();

});

$(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/[^0-9\\.]+/g,'');
});
