@extends('layouts.app')

@section('content')

  <h1>User Details</h1>

  @component( 'components.confirm-modal',[ 'formId' => 'newUserForm', 'heading' => 'New user datails', 'message' => 'Are you sure you want to update user details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )

  @endcomponent

  @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteUserForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

  @endcomponent

  <form id="newUserForm" action="{{route('user-registration.update',$user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @component( 'components.user-reg-form',['user'=>$user] )

    @endcomponent

    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmModal">Update</button>

  </form>

  <form class="d-none hidden" id="deleteUserForm" action="{{route('user-registration.update',$user->id)}}" method="post">
    @csrf
    @method('DELETE')
  </form>


@endsection
