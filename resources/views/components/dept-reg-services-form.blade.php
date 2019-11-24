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

    <button type="button" class="btn btn-default btn-xs">Add room type</button>

    <!--<div class="form-group mt-2" id="nameTitle">
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

    <a href="#" class="btn btn-default btn-sm ">Add product</a>-->













  </div>
</div>

<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">
    <h3>Services details</h3>
    <div class="form-group" id="nameOfServiceTitle">
      <label class="col-md-4 control-label">Name of service</label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-info"></i>
          </span>
          <input name="nameOfService" id="nameOfService" type="text" class="form-control" value="@if( old('nameOfService') ) {{old('nameOfService')}} @elseif( isset($dept) ) {{$dept->nameOfService}} @endif" placeholder="Dept target costs..." />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="nameOfServiceHelper">
          @if ($errors->has('nameOfService'))
            {{ $errors->first('nameOfService') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="costOfServiceTitle">
      <label class="col-md-4 control-label">Cost of service</label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-info"></i>
          </span>
          <input name="costOfService" id="costOfService" type="number" class="form-control numeric" value="@if( old('costOfService') ) {{old('costOfService')}} @elseif( isset($dept) ) {{$dept->costOfService}} @endif" placeholder="Numbers only"  />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="costOfServiceHelper">
          @if ($errors->has('costOfService'))
            {{ $errors->first('costOfService') }}
          @endif
        </p>
      </div>
    </div>

    <button type="button" class="btn btn-default btn-xs" onclick="dept_add_service(@if(isset($dept)) {{$dept->id}} @endif)">Add service</button>

    <!--list of added services-->
    <ul id="services-list" class="list-inline added-rooms-list">
      @if( isset($dept) )
        @if( $dept->DeptServices )
          @foreach( $dept->DeptServices as $service )
            <li> <span class="fa fa-times-circle" onclick="dept_remove_list(this,{{$service->id}})"></span> <span>{{$service->service}}</span> <small> at KES {{$service->cost}}</small></li>
          @endforeach
        @endif
      @endif
    </ul>


  </div>
</div>
