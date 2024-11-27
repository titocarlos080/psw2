<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SessionsController extends Controller{
    public function create(){

        return view('auth.login');
    }
    public function store(Request $request){

 // Validar hCaptcha
            $request->validate([
                'h-captcha-response' => 'required', // Aseguramos que el captcha haya sido respondido
            ], [
                'h-captcha-response.required' => 'Por favor, resuelve el captcha correctamente.',
            ]);
        // Verificar la respuesta del hCaptcha
        $response = Http::asForm()->post('https://hcaptcha.com/siteverify', [
            'secret' => 'ES_4351f30a6fbb430ead562e76d3a22db5', // Aquí va tu clave secreta
            'response' => $request->input('h-captcha-response')
        ]);

        $responseData = $response->json();

        // Si la validación del captcha falla
        if (!$responseData['success']) {
            return back()->withErrors(['message' => 'Por favor, resuelve el captcha correctamente.']);
        }
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
