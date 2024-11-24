<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bitacora;


class SessionsController extends Controller{
    public function create(){

        return view('auth.login');
    }
    public function store(Request $request){
        if(auth()->attempt(request(['email','password']))==false){
            return back()->withErrors(['message'=> 'the email or password is incorrect, please try again']);
        }else{
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.index');
            }else{
                if(auth()->user()->role == 'medico'){
                    return redirect()->route('medico.index');
                }else{
                    if(auth()->user()->role == 'cliente'){
                        return redirect()->route('index');
                    }
                    
                }
            }
        }
        
    }

    public function destroy(Request $request){
        auth()->logout();
        return redirect()->to('/');
    }


    
}
