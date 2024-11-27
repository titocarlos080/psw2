@extends('layouts.index')

@section('title', 'HepatoScan AI')

@section('content')
    <!-- Registration Page -->
    <section class="py-5" style="background-color: #b8e6b3;">  
        <div class="container px-5">
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row gx-5 justify-content-center">
                <!-- Form Column -->
                <div class="col-lg-6 col-md-8">
                    <div class="rounded-3 py-5 px-4 px-md-5 mb-5 shadow-lg" style="background-color: #f9f9f9;">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder text-primary">Registro</h1>
                            <p class="lead fw-normal text-muted mb-0">Ingresa tus datos personales para continuar</p>
                        </div>

                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <!-- CI input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ci" name="ci" type="text" placeholder="Ingresa tu CI..." value="{{ old('ci') }}" />
                                <label for="ci">CI</label>
                                @error('ci')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nombre input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingresa tu nombre..." value="{{ old('nombre') }}" />
                                <label for="nombre">Nombre</label>
                                @error('nombre')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Apellido Paterno -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="a_paterno" name="a_paterno" type="text" placeholder="Ingresa tu apellido paterno..." value="{{ old('a_paterno') }}" />
                                <label for="a_paterno">Apellido Paterno</label>
                                @error('a_paterno')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Apellido Materno -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="a_materno" name="a_materno" type="text" placeholder="Ingresa tu apellido materno..." value="{{ old('a_materno') }}" />
                                <label for="a_materno">Apellido Materno</label>
                                @error('a_materno')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Género -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="sexo" name="sexo">
                                    <option value="">Seleccione su género</option>
                                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                </select>
                                <label for="sexo">Género</label>
                                @error('sexo')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teléfono -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="telefono" name="telefono" type="tel" placeholder="Ingresa tu teléfono..." value="{{ old('telefono') }}" />
                                <label for="telefono">Teléfono</label>
                                @error('telefono')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="direccion" name="direccion" type="text" placeholder="Ingresa tu dirección..." value="{{ old('direccion') }}" />
                                <label for="direccion">Dirección</label>
                                @error('direccion')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nombre de usuario -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Ingresa tu nombre de usuario..." value="{{ old('name') }}" />
                                <label for="name">Nombre de usuario</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" />
                                <label for="email">Email</label>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Crea una contraseña" />
                                <label for="password">Contraseña</label>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirmar Password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirma tu contraseña" />
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    Acepto los <a href="#" id="terms-link" data-bs-toggle="modal" data-bs-target="#termsModal">Términos y Condiciones</a>
                                </label>
                                @error('terms')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Submit Button-->
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg rounded-pill" id="submitButton" type="submit">Registrarme</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="http://clipart-library.com/newhp/kissclipart-health-care-clip-art-medicine-general-medical-exam-0efd34881c07b4da.png" class="img-fluid rounded-3 shadow-lg" alt="Imagen de registro" />
                </div>
            </div>

            
        </div>

        <!-- Modal Términos y Condiciones -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Última actualización: [26/11/2024]</h6>
                        <p>Bienvenido al sistema de gestión de citas de nuestra clínica (en adelante, el "Sistema"). Este documento establece los términos y condiciones (en adelante, los "Términos") bajo los cuales usted (en adelante, el "Usuario") podrá hacer uso del sistema, tanto en su versión web como en su aplicación móvil, para la gestión de citas, el registro de datos personales y la recepción de notificaciones. Al utilizar el sistema, usted acepta y se compromete a cumplir con los presentes Términos.</p>
        
                        <h6>1. Uso del Sistema</h6>
                        <p>1.1. El sistema está diseñado para facilitar la gestión de citas médicas, incluyendo la reserva, modificación y cancelación de citas.</p>
                        <p>1.2. El Usuario se compromete a utilizar el sistema exclusivamente para fines personales y relacionados con la gestión de citas en nuestra clínica.</p>
                        <p>1.3. El uso indebido del sistema, incluyendo actividades fraudulentas o no autorizadas, está estrictamente prohibido.</p>
        
                        <h6>2. Registro de Datos</h6>
                        <p>2.1. Para utilizar el sistema, el Usuario debe proporcionar información personal precisa, completa y actualizada, incluyendo:</p>
                        <ul>
                            <li>Número de Cédula de Identidad (CI)</li>
                            <li>Nombre completo</li>
                            <li>Apellidos (Paterno y Materno)</li>
                            <li>Sexo</li>
                            <li>Teléfono</li>
                            <li>Dirección</li>
                        </ul>
                        <p>2.2. El Usuario es responsable de mantener actualizada esta información para garantizar el correcto funcionamiento del sistema.</p>
                        <p>2.3. Los datos proporcionados serán tratados conforme a nuestra <strong>Política de Privacidad</strong> (ver sección 5).</p>
        
                        <h6>3. Reservas de Citas</h6>
                        <p>3.1. El Usuario podrá realizar reservas de citas médicas a través del sistema web o la aplicación móvil.</p>
                        <p>3.2. Las citas están sujetas a disponibilidad. La clínica no garantiza la confirmación de una cita en caso de alta demanda o falta de disponibilidad.</p>
                        <p>3.3. Es responsabilidad del Usuario cancelar citas con antelación si no podrá asistir.</p>
        
                        <h6>4. Notificaciones</h6>
                        <p>4.1. El sistema enviará notificaciones importantes al Usuario a través de la aplicación móvil, incluyendo:</p>
                        <ul>
                            <li>Confirmación de citas.</li>
                            <li>Recordatorios de citas programadas.</li>
                            <li>Actualizaciones o cancelaciones de citas.</li>
                        </ul>
                        <p>4.2. Es responsabilidad del Usuario asegurarse de que las notificaciones estén habilitadas en la aplicación móvil para recibir estas comunicaciones.</p>
                        <p>4.3. La clínica no se hace responsable si el Usuario no recibe notificaciones debido a configuraciones incorrectas en su dispositivo.</p>
        
                        <h6>5. Tratamiento de Datos Personales</h6>
                        <p>5.1. Los datos personales recopilados serán utilizados exclusivamente para los siguientes fines:</p>
                        <ul>
                            <li>Gestión de citas médicas.</li>
                            <li>Envío de notificaciones relacionadas con las citas.</li>
                            <li>Mejora del servicio proporcionado por la clínica.</li>
                        </ul>
                        <p>5.2. La clínica garantiza la protección de los datos personales conforme a la normativa vigente en protección de datos personales.</p>
                        <p>5.3. En ningún caso, los datos personales serán compartidos con terceros sin el consentimiento expreso del Usuario, salvo cuando sea requerido por ley.</p>
        
                        <h6>6. Responsabilidades del Usuario</h6>
                        <p>6.1. El Usuario es responsable de mantener la confidencialidad de su cuenta y credenciales de acceso.</p>
                        <p>6.2. La clínica no se hace responsable por el acceso no autorizado al sistema debido a negligencia del Usuario en la protección de sus credenciales.</p>
                        <p>6.3. El Usuario se compromete a notificar inmediatamente cualquier uso no autorizado de su cuenta.</p>
        
                        <h6>7. Limitaciones de Responsabilidad</h6>
                        <p>7.1. La clínica no se responsabiliza por:</p>
                        <ul>
                            <li>Fallos técnicos en el sistema o la aplicación móvil.</li>
                            <li>Pérdida de datos debido a errores técnicos o interrupciones del servicio.</li>
                            <li>Incumplimiento del Usuario en mantener actualizados sus datos o en seguir las instrucciones del sistema.</li>
                        </ul>
                        <p>7.2. En caso de problemas técnicos, el Usuario podrá ponerse en contacto con el soporte técnico de la clínica para buscar una solución.</p>
        
                        <h6>8. Modificaciones a los Términos y Condiciones</h6>
                        <p>8.1. La clínica se reserva el derecho de modificar estos Términos en cualquier momento. Las modificaciones entrarán en vigor a partir de su publicación en el sistema.</p>
                        <p>8.2. Es responsabilidad del Usuario revisar periódicamente los Términos para mantenerse informado de cualquier cambio.</p>
        
                        <h6>9. Ley Aplicable y Jurisdicción</h6>
                        <p>9.1. Estos Términos se rigen por las leyes del país en el que se encuentra la clínica.</p>
                        <p>9.2. En caso de disputa, el Usuario y la clínica acuerdan someterse a la jurisdicción de los tribunales competentes de la localidad donde opera la clínica.</p>
        
                        <h6>10. Aceptación de los Términos</h6>
                        <p>10.1. Al registrarse y utilizar el sistema, el Usuario confirma que ha leído, entendido y aceptado estos Términos.</p>
                        <p>10.2. Si el Usuario no está de acuerdo con estos Términos, deberá abstenerse de utilizar el sistema.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        

    </section>
@endsection
