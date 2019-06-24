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
  									<li>New User Registration</li>
  								</ul>
  							</div>
  						</div>
  					<!-- //breadcrumbs -->

  					<div class="inner_content_w3_agile_info two_in">
  					  <h2 class="w3_inner_tittle">User registration</h2>
              @component( 'components.confirm-modal',[ 'formId' => 'newUserForm', 'heading' => 'New user datails', 'message' => 'Are you sure you want to save new user details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )

              @endcomponent

              @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteUserForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

              @endcomponent

  						<!--/forms-->
  				<div class="forms-main_agileits">


  							<!--/forms-inner-->
  				  				<div class="forms-inner">


  										 <!--/set-3-->

  											<div class="wthree_general">


  													<div class="grid-1 graph-form agile_info_shadow">
                            @if( count($errors) )
                              <h3 class="w3_inner_tittle two red-text">There are some errors, please correct them first.</h3>
                            @endif
  													 <h3 class="w3_inner_tittle two">Please fill in this Form </h3>

                             <form class="form-horizontal" id="newUserForm" action="{{route('user-registration.update',$user->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                               @method('PUT')

                               @component( 'components.user-reg-form', ['user'=>$user])

                               @endcomponent

                               <div class="button" data-toggle="modal" data-target="#confirmModal">
       													<p class="btnText">Update?</p>
       													<div class="btnTwo">
       													  <p class="btnText2">GO!</p>
       													</div>
       												 </div>

                               <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
      													<p class="btnText">Delete?</p>
      													<div class="btnTwo">
      													  <p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
      													</div>
      												 </div>


                             </form>


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
