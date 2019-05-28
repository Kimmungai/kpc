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

                <div class="agile-tables">

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
          </div>
            <!-- //tables -->


          </div>
        <!-- //inner_content_w3_agile_info-->
      </div>
  <!-- //inner_content-->
@endsection
