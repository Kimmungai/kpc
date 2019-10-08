@extends('layouts.kpc')

@section('content')
<!-- /inner_content-->
      <div class="inner_content">
          <!-- /inner_content_w3_agile_info-->

        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li><a href="/home">Home</a><span>«</span></li>
                <li><a href="/users">All users</a><span>«</span></li>
                @if( isset($type) )
                  <li>@if($type==1) Staff @elseif($type==2) Customers @elseif($type==3) Administrators @elseif($type==4) Casuals @endif</li>
                @else
                  <li>All users</li>
                @endif
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->

        <div class="inner_content_w3_agile_info two_in">
          @if( isset($type) )
            <h2 class="w3_inner_tittle">@if($type==1) Staff @elseif($type==2) Customers @elseif($type==3) Administrators @elseif($type==4) Casuals @elseif($type==5) Suppliers @elseif($type==-1) Super Administrators @endif</h2>
          @else
            <h2 class="w3_inner_tittle"> All users </h2>

          @endif




            <div class="social_media_w3ls">

              <div class="row">
                <div class="col-md-12">
                  <a href="{{url('/user-registration/create')}}" class="btn btn-default pull-right" title="Create new user">New user <span class="fas fa-user-plus"></span></a>
                </div>
              </div>

              <div class="row">

              @forelse( $users as $user )
                <div class="col-md-4" style="margin-bottom:20px;">
                  <!--<div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        @if( $user->avatar )
                        <img src="{{$user->avatar}}" alt="{{$user->firstName}}" >
                        @else
                        <img src="@if($user->gender == 1){{url('images/avatar-male.png')}}@else {{url('images/avatar-female.png')}} @endif" alt="{{$user->firstName}}" >
                        @endif
                      </div>
                      <div class="flip-card-back @if($user->type==1) bg-staff @elseif($user->type==2) bg-customer @elseif($user->type==4) bg-casual @endif">
                        <h1>{{$user->firstName}} {{$user->lastName}}</h1>
                        <p class="text-left"><strong>Email: </strong>{{$user->email}}</p>
                        <p class="text-left"><strong>Cell: </strong>{{$user->phoneNumber}}</p>
                        <a href="/user-registration/{{$user->id}}/edit" class="btn btn-default"><i class="fa fa-file"></i> Open record</a>
                        @if($user->email)
                        <a href="mailto:{{$user->email}}" class="btn btn-default"><i class="fa fa-envelope"></i> Send email</a>
                        @endif
                      </div>
                    </div>
                  </div>-->
                  <!--new card design-->
                  <div class="panel panel-default mt-2">
                    <div class="panel-heading">  <h4 >User Profile</h4></div>
                     <div class="panel-body">

                      <div class="box box-info" style="overflow:hidden">

                              <div class="box-body">
                                       <div class="col-sm-6">
                                         @if( $user->avatar )
                                         <div  align="center"> <img alt="{{$user->firstName}}" src="{{$user->avatar}}" id="profile-image1" class="img-circle img-responsive">
                                         @else
                                         <div  align="center"> <img alt="{{$user->firstName}}" src="@if($user->gender == 1){{url('images/avatar-male.png')}}@else {{url('images/avatar-female.png')}} @endif" id="profile-image1" class="img-circle img-responsive">
                                         @endif

                                  <input id="profile-image-upload" class="hidden" type="file">
                  <!--<div style="color:#999;" >click here to change profile image</div>-->
                                  <!--Upload Image Js And Css-->
                                       </div>
                                <br>
                                <!-- /input-group -->
                              </div>
                              <div class="col-sm-6">
                              <h4 style="color:#007ee5;">{{$user->name}}</h4></span>
                              @if( $user->type == -1 )
                                <span><p style="color:#e53238">Super Adminstrator</p></span>
                              @elseif( $user->type == 1 )
                                <span><p style="color:#e53238">Staff</p></span>
                              @elseif( $user->type == 2 )
                                <span><p style="color:#e53238">Customer</p></span>
                              @elseif( $user->type == 3 )
                                <span><p style="color:#e53238">Administrator</p></span>
                              @elseif( $user->type == 4 )
                                <span><p style="color:#e53238">Casual</p></span>
                              @elseif( $user->type == 5 )
                                <span><p  style="color:#e53238">Supplier</p></span>
                              @else
                                <span><p style="color:#e53238">Customer</p></span>
                              @endif
                              <a class="btn btn-default btn-block mt-2" href="/user-registration/{{$user->id}}/edit">Open record</a>
                              </div>
                              <div class="clearfix"></div>
                              <hr style="margin:5px 0 5px 0;">

                  @if( $user->firstName || $user->lastName )
                  <div class="col-sm-5 col-xs-6 tital " >Full Name:</div><div class="col-sm-7 col-xs-6 ">{{$user->firstName}} {{$user->lastName}}</div>
                       <div class="clearfix"></div>
                  <div class="bot-border"></div>
                  @endif
                  <div class="col-sm-5 col-xs-6 tital " >Date Of Joining:</div><div class="col-sm-7">{{date('d M Y',strtotime($user->created_at))}}</div>

                    <div class="clearfix"></div>
                  <div class="bot-border"></div>

                  @if( isset($allDepts) )
                  <div class="col-sm-5 col-xs-6 tital " >Department:</div>
                  @foreach( $allDepts as $Dept )
                    @if( $Dept->id == $user->dept )
                      <div class="col-sm-7">{{$Dept->name}}</div>
                      @break
                    @endif
                  @endforeach

                    <div class="clearfix"></div>
                  <div class="bot-border"></div>
                  @endif

                  <div class="col-sm-5 col-xs-6 tital " >Phone:</div><div class="col-sm-7">{{$user->phoneNumber}}</div>

                   <div class="clearfix"></div>
                  <div class="bot-border"></div>

                  <div class="col-sm-5 col-xs-6 tital " >Email:</div><div class="col-sm-7">{{$user->email}}</div>

                   <div class="clearfix"></div>
                  <div class="bot-border"></div>

                  <div class="col-sm-5 col-xs-6 tital " >Status:</div>
                  <div class="col-sm-7">
                    <label class="switch">
                      <input id="status-user-{{$user->id}}" type="checkbox" @if( !$user->deleted_at ) checked @endif onchange="user_state_change({{$user->id}},this.id)">
                      <span class="slider round"></span>

                    </label>
                  </div>


                              <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                          </div>


                      </div>
                      </div>
                  <!-- end new card design-->
                </div>
              @empty

              <p>No records found! <a href="{{url('user-registration/create')}}">Create new record</a></p>
             @endforelse



          </div>
              <div class="clearfix"></div>

          </div>
          {{$users->links()}}



          </div>
        <!-- //inner_content_w3_agile_info-->
      </div>
  <!-- //inner_content-->
@endsection
