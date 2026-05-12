<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
include('conexion.php');

if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre_helado'];
    $sabor = $_POST['sabor'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    $query = "INSERT INTO helados (nombre_helado, sabor, categoria, precio, stock, descripcion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssdss", $nombre, $sabor, $categoria, $precio, $stock, $descripcion);
    mysqli_stmt_execute($stmt);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Helados - Heladería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar { height: 100vh; background-color: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background-color: #34495e; }
        .main-content { padding: 20px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h3 class="text-center mb-4" style="font-family: 'Brush Script MT', cursive;">Heladería</h3>
            <hr>
            <a href="home.php"><i class="bi bi-house-door"></i> Inicio</a>
            <a href="clientes.php"><i class="bi bi-people"></i> Clientes</a>
            <a href="helados.php"><i class="bi bi-snow"></i> Helados</a>
            <a href="pedidos.php"><i class="bi bi-cart"></i> Pedidos</a>
            <hr>
            <a href="logout.php" class="text-danger"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>
        <div class="col-md-10 main-content">
            <h2>Inventario de Helados</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalHelado">Nuevo Helado</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Helado</th>
                        <th>Sabor</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conexion, "SELECT * FROM helados");
                    while($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>{$row['id_helado']}</td>";
                        echo "<td>{$row['nombre_helado']}</td>";
                        echo "<td>{$row['sabor']}</td>";
                        echo "<td>{$row['categoria']}</td>";
                        echo "<td>S/ " . number_format($row['precio'], 2) . "</td>";
                        echo "<td>{$row['stock']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalHelado" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Helado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2"><input type="text" name="nombre_helado" class="form-control" placeholder="Nombre del Helado" required></div>
                <div class="mb-2"><input type="text" name="sabor" class="form-control" placeholder="Sabor" required></div>
                <div class="mb-2">
                    <select name="categoria" class="form-control">
                        <option value="Crema">Crema</option>
                        <option value="Agua">Agua</option>
                        <option value="Sin Azúcar">Sin Azúcar</option>
                    </select>
                </div>
                <div class="mb-2"><input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required></div>
                <div class="mb-2"><input type="number" name="stock" class="form-control" placeholder="Stock" required></div>
                <div class="mb-2"><textarea name="descripcion" class="form-control" placeholder="Descripción"></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="agregar" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
// Gestión de helados
