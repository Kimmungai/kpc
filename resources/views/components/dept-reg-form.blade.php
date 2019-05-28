<div class="form-group">
  <label class="col-md-2 control-label">Organisation</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-building"></i>
      </span>
      <select name="org_id" id="org_id" class="form-control1">
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
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Department type</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-layer-group"></i>
      </span>
      <select name="type" id="type" class="form-control1">
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
</div>

<div class="form-group" id="avatarTitle">
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
</div>

<div class="form-group" id="nameTitle">
  <label class="col-md-2 control-label">Name</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-image"></i>
      </span>
      <input name="name" id="name" type="text" class="form-control1" value="@if( old('name') ) {{old('name')}} @elseif( isset($dept) ) {{$dept->name}} @endif" placeholder="Dept Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
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

<!--<div class="form-group">
<label for="selector1" class="col-sm-2 control-label">Department type <span class="red-text">*</span></label>
<div class="col-sm-8">
<select name="type" id="type" class="form-control1">
<option value="1" @if( old('type') == 1 || ( isset($dept) && $dept->type == 1 ) ) selected @endif>Type 1</option>
<option value="2" @if( old('type') == 2 || ( isset($dept) && $dept->type == 2 ) ) selected @endif>Type 2</option>
<option value="3" @if( old('type') == 3 || ( isset($dept) && $dept->type == 3 ) ) selected @endif>Type 3</option>

</select>
@if ($errors->has('type'))
<span  role="alert" class="red-text">
    <strong>{{ $errors->first('type') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Picture</label>
<div class="col-sm-8">
<img src="@if( isset($dept) ){{$dept->avatar}} @endif" alt="@if( isset($dept) ){{$dept->name}} @endif" class="img-thumbnail" height="50px" width="50px">
<input name="avatar" id="avatar" type="file"  onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)" />
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="avatarHelper">
  @if ($errors->has('avatar'))
    <span class="red-text" role="alert">
        <strong>{{ $errors->first('avatar') }}</strong>
    </span>
@endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Name <span class="red-text">*</span></label>
<div class="col-sm-8">
<input name="name" id="name" type="text" class="form-control1" value="@if( old('name') ) {{old('name')}} @elseif( isset($dept) ) {{$dept->name}} @endif" placeholder="Dept Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="nameHelper">
  @if ($errors->has('name'))
      <span  role="alert">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Location</label>
<div class="col-sm-8">
<input name="address" id="address" type="text" class="form-control" value="@if( old('address') ) {{old('address')}} @elseif( isset($dept) ) {{$dept->address}} @endif" placeholder="Address..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="addressHelper">
  @if ($errors->has('address'))
      <span  role="alert">
          <strong>{{ $errors->first('address') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Details</label>
<div class="col-sm-8">
<textarea name="deptDetails" id="deptDetails" class="form-control"  placeholder="Type any details about this department..." onblur="validate(this.id,{required:0,min:3},this.value)" rows="5">@if( old('deptDetails') ) {{old('deptDetails')}} @elseif( isset($dept) ) {{$dept->deptDetails}} @endif</textarea>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="deptDetailsHelper">
  @if ($errors->has('deptDetails'))
      <span  role="alert">
          <strong>{{ $errors->first('deptDetails') }}</strong>
      </span>
  @endif
</p>
</div>
</div>-->
