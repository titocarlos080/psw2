<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackUpController extends Controller
{
    //

    public function index() 
    {
        return view("admin.backup");
        
    }

     // Crear un respaldo
     public function create()
     {
         // Aquí puedes generar un respaldo de la base de datos.
         // Por ejemplo, puedes usar un paquete como Spatie Backup.
         
         // Simulación: Guardar un archivo de ejemplo
         $filename = 'backup_' . now()->format('Y-m-d_H-i-s') . '.sql';
         Storage::disk('backups')->put($filename, 'Contenido del respaldo');
         
         return redirect()->back()->with('success', 'BackUp creado exitosamente.');
     }
 
     // Descargar un respaldo
     public function download($filename)
     {
         if (Storage::disk('backups')->exists($filename)) {
             return Storage::disk('backups')->download($filename);
         }
 
         return redirect()->back()->with('error', 'El archivo no existe.');
     }
}
