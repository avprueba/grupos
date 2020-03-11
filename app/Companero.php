<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companero extends Model
{
    protected $table = 'companeros';

    // Relación  Muchos a Uno
    public function lider(){
    	return $this->belongsTo('App\Lider', 'lider_id');
    }

}
