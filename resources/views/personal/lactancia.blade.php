@extends('layout')

@section('title', 'CP | Lactancia')

@section('content-header')
<h1>
  Personal con lactancia
  <small>(gestión 2020)</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li>Personal</li>
  <li class="active">Personal a contrato</li>
</ol>
@endsection

@section('content')
@include('modals.view')
<form id="form-filter" action="" method="get">
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <div class="input-group input-group-sm float-left5" style="width: 300px;">
          <span class="input-group-btn">
            <label class="btn btn-warning btn-flat">Tipo</label>
          </span>
          <select name="aval" id="aval" class="form-control">
            <option {!!((request('aval') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('aval') == 'lac_cod') ? "selected=\"selected\"" : "")!!} value="lac_cod">LACTANCIA Y CODEPEDIS</option>
            <option {!!((request('aval') == 'lac_cont') ? "selected=\"selected\"" : "")!!} value="lac_cont">LACTANCIA Y CONTINUIDAD</option>
          </select>
        </div>
        <div class="input-group input-group-sm float-left5">
          <button type="submit" class="btn btn-success btn-flat form-control"><i class="fa fa-filter"></i> Filtrar</button>
        </div>
        <div class="input-group input-group-sm">
          <a href="{{route('funcionarios.lactancia')}}" class="btn btn-info btn-danger form-control"><i class="fa fa-times"></i> Borrar</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            @foreach($filter as $btn => $label)
            <a class="btn btn-{{$btn}} btn-xs">{{$label}}</a>
            @endforeach
          </h3>
          <div class="box-tools">
            <div class="input-group input-group-sm float-left5" style="width: 115px;">
              <select name="field" id="field" class="form-control">
                <option {!!((request('field') == 'nro_doc') ? "selected=\"selected\"" : "")!!} value="nro_doc">
                  Nro doc
                </option>
                <option {!!((request('field') == 'nombre') ? "selected=\"selected\"" : "")!!} value="nombre">
                  Nombre
                </option>
                <option {!!((request('field') == 'nro') ? "selected=\"selected\"" : "")!!} value="nro">
                  Nro contrato
                </option>
              </select>
            </div>
            @php $width = (request('field') == 'nombre' ? '220px' : '150px'); @endphp
            <div id="group-value" class="input-group input-group-sm" style="width: {{$width}};">
              <input type="text" name="value" id="value" style="text-transform:uppercase;" class="form-control" placeholder="Buscar..." value="{{request('value')}}" onkeyup="javascript:this.value=this.value.toUpperCase();">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="box-body table-responsive" style="padding-top: 0px;">
          <table class="table table-hover table-striped table-f12" id="funcs">
            <thead>
              <tr>
                <th>Id func.</th>
                <th>Nro. doc.</th>
                <th>Nombre completo</th>
                <th>Tipo</th>
                <th class="center">Estado func.</th>
                <th class="center">Prenatal</th>
                <th>Nombre beneficiario</th>
                <th class="center">Desde</th>
                <th class="center">Hasta</th>
                <th class="center">Días restantes</th>
                <th>Observaciones</th>
                <th>...</th>
              </tr>
            </thead>
            <tbody>
              @php $value = request('value'); @endphp
              @foreach($items as $item)
              <tr data-id="{{$item->id}}" >
                <td>{{$item->id}}</td>
                <td>{{$item->nro_doc.' '.$item->exp}}</td>
                <td>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</td>
                <td>{{'Tipo_func'}}</td>
                <td class="center">{{$item->estado}}</td>
                <td class="center">{{($item->prenatal == 1) ? 'SI' : ''}}</td>
                <td>{{$item->nombre_benef}}</td>
                <td class="center">
                  {{(isset($item->desde)) ? date('d/m/Y', strtotime($item->desde)) : ''}}
                </td>
                <td class="center">
                  {{(isset($item->hasta)) ? date('d/m/Y', strtotime($item->hasta)) : ''}}
                </td>
                @php
                  $dias = ($item->dias_rest < 0) ? '<span class="label label-danger">CONCLUIDO</span>' : '<span class="badge bg-green">'.$item->dias_rest.'</span>';
                @endphp
                <td class="center">{!!$dias!!}</td>
                <td style="width: 17%">{{Str::limit($item->obs_aval, 15)}}</td>
                <td>
                  <a href="#" class="btn btn-info btn-xs btn-view" data-toggle="modal" data-target="#modal-view"><i class="fa fa-eye"></i></a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <strong>Total registros: {{number_format($total)}}</strong>
            <div class="pull-right">
              <input type="hidden" name="pdf" id="pdf">
              <button id="btn-pdf" class="btn btn-sm btn-danger"><i class="fa fa-download"></i> Descargar</button>
            </div>
            <nav class="text-center">{{$items->appends(Request::all())->links()}}</nav>
          </div>
        </div>

      </div>
    </div>
  </form>
  @endsection

  @push('javascript')
  @include('partials.js_lactancia')
  @endpush