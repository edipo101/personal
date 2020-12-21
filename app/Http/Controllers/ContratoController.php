<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\ViewContrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $value = $request->get('value');
        $items = ViewContrato::
            Search($request->get('field'), $value)
            ->Gestion($request->get('year'))
            ->orderBy('gestion', 'desc')
            ->paginate(25);
        
        $totals = ViewContrato::selectRaw('count(*) cant')
            ->Search($request->get('field'), $value)
            ->Gestion($request->get('year'))
            ->first();

        $years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        return view('contratos.list', compact('items', 'totals', 'years'));
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
