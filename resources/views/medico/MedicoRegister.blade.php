@extends('layouts.app')

@section('title', 'Lista de Médicos')

@section('content')

<h1 class="text-3xl text-center font-bold">Lista Médicos</h1>


<div class="container-fluid mt-4">
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
<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#crearMedicoModal">
    Crear
</button>

</div>

<!-- Modal -->
<div class="modal fade" id="crearMedicoModal" tabindex="-1" aria-labelledby="crearMedicoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearMedicoModalLabel">Crear Médico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va tu formulario de creación de médico -->
        <form method="POST" action="{{ route('admin.storedMedico') }}">
          @csrf
          <div class="form-group">
              <label for="ci">CI</label>
              <input type="text" class="form-control" id="ci" placeholder="CI" name="ci" required>
          </div>
          <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
          </div>
          <div class="form-group">
              <label for="a_paterno">Apellido Paterno</label>
              <input type="text" class="form-control" id="a_paterno" placeholder="Apellido Paterno" name="a_paterno" required>
          </div>
          <div class="form-group">
              <label for="a_materno">Apellido Materno</label>
              <input type="text" class="form-control" id="a_materno" placeholder="Apellido Materno" name="a_materno" required>
          </div>
          <div class="form-group">
              <label for="especialidad">Especialidad</label>
              <input type="text" class="form-control" id="especialidad" placeholder="Especialidad" name="especialidad" required>
          </div>
          <div class="form-group">
              <label for="sexo">Sexo</label>
              <input type="text" class="form-control" id="sexo" placeholder="Sexo" name="sexo" required>
          </div>
          <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono" required>
          </div>
          <div class="form-group">
              <label for="direccion">Dirección</label>
              <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion" required>
          </div>
          <div class="form-group">
              <label for="name">User Name</label>
              <input type="text" class="form-control" id="name" placeholder="User Name" name="name" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
          </div>
          <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" required>
          </div>
          <div class="form-group">
              <label for="password_confirmation">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="password_confirmation" placeholder="Confirmar Contraseña" name="password_confirmation" required>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
      </form>
      
      </div>
    </div>
  </div>
</div>

<!-- Tabla de Médicos -->
<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>A_paterno</th>
                            <th>A_materno</th>
                            <th>Especialidad</th>
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>User_Id</th>
                            <th>F_Registro</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>A_paterno</th>
                            <th>A_materno</th>
                            <th>Especialidad</th>
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>User_Id</th>
                            <th>F_Registro</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($user as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->ci }}</td>
                            <td>{{ $row->nombre }}</td>
                            <td>{{ $row->a_paterno }}</td>
                            <td>{{ $row->a_materno }}</td>
                            <td>{{ $row->especialidad }}</td>
                            <td>{{ $row->sexo }}</td>
                            <td>{{ $row->telefono }}</td>
                            <td>{{ $row->direccion }}</td>
                            <td>{{ $row->estado }}</td>
                            <td>{{ $row->user_id }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.editMedico', $row->id) }}" class="btn btn-success">Editar</a>
                                <a href="{{ route('admin.destroyMedico', $row->id) }}" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
