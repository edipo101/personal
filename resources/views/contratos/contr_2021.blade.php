@extends('layout')

@section('content-header')
<h1>
  Lista de contratos gestion 2021
  <small>({{$total}} registros)</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li>Personal</li>
  <li class="active">Contratos</li>
</ol>
@endsection

@section('content')
<form id="form-filter" action="">
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <div class="input-group input-group-sm float-left5" style="width: 250px;">
          <span class="input-group-btn">
            <label class="btn bg-maroon btn-flat">Secretaria</label>
          </span>
          <select name="secre" id="secre" class="form-control">
            <option {!!((request('secre') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            @foreach($secretarias as $secretaria)
            <option {!!((request('secre') == $secretaria->id) ? "selected=\"selected\"" : "")!!} value="{{$secretaria->id}}">{{$secretaria->nombre_corto}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group input-group-sm float-left5" style="width: 300px;">
          <span class="input-group-btn">
            <label class="btn bg-olive btn-flat">Unidad</label>
          </span>
          <select name="unid" id="unid" class="form-control">
            <option {!!((request('unid') == '') ? "selected=\"selected\"" : "")!!} value="">Todos</option>
            @isset($unidades)
            @foreach($unidades as $unidad)
            <option {!!((request('unid') == $unidad->id) ? "selected=\"selected\"" : "")!!} value="{{$unidad->id}}">{{$unidad->nombre}}</option>
            @endforeach
            @endisset
          </select>
        </div>
        <div class="input-group input-group-sm float-left5">
          <button type="submit" class="btn btn-success btn-flat form-control"><i class="fa fa-filter"></i> Filtrar</button>
        </div>
        <div class="input-group input-group-sm float-left5 pull-right">
          <a href="{{route('contratos.create')}}" class="btn btn-info btn-flat form-control"><i class="fa fa-plus"></i> Nuevo</a>
        </div>
        <div class="input-group input-group-sm">
          <a href="{{route('contratos.2021')}}" class="btn btn-info btn-danger form-control"><i class="fa fa-times"></i> Borrar</a>
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
            <table class="table table-hover table-striped table-f12">
              <thead>
                <tr>
                  <th>Id</th>
                  <th class="right">Nro. contrato</th>
                  <th>Nro. doc.</th>
                  <th>NOMBRE COMPLETO/CARGO</th>
                  <th>Unidad/Secretaria</th>
                  <th class="right">Sueldo (Bs)</th>
                  <th class="center">Fecha inicio</th>
                  <th class="center">Fecha final</th>
                  <th>Estado</th>
                  <th>...</th>
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
                  <td>{{$item->nro_doc.' '.$item->exp}}</td>
                  <td>
                    <strong>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</strong><br>
                    <div class="cargo" style="font-size: 11px;">{{Str::limit($item->cargo, 40)}}</div>
                  </td>
                  <td>
                    {{Str::limit($item->unidad, 40)}}<br>
                    {{$item->abrev}}
                  </td>
                  <td class="right">{{number_format($item->sueldo)}}</td>
                  <td class="center">{{date('d/m/Y', strtotime($item->fecha_inicio))}}</td>
                  <td class="center">{{date('d/m/Y', strtotime($item->fecha_final))}}</td>
                  <td><span class="label label-{{$item->contr_label}}">{{$item->estado}}</span></td>
                  <td>
                    <a href="{{route('contratos.edit', $item->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
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

      $('#secre').change(function(){
        option = this.value;
        $('#unid').empty();
        $('#unid').append($('<option value="">').text('Todos'));
        if (option != ''){
          url = '{{route('unidades.getitems')}}';
          data = "id_secre="+option;
          $.get(url, data, function(data){
            $.each(data, function (index, value) {
              $('#unid').append(
                $('<option value='+value.id+'>').text(value.nombre)
              );
            });

          });
        }
      });

    });
  </script>
  @endpush