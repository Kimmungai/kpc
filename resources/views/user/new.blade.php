@extends('layouts.app')

@section('content')

  <h1>User registration</h1>


  <form class="" action="{{url('/user-registration')}}" method="post" enctype="multipart/form-data">
    @csrf

    @component( 'components.user-reg-form' )

    @endcomponent

    <button type="submit" name="submit">Save</button>

  </form>


@endsection
