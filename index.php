<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/includes/app.php';

// require_once __DIR__ . '/appsalon/includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\ApiHoraController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();

// Rutas de inicio de sesión
$router->get('/paginaNoEncontrada', [LoginController::class, 'paginaNoEncontrada']);
$router->get('/inicio', [LoginController::class, 'inicio']);
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar contraseña
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Rutas Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// Rutas de administrador
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);



// api de citas
$router->get('/api/servicios', [ApiController::class, 'index']);
$router->post('/api/citas',[ApiController::class,'guardar']);
$router->post('/api/eliminar',[ApiController::class,'eliminar']);
$router->get('/api/horas',[ApiHoraController::class,'index']);

// Crud de servicios
// CREAR
$router->get('/admin/servicios', [ServicioController::class, 'index']);
$router->get('/admin/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/admin/servicios/crear', [ServicioController::class, 'crear']);

// API DE SERVICIOS
$router->get('/admin/api/apicitaservicio', [ServicioController::class, 'apicitaservicio']);



// CREAR CLIENTE
$router->get('/admin/servicios/cliente', [ServicioController::class, 'cliente']);
$router->post('/admin/servicios/cliente', [ServicioController::class, 'cliente']);

// CREAR CITA
$router->get('/admin/servicios/agendar', [ServicioController::class, 'agendar']);
$router->post('/admin/servicios/agendar', [ServicioController::class, 'agendar']);

// CALENDARIO
$router->get('/admin/servicios/calendario', [ServicioController::class, 'calendario']);


// ACTUALIZAR
$router->get('/admin/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/admin/servicios/actualizar', [ServicioController::class, 'actualizar']);
// ELIMINAR
$router->post('/admin/servicios/eliminar', [ServicioController::class, 'eliminar']);






// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
