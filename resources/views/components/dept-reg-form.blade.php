<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">
    <h3>Basic details</h3>
    <input type="hidden" name="org_id" value="1">


    <div class="form-group" id="nameTitle">
      <label class="col-md-2 control-label">Name <span class="text-danger">*</span></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info"></i>
          </span>
          <input name="name" id="name" type="text" class="form-control" value="@if( old('name') ) {{old('name')}} @elseif( isset($dept) ) {{$dept->name}} @endif" placeholder="Dept Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="nameHelper">
          @if ($errors->has('name'))
            {{ $errors->first('name') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="addressTitle">
      <label class="col-md-2 control-label">Address</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-map-marker"></i>
          </span>
          <input name="address" id="address" type="text" class="form-control" value="@if( old('address') ) {{old('address')}} @elseif( isset($dept) ) {{$dept->address}} @endif" placeholder="Address..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="addressHelper">
          @if ($errors->has('address'))
            {{ $errors->first('address') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="deptDetailsTitle">
      <label class="col-md-2 control-label">Details</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info"></i>
          </span>
          <textarea name="deptDetails" id="deptDetails" class="form-control"  placeholder="Type any details about this department..." onblur="validate(this.id,{required:0,min:3},this.value)" rows="5">@if( old('deptDetails') ) {{old('deptDetails')}} @elseif( isset($dept) ) {{$dept->deptDetails}} @endif</textarea>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="deptDetailsHelper">
          @if ($errors->has('deptDetails'))
            {{ $errors->first('deptDetails') }}
          @endif
        </p>
      </div>
    </div>









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

    <button type="button" class="btn btn-default btn-xs" onclick="dept_add_service()">Add service</button>

    <!--list of added services-->
    <ul id="services-list" class="list-inline added-rooms-list">

    </ul>
    <input id="service_name_hidden" type="text" name="service_name[]" value="">
    <input id="service_cost_hidden" type="text" name="service_cost[]" value="">

  </div>
</div>
