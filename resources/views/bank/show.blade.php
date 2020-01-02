@extends('layouts.kpc')

@section('content')

<!-- /inner_content-->
    <div class="inner_content">
      <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
          <div class="w3l_agileits_breadcrumbs_inner">
            <ul>
              <li><a href="/home">Home</a> <span>«</span></li>
              <li>Bank</li>
            </ul>
          </div>
        </div>

        <!-- /inner_content_w3_agile_info-->
       <div class="inner_content_w3_agile_info">

         <h4  class="mb-2 text-bold">Bank Details</h4>

         <div class="grid-1 graph-form agile_info_shadow">

           <div class="row">
             <div class="col-sm-12">
               <div class="bank-logo">
                 <img src="{{url('images/family-bank-logo-600px.png')}}" alt="{{$bank->name}}">
               </div>
             </div>
           </div>

           <div class="row mt-2 bank-acc">

             <div class="col-sm-4 mb-2">
               <h3>Available</h3>
               @if( isset($bankBal) )
               <div class="bal-btn">
                 <h4>Kes {{number_format($bankBal,2)}}</h4>
                 <!--<a href="#" class="btn btn-default btn-xs acc-edit-btn"><span class="fas fa-edit"></span> Edit</a>-->
               </div>
               @endif
             </div>

             <div class="col-sm-8 mb-2">
               <h3>Transactions</h3>

               <div class="row">

                 <div class="col-sm-6">
                   @if( isset($bookings) )
                   @if( count($bookings) )

                   <div class="resp-table "><!--Start Money in-->
                     <h5><span class="fa fa-circle text-success"></span>  Money in <small>(bookings)</small></h5>
                     <table >
                       <thead>
                         <tr>
                           <td>Amount</td>
                           <td>Client</td>
                           <td>Details</td>
                           <td>Date</td>
                         </tr>
                       </thead>
                       <tbody>

                         @foreach( $bookings as $booking )
                           <tr>
                             <td  data-label="Amount">KES {{number_format($booking->bookingAmountReceived,2)}}</td>
                             <td  data-label="Client"><a href="{{url('profile')}}/{{$booking->user_id}}">@if($booking->User){{$booking->User->name}}@endif</a></td>
                             <td  data-label="Details">Money in </td>
                             <td>{{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans() }}</td>
                           </tr>
                         @endforeach

                       </tbody>
                       @if(isset($totals['booking']))
                       <tfoot>
                         <td>KES {{number_format($totals['booking'],2)}}</td>
                       </tfoot>
                       @endif

                     </table>
                     {{$bookings->links()}}
                  </div><!--End Money in-->
                  @endif
                  @endif
                 </div>

                 <div class="col-sm-6">
                   @if( isset($sales) )
                   @if( count($sales) )

                   <div class="resp-table "><!--Start Money in-->
                     <h5><span class="fa fa-circle text-success"></span>  Money in <small>(sales)</small></h5>
                     <table >
                       <thead>
                         <tr>
                           <td>Amount</td>
                           <td>Client</td>
                           <td>Details</td>
                           <td>Date</td>
                         </tr>
                       </thead>
                       <tbody>

                         @foreach( $sales as $sale )
                           <tr>
                             <td  data-label="Amount">KES {{number_format($sale->saleAmountReceived,2)}}</td>
                             <td  data-label="Client"><a href="{{url('profile')}}/{{$sale->user_id}}">@if($sale->User){{$sale->User->name}}@endif</a></td>
                             <td  data-label="Details">Money in </td>
                             <td>{{ \Carbon\Carbon::parse($sale->created_at)->diffForHumans() }}</td>
                           </tr>
                         @endforeach

                       </tbody>
                       @if(isset($totals['sales']))
                       <tfoot>
                         <td>KES {{number_format($totals['sales'],2)}}</td>
                       </tfoot>
                       @endif

                     </table>
                     {{$bookings->links()}}
                  </div><!--End Money in-->
                  @endif
                  @endif
                 </div>

                 <div class="col-sm-6">
                   @if( isset($revenues) )
                   @if( count($revenues) )

                   <div class="resp-table "><!--Start Money in-->
                     <h5><span class="fa fa-circle text-success"></span>  Money in <small>(other revenues)</small></h5>
                     <table >
                       <thead>
                         <tr>
                           <td>Amount</td>
                           <td>Client</td>
                           <td>Details</td>
                           <td>Date</td>
                         </tr>
                       </thead>
                       <tbody>

                         @foreach( $revenues as $revenue )
                           <tr>
                             <td  data-label="Amount">KES {{number_format($revenue->total,2)}}</td>
                             <td  data-label="Client"><a href="{{url('profile')}}/{{$revenue->user_id}}">@if($revenue->User){{$revenue->User->name}}@endif</a></td>
                             <td  data-label="Details">Money in </td>
                             <td>{{ \Carbon\Carbon::parse($revenue->created_at)->diffForHumans() }}</td>
                           </tr>
                         @endforeach

                       </tbody>

                       @if(isset($totals['revenue']))
                       <tfoot>
                         <td>KES {{number_format($totals['revenue'],2)}}</td>
                       </tfoot>
                       @endif

                     </table>
                     {{$revenues->links()}}
                  </div><!--End Money in-->
                  @endif
                  @endif
                 </div>
               </div>

               <div class="row">
                 <div class="col-sm-6">
                   @if( isset($purchases) )
                   @if( count($purchases) )
                   <div class="resp-table "><!--Start Money out-->
                     <h5><span class="fa fa-circle text-danger"></span> Money out <small>(purchases)</small></h5>
                     <table >
                       <thead>
                         <tr>
                           <td>Amount</td>
                           <td>Client</td>
                           <td>Details</td>
                           <td>Date</td>
                         </tr>
                       </thead>
                       <tbody>

                         @foreach( $purchases as $purchase )
                           <tr>
                             <td  data-label="Amount">KES {{number_format($purchase->amountPaid,2)}}</td>
                             <td  data-label="Client"><a href="{{url('profile')}}/{{$purchase->user_id}}">@if($purchase->User){{$purchase->User->name}}@endif</a></td>
                             <td  data-label="Details">Money out </td>
                             <td>{{ \Carbon\Carbon::parse($purchase->created_at)->diffForHumans() }}</td>
                           </tr>
                         @endforeach

                       </tbody>

                       @if(isset($totals['purchase']))
                       <tfoot>
                         <td>KES {{number_format($totals['purchase'],2)}}</td>
                       </tfoot>
                       @endif

                     </table>
                     {{$purchases->links()}}
                  </div><!--End Money out-->
                  @endif
                  @endif
                 </div>

                 <div class="col-sm-6">
                   @if( isset($expenses) )
                   @if( count($expenses) )
                   <div class="resp-table "><!--Start Money out-->
                     <h5><span class="fa fa-circle text-danger"></span> Money out <small>(other expenses)</small></h5>
                     <table >
                       <thead>
                         <tr>
                           <td>Amount</td>
                           <td>Client</td>
                           <td>Details</td>
                           <td>Date</td>
                         </tr>
                       </thead>
                       <tbody>

                         @foreach( $expenses as $expense )
                           <tr>
                             <td  data-label="Amount">KES {{number_format($expense->total,2)}}</td>
                             <td  data-label="Client"><a href="{{url('profile')}}/{{$expense->user_id}}">@if($expense->User){{$expense->User->name}}@endif</a></td>
                             <td  data-label="Details">Money out </td>
                             <td>{{ \Carbon\Carbon::parse($expense->created_at)->diffForHumans() }}</td>
                           </tr>
                         @endforeach

                       </tbody>

                       @if(isset($totals['expense']))
                       <tfoot>
                         <td>KES {{number_format($totals['expense'],2)}}</td>
                       </tfoot>
                       @endif

                     </table>
                     {{$expenses->links()}}
                  </div><!--End Money out-->
                  @endif
                  @endif
                 </div>

               </div>




             </div>

           </div>

         </div>

       </div>
      <!-- //inner_content-->
</div>



@endsection
