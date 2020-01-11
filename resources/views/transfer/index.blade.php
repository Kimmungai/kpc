@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a> <span>«</span></li>
                  @if( isset($dept) )
                  <li class="text-capitalize"><a href="/dept-registration/{{$dept->id}}">{{$dept->name}}</a> <span>«</span></li>
                  @endif
                  <li>Transfer</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">

           <div class="row">

            <h4 class="mb-2 text-bold">Transfer form</h4>
						<div id="no-dept-error" class="alert alert-danger alert-dismissible @if(!$errors->has('toDept'))hidden @endif" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5>Please select a destination department</h5>
						</div>

             <div class="col-sm-4">
               <div class="agile_top_w3_grids">
                   <ul class="ca-menu">
                     <li>
                      <a href="#">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <div class="ca-content">
                          <h4 class="ca-main one">From</h4>
                          <h3 class="ca-sub one">{{$dept->name}}</h3>
                          <input type="hidden" id="transferFromDept" value="{{$dept->id}}">
                        </div>
                      </a>
                    </li>
                   </ul>
               </div>
             </div>

             <div class="col-sm-4 allDepts ">
               <h4 class="text-center">Transfer</h4>
               <p class="text-center text-success hidden-xs" style="font-size:50px;"><i class="fas fa-long-arrow-alt-right"></i></p>
               <p class="text-center text-success hidden-sm hidden-md hidden-lg hidden-xl" style="font-size:50px;"><i class="fas fa-long-arrow-alt-down"></i></p>
               <p>
                 <select name="allDepts" id="allDepts" class="form-control mb-2" onchange="select_dept(this.value,this.id)">
                   <option disabled selected>destination dept</option>
                   @foreach( $allDepts as $singleDept )
                     <?php if( $singleDept->id == $dept->id ){continue;} ?>
                     <option data-id = "{{$singleDept->id}}"> {{$singleDept->name}} </option>
                   @endforeach

                 </select>
               </p>
             </div>

             <div class="col-sm-4 pl-0" >
               <div class="agile_top_w3_grids">
                   <ul class="ca-menu">
                     <li id="destinationDept">
                      <a href="#">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <div class="ca-content">
                          <h4 class="ca-main">To</h4>
                          <h3 class="ca-sub"></h3>
                          <input type="hidden" id="transferToDept" value="">
                        </div>
                      </a>
                    </li>
                   </ul>
               </div>
             </div>

           </div>

						<div class="row">

							<div class="col-sm-7 mb-2">
								<!--booking form-->
								<form id="booking-form" class="" action="{{route('transfer.store')}}" method="post">
									@csrf
								@component('components.prod-search-panel',['title' => 'Products to transfer', 'dept' => $dept])@endcomponent

								@component('components.prod-result-panel',['title' => 'Products to transfer'])@endcomponent

								<input type="hidden" name="fromDept" value="{{$dept->id}}">
								<input type="hidden" name="toDept" >
								<input type="hidden" name="no_products" >


								<!--end booking form-->

							</div>

							<div class="col-sm-5">
								<!--Customer details-->




								<!--End customer details-->
								<h4 class="mb-2 mt-1 text-bold">Comments</h4>

									<div class="row">
										<div class="col-xs-12">

											<textarea class="form-control" name="comments" rows="8" cols="80" placeholder="Any comments?">{{old('comments')}}</textarea>

										</div>

									</div>

                <div class="row">
									<div class="col-sm-12 ">
										<button type="button" class="btn btn-default  btn-block mt-1" data-toggle="modal" data-target="#confirmModal"><span class="fa fa-save"></span> Transfer</button>

									</div>

								</div>


							</div>
						</div>
					</form>


				</div>
		<!-- //inner_content-->
</div>
@component( 'components.confirm-modal',[ 'formId' => 'booking-form', 'heading' => 'Transfer form', 'message' => 'Are you sure you want to sunmit transfer form?', 'closeBtn' => 'No ', 'saveBtn' => 'Yes' ] )@endcomponent

@endsection
