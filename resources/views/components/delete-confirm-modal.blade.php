  <!-- Modal -->
  <div class="modal fade" id="deleteConfirmModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        <div class="modal-header">
          @if( isset($heading) )
            <h4 class="modal-title">{{$heading}}</h4>
          @else
            <h4 class="modal-title">Permanent Delete Confirmation</h4>
          @endif
        </div>
        <div class="modal-body">
          @if( isset($message) )
            <p>{{$message}}</p>
          @else
            <p>Are you sure you want to delete records permanently?</p>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">@if( isset($closeBtn) ) {{$closeBtn}} @else Cancel @endif</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="submit_form('{{$formId}}')">@if( isset($saveBtn) ) {{$saveBtn}} @else Procced @endif</button>
        </div>
      </div>
    </div>
  </div>
