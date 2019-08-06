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
                  <li>Booking-@if(isset($booking)){{$booking->id}} @endif</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




					<div class="container" >
						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Booking-@if(isset($booking)){{$booking->id}} @endif </h1>
							@endif
						</div>

						<!--buttons-->
						<div class="row mt-2 mb-2">
							<div class="col-xs-3">
								<a href="{{route('bookings-registration.edit',$booking->id)}}" class="btn btn-sm btn-default btn-block" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							</div>
						</div>
						<!--end buttons-->

						<!--start purchase-show-->
						 @component('components.booking-show',['booking'=>$booking,'dept'=>$dept])@endcomponent
						<!--end purchase-show-->

						<!--buttons-->
						<div class="row mt-2 mb-2">
							<div class="col-xs-3">
								<a href="{{route('bookings-registration.edit',$booking->id)}}" class="btn btn-sm btn-default btn-block" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							</div>
						</div>
						<!--end buttons-->

					</div>

				</div>
		<!-- //inner_content-->
</div>
@component( 'components.delete-confirm-modal',[ 'formId' => 'deleteBookingForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

@endcomponent

<form class="d-none hidden" id="deleteBookingForm" action="{{route('bookings-registration.destroy',$booking->id)}}" method="post">
  @csrf
  @method('DELETE')
</form>
@endsection
