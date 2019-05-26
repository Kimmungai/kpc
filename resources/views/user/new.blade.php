@extends('layouts.kpc')

@section('content')

  <h1>User registration</h1>


  <form class="" action="/" method="post">

    @component( 'components.user-reg-form' )

    @endcomponent

    <button type="submit" name="submit">Save</button>

  </form>


@endsection
