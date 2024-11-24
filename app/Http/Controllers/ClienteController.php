<?php

namespace App\Http\Controllers;

use App\Models\bitacora;
use Illuminate\Http\Request;
use App\Models\cliente;
use PDF;
// tiene que ser inportado



class ClienteController extends Controller
{
    
    /*////// Crear al cliente /////*/

    /*Manda al view clienteRegister */
    public function ListarC(){
        $user = cliente::all();
        return view('cliente.ClienteRegister', compact('user'));
        
    }

    /*Manda al view crearCliente */
    public function createCliente(){
        return view('cliente.crearCliente');
    }



    /*Guarda los datos del cliente */
    public function storedCliente(Request $request){
        $this->validate(request(),['ci'=>'required',
                                                   'nombre'=>'required',
                                                   'a_paterno'=>'required',
                                                   'a_materno'=>'required',
                                                   'sexo'=>'required',
                                                   'telefono'=>'required',
                                                   'direccion'=>'required']);


        $user = cliente::create(request(['ci','nombre','a_paterno','a_materno','sexo','telefono','direccion']));
        $user->estado='h';
       
        
        $user->save();

      

        return redirect()->route('admin.listarcliente');     
    }

    /*////// Elimina a un cliente //// */

    public function destroyCliente($id, Request $request){
        $user = cliente::find($id);
        $user->delete();
    
        return redirect()->route('admin.listarcliente');
    }

    /*///// Edita un cliente////// */

    public function editCliente($id){
        $user = cliente::find($id);
        return view('cliente.editarCliente',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateCliente(Request $request, $id){
        $user = cliente::find($id);
        $user->ci = $request->ci;
        $user->nombre = $request->nombre;
        $user->a_paterno = $request->a_paterno;
        $user->a_materno = $request->a_materno;
        $user->sexo = $request->sexo;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->estado = $request->estado;
       
        $user->save();
         
     


        return redirect()->route('admin.listarcliente');

    }
}
