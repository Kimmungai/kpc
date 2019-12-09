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
            <th>Customer</th>
            <th>Department</th>
            <th>Due</th>
            <th>Received</th>
            <th>No. Goods Bought</th>
        </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      @foreach( $sales as $item )
      <tr >
      <td><a href="/profile/@if($item->user){{$item->user->id}}@endif">@if($item->user){{$item->user->name}}@endif</a></td>
      @if( $item->dept )
      <td>{{$item->dept->name}}</td>
      @else
      <td>-</td>
      @endif
      <td>KES {{number_format($item->saleAmountDue,2)}}</td>
      <td>KES {{number_format($item->saleAmountReceived,2)}}</td>
      <td >{{count($item->revenue)}}</td>
      </tr>
      @endforeach
    </tbody>


</table>

  </div>

</div>
