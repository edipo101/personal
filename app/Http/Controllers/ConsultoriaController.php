<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\ViewConsultoria;
use Illuminate\Http\Request;

class ConsultoriaController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	$rows = ViewConsultoria::
            // Search($request->get('field'), $request->get('value'))
            // ->IdFunc($request->get('id_func'))
            Gestion($request->get('op_year'), $request->get('year'))
            ->Unidad($request->get('unid'))
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
}
