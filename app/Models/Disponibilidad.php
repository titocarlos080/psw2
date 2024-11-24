<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'horainicio',
        'horafin',
        'estado',
        'cupo',
        'libre',
        'user_id_medico',
    ];

     public function user()
     {
         return $this->belongsTo(User::class, 'user_id_medico');
     }

     public function citas()
     {
         return $this->hasMany(Cita::class, 'disponibilidad_id');
     }

}
