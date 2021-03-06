<div class="modal fade" id="purchasePaymentModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
      <div class="modal-header">
        <h4 class="modal-title">Make payment to supplier</h4>
      </div>
      <div class="modal-body">

        <form id="purchase-payment-form" action="{{route('purchases-registration.update',$purchase->id)}}" class="form-horizontal" role="form" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="amountPaid" class="col-sm-3 control-label">Amount <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input name="amountPaid" type="text" class="form-control numeric" placeholder="Amount paid to supplier" value="@if(isset($purchase)) @if( ($purchase->amountDue - $purchase->amountPaid) > 0 ) {{$purchase->amountDue - $purchase->amountPaid}} @endif @endif">
            </div>
          </div>

          <div class="form-group">
            <label for="paymentMethod" class="col-sm-3 control-label">Payment method</label>
            <div class="col-sm-9">
              <select name="paymentMethod" class="form-control">
                <option value="1" @if(isset($purchase)) @if( $purchase->paymentMethod ==1 ) selected @endif @endif>Paid by cash</option>
                <option value="2" @if(isset($purchase)) @if( $purchase->paymentMethod ==2 ) selected @endif @endif>Paid by cheque</option>
                <option value="3" @if(isset($purchase)) @if( $purchase->paymentMethod ==3 ) selected @endif @endif>Paid by bank transfer</option>
                <option value="4" @if(isset($purchase)) @if( $purchase->paymentMethod ==4 ) selected @endif @endif>MPESA</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="remarks" class="col-sm-3 control-label">Remarks</label>
            <div class="col-sm-9">
              <textarea  class="form-control" name="remarks" rows="3"></textarea>
            </div>
          </div>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="submit_form('purchase-payment-form')">Save</button>
      </div>
    </div>
  </div>
</div>
