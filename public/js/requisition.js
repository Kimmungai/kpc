/*
*Function to toggle input of a field in  requisition form
*/
function toggleShow(IdToHide,IdToShow)
{
  $("#"+IdToHide).addClass('hidden');
  $("#"+IdToShow).removeClass('hidden');
}

/*
*Function to assign input value to a field title in the requisition form
*/
function assign_new_val(newValue,IdToAssign)
{
  $("#"+IdToAssign).text(newValue);
}
