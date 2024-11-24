<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Disponibilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
set_time_limit(120); 
class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtiene el usuario autenticado
        $cliente = Auth::user();
    
        // Recupera las citas relacionadas con el cliente autenticado y las ordena desde la más reciente
        $citas = Cita::where('user_id_cliente', $cliente->id)
                     ->orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
                     ->paginate(10); // Cambiado a paginate() para la paginación
    
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return view('citas.index', compact('citas'));
    }
    public function recepciones()
    {
       
        // Recupera las citas relacionadas con el cliente autenticado y las ordena desde la más reciente
        $citas = Cita::orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
        ->paginate(10);
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return view('citas.indexRecepcion', compact('citas'));
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
        $request->validate([
            'fecha' => 'required|date',
            'horadisponible' => 'required|date_format:H:i',
            'disponibilidad_id' => 'required',
        ]);
    
        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id();
                $dispid = $request->disponibilidad_id;
                $disponibilidad = Disponibilidad::where('id', $dispid)->firstOrFail();
    
                // Verificar disponibilidad de cupos
                if ($disponibilidad->libre <= 0) {
                    throw new \Exception('No hay cupos disponibles para esta cita.');
                }
    
                // Reducir el número de cupos libres
                $disponibilidad->libre -= 1;
                $disponibilidad->save();
    
                $medico = $disponibilidad->user->medico;
                $nombre = $medico->nombre . ' ' . $medico->a_paterno . ' ' . $medico->a_materno;
    
                // Crear la cita
                Cita::create([
                    'fecha' => $request->fecha,
                    'hora' => $request->horadisponible,
                    'detalles' => 'Especialista: ' . $nombre . ' Cita reservada en línea',
                    'estado' => 'confirmado',
                    'user_id_cliente' => $userId,
                    'disponibilidad_id' => $disponibilidad->id,
                ]);
            });
    
            return redirect()->back()->with('success', 'Cita reservada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo reservar la cita: ' . $e->getMessage());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
  
        $cita->destroy();
    
        return redirect()->route('citas.index')->with('error', 'No se pudo cancelar la cita.');
    }

    public function cancel($id)
{
    try {
      
        $cita = Cita::findOrFail($id);

      
        if ($cita->user_id_cliente == Auth::id() ) {
            // Cambia el estado de la cita a "cancelado"
            $cita->estado = 'cancelado';
            $cita->save();
            // Retorna con mensaje de éxito
            return redirect()->route('citas.index')->with('success', 'Cita cancelada con éxito.');
        }

        // Retorna con mensaje de error si la cita no puede ser cancelada
        return redirect()->route('citas.index')->with('error', 'No se pudo cancelar la cita.');
    } catch (\Exception $e) {
        // Manejo de errores inesperados
        return redirect()->route('citas.index')->with('error', 'Ocurrió un error al intentar cancelar la cita.');
    }
}
public function finalize($id)
{
    try {
      
        $cita = Cita::findOrFail($id);

      
        if ($cita) {
            // Cambia el estado de la cita a "cancelado"
            $cita->estado = 'finalizado';
            $cita->save();
            // Retorna con mensaje de éxito
            return redirect()->route('citas.recepciones')->with('success', 'Cita finalizada con éxito.');
        }

        // Retorna con mensaje de error si la cita no puede ser cancelada
        return redirect()->route('citas.recepciones')->with('error', 'No se pudo finalizar la cita.');
    } catch (\Exception $e) {
        // Manejo de errores inesperados
        return redirect()->route('citas.recepciones')->with('error', 'Ocurrió un error al intentar finalizar la cita.');
    }
}




function getAccessToken()
{
    // Obtener la ruta del archivo JSON de Firebase desde el archivo .env

    $jsonKeyFilePath = base_path(config('services.firebase.credentials_path'));
    //dd($jsonKeyFilePath);

    if (!file_exists($jsonKeyFilePath)) {
        throw new \Exception('El archivo de credenciales de Firebase no existe en la ruta: ' . $jsonKeyFilePath);
    }

    $tokenURL = 'https://oauth2.googleapis.com/token';

    // Cargar el archivo JSON de la cuenta de servicio
    $jwt = json_decode(file_get_contents($jsonKeyFilePath), true);

    // Configurar el JWT
    $clientEmail = $jwt['client_email'];
    $privateKey = $jwt['private_key'];
    $now = time();
    $expiration = $now + 3600; // El token es válido por 1 hora

    $claimSet = [
        'iss' => $clientEmail,
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud' => $tokenURL,
        'iat' => $now,
        'exp' => $expiration,
    ];

    // Codificar el JWT
    $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
    $payload = json_encode($claimSet);
    $jwtHeaderPayload = base64_encode($header) . '.' . base64_encode($payload);
    $signature = '';
    openssl_sign($jwtHeaderPayload, $signature, $privateKey, 'sha256');
    $jwtSigned = $jwtHeaderPayload . '.' . base64_encode($signature);

    // Solicitar el access token
    $client = new Client();
    $response = $client->post($tokenURL, [
        'form_params' => [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwtSigned,
        ],
    ]);

    $data = json_decode($response->getBody(), true);


    //dd($data);

    return $data['access_token'];
}

public function sendNotificationOautv1($deviceToken, $title, $body)
{
    $accessToken = $this->getAccessToken(); // Obtén el token de acceso usando la función anterior
    $projectId = 'parcialeventos-66383';
    $url = "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";

    // Imagen por defecto
    $defaultImageUrl = 'https://clinicadetextos.com/wp-content/uploads/2016/09/clinica-de-textos.jpg';

    // Sonido por defecto (para Android e iOS)
    $defaultSound = 'default';

    $client = new Client();
    $response = $client->post($url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'image' => $defaultImageUrl, // Añade la imagen por defecto
                ],
                'android' => [
                    'notification' => [
                        'sound' => $defaultSound,
                    ],
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'sound' => $defaultSound,
                        ],
                    ],
                ],
            ],
        ],
    ]);
    //dd($response);
    return $response->getBody()->getContents();
}



public function notificar($id)
{
    $cita = Cita::findOrFail($id);
 //   dd( $cita);
   $userclienttoken = $cita->cliente->tokenNotificacion;
  // Extrae los detalles de la cita
  $fecha = $cita->fecha;
  $hora = $cita->hora;
  $detalles = $cita->detalles;

  // Construye el mensaje de notificación usando los detalles de la cita
  $citaDetalles = "Fecha: $fecha, Hora: $hora, Detalles: $detalles";

  // Enviar la notificación al cliente con los detalles de la cita
  $this->sendNotificationOautv1($userclienttoken, 'Aviso de Cita Programada', "Se le Notifica que tiene una Cita pendiente: $citaDetalles");
    //dd( $userclienttoken);
  //  $this->sendNotification2($userclienttoken,'hola','hola');
 //  $userclienttoken = 'flmE5is-RjuyvAibKjBXNp:APA91bGr8Hy3u64XKlN1yT5M--dU92h_GtOM_xtQNG1DVhQ5nlhoMZQZScNV5jft4u2yn2hQVTt06zKYjvwe67i4mjRHEcIzsn8G1Vh3hd_6BI4BtB6Jt9Q';
  // $this->getAccessToken();
    return redirect()->back()->with('success', 'Notificación enviada correctamente.');
}


public function cancelrecepcion($id)
{
    try {
      
        $cita = Cita::findOrFail($id);

      
        if ($cita ) {
            // Cambia el estado de la cita a "cancelado"
            $cita->estado = 'cancelado';
            $cita->save();
            //   dd( $cita);
            $userclienttoken = $cita->cliente->tokenNotificacion;
             // Extrae los detalles de la cita
             $fecha = $cita->fecha;
             $hora = $cita->hora;
             $detalles = $cita->detalles;
           
             // Construye el mensaje de notificación usando los detalles de la cita
             $citaDetalles = "Fecha: $fecha, Hora: $hora, Detalles: $detalles";
           
             // Enviar la notificación al cliente con los detalles de la cita
             $this->sendNotificationOautv1($userclienttoken, 'Aviso de Cancelacion de Cita', "Se le Notifica que se cancelo la Cita : $citaDetalles");

            // Retorna con mensaje de éxito
            return redirect()->route('citas.recepciones')->with('success', 'Cita cancelada con éxito.');
        }

        // Retorna con mensaje de error si la cita no puede ser cancelada
        return redirect()->route('citas.recepciones')->with('error', 'No se pudo cancelar la cita.');
    } catch (\Exception $e) {
        // Manejo de errores inesperados
        return redirect()->route('citas.recepciones')->with('error', 'Ocurrió un error al intentar cancelar la cita.');
    }
}
}
