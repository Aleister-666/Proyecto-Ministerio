<div class="modal fade" id="{{$modal_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$modal_title}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Seguro que quieres borrar este registro?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="delete-gmvv" action="" method="POST" class="btn-group">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn {{$btn_color}}">{{$modal_action}}</button>
        </form>
      </div>
    </div>
  </div>
</div>
