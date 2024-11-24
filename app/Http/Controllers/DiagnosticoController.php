<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Diagnostico;
use App\Models\Ecografia;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DiagnosticoController extends Controller
{   public function changeTheme(Request $request)
    {
        $request->validate(['theme' => 'required|string']);
        session(['theme' => $request->theme]);
        return response()->json(['status' => 'success']);
    }
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
    
        // Obtener todos los diagnósticos del usuario autenticado con la relación 'medico' cargada
        $diagnosticos = Diagnostico::where('user_id_cliente', $user->id)
                                   ->with('medico', 'ecografias') // Cargar la relaciónes 'medico y imagenes'
                                   ->get();
    
        return view('diagnosticos.index', compact('diagnosticos'));
    }


    public function create()
    {   $users = Cliente::all();
        return view('diagnosticos.create',compact('users')); // Mostrar la vista para crear un nuevo diagnóstico
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'ci' => 'required|integer',
    //         'nombre' => 'required|string|max:30',
    //         'a_paterno' => 'required|string|max:30',
    //         'a_materno' => 'required|string|max:30',
           
    //     ]);
           
    //     Diagnostico::create($request->all()); // Crear un nuevo diagnóstico en la base de datos
    //     return redirect()->route('diagnosticos.create')->with('success', 'Diagnóstico creado exitosamente.');
    // }
    public function store(Request $request)
{
    $request->validate([
        'ci' => 'required|integer',
        'nombre' => 'required|string',
        'a_paterno' => 'required|string',
        'a_materno' => 'required|string',
    ]);
    // Validar la solicitud
    $request->validate([
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
    ]);
  
     

    // Verificar la imagen
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
       // dd('Imagen recibida', $imagen); // Punto de depuración
       $file = $request->file('imagen');
       $filename = time() . '_' . $imagen->getClientOriginalName();
       $filePath = $file->storeAs('public/documents', $filename);
        
       $filePath = Storage::url($filePath);

    } else {
        return redirect()->back()->with('error', 'Error al enviar la imagen a la API.');
        dd('No se recibió ninguna imagen'); // Punto de depuración
    }


    try {
         // Obtener el ID del usuario autenticado que es medico
         $userIdmedico = Auth::id();
       
         $medico = Medico::where('user_id', $userIdmedico)->first();
            // Obtener el ID del cliente seleccionado
            $userid = $request->input('user_id');
            // Buscar al cliente en la base de datos
            $cliente = Cliente::find($userid);

            if ($medico) { 
                $medicouser = $medico->user;
                $medicouserid = $medicouser ? $medicouser->id : null;
            } else {
                $medicouserid = null;
            }
           

            $interpretacion = 'procesando..';
            $jsonencore = 'procesando..';

           $diagnosticonew = Diagnostico::create([
            
            'resultado_ia' =>  $interpretacion,
            'resultado'=> 'en espera',
            'estado'=> 'revision',
            'confidence'=> '80%',
            'data'=> $jsonencore ,
            'user_id_cliente' =>  $cliente->user->id ,
            'user_id_medico'=> $medicouserid,
            ]);

           $ecogrfianew =  Ecografia::create([
                'path' => $filePath,
                'id_diagnostico'=> $diagnosticonew->id,    
        ]);
         //  dd('Respuesta exitosa', $jsonencore);
         return redirect()->back()->with('success', 'El diagnóstico se ha creado exitosamente.');

         //   return redirect()->back()->with('success', 'Imagen enviada correctamente. Respuesta: ' . json_encode($responseData));
        
    } catch (\Exception $e) {
      //  dd('Error de excepción', $e); // Punto de depuración
        return redirect()->back()->with('error', 'Error al conectar el servicio: ' . $e->getMessage());
    }

}

    public function show($id)
    {
        $diagnostico = Diagnostico::find($id); // Obtener el diagnóstico con el ID proporcionado
        return view('diagnosticos.show', compact('diagnostico')); // Mostrar la vista show con el diagnóstico
    }

    public function edit($id)
    {
        $diagnostico = Diagnostico::find($id); // Obtener el diagnóstico con el ID proporcionado
        return view('diagnosticos.edit', compact('diagnostico')); // Mostrar la vista edit con el diagnóstico
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ci' => 'required|integer',
            'nombre' => 'required|string|max:30',
            'a_paterno' => 'required|string|max:30',
            'a_materno' => 'required|string|max:30',
        ]);

        Diagnostico::find($id)->update($request->all()); // Actualizar el diagnóstico con los datos proporcionados
        return redirect()->route('diagnosticos.index')->with('success', 'Diagnóstico actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Diagnostico::destroy($id); // Eliminar el diagnóstico con el ID proporcionado
        return redirect()->route('diagnosticos.index')->with('success', 'Diagnóstico eliminado exitosamente.');
    }


    public function createsolicitud()
    {
        return view('diagnosticos.solicitudAPI'); // Mostrar la vista para crear un nuevo diagnóstico
    }

    public function solicitudAPI(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
        ]);
        $request->validate([
            'medico' => 'required|exists:medicos,id',
        ]);

        // Obtener el ID del médico seleccionado
        $medicoId = $request->input('medico');

        // Buscar al médico en la base de datos
        $medico = Medico::find($medicoId);

        // Verificar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
           // dd('Imagen recibida', $imagen); // Punto de depuración
           $file = $request->file('imagen');
           $filename = time() . '_' . $imagen->getClientOriginalName();
           $filePath = $file->storeAs('public/documents', $filename);
            
           $filePath = Storage::url($filePath);

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
                $interpretacion =$this->identificar($responseData22);
                $userId =  auth()->user()->id;

                $medicouser = $medico->user;

               $diagnosticonew = Diagnostico::create([
             
                'resultado_ia' =>  $interpretacion,
                'resultado'=> 'en espera',
                'estado'=> 'revision',
                'confidence'=> '80%',
                'data'=> $jsonencore ,
                'user_id_cliente' =>  $userId ,
                'user_id_medico'=> $medicouser->id,
                ]);

               $ecogrfianew =  Ecografia::create([
                    'path' => $filePath,
                    'id_diagnostico'=> $diagnosticonew->id,    
            ]);
             //  dd('Respuesta exitosa', $jsonencore);
                return view('servicioresultado', compact('dataApi','ecogrfianew','jsonencore','interpretacion'));
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
    

    public function identificar($responseData){

    $resultado = "Se ha detectado: ";
    if (isset($responseData['predictions'])) {

    foreach ($responseData['predictions'] as $prediction) {
        $class = strtoupper($prediction['class']); // Convertir la clase a mayúsculas

        switch ($class) {
            case 'HCC':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Detección de Carcinoma Hepatocelular (HCC) con una confianza de " . $formattedConfidence . "% ";
                break;
            case 'HV':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Detección de Vena Hepática (HV) con una confianza de " . $formattedConfidence . "% ";
                break;
            case 'IVC':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Detección de Vena Cava Inferior (IVC) con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'K':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= " morfología o características específicas con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'KC':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "características específicas del hígado o de las vías biliares una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'KM':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Detección de KM con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'LT':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Lóbulo Izquierdo del Hígado con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'SAG':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "cortes longitudinales una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'LVR':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Detección de Lesión de Vías Biliares (LVR) con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'PV':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "Vena Porta, con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'RT':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "parte derecha del hígado con una confianza de " .  $formattedConfidence . "% ";
                break;
            case 'TRANS':
                $confidence = $prediction['confidence'] * 100;
                $formattedConfidence = number_format($confidence, 2);
                $resultado .= "sección transversal con una confianza de " .  $formattedConfidence . "% ";
                break;
            default:
                $resultado .= "Detección de una clase no especificada con una confianza de " . $prediction['confidence']. " ";
                break;
        }
    }
}
    return $resultado;
}



}
