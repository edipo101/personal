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
				<h3 class="box-title">Filtrado</h3>
				<div class="pull-right box-tools">					
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
              <div class="nav-tabs-custom">
              	<ul class="nav nav-tabs">
              		<li class="active"><a href="#tab_1" data-toggle="tab">Contratos</a></li>
              		<li><a href="#tab_2" data-toggle="tab">Duración</a></li>
              		<li><a href="#tab_3" data-toggle="tab">Varios</a></li>
              	</ul>
              	<div class="tab-content">
              		<div class="tab-pane active" id="tab_1">
              			<div class="form-group">
              				<label for="exampleInputEmail1">Cantidad de contratos</label>
              				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
              			</div>
              		</div>
              		<!-- /.tab-pane -->
              		<div class="tab-pane" id="tab_2">
              			The European languages are members of the same family. Their separate existence is a myth.
              			For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
              			in their grammar, their pronunciation and their most common words. Everyone realizes why a
              			new common language would be desirable: one could refuse to pay expensive translators. To
              			achieve this, it would be necessary to have uniform grammar, pronunciation and more common
              			words. If several languages coalesce, the grammar of the resulting language is more simple
              			and regular than that of the individual languages.
              		</div>
              		<!-- /.tab-pane -->
              		<div class="tab-pane" id="tab_3">
              			Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              			Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              			when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              			It has survived not only five centuries, but also the leap into electronic typesetting,
              			remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
              			sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
              			like Aldus PageMaker including versions of Lorem Ipsum.
              		</div>
              		<!-- /.tab-pane -->
              	</div>
              	<!-- /.tab-content -->
              </div>
          </div>
      </div>
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
      					<td>{{$item->nombre}} {{$item->apellidos}}</td>
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