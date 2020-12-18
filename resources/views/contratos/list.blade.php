@extends('layout')

@section('content-header')
<h1>
	Lista de contratos
	{{-- <small>Lista general de todos los preventivos</small> --}}
</h1>
<ol class="breadcrumb">
	<li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
	<li>Personal</li>
	<li class="active">Contratos</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
      <div class="box">
      	<div class="box-header">
      		<h3 class="box-title">Personal a contrato</h3>
      		<div class="box-tools">
      			<div class="input-group input-group-sm hidden-xs">
      				<form method="get" action="">
      					<div class="input-group input-group-sm input-filter">
      						<select name="field" id="" class="form-control">
      							<option value="nro">Nro contrato</option>
      							<option value="nombre">Nombre</option>
      						</select>
      					</div>
      					<div class="input-group input-group-sm">
      						<input type="text" name="value" class="form-control" placeholder="Buscar..." value="{{request('value')}}">
      						<span class="input-group-btn">
      							<button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
      						</span>
      					</div>
      				</form>
      			</div>
      		</div>
      	</div>
      	<div class="box-body table-responsive">
      		<table class="table table-hover table-striped table-f12">
      			<thead>
      				<tr>
      					<th>Nro</th>
      					<th class="right">No contrato</th>
      					<th>Nombre completo</th>
      					<th>Cargo</th>
      					<th class="right">Sueldo (Bs)</th>
      					<th class="center">Fecha inicio</th>
      					<th class="center">Fecha final</th>
      				</tr>
      			</thead>
      			<tbody>
      				@foreach($items as $item)
      				<tr>
      					<td>{{$loop->iteration}}</td>
      					<td class="right">{{$item->nro_contrato}}</td>
      					<td>{{$item->nombre_completo}}</td>
      					<td>{{$item->cargo}}</td>
      					<td class="right">{{number_format($item->sueldo, 2)}}</td>
      					<td class="center">{{date('d/m/Y', strtotime($item->fecha_inicio))}}</td>
      					<td class="center">{{date('d/m/Y', strtotime($item->fecha_final))}}</td>
      				</tr>
      				@endforeach
      			</tbody>
					{{-- <tfoot>
						<tr>
							<th>Total empleados</th>
						</tr>
					</tfoot> --}}
				</table>		
			</div>
			<div class="box-footer">
				<strong>Total empleados: {{$totals->cant}}</strong>
				<nav style="text-align: center">{{$items->appends(Request::all())->links()}}</nav>
			</div>
		</div>
		
	</div>
</div>
@endsection