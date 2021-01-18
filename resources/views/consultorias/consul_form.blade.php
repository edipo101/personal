<p class="lead">Datos funcionario:</p>
<div class="form-group {{$errors->has('nro_doc') ? 'has-error' : ''}}">
  <label for="nro_doc" class="col-sm-2 control-label">Nro. doc. <span class="required">*</span></label>
  <div class="col-sm-3">
    <div class="input-group">
      <input id="nro_doc" name="nro_doc" type="text" class="form-control" value="{{old('nro_doc', $item->nro_doc)}}" autocomplete="off">
          <span class="input-group-btn">
            <button id="btn-search" type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
          </span>
    </div>
    {!! $errors->first('nro_doc', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<input type="hidden" id="id_func" name="id_func" value="{{old('id_func', $item->id_func)}}">
<div id="div-nombre" class="form-group {{$errors->has('nombre') ? 'has-error' : ''}}">
  <label for="nombre" class="col-sm-2 control-label">Nombre completo <span class="required">*</span></label>
  <div id="div2-nombre" class="col-sm-6">
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{old('nombre', $item->nombre_completo)}}" readonly="">
    {!! $errors->first('nombre', '<span id="mess-nombre" class="help-block">:message</span>')!!}
  </div>
</div>
<p class="lead">Datos contrato:</p>
<div class="form-group {{$errors->has('cargo') ? 'has-error' : ''}}">
  <label for="cargo" class="col-sm-2 control-label">Cargo <span class="required">*</span></label>
  <div class="col-sm-5">
    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo que ocupará" value="{{old('cargo', $item->cargo)}}" style="text-transform:uppercase;" required="">
    {!! $errors->first('cargo', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('secretaria') ? 'has-error' : ''}}">
  <label for="secretaria" class="col-sm-2 control-label">Secretaría <span class="required">*</span></label>
  <div class="col-sm-5">
    <select name="secretaria" id="secretaria" class="form-control" required="">
      <option value="" disabled selected style="display:none;">Seleccionar</option>
      @foreach($secretarias as $secretaria)
      <option {!!((old('secretaria', $item->dependencia_id) == $secretaria->id) ? "selected=\"selected\"" : "")!!} value="{{$secretaria->id}}">{{$secretaria->nombre_corto}}
      </option>
      @endforeach
    </select>
    {!! $errors->first('secretaria', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('unidad') ? 'has-error' : ''}}">
  <label for="unidad" class="col-sm-2 control-label">Unidad <span class="required">*</span></label>
  <div class="col-sm-5">
    <select name="unidad" id="unidad" class="form-control" required="">
      <option value="" disabled selected style="display:none;">Seleccionar</option>
      @isset($unidades)
      @foreach($unidades as $unidad)
      <option {!!((old('unidad', $item->unidad_id) == $unidad->id) ? "selected=\"selected\"" : "")!!} value="{{$unidad->id}}">{{$unidad->nombre}}</option>
      @endforeach
      @endisset
    </select>
    {!! $errors->first('secretaria', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('fecha_inicio') ? 'has-error' : ''}}">
  <label for="fecha_inicio" class="col-sm-2 control-label">Fecha inicio <span class="required">*</span></label>
  <div class="col-sm-2">
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      @php $date = (is_null($item->fecha_inicio)) ? '': date("d/m/Y", strtotime($item->fecha_inicio)) @endphp
      <input type="text" class="form-control pull-right" id="fecha-inicio" name="fecha_inicio" value="{{old('fecha_inicio', $date)}}" autocomplete="off">
    </div>
    {!! $errors->first('fecha_inicio', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('fecha_final') ? 'has-error' : ''}}">
  <label for="fecha_final" class="col-sm-2 control-label">Fecha final <span class="required">*</span></label>
  <div class="col-sm-2">
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      @php $date = (is_null($item->fecha_final)) ? '': date("d/m/Y", strtotime($item->fecha_final)) @endphp
      <input type="text" class="form-control pull-right" id="fecha-final" name="fecha_final" value="{{old('fecha_final', $date)}}" autocomplete="off">
    </div>
    {!! $errors->first('fecha_final', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('sueldo') ? 'has-error' : ''}}">
  <label for="sueldo" class="col-sm-2 control-label">Sueldo (Bs)</label>
  <div class="col-sm-2">
    <input type="number" class="form-control" id="sueldo" name="sueldo" placeholder="Sueldo" value="{{old('sueldo', $item->sueldo)}}">
    {!! $errors->first('sueldo', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<p class="lead">Otros datos:</p>
<div class="form-group {{$errors->has('estado') ? 'has-error' : ''}}">
  <label for="estado" class="col-sm-2 control-label">Estado <span class="required">*</span></label>
  <div class="col-sm-3">
    <select name="estado" id="estado" class="form-control" required="">
      <option value="" disabled selected style="display:none;">Seleccionar</option>
      @isset($estados)
      @foreach($estados as $estado)
      <option {!!((old('estado', $item->id_estado) == $estado->id) ? "selected=\"selected\"" : "")!!} value="{{$estado->id}}">{{$estado->estado}}</option>
      @endforeach
      @endisset
    </select>
    {!! $errors->first('estado', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('obs') ? 'has-error' : ''}}">
  <label for="obs" class="col-sm-2 control-label">observaciones</label>
  <div class="col-sm-5">
    <textarea class="form-control" name="obs" id="obs" rows="2" style="text-transform:uppercase;">{{old('obs', $item->observaciones)}}</textarea>
    {!! $errors->first('obs', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-5">
    <button type="submit" class="btn btn-primary float-left5">Guardar</button>
    <a href="{{old('url_previous', url()->previous())}}" class="btn btn-default">Cancelar</a>
  </div>
</div>