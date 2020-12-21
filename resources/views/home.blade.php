@extends('layout')

@section('content-header')
<h1>
    Inicio
    {{-- <small>(filtrada)</small> --}}
</h1>
<ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Inicio</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{number_format($total['tot_func'])}}</h3>

                <p>Personal a contrato</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">Mostrar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{number_format($total['tot_contr'])}}</h3>

                <p>Contratos elaborados</p>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a href="{{route('contratos.index')}}" class="small-box-footer">Mostrar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
@endsection
