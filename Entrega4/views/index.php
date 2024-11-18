<?php
session_start(); // Inicia la sesión aquí, si no lo has hecho ya
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Productos</h1>

        <!-- Mensaje de confirmación (si existe en la sesión) -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo ?>
        <?php endif; ?>

        <!-- Formulario para agregar un nuevo producto -->
        <form action="index.php?action=crear" method="POST" class="mb-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <button type="submit" class="btn btn-primary" >Agregar Producto</button>
        </form>

        <!-- Tabla de productos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)) : ?>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['id']; ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                            <td><?php echo number_format($producto['precio'], 2); ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td>
                                <a href="index.php?action=editar&id=<?php echo $producto['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?action=eliminar&id=<?php echo $producto['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay productos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
