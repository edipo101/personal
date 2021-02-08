<div class="modal fade in" id="modal-delete" style="padding-right: 16px;">
  <div class="modal-dialog" style="width: 350px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Eliminar registro</h4>
      </div>
      <div class="modal-body">
        ¿Esta seguro de eliminar el registro con los siguientes datos?<br>        
        {{-- <div><strong>Id:</strong> <span id="id"></span></div> --}}
        <div><strong>CI:</strong> <span id="nro-doc"></span></div>
        <div><strong>Nombre:</strong> <span id="nombre"></span></div>
        <div><strong>Cargo:</strong> <span id="cargo"></span></div>
      </div>
      <div class="modal-footer">
        <button id="btn-cancel" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        {{-- <button id="btn-delete" type="button" class="btn btn-primary">Eliminar</button> --}}
        <form method="post" action="{{route('contratos.destroy')}}">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id" id="id" value="">
          <button type="submit" class="btn btn-primary btn-flat">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>