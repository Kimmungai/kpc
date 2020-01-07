<div class="doc-container">
  <h1>Balance Sheet</h1>

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
            <th>Debit amount (Ksh.)</th>
            <th>Credit amount (Ksh.)</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td data-label="Particulars"><strong>ASSETS</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><u>Non-current assets</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Bookings</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Other revenue</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><u>Current assets</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>TOTAL ASSETS</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>EQUITY AND LIABILITIES</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><u>Owner's equity</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Capital</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><u>Non-current Liabilities</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">10% Loan</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><u>Current Liabilities</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Creditors / payables</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>TOTAL EQUITY AND LIABILITIES</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>


        </tbody>
      </table>

    </div>

  </div>

</div>
