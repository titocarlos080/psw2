<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $table = 'diagnostico';

    protected $fillable = [
        'id',
        'resultado_ia',
        'resultado',
        'estado',
        'confidence',
        'data',
        'user_id_cliente',
        'user_id_medico',
    ];

    // Aquí puedes definir relaciones con otros modelos si es necesario

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id_cliente');
    }

    public function medico()
    {
        return $this->belongsTo(User::class, 'user_id_medico');
    }
    public function ecografias()
    {
        return $this->hasMany(Ecografia::class, 'id_diagnostico');
    }

    // Definir la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Definir la relación con el modelo Recomendacion
    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class, 'diagnostico_id');
    }
}
