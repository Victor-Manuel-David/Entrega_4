<?php
require_once 'models/ProductoModel.php';

class ProductoController {
    private $productoModel;

    public function __construct($db) {
        $this->productoModel = new ProductoModel($db);
    }

    // Método para mostrar todos los productos
    public function index() {
        $productos = $this->productoModel->obtenerProductos();
        require 'views/index.php'; // Asegúrate de que esta vista esté configurada para mostrar productos
    }

    // Método para crear un nuevo producto
    public function crearProducto($datos) {
        $this->productoModel->crearProducto($datos);
        header("Location: index.php");
    }

    // Método para actualizar un producto existente
    public function actualizarProducto($id, $datos) {
        // Llamamos al método para actualizar el producto
        $this->productoModel->actualizarProducto($id, $datos);
        
        // Después de actualizar, pasamos el mensaje a la vista
        $_SESSION['mensaje'] = "Producto actualizado con éxito";
        header("Location: index.php");
    }
    

    // Método para eliminar un producto por su ID
    public function eliminarProducto($id) {
        $this->productoModel->eliminarProducto($id);
        header("Location: index.php");
    }

    // Método para obtener un producto por su ID (para edición o detalles)
    public function obtenerProductoPorId($id) {
        $producto = $this->productoModel->obtenerProductoPorId($id);
        require 'views/editar_producto.php'; // Vista específica para editar o ver detalles de un producto
    }
}
?>
