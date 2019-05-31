$('#search-supplier-box').on('keyup', function() {

     if (this.value.length > 3) {

       //send details to server
       $.post("/search-user",
         {
           string:this.value,
           "_token": $('meta[name="csrf-token"]').attr('content'),
         },
         function(data,status){
           //show result box
           update_supplier_results(data);
         });

     }

});

function update_supplier_results(data)
{
  if( data.length )
  {
    $("#supplier-results-box").html('');
    $("#supplier-results-box").removeClass('d-none').removeClass('hidden');
    for ( var x=0;x<data.length;x++ )
    {
      if( !$("#sup-result-"+data[x].id).length )
      {
        $("#supplier-results-box").append('<p  id="sup-result-'+data[x].id+'" onclick="update_sup_table(this.id)">'+data[x].firstName+'<a class="pull-right" href="#" >select</a></p>');
      }
    }
  }
}

function update_sup_table(id)
{
  var userID = id.substring(11);
  var deptID = $("#deptID").val();
  //get user from server
  $.post("/get-user",
    {
      userID:userID,
      dept_id:deptID,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(response,status){
      //show result box
      update_supplier_table(response);
      $("#supplier-results-box").addClass('d-none').addClass('hidden');
    });
}

function update_amount_due(purchaseID,tdId)
{
  var amount = prompt("please enter amount in  digits only");
  if( isNaN(amount) )
  {
    var amount = prompt("Only digits can be entered!");

  }else{
    //send details to server
    $.post("/update-purchase",
      {
        purchases_id:purchaseID,
        field: 'amountDue',
        value: parseFloat(amount),
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        update_supplier_results(data);
      });
    $("#"+tdId).html(amount);
  }
  //alert(userID);
}
function update_amount_due(purchaseID,tdId,field)
{
  if( field === 'paymentMethod' ){
    amount = parseInt(tdId);//any no.
  }else{
    var amount = prompt("please enter amount in  digits only");
  }
  if( isNaN(amount) )
  {
    var amount = prompt("Only digits can be entered!");

  }else{
    //send details to server
    $.post("/update-purchase",
      {
        purchases_id:purchaseID,
        field: field,
        value: parseFloat(amount),
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        //show result box
        update_supplier_results(data);
      });
    $("#"+tdId).html(amount);
  }
  //alert(userID);
}
$(document).ajaxStart(function(){
  //$(".search-box .loading").removeClass('hidden').removeClass('d-none');
});

$(document).ajaxStop(function(){
  //$(".search-box .loading").addClass('hidden').addClass('d-none');
});
