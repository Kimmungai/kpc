<span id="{{$id2}}" class="@if($hidden) hidden @endif">
 @if( isset($type) )
  @if( $type == 'textarea' )
  <textarea name="{{$name}}" rows="3" class="form-control" placeholder="{{$placeholder}}" onchange="assign_new_val(this.value,'{{$id1}}')" onfocusout="toggleShow('{{$id2}}','{{$id1}}')">{{$value}}</textarea>
  @endif
 @else
 <input name="{{$name}}" type="text" class="form-control @if( isset($numeric) ) @if( $numeric )  numeric @endif @endif" placeholder="{{$placeholder}}" value="{{$value}}" onchange="assign_new_val(this.value,'{{$id1}}')" onfocusout="toggleShow('{{$id2}}','{{$id1}}')" @if( isset( $keyup ) ) @if( $keyup ) onkeydown="@if( isset( $supplier_search ) ) @if( $supplier_search ) search_supplier(this.value,'{{$id1}}') @endif @else search_product(this.value,'{{$id1}}',1) @endif" @endif @endif >

 @endif
</span>

@if( isset( $keyup ) )
 @if( $keyup )
   <div id="{{$id1}}-search-panel" class="search-panel hidden">
     <!--<span class="close" onclick="hide_element('{{$id1}}-search-panel')"><i class="fa fa-times-circle"></i></span>-->
     <!--<a href="#">wajuiwajui</a>
     <a href="#">wajui</a>
     <a href="#">wajui</a>
     <a href="#">wajui</a>-->
   </div>
 @endif
@endif
