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
              <li class="text-capitalize"><a href="/product-registration">All products</a> <span>«</span></li>
              <li class="text-capitalize">Requisition type</li>
            </ul>
          </div>
        </div>
<!--/forms-->
<div class="forms-main_agileits">


  <!--/forms-inner-->
      <div class="forms-inner">


         <!--/set-3-->

          <div class="wthree_general">

            <h3 class="text-capitalize text-center mt-1">Please select a requisition type below </h3>

            <div class="row">

              <div class="col-sm-6">
                <div class="prod-reg-type">
                  <h3>Register product in department</h3>
                  <p>Use this option to register products produced within the department</p>
                  <a href="{{route('product-registration.create')}}" class="btn btn-default  center-block"> <span class="fa fa-check-circle"></span> Use this option</a>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="prod-reg-type">
                  <h3>Fill in requisition form</h3>
                  <p>Use this option to send a requisition request to the administration</p>
                  <a href="{{route('requisition.create')}}" class="btn btn-default  center-block"> <span class="fa fa-check-circle"></span> Use this option</a>
                </div>
              </div>

             </div>


        </div>
        <!--//set-3-->

      </div>
    <!--//forms-inner-->
  </div>
<!--//forms-->
</div>
@endsection
