@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')

<h1 class="text-3xl text-center font-bold">Lista de Clientes</h1>

<div class="container-fluid mt-4">
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#crearClienteModal">
        Crear
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="crearClienteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearClienteModalLabel">Crear Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va tu formulario de creación de cliente -->
        <form method="POST" action="{{ route('admin.storedClientes') }}">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" placeholder="CI" name="ci" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Apellido Paterno" name="a_paterno" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Apellido Materno" name="a_materno" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Teléfono" name="telefono" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Dirección" name="direccion" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Tabla de Clientes -->
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
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>F_Registro</th>
                            <th>User_Id</th>
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
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>F_Registro</th>
                            <th>User_Id</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($user as $row)
                        <tr>
                            <td class="py-3 px-7">{{$row->id}}</td>
                            <td class="p-3">{{$row->ci}}</td>
                            <td class="p-3 text-center">{{$row->nombre}}</td>
                            <td class="p-3 text-center">{{$row->a_paterno}}</td>
                            <td class="p-3 text-center">{{$row->a_materno}}</td>
                            <td class="p-3 text-center">{{$row->sexo}}</td>
                            <td class="p-3 text-center">{{$row->telefono}}</td>
                            <td class="p-3 text-center">{{$row->direccion}}</td>
                            <td class="p-3 text-center">{{$row->estado}}</td>
                            <td class="p-3 text-center">{{$row->created_at}}</td>
                            <td class="p-3 text-center">{{$row->user_id}}</td>
                            <td class="p-3">
                                <a href="{{ route('admin.destroyclientes', $row->id) }}" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Borrar</span>
                                </a>
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
