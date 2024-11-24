<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PaypalController;
use App\Http\Middleware\CheckSubscription;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\RecomendacionController;
use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\BackUpController;
use App\Http\Controllers\ThemeController;






Route::get('/', function () {
    return view('index');
})->name('index');
/*
// ruta para la pagina contacto
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/', function () {
    return view('home');
})->middleware('auth'); 
*/
Route::get('/home', function () { return view('home');});
Route::get('/index', function () {    return view('index');})->name('index2');
Route::get('/contact', function () {return view('contact');})->name('contact');

Route::get('/planes', [PlanesController::class, 'index'])->name('planes');
Route::get('/planes/show/{id}', [PlanesController::class, 'view'])->name('planes.view')->middleware('auth');
Route::get('/service', [ServicioController::class, 'index'])->name('service');/*->middleware(CheckSubscription::class);*/


Route::post('/webhook/paypal', [PaypalController::class, 'webhook'])->name('webhook');


//Route::get('/home', function () { return view('home');});
/*Rutas para inicio de session */
/*Ruta de registro de usuario*/
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
/*ruta de inicio de la session */
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login.index');
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');
/*Ruta de finalizar session */
Route::get('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('login.destroy');

/*///////////////////////////////////
////Rutas para el administrador////// 
/////////////////////////////////////*/

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth.admin')->name('admin.index');
Route::get('/cliente', [AdminController::class, 'indexcliente'])->middleware('auth.admin')->name('cliente.index');
Route::get('/medico', [AdminController::class, 'indexmedico'])->middleware('auth.admin')->name('medico.index');



/*/////////// USUARIO /////////////*/
/*Rutas para que el administrador registre a un Usuario*/
Route::get('/admin/registrarUsuario', [AdminController::class, 'registrarU'])->middleware('auth.admin')->name('admin.registrarusuario');
Route::get('/admin/registrarUsuario/crear', [AdminController::class, 'createUsuario'])->middleware('auth.admin')->name('admin.crearusuario');
Route::post('/admin/registrarUsuario/crear/create', [AdminController::class, 'storedUsuario'])->middleware('auth.admin')->name('admin.storedusuario');
/*Ruta para que el administrador elimine a un Usuario */
Route::get('/admin/registrarUsuario/deleteU/{id}', [AdminController::class, 'destroyUsuario'])->middleware('auth.admin')->name('admin.destroyusuario');
/*Ruta para que el administrador edite los datos de un Usuario*/
Route::get('/admin/registrarUsuario/editarV/{id}', [AdminController::class, 'editUsuario'])->middleware('auth.admin')->name('admin.editusuario');
Route::post('/admin/registrarUsuario/editarV1/{id}', [AdminController::class, 'updateUsuario'])->middleware('auth.admin')->name('admin.updateusuario');

/*///////// Rutas del Medico/////*/
Route::get('/admin/registrarMedico', [MedicoController::class, 'ListarP'])->middleware('auth.admin')->name('admin.listarMedico');
Route::get('/admin/registrarMedico/crear', [MedicoController::class, 'createMedico'])->middleware('auth.admin')->name('admin.crearMedico');
Route::post('/admin/registrarMedico/crear/create', [MedicoController::class, 'storedMedico'])->middleware('auth.admin')->name('admin.storedMedico');
Route::get('/admin/registrarMedico/editarP/{id}', [MedicoController::class, 'editMedico'])->middleware('auth.admin')->name('admin.editMedico');
Route::post('/admin/registrarMedico/editarP1/{id}', [MedicoController::class, 'updateMedico'])->middleware('auth.admin')->name('admin.updateMedico');
Route::get('/admin/registrarMedico/deleteP/{id}', [MedicoController::class, 'destroyMedico'])->middleware('auth.admin')->name('admin.destroyMedico');

/*/////////// CLIENTE////////////////// */
Route::get('/admin/registrarClientes', [ClienteController::class, 'ListarC'])->middleware('auth.admin')->name('admin.listarcliente');
Route::get('/admin/registrarClientes/crear', [ClienteController::class, 'createCliente'])->middleware('auth.admin')->name('admin.crearclientes');
Route::post('/admin/registrarClientes/crear/create', [ClienteController::class, 'storedCliente'])->middleware('auth.admin')->name('admin.storedClientes');
Route::get('/admin/registrarClientes/deleteC/{id}', [ClienteController::class, 'destroyCliente'])->middleware('auth.admin')->name('admin.destroyclientes');
Route::get('/admin/registrarClientes/editarC/{id}', [ClienteController::class, 'editCliente'])->middleware('auth.admin')->name('admin.editclientes');
Route::post('/admin/registrarClientes/editarC1/{id}', [ClienteController::class, 'updateCliente'])->middleware('auth.admin')->name('admin.updateclientes');

/*/////////// BACKUP////////////////// */

Route::get('/backup', [BackUpController::class, 'index'])->middleware('auth.admin')->name('admin.backup');
Route::post('/backup/create', [BackUpController::class, 'create'])->middleware('auth.admin')->name('backup.create');
Route::get('/backup/download/{filename}', [BackUpController::class, 'download'])->middleware('auth.admin')->name('backup.download');

Route::post('/change-theme', [ThemeController::class, 'changeTheme'])->middleware('auth.admin')->name('change.theme');


//Route::get('/diagnosticos/solicitarAPI', [DiagnosticoController::class, 'create'])->name('diagnosticos.create');

/*/////////// VER LISTA DE DIAGNOSTICO////////////////// */
//Route::get('/lista', [DiagnosticoController::class, 'index'])->name('diagnosticos.index');


Route::get('/diagnosticos/crearsolicitud', [DiagnosticoController::class, 'createsolicitud'])->name('diagnosticos.createsolicitud');
Route::post('/diagnosticos/solicitarAPI', [DiagnosticoController::class, 'solicitudAPI'])->name('diagnosticos.api.enviar');
/*/////////// RUTAS DE SOLICITAR DIAGNOSTICO Y RECOMENDACIONES////////////////// */

Route::get('/servicemedic', [ServicioController::class, 'indexmedic'])->name('servicemedic');
Route::post('/diagnosticos/solicitarAPI/medico', [ServicioController::class, 'solicitudAPI'])->name('diagnosticos.api.enviar.medico');


Route::middleware('auth')->group(function () {
    Route::resource('diagnosticos', DiagnosticoController::class);
    Route::resource('historial', DiagnosticoController::class);
});
// /diagnostico/create
Route::middleware('auth')->group(function () {
    Route::resource('recomendacion', RecomendacionController::class);
});
Route::post('/ruta', 'Controlador@metodo')->middleware('auth');

// /diagnostico/create
Route::middleware('auth')->group(function () {
  Route::resource('disponibilidades', DisponibilidadController::class);

});

// /diagnostico/create
Route::middleware('auth')->group(function () {
    Route::resource('citas', CitaController::class);
    Route::patch('citas/{id}/cancel', [CitaController::class, 'cancel'])->name('citas.cancel');
    Route::patch('citas/{id}/cancelrecepcion', [CitaController::class, 'cancelrecepcion'])->name('citas.cancelrecepcion');
    Route::patch('citas/{id}/finalize', [CitaController::class, 'finalize'])->name('citas.finalize');
    Route::post('citas/{id}/notificar', [CitaController::class, 'notificar'])->name('citas.notificar');

    Route::get('cita/recepciones', [CitaController::class, 'recepciones'])->name('citas.recepciones');
  });

// /recomendacion/create
