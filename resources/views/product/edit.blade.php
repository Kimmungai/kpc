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
              <li class="text-capitalize">Product-{{$product->id}}</li>
            </ul>
          </div>
        </div>
<!--/forms-->
<div class="forms-main_agileits">


  <!--/forms-inner-->
      <div class="forms-inner">


         <!--/set-3-->

          <div class="wthree_general">


              <div class="grid-1 graph-form agile_info_shadow">
              @if( count($errors) )
                <h3 class="w3_inner_tittle two red-text">There are some errors, please correct them first.</h3>
              @endif
               <h3 class="w3_inner_tittle two">@if( isset($product) ) Product-{{$product->id}} @endif Registration details </h3>
               @component( 'components.confirm-modal',[ 'formId' => 'ProdForm', 'heading' => 'Product datails', 'message' => 'Are you sure you want to update product details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please update' ] )

               @endcomponent

               @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteProdForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

               @endcomponent

               <form class="form-horizontal" id="ProdForm" action="{{route('product-registration.update',$product->id)}}" method="post" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')

                 @component( 'components.prod-reg-form',['product'=>$product] )

                 @endcomponent


                 <div class="button" data-toggle="modal" data-target="#confirmModal">
                  <p class="btnText">Update?</p>
                  <div class="btnTwo" style="background:green">
                    <p class="btnText2">GO!</p>
                  </div>
                 </div>
                 
                 @if( Auth::user()->type == 3 || Auth::user()->type == -1)
                 <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
                  <p class="btnText">Delete?</p>
                  <div class="btnTwo">
                    <p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
                  </div>
                 </div>
                 @endif

               </form>

               <form class="d-none hidden" id="deleteProdForm" action="{{route('product-registration.update',$product->id)}}" method="post">
                 @csrf
                 @method('DELETE')
               </form>


          </div>
        </div>
        <!--//set-3-->

      </div>
    <!--//forms-inner-->
  </div>
<!--//forms-->
</div>
@endsection
