<?php

namespace App\Http\Controllers;

use App\Funcionario;
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
            where('aval', 'like', '%LACTANCIA%')
            ->Aval($request->get('aval'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $avals = Funcionario::select('aval')->where('aval', 'like', '%LACTANCIA%')->groupBy('aval')->get()->pluck('aval');
        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('personal.lactancia', compact('items', 'total', 'avals'));
        else
            return view('pdf.layout_pdf', compact('items_pdf'));
    }

    public function func_codepedis(Request $request){
        $rows = ViewFuncionario::
            where('aval', 'like', '%CODEPEDIS%')
            ->Aval($request->get('aval'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        // return $items;
        $total = $items->total();
        $avals = Funcionario::select('aval')->where('aval', 'like', '%CODEPEDIS%')->groupBy('aval')->get()->pluck('aval');
        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('personal.codepedis', compact('items', 'total', 'avals'));
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
