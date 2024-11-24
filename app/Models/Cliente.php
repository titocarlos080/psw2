<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;


    //obligatorio para editar 

    protected $fillable =[
        'ci',
        'nombre',
        'a_paterno',
        'a_materno',
        'sexo',
        'telefono',
        'direccion',
        'estado',
        'user_id'
      
    ];


  
    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
