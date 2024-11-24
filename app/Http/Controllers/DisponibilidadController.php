<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use App\Models\Medico;
use Illuminate\Http\Request;

class DisponibilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $disponibilidades = Disponibilidad::all();
        $medicos = Medico::all();
        return view('disponibilidad.Disponibilidadlist', compact('disponibilidades','medicos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validación de los datos del formulario
            $request->validate([
                'fecha' => 'required|date',
                'horainicio' => 'required|date_format:H:i',
                'horafin' => 'required|date_format:H:i|after:horainicio',
                'estado' => 'required|in:disponible,terminado,pendiente',
                'cupo' => 'required|integer|min:0',
                'libre' => 'required|integer|min:0|max:' . $request->input('cupo'),
                'user_id_medico' => 'required',
            ]);
    
            $iduser = $request->user_id_medico;
    
            // Busca el médico en la tabla `medicos` donde `user_id` coincide con `$iduser`
            $medico = Medico::where('id', $iduser)->firstOrFail(); // Lanza excepción si no encuentra médico
            //dd($medico);
            $iduser = $medico->user_id;


            // Creación de la disponibilidad
            $disponibilidad = Disponibilidad::create([
                'fecha' => $request->fecha,
                'horainicio' => $request->horainicio,
                'horafin' => $request->horafin,
                'estado' => $request->estado,
                'cupo' => $request->cupo,
                'libre' => $request->libre,
                'user_id_medico' => $iduser,
            ]);
    
            return redirect()->route('disponibilidades.index')->with('success', 'Disponibilidad creada con éxito');
        } catch (\Exception $e) {
            // Manejo de errores: redirecciona con mensaje de error
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al crear la disponibilidad: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $disponibilidad = Disponibilidad::findOrFail($id);
    $medicos = Medico::all();
    return view('disponibilidad.editarDisponibilidad', compact('disponibilidad', 'medicos'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    // Validación de los datos del formulario
    $request->validate([
        'fecha' => 'required|date',
        'horainicio' => 'required|date_format:H:i',
        'horafin' => 'required|date_format:H:i|after:horainicio',
        'estado' => 'required|in:disponible,terminado,pendiente',
        'cupo' => 'required|integer|min:0',
        'libre' => 'required|integer|min:0|max:' . $request->input('cupo', 0),
       
    ]);

    // Encuentra el registro o lanza un error si no se encuentra
    $disponibilidad = Disponibilidad::findOrFail($id);

    // Actualizar campos uno a uno
    $disponibilidad->fecha = $request->input('fecha');
    $disponibilidad->horainicio = $request->input('horainicio');
    $disponibilidad->horafin = $request->input('horafin');
    $disponibilidad->estado = $request->input('estado');
    $disponibilidad->cupo = $request->input('cupo');
    $disponibilidad->libre = $request->input('libre');

    // Guarda los cambios en la base de datos
    $disponibilidad->save();

    // Redirige con mensaje de éxito
    return redirect()->route('disponibilidades.index')->with('success', 'Disponibilidad actualizada con éxito');
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $disponibilidad = Disponibilidad::findOrFail($id);
    $disponibilidad->delete();

    return redirect()->route('disponibilidades.index')->with('success', 'Disponibilidad eliminada con éxito');
}
}
