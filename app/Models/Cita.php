<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{

    protected $fillable = [
        'fecha',
        'hora',
        'detalles',
        'estado',
        'user_id_cliente',
        'disponibilidad_id'
    ];

    use HasFactory;

    public function getEstadoFormattedAttribute()
    {
        return ucfirst($this->estado);
    }

        // Definir la relación con el modelo User
    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id_cliente');
    }
    
    public function disponibilidad()
    {
        return $this->belongsTo(Disponibilidad::class, 'disponibilidad_id');
    }



}
