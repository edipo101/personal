<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewConsultoria extends Model
{
    protected $table = 'view_consultorias';

    public function scopeGestion($query, $operator, $value){
		if (($operator != '') && ($value != ''))
			$query->where('gestion', $operator, $value);
	}

	public function scopeUnidad($query, $value){
		if ($value != '')
			$query->where('unidad_id', $value);
	}
}
