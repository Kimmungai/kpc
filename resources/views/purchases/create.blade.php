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
									<li><a href="/purchases-registration">Purchases</a> <span>«</span></li>
                  <li>New Purchase</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




					<div class="container" >
						<h4 class="mb-2 text-bold">Supplier</h4>

						<div class="row">
							<div class="col-sm-7 mb-2">
								<div class="supplier-details box-shdow-4">
									<div class="input-group">
									  <span class="input-group-addon" id=""><span class="fa fa-search"></span></span>
									  <input type="text" class="form-control" placeholder="Search by name..." aria-describedby="basic-addon1">
									</div>
									<a href="#">Create new supplier instead</a>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="supplier-details box-shdow-4">

									<div class="row">
										<div class="col-xs-8">
											<ul>
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
							</div>
						</div>
						<div class="row">

							<div class="col-sm-12">
									<!--<img class="pull-right" src="{{url('images/avatar-male.png')}}" alt="">-->
									<div class="resp-table ">
										<table  class="" >
					            <thead >
					              <tr>
							            <td style="background:#fff;">Amount Owed</td>
							            <td style="background:#fff;">Amount Paid</td>
							            <td style="background:#fff;">Payment Method</td>
													<td style="background:#fff;">Payment Status</td>

					              </tr>
					            </thead>
											<tbody>
												<tr>
													<td data-label="Amount Owed" style="background:#fff;">Nyau</td>
													<td data-label="Amount Paid" style="background:#fff;">Nyau</td>
													<td data-label="Payment Method" style="background:#fff;">Nyau</td>
													<td data-label="Payment Method" style="background:#fff;"><strong class="text-danger">PAID</strong></td>

												</tr>
											</tbody>
										</table>
								 </div>
							</div>

						</div>
						<h4 class="mt-2 mb-2 text-bold">Goods Supplied</h4>

						<div class="row">
							<div class="col-sm-7 ">
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

						<div class="row mt-2">
							<div class="col-sm-4 pull-right">

								<a href="#" class="btn btn-default btn-lg"><span class="fa fa-undo"></span> clear</a>
								<a href="#" class="btn btn-default btn-lg "><span class="fa fa-save"></span> Save</a>

							</div>

						</div>


					</div>

				</div>
		<!-- //inner_content-->
</div>
<input id="currentDeptID" type="hidden"  value="@if( isset($dept) ) {{$dept->id}} @endif">
@endsection
