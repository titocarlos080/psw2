@extends('layouts.index')

@section('title', 'IA Online')

@section('content')
    <!-- Page content-->
    <section class="mt-5" style="height: 100%">
        <div class="row">
            <!-- Left Column (Image Upload and Request Diagnosis) -->
            <div class="col-2" style="background-color:#f4f6f9;"> <!-- Lighter background for professionalism -->
                <div class="card h-100 shadow-sm p-1">
                    <div class="card-header bg-info text-white text-center">
                        <h5 class ="m-2">Subir Imagen</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('diagnosticos.api.enviar') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" class="form-control" id="imagen" name="imagen" style="display: none;">
                                <label for="imagen" class="btn btn-success w-100">Agregar Imagen</label>
                            </div>
                            <div class="mb-3">
                                <label for="medico" class="form-label">Médico:</label>
                                <select class="form-select" id="medico" name="medico">
                                    @foreach($medicos as $medico)
                                        <option value="{{ $medico->id }}">
                                            {{ $medico->nombre }} {{ $medico->a_paterno }} {{ $medico->a_materno }} - {{ $medico->especialidad }} - {{ $medico->telefono }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="card-header bg-info text-white text-center rounded">Solicitar Diagnóstico</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Middle Column (Image Preview or Results) -->
            <div class="col-6" style="background-color:#e9ecef;">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5>Resultado</h5>
                    </div>
                    <div class="card-body">
                        <div id="image-list" class="img-fluid" style="height: 80vh; overflow-y: auto;">
                            <!-- Image previews will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>

           <!-- Right Column (Instructions and Information) -->
            <div class="col-4" style="background-color: #f7fdf8; padding: 20px;">
                <div class="card h-100 shadow-lg border-light">
                    <div class="card-header bg-info text-white text-center">
                        <h5 class="mb-0">Instrucciones</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Obtenga un resultado rápido y eficaz con la ayuda de Inteligencia Artificial y de profesionales.</p>
                        <h5 class="mt-3 mb-3 text-primary">Instrucciones:</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Envíe la imagen de su ecografía.</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Se procesará la imagen mediante un mecanismo de reconocimiento de imagen por IA.</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Los resultados serán enviados a un profesional según su plan de suscripción.</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> La revisión por un profesional será pronta.</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Se le darán recomendaciones y un diagnóstico según el profesional designado.</li>
                        </ul>
                        <p class="text-center"><strong class="text-primary ">Gracias por usar el servicio.</strong></p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('imagen').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Image preview';
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                img.classList.add('rounded', 'shadow-sm');
                document.getElementById('image-list').appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
