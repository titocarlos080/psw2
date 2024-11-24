@extends('layouts.app')

@section('title', 'Lista de Disponibilidad')

@section('content')

<h1 class="text-3xl text-center font-bold">Disponibilidad Para Citas Medicas</h1>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
<div class="container-fluid mt-4">
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#crearDisponibilidadModal">
        Crear Disponibilidad
    </button>
</div>

<!-- Modal para crear disponibilidad -->
<div class="modal fade" id="crearDisponibilidadModal" tabindex="-1" aria-labelledby="crearDisponibilidadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearDisponibilidadModalLabel">Crear Disponibilidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('disponibilidades.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="horainicio">Hora Inicio</label>
                        <input type="time" class="form-control" name="horainicio" required>
                    </div>
                    <div class="form-group">
                        <label for="horafin">Hora Fin</label>
                        <input type="time" class="form-control" name="horafin" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="disponible">Disponible</option>
                            <option value="terminado">Terminado</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cupo">Cupo</label>
                        <input type="number" class="form-control" name="cupo" required>
                    </div>
                    <div class="form-group">
                        <label for="libre">Libre</label>
                        <input type="number" class="form-control" name="libre" required>
                    </div>
                    <div class="form-group">
                      <label for="buscarMedico">Buscar Médico</label>
                      <input type="text" class="form-control" id="buscarMedico" placeholder="Nombre o apellido del médico">
                      <select name="user_id_medico" class="form-control mt-2" id="user_id_medico" required>
                          @foreach($medicos as $medico)
                              <option value="{{ $medico->id }}">{{ $medico->nombre }} {{ $medico->a_paterno }}</option>
                          @endforeach
                      </select>
                  </div>
                  
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Disponibilidad -->
<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos de Disponibilidad</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Estado</th>
                            <th>Cupo</th>
                            <th>Libre</th>
                            <th>Médico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Estado</th>
                            <th>Cupo</th>
                            <th>Libre</th>
                            <th>Médico</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($disponibilidades as $disponibilidad)
                        <tr>
                            <td>{{ $disponibilidad->id }}</td>
                            <td>{{ $disponibilidad->fecha }}</td>
                            <td>{{ $disponibilidad->horainicio }}</td>
                            <td>{{ $disponibilidad->horafin }}</td>
                            <td>
                                <span class="
                                    px-2 py-1 rounded-full text-white 
                                    @if($disponibilidad->estado === 'disponible') bg-green-500
                                    @elseif($disponibilidad->estado === 'terminado') bg-gray-500
                                    @elseif($disponibilidad->estado === 'pendiente') bg-yellow-500
                                    @endif
                                ">
                                    {{ ucfirst($disponibilidad->estado) }}
                                </span>
                            </td>
                            <td>{{ $disponibilidad->cupo }}</td>
                            <td>{{ $disponibilidad->libre }}</td>
                            <td>{{ $disponibilidad->user->medico->nombre ?? 'No asignado' }}</td>
                            <td>
                                <a href="{{ route('disponibilidades.edit', $disponibilidad->id) }}" class="btn btn-success">Editar</a>
                                <form action="{{ route('disponibilidades.destroy', $disponibilidad->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                </form>
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
  document.addEventListener('DOMContentLoaded', function() {
      const buscarMedicoInput = document.getElementById('buscarMedico');
      const medicoSelect = document.getElementById('user_id_medico');
      const medicos = @json($medicos); // Carga los médicos en un array de JavaScript

      buscarMedicoInput.addEventListener('input', function() {
          const searchTerm = buscarMedicoInput.value.toLowerCase();
          medicoSelect.innerHTML = ''; // Limpia las opciones actuales

          // Filtra los médicos y muestra solo los que coincidan con el término de búsqueda
          medicos.forEach(medico => {
              const nombreCompleto = `${medico.nombre} ${medico.a_paterno}`.toLowerCase();
              if (nombreCompleto.includes(searchTerm)) {
                  const option = document.createElement('option');
                  option.value = medico.id;
                  option.textContent = nombreCompleto;
                  medicoSelect.appendChild(option);
              }
          });
      });
  });
</script>
@endsection
