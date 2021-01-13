<?php

use App\Aval;
use App\Dependencia;
use App\Estado;
use App\EstadoContrato;
use App\Observacion;
use App\Unidad;

function get_filter($request){
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
		$filter['danger'] = 'Estado func.: '.Estado::where('id', request('estado'))->pluck('estado')->first();

if (request('func_obs') != '') //Estado funcionario
	if (request('func_obs') == 'NULL')
		$filter['navy'] = 'Observaciones: SIN DEFINIR';
	else
		$filter['navy'] = 'Observaciones: '.Observacion::where('id', request('func_obs'))->pluck('detalle')->first();

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
		$filter['warning'] = 'Aval: '.Aval::where('id', request('aval'))->pluck('aval')->first();
		break;
	}

	if (request('secre') != '')
		$filter['maroon'] = 'Secretaria: '.Dependencia::where('id', request('secre'))->pluck('nombre_corto')->first();

	if (request('unid') != '')
		$filter['olive'] = 'Unidad: '.Unidad::where('id', request('unid'))->pluck('nombre')->first();

	if (request('estado_contr') != '')
		$filter['teal'] = 'Estado contr.: '.EstadoContrato::where('id', request('estado_contr'))->pluck('estado')->first();

	if (count($filter) > 1) $filter['all'] = 'Filtros:';
	return $filter;
}