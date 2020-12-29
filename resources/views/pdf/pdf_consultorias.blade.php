@extends('layout_pdf')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="title">Lista de consultorias</h3>
        <div class="date"><strong>Fecha y hora: </strong>{{date('d/m/Y h:m:s')}}</div>

        <div class="box">
            <div class="box-header">
                <div class="filtros">
                    @foreach($filter as $btn => $label)
                    <a class="btn btn-{{$btn}} bg-{{$btn}} btn-xs">{{$label}}</a>
                    @endforeach
                </div>
                <div class="box-tools">
                    <strong>Total registros: {{$total}}</strong>
                </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th class="right">Nro. contrato</th>
                            <th>Nro. doc.</th>
                            <th>Nombre completo</th>
                            <th>Cargo</th>
                            <th class="right">Sueldo (Bs)</th>
                            <th class="center">Fecha inicio</th>
                            <th class="center">Fecha final</th>
                            <th class="center">Gestión</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $value = request('value'); @endphp
                        @foreach($items_pdf as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td class="right">{{$item->nro_contrato}}</td>
                            <td>{{$item->nro_doc.' '.$item->exp}}</td>
                            <td>{{$item->nombre_completo}}</td>
                            <td>
                                {{Str::limit($item->cargo, 40)}}
                            </td>
                            <td class="right">{{number_format($item->sueldo)}}</td>
                            <td class="center">{{date('d/m/Y', strtotime($item->fecha_inicio))}}</td>
                            <td class="center">{{date('d/m/Y', strtotime($item->fecha_final))}}</td>
                            <td class="center">{{$item->gestion}}</td>
                            <td>{{$item->estado}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr><td colspan="5">Total registros: {{$total}}</td></tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection