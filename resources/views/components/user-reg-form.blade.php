<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Avatar</label>
<div class="col-sm-8">
<img src="@if( isset($user) ){{$user->avatar}} @endif" alt="@if( isset($user) ){{$user->name}} @endif" class="img-thumbnail" height="50px" width="50px">
<input name="avatar" id="avatar" type="file"   />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('avatar'))
    <span class="alert-danger" role="alert">
        <strong>{{ $errors->first('avatar') }}</strong>
    </span>
@endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Username</label>
<div class="col-sm-8">
<input name="name" id="name" data-validation="length alphanumeric" data-validation-length="min4" type="text" class="form-control1" value="@if( old('name') ) {{old('name')}} @elseif( isset($user) ) {{$user->name}} @endif" placeholder="Username..." />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('name'))
        <span class="alert-danger"  role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">First Name</label>
<div class="col-sm-8">
<input name="firstName" id="firstName" type="text" class="form-control1" value="@if( old('firstName') ) {{old('firstName')}} @elseif( isset($user) ) {{$user->firstName}} @endif" placeholder="First Name..." />
</div>
<div class="col-sm-2">
<p class="help-block">
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
<input name="middleName" id="middleName" type="text" class="form-control1" value="@if( old('middleName') ) {{old('middleName')}} @elseif( isset($user) ) {{$user->middleName}} @endif" placeholder="Middle Name..." />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('middleName'))
        <span  role="alert">
            <strong>{{ $errors->first('middleName') }}</strong>
        </span>
    @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Last Name</label>
<div class="col-sm-8">
<input name="lastName" id="lastName" type="text" class="form-control1" value="@if( old('lastName') ) {{old('lastName')}} @elseif( isset($user) ) {{$user->lastName}} @endif" placeholder="Last name..." />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('lastName'))
        <span  role="alert">
            <strong>{{ $errors->first('lastName') }}</strong>
        </span>
    @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">DOB</label>
<div class="col-sm-8">
<input name="DOB" id="DOB" type="text" class="form-control1" value="@if( old('DOB') ) {{old('DOB')}} @elseif( isset($user) ) {{$user->DOB}} @endif" placeholder="yy-mm-dd" />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('DOB'))
      <span  role="alert">
          <strong>{{ $errors->first('DOB') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Email</label>
<div class="col-sm-8">
<input name="email" id="email" type="text" class="form-control1" value="@if( old('email') ) {{old('email')}} @elseif( isset($user) ) {{$user->email}} @endif" placeholder="Email..." />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('email'))
      <span  role="alert">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Phone Number</label>
<div class="col-sm-8">
<input name="phoneNumber" id="phoneNumber" type="text" class="form-control1" value="@if( old('phoneNumber') ) {{old('phoneNumber')}} @elseif( isset($user) ) {{$user->phoneNumber}} @endif" placeholder="Phone Number..." />
</div>
<div class="col-sm-2">
<p class="help-block">
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
<option selected disabled>Choose one</option>
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
<label for="selector1" class="col-sm-2 control-label">Organisation</label>
<div class="col-sm-8">
<select name="supermarket_id" id="supermarket_id" class="form-control1" onchange="refresh_departments(this.value,['staffDepartmentId','adminDepartmentId'])">
  <option selected disabled>Choose one</option>
  @if( isset( $userSupermarkets ) )
    @foreach($userSupermarkets as $supermarket)
      <option value="{{$supermarket->id}}" @if ( old('supermarket_id') == $supermarket->id  ) selected @else selected @endif>{{$supermarket->name}}</option>
    @endforeach
  @endif
</select>
@if ($errors->has('supermarket_id'))
  <span  role="alert">
      <strong>{{ $errors->first('supermarket_id') }}</strong>
  </span>
@endif
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Address</label>
<div class="col-sm-8">
<input name="address" id="address" type="text" class="form-control" value="@if( old('address') ) {{old('address')}} @elseif( isset($user) ) {{$user->address}} @endif" placeholder="Address..." />
</div>
<div class="col-sm-2">
<p class="help-block">
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
<input name="idNo" id="idNo" type="text" class="form-control" value="@if( old('idNo') ) {{old('idNo')}} @elseif( isset($user) ) {{$user->idNo}} @endif" placeholder="ID No..." />
</div>
<div class="col-sm-2">
<p class="help-block">
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
<input name="idImage" id="idImage" type="file" value=""  />
</div>
<div class="col-sm-2">
<p class="help-block">
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
<input name="passport" id="passport" type="text" class="form-control" value="@if( old('passport') ) {{old('passport')}} @elseif( isset($user) ) {{$user->passport}} @endif" placeholder="Passport No..." />
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
<input name="passportImage" id="passportImage" type="file"   />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('passportImage'))
      <span  role="alert">
          <strong>{{ $errors->first('passportImage') }}</strong>
      </span>
  @endif
</p>
</div>
</div>

<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Password</label>
<div class="col-sm-8">
<input name="password" id="password" type="text" class="form-control1" value="@if( old('password') ) {{old('password')}}  @endif" placeholder="Password..." />
</div>
<div class="col-sm-2">
<p class="help-block">
  @if ($errors->has('password'))
        <span  role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</p>
</div>
</div>
