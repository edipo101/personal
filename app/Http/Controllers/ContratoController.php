<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Dependencia;
use App\Unidad;
use App\ViewContrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $rows = ViewContrato::
            Search($request->get('field'), $request->get('value'))
            ->IdFunc($request->get('id_func'))
            ->Unidad($request->get('unid'))
            ->Secretaria($request->get('secre'))
            ->Gestion($request->get('op_year'), $request->get('year'))
            ->orderBy('gestion', 'desc');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        $secretarias = Dependencia::get();
        $unidades = Unidad::get();

        // return $request;
        // return $items;
        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('contratos.list', compact('items', 'total', 'years', 'secretarias', 'unidades'));
        else
            return view('pdf.layout_pdf', compact('items_pdf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
