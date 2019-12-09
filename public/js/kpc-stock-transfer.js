
function select_dept(dept,selectID = 'allDepts')
{
  $("#destinationDept .ca-sub").text(dept);
  $("#transferToDept").val(dept);


  $('#booking-form input[name=toDept]').val(get_selected_data_id( selectID  ))
}

/*
*function to get the id of selected dept
*/
function get_selected_data_id( selectID = 'allDepts' )
{
  var dept_id = $("#"+selectID).find(':selected').data('id')
  return dept_id;
}
