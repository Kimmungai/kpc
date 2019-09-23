<!--<div class="form-group">
  <label class="col-md-2 control-label">Organisation</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-building"></i>
      </span>
      <select name="org_id" id="org_id" class="form-control">
        <option value="1" @if( old('org_id') == 1 || ( isset($user) && $user->org_id == 1 ) ) selected @endif> Kitui Pastoral center </option>
      </select>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text">
      @if ($errors->has('org_id'))
        {{ $errors->first('org_id') }}
      @endif
    </p>
  </div>
</div>-->

<input type="hidden" name="org_id" value="1">

<!--<div class="form-group">
  <label class="col-md-2 control-label">Department type</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-layer-group"></i>
      </span>
      <select name="type" id="type" class="form-control">
      <option value="1" @if( old('type') == 1 || ( isset($dept) && $dept->type == 1 ) ) selected @endif>Type 1</option>
      <option value="2" @if( old('type') == 2 || ( isset($dept) && $dept->type == 2 ) ) selected @endif>Type 2</option>
      <option value="3" @if( old('type') == 3 || ( isset($dept) && $dept->type == 3 ) ) selected @endif>Type 3</option>

      </select>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text">
      @if ($errors->has('type'))
        {{ $errors->first('type') }}
      @endif
    </p>
  </div>
</div>-->

<!--<div class="form-group" id="avatarTitle">
  <label class="col-md-2 control-label">Picture</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-image"></i>
      </span>
      <img src="@if( isset($dept) ){{$dept->avatar}} @endif" alt="@if( isset($dept) ){{$dept->name}} @endif" class="img-thumbnail" height="50px" width="50px">
      <input name="avatar" id="avatar" type="file"  onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)" />
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="avatarHelper">
      @if ($errors->has('avatar'))
        {{ $errors->first('avatar') }}
      @endif
    </p>
  </div>
</div>-->

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

<div class="form-group" id="targetCostsTitle">
  <label class="col-md-2 control-label">Target Costs <span class="text-danger">*</span></label>
  <div class="col-md-8">
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
  <label class="col-md-2 control-label">Target revenue <span class="text-danger">*</span></label>
  <div class="col-md-8">
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
  <label class="col-md-2 control-label">Booking capacity <span class="text-danger">*</span></label>
  <div class="col-md-8">
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
  <label class="col-md-2 control-label">Stock capacity <span class="text-danger">*</span></label>
  <div class="col-md-8">
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
  <label class="col-md-2 control-label">Address</label>
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
