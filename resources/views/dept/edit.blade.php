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
              @if( isset($dept) )
              <li class="text-capitalize">{{$dept->name}} Edit Form</li>
              @endif
            </ul>
          </div>
        </div>
<!--/forms-->
<div class="forms-main_agileits">


  <!--/forms-inner-->
      <div class="forms-inner">


         <!--/set-3-->

          <div class="wthree_general">

            @if( count($errors) )
              <h3 class="w3_inner_tittle two red-text">There are some errors, please correct them first.</h3>
            @endif
             <h3 class="w3_inner_tittle two">@if( isset($dept) ) {{$dept->name}} @endif department Registration details </h3>


              <div class="grid-1 graph-form agile_info_shadow">

               @component( 'components.confirm-modal',[ 'formId' => 'DeptForm', 'heading' => 'Department datails', 'message' => 'Are you sure you want to update department details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please update' ] )

               @endcomponent

               @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteDeptForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

               @endcomponent

               <form class="form-horizontal" id="DeptForm" action="{{route('dept-registration.update',$dept->id)}}" method="post" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')

                 @component( 'components.dept-reg-form',['dept'=>$dept] )

                 @endcomponent




               </form>

               <form class="d-none hidden" id="deleteDeptForm" action="{{route('dept-registration.update',$dept->id)}}" method="post">
                 @csrf
                 @method('DELETE')
               </form>


          </div>
          
          <div class="button" data-toggle="modal" data-target="#confirmModal">
           <p class="btnText">Update?</p>
           <div class="btnTwo" style="background:green">
             <p class="btnText2">GO!</p>
           </div>
          </div>

          <div class="button" style="background:#d9534f;" data-toggle="modal" data-target="#deleteConfirmModal">
           <p class="btnText">Delete?</p>
           <div class="btnTwo">
             <p class="btnText2"><i class="fa fa-exclamation-triangle"></i></p>
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
