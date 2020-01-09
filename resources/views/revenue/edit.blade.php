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
                  <li><a href="{{route('revenue.index')}}">All revenue</a><span>«</span></li>
									<li>Revenue-{{$revenue->id}}</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">Edit Revenue-{{$revenue->id}}</h2>
            @component( 'components.confirm-modal',[ 'formId' => 'editRevenueForm', 'heading' => 'Edit revenue-'.$revenue->id.' datails', 'message' => 'Are you sure you want to update revenue-'.$revenue->id.' details?', 'closeBtn' => 'No', 'saveBtn' => 'Yes' ] )

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



	                           <form class="form-horizontal" id="editRevenueForm" action="{{route('revenue.update',$revenue->id)}}" method="post" enctype="multipart/form-data">
	                             @csrf
															 @method('PUT')

	                             @component( 'components.revenue-reg-form',['revenue'=>$revenue] )

	                             @endcomponent

															 @if(isset($dept))
															 <input type="hidden" name="dept_id" value="{{$dept->id}}">
															 @endif



	                           </form>




											<!--<div class="button" data-toggle="modal" data-target="#confirmModal">
											 <p class="btnText">Save details?</p>
											 <div class="btnTwo" style="background:green">
												 <p class="btnText2">GO!</p>
											 </div>
										 </div>-->

										 <div class="row">
												<div class="col-sm-12">
													<a class="btn btn-default btn-lg" title="Click to permanently delete record" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>

													<a class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Update</a>
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
		@if( Auth::user()->type == 3 || Auth::user()->type == -1)
		@component( 'components.delete-confirm-modal',[ 'formId' => 'deleteRevenueForm', 'closeBtn' => 'No ', 'saveBtn' => 'Yes' ] ) @endcomponent
		<form class="d-none hidden" id="deleteRevenueForm" action="{{route('revenue.destroy',$revenue->id)}}" method="post">
		  @csrf
		  @method('DELETE')
		</form>
		@endif
@endsection
