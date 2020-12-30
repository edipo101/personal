<?php

namespace App\Http\Controllers;

use App\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getItems(Request $request){
    	$items = Unidad::where('id_depend', $request->get('id_secre'))->get();
    	return $items;
    }
}
