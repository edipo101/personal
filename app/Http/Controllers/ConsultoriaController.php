<?php

namespace App\Http\Controllers;

use App\Aval;
use App\Dependencia;
use App\Estado;
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
            Search($request->get('field'), $request->get('value'))
            ->IdFunc($request->get('id_func'))
            ->Unidad($request->get('unid'))
            ->Secretaria($request->get('secre'))
            ->Gestion($request->get('op_year'), $request->get('year'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $years = ViewConsultoria::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        $secretarias = Dependencia::get();
        $unidades = (!is_null(request('secre'))) ? Unidad::where('id_depend', request('secre'))->get() : null;
        $filter = get_filter($request);

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('consultorias.list', compact('items', 'total', 'years','secretarias', 'unidades', 'filter'));
        else
            return view('pdf.pdf_consultorias', compact('items_pdf', 'total', 'filter'));
    }
}
