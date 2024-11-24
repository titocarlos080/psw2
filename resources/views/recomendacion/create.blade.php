@extends('layouts.app')

@section('title', 'Crear Recomendación')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg p-4">
        <h1 class="text-center mb-5" style="font-weight: bold; color: #4e73df;">Crear Recomendación</h1>

        <form action="{{ route('recomendacion.store') }}" method="POST">
            @csrf

            <!-- Campo oculto para diagnostico_id -->
            <input type="hidden" id="diagnostico_id" name="diagnostico_id">

            <div class="form-group mb-4">
                <label for="diagnostico_id" class="form-label text-primary">
                    <strong>Seleccionar Diagnóstico:</strong>
                </label>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="diagnosticosTable">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre Cliente</th>
                                <th>Resultado IA</th>
                                <th>Resultado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosticos as $diagnostico)
                            <tr>
                                <td>{{ $diagnostico->id }}</td>
                                <td>{{ $diagnostico->cliente->name }}</td>
                                <td>{{ Str::limit($diagnostico->resultado_ia, 50) }}</td>
                                <td>{{ Str::limit($diagnostico->resultado, 50) }}</td>
                                <td>{{ $diagnostico->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <button type="button" 
                                            class="btn btn-primary btn-sm select-diagnostico" 
                                            data-id="{{ $diagnostico->id }}"
                                            data-nombre-cliente="{{ $diagnostico->cliente->name }}"
                                            data-resultado-ia="{{ $diagnostico->resultado_ia }}"
                                            data-resultado="{{ $diagnostico->resultado }}"
                                            data-imagenes="{{ $diagnostico->ecografias->pluck('path')->implode(',') }}">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="nombre" class="form-label">
                    <strong>Nombre Cliente:</strong>
                </label>
                <input type="text" class="form-control" id="nombre" name="nombre" readonly>
            </div>

            <div class="form-group mb-4">
                <label for="recomenda" class="form-label">
                    <strong>Resultado de la IA:</strong>
                </label>
                <textarea class="form-control" id="recomenda" name="recomenda" rows="3" readonly></textarea>
            </div>

            <div class="form-group mb-4">
                <label for="resultado" class="form-label">
                    <strong>Resultado:</strong>
                </label>
                <textarea class="form-control" id="resultado" name="resultado" rows="3" readonly></textarea>
            </div>

            <div class="form-group mb-4">
                <label for="imagenes" class="form-label">
                    <strong>Imágenes:</strong>
                </label>
                <div id="imagenes" class="d-flex flex-wrap border rounded p-3 shadow-sm bg-light"></div>
            </div>

            <div class="form-group mb-4">
                <label for="recomendacion" class="form-label text-primary">
                    <strong>Recomendación:</strong>
                </label>
                <textarea class="form-control" id="recomendacion" name="recomendacion" rows="5" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success shadow-sm px-4 py-2">
                    Enviar Recomendación
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const diagnosticoIdInput = document.getElementById('diagnostico_id');
        const nombreClienteInput = document.getElementById('nombre');
        const resultadosInput = document.getElementById('recomenda');
        const resultadosDiagnosticoInput = document.getElementById('resultado');
        const imagenesContainer = document.getElementById('imagenes');

        document.querySelectorAll('.select-diagnostico').forEach(button => {
            button.addEventListener('click', function () {
                const diagnosticoId = this.getAttribute('data-id');
                const nombreCliente = this.getAttribute('data-nombre-cliente');
                const resultados = this.getAttribute('data-resultado-ia');
                const resultadoDiag = this.getAttribute('data-resultado');
                const imagenes = this.getAttribute('data-imagenes').split(',');

                // Rellenar campos
                diagnosticoIdInput.value = diagnosticoId;
                nombreClienteInput.value = nombreCliente;
                resultadosInput.value = resultados;
                resultadosDiagnosticoInput.value = resultadoDiag;

                // Limpiar y mostrar imágenes
                imagenesContainer.innerHTML = '';
                imagenes.forEach(function (url) {
                    if (url.trim() !== '') {
                        const img = document.createElement('img');
                        img.src = url.trim();
                        img.alt = 'Ecografía';
                        img.className = 'img-thumbnail m-2';
                        img.style.maxWidth = '200px';
                        img.style.height = 'auto';
                        imagenesContainer.appendChild(img);
                    }
                });
            });
        });
    });
</script>
@endsection
