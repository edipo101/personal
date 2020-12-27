@extends('layout_pdf')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 style="margin-top: 0px;">Personal a contrato</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th class="right">Nro. contrato</th>
                    <th>Nro. doc.</th>
                    <th>Nombre completo</th>
                    <th>Cargo/Unidad</th>
                    {{-- <th>Unidad</th> --}}
                    <th class="right">Sueldo (Bs)</th>
                    <th class="center">Fecha inicio</th>
                    <th class="center">Fecha final</th>
                    <th class="center">Gestión</th>
                </tr>
            </thead>
            <tbody>
                @php $value = request('value'); @endphp
                @foreach($items_pdf as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td class="right">
                        {!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nro_contrato)!!}
                    </td>
                    <td>{{$item->nro_doc}}</td>
                    <td>{!!str_replace($value, '<span class="highlight">'.$value.'</span>', $item->nombre_completo)!!}</td>
                    <td>
                        {{Str::limit($item->cargo, 40)}}<br>
                        {{$item->unidad}}
                    </td>
                    {{-- <td>{{Str::limit($item->unidad, 20)}}</td> --}}
                    <td class="right">{{number_format($item->sueldo, 2)}}</td>
                    <td class="center">{{date('d/m/Y', strtotime($item->fecha_inicio))}}</td>
                    <td class="center">{{date('d/m/Y', strtotime($item->fecha_final))}}</td>
                    <td class="center">{{$item->gestion}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><td>Esto es una preuba</td></tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection