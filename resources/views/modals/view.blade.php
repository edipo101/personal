<div class="modal fade in" id="modal-view">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 id="func-title" class="modal-title">Funcionario</h4>
      </div>
      <div class="modal-body">
        <dl class="dl-horizontal">
          <dt>Id func.</dt>
          <dd id="id"></dd>
          <dt>Cod. func. (Sigma)</dt>
          <dd id="cod-func"></dd>
          <dt>Nro. doc</dt>
          <dd id="nro-doc"></dd>
          <dt>Nombre completo</dt>
          <dd id="nombre-completo"></dd>
          <dt>Fecha de nac.</dt>
          <dd id="fecha-nac"></dd>
          <dt>Estado</dt>
          <dd id="estado"></dd>
          <dt>Aval</dt>
          <dd id="obs-aval"></dd>
          <form id="form-obs" action="" method="get">
          <input type="hidden" name="id" id="id-func" value="">
          <dt>Observaciones</dt>
          <dd id="id-obs" style="padding-bottom: 5px;">
            <select name="id_obs" id="select-obs">
              <option value="" selected="selected"></option>
              @foreach($observaciones as $obs)
              <option value="{{$obs->id}}">{{$obs->detalle}}</option>
              @endforeach
            </select>
          </dd>
          <dd id="obs">
            <textarea name="obs" id="text-obs" cols="55" rows="2"></textarea>
          </dd>
          </form>
        </dl>
      </div>
      <div class="modal-footer">
        <button id="btn-save" type="button" class="btn btn-success" data-dismiss="modal">Guardar y Salir</button>
        <button id="btn-cancel" type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>