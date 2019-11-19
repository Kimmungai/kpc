<span id="{{$id2}}" class="@if($hidden) hidden @endif">
 @if( isset($type) )
  @if( $type == 'textarea' )
  <textarea name="{{$name}}" rows="8" cols="80" class="form-control" placeholder="{{$placeholder}}" onchange="assign_new_val(this.value,'{{$id1}}')" onfocusout="toggleShow('{{$id2}}','{{$id1}}')">{{$value}}</textarea>
  @endif
 @else
 <input name="{{$name}}" type="text" class="form-control" placeholder="{{$placeholder}}" value="{{$value}}" onchange="assign_new_val(this.value,'{{$id1}}')" onfocusout="toggleShow('{{$id2}}','{{$id1}}')" @if( isset( $keyup ) ) @if( $keyup ) onkeyup="search_product(this.value)" @endif @endif>
 @endif
 <!--<span class="input-group-btn">
   <button class="btn btn-info btn-xs" type="button" onclick="toggleShow('{{$id2}}','{{$id1}}')">Ok!</button>
 </span>-->
</span>
