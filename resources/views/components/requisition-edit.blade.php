<div id="{{$id2}}" class="req-edit input-group hidden">
 <input name="{{$name}}" type="text" class="form-control" placeholder="{{$placeholder}}" value="{{$value}}" onchange="assign_new_val(this.value,'{{$id1}}')">
 <span class="input-group-btn">
   <button class="btn btn-info btn-xs" type="button" onclick="toggleShow('{{$id2}}','{{$id1}}')">Ok!</button>
 </span>
</div>
