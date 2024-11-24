<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class PaypalController extends Controller
{
    //

    public function webhook(Request $request){

    }

    public function createAgreement(Request $request)
    {
        // Inicializa el proveedor de PayPal
        $provider = PayPal::setProvider();

        // Obtiene el ID del plan desde la solicitud
        $planId = $request->input('plan_id');

        // Define el acuerdo de suscripción
        $agreement = $provider->createAgreement([
            'name' => 'Monthly Subscription Agreement',
            'description' => 'Agreement for Monthly Subscription',
            'start_date' => now()->addMinutes(5)->toIso8601String(),
            'plan' => [
                'id' => $planId,
            ],
            'payer' => [
                'payment_method' => 'paypal',
            ],
            'shipping_address' => [
            'line1' => 'Av La Guardia',
            'city' => 'Andres Ibañez',
            'state' => 'Santa Cruz de la Sierra',
            'postal_code' => '0000',
            'country_code' => 'US'
        ]
        ]);

        // Obtiene el enlace de aprobación del acuerdo
        //$approvalUrl = $agreement['links'][0]['href'];

        // Devuelve el enlace de aprobación
        //return response()->json(['approval_url' => $approvalUrl]);

        // Redirige al usuario a PayPal para aprobar la suscripción
        return redirect($agreement['links'][1]['href']);
    }

    public function executeAgreement(Request $request)
    {
        // Inicializa el proveedor de PayPal
        $provider = PayPal::setProvider();

        // Obtiene el token desde la solicitud
        $token = $request->input('token');

        // Ejecuta el acuerdo de suscripción
        $agreement = $provider->executeAgreement($token);

        // Guardar la suscripción en la base de datos
        Subscription::create([
            'user_id' => Auth::id(),
            'paypal_plan_id' => $agreement['plan']['id'],
            'paypal_agreement_id' => $agreement['id'],
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);

        return response()->json(['message' => 'Subscription activated successfully']);
    }
}
