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

						@if( isset($dept) )
							 <div class="col-sm-5">
								 <h4 class="text-capitalize text-bold">{{$dept->name}} Products </h4>
							 </div>
							 <div class="col-sm-5">
								 <h4 class=" results-info text-right">Showing: @if(isset($products)) {{count($products)}} of {{$products->total()}}@endif @if(isset($startDate))<span>from {{date('d-m-y',strtotime($startDate))}}</span>@endif @if(isset($endDate))<span>to {{date('d-m-y',strtotime($endDate))}}</span>@endif</h4>
							 </div>
							 <div class="col-sm-2 cart-icon">
								<a href="#" onclick="event.preventDefault();open_cart_window('chart-window')"> <span class="fa fa-shopping-cart"></span> <span class="badge badge-danger hidden count-cart-prods"></span></a>
							 </div>
						 @endif

						 </div>

						 <div id="chart-window" class="chart-window"><!--start chat window-->
							 <span class="fa fa-times-circle close" onclick="close_cart_window('chart-window')"></span>
							 <h4><span class="fas fa-clipboard-check"></span> Items to sell</h4>

							 <div class="table-responsive cart-items">
								 <table id="cart-items" class="table table-condensed">
								  <tbody>

								  	<!--<tr id="cart-prod-2">
								  		<td><span class="fa fa-times-circle" onclick="remove_cart_prod(2)"></span>&nbsp;&nbsp;&nbsp;<span class="cart-prod-img" style="background-image:url({{url('images/avatar-male.png')}})"></span> </td>
											<td>Wsa</td>
											<td><input type="number" min="1" max=""></td>
											<td>KES 20000</td>
								  	</tr>-->

								  </tbody>

									<tfoot>
										<tr>
											<td class="text-right text-bold" colspan="3">Total</td>
											<td id="cart-total">KES 50000</td>
										</tr>
									</tfoot>

								</table>
							 </div>

							 <button class="btn btn-danger center-block" type="button" name="button"><span class="fa fa-shopping-cart"></span> Sell</button>

						 </div><!--end chat window-->

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
