<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    public function scopeSearch($query, $field, $value){
    	if ($value != "")
    		if ($field == 'nro')
    			$query->where('nro_contrato', 'like', $value.'%');	
    		else $query->where($field, $value);
    }

    public function scopeId($query, $value){
    	if ($value != "")
    		$query->where('id', $value);
    }
}
