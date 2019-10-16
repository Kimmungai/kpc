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
									<li>Purchases</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">
					 <?php
					 $filter_from = isset($_GET['filter_from']) ? $_GET['filter_from'] : null;
					 $filter_to = isset($_GET['filter_to']) ? $_GET['filter_to'] : null;
					 $filter_to = strtotime($filter_from) < strtotime($filter_to) ? $filter_to : null;
					  ?>
					 @component( 'components.sort-form', [ 'action' => 'sort-purchases','sortBy' => $sortBy,'filter_from'=>$filter_from,'filter_to'=>$filter_to ] ) @endcomponent

	        <!-- //breadcrumbs -->
					<!--stock options buttons-->

					<!--end stock options buttons-->


						<div class="row">
							<div class="col-sm-6">
								<a href="{{url('/purchases-registration/create')}}" class="btn btn-default" title="Create new user">New purchase <span class="fas fa-plus-circle"></span></a>
							</div>
							<div class="col-sm-6">
								@if( isset($dept) )
								<h4 class="pull-right  p-1 results-info">Showing: @if(isset($purchases)) {{count($purchases)}} of {{$purchases->total()}}@endif @if(isset($startDate))<span>from {{date('d-m-y',strtotime($startDate))}}</span>@endif @if(isset($endDate))<span>to {{date('d-m-y',strtotime($endDate))}}</span>@endif</h4>
								@endif
							</div>
						</div>

						<div class="row">

							@if(isset($purchases))
								@foreach($purchases as $purchase)
								<div class="col-sm-4 mb-2">
									<div class="action-tab ">
											<dl>
												<dt>
													<a href="{{route('purchases-registration.show',$purchase->id)}}"><i class="fas fa-money-bill-wave"></i></a>
													@if( $purchase->amountDue - $purchase->amountPaid <= 0 )
													<div class="status-sec">Paid <span class="fa fa-circle text-success"></span></div>
													@else
													<div class="status-sec">Pending <span class="fa fa-circle text-danger"></span></div>
													@endif

												</dt>
												<dd>
													<h3><a href="{{route('purchases-registration.show',$purchase->id)}}">Purchases-{{$purchase->id}}</a></h3>
													@if( $purchase->user )
													<p>Supplier: <strong>{{$purchase->user->firstName}}</strong></p>
													@endif
													<p>Date: <strong>{{date('d/m/Y',strtotime($purchase->created_at))}}</strong></p>
													<p>Paid: <strong>Ksh. @if( !$purchase->amountPaid ) 0 @else {{$purchase->amountPaid}} @endif</strong></p>
													<p>Owed: <strong>Ksh. @if( !$purchase->amountDue ) 0 @else {{$purchase->amountDue - $purchase->amountPaid}} @endif</strong></p>
													<a href="{{route('purchases-registration.show',$purchase->id)}}" class="btn btn-x-sm  btn-default" >Open</a>
												<dd>
											</dl>
										</div>
								</div>
								@endforeach
							@endif

						</div>
						<div class="row">
							@if(isset($purchases))
								{{$purchases->appends(request()->except('page'))->links()}}
							@endif
						</div>

				</div>
		<!-- //inner_content-->
</div>

@endsection
