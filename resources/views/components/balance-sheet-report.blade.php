<div class="doc-container">
  <h1>Balance Sheet</h1>

  <div class="row mt-2">

    <div class="col-xs-8">
      <ul>
        <li>Kitui Pastoral center</li>
        <li>P.O. BOX 300-90200 KITUI, TEL: 044-442228555</li>
        <li>All departments</li>
      </ul>

      <!--<ul class="mt-2">
        <li>Date: {{date('d-M-Y',time())}}</li>
      </ul>-->
    </div>

    <div class="col-xs-4">
      <ul>
        @if(count($data))
        <li><strong>As of: {{date('d-M-Y',time())}}</strong></li>
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
            <th>KES</th>
            <th>KES</th>
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
            <td data-label="Credit amount (000')"><strong>{{number_format($data['totalFixedAssets'],2)}}</strong></td>
          </tr>
          @foreach( $data['fixedAssets'] as $fixedAsset )
          <tr>
            <td data-label="Particulars">{{$fixedAsset->name}}</td>
            <td data-label="Debit amount (000')">{{number_format($fixedAsset->cost,2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>
          @endforeach
          <tr>
            <td data-label="Particulars"><u>Current assets</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"><strong>{{number_format($data['currentAssetsTotal'],2)}}</strong></td>
          </tr>

          <tr>
            <td data-label="Particulars">Inventory</td>
            <td data-label="Debit amount (000')">{{number_format($data['inventory'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Debtors / Receivables</td>
            <td data-label="Debit amount (000')">{{number_format($data['debtors'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars">Cash at Bank</td>
            <td data-label="Debit amount (000')">{{number_format($data['bankBal'],2)}}</td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>TOTAL ASSETS</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"><strong>{{number_format($data['totalAssets'],2)}}</strong></td>
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
            <td data-label="Particulars">Loan</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"></td>
          </tr>

          <tr>
            <td data-label="Particulars"><u>Current Liabilities</u></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"><strong>{{number_format($data['currentLiabilitiesTotal'],2)}}</strong></td>
          </tr>

          <tr>
            <td data-label="Particulars">Creditors / payables</td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')">{{number_format($data['payables'],2)}}</td>
          </tr>

          <tr>
            <td data-label="Particulars"><strong>TOTAL EQUITY AND LIABILITIES</strong></td>
            <td data-label="Debit amount (000')"></td>
            <td data-label="Credit amount (000')"><strong>{{number_format($data['totalEquityLiabilities'],2)}}</strong></td>
          </tr>


        </tbody>
      </table>

    </div>

  </div>

</div>
