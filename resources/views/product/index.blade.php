@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a> <span>«</span></li>
                  @if( isset($dept) )
                  <li class="text-capitalize"><a href="/dept-registration/{{$dept->id}}">{{$dept->name}}</a> <span>«</span></li>
                  @endif
									<li>All products </li>
									<li class="pull-right"></li>
	              </ul>

	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">
					 <?php
					 $filter_from = isset($_GET['filter_from']) ? $_GET['filter_from'] : null;
					 $filter_to = isset($_GET['filter_to']) ? $_GET['filter_to'] : null;
					 $filter_to = strtotime($filter_from) < strtotime($filter_to) ? $filter_to : null;
					  ?>
						 <div class="row mb-1">
						<?php $no_cart_items = 0 ?>
						<?php $cart_items = [] ?>

						@if( session('cart_contents') != null )
							@if( is_array( session('cart_contents') ) )
								<?php $cart_items = session('cart_contents') ?>
								<?php $no_cart_items = count($cart_items) ?>
							@endif
						@endif

						@if( isset($dept) )
							 <div class="col-sm-5">
								 <h4 class="text-capitalize text-bold">{{$dept->name}} Products </h4>
							 </div>
							 <div class="col-sm-5">
								 <h4 class=" results-info text-right">Showing: @if(isset($products)) {{count($products)}} of {{$products->total()}}@endif @if(isset($startDate))<span>from {{date('d-m-y',strtotime($startDate))}}</span>@endif @if(isset($endDate))<span>to {{date('d-m-y',strtotime($endDate))}}</span>@endif</h4>
							 </div>
							 <div class="col-sm-2 cart-icon">
								<a href="#" onclick="event.preventDefault();open_cart_window('chart-window')"> <span class="fa fa-shopping-cart"></span> <span class="badge badge-danger @if(!$no_cart_items) hidden @endif count-cart-prods">{{$no_cart_items}}</span></a>
							 </div>
						 @endif

						 </div>

						 <div id="chart-window" class="chart-window"><!--start chat window-->
							 <span class="fa fa-times-circle close" onclick="close_cart_window('chart-window')"></span>
							 <h4><span class="fas fa-clipboard-check"></span> Items to sell</h4>

							 <div class="table-responsive cart-items">
								 <table id="cart-items" class="table table-condensed">
								  <tbody>
										<?php $sum = 0; ?>
										@foreach( $cart_items as $cart_item )
										<tr id="cart-prod-{{$cart_item['id']}}" data-id="{{$cart_item['id']}}">
								  		<td class="prod-img-1" data-img="{{$cart_item['img']}}"><span class="fa fa-times-circle" onclick="remove_cart_prod('cart-prod-{{$cart_item['id']}}')"></span>&nbsp;&nbsp;&nbsp;<span class="cart-prod-img" style="background-image:url({{$cart_item['img']}})"></span> </td>
											<td class="prod-name" data-name="{{$cart_item['name']}}">{{$cart_item['name']}}</td>
											<td class="prod-qty"><input id="cart-prod-qty-{{$cart_item['id']}}" type="number" min="{{$cart_item['minQty']}}" max="{{$cart_item['maxQty']}}" value="{{$cart_item['qty']}}" onchange="get_cart_row_total( 'cart-prod-{{$cart_item['id']}}' );"></td>
											<td class="prod-price" data-price="{{$cart_item['price']}}">KES {{number_format( $cart_item['price'] * $cart_item['qty'],2)}}</td>
								  	</tr>
										<?php $sum += ($cart_item['price'] * $cart_item['qty']) ?>
										@endforeach

								  </tbody>

									<tfoot>
										<tr>
											<td class="text-right text-bold" colspan="3">Total</td>
											<td id="cart-total">KES {{number_format($sum,2)}}</td>
										</tr>
									</tfoot>

								</table>
							 </div>



							 <button class="btn btn-danger center-block" type="button" name="button" onclick="open_cart_window('cart-customer-details');close_cart_window('chart-window');get_cart_row_total()"><span class="fa fa-shopping-cart"></span> Sell</button>

						 </div><!--end chat window-->

						 <div id="cart-customer-details" class="chart-window">
							 <span class="fa fa-times-circle close" onclick="close_cart_window('cart-customer-details')"></span>
							 <h4 class="mb-2"><span class="fas fa-clipboard-check"></span> Customer details</h4>
							<form id="booking-form" onsubmit="return()">
							 <div class="supplier-details box-shdow-1 mb-2 text-center">
								 <legend>Total Due</legend>
								 <h3 class="text-danger text-bold cart-total">KES 0.00</h3>
								 <strong class="hidden days-label">For <span class="booking-num-days"></span> day(s) </strong>
							 </div>

							 <div id="no-user-error" class="alert alert-danger alert-dismissible @if(!$errors->has('user_id'))hidden @endif" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								 <h5>Please add a customer first</h5>
							 </div>

							 @component('components.cust-search-panel')@endcomponent
							 @component('components.cust-reg-panel')@endcomponent
							 @component('components.cust-details-panel')@endcomponent
							 <div id="bookingAmountReceivedTitle" class="input-group input-group-md @if($errors->has('bookingAmountReceived')) has-error @endif">
								 <span class="input-group-addon" id=""><i class="fas fa-money-bill"></i></span>
								 <input name="bookingAmountReceived" id="bookingAmountReceived" type="number" class="form-control numeric" value="@if(old('bookingAmountReceived')){{old('bookingAmountReceived')}}@elseif(isset($booking)) {{$booking->bookingAmountReceived}} @endif" placeholder="Amount Received" value="0" onblur="validate(this.id,{required:0,min:1,max:255},this.value)"  value="{{old('bookingAmountReceived')}}">
							 </div>
							 <div class="input-group input-group-md @if($errors->has('modeOfPayment')) has-error @endif">
								 <span class="input-group-addon" id=""><i class="fas fa-info-circle"></i></span>
								 <select class="form-control" name="modeOfPayment"  id="modeOfPayment">
									 <option value="1" @if(old('modeOfPayment') == 1) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==1) selected @endif @endif>Paid in cash</option>
									 <option value="2" @if(old('modeOfPayment') == 2) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==2) selected @endif @endif>Paid by cheque</option>
									 <option value="3" @if(old('modeOfPayment') == 3) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==3) selected @endif @endif>Paid by bank transfer</option>
									 <option value="4" @if(old('modeOfPayment') == 4) selected @elseif(isset($booking)) @if($booking->modeOfPayment ==4) selected @endif @endif>Paid by MPESA</option>
								 </select>
							 </div>
							 <div id="transactionCodeTitle" class="input-group input-group-md @if($errors->has('transactionCode')) has-error @endif">
								 <span class="input-group-addon" id=""><i class="fas fa-money-check"></i></span>
								 <input type="text" id="transactionCode" class="form-control" name="transactionCode" placeholder="E.g MPESA transaction code, cheque number etc" onblur="validate(this.id,{required:0,min:3,max:255},this.value)" value="@if(old('transactionCode')){{old('transactionCode')}}@elseif(isset($booking)) {{$booking->transactionCode}} @endif">
							 </div>
							 	<input type="hidden" name="user_id" value="">
								<input class="cart-total" type="hidden" name="saleAmountDue" value="">
								<input type="hidden" name="dept_id" value="@if(isset($dept)){{$dept->id}}@endif">
							 </form>

							 <button class="btn btn-default pull-left" type="button" name="button" onclick="close_cart_window('cart-customer-details');open_cart_window('chart-window');"><span class="fa fa-arrow-alt-circle-left"></span> Back</button>
							 <button class="btn btn-success pull-right" type="button" name="button" onclick="dept_make_sale()"><span class="fa fa-money-bill"></span> Confirm Sale</button>


						 </div><!--end cart customer window-->

						 <div class="row">
 								<!--<div class="col-sm-6 mb-2">
									<div class="input-group">
							      <input type="text" class="form-control" placeholder="Search for product @if(isset($dept)) in {{$dept->name}} department @endif">
							      <span class="input-group-btn">
							        <button class="btn btn-danger" type="button">Search</button>
							      </span>
							    </div>
 								</div>-->
								<div class="col-sm-6 mb-2">
 								 <a href="{{route('prod_reg_type')}}" class="btn btn-default" title="Add new stock">Re - stock <span class="fas fa-undo"></span></a>
 							 </div>
						 </div>

							<div class="row mb-2">
								<form class="" action="{{url('/product-registration')}}" method="get">
								<div class="col-sm-2">
									<p style="line-height:40px">Sort:</p>
								</div>
								<div class="col-sm-3">
									<select id="filter_sort" class="form-control" name="filter_sort" >
										<option value="newOld" @if(isset($sortBy)) @if($sortBy == 'newOld' ) selected @endif @endif >New-Old</option>
										<option value="oldNew" @if(isset($sortBy)) @if($sortBy == 'oldNew' ) selected @endif @endif>Old-New</option>
										<option value="inOnly" @if(isset($sortBy)) @if($sortBy == 'inOnly' ) selected @endif @endif >In stock only</option>
										<option value="lowOnly" @if(isset($sortBy)) @if($sortBy == 'lowOnly' ) selected @endif @endif >Low in stock only</option>
										<option value="outOnly" @if(isset($sortBy)) @if($sortBy == 'outOnly' ) selected @endif @endif >Out of stock  only</option>
									</select>
								</div>

								<div class="col-sm-2">
									<input type="text" id="filter_from" name="filter_from" class="form-control" value="{{$filter_from}}" placeholder="Date from">
								</div>
								<div class="col-sm-1 hidden-xs">
									<p style="line-height:40px">~</p>
								</div>
								<div class="col-sm-2">
									<input type="text" id="filter_to" name="filter_to" class="form-control" value="{{$filter_to}}" placeholder="Date to">
								</div>
								<div class="col-sm-2">
									<button type="submit" class="btn btn-xs btn-dark"><i class="fas fa-sort-amount-down"></i> Filter</button>
								</div>
								</form>
							</div>

	        <!-- //breadcrumbs -->





						<div class="row">

							@if(isset($products))
								@foreach($products as $product)
								<div class="col-sm-4 mb-2">
									<div class="action-tab">
											<dl>
												<dt>
													<a href="{{route('product-registration.show',$product->id)}}">
                            @if( $product->img1 )
                            <img class="img prod-img" src="{{$product->img1}}" alt="{{$product->name}}" height="60" width="75">
                            @else
                            <img class="img prod-img" src="{{url('/images/product-placeholder.png')}}" alt="{{$product->name}}" height="60" width="75">
                            @endif
                          </a>
													@if( $product->quantity > env('LOW_STOCK_LEVEL',5) )
													<div class="status-sec">In stock <span class="fa fa-circle text-success"></span></div>
                          @elseif( $product->quantity > 0 )
													<div class="status-sec"> low Stock <span class="fa fa-circle text-warning"></span></div>
													@else
													<div class="status-sec">out of stock <span class="fa fa-circle text-danger"></span></div>
													@endif

												</dt>
												<dd class="mb-3">
													<h3><a href="{{route('product-registration.show',$product->id)}}">{{$product->name}}</a></h3>
													<p>Registered: <strong>{{date('d/m/Y',strtotime($product->created_at))}}</strong></p>
													<p>In store: <strong>{{$product->quantity}}</strong></p>
													<p>Price: <strong>Ksh. {{$product->price}}</strong></p>

													<a href="{{route('product-registration.show',$product->id)}}" class="btn btn-x-sm  btn-default pull-left mt-1" ><span class="fa fa-eye"></span> Open</a>
													<a href="#" class="btn btn-x-sm  btn-default pull-right mt-1" onclick="event.preventDefault();add_to_cart({{$product->id}})"><span class="fa fa-shopping-cart"></span> sell</a>

												<dd>
											</dl>
										</div>
								</div>
								@endforeach
							@endif

						</div>
						<div class="row">
							@if(isset($products))
								{{$products->appends(request()->except('page'))->links()}}
							@endif
						</div>

				</div>
		<!-- //inner_content-->
</div>



@endsection
