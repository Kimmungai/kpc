<div class="doc-container">
  <h1>Expenditure Report</h1>

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
        @if(count($expenses))
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
            <th>Expense #</th>
            <th>Supplier</th>
            <th>Department</th>
            <th>Qty supplied</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tbody>
      <?php $totalCost = 0; ?>

      @foreach( $expenses as $item )
      <tr>
      <td><a href="{{route('expenditure.show',$item->id)}}" title="View Expenditure details">{{$item->id}}</a></td>
      <td><a href="/profile/@if($item->purchase)@if($item->purchase->user){{$item->purchase->user->id}}@endif @endif" title="View supplier details">@if($item->purchase)@if($item->purchase->user){{$item->purchase->user->name}}@endif @endif</a></td>
      @if($item->purchase)
      <td>@if($item->purchase->dept)<a href="{{route('dept-registration.show',$item->purchase->id)}}" title="View Department details">{{$item->purchase->dept->name}}</a> @endif</td>
      @else
      <td>-</td>
      @endif
      <td>{{number_format($item->suppliedQuantity)}}</td>
      <td>KES {{number_format($item->cost,2)}}</td>
      </tr>

      <?php $totalCost += $item->cost; ?>

      @endforeach

    </tbody>

    <tfoot>
      <tr>
        <td colspan="4" class="text-right text-uppercase">Grand total:</td>
        <td><strong>KES. {{number_format($totalCost,2)}}</strong></td>
      </tr>
    </tfoot>
</table>

  </div>

</div>
