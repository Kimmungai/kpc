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
                  <li><a href="/product-registration">All products</a><span>«</span></li>
									<li>Requisition Form</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h4 class="text-bold text-capitalize mb-2">Requisition form</h4>
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


												<div class="row" >
													<div class="col-md-12">
														<a href="#" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Save</a>
													</div>
												</div>
	                           <form class="form-horizontal mt-2" id="newUserForm" action="{{url('/user-registration')}}" method="post" enctype="multipart/form-data">
	                             @csrf

	                             @component( 'components.user-reg-form' )

	                             @endcomponent



	                           </form>




											<!--<div class="button" data-toggle="modal" data-target="#confirmModal">
											 <p class="btnText">Save details?</p>
											 <div class="btnTwo" style="background:green">
												 <p class="btnText2">GO!</p>
											 </div>
										 </div>-->
										 <div class="row" >
												<div class="col-md-12">
													<a href="#" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Save</a>
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
