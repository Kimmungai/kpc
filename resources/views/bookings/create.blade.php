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

							<div class="col-sm-7 mb-2">
								<!--booking form-->
								<h4 id="formTitle" class="mb-2 text-bold">Booking form</h4>

								<div class="row">
									<div class="col-sm-12 ">
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-gift"></i></span>
										  <select class="form-control" name="bookingType" onchange="select_booking_type(this.value)">
												<option value="1"> Food ordering </option>
												<option value="2"> Room booking </option>
												<option value="3"> Tent Hiring </option>
												<option value="4"> Meeting hall booking </option>
												<option value="5"> Compound booking </option>
										  </select>
										</div>
										<div id="numPpleTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-users"></i></span>
										  <input name="numPple" id="numPple" type="number" class="form-control numeric" value="{{old('numPple')}}" placeholder="Number of people" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" required>
										</div>
										<div id="chkInDateTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i></span>
										  <input type="text" name="chkInDate" id="chkInDate" class="form-control" placeholder="Date" onblur="validate(this.id,{required:1,min:3,max:255},this.value)">
										</div>
										<div id="chkOutDateTitle" class="input-group input-group-md hidden">
										  <span class="input-group-addon" id=""><i class="fa fa-calendar-alt"></i></span>
										  <input type="text" name="chkOutDate" id="chkOutDate" class="form-control" placeholder="Date" onblur="validate(this.id,{required:1,min:3,max:255},this.value)">
										</div>
										<div id="bookingAmountDueTitle" class="input-group input-group-md">
										  <span class="input-group-addon" id=""><i class="fas fa-money-bill"></i></span>
										  <input name="bookingAmountDue" id="bookingAmountDue" type="number" class="form-control numeric" value="{{old('bookingAmountDue')}}" placeholder="Number of people" onblur="validate(this.id,{required:1,min:3,max:255},this.value)" required>
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id="">@</span>
										  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id="">@</span>
										  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id="">@</span>
										  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id="">@</span>
										  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id="">@</span>
										  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
										</div>
										<div class="input-group input-group-md">
										  <span class="input-group-addon" id="">@</span>
										  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-sm-12 ">
										<h4 class="mb-2 text-bold">Other Booked products</h4>

										<div class="supplier-details box-shdow-4">
											<div class="input-group">
											  <span class="input-group-addon" id=""><span class="fa fa-search"></span></span>
											  <input type="text" class="form-control" placeholder="Search by sku..." aria-describedby="basic-addon1">
											</div>
											<a href="#">Create new product instead</a>
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
								<h4 class="mb-2 text-bold">Customer</h4>

								<div class="supplier-details box-shdow-1 mb-2">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-search"></span></span>
									  <input type="text" class="form-control" placeholder="Search customer by name..." aria-describedby="basic-addon1">
									</div>
									<a href="#">Create new customer instead</a>
								</div>

								<div class="supplier-details box-shdow-1">

									<div class="row">
										<div class="col-xs-8">
											<ul class="pt-1">
												<li><span class="fa fa-user"></span> Name</li>
												<li><span class="fa fa-phone"></span> 0790643963</li>
												<li><span class="fa fa-envelope"></span> kimpita9@gmail.com</li>
											</ul>
										</div>
										<div class="col-xs-4">
											<span class="fas fa-times-circle close"></span>
											<img src="{{url('images/avatar-male.png')}}" alt="">
										</div>
									</div>

								</div>
								<!--End customer details-->
								@if( isset($dept) )
								@if( count($dept->DeptServices) )
								<h4 class="mb-2 mt-1 text-bold">Other services </h4>
								<div class="supplier-details box-shdow-1">

									<div class="row">

										<div class="col-xs-6">
											<ul>
												@foreach( $dept->DeptServices as $service )
													<li>
														<input id="" type="checkbox" value="{{$service->id}}"> {{$service->service}}
												  </li>
												@endforeach
											</ul>
										</div>


									</div>

								</div>
								@endif
								@endif

								<div class="row mt-2">
									<div class="col-sm-12 ">
										<a href="#" class="btn btn-default btn-lg mt-1"><span class="fa fa-save"></span> Save</a>
										<a href="#" class="btn btn-default btn-lg mt-1"><span class="fa fa-undo"></span> clear</a>

									</div>

								</div>

							</div>
						</div>


				</div>
		<!-- //inner_content-->
</div>

@endsection
