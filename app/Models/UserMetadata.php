<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetadata extends Model
{
    use HasFactory;
    protected $guarded = [];
    //public $timestamps = false para que no sean obligatorios el create_ad_ y update_at
    protected $table = 'user_metadata';

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function perfil(){
        return $this->belongsTo(Perfil::class);
    }
}
