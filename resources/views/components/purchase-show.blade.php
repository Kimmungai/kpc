<div class="doc-container">
  <h1>Purchase details</h1>

  <div class="row mt-2">

    <div class="col-xs-8">
      <ul>
        <li>Kitui Pastoral center</li>
        <li>{{$dept->name}} department</li>
      </ul>

      <ul class="mt-2">
        <li>Date: {{date('d-M-Y',strtotime($purchase->created_at))}}</li>
        <li>Serial: {{$purchase->id}}</li>
      </ul>
    </div>

    <div class="col-xs-4">
      <ul>
        <li><strong>Supplier @if( $purchase->amountDue - $purchase->amountPaid <= 0 ) <span class="fa fa-circle text-success"></span> @else <span class="fa fa-circle text-danger"></span> @endif</strong></li>
        <li><small>{{$purchase->user->firstName}} {{$purchase->user->lastName}}</small></li>
        <li><small>{{$purchase->user->email}}</small></li>
        <li><small>{{$purchase->user->phoneNumber}}</small></li>
        <li><small>Paid: @if(is_numeric($purchase->amountPaid)) Ksh. {{number_format($purchase->amountPaid,2)}} @endif</small></li>
        <li><small>Owed:@if(is_numeric($purchase->amountPaid)) Ksh. {{number_format($purchase->amountDue,2)}} @endif</small></li>
      </ul>
    </div>

  </div>

  <hr />

  <div class="table-responsive mt-0">
    <table class="table">
    <thead class="purchase-thead">
        <tr>
            <th>SKU</th>
            <th>NAME</th>
            <th>Quantity Supplied</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      @foreach( $purchase->expense as $expense )
      <tr >
      <td>{{$expense->product->sku}}</td>
      <td>{{$expense->product->name}}</td>
      <td >{{$expense->suppliedQuantity}}</td>
      <td >{{$expense->cost}}</td>
      </tr>
      <?php $total += $expense->cost; ?>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="3" class="text-right text-uppercase">Grand total:</td>
        <td><strong>Ksh. {{number_format($total,2)}}</strong></td>
      </tr>
    </tfoot>
</table>

  </div>

</div>
