<div class="doc-container">
  <h1>Inventory Report</h1>

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
        @if(count($inventory))
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
            <th>Sku</th>
            <th>Name</th>
            <th>Department</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      @foreach( $inventory as $item )
      <tr >
      <td>{{$item->sku}}</td>
      <td>{{$item->name}}</td>
      @if( $item->dept )
      <td>{{$item->dept->name}}</td>
      @else
      <td>-</td>
      @endif
      <td>{{$item->price}}</td>
      <td >@if(is_numeric($item->quantity)){{number_format($item->quantity,2)}}@endif</td>
      </tr>
      @endforeach
    </tbody>


</table>

  </div>

</div>
