<!-- Purchases Modal -->
  <div class="modal fade" id="recordTransfersModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record a transfer</h4>
        </div>
        <div class="modal-body">
          <!--/start transfer images-->
          <div class="row">
            <div class="col-xs-4">
              <div class="agile_top_w3_grids">
                  <ul class="ca-menu">
                    <li>
                     <a href="#">
                       <i class="fa fa-building" aria-hidden="true"></i>
                       <div class="ca-content">
                         <h4 class="ca-main one">From</h4>
                         <h3 class="ca-sub one">{{$dept->name}}</h3>
                       </div>
                     </a>
                   </li>
                  </ul>
              </div>
            </div>
            <div class="col-xs-4">
              <h4 class="text-center">Transfer</h4>
              <p class="text-center text-success" style="font-size:50px;"><i class="fas fa-long-arrow-alt-right"></i></p>
              <p>
                <select name="allDepts" id="allDepts" class="form-control1" onchange="select_dept(this.value)">
                  @if(strtolower($dept->name) != 'kitchen')<option>Kitchen</option>@endif
                  @if(strtolower($dept->name) != 'store')<option>Store</option>@endif
                  @if(strtolower($dept->name) != 'hospitality')<option>Hospitality</option>@endif
                  @if(strtolower($dept->name) != 'chapel')<option>Chapel</option>@endif
                  @if(strtolower($dept->name) != 'shamba')<option>Shamba/ dairy/ poultry</option>@endif
                  @if(strtolower($dept->name) != 'compound')<option>Compound</option>@endif
                  @if(strtolower($dept->name) != 'administration')<option>Administration</option>@endif
                </select>
              </p>
            </div>
            <div class="col-xs-4">
              <div class="agile_top_w3_grids">
                  <ul class="ca-menu">
                    <li id="destinationDept">
                     <a href="#">
                       <i class="fa fa-building" aria-hidden="true"></i>
                       <div class="ca-content">
                         <h4 class="ca-main">To</h4>
                         <h3 class="ca-sub"></h3>
                       </div>
                     </a>
                   </li>
                  </ul>
              </div>
            </div>
          </div>


				<!--end transfer images-->

        <!--/start goods-->
        <div class="set-1_w3ls">
            <div class="col-md-6 button_set_one two agile_info_shadow grapha-aform" style="width:100%">
             <h3 class="w3_inner_tittle two">Goods to transfer  </h3>

             <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
              <input  type="text" class="form-control" name="search" placeholder="Search from records">
            </div>

                  <div class="grid-1">
                    <div class="form-body">
                      <div data-example-id="simple-form-inline">
                        <form class="form-inline">
                          <div class="form-group" id="skuTransferTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-info"></i>
                                </span>
                                <input name="skuTransfer" id="skuTransfer"  type="text" class="form-control1" value="@if( old('skuTransfer') ) {{old('skuTransfer')}} @elseif( isset($user) ) {{$user->skuTransfer}} @endif" placeholder="SKU..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                          <div class="form-group" id="prodTransferNameTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-info"></i>
                                </span>
                                <input name="prodTransferName" id="prodTransferName"  type="text" class="form-control1" value="@if( old('prodTransferName') ) {{old('prodTransferName')}} @elseif( isset($user) ) {{$user->prodTransferName}} @endif" placeholder="Product Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                          <div class="form-group" id="quantityTransferTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-info"></i>
                                </span>
                                <input name="quantityTransfer" id="quantityTransfer" min="0"  type="number" class="form-control1" value="@if( old('quantityTransfer') ) {{old('quantityTransfer')}} @elseif( isset($user) ) {{$user->quantityTransfer}} @endif" placeholder="Product quantity..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
                            </div>
                          </div>
                          <div class="form-group" id="costTransferTitle">
                              <div class="input-group input-icon right">
                                <span class="input-group-addon">
                                  <i class="fa fa-dollar"></i>
                                </span>
                                <input name="costTransfer" id="costTransfer" min="0"  type="number" class="form-control1" value="@if( old('costTransfer') ) {{old('costTransfer')}} @elseif( isset($user) ) {{$user->costTransfer}} @endif" placeholder="Product cost..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
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
          <th>skuTransfer</th>
          <th>Name</th>
          <th>quantityTransfer</th>
          <th>costTransfer</th>
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