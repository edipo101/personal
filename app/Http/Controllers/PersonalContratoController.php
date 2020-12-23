<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Funcionario;
use App\ViewContrato;
use App\ViewFuncionario;
use App\ViewPersonalContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalContratoController extends Controller
{
    public function index(Request $request){
        $rows = ViewContrato::selectRaw('id_func, cod_func, nro_doc, nombre_completo, count(*) cant,
                min(fecha_inicio) fecha_min, max(fecha_final) fecha_max,
                concat_ws("-",min(gestion),max(gestion)) gestiones')
            ->addSelect('aval')
            ->Gestion($request->get('op_year'), $request->get('year'))
            ->Search($request->get('field'), $request->get('value'))
            ->Aval($request->get('aval'))
            ->groupBy('id_func', 'cod_func')
            ->Cantidad($request->get('op_cant'), $request->get('cant'));

        // return $ctrs;
        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
    	$total = $items->total();
    	$years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        $avals = Funcionario::select('aval')->whereRaw('not isnull(aval)')->groupBy('aval')->get()->pluck('aval');

        if (is_null($request->get('pdf')))
    	   return view('personal.acontrato', compact('items', 'total', 'years', 'avals'));
        else
            return view('pdf.layout_pdf', compact('items_pdf'));
    }
}
