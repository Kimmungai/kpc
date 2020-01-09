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
									<li><a href="{{route('revenue.index')}}">Revenue</a> <span>«</span></li>
                  <li>Revenue-@if(isset($revenue)){{$revenue->id}} @endif</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Booking-@if(isset($revenue)){{$revenue->id}} @endif </h1>
							@endif
						</div>

						<!--buttons-->
						<div class="row mt-2 mb-2">
								<a href="{{route('revenue.edit',$revenue->id)}}" class="btn btn-lg btn-default" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>

							@if( Auth::user()->type == 3 || Auth::user()->type == -1)
								<a href="#" class="btn btn-lg btn-default pull-right" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							@endif
						</div>
						<!--end buttons-->

						<!--start purchase-show-->
						 @component('components.revenue-show',['revenue'=>$revenue,'dept'=>$dept])@endcomponent
						<!--end purchase-show-->

						<!--buttons-->
						<div class="row mt-2 mb-2">
								<a href="{{route('revenue.edit',$revenue->id)}}" class="btn btn-lg btn-default" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>

							@if( Auth::user()->type == 3 || Auth::user()->type == -1)
								<a href="#" class="btn btn-lg btn-default pull-right" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							@endif
						</div>
						<!--end buttons-->


				</div>
		<!-- //inner_content-->
</div>

@if( Auth::user()->type == 3 || Auth::user()->type == -1)

@component( 'components.delete-confirm-modal',[ 'formId' => 'deleteRevenueForm', 'closeBtn' => 'No ', 'saveBtn' => 'Yes' ] ) @endcomponent

@component( 'components.revenue-payment',['revenue'=>$revenue,'dept'=>$dept]) @endcomponent

<form class="d-none hidden" id="deleteRevenueForm" action="{{route('revenue.destroy',$revenue->id)}}" method="post">
  @csrf
  @method('DELETE')
</form>
@endif

@endsection
