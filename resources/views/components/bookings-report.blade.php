<div class="doc-container">
  <h1>Bookings Report</h1>

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
        @if(count($bookings))
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
            <th>Type</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Amount due</th>
            <th>Amount received</th>
            <th>Outstanding</th>
        </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      <?php $amtDueTotal = 0; ?>
      <?php $outstandingTotal = 0; ?>

      @foreach( $bookings as $booking )
      <tr >

      @if( $booking->bookingType == 1 )
      <td>Food Order</td>
      @elseif( $booking->bookingType == 2 )
      <td>Room Booking</td>
      @elseif( $booking->bookingType == 3 )
      <td>Tent Hiring</td>
      @elseif( $booking->bookingType == 4 )
      <td>Meeting Hall Booking</td>
      @elseif( $booking->bookingType == 5 )
      <td>Compound Booking</td>
      @endif

      <td><a href="{{route('user-registration.edit',$booking->user->id)}}" title="Open {{$booking->user->firstName}}'s record">{{$booking->user->firstName}}</a></td>
      <td>{{date('d-M-Y',strtotime($booking->created_at))}}</td>
      <td>@if( is_numeric($booking->bookingAmountDue) ) {{number_format($booking->bookingAmountDue,2)}}@endif</td>
      <td >@if( is_numeric($booking->bookingAmountReceived) ){{number_format($booking->bookingAmountReceived,2)}} @endif</td>
      <td >@if( is_numeric($booking->bookingAmountReceived) && is_numeric($booking->bookingAmountDue) ) {{number_format($booking->bookingAmountDue - $booking->bookingAmountReceived,2)}} @endif</td>
      </tr>
      @if( is_numeric($booking->bookingAmountReceived) )
      <?php $total += $booking->bookingAmountReceived; ?>
      @endif
      @if( is_numeric($booking->bookingAmountDue) )
      <?php $amtDueTotal += $booking->bookingAmountDue; ?>
      @endif
      @if( is_numeric($booking->bookingAmountReceived) && is_numeric($booking->bookingAmountDue) )
      <?php $outstandingTotal += ($booking->bookingAmountDue - $booking->bookingAmountReceived); ?>
      @endif
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="3" class="text-right text-uppercase">Grand total:</td>
        <td><strong>Ksh. {{number_format($amtDueTotal,2)}}</strong></td>
        <td><strong>Ksh. {{number_format($total,2)}}</strong></td>
        <td><strong>Ksh. {{number_format($outstandingTotal,2)}}</strong></td>
      </tr>
    </tfoot>
</table>

  </div>

</div>
