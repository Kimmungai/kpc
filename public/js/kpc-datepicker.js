//user registration form
$( function() {
    $( "#chk_in_date" ).datepicker({ minDate: 0 });
    $( "#chk_out_date" ).datepicker({ minDate: 0 });
    $( "#DOB" ).datepicker({ maxDate: 0 });
    $( "#paymentDueDate" ).datepicker({ minDate: 0 });
  } );
//fiter inputs
$( "#filter_from" ).datepicker();
$( "#filter_to" ).datepicker();
