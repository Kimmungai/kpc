<div class="doc-container">
  <h1>Procurement Report</h1>

  <div class="row mt-2">

    <div class="col-xs-8">
      <ul>
        <li>Kitui Pastoral center</li>
        <li>P.O. BOX 300-90200 KITUI, TEL: 044-442228555</li>
        <li>All departments</li>
      </ul>

      <ul class="mt-2">
        <li>Date: {{date('d-M-Y',time())}}</li>
      </ul>
    </div>

    <div class="col-xs-4">
      <ul>
        @if(count($purchases))
        <li><strong>Period</strong></li>
        <li>{{$StartDate}} <span class="fa fa-arrow-right"></span> {{$EndDate}} </li>
        @endif
      </ul>
    </div>

  </div>

  <hr />

  <div class="table-responsive mt-0">
    <table class="table">
    <thead class="purchase-thead">
        <tr>
            <th>Supplier</th>
            <th>Date</th>
            <th>Amount Owed</th>
            <th>Amount Paid</th>
            <th>Outstanding</th>
        </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      <?php $amtPaidTotal = 0; ?>
      <?php $outstandingTotal = 0; ?>

      @foreach( $purchases as $purchase )
      <tr >
      <td> <a href="{{route('user-registration.edit',$purchase->user->id)}}" title="Open {{$purchase->user->firstName}}'s record"> {{$purchase->user->firstName}}</a></td>

      <td>{{date('d-M-Y',strtotime($purchase->created_at))}}</td>
      <td>@if( is_numeric($purchase->amountDue) ) {{number_format($purchase->amountDue,2)}}@endif</td>
      <td >@if( is_numeric($purchase->amountPaid) ){{number_format($purchase->amountPaid,2)}} @endif</td>
      <td >@if( is_numeric($purchase->amountPaid) && is_numeric($purchase->amountDue) ) {{number_format($purchase->amountDue - $purchase->amountPaid,2)}} @endif</td>
      </tr>
      @if( is_numeric($purchase->amountDue) )
      <?php $total += $purchase->amountDue; ?>
      @endif
      @if( is_numeric($purchase->amountPaid) )
      <?php $amtPaidTotal += $purchase->amountPaid; ?>
      @endif
      @if( is_numeric($purchase->amountPaid) && is_numeric($purchase->amountDue) )
      <?php $outstandingTotal += ($purchase->amountDue - $purchase->amountPaid); ?>
      @endif
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="2" class="text-right text-uppercase">Grand total:</td>
        <td><strong>Ksh. {{number_format($total,2)}}</strong></td>
        <td><strong>Ksh. {{number_format($amtPaidTotal,2)}}</strong></td>
        <td><strong>Ksh. {{number_format($outstandingTotal,2)}}</strong></td>

      </tr>
    </tfoot>
</table>

  </div>

</div>
