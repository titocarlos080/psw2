@extends('layouts.app')

@section('title', 'IA Online')

@section('content')
    <!-- Contenido de la página -->
    <section class="mt-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna izquierda (Subir imágenes) -->
                <div class="col-lg-2 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-header text-center bg-primary text-white">
                            Subir Imágenes
                        </div>
                        <div class="card-body">
                            <form id="imageForm" enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <input type="file" class="form-control" id="imagen" name="imagen[]" accept="image/*" multiple required>
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
                        <div class="card-body">
                            <div id="result-container">
                                <div id="image-list" class="text-center" style="max-height: 90vh; overflow-y: auto;">
                                    <!-- Las imágenes se mostrarán aquí -->
                                </div>
                                <div id="detections" class="mt-3">
                                    <!-- Las detecciones se mostrarán aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('imageForm').addEventListener('submit', async function (e) {
            e.preventDefault(); // Evitar envío tradicional del formulario

            const formData = new FormData();
            const fileInput = document.getElementById('imagen');
            const files = fileInput.files; // Obtiene todas las imágenes seleccionadas

            if (files.length === 0) {
                alert('Por favor selecciona al menos una imagen.');
                return;
            }

            // Agregar todas las imágenes al FormData
            for (let i = 0; i < files.length; i++) {
                formData.append('imagen', files[i]); // Clave 'imagen' debe coincidir con lo que espera el servidor
            }

            try {
                // Hacer solicitud POST hacia la API
                const response = await fetch('https://b820-54-234-47-232.ngrok-free.app/analizar-imagen/', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.statusText);
                }

                const data = await response.json();

                // Mostrar resultados de todas las imágenes
                mostrarResultados(data.images);
            } catch (error) {
                alert('Hubo un error al procesar las imágenes: ' + error.message);
                console.error(error);
            }
        });

        // Función para mostrar resultados de todas las imágenes
        function mostrarResultados(images) {
            const resultContainer = document.getElementById('result-container');
            resultContainer.innerHTML = ''; // Limpiar resultados previos

            images.forEach((imageResult, index) => {
                const originalImage = `data:image/jpeg;base64,${imageResult.original_image}`;
                const processedImage = `data:image/jpeg;base64,${imageResult.processed_image}`;

                // Crear contenedor para cada resultado
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('mb-4');

                imageContainer.innerHTML = `
                    <h5>Imagen ${index + 1}</h5>
                    <div class="mb-3">
                        <h6>Original</h6>
                        <img src="${originalImage}" alt="Imagen Original" class="img-fluid rounded">
                    </div>
                    <div class="mb-3">
                        <h6>Procesada</h6>
                        <img src="${processedImage}" alt="Imagen Procesada" class="img-fluid rounded">
                    </div>
                    <div>
                        <h6>Detecciones</h6>
                        ${imageResult.detections.map(detection => `
                            <div class="mb-2">
                                <p>X Mínimo: ${detection.x_min.toFixed(2)}</p>
                                <p>Y Mínimo: ${detection.y_min.toFixed(2)}</p>
                                <p>X Máximo: ${detection.x_max.toFixed(2)}</p>
                                <p>Y Máximo: ${detection.y_max.toFixed(2)}</p>
                                <p>Confianza: ${(detection.confidence * 100).toFixed(2)}%</p>
                                <p>Clase: ${detection.class}</p>
                            </div>
                        `).join('')}
                    </div>
                `;

                resultContainer.appendChild(imageContainer);
            });
        }
    </script>
@endsection
