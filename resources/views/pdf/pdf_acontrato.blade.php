@extends('layout_pdf')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="title">Personal a contrato</h3>
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
                            <th>Id func</th>
                            <th>Nro doc.</th>
                            <th>Nombre completo</th>
                            <th class="right">Cant. contratos</th>
                            <th class="center">Primer contrato</th>
                            <th class="center">Último contrato</th>
                            <th class="center">Gestiones</th>
                            <th class="center">Estado func.</th>
                            <th class="center">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $value = request('value'); @endphp
                        @foreach($items_pdf as $item)
                        <tr>
                            <td>{{$item->id_func}}</td>
                            <td>{{$item->nro_doc}}</td>
                            <td>{{$item->nombre_completo}}</td>
                            <td class="right">{{$item->cant}}</td>
                            <td class="center">{{date('d/m/Y', strtotime($item->primer_contr))}}</td>
                            <td class="center">{{date('d/m/Y', strtotime($item->ult_contr))}}</td>
                            <td class="center">{{$item->gestiones}}</td>
                            <td class="center">{{$item->func_estado}}</td>
                            <td>{{$item->obs_aval}}</td>
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