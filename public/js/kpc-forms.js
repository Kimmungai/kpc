function submit_form( id )
{
  $("#"+id).submit();
}

function toggleElements(elementA,elementB)
{
  $('#'+elementA).removeClass('d-none').removeClass('hidden');
  $('#'+elementB).addClass('d-none').addClass('hidden');
}
