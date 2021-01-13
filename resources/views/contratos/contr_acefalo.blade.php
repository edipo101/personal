@extends('layout')

@section('title', 'CP | Contrato acéfalo')

@section('content-header')
<h1>
  Crear contrato acéfalo
  <small>gestión 2021</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Crear contrato acéfalo</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <form method="post" action="{{route('contratos.store_acefalo')}}" class="form-horizontal" style="margin-top: 15px;">
          <input name="url_previous" type="hidden" value="{{old('url_previous', url()->previous())}}">
          {{ csrf_field() }}
          @include('contratos.contr_acef_form')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('javascript')
<script>

$(document).ready(function(){

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