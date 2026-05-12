<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
include('conexion.php');

if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];

    $query = "INSERT INTO clientes (nombre, apellido, dni, telefono, direccion, correo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $dni, $telefono, $direccion, $correo);
    mysqli_stmt_execute($stmt);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Heladería</title>
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
            <h2>Gestión de Clientes</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCliente">Nuevo Cliente</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conexion, "SELECT * FROM clientes");
                    while($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>{$row['id_cliente']}</td>";
                        echo "<td>{$row['nombre']} {$row['apellido']}</td>";
                        echo "<td>{$row['dni']}</td>";
                        echo "<td>{$row['telefono']}</td>";
                        echo "<td>{$row['correo']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCliente" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
                <div class="mb-2"><input type="text" name="apellido" class="form-control" placeholder="Apellido" required></div>
                <div class="mb-2"><input type="text" name="dni" class="form-control" placeholder="DNI" required></div>
                <div class="mb-2"><input type="text" name="telefono" class="form-control" placeholder="Teléfono"></div>
                <div class="mb-2"><input type="text" name="direccion" class="form-control" placeholder="Dirección"></div>
                <div class="mb-2"><input type="email" name="correo" class="form-control" placeholder="Correo"></div>
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
// Registro de clientes
