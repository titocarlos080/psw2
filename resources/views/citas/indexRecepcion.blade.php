@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mis Citas</h6>
        </div>
        <div class="card-body">
            <!-- Mensajes de éxito y error -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Verificar si hay citas -->
            @if ($citas->isEmpty())
                <div class="alert alert-info mt-4" role="alert">
                    No tienes citas reservadas.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha</th>                                
                                <th>Hora</th>
                                <th>Detalles</th>
                                <th>Estado</th>
                                <th>Médico</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>nombre</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Detalles</th>
                                <th>Estado</th>
                                <th>Médico</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($citas as $cita)
                                <tr>
                                    <td class="py-3 px-7">{{ $cita->id }}</td>
                                    <td class="py-3 px-7">{{ $cita->cliente->cliente->nombre ?? ' ' }} {{ $cita->cliente->cliente->a_paterno ?? ' ' }}  </td>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                                    <td class="p-3">{{ $cita->detalles }}</td>
                                    <td class="p-3">
                                        <span class="badge 
                                            @if($cita->estado === 'pendiente') bg-warning
                                            @elseif($cita->estado === 'finalizado') bg-success
                                            @elseif($cita->estado === 'cancelado') bg-danger
                                            @elseif($cita->estado === 'modificado') bg-info
                                            @elseif($cita->estado === 'confirmado') bg-primary
                                            @endif">
                                            {{ ucfirst($cita->estado) }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        {{ $cita->disponibilidad->user->medico->nombre ?? 'No asignado' }}
                                        {{ $cita->disponibilidad->user->medico->a_paterno ?? '' }}
                                        {{ $cita->disponibilidad->user->medico->a_materno ?? '' }}
                                    </td>
                                    <td class="p-3">
                                        <!-- Botón para cancelar la cita -->
                                        <form action="{{ route('citas.cancelrecepcion', $cita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás segura de que deseas cancelar esta cita?')">
                                                Cancelar
                                            </button>
                                        </form>
                                    
                                      
                                        <!-- Botón para finalizar la cita -->
                                        <form action="{{ route('citas.finalize', $cita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('¿Estás segura de que deseas marcar esta cita como finalizada?')">
                                                Finalizar
                                            </button>
                                        </form>
                                         <!-- Botón para notificar -->
                                         <form action="{{ route('citas.notificar', $cita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('¿Deseas enviar una notificación para esta cita?')">
                                                Notificar
                                            </button>
                                        </form>
                                    </td>
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
