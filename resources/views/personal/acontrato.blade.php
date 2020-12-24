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
<form id="form-filter" action="" method="get">
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <div class="input-group input-group-sm float-left5" style="width: 270px;">
          <span class="input-group-btn">
            <label class="btn btn-default btn-flat">Gestion</label>
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
        <div class="input-group input-group-sm float-left5" style="width: 200px;">
          <span class="input-group-btn">
            <label class="btn btn-default btn-flat">Cantidad</label>
          </span>
          <select name="op_cant" id="op_cant" class="form-control" style="width: 70%">
            <option {!!((request('op_cant') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            <option {!!((request('op_cant') == '=') ? "selected=\"selected\"" : "")!!} value="=">Igual a...</option>
            <option {!!((request('op_cant') == '>') ? "selected=\"selected\"" : "")!!} value=">">Mayor a...</option>
            <option {!!((request('op_cant') == '<') ? "selected=\"selected\"" : "")!!} value="<">Menor a...</option>
          </select>
          <input type="text" name="cant" id="cant" class="form-control" value="{{request('cant')}}" style="width: 30%" disabled="disabled">
        </div>
        <div class="input-group input-group-sm float-left5" style="width: 200px;">
          <span class="input-group-btn">
            <label class="btn btn-default btn-flat">Aval</label>
          </span>
          <select name="aval" id="aval" class="form-control">
            <option {!!((request('aval') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            @foreach($avals as $aval)
            <option {!!((request('aval') == $aval) ? "selected=\"selected\"" : "")!!}>{{$aval}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group input-group-sm float-left5">
          <button type="submit" class="btn btn-info btn-flat form-control"><i class="fa fa-filter"></i> Filtrar</button>
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
            @php
            $filter['default'] = 'Todos:';
            if ((request('value')) != '' && (request('field') == 'nro'))
              $filter['primary'] = 'Nro. contrato: '.request('value');
            if ((request('value')) != '' && (request('field') == 'nombre'))
              $filter['primary'] = 'Nombre: '.request('value');
            if ((request('value')) != '' && (request('field') == 'nro_doc'))
              $filter['primary'] = 'Nro. doc: '.request('value');

            if (request('year') != '')
              $filter['success'] = 'Gestión '.request('op_year').' '.request('year');

            if (request('cant') != '')
              $filter['info'] = 'Cant. contratos '.request('op_cant').' '.request('cant');

            if (request('aval') != '')
              $filter['warning'] = 'Aval: '.request('aval');

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
          <table class="table table-hover table-striped table-f12" id="funcs">
            <thead>
              <tr>
                <th>Id func.</th>
                <th>Cod. func.</th>
                <th>Nro. doc.</th>
                <th>Nombre completo</th>
                <th class="center">Cant. contratos</th>
                <th class="center">Fecha Mínima</th>
                <th class="center">Fecha Máxima</th>
                <th class="center">Gestiones</th>
                <th>Aval</th>
                <th>...</th>
              </tr>
            </thead>
            <tbody>
              <tr id="clone" hidden="">
                <td></td>
                <td colspan="8">
                  <table class="table" style="font-size: 11px; background-color: #FEB;">
                    <thead>
                      <tr>
                        <th>Id</th>
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
                <td>{{$item->cod_func}}</td>
                <td>{{$item->nro_doc}}</td>
                <td>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</td>
                <td class="center">{{$item->cant}}</td>
                <td class="center">{{date('d/m/Y', strtotime($item->fecha_min))}}</td>
                <td class="center">{{date('d/m/Y', strtotime($item->fecha_max))}}</td>
                <td class="center">{{$item->gestiones}}</td>
                <td style="width: 17%">{{Str::limit($item->aval, 20)}}</td>
                <td>
                  <a href="#" class="btn btn-primary btn-xs btn-contr" style="padding: 0px 5px;">
                    <i class="fa fa-file-o"></i></a>
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
  <script>
    function resize(option){
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

      op_cant = "{{request('op_cant')}}";
      if (op_cant != '')
        $('#cant').removeAttr('disabled');

      $('#op_cant').change(function(){
        option = this.value;
        if (option == ''){
          $('#cant').attr('disabled', 'disabled');
          $('#cant').val('');
        }
        else
          $('#cant').removeAttr('disabled');
      });

      op_year = "{{request('op_year')}}";
      if (op_year != '')
        $('#year').removeAttr('disabled');

      $('#op_year').change(function(){
        option = this.value;
        if (option == ''){
          $('#year').attr('disabled', 'disabled');
          $('#year').val('');
        }
        else
          $('#year').removeAttr('disabled');
      });

      $('#btn-pdf').click(function(){
        console.log('pdf');
        $('#pdf').val('1');
        var form = $('#form-filter');
        form.attr('target', '_blank');
        form.submit();
        form.removeAttr('target');
        $('#pdf').removeAttr('value');
      });

      $('.btn-contr').click(function(){
        var row = $(this).parents('tr');
        id = row.data('id');
        console.log(id);
        // $('.btn-contr').attr('href', '#'+id)
        contratos = $('#funcs').find('tr#'+id);
        if (!contratos.length){
          var url = '{{route('contratos.index')}}';
          var data = $("#form-filter").serialize();
          data = data+"&id_func="+id+"&type=json";
          
          $.get(url, data, function(data){
            $('#contratos').html('');
            $.each(data, function (index, value) {
              $('#contratos').append(
                $('<tr>').append(
                  $('<td>').text(value.id),
                  $('<td class="center">').text(value.nro_doc),
                  $('<td class="right">').text(value.nro_contrato),
                  $('<td>').text(value.cargo),
                  $('<td>').text(value.unidad),
                  $('<td class="right">').text(value.sueldo),
                  $('<td class="center">').text(value.fecha_inicio),
                  $('<td class="center">').text(value.fecha_final),
                  $('<td class="center">').text(value.gestion)
                ));
            });

            tr_clone = $('#clone').clone();
            tr_clone.attr('id', id);
            tr_clone.find('#contratos').removeAttr('id');
            row.after(tr_clone);
            tr_clone.show();
          });
          // contratos = tr_clone;
        }
        contratos.toggle();
      });

    });
  </script>
  @endpush