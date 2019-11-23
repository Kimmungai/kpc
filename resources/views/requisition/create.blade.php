@extends('layouts.kpc')

@section('content')
<!-- /inner_content-->
    <div class="inner_content">
      <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
          <div class="w3l_agileits_breadcrumbs_inner">
            <ul>
              <li><a href="/home">Home</a> <span>«</span></li>
              <li><a href="#">Requisition Form</a> </li>
            </ul>
          </div>
        </div>

        <!-- /inner_content_w3_agile_info-->
       <div class="inner_content_w3_agile_info">



         <div class="row mb-1">
           <div class="col-sm-12">
             <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#confirmModal" title="Submit requisition form" ><span class="fa fa-paper-plane"></span> Send request</button>
           </div>
         </div>


      <form id="requisitionForm"  action="{{route('requisition.store')}}" method="post" onsubmit="req_num_rows()">
        @csrf
         <article class="requisition-form">

           <header>
               <div class="row">
                 <div class="col-sm-4">
                   <ul>
                     <li>
                       <span id="req-company-name" onclick="toggleShow('req-company-name','req-company-name-edit')">{{env('APP_NAME','Company name')}}</span>
                       @component( 'components.requisition-edit',['id1'=>'req-company-name','id2'=>'req-company-name-edit','name'=>'company_name','placeholder'=>'Company name','value'=>env('APP_NAME','Company name'),'hidden'=>true] )@endcomponent
                     </li>
                     <li>
                       <span id="req-company-addr" onclick="toggleShow('req-company-addr','req-company-addr-edit')">{{env('APP_ADDR','P.o Box 119 - 90200')}}</span>
                       @component( 'components.requisition-edit',['id1'=>'req-company-addr','id2'=>'req-company-addr-edit','name'=>'company_addr','placeholder'=>'Company address','value'=>env('APP_ADDR','P.o Box 119 - 90200'),'hidden'=>true] )@endcomponent
                     </li>
                     <li>
                       <span id="req-company-city" onclick="toggleShow('req-company-city','req-company-city-edit')">{{env('APP_CITY','Kitui, Kenya')}}</span>
                       @component( 'components.requisition-edit',['id1'=>'req-company-city','id2'=>'req-company-city-edit','name'=>'company_city','placeholder'=>'Company city','value'=>env('APP_CITY','Kitui, Kenya'),'hidden'=>true] )@endcomponent
                     </li>
                   </ul>
                 </div>
                 <div class="col-sm-8">
                   <h1>
                     <span id="req-doc-title" onclick="toggleShow('req-doc-title','req-doc-title-edit')">Requisition Form</span>
                     @component( 'components.requisition-edit',['id1'=>'req-doc-title','id2'=>'req-doc-title-edit','name'=>'doc_title','placeholder'=>'Title ..','value'=>'Requisition Form','hidden'=>true] )@endcomponent
                   </h1>
                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <div>
                     <strong>Supplier name:</strong>

                     <span id="req-supplier-name" class="th" onclick="toggleShow('req-supplier-name','req-supplier-name-edit')">name</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-name','id2'=>'req-supplier-name-edit','name'=>'supplier_name','placeholder'=>'Supplier name','value'=>'name','hidden'=>true] )@endcomponent
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div>
                     <strong>Requisition #:</strong>

                     <span id="req-number" class="th" onclick="toggleShow('req-number','req-number-edit')">745468</span>
                     @component( 'components.requisition-edit',['id1'=>'req-number','id2'=>'req-number-edit','name'=>'requisition_number','placeholder'=>'Requisition number','value'=>'745468','hidden'=>true] )@endcomponent
                   </div>
                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <div>
                     <strong>Address:</strong>
                     <span id="req-supplier-addr" class="th" onclick="toggleShow('req-supplier-addr','req-supplier-addr-edit')">P.o box 9 kitui</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-addr','id2'=>'req-supplier-addr-edit','name'=>'supplier_addr','placeholder'=>'Supplier address','value'=>'P.o box 9 kitui','hidden'=>true] )@endcomponent
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div>
                     <strong>Phone:</strong>
                     <span id="req-supplier-phone" class="th" onclick="toggleShow('req-supplier-phone','req-supplier-phone-edit')">0790643963</span>
                     @component( 'components.requisition-edit',['id1'=>'req-supplier-phone','id2'=>'req-supplier-phone-edit','name'=>'supplier_phone','placeholder'=>'Supplier phone','value'=>'0790643963','hidden'=>true] )@endcomponent
                   </div>
                 </div>
               </div>

           </header>

           <main class="mt-3">
             <div class="resp-table">
               <button type="button" class="btn btn-default btn-xs" onclick="add_prod_table_row('products-table')"><span class="fa fa-plus-circle"></span> add row</button>
               <table  id="products-table" >
                 <thead >
                   <tr>
                     <th></th>
                     <th>Item</th>
                     <th>Description</th>
                     <th>Sale price</th>
                     <th>Cost / unit</th>
                     <th>Quantity</th>
                     <th>Total Cost</th>
                   </tr>
                 </thead>
                 <tbody>

                   <tr id="row-1" data-row="1">
                     <td><span class="fas fa-times-circle" onclick="remove_table_row('row-1')"></span></td>
                     <td data-label="Item" >
                       <span id="col-1-1" data-col='1.1' class="hidden" onclick="toggleShow('col-1-1','col-1-1-edit')"></span>
                       @component( 'components.requisition-edit',['id1'=>'col-1-1','id2'=>'col-1-1-edit','name'=>'col-1-1','placeholder'=>'Item','value'=>'','hidden'=>false,'keyup'=>true] )@endcomponent
                     </td>
                     <td data-label="Description" >
                       <span id="col-1-2" data-col='1.2' class="hidden" onclick="toggleShow('col-1-2','col-1-2-edit')"></span>
                       @component( 'components.requisition-edit',['id1'=>'col-1-2','id2'=>'col-1-2-edit','name'=>'col-1-2','placeholder'=>'Description','value'=>'','hidden'=>false] )@endcomponent
                     </td>
                     <td data-label="Sale price" >
                       <span id="col-1-3" data-col='1.3' class="hidden" onclick="toggleShow('col-1-3','col-1-3-edit')"></span>
                       @component( 'components.requisition-edit',['id1'=>'col-1-3','id2'=>'col-1-3-edit','name'=>'col-1-3','placeholder'=>'Numbers only','value'=>'0','hidden'=>false,'numeric'=>true] )@endcomponent
                     </td>
                     <td data-label="Cost / unit" >
                       <span id="col-1-4" data-col='1.4' class="hidden" onclick="toggleShow('col-1-4','col-1-4-edit')"></span>
                       @component( 'components.requisition-edit',['id1'=>'col-1-4','id2'=>'col-1-4-edit','name'=>'col-1-4','placeholder'=>'Numbers only','value'=>'0','hidden'=>false,'numeric'=>true] )@endcomponent
                     </td>
                     <td data-label="Quantity" >
                       <span id="col-1-5" data-col='1.5' class="hidden" onclick="toggleShow('col-1-5','col-1-5-edit')"></span>
                       @component( 'components.requisition-edit',['id1'=>'col-1-5','id2'=>'col-1-5-edit','name'=>'col-1-5','placeholder'=>'Numbers only','value'=>'0','hidden'=>false,'numeric'=>true] )@endcomponent
                     </td>
                     <td data-label="Total Cost" >
                       <span id="col-1-6" data-col='1.6'  onclick="toggleShow('col-1-6','col-1-6-edit')"></span>
                       @component( 'components.requisition-edit',['id1'=>'col-1-6','id2'=>'col-1-6-edit','name'=>'col-1-6','placeholder'=>'','value'=>'','hidden'=>true,'numeric'=>true] )@endcomponent
                     </td>
                   </tr>

                 </tbody>
                 <tfoot>
                   <tr>
                     <td class="tfoot-hidden-cell" colspan="5"></td>
                     <td>Sub total</td>
                     <td><span id="req_subtotal">KES 0</span></td>
                     <input type="hidden" name="req_subtotal" value="">
                   </tr>
                   <tr >
                     <td class="tfoot-hidden-cell" colspan="5"></td>
                     <td>Vat
                       <small id="req-vat-percent" onclick="toggleShow('rreq-vat-percent','req-vat-percent-edit')">16</small><small>%</small>
                       @component( 'components.requisition-edit',['id1'=>'req-vat-percent','id2'=>'req-vat-percent-edit','name'=>'vat_percent','placeholder'=>'Vat value','value'=>'16','hidden'=>true] )@endcomponent
                     </td>
                     <td id="req-vat">KES 0</td>
                     <input type="hidden" name="vat_total" value="">
                   </tr>
                   <tr >
                     <td class="tfoot-hidden-cell" colspan="5"></td>
                     <td><strong>Total amount</strong></td>
                     <td><strong id="req_grandtotal">KES 0</strong></td>
                     <input type="hidden" name="req_grandtotal" value="">

                   </tr>
                 </tfoot>
               </table>

               <button type="button" class="btn btn-default btn-xs mt-2" onclick="add_prod_table_row('products-table')"><span class="fa fa-plus-circle"></span> add row</button>
               <p class="mt-2">Notes / comments:</p>
               <p id="comments-box" class="comments-box" onclick="toggleShow('comments-box','comments-box-edit')"></p>
               @component( 'components.requisition-edit',['id1'=>'comments-box','id2'=>'comments-box-edit','name'=>'description','placeholder'=>'Comments ...','value'=>'','hidden'=>true,'type'=>'textarea'] )@endcomponent

               <div class="row mt-2">
                 <div class="col-sm-6">
                   <p><strong>Request by:</strong> <span class="td">@if(Auth::check()) {{Auth::user()->name}} <input type="hidden" name="request_by" value="{{Auth::id()}}"> @endif</span> </p>
                 </div>
                 <div class="col-sm-6">
                   <p><strong>Date:</strong> <span class="td">{{date('d-M-Y')}}</span> </p>
                 </div>
               </div>

               <div class="row mt-1">
                 <div class="col-sm-6">
                   <p><strong>Approved by:</strong> <span class="td"></span> </p>
                 </div>
                 <div class="col-sm-6">
                   <p><strong>Date:</strong> <span class="td"></span> </p>
                 </div>
               </div>

            </div>
           </main>
           <input type="hidden" name="dept_id" id="currentDeptID" value="@if(isset($dept)) {{$dept->id}} @endif">
           <input type="hidden" name="no_products" value="">
         </article>
         @component( 'components.confirm-modal',[ 'formId' => 'requisitionForm', 'heading' => 'Requisition form', 'message' => 'Are you sure you want to sunmit requisition form?', 'closeBtn' => 'No ', 'saveBtn' => 'Yes' ] )@endcomponent

       </form>

         <div class="row mt-1">
           <div class="col-sm-12">
             <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#confirmModal" title="Submit requisition form"><span class="fa fa-paper-plane"></span> Send request</button>
           </div>
         </div>


       </div>
      <!-- //inner_content-->
</div>
@endsection
