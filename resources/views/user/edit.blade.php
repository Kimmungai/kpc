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
  					  <h4 class="text-bold text-capitalize mb-2">User registration</h4>
              <h4 class="w3_inner_tittle two mb-2">Please fill in all required field <span class="text-danger">*</span> </h4>
              @if( count($errors) )
                <h4 class="w3_inner_tittle two red-text mb-2">There are some errors, please correct them first.</h4>
              @endif
              @component( 'components.confirm-modal',[ 'formId' => 'newUserForm', 'heading' => 'New user datails', 'message' => 'Are you sure you want to save new user details?', 'closeBtn' => 'No', 'saveBtn' => 'Yes' ] )

              @endcomponent

              @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteUserForm', 'closeBtn' => 'No', 'saveBtn' => 'Yes' ] )

              @endcomponent

  						<!--/forms-->
  				<div class="forms-main_agileits">


  							<!--/forms-inner-->
  				  				<div class="forms-inner">


  										 <!--/set-3-->

  											<div class="wthree_general">


  													<div class="grid-1 graph-form agile_info_shadow">


                             <form class="form-horizontal" id="newUserForm" action="{{route('user-registration.update',$user->id)}}" method="post" enctype="multipart/form-data">

                               <div class="row mb-2">
                                 <div class="col-sm-12">
                                   @if( Auth::user()->type == -1 )
                                    <a class="btn btn-default btn-lg" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-exclamation-triangle"></span> Delete</a>
                                   @endif

                                   <a class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Update</a>
                                 </div>
                               </div>

                               @csrf
                               @method('PUT')

                               @component( 'components.user-reg-form', ['user'=>$user])

                               @endcomponent

                               <!--<div class="button" data-toggle="modal" data-target="#confirmModal">
       													<p class="btnText">Update?</p>
       													<div class="btnTwo" style="background:green">
       													  <p class="btnText2">GO!</p>
       													</div>
       												 </div>

                               <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
      													<p class="btnText">Delete?</p>
      													<div class="btnTwo">
      													  <p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
      													</div>
                              </div>-->

                              <div class="row">
                                <div class="col-sm-12">
                                  @if( Auth::user()->type == -1 )
                                   <a class="btn btn-default btn-lg" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-exclamation-triangle"></span> Delete</a>
                                  @endif

                                  <a class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Update</a>
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
