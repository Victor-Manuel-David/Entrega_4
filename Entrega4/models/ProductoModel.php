<?php
class ProductoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Método para obtener todos los productos
    public function obtenerProductos() {
        $sql = "SELECT * FROM Producto";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obtener un producto por su ID
    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM Producto WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    // Método para crear un nuevo producto
    public function crearProducto($datos) {
        $nombre = $datos['nombre'];
        $descripcion = $datos['descripcion'];
        $precio = $datos['precio'];
        $cantidad = $datos['cantidad'];

        $sql = "INSERT INTO Producto (nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $cantidad);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    // Método para actualizar un producto existente
    public function actualizarProducto($id, $datos) {
        $nombre = $datos['nombre'];
        $descripcion = $datos['descripcion'];
        $precio = $datos['precio'];
        $cantidad = $datos['cantidad'];

        $sql = "UPDATE Producto SET nombre = ?, descripcion = ?, precio = ?, cantidad = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $cantidad, $id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    // Método para eliminar un producto
    public function eliminarProducto($id) {
        $sql = "DELETE FROM Producto WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
}
?>
