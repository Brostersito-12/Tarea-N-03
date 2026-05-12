<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
include('conexion.php');

if (isset($_POST['registrar_pedido'])) {
    $id_cliente = $_POST['id_cliente'];
    $id_helado = $_POST['id_helado'];
    $cantidad = $_POST['cantidad'];
    
    // Obtener precio del helado
    $res_p = mysqli_query($conexion, "SELECT precio FROM helados WHERE id_helado = $id_helado");
    $prod = mysqli_fetch_assoc($res_p);
    $total = $prod['precio'] * $cantidad;
    $estado = "pendiente";

    $query = "INSERT INTO pedidos (id_cliente, id_helado, cantidad, total, estado_pedido) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "iiids", $id_cliente, $id_helado, $cantidad, $total, $estado);
    mysqli_stmt_execute($stmt);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - Heladería</title>
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
            <h2>Gestión de Pedidos</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalPedido">Nuevo Pedido</button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Helado</th>
                        <th>Cant.</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT p.*, c.nombre as c_nom, c.apellido as c_ape, h.nombre_helado 
                              FROM pedidos p 
                              JOIN clientes c ON p.id_cliente = c.id_cliente 
                              JOIN helados h ON p.id_helado = h.id_helado";
                    $res = mysqli_query($conexion, $query);
                    while($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>{$row['id_pedido']}</td>";
                        echo "<td>{$row['c_nom']} {$row['c_ape']}</td>";
                        echo "<td>{$row['nombre_helado']}</td>";
                        echo "<td>{$row['cantidad']}</td>";
                        echo "<td>S/ " . number_format($row['total'], 2) . "</td>";
                        echo "<td><span class='badge bg-secondary'>{$row['estado_pedido']}</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPedido" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Cliente</label>
                    <select name="id_cliente" class="form-control" required>
                        <?php
                        $clientes = mysqli_query($conexion, "SELECT id_cliente, nombre, apellido FROM clientes");
                        while($c = mysqli_fetch_assoc($clientes)) {
                            echo "<option value='{$c['id_cliente']}'>{$c['nombre']} {$c['apellido']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Helado</label>
                    <select name="id_helado" class="form-control" required>
                        <?php
                        $prods = mysqli_query($conexion, "SELECT id_helado, nombre_helado, precio FROM helados");
                        while($p = mysqli_fetch_assoc($prods)) {
                            echo "<option value='{$p['id_helado']}'>{$p['nombre_helado']} (S/ {$p['precio']})</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" min="1" value="1" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="registrar_pedido" class="btn btn-success">Crear Pedido</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
// Control de ventas
