@extends('layouts.app')

@section('content')

  <h1>User registration</h1>

  @component( 'components.confirm-modal',[ 'formId' => 'newUserForm', 'heading' => 'New user datails', 'message' => 'Are you sure you want to save new user details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )

  @endcomponent

  <form id="newUserForm" action="{{url('/user-registration')}}" method="post" enctype="multipart/form-data">
    @csrf

    @component( 'components.user-reg-form' )

    @endcomponent

    <button type="button" data-toggle="modal" data-target="#confirmModal">Save</button>

  </form>


@endsection
