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
									<li><a href="/purchases-registration">Purchases</a> <span>«</span></li>
                  <li>Purchase-@if(isset($purchase)){{$purchase->id}} @endif</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Purchase-@if(isset($purchase)){{$purchase->id}} @endif </h1>
							@endif
						</div>

						<div class="row">
              <!--purchase reg form-->
              <div class="modal-body">
                <!--/start supplier-->
      					<div class="set-1_w3ls">
      							<div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
      							 <h3 class="w3_inner_tittle two">Supplier</h3>
                     <div class="" id="search-supplier-form-container">
                       <div class="input-group search-box">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        <div class="loading hidden d-none">
                          <img src="{{url('images/search-loading.gif')}}" alt="" height="10" width="50">
                        </div>
                        <input id="search-supplier-box"  type="text" class="form-control" name="search" placeholder="Search by name...">
                       </div>
                       <div id="supplier-results-box" class="search-box-results border-1 hidden d-none">

                       </div>
                       <div class="form-group">
                         <button type="button" class="btn btn-warning btn-sm" name="button" onclick="toggleElements('purchase-create-supplier-form-container','search-supplier-form-container')">Create new supplier record instead <i class="fa fa-database"></i></button>
                       </div>
                     </div>


      										<div class="grid-1 hidden d-none" id="purchase-create-supplier-form-container">
      											<div class="form-body">
      												<div data-example-id="simple-form-inline">
                                <form class="form-inline">

                                  <div class="form-group" id="firstNameTitle">
                                      <div class="input-group input-icon right">
                                        <span class="input-group-addon">
                                          <i class="fa fa-info"></i>
                                        </span>
                                        <input name="firstName" id="firstName" type="text" class="form-control" value="@if( old('firstName') ) {{old('firstName')}} @elseif( isset($user) ) {{$user->firstName}} @endif" placeholder="Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                                    </div>
                                  </div>

                                  <div class="form-group" id="emailTitle">
                                      <div class="input-group input-icon right">
                                        <span class="input-group-addon">
                                          <i class="fa fa-envelope"></i>
                                        </span>
                                        <input name="email" id="email" type="text" class="form-control" value="@if( old('email') ) {{old('email')}} @elseif( isset($user) ) {{$user->email}} @endif" placeholder="Email..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                                    </div>
                                  </div>

                                  <div class="form-group" id="phoneNumberTitle">
                                      <div class="input-group input-icon right">
                                        <span class="input-group-addon">
                                          <i class="fa fa-phone"></i>
                                        </span>
                                        <input name="phoneNumber" id="phoneNumber" min="0" type="number" class="form-control" value="@if( old('phoneNumber') ) {{old('phoneNumber')}} @elseif( isset($user) ) {{$user->phoneNumber}} @endif" placeholder="Phone Number..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                                    </div>
                                  </div>

                                  <div class="form-group" id="amountDueTitle">
                                      <div class="input-group input-icon right">
                                        <span class="input-group-addon">
                                          <i class="fa fa-dollar"></i>
                                        </span>
                                        <input name="amountDue" id="amountDue" min="0" type="number" class="form-control" value="@if( old('amountDue') ) {{old('amountDue')}} @elseif( isset($user) ) {{$user->amountDue}} @endif" placeholder="Amount Owed..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                                    </div>
                                  </div>

                                  <div class="form-group" id="amountPaidTitle">
                                      <div class="input-group input-icon right">
                                        <span class="input-group-addon">
                                          <i class="fa fa-dollar"></i>
                                        </span>
                                        <input name="amountPaid" id="amountPaid" min="0" type="number" class="form-control" value="@if( old('amountPaid') ) {{old('amountPaid')}} @elseif( isset($user) ) {{$user->amountPaid}} @endif" placeholder="Amount Paid..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                                    </div>
                                  </div>

                                <div class="form-group">
                                  <select id="paymentMethod">
                                    <option value="1">Paid by cash</option>
                                    <option value="2">Paid by cheque</option>
                                    <option value="3">Paid by bank transfer</option>
                                    <option value="4">MPESA</option>
                                  </select>
                                  <input id="deptID" type="hidden" name="deptID" value="@if( isset($dept) ) {{$dept->id}} @endif">
                                </div>
                                <div class="form-group">
                                  <button type="button" class="btn btn-default btn-sm" name="button" onclick="create_purchase()">Add</button>
                                </div>
                                </form>
                              </div>
      											</div>
                            <div class="form-group">
                              <button type="button" class="btn btn-warning btn-sm" name="button" onclick="toggleElements('search-supplier-form-container','purchase-create-supplier-form-container')">Search supplier from records instead <i class="fa fa-database"></i></button>
                            </div>
      										 </div>
      								</div>
      							 <div class="clearfix"> </div>
      				</div>
      				<!--end supplier-->

              <!--supplier table-->
              <!-- tables -->

              <div class="agile-tables">

              <div class="w3l-table-info agile_info_shadow">
                <table   class="two-axis">
                <thead>
                  <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Amount Owed</th>
                  <th>Amount Paid</th>
                  <th>Payment Method</th>
                  </tr>
                </thead>
                <tbody id="table-supplier-info">

                  @if( isset($purchase) )
                  <tr>
                  <td>{{$purchase->user->firstName}} {{$purchase->user->lastName}}</td>
                  <td>{{$purchase->user->email}}</td>
                  <td>{{$purchase->user->phoneNumber}}</td>
                  <td class="text-info cursor" id="supplier-{{$purchase->user->id}}-amount-due" onclick="update_amount_due({{$purchase->id}},this.id,'amountDue')">{{$purchase->amountDue}}</td>
                  <td class="text-info cursor" id="supplier-{{$purchase->user->id}}-amount-paid" onclick="update_amount_due({{$purchase->id}},this.id,'amountPaid')">{{$purchase->amountPaid}}</td>
                  <td>
                    <select id="supplier-{{$purchase->id}}-payment-method" onchange="update_amount_due({{$purchase->id}},this.value,'paymentMethod')">
                      <option value="0" disabled>select one</option>
                      <option value="1" @if( $purchase->paymentMethod ==1 ) selected @endif>Paid by cash</option>
                      <option value="2" @if( $purchase->paymentMethod ==2 ) selected @endif>Paid by cheque</option>
                      <option value="3" @if( $purchase->paymentMethod ==3 ) selected @endif>Paid by bank transfer</option>
                      <option value="4" @if( $purchase->paymentMethod ==4 ) selected @endif>MPESA</option>
                    </select>
                  </td>
                  </tr>
                  @endif

                </tbody>
                </table>


              </div>
           </div>
          <!-- //tables -->

              <!--end supplier table-->

              <!--/start goods-->
              <div class="set-1_w3ls">
                  <div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
                   <h3 class="w3_inner_tittle two">Goods supplied  </h3>

                   <div id="purchases-search-product-form-container">

                     <div class="input-group search-box">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                      <div class="loading hidden d-none">
                        <img src="{{url('images/search-loading.gif')}}" alt="" height="10" width="50">
                      </div>
                      <input id="search-product-box"  type="text" class="form-control" name="search" placeholder="Search by name...">
                     </div>

                     <div id="product-results-box" class="search-box-results border-1 hidden d-none">

                     </div>

                     <div class="form-group">
                       <button type="button" class="btn btn-warning btn-sm" name="button" onclick="toggleElements('purchases-create-product-form-container','purchases-search-product-form-container')">Create new product record instead <i class="fa fa-database"></i></button>
                     </div>

                   </div>


                        <div class="grid-1 d-none hidden" id="purchases-create-product-form-container">
                          <div class="form-body">
                            <div data-example-id="simple-form-inline">
                              <form class="form-inline">
                                <div class="form-group" id="skuTitle">
                                    <div class="input-group input-icon right">
                                      <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                      </span>
                                      <input name="sku" id="sku"  type="text" class="form-control" value="@if( old('sku') ) {{old('sku')}} @elseif( isset($user) ) {{$user->sku}} @endif" placeholder="SKU..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                                  </div>
                                </div>
                                <div class="form-group" id="prodNameTitle">
                                    <div class="input-group input-icon right">
                                      <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                      </span>
                                      <input name="prodName" id="prodName"  type="text" class="form-control" value="@if( old('prodName') ) {{old('prodName')}} @elseif( isset($user) ) {{$user->prodName}} @endif" placeholder="Product Name..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                                  </div>
                                </div>
                                <div class="form-group" id="quantityTitle">
                                    <div class="input-group input-icon right">
                                      <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                      </span>
                                      <input name="quantity" id="quantity" min="0"  type="number" class="form-control" value="@if( old('quantity') ) {{old('quantity')}} @elseif( isset($user) ) {{$user->quantity}} @endif" placeholder="Product Quantity..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                                  </div>
                                </div>
                                <div class="form-group" id="costTitle">
                                    <div class="input-group input-icon right">
                                      <span class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                      </span>
                                      <input name="cost" id="cost" min="0"  type="number" class="form-control" value="@if( old('cost') ) {{old('cost')}} @elseif( isset($user) ) {{$user->cost}} @endif" placeholder="Product cost..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" />
                                  </div>
                                </div>

                              <div class="form-group">
                                <button type="button" class="btn btn-default btn-sm" name="button" onclick="create_products()">Add</button>
                              </div>
                              </form>
                            </div>
                          </div>
                          <div class="form-group">
                            <button type="button" class="btn btn-warning btn-sm" name="button" onclick="toggleElements('purchases-search-product-form-container','purchases-create-product-form-container')">Search product from records instead <i class="fa fa-database"></i></button>
                          </div>
                         </div>
                    </div>
                   <div class="clearfix"> </div>
            </div>
            <!--end goods-->

            <!--goods table-->
            <!-- tables -->

            <div class="agile-tables">

            <div class="w3l-table-info agile_info_shadow">
              <table  class="two-axis">
                <input id="purchasesID" type="hidden" name="purchasesID" value="@if( isset($purchase) ) {{$purchase->id}} @endif">
								<input type="hidden" id="currentDeptID" name="currentDeptID" value="@if( isset($dept) ) {{$dept->id}} @endif">
              <thead>
                <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Quantity supplied</th>
                <th>Cost</th>
                </tr>
              </thead>
              <tbody id="purchases-table">

                @if( isset($purchase) )
                  @foreach( $purchase->expense as $expense )
                  <tr id="purchases-table-product-{{$expense->product->id}}">
                  <td>{{$expense->product->sku}}</td>
                  <td>{{$expense->product->name}}</td>
                  <td data-prod="{{$expense->product->id}}" class="text-info cursor" id="product-{{$expense->product->id}}" onclick="update_product_quantity({{$purchase->id}},this.id,'suppliedQuantity')">{{$expense->suppliedQuantity}}</td>
                  <td data-prod="{{$expense->product->id}}" class="text-info cursor" id="product-cost-{{$expense->product->id}}" onclick="update_product_quantity({{$purchase->id}},this.id,'cost')">{{$expense->cost}}</td>
                  </tr>
                  @endforeach
                @endif

              </tbody>
              </table>


            </div>
         </div>
        <!-- //tables -->

            <!--end goods table-->
            <div class="button" onclick="save_purchases()">
             <p class="btnText">Update?</p>
             <div class="btnTwo" style="background:green">
               <p class="btnText2" >GO!</p>
             </div>
            </div>

            <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
             <p class="btnText">Delete?</p>
             <div class="btnTwo">
               <p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
             </div>
            </div>
              </div>
              <!--purchase reg form-->

						</div>


				</div>
		<!-- //inner_content-->
</div>
@component( 'components.delete-confirm-modal',[ 'formId' => 'deletePurchaseForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

@endcomponent

<form class="d-none hidden" id="deletePurchaseForm" action="{{route('purchases-registration.destroy',$purchase->id)}}" method="post">
  @csrf
  @method('DELETE')
</form>
@endsection
