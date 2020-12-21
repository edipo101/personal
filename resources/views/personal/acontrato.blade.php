@extends('layout')

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
<form action="">
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <div class="input-group input-group-sm float-left5" style="width: 140px;">
          <span class="input-group-btn">
            <label class="btn btn-default btn-flat">Gestion</label>
          </span>
          <select name="year" id="year" class="form-control">
            <option value="">Todos</option>
            @foreach($years as $year)
            <option {!!((request('year') == $year) ? "selected=\"selected\"" : "")!!}>{{$year}}</option>
            @endforeach
          </select>
        </div>
        {{-- <div class="input-group input-group-sm float-left5" style="width: 200px;">
          <span class="input-group-btn">
            <label class="btn btn-default btn-flat">Cant</label>
          </span>
          <select name="field3" id="3" class="form-control" style="width: 60%">
            <option value="nro">Todos</option>
            <option value="nro">Mayor a...</option>
            <option value="nro">Igual a...</option>
            <option value="nombre">Menor a...</option>
            <option value="nombre">Consultoria</option>
          </select>
          <input type="text" name="" class="form-control" style="width: 40%">
        </div> --}}
        <div class="input-group input-group-sm float-left5">
          <button type="submit" class="btn btn-info btn-flat form-control"><i class="fa fa-filter"></i> Filtrar</button>
        </div>
        <div class="input-group input-group-sm">
          <a href="{{route('contratos.index')}}" class="btn btn-info btn-danger form-control"><i class="fa fa-times"></i> Borrar</a>
        </div>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              @php 
              $filter['default'] = 'Todos:';
              if ((request('value')) != '' && (request('field') == 'nro'))
                $filter['primary'] = 'Nro. contrato: '.request('value');
              if ((request('value')) != '' && (request('field') == 'nombre'))
                $filter['primary'] = 'Nombre: '.request('value'); 
              if (request('year') != '')
                $filter['success'] = 'Gestión: '.request('year');
              if (count($filter) > 1) $filter['default'] = 'Filtros:';
              @endphp
              @foreach($filter as $btn => $label)
              <a class="btn btn-{{$btn}} btn-xs">{{$label}}</a>
              @endforeach
            </h3>
            <div class="box-tools">
              <div class="input-group input-group-sm float-left5" style="width: 115px;">
                <select name="field" id="field" class="form-control">
                  <option {!!((request('field') == 'nro') ? "selected=\"selected\"" : "")!!} value="nro">
                    Nro contrato
                  </option>
                  <option {!!((request('field') == 'nombre') ? "selected=\"selected\"" : "")!!} value="nombre">
                    Nombre
                  </option>
                  <option {!!((request('field') == 'nro_doc') ? "selected=\"selected\"" : "")!!} value="nro_doc">
                    Nro doc
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
            <div class="class" style="padding-bottom: 10px;">
            </div>
            <table class="table table-hover table-striped table-f12">
              <thead>
                <tr>
                  <th>Id</th>
                  <th class="right">Nro. contrato</th>
                  <th>Nro. doc.</th>
                  <th>Nombre completo</th>
                  <th>Cargo</th>
                  <th>Unidad</th>
                  <th class="right">Sueldo (Bs)</th>
                  <th class="center">Fecha inicio</th>
                  <th class="center">Fecha final</th>
                  <th class="center">Gestión</th>
                </tr>
              </thead>
              <tbody>
                @php $value = request('value'); @endphp
                @foreach($items as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td class="right">
                    {!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nro_contrato)!!}
                  </td>
                  <td>{{$item->nro_doc}}</td>
                  <td>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</td>
                  <td>{{$item->cargo}}</td>
                  <td>{{$item->unidad}}</td>
                  <td class="right">{{number_format($item->sueldo, 2)}}</td>
                  <td class="center">{{date('d/m/Y', strtotime($item->fecha_inicio))}}</td>
                  <td class="center">{{date('d/m/Y', strtotime($item->fecha_final))}}</td>
                  <td class="center">{{$item->gestion}}</td>
                </tr>
                @endforeach
              </tbody>

            </table>		
          </div>
          <div class="box-footer">
            <strong>Total registros: {{number_format($total)}}</strong>
            <nav class="text-center">{{$items->appends(Request::all())->links()}}</nav>
          </div>
        </div>

      </div>
    </div>
  </form>
  @endsection

  @push('javascript')
  <script>
    function resize(option){
      console.log(option);
      if (option == 'nombre')
        $('#group-value').width(220);
      else
        $('#group-value').width(150);
    }

    $(document).ready(function(){
      $('#field').change(function(){
        resize(this.value);
        $('#value').val('');
      });
    });
  </script>
  @endpush