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
									<li><a href="/purchases-registration">Procurement report</a> </li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




					<div class="container" >



						<!--buttons-->
						<div class="row mt-2">

							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>

						</div>
						<!--end buttons-->
						<!--start purchase-show-->
            @component('components.purchases-report',['purchases'=>$purchases])@endcomponent
						<!--end purchase-show-->

						<!--buttons-->
						<div class="row mt-2">

							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>

						</div>
						<!--end buttons-->



					</div>

				</div>
		<!-- //inner_content-->
</div>

@endsection
