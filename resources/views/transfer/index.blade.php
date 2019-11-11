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
									<li><a href="/bookings-registration">Bookings</a> <span>«</span></li>
                  <li>New Booking</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">

           <div class="row">

            <h4 class="mb-2 text-bold">Transfer form</h4>

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
                 <select name="allDepts" id="allDepts" class="form-control mb-2" onchange="select_dept(this.value)">
                   <option disabled selected>destination dept</option>
                   @foreach( $allDepts as $singleDept )
                     <?php if( $singleDept->id == $dept->id ){continue;} ?>
                     <option> {{$singleDept->name}} </option>
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
								<div class="row">

									<div class="col-sm-12 ">
										<h4 class="mb-2 text-bold">Product to transfer</h4>

										<div class="supplier-details box-shdow-4">
											<div class="input-group">
											  <span class="input-group-addon" id=""><span class="fa fa-search"></span></span>
											  <input type="text" class="form-control" placeholder="Search by sku..." aria-describedby="basic-addon1">
											</div>
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-sm-12">
										<div class="resp-table ">
											<table  class="" >
												<thead >
													<tr>
														<td style="background:#fff;">#</td>
														<td style="background:#fff;">Image</td>
														<td style="background:#fff;">SKU</td>
														<td style="background:#fff;">Name</td>
														<td style="background:#fff;">Quantity</td>
														<td style="background:#fff;">Cost</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td data-label="#" style="background:#fff;"><span class="fas fa-times-circle"></span> &nbsp;&nbsp;&nbsp;1.</td>
														<td data-label="Image" style="background:#fff;"> <img class="img-circle prod-img" src="{{url('images/avatar-male.png')}}" alt="" height="50" width="50"></td>
														<td data-label="Name" style="background:#fff;">Nyau</td>
														<td data-label="Email" style="background:#fff;">Nyau</td>
														<td data-label="Phone" style="background:#fff;">Nyau</td>
														<td data-label="Amount Owed" style="background:#fff;">Nyau</td>
													</tr>
												</tbody>
											</table>
									 </div>
									</div>
								</div>



								<!--end booking form-->

							</div>

							<div class="col-sm-5">
								<!--Customer details-->




								<!--End customer details-->
								<h4 class="mb-2 mt-1 text-bold">Comments</h4>

									<div class="row">
										<div class="col-xs-12">

											<textarea class="form-control" name="name" rows="8" cols="80" placeholder="Any comments?"></textarea>

										</div>

									</div>


                <div class="row">
									<div class="col-sm-12 ">
										<a href="#" class="btn btn-default  btn-block mt-1"><span class="fa fa-save"></span> Save</a>

									</div>

								</div>


							</div>
						</div>


				</div>
		<!-- //inner_content-->
</div>

@endsection
