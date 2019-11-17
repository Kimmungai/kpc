<div class="row prod-details mt-2">
  <div class="col-sm-6">
    <div class="grid-1 graph-form agile_info_shadow">
<h3>Basic details</h3>
    <div class="form-group">
      <label class="col-md-2 control-label">Product type</label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-layer-group"></i>
          </span>
          <select name="type" id="type" class="form-control">
          <option value="1" @if( old('type') == 1 || ( isset($product) && $product->type == 1 ) ) selected @endif>Fixed asset</option>
          <option value="2" @if( old('type') == 2 || ( isset($product) && $product->type == 2 ) ) selected @endif>Current asset</option>
          </select>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text">
          @if ($errors->has('type'))
            {{ $errors->first('type') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="img1Title">
      <label class="col-md-2 control-label">Image <small>max 1mb</small></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-image"></i>
          </span>
          <img src="@if( isset($product) ){{$product->img1}} @endif" alt="@if( isset($product) ){{$product->name}} @endif" class="img-thumbnail" height="50px" width="50px">
          <input name="img1" id="img1" type="file"  onchange="validate(this.id,{required:0,min:0,max:255,type:'image',size:1},this.value)" />
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="img1Helper">
          @if ($errors->has('img1'))
            {{ $errors->first('img1') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="nameTitle">
      <label class="col-md-2 control-label">Name <span class="text-danger">*</span></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fa fa-info-circle"></i>
          </span>
          <input name="name" id="name" type="text" class="form-control" value="@if( old('name') ) {{old('name')}} @elseif( isset($product) ) {{$product->name}} @endif" placeholder="Product Name..." onblur="validate(this.id,{required:1,min:3,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="nameHelper">
          @if ($errors->has('name'))
            {{ $errors->first('name') }}
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
          <textarea name="description" id="description" class="form-control"  placeholder="Type any details about this product..." onblur="validate(this.id,{required:0,min:3},this.value)" rows="5">@if( old('description') ) {{old('description')}} @elseif( isset($product) ) {{$product->description}} @endif</textarea>
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


  <div class="col-sm-6">
    <div class="grid-1 graph-form agile_info_shadow">
<h3>Cost details</h3>
    <div class="form-group" id="skuTitle">
      <label class="col-md-2 control-label">SKU <span class="text-danger">*</span></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-money-bill-wave"></i>
          </span>
          <input name="sku" id="sku" type="text" class="form-control" value="@if( old('sku') ) {{old('sku')}} @elseif( isset($product) ) {{$product->sku}} @endif" placeholder="Product sku costs..." onblur="validate(this.id,{required:1,min:1,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="skuHelper">
          @if ($errors->has('sku'))
            {{ $errors->first('sku') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="priceTitle">
      <label class="col-md-2 control-label">Selling Price <span class="text-danger">*</span></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-cash-register"></i>
          </span>
          <input name="price" id="price" type="text" class="form-control" value="@if( old('price') ) {{old('price')}} @elseif( isset($product) ) {{$product->price}} @endif" placeholder="Product selling price..." onblur="validate(this.id,{required:1,min:0,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="priceHelper">
          @if ($errors->has('price'))
            {{ $errors->first('price') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="costTitle">
      <label class="col-md-2 control-label">Cost Price <span class="text-danger">*</span></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-money-bill-wave"></i>
          </span>
          <input name="cost" id="cost" type="text" class="form-control" value="@if( old('cost') ) {{old('cost')}} @elseif( isset($product) ) {{$product->cost}} @endif" placeholder="Product cost..." onblur="validate(this.id,{required:1,min:0,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="costHelper">
          @if ($errors->has('cost'))
            {{ $errors->first('cost') }}
          @endif
        </p>
      </div>
    </div>

    <div class="form-group" id="quantityTitle">
      <label class="col-md-2 control-label">Quantity <span class="text-danger">*</span></label>
      <div class="col-md-8">
        <div class="input-group input-icon right">
          <span class="input-group-addon">
            <i class="fas fa-info-circle"></i>
          </span>
          <input name="quantity" id="quantity" type="text" class="form-control" value="@if( old('quantity') ) {{old('quantity')}} @elseif( isset($product) ) {{$product->quantity}} @endif" placeholder="Product quantity..." onblur="validate(this.id,{required:1,min:0,max:255},this.value)" required/>
        </div>
      </div>
      <div class="col-sm-2">
        <p class="help-block red-text" id="quantityHelper">
          @if ($errors->has('quantity'))
            {{ $errors->first('quantity') }}
          @endif
        </p>
      </div>
    </div>




    </div>
  </div>
</div>
