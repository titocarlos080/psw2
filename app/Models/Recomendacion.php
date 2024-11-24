<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    use HasFactory;

    protected $table = 'recomendaciones';

    protected $fillable = [
        'diagnostico_id',
        'recomendacion',
        'nombre_medico', // Nuevo campo para almacenar el nombre del médico
        'user_id_cliente'
    ];

    // Definir la relación con el modelo Diagnostico
    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'diagnostico_id');
    }
}
