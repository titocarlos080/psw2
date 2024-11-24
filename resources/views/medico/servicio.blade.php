@extends('layouts.app')

@section('title', 'IA Online')

@section('content')
    <!-- Contenido de la página -->
    <section class="mt-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna izquierda (Subir imagen) -->
                <div class="col-lg-2 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-header text-center bg-primary text-white">
                            Subir Imagen
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('diagnosticos.api.enviar.medico') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="file" class="form-control" id="imagen" name="imagen" style="display: none;">
                                    <label for="imagen" class="btn btn-outline-primary w-100">Imagen</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Solicitar Reconocimiento</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Columna central (Resultado) -->
                <div class="col-lg-10">
                    <div class="card shadow h-100">
                        <div class="card-header bg-primary text-center text-white">
                            Resultado
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div id="image-list" class="text-center" style="max-height: 90vh; overflow-y: auto;">
                                <!-- Las imágenes se mostrarán aquí -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('imagen').addEventListener('change', (e) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Vista previa de imagen';
                    img.classList.add('img-fluid', 'rounded', 'mt-2');
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '100%';
                    document.getElementById('image-list').innerHTML = '';
                    document.getElementById('image-list').appendChild(img);
                };
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
