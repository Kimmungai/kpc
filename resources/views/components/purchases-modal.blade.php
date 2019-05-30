<!-- Purchases Modal -->
  <div class="modal fade" id="recordPurchasesModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record a purchase</h4>
        </div>
        <div class="modal-body">
          <!--/start supplier-->
					<div class="set-1_w3ls">
							<div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
							 <h3 class="w3_inner_tittle two">Supplier</h3>
                 <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                  <input  type="text" class="form-control" name="search" placeholder="Search from records">
                 </div>
										<div class="grid-1">
											<div class="form-body">
												<div data-example-id="simple-form-inline">
                          <form class="form-inline">

                            <div class="form-group" id="firstNameTitle">
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                  </span>
                                  <input name="firstName" id="firstName" type="text" class="form-control1" value="@if( old('firstName') ) {{old('firstName')}} @elseif( isset($user) ) {{$user->firstName}} @endif" placeholder="Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                              </div>
                            </div>

                            <div class="form-group" id="emailTitle">
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                  </span>
                                  <input name="email" id="email" type="text" class="form-control1" value="@if( old('email') ) {{old('email')}} @elseif( isset($user) ) {{$user->email}} @endif" placeholder="Email..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                              </div>
                            </div>

                            <div class="form-group" id="phoneNumberTitle">
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </span>
                                  <input name="phoneNumber" id="phoneNumber" min="0" type="number" class="form-control1" value="@if( old('phoneNumber') ) {{old('phoneNumber')}} @elseif( isset($user) ) {{$user->phoneNumber}} @endif" placeholder="Phone Number..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                              </div>
                            </div>

                            <div class="form-group" id="amountDueTitle">
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                  </span>
                                  <input name="amountDue" id="amountDue" min="0" type="number" class="form-control1" value="@if( old('amountDue') ) {{old('amountDue')}} @elseif( isset($user) ) {{$user->amountDue}} @endif" placeholder="Amount Owed..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                              </div>
                            </div>

                            <div class="form-group" id="amountPaidTitle">
                                <div class="input-group input-icon right">
                                  <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                  </span>
                                  <input name="amountPaid" id="amountPaid" min="0" type="number" class="form-control1" value="@if( old('amountPaid') ) {{old('amountPaid')}} @elseif( isset($user) ) {{$user->amountPaid}} @endif" placeholder="Amount Paid..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                              </div>
                            </div>

                          <div class="form-group">
                            <select >
                              <option>Paid by cash</option>
                              <option>Paid by cheque</option>
                              <option>Paid by bank transfer</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <button type="button" class="btn btn-default btn-sm" name="button">Add</button>
                          </div>
                          </form>
                        </div>
											</div>
										 </div>
								</div>
							 <div class="clearfix"> </div>
				</div>
				<!--end supplier-->

        <!--/start goods-->
        <div class="set-1_w3ls">
            <div class="col-md-6 button_set_one two agile_info_shadow graph-form" style="width:100%">
             <h3 class="w3_inner_tittle two">Goods supplied  </h3>

             <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
              <input  type="text" class="form-control" name="search" placeholder="Search from records">
            </div>

                  <div class="grid-1">
                    <div class="form-body">
                      <div data-example-id="simple-form-inline">
                        <form class="form-inline">
                          <div class="form-group" id="skuTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-info"></i>
                                </span>
                                <input name="sku" id="sku"  type="text" class="form-control1" value="@if( old('sku') ) {{old('sku')}} @elseif( isset($user) ) {{$user->sku}} @endif" placeholder="SKU..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                          <div class="form-group" id="prodNameTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-info"></i>
                                </span>
                                <input name="prodName" id="prodName"  type="text" class="form-control1" value="@if( old('prodName') ) {{old('prodName')}} @elseif( isset($user) ) {{$user->prodName}} @endif" placeholder="Product Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                          <div class="form-group" id="quantityTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-info"></i>
                                </span>
                                <input name="quantity" id="quantity" min="0"  type="number" class="form-control1" value="@if( old('quantity') ) {{old('quantity')}} @elseif( isset($user) ) {{$user->quantity}} @endif" placeholder="Product Quantity..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                          <div class="form-group" id="costTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-dollar"></i>
                                </span>
                                <input name="cost" id="cost" min="0"  type="number" class="form-control1" value="@if( old('cost') ) {{old('cost')}} @elseif( isset($user) ) {{$user->cost}} @endif" placeholder="Product cost..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                      
                        <div class="form-group">
                          <button type="button" class="btn btn-default btn-sm" name="button">Add</button>
                        </div>
                        </form>
                      </div>
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
        <table id="table-two-axis" class="two-axis">
        <thead>
          <tr>
          <th>SKU</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Cost</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>Jill Smith</td>
						<td>25</td>
						<td>Female</td>
						<td>5'4</td>
          </tr>

        </tbody>
        </table>


      </div>
   </div>
  <!-- //tables -->

      <!--end goods table-->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success btn-lg" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
