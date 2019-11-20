/*
*Function to toggle input of a field in  requisition form
*/
function toggleShow(IdToHide,IdToShow)
{
  $("#"+IdToHide).addClass('hidden');
  $("#"+IdToShow).removeClass('hidden');

  if($("#"+IdToHide+" input").length){
    newValue = $("#"+IdToHide+" input").val();
    assign_new_val(newValue,IdToShow);}

}

/*
*Function to assign input value to a field title in the requisition form
*/
function assign_new_val(newValue,IdToAssign)
{
  if( newValue == '' ) { newValue = 'null'; }
  $("#"+IdToAssign).text(newValue);
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

  var td = '<td data-label="'+get_col_label( col )+'">';
        td += '<span id="col-'+nextRow+'-'+col+'" data-col=\''+nextRow+'.'+col+'\' class="hidden" onclick="toggleShow(\'col-'+nextRow+'-'+col+'\',\'col-'+nextRow+'-'+col+'-edit\')"></span>';
        td +=   '<span id="col-'+nextRow+'-'+col+'-edit" >';

        if( col == 1 ){//if first column, include product search event on key up
          td +=     '<input name="col-'+nextRow+'-'+col+'" type="text" class="form-control" placeholder="" value="" onchange="assign_new_val(this.value,\'col-'+nextRow+'-'+col+'\')" onfocusout="toggleShow(\'col-'+nextRow+'-'+col+'-edit\',\'col-'+nextRow+'-'+col+'\')" onkeyup="search_product(this.value,\'col-'+nextRow+'-'+col+'\')">';
          td += get_table_search_panel_markup( nextRow, col );
        }
        else{
          td +=     '<input name="col-'+nextRow+'-'+col+'" type="text" class="form-control" placeholder="" value="" onchange="assign_new_val(this.value,\'col-'+nextRow+'-'+col+'\')" onfocusout="toggleShow(\'col-'+nextRow+'-'+col+'-edit\',\'col-'+nextRow+'-'+col+'\')" >';
        }
        td +=  '</span>';
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
function search_product( string, parentID )
{
  if( string.length < 3 ) //start searching when charaters are 3 or more
    return

    //Search for the damn product

    //unhide results box
    $("#"+parentID+'-search-panel').removeClass('hidden');
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
      mark_up += '<span class="close" onclick="hide_element(\'col-'+nextRow+'-'+col+'-search-panel\')"><i class="fa fa-times-circle"></i></span>';
      mark_up += '<a href="#">wajuiwajui</a>';
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
