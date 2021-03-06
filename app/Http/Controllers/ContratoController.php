<?php

namespace App\Http\Controllers;

use App\Aval;
use App\Contrato;
use App\Dependencia;
use App\Estado;
use App\EstadoContrato;
use App\Unidad;
use App\ViewContrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $rows = ViewContrato::
            Search($request->get('field'), $request->get('value'))
            ->where('gestion', '<=', 2020)
            ->IdFunc($request->get('id_func'))
            ->Unidad($request->get('unid'))
            ->Secretaria($request->get('secre'))
            ->Gestion($request->get('op_year'), $request->get('year'));

        if (!is_null($request->get('pdf'))){
            $rows->orderBy('dependencia');
            $rows->orderBy('unidad');
        }
        else
            $rows->orderBy('nombre_completo');

        $items_pdf = $rows->orderBy('gestion', 'desc')->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $years = Contrato::select('gestion')->orderBy('gestion', 'desc')->groupBy('gestion')->having('gestion', '<=', 2020)->get()->pluck('gestion');
        $secretarias = Dependencia::get();
        $unidades = (!is_null(request('secre'))) ? Unidad::where('id_depend', request('secre'))->get() : null;
        $filter = get_filter($request);

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('contratos.list', compact('items', 'total', 'years', 'secretarias', 'unidades', 'filter'));
        else
            switch ($request->get('pdf')) {
                case '2':
                    return view('pdf.pdf_contratos_bysecre', compact('items_pdf', 'total', 'filter'));
                    break;
                case '3':
                    return view('pdf.pdf_contratos_byunid', compact('items_pdf', 'total', 'filter'));
                    break;
                default:
                    return view('pdf.pdf_contratos', compact('items_pdf', 'total', 'filter'));
                    break;
            }
    }

    public function gestion_2021(Request $request){
        $rows = ViewContrato::
            Search($request->get('field'), $request->get('value'))
            ->IdFunc($request->get('id_func'))
            ->Unidad($request->get('unid'))
            ->Secretaria($request->get('secre'))
            ->EstadoContrato($request->get('estado_contr'))
            ->where('gestion', 2021);
            // ->orderBy('id', 'desc');

        if (!is_null($request->get('pdf'))){
            $rows->orderBy('dependencia');
            $rows->orderBy('unidad');
        }
        else
            $rows->orderBy('id', 'desc');

        $items_pdf = $rows->orderBy('gestion', 'desc')->get();
        $items = $rows->paginate(25);
        $total = $items->total();
        $secretarias = Dependencia::get();
        $unidades = (!is_null(request('secre'))) ? Unidad::where('id_depend', request('secre'))->get() : null;
        $filter = get_filter($request);
        $gestion = 2021;
        $estados = EstadoContrato::get();

        if (is_null($request->get('pdf')))
            if (!is_null($request->get('type'))){
                return $items_pdf;
            }
            else
                return view('contratos.contr_2021', compact('items', 'total', 'secretarias', 'unidades', 'filter', 'estados'));
        else
            switch ($request->get('pdf')) {
                case '2':
                    return view('pdf.pdf_contratos_bysecre', compact('items_pdf', 'total', 'filter', 'gestion'));
                    break;
                case '3':
                    return view('pdf.pdf_contratos_byunid', compact('items_pdf', 'total', 'filter', 'gestion'));
                    break;
                default:
                    return view('pdf.pdf_contratos', compact('items_pdf', 'total', 'filter', 'gestion'));
                    break;
            }
    }

    public function create(){
        $item = new Contrato;
        $secretarias = Dependencia::get();
        $unidades = (!is_null(old('secretaria'))) ? Unidad::where('id_depend', old('secretaria'))->get() : null;
        $estados = EstadoContrato::get();
        return view('contratos.contr_create', compact('item', 'secretarias', 'unidades', 'estados'));
    }

    public function acefalo(){
        $item = new Contrato;
        $secretarias = Dependencia::get();
        $unidades = (!is_null(old('secretaria'))) ? Unidad::where('id_depend', old('secretaria'))->get() : null;
        $estados = EstadoContrato::get();
        return view('contratos.contr_acefalo', compact('item', 'secretarias', 'unidades', 'estados'));
    }

    private function getValidate(){
        $validate = [
            // 'nro_doc' => 'required',
            // 'nombre' => 'required',
            'cargo' => 'required',
            'secretaria' => 'required',
            'unidad' => 'required',
            // 'fecha_inicio' => 'required',
            // 'fecha_final' => 'required',
            'estado' => 'required',
        ];
        return $validate;
    }

    private function getMessages(){
        $messages = [
            // 'nro_doc.required' => 'Requerido',
            // 'nombre.required' => 'Requerido',
            'cargo.required' => 'Requerido',
            'secretaria.required' => 'Requerido',
            'unidad.required' => 'Requerido',
            // 'fecha_inicio.required' => 'Requerido',
            // 'fecha_final.required' => 'Requerido',
            'estado.required' => 'Requerido',
        ];
        return $messages;
    }

    public function store(Request $request)
    {
        $validate = $this->getValidate();
        $validatedData = $request->validate($validate, $this->getMessages());
        // return $request;
        $item = new Contrato;
        $cant = Contrato::selectRaw('count(*) as cant')->where('gestion', 2021)->pluck('cant')->first();
        $item->nro_contrato = $cant + 1;
        $item->id_func = request('id_func');
        $item->cargo = strtoupper(request('cargo'));
        $item->gestion = 2021;
        $item->dependencia_id = request('secretaria');
        $item->unidad_id = request('unidad');
        if (!is_null(request('fecha_inicio'))){
            $date = str_replace('/', '-', request('fecha_inicio'));
            $fecha = date("Y-m-d", strtotime($date));
            $item->fecha_inicio = $fecha;
        }
        else
            $item->fecha_inicio = null;
        if (!is_null(request('fecha_final'))){
            $date = str_replace('/', '-', request('fecha_final'));
            $fecha = date("Y-m-d", strtotime($date));
            $item->fecha_final = $fecha;
        }
        else
            $item->fecha_final = null;
        $item->sueldo = request('sueldo');
        $item->id_estado = request('estado');
        $item->observaciones = strtoupper(request('obs'));
        // return $item;
        $item->save();
        return redirect(request('url_previous'));
    }

    public function store_acefalo(Request $request){
        // return $request;
        $validate = [
            'cargo' => 'required',
            'secretaria' => 'required',
            'unidad' => 'required',
            'estado' => 'required',
        ];
        $messages = [
            'cargo.required' => 'Requerido',
            'secretaria.required' => 'Requerido',
            'unidad.required' => 'Requerido',
            'estado.required' => 'Requerido',
        ];
        $validatedData = $request->validate($validate, $messages);
        $item = new Contrato;
        $cant = Contrato::selectRaw('count(*) as cant')->where('gestion', 2021)->pluck('cant')->first();
        $item->nro_contrato = $cant + 1;
        $item->cargo = strtoupper(request('cargo'));
        $item->gestion = 2021;
        $item->dependencia_id = request('secretaria');
        $item->unidad_id = request('unidad');
        $item->sueldo = request('sueldo');
        $item->id_estado = request('estado');
        $item->observaciones = strtoupper(request('obs'));
        // return $item;
        $item->save();
        return redirect(request('url_previous'));
    }

    public function show(Contrato $contrato)
    {
        //
    }

    public function edit($id)
    {
        $item = ViewContrato::FindOrFail($id);

        $secretarias = Dependencia::get();
        $unidades = (!is_null(old('secretaria', $item->dependencia_id))) ? Unidad::where('id_depend', old('secretaria', $item->dependencia_id))->get() : null;
        $estados = EstadoContrato::get();
        return view('contratos.contr_edit', compact('item', 'secretarias', 'unidades', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $validate = $this->getValidate();
        $validatedData = $request->validate($validate, $this->getMessages());
        // return $request;
        $item = Contrato::FindOrFail($id);
        // $cant = Contrato::selectRaw('count(*) as cant')->where('gestion', 2021)->pluck('cant')->first();
        // $item->nro_contrato = $cant + 1;
        $item->id_func = request('id_func');
        $item->cargo = strtoupper(request('cargo'));
        $item->gestion = 2021;
        $item->dependencia_id = request('secretaria');
        $item->unidad_id = request('unidad');
        if (!is_null(request('fecha_inicio'))){
            $date = str_replace('/', '-', request('fecha_inicio'));
            $fecha = date("Y-m-d", strtotime($date));
            $item->fecha_inicio = $fecha;
        }
        else
            $item->fecha_inicio = null;
        if (!is_null(request('fecha_final'))){
            $date = str_replace('/', '-', request('fecha_final'));
            $fecha = date("Y-m-d", strtotime($date));
            $item->fecha_final = $fecha;
        }
        else
            $item->fecha_final = null;
        $item->sueldo = request('sueldo');
        $item->id_estado = request('estado');
        $item->observaciones = strtoupper(request('obs'));
        // return $item;
        $item->save();
        return redirect(request('url_previous'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contr = Contrato::find(request('id'));
        if ($contr)
            $contr->delete();
        return redirect(url()->previous());
    }
}
