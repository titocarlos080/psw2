<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
  
    /*////// Crear al Medico /////*/

    /*Manda al view clienteRegister */
    public function ListarP(){
        $user = Medico::all();
        return view('medico.MedicoRegister', compact('user'));
    }


    /*Manda al view crearCliente */
    public function createMedico(){
        return view('medico.crearMedico');
    }


    public function storedMedico(Request $request)
    {
        $request->validate([
            'ci' => 'required',
            'nombre' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'especialidad' => 'required',
            'sexo' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
    
        DB::beginTransaction();
    
        try {
            // Crear el médico
            $usermedico = Medico::create([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'a_paterno' => $request->a_paterno,
                'a_materno' => $request->a_materno,
                'especialidad' => $request->especialidad,
                'sexo' => $request->sexo,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'estado' => 'h'
            ]);
    
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password'), // Asegúrate de cifrar la contraseña
            ]);
            $user->role = 'medico';
            // Asociar el usuario con el médico
            $usermedico->user_id = $user->id;
            $user->save();
            $usermedico->save();
    
            // Confirmar la transacción
            DB::commit();
    
            return redirect()->route('admin.listarMedico')->with('success', 'Médico creado con éxito');
        } catch (\Exception $e) {
            // Si hay un error, hacer rollback y devolver a la vista anterior
            DB::rollback();
            return redirect()->back()->withInput()->withErrors(['error' => 'Hubo un problema al crear el médico: ' . $e->getMessage()]);
        }
    }
    

    /*////// Elimina a un cliente //// */

    public function destroyMedico(Request $request,$id){
        $user = Medico::find($id);
        $user->delete();

        return redirect()->route('admin.listarMedico');
    }

    /*///// Edita un cliente////// */

    public function editMedico($id){
        $user = Medico::find($id);
        return view('medico.editarMedico',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateMedico(Request $request, $id){
        $user = Medico::find($id);
        $user->ci = $request->ci;
        $user->nombre = $request->nombre;
        $user->a_paterno = $request->a_paterno;
        $user->a_materno = $request->a_materno;
        $user->especialidad = $request->especialidad;
        $user->sexo = $request->sexo;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->estado = $request->estado;
        $user->user_id = $request->user_id;

        $user->save();
        return redirect()->route('admin.listarMedico');

    }


}
