@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a></li>

	              </ul>
	            </div>
	          </div>
	        <!-- //breadcrumbs -->
				    <!-- /inner_content_w3_agile_info-->
					<div class="inner_content_w3_agile_info">
					<!-- /departments start-->
					<h4 class="text-capitalize text-bold mb-1">All departments</h4>
					<!--<div class="row">
						<div class="col-md-12">
							<a href="{{url('/dept-registration/create')}}" class="btn btn-default pull-right" title="Add new department">New department <span class="fas fa-plus-circle"></span></a>
						</div>
					</div>-->


					 <div class="agile_top_w3_grids">

						 <?php $rows = ceil(count($depts) / 3); ?>
						 <?php $count = 0; $colors=0;?>
						 <?php $departmentsArr = []; ?>

						 <div class="row">
								 <ul class="ca-menu">
									@foreach( $depts as $Dept )

										<?php if(!in_array($Dept->id, $departmentsArr)) {$departmentsArr [] = $Dept->id;}else{continue;}?>
										<?php if($colors > 3){$colors =0;} ?>
										<div class="col-sm-4">

										 <li >
											 <a href="{{url('dept-registration')}}/{{$Dept->id}}">
												 @if( strtolower($Dept->name) == 'kitchen' )
												 <i class="fas fa-utensils" aria-hidden="true"></i>
												 @elseif( strtolower($Dept->name) == 'chapel' )
												 <i class="fas fa-church" aria-hidden="true"></i>
												 @elseif( strtolower($Dept->name) == 'shamba' )
												 <i class="fa fa-tractor" aria-hidden="true"></i>
												 @elseif( strtolower($Dept->name) == 'compound' )
												 <i class="fas fa-umbrella-beach" aria-hidden="true"></i>
												 @elseif( strtolower($Dept->name) == 'administration' )
												 <i class="fa fa-user-tie" aria-hidden="true"></i>
												 @elseif( strtolower($Dept->name) == 'store' )
												 <i class="fa fa-store-alt" aria-hidden="true"></i>
												 @elseif( strtolower($Dept->name) == 'hospitality' )
												 <i class="fa fa-bed" aria-hidden="true"></i>
												 @else
												 <i class="fa fa-tag" aria-hidden="true"></i>
												 @endif
												 <?php $bookings = 0 ?>
												 @foreach ( $Dept->booking as $booking )
												 	@if($booking->status == 1)
														<?php $bookings += 1 ?>
													@endif
												 @endforeach

												 <div class="ca-content">
													 <h4 class="ca-main @if($colors==1) one @elseif($colors==2) two @elseif($colors==3) three @endif text-capitalize">{{$bookings}} @if($bookings == 1)<small>booking</small>@else <small>bookings</small> @endif</h4>
													 <h3 class="ca-sub @if($colors==1) one @elseif($colors==2) two @elseif($colors==3) three @endif text-capitalize">{{$Dept->name}}</h3>
												 </div>
											 </a>
										 </li>
									 </div>

										 <?php $count++; $colors++;?>

									 @endforeach





								 <div class="clearfix"></div>

							 </ul>
						 </div>

					 </div>




				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->

@endsection
