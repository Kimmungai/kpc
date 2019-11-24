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

/*
*Add service to department form page
*/
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

/*
*Hide & unhide rooms panel
*/
function hide_unhide_room_panel( dept_id )
{
  if(!dept_id){return;}

  if( $('#has_rooms_1').is(':checked') )
  {
    $('.rooms-panel').removeClass('hidden');
    var has_rooms = 1;

  }
  else
  {
    var has_rooms = -1;
    $('.rooms-panel').addClass('hidden');
  }

  $.post("/update-has-rooms",
    {
      has_rooms:has_rooms,
      dept_id:dept_id,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //append room to list
    });

}

/*
*Add room type to department form page
*/
function dept_add_room( dept_id = 0 )
{
  if(!dept_id){return;}

  var type = $("#deptRoomType").val();
  var price = $("#deptRoomPriceType").val();

  if( type != '' && price != '')
  {


    $("#deptRoomType").val('');
    $("#deptRoomPriceType").val('');

    $.post("/add-dept-room",
      {
        type:type,
        price:price,
        dept_id:dept_id,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //append room to list
        $('#rooms-list').append('<li> <span class="fa fa-times-circle" onclick="dept_remove_list(this,'+data.id+')"></span> <span>'+type+'</span> <small> at KES '+price+'</small></li>');
      });


  }

}

/*
*remove room type from department form
*/
function dept_remove_room_list(element,room_id)
{
  $.post("/remove-dept-room",
    {
      room_id:room_id,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //alert(data)
    });

  $(element).parent().remove();
}
