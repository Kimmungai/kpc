<div class="row">

<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">

<div class="form-group" id="titleTitle">
  <label class="col-md-2 control-label">Title <span class="text-danger">*</span></label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-info-circle"></i>
      </span>
      <input name="title" id="title" type="email" class="form-control" value="@if( old('title') ) {{old('title')}} @elseif( isset($expense) ) {{$expense->title}} @endif" placeholder="Title..." onblur="validate(this.id,{required:1},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="titleHelper">
      @if ($errors->has('title'))
        {{ $errors->first('title') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="descriptionTitle">
  <label class="col-md-2 control-label">Description</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fa fa-info-circle"></i>
      </span>
      <textarea name="description" id="description" type="text" class="form-control"  rows="6" placeholder="Description about the revenue" onblur="validate(this.id,{required:0,min:3},this.value)">@if( old('description') ) {{old('description')}} @elseif( isset($expense) ) {{$expense->description}} @endif</textarea>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="descriptionHelper">
      @if ($errors->has('description'))
        {{ $errors->first('description') }}
      @endif
    </p>
  </div>
</div>



</div>


</div>

<div class="col-md-6">
  <div class="grid-1 graph-form agile_info_shadow">

<div class="form-group" id="amountDueTitle">
  <label class="col-md-2 control-label">Amount Due <span class="text-danger">*</span></label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-money-bill"></i>
      </span>
      <input name="amountDue" id="amountDue" type="text" class="form-control numeric" value="@if( old('amountDue') ) {{old('amountDue')}} @elseif( isset($expense) ) {{$expense->amountDue}} @endif" placeholder="Enter digits only..." onblur="validate(this.id,{required:1,min:1,max:255,type:'numeric'},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="amountDueHelper">
      @if ($errors->has('amountDue'))
        {{ $errors->first('amountDue') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="amountPaidTitle">
  <label class="col-md-2 control-label">Amount Paid</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-money-bill"></i>
      </span>
      <input name="amountPaid" id="amountPaid" type="text" class="form-control numeric" value="@if( old('amountPaid') ) {{old('amountPaid')}} @elseif( isset($expense) ) {{$expense->amountPaid}} @else 0 @endif" placeholder="Enter digits only..." onblur="validate(this.id,{required:0,min:1},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="amountPaidHelper">
      @if ($errors->has('amountPaid'))
        {{ $errors->first('amountPaid') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="paymentDueDateTitle">
  <label class="col-md-2 control-label">Payment Due Date</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-calendar-alt"></i>
      </span>
      <input name="paymentDueDate" id="paymentDueDate" type="text" class="form-control numeric" value="@if( old('paymentDueDate') ) {{old('paymentDueDate')}} @elseif( isset($expense) ) {{$expense->paymentDueDate}} @endif" placeholder="Choose a date..." onblur="validate(this.id,{required:0,min:1},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="paymentDueDateHelper">
      @if ($errors->has('paymentDueDate'))
        {{ $errors->first('paymentDueDate') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="modeOfPaymentTitle">
  <label class="col-md-2 control-label">Mode of payment</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-info-circle"></i>
      </span>
      <select class="form-control" name="modeOfPayment"  id="modeOfPayment">
        <option value="1" @if(old('modeOfPayment') == 1) selected @elseif(isset($expense)) @if($expense->modeOfPayment ==1) selected @endif @endif>Paid in cash</option>
        <option value="2" @if(old('modeOfPayment') == 2) selected @elseif(isset($expense)) @if($expense->modeOfPayment ==2) selected @endif @endif>Paid by cheque</option>
        <option value="3" @if(old('modeOfPayment') == 3) selected @elseif(isset($expense)) @if($expense->modeOfPayment ==3) selected @endif @endif>Paid by bank transfer</option>
        <option value="4" @if(old('modeOfPayment') == 4) selected @elseif(isset($expense)) @if($expense->modeOfPayment ==4) selected @endif @endif>Paid by MPESA</option>
      </select>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="modeOfPaymentHelper">
      @if ($errors->has('modeOfPayment'))
        {{ $errors->first('modeOfPayment') }}
      @endif
    </p>
  </div>
</div>

<div class="form-group" id="transactionCodeTitle">
  <label class="col-md-2 control-label">Transaction Code</label>
  <div class="col-md-8">
    <div class="input-group input-icon right">
      <span class="input-group-addon">
        <i class="fas fa-info-circle"></i>
      </span>
      <input name="transactionCode" id="transactionCode" type="text" class="form-control" value="@if( old('transactionCode') ) {{old('transactionCode')}} @elseif( isset($expense) ) {{$expense->transactionCode}} @endif" placeholder="E.g MPESA transaction code, cheque number etc" onblur="validate(this.id,{required:0,min:1},this.value)"/>
    </div>
  </div>
  <div class="col-sm-2">
    <p class="help-block red-text" id="transactionCodeHelper">
      @if ($errors->has('transactionCode'))
        {{ $errors->first('transactionCode') }}
      @endif
    </p>
  </div>
</div>



</div>


</div>

</div>
