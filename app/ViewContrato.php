<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ViewContrato extends Model
{
	protected $table = 'view_contratos';

	public function scopeSearch($query, $field, $value){
		if ($value != "")
			switch ($field) {
				case 'nro':
					$query->where('nro_contrato', 'like', '%'.$value.'%');
					break;
				case 'nombre':
					$query->where('nombre_completo', 'like', '%'.$value.'%');
					break;
				default:
					$query->where($field, $value);
					break;
			}
	}

	public function scopeEstado($query, $value){
		if ($value != '')
			switch ($value) {
				case 'NULL':
					$query->whereNull('func_id_estado');
					break;
				
				default:
					$query->where('func_id_estado', $value);
					break;
			}			
	}

	public function scopeGestion($query, $operator, $value){
		if (($operator != '') && ($value != ''))
			$query->where('gestion', $operator, $value);
	}

	public function scopeIdFunc($query, $value){
		if ($value != '')
			$query->where('id_func', $value);
	}

	public function scopeSecretaria($query, $value){
		if ($value != '')
			$query->where('dependencia_id', $value);
	}

	public function scopeUnidad($query, $value){
		if ($value != '')
			$query->where('unidad_id', $value);
	}

	public function scopeCantidad($query, $operator, $value){
		if (($operator != '') && ($value != ''))
			$query->havingRaw('count(*)'.$operator.$value);
	}

	public function scopeAval($query, $value){
		if ($value != '')
			switch ($value) {
				case 'NULL':
					$query->whereNull('aval');
					break;

				case 'sin_aval':
					$query->where('aval', 'NOT LIKE', '%LACTANCIA%');
					$query->where('aval', 'NOT LIKE', '%CODEPEDIS%');
					break;
				
				default:
					$query->where('aval', $value);
					break;
			}			
	}
}
