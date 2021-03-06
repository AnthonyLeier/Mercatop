<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'fotos';
    protected $primaryKey = 'id';

	function produto(){
    	return $this->belongsTo('App\Produto', 'id_produto', 'id');
    }
}

