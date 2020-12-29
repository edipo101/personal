@extends('layout_pdf')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="title">Personal con Lactancia</h3>
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
                            <th class="center">Prenatal</th>
                            <th>Nombre beneficiario</th>
                            <th class="center">Desde</th>
                            <th class="center">Hasta</th>
                            <th class="center">Días restantes</th>
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
                            <td class="center">{{($item->prenatal == 1) ? 'SI' : ''}}</td>
                            <td>{{$item->nombre_benef}}</td>
                            <td class="center">
                              {{(isset($item->desde)) ? date('d/m/Y', strtotime($item->desde)) : ''}}
                          </td>
                          <td class="center">
                              {{(isset($item->hasta)) ? date('d/m/Y', strtotime($item->hasta)) : ''}}
                          </td>
                          @php
                          $dias = ($item->dias_rest < 0) ? 'CONCLUIDO' : $item->dias_rest;
                          @endphp
                          <td class="center">{!!$dias!!}</td>
                          <td style="width: 17%">{{Str::limit($item->obs_aval, 30)}}</td>
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