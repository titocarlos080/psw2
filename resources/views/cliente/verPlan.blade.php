@extends('layouts.index')

@section('title', 'Hepatoscan IA | Planes')

@section('content')
    <section class="bg-light py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Suscribite a nuestro Plan</h1>
                <p class="lead fw-normal text-muted mb-0">Nuestro plan Starter incluye 7 días de prueba</p>
            </div>
            <div class="row gx-5 justify-content-center">
                @switch($id)
                    @case('P-9T68897196701321TMZ3TN5Y')
                        <!-- Pricing card free-->
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-5 mb-xl-0">
                                <div class="card-body p-5">
                                    <div class="small text-uppercase fw-bold text-muted">Start</div>
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold">$3.99</span>
                                        <span class="text-muted">/ mo.</span>
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            <strong>7 días de prueba</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Consultas con nuestra IA
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Reporte de salud
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Acceso a tutoriales
                                        </li>
                                        <li class="mb-2 text-muted">
                                            <i class="bi bi-x"></i>
                                            Consulta con Médicos
                                        </li>
                                        <li class="mb-2 text-muted">
                                            <i class="bi bi-x"></i>
                                            Acceso a nuesta API
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Paid -->
                        <div class="col-lg-6 col-xl-4">
                            <div id="paypal-button-container-P-9T68897196701321TMZ3TN5Y"></div>
                            <script
                                src="https://www.paypal.com/sdk/js?client-id=AZnEXXhJ4oxb2j2-f277WXUhDKAr9PSwuJ_Uv48Al4q-UV_VIs154pOZ-96LhFfF1cuD5w6WJo0z4ede&vault=true&intent=subscription"
                                data-sdk-integration-source="button-factory"></script>
                            <script>
                                paypal.Buttons({
                                    style: {
                                        shape: 'rect',
                                        color: 'silver',
                                        layout: 'vertical',
                                        label: 'subscribe'
                                    },
                                    createSubscription: function(data, actions) {
                                        return actions.subscription.create({
                                            /* Creates the subscription */
                                            plan_id: 'P-9T68897196701321TMZ3TN5Y'
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        alert(data.subscriptionID); // You can add optional success message for the subscriber here
                                    }
                                }).render('#paypal-button-container-P-9T68897196701321TMZ3TN5Y'); // Renders the PayPal button
                            </script>
                        </div>
                    @break

                    @case('P-13508707YV9657634MZ3TPZY')
                        <!-- Pricing card free-->
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-5 mb-xl-0">
                                <div class="card-body p-5">
                                    <div class="small text-uppercase fw-bold">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        Pro
                                    </div>
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold">$9.99</span>
                                        <span class="text-muted">/ mo.</span>
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            <strong>30 días de Suscripción</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Consultas con nuestra IA
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Reporte de salud
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Acceso a tutoriales
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Consulta con Médicos
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Acceso a nuesta API
                                        </li>
                                    </ul>
                                    <div class="d-grid"><a class="btn btn-primary" href="#!">Choose plan</a></div>
                                </div>
                            </div>
                        </div>
                        <!-- Paid -->
                        <div class="col-lg-6 col-xl-4">
                            <div id="paypal-button-container-P-13508707YV9657634MZ3TPZY"></div>
                            <script
                                src="https://www.paypal.com/sdk/js?client-id=AZnEXXhJ4oxb2j2-f277WXUhDKAr9PSwuJ_Uv48Al4q-UV_VIs154pOZ-96LhFfF1cuD5w6WJo0z4ede&vault=true&intent=subscription"
                                data-sdk-integration-source="button-factory"></script>
                            <script>
                                paypal.Buttons({
                                    style: {
                                        shape: 'rect',
                                        color: 'silver',
                                        layout: 'vertical',
                                        label: 'subscribe'
                                    },
                                    createSubscription: function(data, actions) {
                                        return actions.subscription.create({
                                            /* Creates the subscription */
                                            plan_id: 'P-13508707YV9657634MZ3TPZY'
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        alert(data.subscriptionID); // You can add optional success message for the subscriber here
                                    }
                                }).render('#paypal-button-container-P-13508707YV9657634MZ3TPZY'); // Renders the PayPal button
                            </script>
                        </div>
                    @break

                    @case('P-896239544C661054WMZ3TQQY')
                        <!-- Pricing card free-->
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-5 mb-xl-0">
                                <div class="card-body p-5">
                                    <div class="small text-uppercase fw-bold">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        Confort
                                    </div>
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold">$25.99</span>
                                        <span class="text-muted">/ 3 mo.</span>
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            <strong>30 días de Suscripción</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Consultas con nuestra IA
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Reporte de salud
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Acceso a tutoriales
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Consulta con Médicos
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Acceso a nuesta API
                                        </li>
                                    </ul>
                                    <div class="d-grid"><a class="btn btn-primary" href="#!">Choose plan</a></div>
                                </div>
                            </div>
                        </div>
                        <!-- Paid -->
                        <div class="col-lg-6 col-xl-4">
                            <div id="paypal-button-container-P-896239544C661054WMZ3TQQY"></div>
                            <script
                                src="https://www.paypal.com/sdk/js?client-id=AZnEXXhJ4oxb2j2-f277WXUhDKAr9PSwuJ_Uv48Al4q-UV_VIs154pOZ-96LhFfF1cuD5w6WJo0z4ede&vault=true&intent=subscription"
                                data-sdk-integration-source="button-factory"></script>
                            <script>
                                paypal.Buttons({
                                    style: {
                                        shape: 'rect',
                                        color: 'silver',
                                        layout: 'vertical',
                                        label: 'subscribe'
                                    },
                                    createSubscription: function(data, actions) {
                                        return actions.subscription.create({
                                            /* Creates the subscription */
                                            plan_id: 'P-896239544C661054WMZ3TQQY'
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        alert(data.subscriptionID); // You can add optional success message for the subscriber here
                                    }
                                }).render('#paypal-button-container-P-896239544C661054WMZ3TQQY'); // Renders the PayPal button
                            </script>
                        </div>
                    @break

                    @default
                        <div class="small text-uppercase fw-bold text-muted">Plan por defecto</div>
                        <!-- Más contenido para el plan por defecto -->
                @endswitch
            </div>
        </div>
    </section>
@endsection
