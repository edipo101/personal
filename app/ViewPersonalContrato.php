<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewPersonalContrato extends Model
{
	protected $table = 'view_personal_acontrato';

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

	public function scopeGestion($query, $value){
		if ($value != '')
			$query->where('gestion', $value);
	}
}
