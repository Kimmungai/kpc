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
                  <li>Purchase-@if(isset($purchase)){{$purchase->id}} @endif</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Purchase-@if(isset($purchase)){{$purchase->id}} @endif </h1>
							@endif
						</div>
						<div class="alert alert-danger alert-dismissible @if(!$errors->has('amountPaid')) hidden @endif" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5>Please enter a valid number when making payments!</h5>
						</div>

						<!--buttons-->
						<div class="row mt-2">
							<div class="col-xs-3">
								<a href="{{route('purchases-registration.edit',$purchase->id)}}" class="btn btn-sm btn-default btn-block" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email" onclick="share_doc('/share-purchase',{{$purchase->id}})"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-3">
								<a href="{{url('download-purchase')}}/{{$purchase->id}}" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>
							 @if( Auth::user()->type == 3 || Auth::user()->type == -1)
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							</div>
							@endif
						</div>
						<!--end buttons-->

						<!--start purchase-show-->
						 @component('components.purchase-show',['purchase'=>$purchase,'dept'=>$dept])@endcomponent
						<!--end purchase-show-->

						<!--buttons-->
						<div class="row mt-2">
							<div class="col-xs-3">
								<a href="{{route('purchases-registration.edit',$purchase->id)}}" class="btn btn-sm btn-default btn-block" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>
							</div>
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email" onclick="share_doc('/share-purchase',{{$purchase->id}})"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-3">
								<a href="{{url('download-purchase')}}/{{$purchase->id}}" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>
							@if( Auth::user()->type == 3 || Auth::user()->type == -1)
							<div class="col-xs-3">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							</div>
							@endif
						</div>
						<!--end buttons-->


				</div>
		<!-- //inner_content-->
</div>

@if( Auth::user()->type == 3 || Auth::user()->type == -1)

@component( 'components.delete-confirm-modal',[ 'formId' => 'deletePurchaseForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] ) @endcomponent
@component( 'components.purchase-payment',['purchase'=>$purchase]) @endcomponent

<form class="d-none hidden" id="deletePurchaseForm" action="{{route('purchases-registration.destroy',$purchase->id)}}" method="post">
  @csrf
  @method('DELETE')
</form>

@endif

@endsection
