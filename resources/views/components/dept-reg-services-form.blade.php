<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">
    <h3>Products details</h3>
    <input type="hidden" name="org_id" value="1">


    <div class="form-group" id="nameTitle">
      <label class="col-md-2 control-label">Has rooms? </label>
      <div class="col-md-8">
          Yes <input name="has_rooms" id="has_rooms" type="radio" class="" value="@if( old('has_rooms') ) {{old('has_rooms')}} @elseif( isset($dept) ) {{$dept->has_rooms}} @endif"  />
          No <input name="has_rooms" id="has_rooms" type="radio" class="" value="@if( old('has_rooms') ) {{old('has_rooms')}} @elseif( isset($dept) ) {{$dept->has_rooms}} @endif"  checked/>
      </div>

    </div>

    <div class="form-group" id="deptRoomTypeTitle">
      <label class="col-md-2 control-label">Type of room</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-bed"></i>
          </span>
          <input name="deptRoomType" id="deptRoomType" type="text" class="form-control" value="@if( old('deptRoomType') ) {{old('deptRoomType')}} @elseif( isset($dept) ) {{$dept->deptRoomType}} @endif" placeholder="e.g Standard, Delux, etc." onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptRoomTypeHelper">
          @if ($errors->has('deptRoomType'))
            {{ $errors->first('deptRoomType') }}
          @endif
        </p>
      </div>
    </div>


    <div class="form-group" id="deptRoomPriceTitle">
      <label class="col-md-2 control-label">Room price</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info"></i>
          </span>
          <input name="deptRoomPriceType" id="deptRoomPriceType" type="text" class="form-control" value="@if( old('deptRoomPriceType') ) {{old('deptRoomPriceType')}} @elseif( isset($dept) ) {{$dept->deptRoomPriceType}} @endif" placeholder="Price customers will pay" onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptRoomPriceHelper">
          @if ($errors->has('deptRoomPrice'))
            {{ $errors->first('deptRoomPrice') }}
          @endif
        </p>
      </div>
    </div>

    <a href="#" class="btn btn-default btn-sm">Add room type</a>

    <div class="form-group mt-2" id="nameTitle">
      <label class="col-md-2 control-label">Has products? </label>
      <div class="col-md-8">
          Yes <input name="has_products" id="has_products" type="radio" class="" value="@if( old('has_products') ) {{old('has_products')}} @elseif( isset($dept) ) {{$dept->has_products}} @endif"  />
          No <input name="has_products" id="has_products" type="radio" class="" value="@if( old('has_products') ) {{old('has_products')}} @elseif( isset($dept) ) {{$dept->has_products}} @endif"  checked/>
      </div>

    </div>

    <div class="form-group" id="deptProductNameTitle">
      <label class="col-md-2 control-label">Product name</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info"></i>
          </span>
          <input name="deptProductName" id="deptProductName" type="text" class="form-control" value="@if( old('deptProductName') ) {{old('deptProductName')}} @elseif( isset($dept) ) {{$dept->deptProductName}} @endif" placeholder="e.g Standard, Delux, etc." onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptProductNameHelper">
          @if ($errors->has('deptProductName'))
            {{ $errors->first('deptProductName') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="deptProductCostTitle">
      <label class="col-md-2 control-label">Product cost</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info"></i>
          </span>
          <input name="deptProductCostType" id="deptProductCostType" type="text" class="form-control" value="@if( old('deptProductCostType') ) {{old('deptProductCostType')}} @elseif( isset($dept) ) {{$dept->deptProductCostType}} @endif" placeholder="Price customers will pay" onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptProductCostHelper">
          @if ($errors->has('deptProductCost'))
            {{ $errors->first('deptProductCost') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="deptProductPriceTitle">
      <label class="col-md-2 control-label">Product price</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info"></i>
          </span>
          <input name="deptProductPriceType" id="deptProductPriceType" type="text" class="form-control" value="@if( old('deptProductPriceType') ) {{old('deptProductPriceType')}} @elseif( isset($dept) ) {{$dept->deptProductPriceType}} @endif" placeholder="Price customers will pay" onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptProductPriceHelper">
          @if ($errors->has('deptProductPrice'))
            {{ $errors->first('deptProductPrice') }}
          @endif
        </p>
      </div>
    </div>

    <a href="#" class="btn btn-default btn-sm ">Add product</a>













  </div>
</div>

<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">
    <h3>Costs details</h3>
    <div class="form-group" id="targetCostsTitle">
      <label class="col-md-4 control-label">Target Costs <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-money-bill-wave"></i>
          </span>
          <input name="targetCosts" id="targetCosts" type="text" class="form-control" value="@if( old('targetCosts') ) {{old('targetCosts')}} @elseif( isset($dept) ) {{$dept->targetCosts}} @endif" placeholder="Dept target costs..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="targetCostsHelper">
          @if ($errors->has('targetCosts'))
            {{ $errors->first('targetCosts') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="targetRevenuesTitle">
      <label class="col-md-4 control-label">Target revenue <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-cash-register"></i>
          </span>
          <input name="targetRevenues" id="targetRevenues" type="text" class="form-control" value="@if( old('targetRevenues') ) {{old('targetRevenues')}} @elseif( isset($dept) ) {{$dept->targetRevenues}} @endif" placeholder="Dept target revenue..." onblur="validate(this.id,{required:1,min:0,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="targetRevenuesHelper">
          @if ($errors->has('targetRevenues'))
            {{ $errors->first('targetRevenues') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="bookingCapacityTitle">
      <label class="col-md-4 control-label">Booking capacity <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-info"></i>
          </span>
          <input name="bookingCapacity" id="bookingCapacity" type="text" class="form-control" value="@if( old('bookingCapacity') ) {{old('bookingCapacity')}} @elseif( isset($dept) ) {{$dept->bookingCapacity}} @endif" placeholder="Dept booking capacity..." onblur="validate(this.id,{required:1,min:0,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="bookingCapacityHelper">
          @if ($errors->has('bookingCapacity'))
            {{ $errors->first('bookingCapacity') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="stockCapacityTitle">
      <label class="col-md-4 control-label">Stock capacity <span class="text-danger">*</span></label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-user-tie"></i>
          </span>
          <input name="stockCapacity" id="stockCapacity" type="text" class="form-control" value="@if( old('stockCapacity') ) {{old('stockCapacity')}} @elseif( isset($dept) ) {{$dept->stockCapacity}} @endif" placeholder="Dept staff and workers capacity..." onblur="validate(this.id,{required:1,min:0,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="stockCapacityHelper">
          @if ($errors->has('stockCapacity'))
            {{ $errors->first('stockCapacity') }}
          @endif
        </p>
      </div>
    </div>



  </div>
</div>
