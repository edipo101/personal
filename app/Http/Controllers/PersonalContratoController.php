<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\ViewFuncionario;
use App\ViewPersonalContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalContratoController extends Controller
{
    public function index(Request $request){
    	$items = ViewFuncionario::addSelect([
            'cant' => Contrato::selectRaw('count(*)')            
                ->Gestion($request->get('year'))
                ->whereColumn('contratos.id_func', 'view_funcionarios.id')
    		])
            ->Search($request->get('field'), $request->get('value'))
            // ->where('cant', 4)
    		->paginate(25);	
        // $items = $items->where('cant', 9)->paginate(25);
    	$total = $items->total();
        return $items;
    	$years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
    	return view('personal.acontrato', compact('items', 'total', 'years'));
    }
}
