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
        <li><strong>Customer @if( $booking->bookingAmountDue - $booking->bookingAmountReceived <= 0 ) <span class="fa fa-circle text-success"></span> @else <span class="fa fa-circle text-danger"></span> @endif</strong></li>
        <li><small>{{$booking->user->firstName}} {{$booking->user->lastName}}</small></li>
        <li><small>{{$booking->user->email}}</small></li>
        <li><small>{{$booking->user->phoneNumber}}</small></li>
      </ul>
    </div>

  </div>

  <hr />

  <div class="row">
    <div class="col-xs-4">
      <div class="booking-details">
        <h3>Check in</h3>
        <p class="text-center">{{date('d-M-Y',strtotime($booking->chkInDate))}}</p>
      </div>
    </div>

    <!--<div class="col-xs-4">
      <div class="booking-details">
        <h3><span class="fa fa-angle-right"></span></h3>
      </div>
    </div>-->

    <div class="col-xs-4 col-xs-offset-4">
      <div class="booking-details">
        <h3>Check Out</h3>
        <p class="text-center">{{date('d-M-Y',strtotime($booking->chkOutDate))}}</p>
      </div>
    </div>
  </div>

  <div class="row mt-2">

    <div class="col-xs-7">
      <div class="booking-details">
        <h3>Basic details</h3>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <th>Type</th>
                @if( $booking->bookingType == 1)<td>Food ordering </td>@endif
                @if( $booking->bookingType == 2)<td>Room booking </td>@endif
                @if( $booking->bookingType == 3)<td>Tent Hiring </td>@endif
                @if( $booking->bookingType == 4)<td>Meeting hall booking </td>@endif
                @if( $booking->bookingType == 5)<td>Compound booking </td>@endif
              </tr>
              @if( $booking->roomType ==2 )
              <tr>
                <th>Room Type</th>
                @if( $booking->roomType == 1 )<td> Single  </td>@endif
                @if( $booking->roomType == 2 )<td> Double  </td>@endif
                @if( $booking->roomType == 3 )<td> Delux   </td>@endif
              </tr>
              @endif
              <tr>
                <th>No. of people</th>
                <td>{{$booking->numPple}}</td>
              </tr>
              <tr>
                <th>Amount due</th>
                <td>@if( is_numeric($booking->bookingAmountDue)) Ksh. {{number_format($booking->bookingAmountDue,2)}} @endif</td>
              </tr>
              <tr>
                <th>Amount received</th>
                <td>@if( is_numeric($booking->bookingAmountReceived) ) Ksh. {{number_format($booking->bookingAmountReceived,2)}} @endif</td>
              </tr>
              @if( is_numeric($booking->bookingAmountDue) && is_numeric($booking->bookingAmountReceived) )
                <tr>
                  @if($booking->bookingAmountDue - $booking->bookingAmountReceived >= 0)
                  <th>Amount Pending</th>
                  @else
                  <th>Overpayment</th>
                  @endif
                  <td> Ksh. {{number_format(abs($booking->bookingAmountDue - $booking->bookingAmountReceived),2)}}</td>
                </tr>
              @endif
              <tr>
                <th>Mode of payment</th>
                @if($booking->modeOfPayment == 1)<td>Paid by cash</td>@endif
                @if($booking->modeOfPayment == 2)<td>Paid by cheque</td>@endif
                @if($booking->modeOfPayment == 3)<td>Paid by bank transfer</td>@endif
                @if($booking->modeOfPayment == 4)<td>MPESA</td>@endif
              </tr>
              @if($booking->transactionCode)
              <tr>
                <th>Code</th>
                <td>{{$booking->transactionCode}}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <div class="">
      <div class="booking-details">
        <h3>Menu details</h3>
        @if($booking->board == 2)
        <p>Full board</p>
        @else
        <p>Half board</p>
        @endif

        @if($booking->menu == 2)
        <p>Special menu</p>
        @else
        <p>Ordinary menu</p>
        @endif

        <p>{{$booking->menuDetails}}</p>

      </div>
      <div class="booking-details mt-2">
        <h3>Requested services</h3>
          <p>@if($booking->meetingHall == 1) Meeting hall, @endif @if($booking->tent == 1 ) Tent, @endif @if($booking->paSystem == 1) PA system, @endif @if($booking->projector == 1) Projector @endif</p>
      </div>
    </div>

  </div>

@if( count($booking->revenue) )
  <div class="row mt-2">
    <div class="col-xs-12">
      <div class="booking-details">
        <h3>Other booked items</h3>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
              <th>SKU</th>
              <th>Name</th>
              <th>Quantity booked</th>
              <th>Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $booking->revenue as $revenue)
              <tr>
              <td>{{$revenue->product->sku}}</td>
              <td>{{$revenue->product->name}}</td>
              <td>{{$revenue->bookedQuantity}}</td>
              <td>{{$revenue->price}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endif

</div>
