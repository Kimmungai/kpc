function set_report_duration(value,id)
{
  if(value == 'dates'){
    $("#specific-dates").removeClass('d-none').removeClass('hidden');
  }else {
    $("#filter_to").val('');
    $("#filter_from").val('');
    $("#specific-dates").addClass('d-none').addClass('hidden');
  }
}

function clear_max_field(id)
{
  $("#"+id).val('');
}
