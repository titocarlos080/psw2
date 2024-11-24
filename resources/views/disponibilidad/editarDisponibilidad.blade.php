@extends('layouts.app')

@section('title', 'Editar Disponibilidad')

@section('content')
<div class="container mt-5">
    <h1 class="text-3xl text-center font-bold mb-4">Editar Disponibilidad</h1>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mensajes de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('disponibilidades.update', $disponibilidad->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="fecha" class="font-weight-bold">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $disponibilidad->fecha) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="horainicio" class="font-weight-bold">Hora Inicio</label>
            <input type="time" name="horainicio" class="form-control" 
                   value="{{ old('horainicio', \Carbon\Carbon::parse($disponibilidad->horainicio)->format('H:i')) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="horafin" class="font-weight-bold">Hora Fin</label>
            <input type="time" name="horafin" class="form-control" 
                   value="{{ old('horafin', \Carbon\Carbon::parse($disponibilidad->horafin)->format('H:i')) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="estado" class="font-weight-bold">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible" {{ old('estado', $disponibilidad->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="terminado" {{ old('estado', $disponibilidad->estado) == 'terminado' ? 'selected' : '' }}>Terminado</option>
                <option value="pendiente" {{ old('estado', $disponibilidad->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="cupo" class="font-weight-bold">Cupo</label>
            <input type="number" name="cupo" class="form-control" value="{{ old('cupo', $disponibilidad->cupo) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="libre" class="font-weight-bold">Libre</label>
            <input type="number" name="libre" class="form-control" value="{{ old('libre', $disponibilidad->libre) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="user_id_medico" class="font-weight-bold">Médico</label>
            <h2 class="form-control-static">
                {{ $disponibilidad->user->medico->nombre ?? 'No asignado' }} 
                {{ $disponibilidad->user->medico->a_paterno ?? '' }} 
                {{ $disponibilidad->user->medico->a_materno ?? '' }} 
                - CI: {{ $disponibilidad->user->medico->ci ?? 'N/A' }}
            </h2>
        </div>
        
        

        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
    </form>
</div>
@endsection
