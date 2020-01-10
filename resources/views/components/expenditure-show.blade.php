<div class="doc-container">
  <h1>Expenditure-{{$expense->id}} details</h1>


  <div class="row mt-2">

    <div class="col-xs-7">
      <div class="booking-details">
        <h3>Basic details</h3>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td>Title</td>
                <td>{{$expense->title}}</td>
              </tr>
              <tr>
                <td>Created on:</td>
                <td>{{date('d-M-Y',strtotime($expense->created_at))}}</td>
              </tr>

              <tr>
                <td>Mode of payment</td>
                @if($expense->modeOfPayment == 1)<td>Paid by cash</td>@endif
                @if($expense->modeOfPayment == 2)<td>Paid by cheque</td>@endif
                @if($expense->modeOfPayment == 3)<td>Paid by bank transfer</td>@endif
                @if($expense->modeOfPayment == 4)<td>MPESA</td>@endif
              </tr>

              @if($expense->transactionCode)
              <tr>
                <td>Transaction Code</td>
                <td>{{$expense->transactionCode}}</td>
              </tr>
              @endif

              @if( $expense->balance > 0)
              <tr>
                <td>paymentDueDate</td>
                <td>{{date('d-M-Y',strtotime($expense->paymentDueDate))}}</td>
              </tr>
              @endif
              <tr>
                <td>Description</td>
                <td>{{$expense->description}}</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <div class="col-xs-5">
      <div class="booking-details">
        <h3>Payment status</h3>
        @if( $expense->balance > 0 )
          <p class="text-danger">PENDING <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#expensePaymentModal">Receive payment</button></p>
        @elseif( $expense->balance <= 0 )
          <p class="text-success">PAID</p>
        @endif
        <p>Amount Due: KES. {{number_format($expense->amountDue,2)}}</p>
        <p>Amount Received: KES. {{number_format($expense->amountPaid,2)}}</p>
        @if( $expense->balance > 0  )
        <p>Pending: KES. {{number_format($expense->balance,2)}}</p>
        @elseif( $expense->balance < 0 )
        <p>Overpayment: KES. {{number_format(abs($expense->balance),2)}}</p>
        @endif
      </div>

    </div>

  </div>



</div>
