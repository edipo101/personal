@extends('layout')

@section('content-header')
<h1>
  Personal con Codepedis
  <small>(gestión 2020)</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li>Personal</li>
  <li class="active">CODEPEDIS</li>
</ol>
@endsection

@section('content')
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
            <option {!!((request('aval') == 'lac_cod') ? "selected=\"selected\"" : "")!!} value="lac_cod">CODEPEDIS Y LACTANCIA</option>
            <option {!!((request('aval') == 'cod_cont') ? "selected=\"selected\"" : "")!!} value="cod_cont">CODEPEDIS Y CONTINUIDAD</option>
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
      <div class="box box-success">
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
                <th>Dependiente con disc.</th>
                <th class="center">Edad depen.</th>
                <th>Parentezco</th>
                <th>Tipo discapacidad</th>
                <th class="center">Porcen.</th>
                <th>Observaciones</th>
                <th>...</th>
              </tr>
            </thead>
            <tbody>
              @php $value = request('value'); @endphp
              @foreach($items as $item)
              <tr data-id="{{$item->id_func}}" >
                <td>{{$item->id}}</td>
                <td>{{$item->nro_doc.' '.$item->exp}}</td>
                <td>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</td>
                <td>{{'Tipo_func'}}</td>
                <td class="center">{{$item->estado}}</td>
                <td>{{$item->depen_discapacidad}}</td>
                <td class="center">{{$item->edad_depen}}</td>
                <td>{{$item->parentezco}}</td>
                <td>{{$item->tipo_discapacidad}}</td>
                <td class="center">{{($item->porc != '') ? $item->porc.'%' : ''}}</td>
                <td style="width: 17%">{{Str::limit($item->obs_aval, 20)}}</td>
                <td>
                  <button class="btn btn-primary btn-xs btn-contr" style="padding: 0px 5px;">
                    <i class="fa fa-file-o"></i>
                  </button>
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

      $('.btn-contr').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        id = row.data('id');
        // console.log(id);
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
                  $('<td class="center date">').text(dateFormatSql(value.fecha_inicio)),
                  $('<td class="center">').text(dateFormatSql(value.fecha_final)),
                  $('<td class="center">').text(value.gestion)
                  ));
            });
            tr_clone = $('#clone').clone();
            tr_clone.attr('id', id);
            tr_clone.find('#contratos').removeAttr('id');
            row.after(tr_clone);
            tr_clone.show();
          });
        }
        contratos.toggle();
      });

    });
  </script>
  @endpush