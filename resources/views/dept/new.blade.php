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
					  <h2 class="w3_inner_tittle">Department registration</h2>
            @component( 'components.confirm-modal',[ 'formId' => 'newDeptForm', 'heading' => 'New Department datails', 'message' => 'Are you sure you want to save new department details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )

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

                           <form class="form-horizontal" id="newDeptForm" action="{{url('/dept-registration')}}" method="post" enctype="multipart/form-data">
                             @csrf

                             @component( 'components.dept-reg-form' )

                             @endcomponent

                             <div class="button" data-toggle="modal" data-target="#confirmModal">
     													<p class="btnText">Save details?</p>
     													<div class="btnTwo">
     													  <p class="btnText2">GO!</p>
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
@endsection
