@extends('layouts.index')

@section('content')
    <div class="min-vh-100 d-flex flex-column">
        <h1 class="text-center fw-bold mb-4">Mis Citas</h1>
        <div class="container flex-grow-1">

            <!-- Mensajes de éxito y error -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mostrar citas en formato de tarjetas -->
            @if ($citas->isEmpty())
                <div class="alert alert-info mt-4" role="alert">
                    No tienes citas reservadas.
                </div>
            @else
            <h1 class="text-center fw-bold mb-4">Mis Citas</h1>
                <div class="row">
                    @foreach ($citas as $cita)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"> FECHA: {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }} - HORA :  {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</h5>
                                    <p class="card-text"><strong>Detalles:</strong> {{ $cita->detalles }}</p>
                                    
                                    <p class="card-text">
                                        <strong>Estado:</strong>
                                        <span class="badge
                                            @if($cita->estado === 'pendiente') bg-warning
                                            @elseif($cita->estado === 'finalizado') bg-success
                                            @elseif($cita->estado === 'cancelado') bg-danger
                                            @elseif($cita->estado === 'modificado') bg-info
                                            @elseif($cita->estado === 'confirmado') bg-primary
                                            @endif
                                        ">
                                            {{ ucfirst($cita->estado) }}
                                        </span>
                                    </p>

                                    <p class="card-text"><strong>Médico:</strong> 
                                        {{ $cita->disponibilidad->user->medico->nombre ?? 'No asignado' }}
                                        {{ $cita->disponibilidad->user->medico->a_paterno ?? '' }}
                                        {{ $cita->disponibilidad->user->medico->a_materno ?? '' }}
                                    </p>

                                    @if($cita->estado !== 'finalizado')
                                    <!-- Botón para cancelar -->
                                    <form action="{{ route('citas.cancel', $cita->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás segura de que deseas cancelar esta cita?')">
                                            Cancelar
                                        </button>
                                    </form>
                                @else
                                    <!-- Mensaje cuando la cita está finalizada -->
                                    <span class="text-muted">No disponible</span>
                                @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $citas->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
@endsection
