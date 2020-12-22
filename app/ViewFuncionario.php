<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewFuncionario extends Model
{
	protected $table = 'view_funcionarios';

	// public getCantidadAttribute(){
		
	// }

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
}
