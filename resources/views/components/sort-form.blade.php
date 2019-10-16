<div class="row mb-2">
  <form class="" action="{{$action}}" method="get">
  <div class="col-sm-2">
    <p style="line-height:40px">Sort:</p>
  </div>
  <div class="col-sm-3" style="overflow:hidden">
    <select id="filter_sort" class="form-control1" name="filter_sort" >
      <option value="newOld" @if(isset($sortBy)) @if($sortBy == 'newOld' ) selected @endif @endif >New-Old</option>
      <option value="oldNew" @if(isset($sortBy)) @if($sortBy == 'oldNew' ) selected @endif @endif>Old-New</option>
      <option value="paidOnly" @if(isset($sortBy)) @if($sortBy == 'paidOnly' ) selected @endif @endif >Paid only</option>
      <option value="pendingOnly" @if(isset($sortBy)) @if($sortBy == 'pendingOnly' ) selected @endif @endif >Pending only</option>
      <option value="overPaidOnly" @if(isset($sortBy)) @if($sortBy == 'overPaidOnly' ) selected @endif @endif >Overpaid only</option>
    </select>
  </div>

  <div class="col-sm-2">
    <input type="text" id="filter_from" name="filter_from" class="form-control1" value="@if(isset($filter_from)){{$filter_from}}@endif" placeholder="Date from">
  </div>
  <div class="col-sm-1 hidden-xs">
    <p style="line-height:40px">~</p>
  </div>
  <div class="col-sm-2">
    <input type="text" id="filter_to" name="filter_to" class="form-control1" value="@if(isset($filter_to)){{$filter_to}}@endif" placeholder="Date to">
  </div>
  <div class="col-sm-2">
    <button type="submit" class="btn btn-xs btn-dark"><i class="fas fa-sort-amount-down"></i> Filter</button>
  </div>
  </form>
</div>
