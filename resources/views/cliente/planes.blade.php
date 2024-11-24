@extends('layouts.index')

@section('title', 'Suscribe')

@section('content')
    <section class="bg-light py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Suscribite a nuestro servicio</h1>
                <p class="lead fw-normal text-muted mb-0">Nuestro plan Starter incluye 7 días de prueba</p>
            </div>
            <div class="row gx-5 justify-content-center">
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
                            <div class="d-grid">
                                <a class="btn btn-outline-primary" href="{{ route('planes.view', ['id' => 'P-9T68897196701321TMZ3TN5Y']) }}">Choose plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pricing card pro-->
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
                            <div class="d-grid">
                                <a class="btn btn-outline-primary" href="{{ route('planes.view', ['id' => 'P-13508707YV9657634MZ3TPZY']) }}">Choose plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Confort card pro-->
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
                            <div class="d-grid">
                                <a class="btn btn-outline-primary" href="{{ route('planes.view', ['id' => 'P-896239544C661054WMZ3TQQY']) }}">Choose plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
