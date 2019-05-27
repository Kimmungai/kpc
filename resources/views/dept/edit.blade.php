@extends('layouts.app')

@section('content')
  <h1>Department details</h1>

  @component( 'components.confirm-modal',[ 'formId' => 'DeptForm', 'heading' => 'Department datails', 'message' => 'Are you sure you want to update department details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please update' ] )

  @endcomponent

  @component( 'components.delete-confirm-modal',[ 'formId' => 'deleteDeptForm', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, delete parmanently' ] )

  @endcomponent

  <form id="DeptForm" action="{{route('dept-registration.update',$dept->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @component( 'components.dept-reg-form', ['dept'=>$dept] )

    @endcomponent

    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmModal">Update</button>

  </form>

  <form class="d-none hidden" id="deleteDeptForm" action="{{route('dept-registration.update',$dept->id)}}" method="post">
    @csrf
    @method('DELETE')
  </form>

@endsection
