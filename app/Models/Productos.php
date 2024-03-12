<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;

class Productos extends Model
{
    use HasFactory;
    protected $guarded=[];
    //public $timestamps = false;
    protected $table = 'productos';

    /*Esto sirve para indicarle a laravel la realcion que existe de productos y categorias*/
    public function categorias(){
        return $this->belongsTo(Categorias::class);
    }

}
