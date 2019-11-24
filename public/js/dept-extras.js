/*
*Add service to department form page
*/
function dept_add_service( dept_id = 0 )
{
  if(!dept_id){return;}

  var service = $("#nameOfService").val();
  var cost = $("#costOfService").val();


  if( service != '' && cost != '')
  {


    $("#nameOfService").val('');
    $("#costOfService").val('');

    $.post("/add-dept-service",
      {
        service:service,
        cost:cost,
        dept_id:dept_id,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //append service to list
        $('#services-list').append('<li> <span class="fa fa-times-circle" onclick="dept_remove_list(this,'+data.id+')"></span> <span>'+service+'</span> <small> at KES '+cost+'</small></li>');
      });


  }



}

function dept_remove_list(element,service_id)
{
  $.post("/remove-dept-service",
    {
      service_id:service_id,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //alert(data)
    });

  $(element).parent().remove();
}
