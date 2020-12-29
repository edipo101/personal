@extends('layout_pdf')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="title">Personal con Codepedis</h3>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items_pdf as $item)
                        <tr data-id="{{$item->id_func}}" >
                            <td>{{$item->id}}</td>
                            <td>{{$item->nro_doc.' '.$item->exp}}</td>
                            <td>{{$item->nombre_completo}}</td>
                            <td>{{'Tipo_func'}}</td>
                            <td class="center">{{$item->estado}}</td>
                            <td>{{$item->depen_discapacidad}}</td>
                            <td class="center">{{$item->edad_depen}}</td>
                            <td>{{$item->parentezco}}</td>
                            <td>{{$item->tipo_discapacidad}}</td>
                            <td class="center">{{($item->porc != '') ? $item->porc.'%' : ''}}</td>
                            <td style="width: 17%">{{Str::limit($item->obs_aval, 20)}}</td>
                            <td>
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