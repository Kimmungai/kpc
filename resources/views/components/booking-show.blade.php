<div class="doc-container">
  <h1>Booking details</h1>

  <div class="row mt-2">

    <div class="col-xs-8">
      <ul>
        <li>Kitui Pastoral center</li>
        <li>{{$dept->name}} department</li>
      </ul>

      <ul class="mt-2">
        <li>Date: {{date('d-M-Y',strtotime($booking->created_at))}}</li>
        <li>Serial: {{$booking->id}}</li>
      </ul>
    </div>

    <div class="col-xs-4">
      <ul>
        <li><strong>Customer </strong></li>
        <li><small>{{$booking->user->firstName}} {{$booking->user->lastName}}</small></li>
        <li><small>{{$booking->user->email}}</small></li>
        <li><small>{{$booking->user->phoneNumber}}</small></li>
        <li><small>Paid: @if( is_numeric($booking->bookingAmountReceived) ) Ksh. {{number_format($booking->bookingAmountReceived,2)}} @endif</small></li>
        <li><small>Owed: @if( is_numeric($booking->bookingAmountDue) && is_numeric($booking->bookingAmountReceived) ) Ksh. {{number_format(($booking->bookingAmountDue - $booking->bookingAmountReceived),2)}} @endif</small></li>
      </ul>
    </div>

  </div>

  <hr />


</div>
