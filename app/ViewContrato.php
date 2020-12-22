<?php

namespace App;

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

	public function scopeGestion($query, $operator, $value){
		if (($operator != '') && ($value != ''))
			$query->where('gestion', $operator, $value);
	}

	public function scopeCantidad($query, $operator, $value){
		if (($operator != '') && ($value != ''))
			$query->havingRaw('count(*)'.$operator.$value);
	}

	public function scopeAval($query, $value){
		if ($value != '')
			$query->where('aval', $value);
	}
}
