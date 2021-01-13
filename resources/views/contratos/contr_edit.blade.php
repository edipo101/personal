@extends('layout')

@section('title', 'CP | Modificar contrato')

@section('content-header')
<h1>
  Modificar contrato
  <small>gestión 2021</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Modificar contrato</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <form method="post" action="{{route('contratos.update', $item->id)}}" class="form-horizontal" style="margin-top: 15px;">
          <input name="_method" type="hidden" value="PATCH">
          <input name="url_previous" type="hidden" value="{{old('url_previous', url()->previous())}}">
          {{ csrf_field() }}
          @include('contratos.contr_form')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('javascript')
<script>

$(document).ready(function(){

  $('#fecha-inicio').datepicker({
    language: 'es',
    autoclose: true
  });

  $('#fecha-final').datepicker({
    language: 'es',
    autoclose: true
  });

  $("#nro_doc").keypress(function(e) {
    if(e.which == 13) {
      e.preventDefault();
      $('#btn-search').click();
    }
  });

  $('#btn-search').click(function(){
    nro_doc = $('#nro_doc').val();
    // console.log(nro_doc);
    data = "nro-doc="+nro_doc;
    url = '{{route('funcionarios.search')}}';
    $.get(url, data, function(data){
      console.log(data);
      if(data){
        $('#div-nombre').removeClass('has-error');
        $('#mess-nombre').remove();
        $('#nombre').val(data.nombre_completo);
        $('#id_func').val(data.id);
      }
      else{
        $('#nombre').val('');
        $('#div-nombre').addClass('has-error');
        $('#mess-nombre').remove();
        $('#div2-nombre').append('<span id="mess-nombre" class="help-block">Funcionario no encontrado</span>');
        $('#id_func').val('');
      }
    });
  });

  $('#secretaria').change(function(){
      id = $(this).val();
      $('#unidad').empty();
      $('#unidad').append("<option value='' disabled selected style='display:none;'>Seleccionar</option>");
      data = "id_secre="+id;
      url = '{{route('unidades.getitems')}}';
      $.get(url, data, function(data){
        // console.log(data);
        $.each(data, function (index, value){
          $('#unidad').append(
            '<option value="'+value.id+'">'+value.nombre+'</option>'
          );
        });
      });
    });

});
</script>
@endpush