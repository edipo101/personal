<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    public function scopeSearch($query, $field, $value){
    	if ($value != "")
    		if ($field == 'nro')
    			$query->where('nro_contrato', 'like', '%'.$value.'%');	
    		// else if ($field == 'nombre') 
      //           $query->where('nombre_completo', 'like', '%'.$value.'%');
            else
                $query->where($field, $value);
    }

    public function scopeId($query, $value){
    	if ($value != "")
    		$query->where('id', $value);
    }

    public function scopeGestion($query, $value){
        if ($value != '')
            $query->where('gestion', $value);
    }
}
