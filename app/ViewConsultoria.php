<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewConsultoria extends Model
{
	protected $table = 'view_consultorias';

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

	public function scopeEstadoContrato($query, $value){
		if ($value != '')
			switch ($value) {
				case 'NULL':
					$query->whereNull('id_estado');
					break;

				default:
					$query->where('id_estado', $value);
					break;
			}
	}
}
