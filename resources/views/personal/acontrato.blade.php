@extends('layout')

@section('title', 'CP | Personal a contrato')

@section('content-header')
<h1>
  Personal a contrato
  {{-- <small>(filtrada)</small> --}}
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
        <div class="input-group input-group-sm float-left5" style="width: 270px;">
          <span class="input-group-btn">
            <label class="btn bg-purple btn-flat">Gestion</label>
          </span>
          <select name="op_year" id="op_year" class="form-control" style="width: 130px">
            <option {!!((request('op_year') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('op_year') == '=') ? "selected=\"selected\"" : "")!!} value="=">Igual a...</option>
            <option {!!((request('op_year') == '>') ? "selected=\"selected\"" : "")!!} value=">">Mayor a...</option>
            <option {!!((request('op_year') == '>=') ? "selected=\"selected\"" : "")!!} value=">=">Mayor o igual a...</option>
            <option {!!((request('op_year') == '<') ? "selected=\"selected\"" : "")!!} value="<">Menor a...</option>
            <option {!!((request('op_year') == '<=') ? "selected=\"selected\"" : "")!!} value="<=">Menor o igual a...</option>
          </select>
          <select name="year" id="year" class="form-control" style="width: 80px" disabled="disabled">
            <option value=""></option>
            @foreach($years as $year)
            <option {!!((request('year') == $year) ? "selected=\"selected\"" : "")!!}>{{$year}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group input-group-sm float-left5" style="width: 210px;">
          <span class="input-group-btn">
            <label class="btn btn-info btn-flat">Cant. contratos</label>
          </span>
          <select name="op_cant" id="op_cant" class="form-control" style="width: 70%">
            <option {!!((request('op_cant') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('op_cant') == '=') ? "selected=\"selected\"" : "")!!} value="=">Igual a...</option>
            <option {!!((request('op_cant') == '>') ? "selected=\"selected\"" : "")!!} value=">">Mayor a...</option>
            <option {!!((request('op_cant') == '<') ? "selected=\"selected\"" : "")!!} value="<">Menor a...</option>
          </select>
          <input type="text" name="cant" id="cant" class="form-control" value="{{request('cant')}}" style="width: 30%" disabled="disabled">
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="padding-top: 5px;">
    <div class="col-xs-12">
      <div class="form-group">
        <div class="input-group input-group-sm float-left5" style="width: 200px;">
          <span class="input-group-btn">
            <label class="btn btn-danger btn-flat">Estado func.</label>
          </span>
          <select name="estado" id="estado" class="form-control">
            <option {!!((request('estado') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('estado') == 'NULL') ? "selected=\"selected\"" : "")!!} value="NULL">SIN DEFINIR</option>
            @foreach($estados as $estado)
            <option {!!((request('estado') == $estado->id) ? "selected=\"selected\"" : "")!!} value="{{$estado->id}}">{{$estado->estado}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group input-group-sm float-left5" style="width: 230px;">
          <span class="input-group-btn">
            <label class="btn btn-warning btn-flat">Aval</label>
          </span>
          <select name="aval" id="aval" class="form-control">
            <option {!!((request('aval') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('aval') == 'lac') ? "selected=\"selected\"" : "")!!} value="lac">LACTANCIA</option>
            <option {!!((request('aval') == 'cod') ? "selected=\"selected\"" : "")!!} value="cod">CODEPEDIS</option>
            <option {!!((request('aval') == 'cont') ? "selected=\"selected\"" : "")!!} value="cont">CONTINUIDAD</option>
            <option {!!((request('aval') == 'lac_cod') ? "selected=\"selected\"" : "")!!} value="lac_cod">LACTANCIA Y CODEPEDIS</option>
            <option {!!((request('aval') == 'lac_cont') ? "selected=\"selected\"" : "")!!} value="lac_cont">LACTANCIA Y CONTINUIDAD</option>
            <option {!!((request('aval') == 'cod_cont') ? "selected=\"selected\"" : "")!!} value="cod_cont">CODEPEDIS Y CONTINUIDAD</option>
            @foreach($avales as $aval)
            <option {!!((request('aval') == $aval->id) ? "selected=\"selected\"" : "")!!} value="{{$aval->id}}">{{$aval->aval}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group input-group-sm float-left5" style="width: 200px;">
          <span class="input-group-btn">
            <label class="btn bg-navy btn-flat">Obs. 2021</label>
          </span>
          <select name="func_obs" id="func_obs" class="form-control">
            <option {!!((request('func_obs') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('func_obs') == 'NULL') ? "selected=\"selected\"" : "")!!} value="NULL">SIN DEFINIR</option>
            @foreach($observaciones as $obs)
            <option {!!((request('func_obs') == $obs->id) ? "selected=\"selected\"" : "")!!} value="{{$obs->id}}">{{$obs->detalle}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group input-group-sm float-left5">
          <button type="submit" class="btn btn-success btn-flat form-control"><i class="fa fa-filter"></i> Filtrar</button>
        </div>
        <div class="input-group input-group-sm">
          <a href="{{route('acontrato.index')}}" class="btn btn-info btn-danger form-control"><i class="fa fa-times"></i> Borrar</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            @foreach($filter as $btn => $label)
            <a class="btn btn-{{$btn}} bg-{{$btn}} btn-xs">{{$label}}</a>
            @endforeach
          </h3>
          <div class="box-tools">
            <div class="input-group input-group-sm float-left5" style="width: 115px;">
              <select name="field" id="field" class="form-control">
                <option {!!((request('field') == 'nro_doc') ? "selected=\"selected\"" : "")!!} value="nro_doc">
                  Nro. doc
                </option>
                <option {!!((request('field') == 'nombre') ? "selected=\"selected\"" : "")!!} value="nombre">
                  Nombre
                </option>
                <option {!!((request('field') == 'nro') ? "selected=\"selected\"" : "")!!} value="nro">
                  Nro. contrato
                </option>
              </select>
            </div>
            @php $width = (request('field') == 'nombre' ? '220px' : '150px'); @endphp
            <div id="group-value" class="input-group input-group-sm" style="width: {{$width}};">
              <input type="text" name="value" id="value" style="text-transform:uppercase;" class="form-control" placeholder="Buscar..." value="{{request('value')}}">
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
                <th>Idfunc</th>
                <th>Nro. doc.</th>
                <th>Nombre completo</th>
                <th class="center">Cant.</th>
                <th class="center">Primer contrato</th>
                <th class="center">Ùltimo contrato</th>
                <th class="center">Gestiones</th>
                <th>Obs. aval</th>
                <th>Obs. 2021</th>
                <th>Estado func.</th>
                <th>...</th>
              </tr>
            </thead>
            <tbody>
              <tr id="clone" hidden="">
                <td></td>
                <td colspan="9">
                  <table class="table" style="background-color: #FEB;">
                    <thead>
                      <tr>
                        <th>Idcont</th>
                        <th class="center">Nro. doc.</th>
                        <th class="right">Nro. contrato</th>
                        <th>Cargo</th>
                        <th>Unidad</th>
                        <th class="right">Sueldo (Bs)</th>
                        <th class="center">Fecha inicio</th>
                        <th class="center">Fecha final</th>
                        <th class="center">Gestión</th>
                      </tr>
                    </thead>
                    <tbody id="contratos">
                    </tbody>
                  </table>

                </td>
              </tr>
              @php $value = request('value'); @endphp
              @foreach($items as $item)
              <tr data-id="{{$item->id_func}}" >
                <td>{{$item->id_func}}</td>
                <td>{{$item->nro_doc.' '.$item->exp}}</td>
                <td>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</td>
                <td class="center">{{$item->cant}}</td>
                <td class="center">{{date('d/m/Y', strtotime($item->primer_contr))}}</td>
                <td class="center">{{date('d/m/Y', strtotime($item->ult_contr))}}</td>
                <td class="center">{{$item->gestiones}}</td>
                <td style="width: 17%">{{Str::limit($item->obs_aval, 12)}}</td>
                <td id="td-{{$item->id_func}}"><span class="label label-{{$item->label}}">{{$item->obs_tipo}}</span></td>
                <td>{{$item->func_estado}}</td>
                <td style="width: 60px;">
                  <button class="btn btn-primary btn-xs btn-contr" style="padding: 0px 5px;">
                    <i class="fa fa-file-o"></i>
                  </button>
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
  @include('partials.js_acontrato')
  @endpush