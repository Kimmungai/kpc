<div class="doc-container">
  <h1>Revenue Report</h1>

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
        @if(count($revenues))
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
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
      <?php $totalPrice = 0; ?>

      @foreach( $revenues as $item )

      @if( $item->Booking )

        @if( $item->Booking->status )
        <tr>
        <td>@if($item->booking->user)<a href="/profile/{{$item->booking->user->id}}" title="View customer details">{{$item->booking->user->name}}</a> @endif</td>
        <td>@if($item->booking->dept)<a href="{{route('dept-registration.show',$item->booking->dept->id)}}" title="View Department details">{{$item->booking->dept->name}}</a>@endif</td>
        <td>@if($item->product)<a href="{{route('product-registration.show',$item->product->id)}}" title="View Expenditure details">{{$item->product->name}}</a>@endif</td>
        <td>{{number_format($item->bookedQuantity)}}</td>
        <td>KES {{number_format($item->total,2)}}</td>
        </tr>
        @endif

      @elseif( $item->DeptSales )
      <tr>
      <td>@if($item->DeptSales->user)<a href="/profile/{{$item->DeptSales->user->id}}" title="View customer details">{{$item->DeptSales->user->name}} @endif</td>
      <td>@if($item->DeptSales->dept)<a href="{{route('dept-registration.show',$item->DeptSales->dept->id)}}" title="View Department details">{{$item->DeptSales->dept->name}}</a>@endif</td>
      <td>@if($item->product)<a href="{{route('product-registration.show',$item->product->id)}}" title="View Expenditure details">{{$item->product->name}}</a>@endif</td>
      <td>{{number_format($item->bookedQuantity)}}</td>
      <td>KES {{number_format($item->total,2)}}</td>
      </tr>
      @endif
      <?php $totalPrice += $item->total; ?>

      @endforeach

    </tbody>

    <tfoot>
      <tr>
        <td colspan="4" class="text-right text-uppercase">Grand total:</td>
        <td><strong>KES. {{number_format($totalPrice,2)}}</strong></td>
      </tr>
    </tfoot>
</table>

  </div>

</div>
