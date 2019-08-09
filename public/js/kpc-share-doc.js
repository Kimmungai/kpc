function share_doc(route,id)
{
  event.preventDefault();
  var email = prompt("Please enter an email to share to");
  if(email == null){return;}
  while( !ValidateEmail(email) )
  {
    email = prompt("The email you entered is invalid. Please try again");
    if(email == null){break;}
  }
  if(email == null){return;}

  //send details to server
  $.post(route,
    {
      id:id,
      email:email,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //show result box
      alert(data);
    });


}

function share_report(route)
{
  event.preventDefault();
  var email = prompt("Please enter an email to share to");
  if(email == null){return;}
  while( !ValidateEmail(email) )
  {
    email = prompt("The email you entered is invalid. Please try again");
    if(email == null){break;}
  }
  if(email == null){return;}

  var duration_sort = $('#duration_sort').val();
  var filter_from = $('#filter_from').val();
  var filter_to = $('#filter_to').val();

  //send details to server
  $.post(route,
    {
      duration_sort:duration_sort,
      filter_from:filter_from,
      filter_to:filter_to,
      email:email,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //show result box
      alert(data);
    });

}

//function to validate email
function ValidateEmail(val)
{
  var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(pattern.test(val))
  {
    return 1;
  }
  return 0;
}
