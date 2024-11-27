@extends('layouts.index')

@section('title', 'Login')

@section('content')
   <!-- Login Page -->
   <section class="py-5" style="background-color: #b8e6b3;"> <!-- Verde claro -->
   <head>
  <!-- Your code -->
</head>
        <div class="container">
        <div class="row justify-content-center">
            <!-- Imagen a la izquierda -->
            <div class="col-lg-5 d-flex justify-content-center align-items-center">
                <img class="img-fluid rounded-3" src="https://png.pngtree.com/png-clipart/20230822/original/pngtree-doctors-examining-huge-liver-with-magnifier-and-microscope-picture-image_8163417.png" alt="Imagen de inicio de sesión" />
            </div>

            <!-- Formulario a la derecha -->
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-5" style="background-color: #f9f9f9;"> <!-- Fondo más claro para el formulario -->
                    <h3 class="text-center text-primary mb-4" style="font-family: 'Roboto', sans-serif;">Iniciar Sesión</h3>

                        <!-- Error Alert -->
                        @if ($errors->has('error'))
                            <div class="alert alert-danger text-center">
                                {{ $errors->first('error') }}
                            </div>
                        @endif

                        <form method="POST" action="">
                            @csrf
                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label text-muted" for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" placeholder="example@gmail.com"
                                    class="form-control form-control-lg rounded-pill" required />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="form-label text-muted" for="password">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg rounded-pill" required />
                            </div>

                            <!-- Error Message -->
                            @error('message')
                                <p class="alert alert-danger text-center">
                                    {{ $message }}
                                </p>
                            @enderror

                            @error('g-recaptcha-response')
                            <p class="alert alert-danger text-center">
                                {{ $message }}
                            </p>
                        @enderror
                    
                        <!-- reCAPTCHA -->
                        <div class="form-group">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        
                        <!-- Debugging -->
                      
                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button class="btn btn-primary btn-lg rounded-pill" type="submit">Iniciar Sesión</button>
                            </div>

                            <!-- Links -->
                            <div class="text-center">
                                <a class="small text-muted" href="#!">¿Olvidaste tu contraseña?</a>
                                <p class="mt-3">
                                    ¿No tienes una cuenta?
                                    <a href="{{ route('register.index') }}" class="btn btn-outline-primary text-dark btn-sm">Regístrate aquí</a>
                                    </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</section>


@endsection
