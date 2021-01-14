@extends('layout_pdf')

@section('title', 'Reporte consultorias')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="title">
            Lista de consultorias
            @isset($gestion)
            (gestión {{$gestion}})
            @endisset
        </h3>
        <div class="date"><strong>Fecha y hora: </strong>{{date('d/m/Y')}} {{date('h:i:s', time())}}</div>

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
                            <th>Nombre completo/Cargo</th>
                            <th>Unidad/Secretaria</th>
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
                            <td>
                                @if(!is_null($item->nombre_completo))
                                <strong>{{$item->nombre_completo}}</strong><br>
                                @else
                                <strong>ACÉFALO</strong><br>
                                @endif
                                {{Str::limit($item->cargo, 40)}}
                            </td>
                            <td>
                                {{Str::limit($item->unidad, 40)}}<br>
                                {{$item->abrev}}
                            </td>
                            <td class="right">{{number_format($item->sueldo)}}</td>
                            @php
                                $date_inicio = (is_null($item->fecha_inicio) ? '': date('d/m/Y', strtotime($item->fecha_inicio)));
                                $date_final = (is_null($item->fecha_final) ? '': date('d/m/Y', strtotime($item->fecha_final)));
                            @endphp
                            <td class="center">{{$date_inicio}}</td>
                            <td class="center">{{$date_final}}</td>
                            <td class="center">{{$item->gestion}}</td>
                            <td>{{$item->consul_estado}}</td>
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