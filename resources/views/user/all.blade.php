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
            <h2 class="w3_inner_tittle">@if($type==1) Staff @elseif($type==2) Customers @elseif($type==3) Administrators @elseif($type==4) Casuals @endif</h2>
          @else
            <h2 class="w3_inner_tittle"> All users</h2>
          @endif
                <!-- tables -->

                <!--<div class="agile-tables">

                <div class="w3l-table-info agile_info_shadow">
                  @if( isset($users) )
                  <h3>You can click on open to view more details or edit a record</h3>
                  <table id="table-two-axis" class="two-axis">
                  <thead>
                    <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  @forelse( $users as $user )
                    <tr>
                    <td><img class="img img-circle" src="{{$user->avatar}}" alt="" height="50" width="50" /></td>
                    <td>{{$user->firstName}} {{$user->lastName}}</td>
                    <td>{{$user->phoneNumber}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->address}}</td>
                    <td><a href="{{url('user-registration/')}}/{{$user->id}}/edit">OPEN</a></td>
                    </tr>
                  @empty
                    <tr>
                    <td colspan="5">No records found! <a href="{{url('user-registration/create')}}">Create new record</a></td>
                    </tr>
                  @endforelse

                  </tbody>
                  </table>


                @endif
                </div>
          </div>-->
            <!-- //tables -->

            <div class="social_media_w3ls">
              <div class="row">

              @forelse( $users as $user )
                <div class="col-md-4" style="margin-bottom:20px;">
                  <div class="flip-card">
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
                        <p><i class="fa fa-envelope"></i> {{$user->email}}</p>
                        <p><i class="fa fa-phone"></i> {{$user->phoneNumber}}</p>
                        <a href="/user-registration/{{$user->id}}/edit" class="btn btn-default">Open</a>
                      </div>
                    </div>
                  </div>
                </div>
              @empty

              <p>No records found! <a href="{{url('user-registration/create')}}">Create new record</a></p>
             @endforelse

          </div>
              <div class="clearfix"></div>

          </div>


          </div>
        <!-- //inner_content_w3_agile_info-->
      </div>
  <!-- //inner_content-->
@endsection
