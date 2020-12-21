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
    	// $items = ViewPersonalContrato::
    	// 	Search($request->get('field'), $request->get('value'))
     //    ->Gestion($request->get('year'))
    	// 	->paginate(25);	

    	$items = ViewFuncionario::
    		select('*'
    			// , (function($query){ 
     		// 		$query->selectRaw('count(*) cant') 
       // 			->from('contratos') 
       // 			->where('contratos.id_func', 'id')
       // 			// ->get()->count();
    			// }) cant
    		)
    		// ->leftJoin()
    		->paginate(25);	
    	$total = $items->total();
    	return $items;
    	$years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->get()->pluck('gestion');
    	return view('personal.acontrato', compact('items', 'total', 'years'));
    }
}
