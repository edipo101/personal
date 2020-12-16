@extends('layout')

@section('content-header')
<h1>
	Lista de personal
	{{-- <small>Lista general de todos los preventivos</small> --}}
</h1>
<ol class="breadcrumb">
	<li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
	<li class="active">Personal</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			{{-- <div class="box-header">
				<h3 class="box-title">Lista de personal</h3>
			</div> --}}
			<div class="box-body table-responsive nopadding">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Nro</th>
							<th>Cod func</th>
							<th>Nombre completo</th>
							<th>Fecha Nac</th>
							<th>Cedula</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$item->cod_func}}</td>
							<td>{{$item->nombre_completo}}</td>
							<td>{{$item->fecha_nac}}</td>
							<td>{{$item->nro_doc}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>		
			</div>
			<div class="box-footer" style="text-align: right;">
				{{$items->appends(Request::all())->links()}}
			</div>
		</div>
		
	</div>
</div>
@endsection