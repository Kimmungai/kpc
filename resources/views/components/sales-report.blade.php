<div class="doc-container">
  <h1>Sales Report</h1>

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
        @if(count($sales))
        <li><strong>Period</strong></li>

          <li>{{$StartDate}} <span class="fa fa-arrow-right"></span> {{$EndDate}}</li>
        @endif
      </ul>
    </div>

  </div>

  <hr />

  <div class="table-responsive mt-0">
    <table class="table">
    <thead class="purchase-thead">
        <tr>
            <th>Sale #</th>
            <th>Customer</th>
            <th>Department</th>
            <th>Due</th>
            <th>Received</th>
            <th>Outstanding</th>
        </tr>
    </thead>
    <tbody>
      <?php $totalReceived = 0; ?>
      <?php $amtDueTotal = 0; ?>
      <?php $outstandingTotal = 0; ?>

      @foreach( $sales as $item )
      <tr>
      <td><a href="{{route('sale.show',$item->id)}}" title="View sale details">{{$item->id}}</a></td>
      <td><a href="/profile/@if($item->user){{$item->user->id}}@endif" title="View customer details">@if($item->user){{$item->user->name}}@endif</a></td>
      @if( $item->dept )
      <td>{{$item->dept->name}}</td>
      @else
      <td>-</td>
      @endif
      <td>KES {{number_format($item->saleAmountDue,2)}}</td>
      <td>KES {{number_format($item->saleAmountReceived,2)}}</td>
      <td >KES {{number_format(abs($item->saleAmountDue - $item->saleAmountReceived),2)}}</td>
      </tr>

      <?php $totalReceived += $item->saleAmountReceived; ?>
      <?php $amtDueTotal += $item->saleAmountDue; ?>
      <?php $outstandingTotal += abs($item->saleAmountDue - $item->saleAmountReceived); ?>

      @endforeach

    </tbody>

    <tfoot>
      <tr>
        <td colspan="3" class="text-right text-uppercase">Grand total:</td>
        <td><strong>KES. {{number_format($amtDueTotal,2)}}</strong></td>
        <td><strong>KES. {{number_format($totalReceived,2)}}</strong></td>
        <td><strong>KES. {{number_format($outstandingTotal,2)}}</strong></td>
      </tr>
    </tfoot>
</table>

  </div>

</div>
