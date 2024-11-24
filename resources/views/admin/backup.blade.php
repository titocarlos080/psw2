@extends('layouts.app')

@section('title', 'BackUp')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4" style="font-weight: bold; color: #4e73df;">Gestión de BackUps</h1>
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-primary">Crear un BackUp</h4>
            <p class="card-text">Presiona el botón para generar un respaldo completo de la base de datos.</p>
            <form action="{{ route('backup.create') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Generar BackUp</button>
            </form>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title text-primary">Descargar BackUp</h4>
            <p class="card-text">Selecciona un respaldo para descargarlo.</p>
            
        </div>
    </div>
</div>
@endsection
