<div class="row">

  <div class="col-sm-12">
    <div class="resp-table ">
      <table id="otherProductsSearchTable" class="bg-white @if(!old('no_products'))  hidden @elseif(isset($booking)) @if(!$booking->no_products) hidden @endif @endif" >
        <thead>
          <tr>
            <td>#</td>
            <td>Name</td>
            <td>Description</td>
            <td>Quantity</td>
            <td>Selling price</td>
            <td>Total</td>
          </tr>
        </thead>
        <tbody>
          <!---<input name="col__2" type="text" class="form-control" placeholder="" min="" max="" value="'+value+'" onchange="assign_new_val(this.value,\'col__2\',2)" onfocusout="toggleShow(\'col__2_editor\',\'col__2\',2)" onkeyup="max_field_input(this)"> FOR QUANTITY-->

          @if(old('no_products'))
            @for( $x = 1; $x <= old('no_products'); $x++ )
            <tr id="booked-prods-row-{{$x}}" data-product="{{old('col_'.$x.'_7')}}">
              <td id="col_{{$x}}_1" data-label="#"><span class="fas fa-times-circle" onclick="remove_row_hide_empty_table('booked-prods-row-{{$x}}', 'otherProductsSearchTable' )"></span> &nbsp;&nbsp;&nbsp;{{$x}}</td>
              <td  data-label="Name"> <span id="col_{{$x}}_2"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_2')}}</span>
                <span id="col_{{$x}}_2_editor" class="hidden">
                  <input name="col_{{$x}}_2" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_2')}}" onchange="assign_new_val(this.value,'col_{{$x}}_2',2)" onfocusout="toggleShow('col_{{$x}}_2_editor','col_{{$x}}_2',2)" >
                </span>
              </td>
              <td  data-label="Description"> <span id="col_{{$x}}_3"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_3')}}</span>
                <span id="col_{{$x}}_3_editor" class="hidden">
                  <input name="col_{{$x}}_3" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_3')}}" onchange="assign_new_val(this.value,'col_{{$x}}_3',2)" onfocusout="toggleShow('col_{{$x}}_3_editor','col_{{$x}}_3',2)" >
                </span>
              </td>
              <td  data-label="Quantity"> <span id="col_{{$x}}_4"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_4')}}</span>
                <span id="col_{{$x}}_4_editor" class="hidden">
                  <input name="col_{{$x}}_4" type="number" class="form-control numeric" placeholder="" min="1" max="{{old('col_'.$x.'_4_max')}}" value="{{old('col_'.$x.'_4')}}" onchange="assign_new_val(this.value,'col_{{$x}}_4',2)" onfocusout="toggleShow('col_{{$x}}_4_editor','col_{{$x}}_4',2)" onkeyup="max_field_input(this)">
                  <input name="col_{{$x}}_4_max" type="hidden" value="{{old('col_'.$x.'_4_max')}}">
                </span>
              </td>
              <td  data-label="Selling price"> <span id="col_{{$x}}_5"  onclick="toggleShow(this.id,this.id+'_editor',2)">{{old('col_'.$x.'_5')}}</span>
                <span id="col_{{$x}}_5_editor" class="hidden">
                  <input name="col_{{$x}}_5" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_5')}}" onchange="assign_new_val(this.value,'col_{{$x}}_5',2)" onfocusout="toggleShow('col_{{$x}}_5_editor','col_{{$x}}_5',2)" >
                </span>
              </td>
              <td  data-label="Total"> <span id="col_{{$x}}_6"  onclick="toggleShow(this.id,this.id+'_editor',2)">KES {{number_format(old('col_'.$x.'_6'),2)}}</span>
                <span id="col_{{$x}}_6_editor" class="hidden">
                  <input name="col_{{$x}}_6" type="text" class="form-control" placeholder="" min="" max="" value="{{old('col_'.$x.'_6')}}" onchange="assign_new_val(this.value,'col_{{$x}}_6',2)" onfocusout="toggleShow('col_{{$x}}_6_editor','col_{{$x}}_6',2)" >
                </span>
              </td>
              <input type="hidden" name="col_{{$x}}_7" value="{{old('col_'.$x.'_7')}}">

            @endfor
          @elseif(isset($booking))
          @endif
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td>Grand Total</td>
            <td id="booked_prods_grand_total" class="text-bold">@if(old('booked_prods_grand_total'))KES {{number_format(old('booked_prods_grand_total'),2)}}@elseif(isset($booking)) code mada desu @endif</td>
            <input type="hidden" id="booked_prods_grand_total" name="booked_prods_grand_total" value="@if(old('booked_prods_grand_total')){{old('booked_prods_grand_total')}}@elseif(isset($booking)) 0 @endif">
          </tr>
        </tfoot>
      </table>
   </div>
  </div>
</div>
