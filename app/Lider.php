<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lider extends Model
{
    protected $table = 'lideres';

    // Relación Uno a Muchos
    public function companeros(){
    	return $this->hasMany('App\Companero');
    
    }
}
