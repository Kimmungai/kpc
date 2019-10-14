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

						<h4 class="w3_inner_tittle two mb-2">Please fill in all required field <span class="text-danger">*</span> </h4>
						@if( count($errors) )
							<h4 class="w3_inner_tittle two red-text mb-2">There are some errors, please correct them first.</h4>
						@endif
						<!--/forms-->
				<div class="forms-main_agileits">


							<!--/forms-inner-->
				  				<div class="forms-inner">


										 <!--/set-3-->

											<div class="wthree_general">



	                           <form class="form-horizontal" id="newUserForm" action="{{url('/user-registration')}}" method="post" enctype="multipart/form-data">
	                             @csrf

	                             @component( 'components.user-reg-form' )

	                             @endcomponent



	                           </form>


													

											<div class="button" data-toggle="modal" data-target="#confirmModal">
											 <p class="btnText">Save details?</p>
											 <div class="btnTwo" style="background:green">
												 <p class="btnText2">GO!</p>
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
@endsection
