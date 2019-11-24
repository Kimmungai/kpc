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
									<li>New Department Registration</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					 <!-- <h4 class="w3_inner_tittle text-bold text-capitalize mb-2">Department registration</h4>-->
            @component( 'components.confirm-modal',[ 'formId' => 'newDeptForm', 'heading' => 'New Department datails', 'message' => 'Are you sure you want to save new department details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )

            @endcomponent
						<!--/forms-->
				<div class="forms-main_agileits">


							<!--/forms-inner-->
				  				<div class="forms-inner">


										 <!--/set-3-->

											<div class="wthree_general">


                          @if( count($errors) )
                            <h3 class="w3_inner_tittle two red-text">There are some errors, please correct them first.</h3>
                          @endif
													 <h4 class="w3_inner_tittle two mb-2">Please fill in all required field <span class="text-danger">*</span> </h4>

                           <form class="form-horizontal" id="newDeptForm" action="{{url('/dept-registration')}}" method="post" enctype="multipart/form-data">
                             @csrf

														 <div class="row mt-2 dept-details">
							                    @component( 'components.dept-reg-form' )@endcomponent
							                </div>
							               


														<div class="row">
															<div class="col-sm-12">
																<a class="btn btn-default btn-lg center-block" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Save</a>
															</div>
														</div>


                           </form>


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
