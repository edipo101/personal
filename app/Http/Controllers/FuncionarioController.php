<?php

namespace App\Http\Controllers;

use App\Aval;
use App\Dependencia;
use App\Estado;
use App\Funcionario;
use App\Observacion;
use App\Unidad;
use App\ViewContrato;
use App\ViewFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function func_lactancia(Request $request){
        $rows = ViewFuncionario::
            where('lactancia', 1)
            ->Search($request->get('field'), $request->get('value'))
            ->Aval($request->get('aval'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $filter = get_filter($request);
        $observaciones = Observacion::get();

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('personal.lactancia', compact('items', 'total', 'filter', 'observaciones'));
        else
            return view('pdf.pdf_lactancia', compact('items_pdf', 'total', 'filter'));
    }

    public function func_codepedis(Request $request){
        $rows = ViewFuncionario::
            where('codepedis', 1)
            ->Search($request->get('field'), $request->get('value'))
            ->Aval($request->get('aval'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $filter = get_filter($request);
        $observaciones = Observacion::get();

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('personal.codepedis', compact('items', 'total', 'filter', 'observaciones'));
        else
            return view('pdf.pdf_codepedis', compact('items_pdf', 'total', 'filter'));
    }

    public function view(Request $request){
        $row = ViewFuncionario::where('id', $request->get('id'))->first();
        return $row;
    }

    public function save_obs(Request $request){
        $row = Funcionario::where('id', $request->get('id'))->first();
        $row->id_obs = $request->get('id_obs');
        $row->func_obs = $request->get('obs');
        $row->save();
        $item = ViewFuncionario::where('id', $request->get('id'))->first();
        return $item;
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
