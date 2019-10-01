<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table="productos";
    protected $primaryKey="id";
    protected $fillable=['user_id','codigo','nombre','marca','modelo'];
    public $timestamps=false;
}
