<?php

namespace App\Http\Controllers;

use App\Aval;
use App\Dependencia;
use App\Estado;
use App\Funcionario;
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

    private function get_filter($request){
        $estado = Estado::where('id', request('estado'))->first();
        $aval = Aval::where('id', request('aval'))->first();
        $dependencia = Dependencia::where('id', request('secre'))->first();
        $unidad = Unidad::where('id', request('unid'))->first();

        $filter['all'] = 'Todos:';
        if ((request('value')) != '' && (request('field') == 'nro'))
            $filter['primary'] = 'Nro. contrato: '.request('value');
        if ((request('value')) != '' && (request('field') == 'nombre'))
            $filter['primary'] = 'Nombre: '.request('value');
        if ((request('value')) != '' && (request('field') == 'nro_doc'))
            $filter['primary'] = 'Nro. doc: '.request('value');
        if (request('year') != '')
            $filter['purple'] = 'Gestión '.request('op_year').' '.request('year');
        if (request('cant') != '')
            $filter['info'] = 'Cant. contratos '.request('op_cant').' '.request('cant');
        if (request('estado') != '') //Estado funcionario
            if (request('estado') == 'NULL')
                $filter['danger'] = 'Estado func.: SIN DEFINIR';
            else
                $filter['danger'] = 'Estado func.: '.$estado->estado;
        //Aval
        if (request('aval') != '')
            switch (request('aval')) {
                case 'lac':
                    $filter['warning'] = 'Aval: LACTANCIA';
                    break;
                case 'cod':
                    $filter['warning'] = 'Aval: CODEPEDIS';
                    break;
                case 'cont':
                    $filter['warning'] = 'Aval: CONTINUIDAD';
                    break;
                case 'lac_cod':
                    $filter['warning'] = 'Aval: LACTANCIA Y CODEPEDIS';
                    break;
                case 'lac_cont':
                    $filter['warning'] = 'Aval: LACTANCIA Y CONTINUIDAD';
                    break;
                case 'cod_cont':
                    $filter['warning'] = 'Aval: CODEPEDIS Y CONTINUIDAD';
                    break;
                default:
                    $filter['warning'] = 'Aval: '.$aval->aval;
                    break;
            }
        
        if (request('secre') != '')
            $filter['maroon'] = 'Secretaria: '.$dependencia->nombre_corto;
        if (request('unid') != '')
            $filter['olive'] = 'Unidad: '.$unidad->nombre;

        if (count($filter) > 1) $filter['all'] = 'Filtros:';
        return $filter;
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
        $filter = $this->get_filter($request);

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('personal.lactancia', compact('items', 'total', 'filter'));
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
        $filter = $this->get_filter($request);

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('personal.codepedis', compact('items', 'total', 'filter'));
        else
            return view('pdf.pdf_codepedis', compact('items_pdf', 'total', 'filter'));
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
