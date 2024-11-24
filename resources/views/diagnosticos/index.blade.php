@extends('layouts.index')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5" style="font-weight: bold; color: #4e73df;">Historial Médico</h1>

    @if ($diagnosticos->isEmpty())
    <div class="alert alert-info text-center" role="alert">
        <strong>No se encontraron diagnósticos en el historial.</strong>
    </div>
    @else
    <div class="list-group">
        @foreach ($diagnosticos as $diagnostico)
        <div class="list-group-item mb-4 p-4 rounded shadow-sm border-0" style="background-color: #f8f9fc;">
            <!-- Sección de Ecografías -->
            <div class="mb-4">
                <h5 class="text-primary"><strong>Ecografías:</strong></h5>
                <div class="d-flex flex-wrap">
                    @foreach ($diagnostico->ecografias as $ecografia)
                    <div class="p-2">
                        <img src="{{ asset($ecografia->path) }}" alt="Ecografía" class="img-thumbnail" style="max-width: 250px; height: auto;">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Resultados -->
            <div class="mb-3">
                <h5 class="text-primary"><strong>Resultado de la IA:</strong></h5>
                <textarea class="form-control mb-3" rows="3" readonly>{{ $diagnostico->resultado_ia }}</textarea>

                <h5 class="text-primary"><strong>Resultado por el Especialista:</strong></h5>
                <textarea class="form-control" rows="3" readonly>{{ $diagnostico->resultado }}</textarea>
            </div>

            <!-- Información adicional -->
            <div class="mb-2">
                <strong>Fecha y Hora:</strong> 
                <span class="text-muted">{{ $diagnostico->created_at->format('d/m/Y H:i:s') }}</span>
            </div>

            <div>
                <strong>Nombre del Médico:</strong> 
                <span class="text-muted">{{ $diagnostico->medico->name }}</span>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
