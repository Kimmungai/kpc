@extends('layouts.kpc')

@section('content')
<!-- /inner_content-->
    <div class="inner_content">
      <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
          <div class="w3l_agileits_breadcrumbs_inner">
            <ul>
              <li><a href="/home">Home</a> <span>«</span></li>
              <li><a href="{{route('requisition.index')}}">All Requisition Requests</a> <span>«</span></li>
              <li>Requisition Form</li>
            </ul>
          </div>
        </div>

        <!-- /inner_content_w3_agile_info-->
       <div class="inner_content_w3_agile_info">


        @if( Auth::user()->type != 1 )
         <div class="row mb-1">
           <div class="col-sm-12">
             <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#confirmModal" title="Submit requisition form" ><span class="fa fa-paper-plane"></span> Update</button>
           </div>
         </div>
         @endif

         <!--error alert-->
         <div id="requisitionFormAlert" class="requisitionFormAlert alert alert-danger alert-dismissible hidden" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h3>The form has errors. Please ensure you have:</h3>
           <ol>
             <li>Typed the name of each item</li>
             <li>Typed a sale price greater than 0 for each item</li>
             <li>Typed a cost price greater than 0 for each item</li>
             <li>Typed the quantity greater than 0 for each item</li>
           </ol>
         </div>
         <!--end error alert-->


      <form id="requisitionForm"  action="{{route('requisition.update',$requisition->id)}}" method="post" onsubmit="req_num_rows()">
        @csrf
        @method('PUT')
         <article class="requisition-form">

           <header>
               <div class="row">
                 <div class="col-sm-4">
                   <ul>
                     <li>
                       <span id="req-company-name" onclick="toggleShow('req-company-name','req-company-name-edit')">{{$requisition->company_name}}</span>
                       @component( 'components.requisition-edit',['id1'=>'req-company-name','id2'=>'req-company-name-edit','name'=>'company_name','placeholder'=>'Company name','value'=>$requisition->company_name,'hidden'=>true] )@endcomponent
                     </li>
                     <li>
                       <span id="req-company-addr" onclick="toggleShow('req-company-addr','req-company-addr-edit')">{{$requisition->company_addr}}</span>
                       @component( 'components.requisition-edit',['id1'=>'req-company-addr','id2'=>'req-company-addr-edit','name'=>'company_addr','placeholder'=>'Company address','value'=>$requisition->company_addr,'hidden'=>true] )@endcomponent
                     </li>
                     <li>
                       <span id="req-company-city" onclick="toggleShow('req-company-city','req-company-city-edit')">{{$requisition->company_city}}</span>
                       @component( 'components.requisition-edit',['id1'=>'req-company-city','id2'=>'req-company-city-edit','name'=>'company_city','placeholder'=>'Company city','value'=>$requisition->company_city,'hidden'=>true] )@endcomponent
                     </li>
                   </ul>
                 </div>
                 <div class="col-sm-8">
                   <h1>
                     <span id="req-doc-title" onclick="toggleShow('req-doc-title','req-doc-title-edit')">{{$requisition->doc_title}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-doc-title','id2'=>'req-doc-title-edit','name'=>'doc_title','placeholder'=>'Title ..','value'=>$requisition->doc_title,'hidden'=>true] )@endcomponent
                   </h1>


                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <div>
                     <strong>Supplier name:</strong>

                     <span id="req-supplier-name" class="th" onclick="toggleShow('req-supplier-name','req-supplier-name-edit')">{{$requisition->supplier_name}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-name','id2'=>'req-supplier-name-edit','name'=>'supplier_name','placeholder'=>'Supplier name','value'=>$requisition->supplier_name,'hidden'=>true] )@endcomponent
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div>
                     <strong>Requisition #:</strong>

                     <span id="req-number" class="th" onclick="toggleShow('req-number','req-number-edit')">{{$requisition->requisition_number}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-number','id2'=>'req-number-edit','name'=>'requisition_number','placeholder'=>'Requisition number','value'=>$requisition->requisition_number,'hidden'=>true] )@endcomponent
                   </div>
                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <div>
                     <strong>Email:</strong>
                     <span id="req-supplier-email" class="th" onclick="toggleShow('req-supplier-email','req-supplier-email-edit')">{{$requisition->supplier_email}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-email','id2'=>'req-supplier-email-edit','name'=>'supplier_email','placeholder'=>'Email address','value'=>$requisition->supplier_email,'hidden'=>true] )@endcomponent
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div>
                     <strong>Phone:</strong>
                     <span id="req-supplier-phone" class="th" onclick="toggleShow('req-supplier-phone','req-supplier-phone-edit')">{{$requisition->supplier_phone}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-phone','id2'=>'req-supplier-phone-edit','name'=>'supplier_phone','placeholder'=>'Supplier phone','value'=>$requisition->supplier_phone,'hidden'=>true] )@endcomponent
                   </div>
                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <div>
                     <strong>Address:</strong>
                     <span id="req-supplier-addr" class="th" onclick="toggleShow('req-supplier-addr','req-supplier-addr-edit')">{{$requisition->supplier_addr}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-addr','id2'=>'req-supplier-addr-edit','name'=>'supplier_addr','placeholder'=>'Supplier address','value'=>$requisition->supplier_addr,'hidden'=>true] )@endcomponent
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div>
                     <strong>Organisation:</strong>
                     <span id="req-supplier-org" class="th" onclick="toggleShow('req-supplier-org','req-supplier-org-edit')">{{$requisition->supplier_org}}</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-org','id2'=>'req-supplier-org-edit','name'=>'supplier_org','placeholder'=>'Organisation','value'=>$requisition->supplier_org,'hidden'=>true] )@endcomponent
                   </div>
                 </div>
               </div>

               <div class="row mt-1">

                 <div class="col-sm-6">
                   <div id="req-goods-supplied-html">

                     @if( !$requisition->goods_received )
                     <strong>Goods received?</strong>
                     <label class="switch-xs">
                       <input id="req-goods-received-{{$requisition->id}}" type="checkbox"  @if( $requisition->goods_received ) checked @endif onchange="req_open_modal( 'receiveGoodsModal' )" @if( !$requisition->approval_status ) disabled @endif>
                       <span class="slider-xs round"></span>

                     </label>
                     @else
                      <strong>Goods received:</strong>
                      <span class="text-success">Supplied</span>
                     @endif

                   </div>
                 </div>

                 <div class="col-sm-6">
                   <div>
                     <strong>Approval:</strong>

                     @if( Auth::user()->type == 1 )
                       @if( $requisition->approval_status ) <span class="text-success">Approved</span> @else <span class="text-danger">Rejected</span>@endif
                     @else
                     <label class="switch-xs">
                       <input id="req-approval-{{$requisition->id}}" type="checkbox"  @if( $requisition->approved_by ) checked @endif onchange="requisition_approval_change({{$requisition->id}})">
                       <span class="slider-xs round"></span>

                     </label>
                     @endif

                   </div>
                 </div>

               </div>

               <input type="hidden" id="supplier_id" name="supplier_id" value="{{$requisition->supplier_id}}">


           </header>

           <main class="mt-3">
             <div class="resp-table">
               <button type="button" class="btn btn-default btn-xs" onclick="add_prod_table_row('products-table')"><span class="fa fa-plus-circle"></span> add row</button>
               <table  id="products-table">
                 <thead >
                   <tr>
                     <th></th>
                     <th>Item</th>
                     <th>Description</th>
                     <th>Sale price</th>
                     <th>Cost / unit</th>
                     <th>Quantity</th>
                     <th>Measurement</th>
                     <th>Total Cost</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php $count = 1; ?>

                   @foreach( $requisition->RequisitionProducts as $product )
                   <tr id="row-{{$count}}" data-row="{{$count}}">
                     <td><span class="fas fa-times-circle" onclick="remove_table_row('row-{{$count}}')"></span></td>
                     <td data-label="Item" >
                       <span id="col-{{$count}}-1" data-col='{{$count}}.1'  onclick="toggleShow('col-{{$count}}-1','col-{{$count}}-1-edit')">{{$product->name}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-1','id2'=>'col-'.$count.'-1-edit','name'=>'col-'.$count.'-1','placeholder'=>'Item','value'=>$product->name,'hidden'=>true,'keyup'=>true] )@endcomponent
                     </td>
                     <td data-label="Description" >
                       <span id="col-{{$count}}-2" data-col='{{$count}}.2'  onclick="toggleShow('col-{{$count}}-2','col-{{$count}}-2-edit')">{{$product->description}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-2','id2'=>'col-'.$count.'-2-edit','name'=>'col-'.$count.'-2','placeholder'=>'Description','value'=>$product->description,'hidden'=>true] )@endcomponent
                     </td>
                     <td data-label="Sale price" >
                       <span id="col-{{$count}}-3" data-col='{{$count}}.3'  onclick="toggleShow('col-{{$count}}-3','col-{{$count}}-3-edit')">{{$product->price}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-3','id2'=>'col-'.$count.'-3-edit','name'=>'col-'.$count.'-3','placeholder'=>'Numbers only','value'=>$product->price,'hidden'=>true,'numeric'=>true] )@endcomponent
                     </td>
                     <td data-label="Cost / unit" >
                       <span id="col-{{$count}}-4" data-col='{{$count}}.4'  onclick="toggleShow('col-{{$count}}-4','col-{{$count}}-4-edit')">{{$product->cost}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-4','id2'=>'col-'.$count.'-4-edit','name'=>'col-'.$count.'-4','placeholder'=>'Numbers only','value'=>$product->cost,'hidden'=>true,'numeric'=>true] )@endcomponent
                     </td>
                     <td data-label="Quantity" >
                       <span id="col-{{$count}}-5" data-col='{{$count}}.5'  onclick="toggleShow('col-{{$count}}-5','col-{{$count}}-5-edit')">{{$product->quantity}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-5','id2'=>'col-'.$count.'-5-edit','name'=>'col-'.$count.'-5','placeholder'=>'Numbers only','value'=>$product->quantity,'hidden'=>true,'numeric'=>true] )@endcomponent
                     </td>
                     <td data-label="Measurement" >
                       <span id="col-{{$count}}-6" data-col='{{$count}}.6'  onclick="toggleShow('col-{{$count}}-6','col-{{$count}}-6-edit')">{{$product->unitsOfMeasure}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-6','id2'=>'col-'.$count.'-6-edit','name'=>'col-'.$count.'-6','placeholder'=>'','value'=>$product->unitsOfMeasure,'hidden'=>true,'numeric'=>false] )@endcomponent
                     </td>
                     <td data-label="Total Cost" >
                       <span id="col-{{$count}}-7" data-col='{{$count}}.7'  onclick="toggleShow('col-{{$count}}-7','col-{{$count}}-7-edit')">KES {{number_format($product->totalCost,2)}}</span>
                       @component( 'components.requisition-edit',['id1'=>'col-'.$count.'-7','id2'=>'col-'.$count.'-7-edit','name'=>'col-'.$count.'-7','placeholder'=>'','value'=>$product->totalCost,'hidden'=>true,'numeric'=>true] )@endcomponent
                     </td>
                   </tr>

                   <?php $count++ ?>

                   @endforeach

                 </tbody>
                 <tfoot>
                   <tr>
                     <td class="tfoot-hidden-cell" colspan="6"></td>
                     <td>Sub total</td>
                     <td><span id="req_subtotal">KES {{number_format($requisition->req_subtotal,2)}}</span></td>
                     <input type="hidden" name="req_subtotal" value="{{$requisition->req_subtotal}}">
                   </tr>
                   <tr >
                     <td class="tfoot-hidden-cell" colspan="6"></td>
                     <td>Vat
                       <small id="req-vat-percent" onclick="toggleShow('rreq-vat-percent','req-vat-percent-edit')">{{$requisition->vat_percent}}</small><small>%</small>
                       @component( 'components.requisition-edit',['id1'=>'req-vat-percent','id2'=>'req-vat-percent-edit','name'=>'vat_percent','placeholder'=>'Vat value','value'=>$requisition->vat_percent,'hidden'=>true] )@endcomponent
                     </td>
                     <td id="req-vat">KES {{number_format($requisition->vat_total,2)}}</td>
                     <input type="hidden" name="vat_total" value="{{$requisition->vat_total}}">
                   </tr>
                   <tr >
                     <td class="tfoot-hidden-cell" colspan="6"></td>
                     <td><strong>Total amount</strong></td>
                     <td><strong id="req_grandtotal">KES {{number_format($requisition->req_grandtotal,2)}}</strong></td>
                     <input type="hidden" name="req_grandtotal" value="{{$requisition->req_grandtotal}}">

                   </tr>
                 </tfoot>
               </table>

               <button type="button" class="btn btn-default btn-xs mt-2" onclick="add_prod_table_row('products-table')"><span class="fa fa-plus-circle"></span> add row</button>
               <p class="mt-2">Notes / comments:</p>
               <p id="comments-box" class="comments-box" onclick="toggleShow('comments-box','comments-box-edit')">{{$requisition->description}}</p>
               @component( 'components.requisition-edit',['id1'=>'comments-box','id2'=>'comments-box-edit','name'=>'description','placeholder'=>'Comments ...','value'=>$requisition->description,'hidden'=>true,'type'=>'textarea'] )@endcomponent

               <div class="row mt-2">
                 <div class="col-sm-6">
                   <p><strong>Request by:</strong> <span class="td">@if($requisition->user) {{$requisition->user->name}} <input type="hidden" name="request_by" value="{{$requisition->request_by}}"> @endif</span> </p>
                 </div>
                 <div class="col-sm-6">
                   <p><strong>Date:</strong> <span class="td">{{date('d-M-Y',strtotime($requisition->created_at))}}</span> </p>
                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <p><strong>Approved by:</strong> <span class="td">{{$requisition->approved_by_name}}</span> </p>
                   <input type="hidden" name="approved_by" value="{{$requisition->approved_by}}">
                 </div>
                 <div class="col-sm-6">
                   <p><strong>Date:</strong> <span class="td">{{date('d-M-Y',strtotime($requisition->approved_on))}}</span> </p>
                   <input type="hidden" name="approved_on" value="{{$requisition->approved_on}}">
                 </div>
               </div>

            </div>
           </main>
           <input type="hidden" name="dept_id" id="currentDeptID" value="@if(isset($dept)) {{$dept->id}} @endif">
           <input type="hidden" name="no_products" value="">
         </article>
         @component( 'components.confirm-modal',[ 'formId' => 'requisitionForm', 'heading' => 'Requisition form', 'message' => 'Are you sure you want to sunmit requisition form?', 'closeBtn' => 'No ', 'saveBtn' => 'Yes' ] )@endcomponent
       </form>

       @if( Auth::user()->type != 1 )
        <div class="row mt-1">
          <div class="col-sm-12">
            <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#confirmModal" title="Submit requisition form" ><span class="fa fa-paper-plane"></span> Update</button>
          </div>
        </div>
        @endif


       </div>
      <!-- //inner_content-->
</div>

<!-- Modal -->
<div class="modal fade" id="receiveGoodsModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
      <div class="modal-header">
          <h4 class="modal-title">Goods received</h4>
      </div>
      <div class="modal-body">
          <p>Are you sure you confirm all good in this LPO have been received?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="uncheck_checkbox( 'req-goods-received-{{$requisition->id}}' )">Cancel</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="requisition_goods_received( {{$requisition->id}} )">Yes, all goods received</button>
      </div>
    </div>
  </div>
</div>

@endsection
