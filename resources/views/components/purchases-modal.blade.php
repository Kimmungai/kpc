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
							 <h3 class="w3_inner_tittle two">Supplier  </h3>
										<div class="grid-1">
											<div class="form-body">
												<div data-example-id="simple-form-inline">
                          <form class="form-inline">
                          <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Name" onblur="validate(this.id,{required:1,min:3,max:255},this.value)">
                          </div>
                          <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputPassword3" placeholder="Email" onblur="validate(this.id,{required:1,min:3,max:255,type:'email'},this.value)">
                          </div>
                          <div class="form-group">
                            <input type="number" min="0" class="form-control" id="exampleInputEmail3" placeholder="Phone Number">
                          </div>
                          <div class="form-group">
                            <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Amount Payable">
                          </div>
                          <div class="form-group">
                            <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Amount Paid">
                          </div>
                          <div class="form-group">
                            <select >
                              <option>Paid by cash</option>
                              <option>Paid by cheque</option>
                              <option>Paid by bank transfer</option>
                            </select>
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
                        <div class="form-group">
                          <input type="text" class="form-control" name="sku" placeholder="SKU"  >
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control"  placeholder="Name">
                        </div>
                        <div class="form-group">
                          <input type="number" class="form-control"  placeholder="Quantity">
                        </div>
                        <div class="form-group">
                          <input type="number" class="form-control"  placeholder="Cost">
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
