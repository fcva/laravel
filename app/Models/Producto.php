<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder,Model};

class Producto extends Model
{
    protected $table = 'productos';

    protected $guarded = [];

    public function scopeBuscar(Builder, $builder, $producto)
    {

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
