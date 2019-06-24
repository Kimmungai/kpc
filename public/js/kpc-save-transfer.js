function save_transfer(tableID='transfer-products-table')
{
  var fromDept = $("#transferFromDept").val();
  var toDept = $("#transferToDept").val();
  if( toDept == '' ){alert("Please select a destination department.");return;}

  var transferedProds = [];

  $('#'+tableID+' tr').each(function(){
    var prodID = $("#"+this.id).data('prod');//this.id.substring(12);
    var prodQty = $("#"+tableID+"-booked-prod-qty-"+prodID).text();
    var prodPrice = $("#"+tableID+"-booked-prod-price-"+prodID).text();
    transferedProds.push({id:prodID,qty:prodQty,price:prodPrice});
  });

  if( !transferedProds.length ){alert("Please add at least one product to transfer.");return;}

  var con = confirm( "Are you sure you want to make the transfer?" );
  if( !con ){ return; }

  $.post("/save-transfer",//send details to server
    {
      fromDept:fromDept,
      toDept:'',
      toDeptName:toDept,
      transferedProds:transferedProds,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      if( data == 1 )
        alert("Success!")
      else
        alert("Failed!")
    });

    $('#recordTransfersModal').modal('hide');
    $('#'+tableID).html('');

}
