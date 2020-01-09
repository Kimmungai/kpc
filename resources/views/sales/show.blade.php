@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a> <span>«</span></li>
                  @if( isset($sale->Dept) )
                  <li class="text-capitalize"><a href="/dept-registration/{{$sale->Dept->id}}">{{$sale->Dept->name}}</a> <span>«</span></li>
                  @endif
									<li><a href="{{route('sale.index')}}">Sales</a> <span>«</span></li>
                  <li>Sale-@if(isset($sale)){{$sale->id}} @endif</li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




						<div class="row">
							@if( isset($dept) )
							<h1 class="text-capitalize ">{{$dept->name}} Purchase-@if(isset($sale)){{$sale->id}} @endif </h1>
							@endif
						</div>
						<div class="alert alert-danger alert-dismissible @if(!$errors->has('amountPaid')) hidden @endif" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5>Please enter a valid number when making payments!</h5>
						</div>

						<!--buttons-->
						<div class="row mt-2">
							<!--<div class="col-xs-6">
								<a href="{{route('sale.edit',$sale->id)}}" class="btn btn-sm btn-default btn-block" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>
							</div>-->

							 @if( Auth::user()->type == 3 || Auth::user()->type == -1)
							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fa fa-warning"></span> Delete</a>
							</div>
							@endif
						</div>
						<!--end buttons-->

						<!--start purchase-show-->
						 @component('components.sale-show',['sale'=>$sale,'dept'=>$sale->Dept])@endcomponent
						<!--end purchase-show-->

						<!--buttons-->
						<div class="row mt-2">
							<!--<div class="col-xs-6">
								<a href="{{route('sale.edit',$sale->id)}}" class="btn btn-sm btn-default btn-block" title="Click to edit details"><span class="fa fa-edit"></span> Edit</a>
							</div>-->

							 @if( Auth::user()->type == 3 || Auth::user()->type == -1)
							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to permanently delete document" data-toggle="modal" data-target="#deleteConfirmModal"><span class="fas fa-warning"></span> Delete</a>
							</div>
							@endif
						</div>
						<!--end buttons-->


				</div>
		<!-- //inner_content-->
</div>

@if( Auth::user()->type == 3 || Auth::user()->type == -1)

@component( 'components.delete-confirm-modal',[ 'formId' => 'deleteSaleForm', 'closeBtn' => 'No', 'saveBtn' => 'Yes' ] ) @endcomponent
@component( 'components.sale-payment',['sale'=>$sale]) @endcomponent

<form class="d-none hidden" id="deleteSaleForm" action="{{route('sale.destroy',$sale->id)}}" method="post">
  @csrf
  @method('DELETE')
</form>

@endif

@endsection
