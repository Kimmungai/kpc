<div class="row">

  <div class="col-sm-12 ">
    @if( isset ($title) )
    <h4 class="mb-2 text-bold">{{$title}}</h4>
    @else
    <h4 class="mb-2 text-bold">Other Booked products</h4>
    @endif

    <div id="booked-prods-error" class="alert alert-danger alert-dismissible hidden" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h5>Please enter correct values for the fields in red.</h5>
    </div>

    <div class="supplier-details box-shdow-4">
      <div class="input-group mb-0" >
        <span class="input-group-addon" id=""><span class="fa fa-search"></span></span>
        <input id="otherProductsSearch" type="text" class="form-control search-input" placeholder="Search by product name..." onkeyup="kpc_search(this.value,this.id,@if(isset($dept)){{$dept->id}}@endif,'product')">
      </div>

      <div id="otherProductsSearchPanel" class="search-panel-lg hidden">


      </div>

    </div>



  </div>
</div>
