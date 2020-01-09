/*
*Function to add product to cart
*/
function add_to_cart(id)
{
  open_cart_window()

  if( !id )
    return

  if( isNaN(id) )
    return

  if( $('#cart-prod-'+id).length )
  {
    increase_cart_prod_qty('cart-prod-'+id+'');
    return;
  }

  //Fetch product
  $.post("/find-product",
    {
      prodID:id,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      append_product_to_cart(data)
    });
}

/*
*Function to append a product to cart
*/
function append_product_to_cart(product)
{
  $('#cart-items tbody').append( get_cart_prod_markup( product ) )
  $('#cart-total').text( kes_currency( get_cart_total('cart-items'), 'KES' ) )
  count_cart_prods()
}

/*
*Function to return cart product mark up
*/
function get_cart_prod_markup( product )
{
  var row  = '<tr id="cart-prod-'+product.id+'" data-id="'+product.id+'">';
      if( product.img1 )
      row +='<td class="prod-img-1" data-img="'+product.img1+'"><span class="fa fa-times-circle" onclick="remove_cart_prod(\'cart-prod-'+product.id+'\')"></span>&nbsp;&nbsp;&nbsp;<span class="cart-prod-img" style="background-image:url('+product.img1+')"></span> </td>';
      else
      row +='<td class="prod-img-1" data-img="/images/product-placeholder.png"><span class="fa fa-times-circle" onclick="remove_cart_prod(\'cart-prod-'+product.id+'\')"></span>&nbsp;&nbsp;&nbsp;<span class="cart-prod-img" style="background-image:url(/images/product-placeholder.png)"></span> </td>';
      row +='<td class="prod-name" data-name="'+product.name+'">'+product.name+'</td>';
      row +='<td class="prod-qty"><input id="cart-prod-qty-'+product.id+'" type="number" min="1" max="'+product.quantity+'" value="1" onchange="get_cart_row_total( \'cart-prod-'+product.id+'\' )"></td>';
      row +='<td class="prod-price" data-price="'+product.price+'">'+kes_currency(product.price,'KES')+'</td>';
      row +='</tr>';
  return row;
}

/*
*Function to remove product from cart
*/
function remove_cart_prod(id)
{
  $('#'+id).remove()
  $('#cart-total').text( kes_currency( get_cart_total('cart-items'), 'KES' ) )
  count_cart_prods()
}

/*
*Function to get cart total
*/
function get_cart_total( tableID='cart-items' )
{
  var sum = 0;
  $('#'+tableID +' tbody tr').each(function() {
    var qty = $(".prod-qty input",this).val();
    var price = $(".prod-price",this).data('price');
    sum += (parseFloat(price) * parseFloat(qty));
  });
  return sum;
}

/*
*Function to get the total of a given row in cart
*/
function get_cart_row_total( id = 0 )
{
  if( id ){
    var qty = $("#"+id+" .prod-qty input").val();
    var price = $("#"+id+" .prod-price").data('price');
    sum = (parseFloat(price) * parseFloat(qty));
    $("#"+id+" .prod-price").attr('data-price',sum);
    $("#"+id+" .prod-price").text(kes_currency(sum,'KES'));
  }
  $('#cart-total').text( kes_currency( get_cart_total('cart-items'), 'KES' ) );
  $('.cart-total').text( kes_currency( get_cart_total('cart-items'), 'KES' ) );
  $('.cart-total').val(  get_cart_total('cart-items') );

  save_cart_content();
}

/*
*Function to increament the quantity of cart product
*/
function increase_cart_prod_qty( row, increment=1 )
{
  var input = $("#"+row+" .prod-qty input");
  v = parseFloat(input.val());
  min = parseFloat(input.attr('min'));
  max = parseFloat(input.attr('max'));
  if (v >= max)
  {
    alert("You can only add a maximum of "+max+" item(s)");
    input.val(max);
    return;
  }

  var qty = input.val();
  qty = parseFloat(qty) + increment;
  input.val( qty );
  get_cart_row_total( row );
}
/*
*Function to add a badge with number of products in the cart
*/
function count_cart_prods( tableID='cart-items' )
{
  var prods = $('#'+tableID +' tbody tr').length;
  if( prods ){
    $(".count-cart-prods").text(prods)
    $(".count-cart-prods").removeClass('hidden')
  }
  else
    $(".count-cart-prods").addClass('hidden')
  save_cart_content( tableID )
}
/*
*Function to save cart contents
*/
function save_cart_content( tableID='cart-items' )
{
  cart_contents = []
  $('#'+tableID +' tbody tr').each(function() {
    var img = $(".prod-img-1",this).data('img');
    var name = $(".prod-name",this).data('name');
    var qty = $(".prod-qty input",this).val();
    var price = $(".prod-price",this).data('price');
    var id = $(this).data('id');
    var maxQty = $(".prod-qty input",this).attr('max')
    var minQty = $(".prod-qty input",this).attr('min')
    var total = parseFloat(price) * parseFloat(qty);
    var item = {img:img,name:name,qty:qty,price:price,id:id,maxQty:maxQty,minQty:minQty,total:total};
    cart_contents.push( item );
  });

  //send data to server
  $.post("/save-cart",
    {
      cart_contents:cart_contents,
      "_token": $('meta[name="csrf-token"]').attr('content'),
    },
    function(data,status){
      //alert(data)
    });

}
/*
*Function to record department sale
*/
function dept_make_sale( formId = 'booking-form' )
{
  var customerID = $('#'+formId+' input[name=user_id]').val();
  var saleAmountReceived = $('#'+formId+' input[name=bookingAmountReceived]').val();
  var modeOfPayment = $('#'+formId+' select[name=modeOfPayment]').val();
  var transactionCode = $('#'+formId+' input[name=transactionCode]').val();
  var saleAmountDue = $('#'+formId+' input[name=saleAmountDue]').val();
  var deptID = $('#'+formId+' input[name=dept_id]').val();

  if( customerID == '' ){
    $("#no-user-error").removeClass('hidden');
    return;
  }
  else
    $("#no-user-error").addClass('hidden');

    //send data to server
    $.post("/make-sale",
      {
        customerID:customerID,
        saleAmountReceived:saleAmountReceived,
        saleAmountDue:saleAmountDue,
        modeOfPayment:modeOfPayment,
        transactionCode:transactionCode,
        dept_id:deptID,
        "_token": $('meta[name="csrf-token"]').attr('content'),
      },
      function(data,status){
        alert( "Sale recorded successfully!" );
        close_cart_window('cart-customer-details');
        close_cart_window('chart-window');
        empty_cart();
      });

}

/*
*function to empty cart
*/
function empty_cart( tableID='cart-items',formId = 'booking-form' )
{
  $('#'+tableID +' tbody').html('');
  count_cart_prods(tableID);
  get_cart_row_total( );

  $('#'+formId+' input[name=user_id]').val('');
  $('#'+formId+' input[name=bookingAmountReceived]').val('');
  $('#'+formId+' select[name=modeOfPayment]').val('');
  $('#'+formId+' input[name=transactionCode]').val('');
  $('#'+formId+' input[name=saleAmountDue]').val('');

}
