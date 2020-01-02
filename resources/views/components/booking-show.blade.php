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
        <li><strong>Customer @if( $booking->bookingAmountDue - $booking->bookingAmountReceived <= 0 ) <span class="fa fa-circle text-success"></span> @else <span class="fa fa-circle text-danger"></span> @endif @if(!$booking->paid)<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#bookingPaymentModal">Make payment</button>@endif</strong></li>
        @if( ($booking->bookingAmountDue - $booking->bookingAmountReceived) > 0 )
        <li><small>Amount Due: {{$booking->bookingAmountDue - $booking->bookingAmountReceived}}</small></li>
        @endif
        <li><small>{{$booking->user->name}}</small></li>
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
                <td>Type</td>
                @if($booking->DeptBookingTypes)
                <td>{{$booking->DeptBookingTypes->type}}</td>
                @endif
              </tr>
              @if( $booking->DeptRooms )
              <tr>
                <td>Room Type</td>
                <td>{{$booking->DeptRooms->type}}</td>
              </tr>
              @endif
              <tr>
                <td>No. of people</td>
                <td>{{$booking->numPple}}</td>
              </tr>
              <tr>
                <td>Amount due</td>
                <td>@if( is_numeric($booking->bookingAmountDue)) Ksh. {{number_format($booking->bookingAmountDue,2)}} @endif</td>
              </tr>
              <tr>
                <td>Amount received</td>
                <td>@if( is_numeric($booking->bookingAmountReceived) ) Ksh. {{number_format($booking->bookingAmountReceived,2)}} @endif</td>
              </tr>
              @if( is_numeric($booking->bookingAmountDue) && is_numeric($booking->bookingAmountReceived) )
                <tr>
                  @if($booking->bookingAmountDue - $booking->bookingAmountReceived >= 0)
                  <td>Amount Pending</td>
                  @else
                  <td>Overpayment</td>
                  @endif
                  <td> Ksh. {{number_format(abs($booking->bookingAmountDue - $booking->bookingAmountReceived),2)}}</td>
                </tr>
              @endif
              <tr>
                <td>Mode of payment</td>
                @if($booking->modeOfPayment == 1)<td>Paid by cash</td>@endif
                @if($booking->modeOfPayment == 2)<td>Paid by cheque</td>@endif
                @if($booking->modeOfPayment == 3)<td>Paid by bank transfer</td>@endif
                @if($booking->modeOfPayment == 4)<td>MPESA</td>@endif
              </tr>
              @if($booking->transactionCode)
              <tr>
                <td>Code</td>
                <td>{{$booking->transactionCode}}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <div class="col-xs-5">
      <div class="booking-details">
        <h3>Menu details</h3>
        @if($dept->DeptMenu)
          @foreach( $dept->DeptMenu as $menu )
            <p>{{$menu->name}}</p>
          @endforeach
        @endif
        <p>{{$booking->menuDetails}}</p>

      </div>
      <div class="booking-details mt-2">
        <h3>Requested services</h3>
        @if($dept->DeptServices)
          @foreach( $dept->DeptServices as $service )
            <p>{{$service->service}}</p>
          @endforeach
        @endif
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
              <td>SKU</td>
              <td>Name</td>
              <td>Quantity booked</td>
              <td>Price</td>
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
