<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use WangID\Scanner\Scanner;

use App\Models\bitacora;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

use App\Models\Cliente;
use App\Models\Cita;
use App\Models\User;
use App\Models\Diagnostico;
use Aws\SavingsPlans\Exception\SavingsPlansException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Client;


class ApiController extends Controller
{
    //
    public function login(Request $request){
        $user = $request->validate(['email'=>'required|email',
                                    'password'=>'required',
                                   ]);
        //$user = User::all();
        
        if(!Auth::attempt($user))
        {
          return  response([ 'mensaje' =>'credenciales invalidos'],404);

        }

        $token = $request->token;

        $user=User::where('email',$request->email)->firstOrFail();
        $user->tokenNotificacion=$token;
        $user->save();

        return response( ['user'=>auth()->user()  ,
                        'token'=>Auth()->user()->createtoken('secret')->plainTextToken
                        ],200);
        //return redirect()->route('admin.registrarusuario');
    }

    public function logout(){

        auth()->user()->tokens()->delete();    // error al crear el token sera corregido posteriormente
        return response( [ 'mensaje'=>'logout success',
                         ],200);
        //return redirect()->route('admin.registrarusuario');
    }

    public function citas(Request $request,$id)
    {
        // Obtiene el usuario autenticado
        $user = User::find($id);

        // Recupera las citas relacionadas con el cliente autenticado y las ordena desde la más reciente
        $citas = Cita::where('user_id_cliente', $user->id)
                     ->orderBy('created_at', 'desc')->get() ; // Cambiado a paginate() para la paginación
    
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return response(['citas'=>$citas],200);;

    }

    public function diagnosticos(Request $request,$id)
    {
        // Obtiene el usuario autenticado
        $user = User::find($id);
       // Obtener todos los diagnósticos del usuario autenticado con la relación 'medico' cargada
       $diagnosticos = Diagnostico::where('user_id_cliente', $user->id)
       ->with('medico', 'ecografias') // Cargar la relaciónes 'medico y imagenes'
       ->get();
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return response(['diagnosticos'=>$diagnosticos],200);;

    }
    public function recomendaciones(Request $request,$id)
    {
        // Obtiene el usuario autenticado
        $user = User::find($id);
        // Obtener todos los diagnósticos del usuario autenticado
        $diagnosticos = Diagnostico::where('user_id_cliente', $user->id)
                                ->with('recomendaciones')
                                ->get();

        // Obtener todas las recomendaciones relacionadas con estos diagnósticos
        $recomendaciones = collect();

        foreach ($diagnosticos as $diagnostico) {
            $recomendaciones = $recomendaciones->merge($diagnostico->recomendaciones);
        }
       
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return response(['recomendaciones'=>$recomendaciones],200);;

    }



}
