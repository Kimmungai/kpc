function submit_form( id )
{
  if( id == 'requisitionForm' ){//validate requisition form before submit
    validate_requisition_form( id );
  }
  else{
    $("#"+id).submit();
  }

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

$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');

    if ($(this).find('.btn-primary').size()>0) {
        $(this).find('.btn').toggleClass('btn-primary');
    }
    if ($(this).find('.btn-danger').size()>0) {
    	$(this).find('.btn').toggleClass('btn-danger');
    }
    if ($(this).find('.btn-success').size()>0) {
    	$(this).find('.btn').toggleClass('btn-success');
    }
    if ($(this).find('.btn-info').size()>0) {
    	$(this).find('.btn').toggleClass('btn-info');
    }

    $(this).find('.btn').toggleClass('btn-default');

});

function user_state_change(user_id)
{
  var status = $('#status-user-' + user_id).is(":checked");

  if( status == true ){ status = 1; }else{ status = 0;}
  //send details to server
  $.post("/change-user-status",
    {
      status:status,
      user_id:user_id,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //show result box
      //alert("status updated");
    });
}

/*
*Function to hide element by its ID
*/
function hide_element( id )
{
  $('#'+id).addClass('hidden');
}

/*
*Function to unhide element by its ID
*/
function unhide_element( id )
{
  $('#'+id).removeClass('hidden');
}

/*
*Function to remove a row of a table
*/
function remove_row( id )
{
  $('#'+id).remove();
}

/*
*Currency formatter
*/
function kes_currency(value,currency)
{
  var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: currency,
  });

  return formatter.format(value);
}

/*
*Function to toggle input of a field in  requisition form
*/
function toggleShow(IdToHide,IdToShow,table=1)
{
  $("#"+IdToHide).addClass('hidden');
  $("#"+IdToShow).removeClass('hidden');

  if($("#"+IdToHide+" input").length){
    newValue = $("#"+IdToHide+" input").val();
    assign_new_val(newValue,IdToShow,table);
  }

}

/*
*Function to assign input value to a field title in the requisition form
*/
function assign_new_val(newValue,IdToAssign, table=1)
{
  if( newValue == '' ) { newValue = 'null'; }
  $("#"+IdToAssign).text(newValue);
  if( table )
    get_totals_of_table( table );
}

/*
*function to determine which table to get totals of
*/
function get_totals_of_table( table )
{
  switch (table) {

    case 1://table in the rquisition form
    if (jQuery.isFunction(req_calculate_product_table_total)) {
      req_calculate_product_table_total();
    }
    break;

    case 2://other booked products in the bookings form
    if (jQuery.isFunction(sum_booked_prods_table)) {
      sum_booked_prods_table();
    }
    break;

    default:
    if (jQuery.isFunction(req_calculate_product_table_total)) {
      req_calculate_product_table_total();
    }
    break;

  }
}

$(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/[^0-9\\.]+/g,'');
});
