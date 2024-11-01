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
$router->get('/', [LoginController::class, 'inicio']);
$router->get('/admin/login', [LoginController::class, 'login']);
$router->post('/admin/login', [LoginController::class, 'login']);
$router->get('/admin/logout', [LoginController::class, 'logout']);

// Recuperar contraseña
$router->get('/admin/olvide', [LoginController::class, 'olvide']);
$router->post('/admin/olvide', [LoginController::class, 'olvide']);
$router->get('/admin/recuperar', [LoginController::class, 'recuperar']);
$router->post('/admin/recuperar', [LoginController::class, 'recuperar']);

// Rutas Crear Cuenta
$router->get('/admin/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/admin/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/admin/confirmar', [LoginController::class, 'confirmar']);
$router->get('/admin/mensaje', [LoginController::class, 'mensaje']);

// Rutas de administrador
$router->get('/admin/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);



// api de citas
$router->get('/admin/api/servicios', [ApiController::class, 'index']);
$router->post('/admin/api/citas',[ApiController::class,'guardar']);
$router->post('/admin/api/eliminar',[ApiController::class,'eliminar']);
$router->get('/admin/api/horas',[ApiHoraController::class,'index']);

// Crud de servicios
// CREAR
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
// ACTUALIZAR
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
// ELIMINAR
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);






// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
