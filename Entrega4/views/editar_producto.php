<?php
session_start(); // Inicia la sesión aquí, si no lo has hecho ya
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Producto</h1>

        <!-- Mensaje de confirmación (si existe en la sesión) -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo ?>
        <?php endif; ?>

        <form action="index.php?action=actualizar&id=<?php echo $producto['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success" onclick="return confirm('¿Estás seguro de editar este producto?');">Editar Producto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
