@extends('layouts.app')

@section('content')
  <h1>Department registration</h1>

  @component( 'components.confirm-modal',[ 'formId' => 'newDeptForm', 'heading' => 'New Department datails', 'message' => 'Are you sure you want to save new department details?', 'closeBtn' => 'No, please cancel ', 'saveBtn' => 'Yes, please save' ] )

  @endcomponent

  <form id="newDeptForm" action="{{url('/dept-registration')}}" method="post" enctype="multipart/form-data">
    @csrf

    @component( 'components.dept-reg-form' )

    @endcomponent

    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmModal">Save</button>

  </form>
@endsection
