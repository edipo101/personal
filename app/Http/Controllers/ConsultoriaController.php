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

    public function index(Request $request){
    	$rows = ViewConsultoria::
            Gestion($request->get('op_year'), $request->get('year'))
            ->Unidad($request->get('unid'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $years = ViewConsultoria::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        $unidades = Unidad::get();
        $filter = $this->get_filter($request);

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('consultorias.list', compact('items', 'total', 'years', 'unidades', 'filter'));
        else
            return view('pdf.pdf_consultorias', compact('items_pdf', 'total', 'filter'));
    }
}
