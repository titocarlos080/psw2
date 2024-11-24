<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;

class PlanesController extends Controller
{
    //
    public function index(){

        //$provider = PayPal::setProvider();
        //$provider->getAccessToken();
        //$plans = $provider->listProducts();

        return view('cliente.planes');
    }

    public function view($id){
        //$provider = PayPal::setProvider();
        //$provider->getAccessToken();
        //$plan = $provider->showProduct($id);

        return view('cliente.verPlan', ['id' => $id]);
    }



}
