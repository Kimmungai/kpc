@extends('layouts.kpc')

@section('content')
<!-- /inner_content-->
    <div class="inner_content">
      <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
          <div class="w3l_agileits_breadcrumbs_inner">
            <ul>
              <li><a href="/home">Home</a> <span>«</span></li>
              <li>All Requisition Requests </li>
            </ul>
          </div>
        </div>

        <!-- /inner_content_w3_agile_info-->
       <div class="inner_content_w3_agile_info">

         <h4 class="text-bold text-capitalize">All requisition Requests</h4>
        @if( isset($requisitions) )

        <div class="row">
          <div class="col-sm-12">
            <div class="pagination pull-right">
              {{$requisitions->appends(request()->except('page'))->links()}}
            </div>
          </div>
        </div>

         <div class="row">
            @foreach( $requisitions as $requisition )
              <div class="col-sm-4 mb-2">
                <div class="action-tab ">
                    <dl>
                      <dt>
                        <a href="{{route('requisition.show',$requisition->id)}}" title="click to view details"><i class="fas fa-tasks"></i></a>
                      </dt>
                      <dd>
                        <h3><a href="{{route('requisition.show',$requisition->id)}}" title="click to view details">@if( $requisition->dept ) {{$requisition->dept->name}} @endif</a></h3>
                        <p class="text-underline">@if( $requisition->user ) By {{$requisition->user->name}} @endif</p>
                          <p><strong>{{count( $requisition->RequisitionProducts )}}</strong> @if( count( $requisition->RequisitionProducts ) > 1 ) items @else item @endif</p>
                          <p>Value: <strong>Ksh. {{$requisition->req_grandtotal}}</strong></p>
                          <p>
                            Approval:
                            @if( Auth::user()->type == 1 )
                              @if( $requisition->approval_status ) <span class="text-success">Approved</span> @else <span class="text-danger">Rejected</span>@endif
                            @else
                            <label class="switch-xs">
                              <input id="req-approval-{{$requisition->id}}" type="checkbox"  @if( $requisition->approved_by ) checked @endif onchange="requisition_approval_change({{$requisition->id}})">
                              <span class="slider-xs round"></span>

                            </label>
                            @endif

                          </p>
                        <a href="{{route('requisition.show',$requisition->id)}}" class="btn btn-x-sm  btn-default mt-1" title="click to view details"><span class="fa fa-eye"></span> Open</a>
                      <dd>
                    </dl>
                  </div>
              </div>
            @endforeach
         </div>

         <div class="row">
           <div class="col-sm-12">
             <div class="pagination pull-right">
               {{$requisitions->appends(request()->except('page'))->links()}}
             </div>
           </div>
         </div>

        @endif

       </div>
      <!-- //inner_content-->
</div>
@endsection
