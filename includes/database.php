<?php

// $db = mysqli_connect(
// $_ENV['BD_HOST'], 
// $_ENV['BD_USER'], 
// $_ENV['BD_PASS'],
// $_ENV['DB_NAME'],
// );

// $db->set_charset("utf8");

// if (!$db) {
//     echo "Error: No se pudo conectar a MySQL.";
//     echo "errno de depuración: " . mysqli_connect_error();
//     echo "error de depuración: " . mysqli_connect_error();
//     exit;
// }



// // Detectar el subdominio
// $host = $_SERVER['HTTP_HOST'];
// $subdominio = explode('.', $host)[0];

// // Cargar credenciales desde el .env
// $env = parse_ini_file(__DIR__ . '/../includes/.env');

// // Seleccionar la BD correcta
// if ($subdominio == "sas") {
//     $db_host = $env['BD_HOST_SAS'];
//     $db_user = $env['BD_USER_SAS'];
//     $db_pass = $env['BD_PASS_SAS'];
//     $db_name = $env['BD_NAME_SAS'];
// } elseif ($subdominio == "odonto") {
//     $db_host = $env['BD_HOST_ODONTO'];
//     $db_user = $env['BD_USER_ODONTO'];
//     $db_pass = $env['BD_PASS_ODONTO'];
//     $db_name = $env['BD_NAME_ODONTO'];
// } else {
//     die("Error: Clínica no registrada.");
// }

// // Conectar a la base de datos
// $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// if (!$db) {
//     die("Error: No se pudo conectar a MySQL. " . mysqli_connect_error());
// }

// $db->set_charset("utf8");




// Detectar el subdominio correctamente
$host = $_SERVER['HTTP_HOST'];
$partes_dominio = explode('.', $host);
$subdominio = $partes_dominio[0]; // Extrae el primer nivel del dominio

// Cargar credenciales desde el archivo .env
$env = parse_ini_file(__DIR__ . '/../includes/.env');

// Lista de bases de datos según el subdominio
$clinicas = [
    "sas" => [
        "BD_HOST" => $env['BD_HOST_SAS'],
        "BD_USER" => $env['BD_USER_SAS'],
        "BD_PASS" => $env['BD_PASS_SAS'],
        "BD_NAME" => $env['BD_NAME_SAS']
    ],
    "odonto" => [
        "BD_HOST" => $env['BD_HOST_ODONTO'],
        "BD_USER" => $env['BD_USER_ODONTO'],
        "BD_PASS" => $env['BD_PASS_ODONTO'],
        "BD_NAME" => $env['BD_NAME_ODONTO']
    ]
];

// Verificar si el subdominio está en la lista de clínicas
if (!isset($clinicas[$subdominio])) {
    die("⚠️ Error: Clínica no registrada.");
}

// Obtener las credenciales correctas
$db_config = $clinicas[$subdominio];

// Conectar a la base de datos
$db = mysqli_connect(
    $db_config["BD_HOST"],
    $db_config["BD_USER"],
    $db_config["BD_PASS"],
    $db_config["BD_NAME"]
);

// Verificar conexión
if (!$db) {
    die("❌ Error: No se pudo conectar a MySQL. " . mysqli_connect_error());
}

$db->set_charset("utf8");

// 🚨 Verificar la expiración de la membresía
$query = "SELECT fecha_registro FROM clinicas WHERE subdominio = '$subdominio'";
$result = mysqli_query($db, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $fecha_registro = $row['fecha_registro'];

    // Calcular la fecha de expiración (+3 meses desde la fecha de registro)
    $fecha_expiracion = date('Y-m-d', strtotime($fecha_registro . ' +3 months'));
    $fecha_actual = date('Y-m-d');

    if ($fecha_actual > $fecha_expiracion) {
        // 🚨 Membresía expirada, bloquear acceso o redirigir
        die("⛔ Acceso denegado: Tu suscripción ha caducado. Contacta con soporte para renovarla.");
        
        // OPCIONAL: Redirigir a página de pago
        // header("Location: renovar.php");
        // exit();
    }
} else {
    die("⚠️ Error al verificar la suscripción.");
}
?>

