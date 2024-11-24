<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bitacora;

class AdminController extends Controller{
     
    public function index(){
        return view('admin.index');
    }
    public function indexmedico(){
        return view('medico.index');
    }
    public function indexcliente(){
        return view('cliente.index');
    }

    /*/////////////////////////////////////////////////////////////////
    /////////////////  Funciones para los clientes ////////////////////
    /////////////////////////////////////////////////////////////////// */

    /*////// Crear al cliente /////*/

    /*Manda al view clienteRegister */
    public function registrarC(){
        $user = User::all();
        return view('admin.ClienteRegister', compact('user'));
        
    }
    /*Manda al view crearCliente */
    public function createCliente(){
        return view('admin.crearCliente');
    }
    /*Guarda los datos del cliente */
    public function storedCliente(){
        $this->validate(request(),['carnet'=>'required','name'=>'required','email'=>'required|email','password'=>'required|confirmed',]);
        $user = User::create(request(['carnet','name','email','password']));
        $user->role='cliente';
        
        $user->save();
        return redirect()->route('admin.registrarcliente');     
    }

    /*////// Elimina a un cliente //// */

    public function destroyCliente($id){
        $user = User::find($id);
  
        $user->delete();
        return redirect()->route('admin.registrarcliente');
    }

    /*///// Edita un cliente////// */

    public function editCliente($id){
        $user = User::find($id);
        return view('admin.editarCliente',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateCliente(Request $request, $id){
        $user = User::find($id);
        $user->carnet = $request->carnet;
        $user->name = $request->name;
        $user->email = $request->email;

    

        $user->save();
        return redirect()->route('admin.registrarcliente');

    }
    


    /*////////////////////////////////////////////////////////////////////
    /////////////////  Funciones para los Usuarios ////////////////////
    ////////////////////////////////////////////////////////////////////// */

        /*////// Crear Usuario /////*/

    /*Manda al view UsuarioRegister */
    public function registrarU(){
        $user = User::all();
        return view('admin.UsuarioRegister', compact('user'));
    }

    /*Manda al view Usuario*/
    public function createUsuario(){
        return view('admin.crearUsuario');
    }

    /*Guarda los datos del Usuario */
    public function storedUsuario(){
        $this->validate(request(),['name'=>'required','email'=>'required|email','password'=>'required|confirmed',]);
        $user = User::create(request(['name','email','password']));
        $user->role='cliente';
        $user->save();
        return redirect()->route('admin.registrarusuario');
    }

    /*////// Elimina a un Usuario //// */
    public function destroyUsuario($id){
        $user = User::find($id);

        $user->delete();
       
        return redirect()->route('admin.registrarusuario');
    }





    /*///// Edita un Usuario////// */
    public function editUsuario($id){
        $user = User::find($id);
        return view('admin.editarUsuario',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateUsuario(Request $request, $id){
        $user = User::find($id);
     
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->save();
    
        return redirect()->route('admin.registrarusuario');

    }


 

}

    
