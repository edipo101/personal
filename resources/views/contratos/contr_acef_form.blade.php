<p class="lead">Datos contrato:</p>
<div class="form-group {{$errors->has('cargo') ? 'has-error' : ''}}">
  <label for="cargo" class="col-sm-2 control-label">Cargo <span class="required">*</span></label>
  <div class="col-sm-5">
    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo a ocupar" value="{{old('cargo', $item->cargo)}}" style="text-transform:uppercase;" required="">
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
    <select name="estado" id="estado" class="form-control" required="" readonly="">
      <option value="7">ACÉFALO</option>
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