<?php

namespace App\Http\Controllers;

use App\Aval;
use App\Contrato;
use App\Dependencia;
use App\Estado;
use App\Funcionario;
use App\Unidad;
use App\ViewContrato;
use App\ViewFuncionario;
use App\ViewPersonalContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalContratoController extends Controller
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
        $rows = ViewContrato::selectRaw('id_func, cod_func, nro_doc, nombre_completo, count(*) cant,
                min(fecha_inicio) primer_contr, max(fecha_inicio) ult_contr,
                concat_ws("-",min(gestion),max(gestion)) gestiones')
            ->addSelect('exp')
            ->addSelect('lactancia')
            ->addSelect('id_aval')
            ->addSelect('obs_aval')
            ->addSelect('func_id_estado')
            ->addSelect('func_estado')
            ->Estado($request->get('estado'))
            ->Gestion($request->get('op_year'), $request->get('year'))
            ->Search($request->get('field'), $request->get('value'))
            ->Aval($request->get('aval'))
            ->groupBy('id_func', 'cod_func')
            ->Cantidad($request->get('op_cant'), $request->get('cant'))
            ->orderBy('nombre_completo');

        $items_pdf = $rows->get();
        $items = $rows->paginate(25);
        // return $items;
    	$total = $items->total();
    	$years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
        $avales = Aval::get();
        $estados = Estado::get();
        $filter = $this->get_filter($request);

        if (is_null($request->get('pdf')))
    	   return view('personal.acontrato', compact('items', 'total', 'years', 'avales', 'filter', 'estados'));
        else
            return view('pdf.pdf_acontrato', compact('items_pdf', 'filter', 'total'));
    }

}
