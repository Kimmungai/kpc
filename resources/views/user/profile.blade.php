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
  									<li>{{$user->name}}</li>
  								</ul>
  							</div>
  						</div>
  					<!-- //breadcrumbs -->

  					<div class="inner_content_w3_agile_info two_in">
  						<!--/forms-->
  				<div class="forms-main_agileits">


  							<!--/forms-inner-->
  				  				<div class="forms-inner">


  										 <!--/set-3-->

  											<div class="wthree_general">


    											<div class="grid-1 graph-form agile_info_shadow">

                            <div class="emp-profile">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="profile-img">
                                              @if( $user->avatar )
                                                <img src="{{$user->avatar}}" alt="$user->name"/>
                                              @else
                                                <img src="@if($user->gender == 1) {{url('/images/avatar-male.png')}} @else {{url('/images/avatar-female.png')}} @endif" alt=""/>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile-head">
                                                        <h3 class="mb-1">
                                                            {{$user->firstName}} {{$user->lastName}} @if($user->name) ({{$user->name}}) @endif
                                                        </h3>
                                                        @if( $user->type == -1 )
                                                          <h6>Super Adminstrator</h6>
                                                        @elseif( $user->type == 1 )
                                                          <h6>Staff</h6>
                                                        @elseif( $user->type == 2 )
                                                          <h6>Customer</h6>
                                                        @elseif( $user->type == 3 )
                                                          <h6>Administrator</h6>
                                                        @elseif( $user->type == 4 )
                                                          <h6>Casual</h6>
                                                        @elseif( $user->type == 5 )
                                                          <h6>Supplier</h6>
                                                        @else
                                                          <h6>Customer</h6>
                                                        @endif

                                                        @if($user->Dept)
                                                          <p class="proile-rating">Department : <span>{{$user->Dept->name}}</span></p>
                                                        @endif

                                                <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{url('/user-registration')}}/{{$user->id}}/edit" class="btn btn-xs btn-default" ><i class="fa fa-cog"></i> Edit Profile</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="profile-work">
                                                <p class="mb-2">Basic info</p>
                                                <a href="">Gender: </a><br/>
                                                <a href="">DOB: </a><br/>
                                                <a href="">Bootply Profile</a>
                                                <p class="mb-2">SKILLS</p>
                                                <a href="">Web Designer</a><br/>
                                                <a href="">Web Developer</a><br/>
                                                <a href="">WordPress</a><br/>
                                                <a href="">WooCommerce</a><br/>
                                                <a href="">PHP, .Net</a><br/>
                                            </div>

                                        </div>
                                        <div class="col-md-8">
                                            <div class="tab-content profile-tab" id="myTabContent">
                                                <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label>User Id</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>{{$user->id}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label>Name</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>{{$user->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label>Email</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>{{$user->email}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label>Phone</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>{{$user->phoneNumber}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label>Biography</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>{{$user->biography}}</p>
                                                                </div>
                                                            </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>


    											</div>

  										</div>
  										<!--//set-3-->

  									</div>
  								<!--//forms-inner-->
  							</div>
  					<!--//forms-->


  				    </div>
  					<!-- //inner_content_w3_agile_info-->
  				</div>
  		<!-- //inner_content-->

  <form class="d-none hidden" id="deleteUserForm" action="{{route('user-registration.update',$user->id)}}" method="post">
    @csrf
    @method('DELETE')
  </form>


@endsection
