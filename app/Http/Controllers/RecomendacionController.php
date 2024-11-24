<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Recomendacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecomendacionController extends Controller
{
    // // Mostrar todas las recomendaciones
    // public function index()
    // {
    //     $recomendaciones = Recomendacion::all();
    //     return view('recomendacion.index', compact('recomendaciones'));
    // }
        public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todos los diagnósticos del usuario autenticado
        $diagnosticos = Diagnostico::where('user_id_cliente', $user->id)
                                ->with('recomendaciones')
                                ->get();

        // Obtener todas las recomendaciones relacionadas con estos diagnósticos
        $recomendaciones = collect();

        foreach ($diagnosticos as $diagnostico) {
            $recomendaciones = $recomendaciones->merge($diagnostico->recomendaciones);
        }

        return view('recomendacion.index', compact('recomendaciones'));
    }
    

    public function create()
{
    // Obtener al usuario autenticado (médico en este caso)
    $user = Auth::user();
 // Obtener los diagnósticos del usuario autenticado
 $diagnosticos = Diagnostico::where('user_id_cliente', $user->id)->with('cliente')->get();
    // Obtener todos los diagnósticos que el médico aún no ha recomendado
    $diagnosticos = Diagnostico::whereDoesntHave('recomendaciones', function ($query) use ($user) {
        $query->where('nombre_medico', $user->name);
    })->get();

    return view('recomendacion.create', compact('diagnosticos'));
}
    //     //crea una nueva recomendacion para ese dianogstico
    //     public function store(Request $request)
    // {
    //     $request->validate([
    //         'diagnostico_id' => 'required|exists:diagnostico,id',
    //         'recomendacion' => 'required|string',
    //     ]);

    //     // Obtener al usuario autenticado (médico en este caso)
    //     $medico = Auth::user();

    //     // Obtener el diagnóstico específico
    //     $diagnostico = Diagnostico::findOrFail($request->diagnostico_id);

    //     // Verificar si ya existe una recomendación para el mismo diagnóstico y médico
    //     $existingRecomendacion = Recomendacion::where('diagnostico_id', $diagnostico->id)
    //                                         ->where('nombre_medico', $medico->name)
    //                                         ->exists();

    //     if ($existingRecomendacion) {
    //         return redirect()->back()->with('error', 'Ya has enviado una recomendación para este diagnóstico.');
    //     }

    //     // Crear una nueva instancia de Recomendacion y asignar los valores
    //     $recomendacion = new Recomendacion();
    //     $recomendacion->diagnostico_id = $diagnostico->id;
    //     $recomendacion->recomendacion = $request->recomendacion;
    //     $recomendacion->nombre_medico = $medico->name; // Guardar el nombre del médico autenticado
    //     $recomendacion->user_id_cliente = $diagnostico->user_id_cliente; // Guardar el ID del cliente asociado al diagnóstico

    //     // Guardar la recomendación
    //     $recomendacion->save();

    //     return redirect()->route('medico.index')->with('success', 'Recomendación creada correctamente');
    // }
    public function store(Request $request)
{
  
    $request->validate([
        'diagnostico_id' => 'required',
        'recomendacion' => 'required|string',
    ]);

    // Obtener al usuario autenticado (médico en este caso)
    $medico = Auth::user();

    // Obtener el diagnóstico específico con sus ecografías
    $diagnostico = Diagnostico::with('ecografias')->findOrFail($request->diagnostico_id);

    //dd($diagnostico);


    // Verificar si ya existe una recomendación para el mismo diagnóstico y médico
    $existingRecomendacion = Recomendacion::where('diagnostico_id', $diagnostico->id)
                                          ->where('nombre_medico', $medico->name)
                                          ->exists();

    if ($existingRecomendacion) {
        return redirect()->back()->with('error', 'Ya has enviado una recomendación para este diagnóstico.');
    }

    // Crear una nueva instancia de Recomendacion y asignar los valores
    $recomendacion = new Recomendacion();
    $recomendacion->diagnostico_id = $diagnostico->id;
    $recomendacion->recomendacion = $request->recomendacion;
    $recomendacion->nombre_medico = $medico->name; // Guardar el nombre del médico autenticado
    $recomendacion->user_id_cliente = $diagnostico->user_id_cliente; // Guardar el ID del cliente asociado al diagnóstico

    // Guardar la recomendación
    $recomendacion->save();

    // Actualizar el campo 'resultado' en la tabla 'diagnostico'
    $diagnostico->resultado = $request->input('resultado'); // Ajusta este campo según sea necesario
    $diagnostico->save();

    
    return redirect()->route('recomendacion.create')->with('success', 'Recomendación creada correctamente');
}

    

    // Mostrar una recomendacion específica
    public function show($id)
    {
        $recomendacion = Recomendacion::findOrFail($id);
        return view('recomendacion.show', compact('recomendacion'));
    }

    // Mostrar el formulario para editar una recomendacion
    public function edit($id)
    {
        $recomendacion = Recomendacion::findOrFail($id);
        return view('recomendacion.edit', compact('recomendacion'));
    }

    // Actualizar una recomendacion existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnostico_id' => 'exists:diagnostico,id',
            'recomendacion' => 'string',
        ]);

        $recomendacion = Recomendacion::findOrFail($id);
        $recomendacion->update($request->all());
        return redirect()->route('recomendacion.index')->with('success', 'Recomendación actualizada correctamente');
    }

    // Eliminar una recomendacion
    public function destroy($id)
    {
        $recomendacion = Recomendacion::findOrFail($id);
        $recomendacion->delete();
        return redirect()->route('recomendacion.index')->with('success', 'Recomendación eliminada correctamente');
    }
}
