<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewFuncionario extends Model
{
	protected $table = 'view_funcionarios';

	public function addCantidadSelect(){
		return 10;
	}

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

	public function scopeAval($query, $value){
		if ($value != '')
			switch ($value) {
				case 'lac_cod':
					$query->where('lactancia', 1);
					$query->where('codepedis', 1);
					break;
				case 'lac_cont':
					$query->where('lactancia', 1);
					$query->where('continuidad', 1);
					break;
				case 'cod_cont':
					$query->where('codepedis', 1);
					$query->where('continuidad', 1);
					break;
			}			
	}

}
