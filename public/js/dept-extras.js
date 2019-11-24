/*
*Add service to department form page
*/
function dept_add_service()
{
  var service = $("#nameOfService").val();
  var cost = $("#costOfService").val();

  if( service != '' && cost != '')
  {
    //append service to list
    $('#services-list').append('<li onclick="dept_remove_list(this)" ><span class="fa fa-times-circle"></span> '+service+' <small> at KES '+cost+'</small></li>');
    //$("#service_name_hidden").append(service)
  //  $("#service_cost_hidden").append(cost);
    var service = $("#nameOfService").val('');
    var cost = $("#costOfService").val('');
  }



}

function dept_remove_list(element)
{
  $(element).remove();
}
