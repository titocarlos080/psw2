@extends('layouts.index')

@section('title', 'Clinica del Higado')

@section('content')

@php
    $disponibilidades = App\Models\Disponibilidad::where('estado', 'disponible')->get();
@endphp

<!-- Header -->
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Servicio Médico a su Alcance</h1>
                    <p class="lead fw-normal text-white-50 mb-4">Obtenga un resultado rápido y eficaz con la ayuda de profesionales</p>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <img class="img-fluid rounded-3 my-5" src="https://clinicadetextos.com/wp-content/uploads/2016/09/clinica-de-textos.jpg" alt="..." />
            </div>
        </div>
    </div>
</header>

<!-- Form Section --> 
<section class="py-5">
    <div class="container px-5 my-5">
        <form method="POST" action="{{ route('citas.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la Cita</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="horario" class="form-label">Seleccione Disponibilidad</label>
                <select name="disponibilidad_id" class="form-control" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    @foreach($disponibilidades as $disponibilidad)
                        <option value="{{ $disponibilidad->id }}">
                            {{ $disponibilidad->fecha }} - {{ $disponibilidad->horainicio }} a {{ $disponibilidad->horafin }} 
                            ({{ $disponibilidad->cupo }} cupos)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Reservar Cita</button>
            </div>
        </form>
    </div>
</section>

<!-- Calendar Section -->
<section class="py-5">
    <div class="container px-5 my-5">
        <div id="calendar"></div>
    </div>
</section>

<!-- Include FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            aspectRatio: 1., // Ajusta este valor para hacer que el calendario sea más ancho o estrecho
            dateClick: function(info) {
                document.getElementById('fecha').value = info.dateStr;
            },
            events: [
                @foreach($disponibilidades as $disponibilidad)
                {
                    title: 'Disponible: {{ $disponibilidad->user->medico->nombre ?? 'No asignado' }}  {{ $disponibilidad->user->medico->a_paterno ?? 'No asignado' }}',
                    start: '{{ $disponibilidad->fecha }}T{{ $disponibilidad->horainicio }}',
                    end: '{{ $disponibilidad->fecha }}T{{ $disponibilidad->horafin }}',
                    description: 'Cupos: {{ $disponibilidad->cupo }}'
                },
                @endforeach
            ],
            eventDidMount: function(info) {
                // Inicialización del tooltip con Bootstrap
                new bootstrap.Tooltip(info.el, {
                    title: info.event.extendedProps.description,
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

<style>
    #calendar {
        max-width: 100%;
        margin: auto;
        padding: 10px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>


@endsection
