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
  $("#"+tableID+" tbody").append( product_row() );
}

/*
*Function to return mark up for product in requisition form table
*/
function product_row()
{
  var row = '<tr><td>Ntya</td></tr>';
  return row;
}
