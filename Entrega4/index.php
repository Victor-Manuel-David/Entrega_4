<?php
require_once 'controllers/ProductoController.php';

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aplicaciones"; // Cambia el nombre de la base de datos si es necesario

// Crear conexión a la base de datos
$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

// Instanciar el controlador de productos
$controller = new ProductoController($db);

// Capturar la acción y el ID de los parámetros GET
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

// Procesar solicitudes POST para crear o actualizar productos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = $_POST;
    if ($action == 'crear') {
        $controller->crearProducto($datos);
    } elseif ($action == 'actualizar' && $id) {
        $controller->actualizarProducto($id, $datos);
    }
} elseif ($action == 'eliminar' && $id) {
    // Procesar solicitud GET para eliminar productos
    $controller->eliminarProducto($id);
} elseif ($action == 'editar' && $id) {
    // Mostrar formulario de edición para un producto específico
    $controller->obtenerProductoPorId($id);
} else {
    // Mostrar la lista de productos por defecto
    $controller->index();
}

// Cerrar la conexión a la base de datos
$db->close();
?>
