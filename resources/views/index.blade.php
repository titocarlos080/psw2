@extends('layouts.index')

@section('title', 'Clinica del Higado')

@section('content')

@php
    $disponibilidades = App\Models\Disponibilidad::where('estado', 'disponible')->get();
@endphp


<header class="bg-dark py-5">
    <div class="container px-4">
        <div class="row gx-4 align-items-center justify-content-center">
            <!-- Texto y descripción a la izquierda -->
            <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                <h1 class="h3 fw-bolder text-white mb-2">Servicio Médico a su Alcance</h1>
                <p class="lead fw-normal text-white-50 mb-3">Obtenga un resultado rápido y eficaz con la ayuda de profesionales</p>

                <!-- Botón de acción -->
                <sreong class="btn text-white" style="background: #00ff8f;">Reserve su cita <span style="color:green;">&#x25BC;</span></strong>
            </div>

            <!-- Imágenes a la derecha -->
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center">
                    <!-- Imagen principal del doctor -->
                    <img class="img-fluid rounded-3 mb-3" src="https://pngfreepic.com/wp-content/uploads/2021/05/doctor-png-142.png" alt="Doctor" />

                   
                </div>
            </div>
        </div>
    </div>
</header>


 


<!-- Mostrar mensaje de éxito -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Mostrar mensaje de error -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Mostrar errores de validación (campos específicos) -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Cuadro con enlace de descarga -->
<section class="bg-light py-4">
    <div class="container text-center">
        <h2 class="mb-3">Descarga nuestra App</h2>
        <p class="mb-4">Accede a todos nuestros servicios desde la comodidad de tu dispositivo móvil.</p>
        <a href="https://drive.google.com/drive/folders/13JCj-3refuN8LmZHRVecnOuGyB8Xf8-g?usp=sharing" class="btn btn-primary btn-lg" target="_blank">
            Descargar desde Google Drive
        </a>
    </div>
</section>

<!-- Calendar Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder">Calendario</h1>
            <p class="lead fw-normal">Seleccione el horario disponible y reserve su cita</p>

        </div>
        <div class="container px-5">
            <div id="calendar" class="p-3 bg-light rounded border"></div>
        </div>
    </div>
</section>



<!-- Modal para reservar cita -->
<!-- Modal para reservar cita -->
<div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if(Auth::check())
                <!-- Formulario de reserva si el usuario está autenticado -->
                <form method="POST" action="{{ route('citas.store') }}">
                    @csrf
                    <input type="hidden" id="disponibilidad_id" name="disponibilidad_id"> <!-- ID de la disponibilidad -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservaModalLabel">Reservar Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <h6>Disponibilidad Seleccionada</h6>
                            <p id="detallesDisponibilidad" class="fw-bold"></p> <!-- Detalles de disponibilidad -->
                        </div>
                        <div class="mb-3">
                            <label for="ci" class="form-label">Carnet de Identidad</label>
                            <input type="text" class="form-control" id="ci" name="ci" value="{{ Auth::user()->cliente->ci ?? '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ Auth::user()->cliente->nombre ?? '' }} {{ Auth::user()->cliente->a_paterno ?? '' }} {{ Auth::user()->cliente->a_materno ?? '' }} " readonly>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ Auth::user()->cliente->telefono ?? '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de la Cita</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="horario" class="form-label">Horario</label>
                            <input type="text" class="form-control" id="horario" name="horario" readonly>
                        </div>
                          <div class="mb-3">
                            <label for="horadisponible" class="form-label">Hora Disponible</label>
                            <input type="text" class="form-control" id="horadisponible" name="horadisponible" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                    </div>
                </form>
            @else
                <!-- Mensaje de autenticación si el usuario no está autenticado -->
                <input type="hidden" id="disponibilidad_id" name="disponibilidad_id"> <!-- ID de la disponibilidad -->
                <div class="modal-header">
                    <h5 class="modal-title" id="reservaModalLabel">Inicie Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h3 class="font-semibold uppercase">Debe iniciar sesión para poder reservar una cita</h3>
                    <br>
                      <div class="mb-3">
                        <h6>Disponibilidad Seleccionada</h6>
                        <p id="detallesDisponibilidad" class="fw-bold"></p> <!-- Detalles de disponibilidad -->
                    </div>
                    <a href="{{ route('login.index') }}" class="btn btn-primary">
                        Iniciar Sesión
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>


<!-- Include FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            aspectRatio: 1.2,
            events: [
                @foreach($disponibilidades as $disponibilidad)
                {
                    title: 'Disponible: {{ $disponibilidad->user->medico->nombre ?? 'No asignado' }} {{ $disponibilidad->user->medico->a_paterno ?? 'No asignado' }}',
                    start: '{{ $disponibilidad->fecha }}T{{ $disponibilidad->horainicio }}',
                    end: '{{ $disponibilidad->fecha }}T{{ $disponibilidad->horafin }}',
                    extendedProps: {
                        description: 'Cupos: {{ $disponibilidad->cupo }}   Cupos libres  : {{ $disponibilidad->libre }} ',
                        disponibilidadId: {{ $disponibilidad->id }},
                        fecha: '{{ $disponibilidad->fecha }}',
                        horainicio: '{{ $disponibilidad->horainicio }}',
                        horafin: '{{ $disponibilidad->horafin }}',
                        cuposlibres  : '{{ $disponibilidad->libre }}',
                        cupos  : '{{ $disponibilidad->cupo }}'
                    }
                },
                @endforeach
            ],
            eventClick: function(info) {
                var evento = info.event.extendedProps;
                document.getElementById('disponibilidad_id').value = evento.disponibilidadId;
                    // Usar try-catch para evitar errores si algún elemento no está presente
                    document.getElementById('detallesDisponibilidad').innerHTML = 
                 info.event.title + ' - ' + evento.description + '<br>Fecha: ' + evento.fecha + '<br>Horario: ' + evento.horainicio + ' a ' + evento.horafin +'<br>Cupos: ' + evento.cupos + '<br>Cupos libres: ' + evento.cuposlibres ;
              
                                    var evento = info.event.extendedProps;
                        var horainicio = evento.horainicio.slice(0, 5); // Solo tomar HH:mm
                        var horafin = evento.horafin.slice(0, 5); // Solo tomar HH:mm
                        
                     //   console.log("Hora inicio:", horainicio);
                       // console.log("Hora fin:", horafin);

                        // Convertir las horas a objetos Date usando solo HH:mm
                        var horaInicio = new Date("1970-01-01T" + horainicio + ":00");
                        var horaFin = new Date("1970-01-01T" + horafin + ":00");

                        if (isNaN(horaInicio.getTime()) || isNaN(horaFin.getTime())) {
                            console.error("No se pudo convertir a formato de fecha y hora.");
                            return;
                        }

                        // Calcular la duración en minutos y determinar la hora disponible
                        var duracionTotal = (horaFin - horaInicio) / 60000;
                        var duracionCupo = duracionTotal / evento.cupos;
                       // var horaDisponible = new Date(horaInicio.getTime() + (duracionCupo * (evento.cupos - evento.cuposlibres) * 60000));
                       // var horaDisponibleFormatted = horaDisponible.toTimeString().slice(0, 5);

                        // Condición si hay cupos libres
                        if (evento.cuposlibres > 0) {
                            var horaDisponible = new Date(horaInicio.getTime() + (duracionCupo * (evento.cupos - evento.cuposlibres) * 60000));
                            horaDisponibleFormatted = horaDisponible.toTimeString().slice(0, 5);
                        }else {

                            horaDisponibleFormatted =null;
                        }

                try {
                document.getElementById('horadisponible').value = horaDisponibleFormatted;
                    // Rellenar los campos del formulario en el modal
                document.getElementById('disponibilidad_id').value = evento.disponibilidadId;
                document.getElementById('fecha').value = evento.fecha;
                document.getElementById('horario').value = evento.horainicio + ' a ' + evento.horafin;
                //document.getElementById('detallesDisponibilidad').innerText = info.event.title + ' - ' + evento.description;
                document.getElementById('detallesDisponibilidad').innerHTML = 
                 info.event.title + ' - ' + evento.description + '<br>Fecha: ' + evento.fecha + '<br>Horario: ' + evento.horainicio + ' a ' + evento.horafin +'<br>Cupos: ' + evento.cupos + '<br>Cupos libres: ' + evento.cuposlibres ;
              
                } catch (error) {
                    console.log("Elementos del DOM no encontrados: ", error);
                }
              
              
              
                 // Mostrar el modal
                var reservaModal = new bootstrap.Modal(document.getElementById('reservaModal'));
                reservaModal.show();
            },
            eventDidMount: function(info) {
                // Tooltip para mostrar el título y la descripción en líneas separadas
                new bootstrap.Tooltip(info.el, {
                    title: `<strong>${info.event.title}</strong><br><span>${info.event.extendedProps.description}</span>`,
                    html: true,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });

        calendar.render();
    });
</script>



@endsection
