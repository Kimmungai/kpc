<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">
    <h3>Booking types</h3>
    <input type="hidden" name="org_id" value="1">




    <div class="form-group" id="deptBookingTypeTitle">
      <label class="col-md-4 control-label">Type of booking</label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-gift"></i>
          </span>
          <input name="deptBookingType" id="deptBookingType" type="text" class="form-control" value="@if( old('deptBookingType') ) {{old('deptBookingType')}} @elseif( isset($dept) ) {{$dept->deptBookingType}} @endif" placeholder="e.g Standard, Delux, etc." />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptBookingTypeHelper">
          @if ($errors->has('deptBookingType'))
            {{ $errors->first('deptBookingType') }}
          @endif
        </p>
      </div>
    </div>


    <div class="form-group" id="deptBookingTypePriceTitle">
      <label class="col-md-4 control-label">Price per person</label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-money-bill"></i>
          </span>
          <input name="deptBookingTypePrice" id="deptBookingTypePrice" type="text" class="form-control numeric" value="@if( old('deptBookingTypePrice') ) {{old('deptBookingTypePrice')}} @elseif( isset($dept) ) {{$dept->deptBookingTypePrice}} @endif" placeholder="Price customers will pay" />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptBookingTypePriceHelper">
          @if ($errors->has('deptBookingTypePrice'))
            {{ $errors->first('deptBookingTypePrice') }}
          @endif
        </p>
      </div>
    </div>

    <button type="button" class="btn btn-default btn-xs" onclick="dept_add_booking_type(@if(isset($dept)) {{$dept->id}} @endif)">Add booking type</button>

    <ul id="booking-type-list" class="list-inline added-rooms-list">

      @if( isset($dept) )
        @if( $dept->DeptBookingTypes )
          @foreach( $dept->DeptBookingTypes as $type )
            <li> <span class="fa fa-times-circle" onclick="dept_remove_booking_type_list(this,{{$type->id}})"></span> <span>{{$type->type}}</span> <small> at KES {{$type->price}}</small></li>
          @endforeach
        @endif
      @endif

    </ul>



  </div>
</div>

<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">
    <h3>Menu details</h3>
    <div class="form-group" id="nameOfMenuTitle">
      <label class="col-md-4 control-label">Menu type</label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-utensils"></i>
          </span>
          <input name="nameOfMenu" id="nameOfMenu" type="text" class="form-control" value="@if( old('nameOfMenu') ) {{old('nameOfMenu')}} @elseif( isset($dept) ) {{$dept->nameOfMenu}} @endif" placeholder="Dept target costs..." />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="nameOfMenuHelper">
          @if ($errors->has('nameOfMenu'))
            {{ $errors->first('nameOfMenu') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="costOfMenuTitle">
      <label class="col-md-4 control-label">Cost per person</label>
      <div class="col-md-6">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-money-bill"></i>
          </span>
          <input name="costOfMenu" id="costOfMenu" type="number" class="form-control numeric" value="@if( old('costOfMenu') ) {{old('costOfMenu')}} @elseif( isset($dept) ) {{$dept->costOfMenu}} @endif" placeholder="Numbers only"  />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="costOfMenuHelper">
          @if ($errors->has('costOfMenu'))
            {{ $errors->first('costOfMenu') }}
          @endif
        </p>
      </div>
    </div>

    <button type="button" class="btn btn-default btn-xs" onclick="dept_add_menu(@if(isset($dept)) {{$dept->id}} @endif)">Add menu</button>

    <!--list of added services-->
    <ul id="menu-list" class="list-inline added-rooms-list">
      @if( isset($dept) )
        @if( $dept->DeptMenu )
          @foreach( $dept->DeptMenu as $menu )
            <li> <span class="fa fa-times-circle" onclick="dept_remove_menu_list(this,{{$menu->id}})"></span> <span>{{$menu->name}}</span> <small> at KES {{$menu->price}}</small></li>
          @endforeach
        @endif
      @endif
    </ul>


  </div>
</div>
