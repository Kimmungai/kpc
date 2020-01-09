<div class="doc-container">
  <h1>Revenue-{{$revenue->id}} details</h1>


  <div class="row mt-2">

    <div class="col-xs-7">
      <div class="booking-details">
        <h3>Basic details</h3>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td>Title</td>
                <td>{{$revenue->title}}</td>
              </tr>
              <tr>
                <td>Created on:</td>
                <td>{{date('d-M-Y',strtotime($revenue->created_at))}}</td>
              </tr>

              <tr>
                <td>Mode of payment</td>
                @if($revenue->modeOfPayment == 1)<td>Paid by cash</td>@endif
                @if($revenue->modeOfPayment == 2)<td>Paid by cheque</td>@endif
                @if($revenue->modeOfPayment == 3)<td>Paid by bank transfer</td>@endif
                @if($revenue->modeOfPayment == 4)<td>MPESA</td>@endif
              </tr>

              @if($revenue->transactionCode)
              <tr>
                <td>Transaction Code</td>
                <td>{{$revenue->transactionCode}}</td>
              </tr>
              @endif

              @if( $revenue->balance > 0)
              <tr>
                <td>paymentDueDate</td>
                <td>{{date('d-M-Y',strtotime($revenue->paymentDueDate))}}</td>
              </tr>
              @endif
              <tr>
                <td>Description</td>
                <td>{{$revenue->description}}</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <div class="col-xs-5">
      <div class="booking-details">
        <h3>Payment status</h3>
        @if( $revenue->balance > 0 )
          <p class="text-danger">PENDING <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#revenuePaymentModal">Receive payment</button></p>
        @elseif( $revenue->balance <= 0 )
          <p class="text-success">PAID</p>
        @endif
        <p>Amount Due: KES. {{number_format($revenue->amountDue,2)}}</p>
        <p>Amount Received: KES. {{number_format($revenue->amountReceived,2)}}</p>
        @if( $revenue->balance > 0  )
        <p>Pending: KES. {{number_format($revenue->balance,2)}}</p>
        @elseif( $revenue->balance < 0 )
        <p>Overpayment: KES. {{number_format(abs($revenue->balance),2)}}</p>
        @endif
      </div>

    </div>

  </div>



</div>
