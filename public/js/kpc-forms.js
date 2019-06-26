function submit_form( id )
{
  $("#"+id).submit();
}

function toggleElements(elementA,elementB)
{
  $('#'+elementA).removeClass('d-none').removeClass('hidden');
  $('#'+elementB).addClass('d-none').addClass('hidden');
}

function sortPurchases(value)
{
  window.open('/sort-purchases/'+value,'_self');
}

function filterPurchases()
{
  /*event.preventDefault();
  var startDate = $("#filter_from").val();
  var endDate = $("#filter_to").val();
  var sort = $("#filter_sort").val();
  window.open('/sort-purchases/'+sort+'/'+startDate+'/'+endDate,'_self');*/
}
