<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Funcionario;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total['tot_func'] = Contrato::select('id_func')->groupBy('id_func')->get()->count();
        $total['tot_contr'] = Contrato::get()->count();
        // return $total;
        return view('home', compact('total'));
    }
}
