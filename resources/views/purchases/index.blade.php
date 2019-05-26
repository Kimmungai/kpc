<h1>Purchases</h1>
Department:

@if( isset( $depts ) )
  <!--list of departments-->
  <select class="" name="">
    @forelse( $depts as $dept )
      <option value="{{$dept->id}}">{{$dept->id}}</option>
    @empty
      <option selected disabled>No departments</option>
    @endforelse
  </select>
  <!--end list of departments-->
@endif


@if( isset( $purchases ) )

  <!--list of purchases-->
  <ul>
    @forelse( $purchases as $purchase )
      <li>{{$purchase->id}}</li>
    @empty
      <li>No purchases</li>
    @endforelse
    <!--end list of purchases-->
  </ul>
@endif
