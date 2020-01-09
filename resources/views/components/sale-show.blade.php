<div class="doc-container">
  <h1>Sale-{{$sale->id}} details</h1>

  <div class="row mt-2">

    <div class="col-xs-8">
      <ul>
        <li>Kitui Pastoral center</li>
        <li>{{$dept->name}} department</li>
      </ul>

      <ul class="mt-2">
        <li>Date: {{date('d-M-Y',strtotime($sale->created_at))}}</li>
        <li>Serial: {{$sale->id}}</li>
      </ul>
    </div>

    <div class="col-xs-4">
      <ul>
        <li><strong>Customer @if( $sale->saleAmountDue - $sale->saleAmountReceived <= 0 ) <span class="text-success">PAID</span> @else <span class="text-danger">PENDING</span> @endif</strong></li>
        <li><small>{{$sale->user->firstName}} {{$sale->user->lastName}}</small></li>
        <li><small>{{$sale->user->email}}</small></li>
        <li><small>{{$sale->user->phoneNumber}}</small></li>
        @if( !$sale->paid )
        <li><small>Paid: Ksh. {{number_format($sale->saleAmountReceived,2)}}</small></li>
        <li><small>Due:  Ksh. {{number_format(($sale->saleAmountDue - $sale->saleAmountReceived),2)}} @if(!$sale->paid)<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#salePaymentModal">Receive payment</button>@endif</small></li>
        <li><small>Pending:Ksh. {{number_format($sale->saleAmountDue-$sale->saleAmountPaid,2)}}</small></li>
        @endif
      </ul>
    </div>

  </div>

  <hr />

  <div class="resp-table mt-0 show-sale-table">
    <table class="table">
    <thead>
        <tr>
            <th>NAME</th>
            <th>Quantity Sold</th>
            <th>Unit price</th>
            <th>Total price</th>
        </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      @foreach( $sale->Revenue as $revenue )
      <tr >
      <td>{{$revenue->product->name}}</td>
      <td >{{$revenue->bookedQuantity}}</td>
      <td >KES. {{number_format($revenue->price,2)}}</td>
      <td >KES. {{number_format($revenue->total,2)}}</td>
      </tr>
      <?php $total += $revenue->total; ?>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="3" class="text-right text-uppercase">Grand total:</td>
        <td><strong>KES. {{number_format($total,2)}}</strong></td>
      </tr>
    </tfoot>
</table>

  </div>

</div>
