@extends('layouts.kpc')

@section('content')
<!-- /inner_content-->
    <div class="inner_content">
      <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
          <div class="w3l_agileits_breadcrumbs_inner">
            <ul>
              <li><a href="/home">Home</a> <span>«</span></li>
              <li class="text-capitalize"><a href="/dept-registration/{{$dept->id}}">{{$dept->name}}</a> <span>«</span></li>
              <li class="text-capitalize"><a href="/product-registration">All products</a> <span>«</span></li>
              <li class="text-capitalize">New product</li>
            </ul>
          </div>
        </div>
<!--/forms-->
<div class="forms-main_agileits">


  <!--/forms-inner-->
      <div class="forms-inner">


         <!--/set-3-->

          <div class="wthree_general">

            <h4 class="text-capitalize text-bold mt-1">Product Registration </h4>
            <h4 class="mt-1 mb-1">Fill in all required fields <span class="text-danger">*</span> </h4>
            @if( count($errors) )
              <h4 class="text-capitalize mb-1 mt-1 red-text">There are some errors, please correct them first.</h4>
            @endif

               @component( 'components.confirm-modal',[ 'formId' => 'ProdForm', 'heading' => 'Product datails', 'message' => 'Are you sure you want to save product details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )@endcomponent

               <div class="row">
                 <div class="col-sm-12">
                   <a class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal" title="Save product"><span class="fa fa-save"></span> Save</a>
                 </div>
               </div>

               <form class="form-horizontal" id="ProdForm" action="{{route('product-registration.store')}}" method="post" enctype="multipart/form-data">
                 @csrf

                 @component( 'components.prod-reg-form')@endcomponent
                 <input type="hidden" name="dept_id" value="{{$dept->id}}">

               </form>



               <div class="row">
                 <div class="col-sm-12">
                   <a class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#confirmModal" title="Save product"><span class="fa fa-save"></span> Save</a>
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
