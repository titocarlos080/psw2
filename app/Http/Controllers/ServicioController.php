<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServicioController extends Controller
{
    //
    public function index(){ 
        $medicos = Medico::all();
        return view('servicio', compact('medicos'));
    }

    public function indexmedic(){
      
        return view('medico.servicio');
    }

    
    public function solicitudAPI(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
        ]);
      

        // Verificar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            // Codificar la imagen en base64
            $base64Imagepasar = 'data:' . $imagen->getMimeType() . ';base64,' . base64_encode(file_get_contents($imagen->path()));
      

        } else {
            return redirect()->back()->with('error', 'Error al enviar la imagen a la API.');
            dd('No se recibió ninguna imagen'); // Punto de depuración
        }
      
        // Preparar los datos para enviar a la API externa
        $apiUrl = 'https://detect.roboflow.com/liver_ultrasound/10';
        $apiKey = 'ez0KYg4w4v0R1U0OkbWh';
    
        $base64Image = base64_encode(file_get_contents($imagen->path()));
    
        try {
          
        // Realizar la solicitud a la API usando HTTP Client de Laravel (Guzzle)
        $response = Http::withHeaders([
           'Content-Type' => 'application/x-www-form-urlencoded',
        ])->post($apiUrl . '?api_key=' . $apiKey , [ $base64Image] // Enviar la imagen codificada en base64 como 'file'
            );
      
        //   dd(' respuesta de la API', $response);
            // Manejar la respuesta de la API
            if ($response->successful()) {

                $responseData = $response->json();
             //   dd('Respuesta exitosa', $responseData); // Punto de depuración
                $jsonencore = json_encode($responseData);
                $dataApi = json_decode($jsonencore);

                $responseData22 = json_decode($jsonencore, true);
                                    // Iterar sobre las predicciones y mostrar mensajes específicos
               // dd('Respuesta exitosa', $jsonencore);
             //   $interpretacion =$this->identificar($responseData22);
                $userId =  auth()->user()->id;

              // dd('Respuesta exitosa', $jsonencore);
                return view('medico.servicioresultado', compact('dataApi','base64Imagepasar','jsonencore'));
             //   return redirect()->back()->with('success', 'Imagen enviada correctamente. Respuesta: ' . json_encode($responseData));
            } else {
              //  dd('Error en la respuesta de la API', $response); // Punto de depuración
                return redirect()->back()->with('error', 'Error al enviar la imagen a la API.');
            }
        } catch (\Exception $e) {
          //  dd('Error de excepción', $e); // Punto de depuración
            return redirect()->back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }

}
