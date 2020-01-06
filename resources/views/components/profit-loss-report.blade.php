<div class="doc-container">
  <h1>Profit & Loss</h1>

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
        @if(count($totals))
        <li><strong>Period</strong></li>
        <li>{{$StartDate}} <span class="fa fa-arrow-right"></span> {{$EndDate}} </li>
        @endif
      </ul>
    </div>

  </div>

  <hr />

  <div class="table-responsive mt-0">
    <div class="resp-table mt-0">
      <table>
        <thead>
          <tr>
            <th>Particulars</th>
            <th>Debit amount (000')</th>
            <th>Credit amount (000')</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td data-label="Particulars"><strong>Revenue</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Dapartment Sales</td>
            <td data-label="Debit amount (000')">Ksh. {{number_format($totals['sales'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Bookings</td>
            <td data-label="Debit amount (000')">Ksh. {{number_format($totals['booking'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Other revenue</td>
            <td data-label="Debit amount (000')">Ksh. {{number_format($totals['revenue'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>Total revenues</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')">Ksh. {{number_format($totals['totalRevenue'],2)}}</td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>Expenses</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Purchases</td>
            <td data-label="Debit amount (000')">Ksh. {{number_format($totals['purchase'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Miscellaneous expenses</td>
            <td data-label="Debit amount (000')">Ksh. {{number_format($totals['expense'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>Total expenses</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')">(Ksh. {{number_format($totals['totalExpense'],2)}})</td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>Net income</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"><strong>Ksh. {{number_format($totals['netIncome'],2)}}</strong></td>
          </tr>

        </tbody>
      </table>

    </div>

  </div>

</div>
