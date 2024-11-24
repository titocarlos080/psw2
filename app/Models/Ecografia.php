<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecografia extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'path',
        'id_diagnostico',
    ];

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'id_diagnostico');
    }
}
