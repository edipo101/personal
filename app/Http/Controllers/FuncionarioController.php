<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function func_lactancia(){
        $rows = ViewFuncionario::
            // Search($request->get('field'), $request->get('value'))
            // ->IdFunc($request->get('id_func'))
            // Gestion($request->get('op_year'), $request->get('year'))
            // ->Unidad($request->get('unid'))
            ->orderBy('gestion', 'desc');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $years = ViewConsultoria::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        $unidades = Unidad::get();
        // return $request;
        // return $items;
        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('consultorias.list', compact('items', 'total', 'years', 'unidades'));
        else
            return view('pdf.layout_pdf', compact('items_pdf'));
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
