@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Éxito:</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Mostrar mensaje de error general -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Mostrar errores de validación específicos -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Errores:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <!-- Formulario para solicitar diagnóstico -->
    <div class="card shadow mb-4">

    <h1 class="text-center my-4">Crear Nuevo Diagnóstico</h1>

        <div class="card-body">
            <form method="POST" action="{{ route('diagnosticos.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Campo oculto para el user_id -->
                <input type="hidden" id="user_id" name="user_id">

                <div class="row mb-3">
                    <div class="col-md-6">
                         <input type="number" class="form-control" id="ci" name="ci" placeholder="Número de CI" required>
                    </div>
                    <div class="col-md-6">
                         <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                         <input type="text" class="form-control" id="a_paterno" name="a_paterno" placeholder="Apellido Paterno" required>
                    </div>
                    <div class="col-md-6">
                         <input type="text" class="form-control" id="a_materno" name="a_materno" placeholder="Apellido Materno" required>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control d-none" id="imagen" name="imagen">
                    <label for="imagen" class="btn btn-primary">Agregar imagen</label>
                </div>

                <!-- Contenedor para la vista previa de la imagen -->
                <div id="image-preview" class="d-flex justify-content-center mt-3">
                    <div id="image-list"></div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Crear Diagnóstico</button>
                    <a href="#" class="btn btn-secondary">Analizar Imagen IA</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Clientes -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Seleccionar Cliente</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Sexo</th>
                            <th>Estado</th>
                            <th>User ID</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->ci }}</td>
                            <td>{{ $row->nombre }}</td>
                            <td>{{ $row->a_paterno }}</td>
                            <td>{{ $row->a_materno }}</td>
                            <td>{{ $row->sexo }}</td>
                            <td>{{ $row->estado }}</td>
                            <td>{{ $row->user_id }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="selectClient({{ $row }})">Seleccionar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function selectClient(client) {
        document.getElementById('ci').value = client.ci;
        document.getElementById('nombre').value = client.nombre;
        document.getElementById('a_paterno').value = client.a_paterno;
        document.getElementById('a_materno').value = client.a_materno;
        document.getElementById('user_id').value = client.id;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('imagen').addEventListener('change', function(e) {
            document.getElementById('image-list').innerHTML = '';

            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Vista previa de la imagen';
                img.classList.add('img-thumbnail', 'mt-3');
                img.style.maxWidth = '150px';
                document.getElementById('image-list').appendChild(img);
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection
