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
  <label class="col-md-2 control-label">User type</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-user"></i>
      </span>
      <select name="type" id="type" class="form-control1">
        <option value="1" @if( old('type') == 1 || ( isset($user) && $user->type == 1 ) ) selected @endif>Staff</option>
        <option value="2" @if( old('type') == 2 || ( isset($user) && $user->type == 2 ) ) selected @endif>Customer</option>
        <option value="3" @if( old('type') == 3 || ( isset($user) && $user->type == 3 ) ) selected @endif>Administrator</option>
        <option value="4" @if( old('type') == 4 || ( isset($user) && $user->type == 4 ) ) selected @endif>Casuals</option>
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
      <img src="@if( isset($user) ){{$user->avatar}} @endif" alt="@if( isset($user) ){{$user->name}} @endif" class="img-thumbnail" height="50px" width="50px">
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

<div class="form-group" id="firstNameTitle">
  <label class="col-md-2 control-label">First Name</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-info"></i>
      </span>
      <input name="firstName" id="firstName" type="text" class="form-control1" value="@if( old('firstName') ) {{old('firstName')}} @elseif( isset($user) ) {{$user->firstName}} @endif" placeholder="First Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="firstNameHelper">
      @if ($errors->has('firstName'))
        {{ $errors->first('firstName') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="middleNameTitle">
  <label class="col-md-2 control-label">Middle Name</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-info"></i>
      </span>
      <input name="middleName" id="middleName" type="text" class="form-control1" value="@if( old('middleName') ) {{old('middleName')}} @elseif( isset($user) ) {{$user->middleName}} @endif" placeholder="Middle Name..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)" />
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="middleNameHelper">
      @if ($errors->has('middleName'))
        {{ $errors->first('middleName') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="lastNameTitle">
  <label class="col-md-2 control-label">Last Name</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-info"></i>
      </span>
      <input name="lastName" id="lastName" type="text" class="form-control1" value="@if( old('lastName') ) {{old('lastName')}} @elseif( isset($user) ) {{$user->lastName}} @endif" placeholder="Last name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="lastNameHelper">
      @if ($errors->has('lastName'))
        {{ $errors->first('lastName') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="DOBTitle">
  <label class="col-md-2 control-label">DOB</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-calendar-alt"></i>
      </span>
      <input name="DOB" id="DOB" type="text" class="form-control1" value="@if( old('DOB') ) {{old('DOB')}} @elseif( isset($user) ) {{$user->DOB}} @endif" placeholder="dd-mm-yyyy" onchange="validate(this.id,{required:1,min:3,max:255},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="DOBHelper">
      @if ($errors->has('DOB'))
        {{ $errors->first('DOB') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="emailTitle">
  <label class="col-md-2 control-label">Email</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-envelope"></i>
      </span>
      <input name="email" id="email" type="email" class="form-control1" value="@if( old('email') ) {{old('email')}} @elseif( isset($user) ) {{$user->email}} @endif" placeholder="Email..." onblur="validate(this.id,{required:1,min:3,max:255,type:'email'},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="emailHelper">
      @if ($errors->has('email'))
        {{ $errors->first('email') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="phoneNumberTitle">
  <label class="col-md-2 control-label">Phone Number</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-phone"></i>
      </span>
      <input name="phoneNumber" id="phoneNumber" type="text" class="form-control1" value="@if( old('phoneNumber') ) {{old('phoneNumber')}} @elseif( isset($user) ) {{$user->phoneNumber}} @endif" placeholder="Phone Number..." onblur="validate(this.id,{required:1,min:10,max:13,type:'numeric'},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="phoneNumberHelper">
      @if ($errors->has('phoneNumber'))
        {{ $errors->first('phoneNumber') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="genderTitle">
  <label class="col-md-2 control-label">Gender</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-circle-notch"></i>
      </span>
      <select name="gender" id="gender" class="form-control1">
      <option value="1" @if( old('gender') == 1 || ( isset($user) && $user->gender == 1 ) ) selected @endif>Male</option>
      <option value="2" @if( old('gender') == 2 || ( isset($user) && $user->gender == 2 ) ) selected @endif>Female</option>
      </select>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="genderHelper">
      @if ($errors->has('gender'))
        {{ $errors->first('gender') }}
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
      <input name="address" id="address" type="text" class="form-control" value="@if( old('address') ) {{old('address')}} @elseif( isset($user) ) {{$user->address}} @endif" placeholder="Address..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
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

<div class="form-group" id="idNoTitle">
  <label class="col-md-2 control-label">ID No</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-id-card"></i>
      </span>
      <input name="idNo" id="idNo" type="text" class="form-control" value="@if( old('idNo') ) {{old('idNo')}} @elseif( isset($user) ) {{$user->idNo}} @endif" placeholder="ID No..." onblur="validate(this.id,{required:0,min:5,max:10,type:'numeric'},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="idNoHelper">
      @if ($errors->has('idNo'))
        {{ $errors->first('idNo') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="idImageTitle">
  <label class="col-md-2 control-label">ID Scan</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-image"></i>
      </span>
      <img src="@if( isset($user) ){{$user->idImage}} @endif" alt="" class="img-thumbnail" height="50px" width="50px">
      <input name="idImage" id="idImage" type="file" value=""  onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="idImageHelper">
      @if ($errors->has('idImage'))
        {{ $errors->first('idImage') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="passportTitle">
  <label class="col-md-2 control-label">Passport</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-passport"></i>
      </span>
      <input name="passport" id="passport" type="text" class="form-control" value="@if( old('passport') ) {{old('passport')}} @elseif( isset($user) ) {{$user->passport}} @endif" placeholder="Passport No..." onblur="validate(this.id,{required:0,min:5,max:20},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="passportHelper">
      @if ($errors->has('passport'))
        {{ $errors->first('passport') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="passportImageTitle">
  <label class="col-md-2 control-label">Passport Scan</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-image"></i>
      </span>
      <img src="@if( isset($user) ){{$user->passportImage}} @endif" alt="@if( isset($user) ){{$user->name}} @endif" class="img-thumbnail" height="50px" width="50px">
      <input name="passportImage" id="passportImage" type="file"   onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="passportImageHelper">
      @if ($errors->has('passportImage'))
        {{ $errors->first('passportImage') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="passwordTitle">
  <label class="col-md-2 control-label">Password</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-key"></i>
      </span>
      <input name="password" id="password" type="text" class="form-control1" value="@if( old('password') ) {{old('password')}}  @endif" placeholder="Password..." onblur="validate(this.id,{required:1,min:8,max:255},this.value)" />
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="passwordHelper">
      @if ($errors->has('password'))
        {{ $errors->first('password') }}
      @endif
    </p>
  </div>
</div>

<!--<div class="form-group">
<label for="selector1" class="col-sm-2 control-label">Organisation<span class="red-text">*</span></label>
<div class="col-sm-8">
<select name="org_id" id="org_id" class="form-control1">
  <option value="1" @if( old('org_id') == 1 || ( isset($user) && $user->org_id == 1 ) ) selected @endif> Kitui Pastoral center </option>
</select>
@if ($errors->has('org_id'))
<span  role="alert" class="red-text">
    <strong>{{ $errors->first('org_id') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group">
<label for="selector1" class="col-sm-2 control-label">User type <span class="red-text">*</span></label>
<div class="col-sm-8">
<select name="type" id="type" class="form-control1">
<option value="1" @if( old('type') == 1 || ( isset($user) && $user->type == 1 ) ) selected @endif>Staff</option>
<option value="2" @if( old('type') == 2 || ( isset($user) && $user->type == 2 ) ) selected @endif>Customer</option>
<option value="3" @if( old('type') == 3 || ( isset($user) && $user->type == 3 ) ) selected @endif>Administrator</option>

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
<img src="@if( isset($user) ){{$user->avatar}} @endif" alt="@if( isset($user) ){{$user->name}} @endif" class="img-thumbnail" height="50px" width="50px">
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
<label for="focusedinput" class="col-sm-2 control-label">First Name <span class="red-text">*</span></label>
<div class="col-sm-8">
<input name="firstName" id="firstName" type="text" class="form-control1" value="@if( old('firstName') ) {{old('firstName')}} @elseif( isset($user) ) {{$user->firstName}} @endif" placeholder="First Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" />
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="firstNameHelper">
  @if ($errors->has('firstName'))
      <span  role="alert">
          <strong>{{ $errors->first('firstName') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Middle Name</label>
<div class="col-sm-8">
<input name="middleName" id="middleName" type="text" class="form-control1" value="@if( old('middleName') ) {{old('middleName')}} @elseif( isset($user) ) {{$user->middleName}} @endif" placeholder="Middle Name..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)" />
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="middleNameHelper">
  @if ($errors->has('middleName'))
        <span  role="alert">
            <strong>{{ $errors->first('middleName') }}</strong>
        </span>
    @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Last Name <span class="red-text">*</span></label>
<div class="col-sm-8">
<input name="lastName" id="lastName" type="text" class="form-control1" value="@if( old('lastName') ) {{old('lastName')}} @elseif( isset($user) ) {{$user->lastName}} @endif" placeholder="Last name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="lastNameHelper">
  @if ($errors->has('lastName'))
        <span  role="alert">
            <strong>{{ $errors->first('lastName') }}</strong>
        </span>
    @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">DOB<span class="red-text">*</span></label>
<div class="col-sm-8">
<input name="DOB" id="DOB" type="text" class="form-control1" value="@if( old('DOB') ) {{old('DOB')}} @elseif( isset($user) ) {{$user->DOB}} @endif" placeholder="dd-mm-yyyy" onchange="validate(this.id,{required:1,min:3,max:255},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="DOBHelper">
  @if ($errors->has('DOB'))
      <span  role="alert">
          <strong>{{ $errors->first('DOB') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Email <span class="red-text">*</span></label>
<div class="col-sm-8">
<input name="email" id="email" type="email" class="form-control1" value="@if( old('email') ) {{old('email')}} @elseif( isset($user) ) {{$user->email}} @endif" placeholder="Email..." onblur="validate(this.id,{required:1,min:3,max:255,type:'email'},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="emailHelper">
  @if ($errors->has('email'))
      <span  role="alert">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Phone Number <span class="red-text">*</span></label>
<div class="col-sm-8">
<input name="phoneNumber" id="phoneNumber" type="text" class="form-control1" value="@if( old('phoneNumber') ) {{old('phoneNumber')}} @elseif( isset($user) ) {{$user->phoneNumber}} @endif" placeholder="Phone Number..." onblur="validate(this.id,{required:1,min:10,max:13,type:'numeric'},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="phoneNumberHelper">
  @if ($errors->has('phoneNumber'))
      <span  role="alert">
          <strong>{{ $errors->first('phoneNumber') }}</strong>
      </span>
  @endif
</p>
</div>
</div>


<div class="form-group">
<label for="selector1" class="col-sm-2 control-label">Gender</label>
<div class="col-sm-8">
<select name="gender" id="gender" class="form-control1">
<option value="1" @if( old('gender') == 1 || ( isset($user) && $user->gender == 1 ) ) selected @endif>Male</option>
<option value="2" @if( old('gender') == 2 || ( isset($user) && $user->gender == 2 ) ) selected @endif>Female</option>
</select>
@if ($errors->has('gender'))
<span  role="alert">
    <strong>{{ $errors->first('gender') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Address</label>
<div class="col-sm-8">
<input name="address" id="address" type="text" class="form-control" value="@if( old('address') ) {{old('address')}} @elseif( isset($user) ) {{$user->address}} @endif" placeholder="Address..." onblur="validate(this.id,{required:0,min:3,max:255},this.value)"/>
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
<label for="focusedinput" class="col-sm-2 control-label">ID No.</label>
<div class="col-sm-8">
<input name="idNo" id="idNo" type="text" class="form-control" value="@if( old('idNo') ) {{old('idNo')}} @elseif( isset($user) ) {{$user->idNo}} @endif" placeholder="ID No..." onblur="validate(this.id,{required:0,min:5,max:10,type:'numeric'},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="idNoHelper">
  @if ($errors->has('idNo'))
      <span  role="alert">
          <strong>{{ $errors->first('idNo') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Id Scan</label>
<div class="col-sm-8">
<img src="@if( isset($user) ){{$user->idImage}} @endif" alt="" class="img-thumbnail" height="50px" width="50px">
<input name="idImage" id="idImage" type="file" value=""  onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="idImageHelper">
  @if ($errors->has('idImage'))
      <span  role="alert">
          <strong>{{ $errors->first('idImage') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Passport</label>
<div class="col-sm-8">
<input name="passport" id="passport" type="text" class="form-control" value="@if( old('passport') ) {{old('passport')}} @elseif( isset($user) ) {{$user->passport}} @endif" placeholder="Passport No..." onblur="validate(this.id,{required:0,min:5,max:20},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('passport'))
      <span  role="alert">
          <strong>{{ $errors->first('passport') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Passport Scan</label>
<div class="col-sm-8">
<img src="@if( isset($user) ){{$user->passportImage}} @endif" alt="@if( isset($user) ){{$user->name}} @endif" class="img-thumbnail" height="50px" width="50px">
<input name="passportImage" id="passportImage" type="file"   onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)"/>
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="passportImageHelper">
  @if ($errors->has('passportImage'))
      <span  role="alert">
          <strong>{{ $errors->first('passportImage') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Password @if( !isset($user) )<span class="red-text">*</span> @endif</label>
<div class="col-sm-8">
<input name="password" id="password" type="text" class="form-control1" value="@if( old('password') ) {{old('password')}}  @endif" placeholder="Password..." onblur="validate(this.id,{required:1,min:8,max:255},this.value)" />
</div>
<div class="col-sm-2">
<p class="help-block red-text" id="passwordHelper">
  @if ($errors->has('password'))
        <span  role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</p>
</div>
</div>-->
