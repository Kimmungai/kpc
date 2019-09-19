@extends('layouts.kpc')

@section('content')

		<!-- /inner_content-->
				<div class="inner_content">
					<!-- breadcrumbs -->
	          <div class="w3l_agileits_breadcrumbs">
	            <div class="w3l_agileits_breadcrumbs_inner">
	              <ul>
	                <li><a href="/home">Home</a> <span>«</span></li>
									<li><a href="/purchases-registration">Inventory report</a> </li>
	              </ul>
	            </div>
	          </div>
						<!-- /inner_content_w3_agile_info-->
				 <div class="inner_content_w3_agile_info">




					<div class="container" >



						<!--buttons-->
						<div class="row mt-2">

							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email" onclick="share_report('/share-inventory-report')"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-6">
								<form id="download-form" class="hidden" action="/download-inventory-report" method="get">
									<input type="hidden" name="duration_sort" value="@if(isset($_GET['duration_sort'])) {{$_GET['duration_sort']}} @endif">
									<input type="hidden" name="filter_from" value="@if(isset($_GET['filter_from'])) {{$_GET['filter_from']}} @endif" >
									<input type="hidden" name="filter_to"   value="@if(isset($_GET['filter_to'])) {{$_GET['filter_to']}} @endif">
								</form>
								<a href="#" class="btn btn-sm btn-default btn-block" onclick="event.preventDefault();document.getElementById('download-form').submit()" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>

						</div>
						<!--end buttons-->
						<!--sorting-->
							<div class="row mt-2">
								<form class="" action="/inventory-filtered-report" method="get">
								<div class="col-xs-2">
									<p style="line-height:40px">Sort:</p>
								</div>
								<div class="col-xs-3">
									<select class="duration_sort" id="duration_sort" class="form-control1" name="duration_sort" onchange="set_report_duration(this.value)">
										<option value="thisMonth" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'thisMonth' ) selected @endif @endif >This month</option>
										<option value="thisWeek" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'thisWeek' ) selected @endif @endif>This week</option>
										<option value="thisYear" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'thisYear' ) selected @endif @endif >This Year</option>
										<option value="today" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'today' ) selected @endif @endif >Today</option>
										<option value="dates" @if(isset($_GET['duration_sort'])) @if($_GET['duration_sort'] == 'dates' ) selected @endif @endif >Choose specific dates</option>
									</select>
								</div>
								<div id="specific-dates" class="specific-dates @if(isset($_GET['duration_sort']))  @if($_GET['filter_from']=='' && $_GET['filter_to']=='') d-none hidden  @endif @else d-none hidden @endif">
									<div class="col-xs-2">
										<input type="text" id="filter_from" name="filter_from" class="form-control1" value="@if(isset($_GET['filter_from'])) {{$_GET['filter_from']}} @endif"  onchange="clear_max_field('filter_to')" placeholder="Date from">
									</div>
									<div class="col-xs-1">
										<p style="line-height:40px">~</p>
									</div>
									<div class="col-xs-2">
										<input type="text" id="filter_to" name="filter_to" class="form-control1" value="@if(isset($_GET['filter_to'])) {{$_GET['filter_to']}} @endif" placeholder="Date to">
									</div>
							  </div>
								<div class="col-xs-2">
									<button type="submit" class="btn btn-xs btn-dark"><i class="fas fa-sort-amount-down"></i> Filter</button>
								</div>
								</form>
							</div>
						<!--end sorting-->

						<!--start purchase-show-->
						<?php $StartDate=''; $EndDate='';?>
						<?php $dt = \Carbon\Carbon::now(); ?>
						@if( isset($_GET['duration_sort']) )
							@if( $_GET['duration_sort'] == 'dates')
							<?php $StartDate=date('d-M-Y',strtotime($_GET['filter_from']));$EndDate=date('d-M-Y',strtotime($_GET['filter_to'])); ?>
							@elseif( $_GET['duration_sort'] == 'thisYear' )
							<?php $StartDate=date('d-M-Y',strtotime($dt->startOfYear()));$EndDate=date('d-M-Y',strtotime($dt->endOfYear())); ?>
							@elseif( $_GET['duration_sort'] == 'thisWeek' )
							<?php $StartDate=date('d-M-Y',strtotime($dt->startOfWeek()));$EndDate=date('d-M-Y',strtotime($dt->endOfWeek())); ?>
							@elseif( $_GET['duration_sort'] == 'today' )
							<?php $StartDate=date('d-M-Y',strtotime($dt->today()));$EndDate=date('d-M-Y',strtotime($dt->today())); ?>
							@endif
						@else
							<?php $StartDate=date('d-M-Y',strtotime($dt->startOfMonth()));$EndDate=date('d-M-Y',strtotime($dt->endOfMonth())); ?>
						@endif
	
            @component('components.inventory-report',['inventory'=>$inventory,'StartDate'=>$StartDate,'EndDate'=>$EndDate])@endcomponent
						<!--end purchase-show-->

						<!--buttons-->
						<div class="row mt-2">

							<div class="col-xs-6">
								<a href="#" class="btn btn-sm btn-default btn-block" title="Click to share document via email" onclick="share_report('/share-inventory-report')"><span class="fa fa-share-alt"></span> Share</a>
							</div>
							<div class="col-xs-6">
								<a href="#" onclick="event.preventDefault();document.getElementById('download-form').submit()" class="btn btn-sm btn-default btn-block" title="Click to save document to your computer"><span class="fa fa-download"></span> Download</a>
							</div>

						</div>
						<!--end buttons-->



					</div>

				</div>
		<!-- //inner_content-->
</div>

@endsection
