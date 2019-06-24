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
                         <input type="hidden" id="transferFromDept" value="{{$dept->id}}">
                       </div>
                     </a>
                   </li>
                  </ul>
              </div>
            </div>
            <div class="col-xs-4 allDepts">
              <h4 class="text-center">Transfer</h4>
              <p class="text-center text-success" style="font-size:50px;"><i class="fas fa-long-arrow-alt-right"></i></p>
              <p>
                <select name="allDepts" id="allDepts" class="form-control" onchange="select_dept(this.value)">
                  <option disabled selected>destination dept</option>
                  @foreach( $allDepts as $singleDept )
                    <?php if( $singleDept->id == $dept->id ){continue;} ?>
                    <option> {{$singleDept->name}} </option>
                  @endforeach
                  <!--@if(strtolower($dept->name) != 'kitchen')<option>Kitchen</option>@endif
                  @if(strtolower($dept->name) != 'store')<option>Store</option>@endif
                  @if(strtolower($dept->name) != 'hospitality')<option>Hospitality</option>@endif
                  @if(strtolower($dept->name) != 'chapel')<option>Chapel</option>@endif
                  @if(strtolower($dept->name) != 'shamba')<option>Shamba/ dairy/ poultry</option>@endif
                  @if(strtolower($dept->name) != 'compound')<option>Compound</option>@endif
                  @if(strtolower($dept->name) != 'administration')<option>Administration</option>@endif-->
                </select>
              </p>
            </div>
            <div class="col-xs-4 pl-0" >
              <div class="agile_top_w3_grids">
                  <ul class="ca-menu">
                    <li id="destinationDept">
                     <a href="#">
                       <i class="fa fa-building" aria-hidden="true"></i>
                       <div class="ca-content">
                         <h4 class="ca-main">To</h4>
                         <h3 class="ca-sub"></h3>
                         <input type="hidden" id="transferToDept" value="">
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
              <input id="search-transfer-product"  type="text" class="form-control search-box" name="search" placeholder="Search from records" onkeyup="std_search_product(this.id,this.value,'transfer-products-table')">
            </div>

            <div id="search-transfer-product-results" class="search-box-results border-1 hidden d-none">

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
          <th>sku</th>
          <th>Name</th>
          <th>Transfer quantity</th>
          <th>Unit cost</th>
          </tr>
        </thead>

        <tbody id="transfer-products-table">

        </tbody>

        </table>


      </div>
   </div>
  <!-- //tables -->

      <!--end goods table-->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success btn-lg" onclick="save_transfer()">Save</button>
        </div>
      </div>
    </div>
  </div>
