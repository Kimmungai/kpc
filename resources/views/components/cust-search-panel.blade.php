<div id="bookingCustomerSearchPanel" class="supplier-details box-shdow-1 mb-2">
  <legend>Search</legend>
  <div  class="input-group mb-0">
    <span class="input-group-addon" ><span class="fa fa-search"></span></span>
    <input id="customerSearch" type="text" class="form-control search-input" placeholder="Search customer by name..." onkeyup="kpc_cust_search(this.value,this.id)">
  </div>

  <div id="customerSearchPanel" class="search-panel-lg hidden">


  </div>
  <br>
  <a href="#"  onclick="event.preventDefault();toggleElements('bookingCustomerRegPanel','bookingCustomerSearchPanel')">Create new customer instead</a>
</div>
