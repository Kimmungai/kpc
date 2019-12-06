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
  var row  = '<tr id="cart-prod-'+product.id+'">';
      if( product.img1 )
      row +='<td><span class="fa fa-times-circle" onclick="remove_cart_prod(\'cart-prod-'+product.id+'\')"></span>&nbsp;&nbsp;&nbsp;<span class="cart-prod-img" style="background-image:url('+product.img1+')"></span> </td>';
      else
      row +='<td><span class="fa fa-times-circle" onclick="remove_cart_prod(\'cart-prod-'+product.id+'\')"></span>&nbsp;&nbsp;&nbsp;<span class="cart-prod-img" style="background-image:url(/images/product-placeholder.png)"></span> </td>';
      row +='<td>'+product.name+'</td>';
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
function get_cart_row_total( id )
{
  var qty = $("#"+id+" .prod-qty input").val();
  var price = $("#"+id+" .prod-price").data('price');
  sum = (parseFloat(price) * parseFloat(qty));
  $("#"+id+" .prod-price").text(kes_currency(sum,'KES'));
  $('#cart-total').text( kes_currency( get_cart_total('cart-items'), 'KES' ) )
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
}
