<!-- resources/views/diagnosticos/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="card shadow">
    <h1 class="text-center pt-2 mb-4" style="color: #4e73df; font-weight: bold;">Crear Nuevo Diagnóstico</h1>

        <div class="card-body">
            <form method="POST" action="{{ route('diagnosticos.api.enviar') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="ci" class="form-label"><strong>CI:</strong></label>
                    <input type="number" class="form-control" id="ci" name="ci" placeholder="Número de CI" required>
                    @error('ci')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="nombre" class="form-label"><strong>Nombre:</strong></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="imagen" class="form-label"><strong>Imagen:</strong></label>
                    <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" required>
                    @error('imagen')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg shadow" style="background-color: #1cc88a; border: none;">
                        <i class="fas fa-paper-plane"></i> Solicitar Diagnóstico API
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
