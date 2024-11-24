@extends('layouts.index')



@section('content')
<h1 class="text-center" style="font-weight: bold;" class="mb-4">Recomendaciones del médico</h1>
<div class="container">
    <h1 class="text-center">Recomendaciones del médico</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre del Médico</th>
                    <th>Recomendación</th>
                    <th>Fecha y hora</th>
                    <th>Imágenes</th> <!-- Nuevo encabezado para las imágenes -->
                </tr>
            </thead>
            <tbody>
                @forelse ($recomendaciones as $recomendacion)
                <tr>
                    <td>{{ $recomendacion->nombre_medico }}</td>
                    <td>{{ $recomendacion->recomendacion }}</td>
                    <td>{{ $recomendacion->created_at }}</td>
                    <td>
                        <div class="d-flex flex-wrap">
                            @foreach ($recomendacion->diagnostico->ecografias as $imagen)
                                <img src="{{ asset($imagen->path) }}" alt="Ecografía" class="img-thumbnail m-2" style="max-width: 200px;">
                            @endforeach
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No hay recomendaciones registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
  <!-- Botón para imprimir -->
  <div class="text-center">
    <button id="btnImprimir" class="btn btn-primary" onclick="imprimirPagina()">Imprimir</button>
</div>


<!-- Script para imprimir y ocultar el botón -->
<script>
    function imprimirPagina() {
        // Ocultar el botón antes de imprimir
        var btnImprimir = document.getElementById('btnImprimir');
        btnImprimir.style.display = 'none';

        // Imprimir la página
        window.print();

        // Mostrar el botón nuevamente después de imprimir (opcional)
        btnImprimir.style.display = 'inline-block'; // o 'block' dependiendo de su diseño original
    }
</script>
@endsection
