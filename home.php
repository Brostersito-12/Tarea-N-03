<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Heladería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar { height: 100vh; background-color: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background-color: #34495e; }
        .main-content { padding: 20px; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .card-custom:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h3 class="text-center mb-4" style="font-family: 'Brush Script MT', cursive;">Heladería</h3>
            <p class="text-center small">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></p>
            <hr>
            <a href="home.php"><i class="bi bi-house-door"></i> Inicio</a>
            <a href="clientes.php"><i class="bi bi-people"></i> Clientes</a>
            <a href="helados.php"><i class="bi bi-snow"></i> Helados</a>
            <a href="pedidos.php"><i class="bi bi-cart"></i> Pedidos</a>
            <hr>
            <a href="logout.php" class="text-danger"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Panel de Control</h2>
                <span class="badge bg-primary"><?php echo strtoupper($_SESSION['rol']); ?></span>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card card-custom bg-info text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-people fs-1"></i>
                            <h5 class="card-title mt-2">Clientes</h5>
                            <?php
                            $res = mysqli_query($conexion, "SELECT COUNT(*) as total FROM clientes");
                            $data = mysqli_fetch_assoc($res);
                            echo "<h3>" . $data['total'] . "</h3>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-custom bg-success text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-snow fs-1"></i>
                            <h5 class="card-title mt-2">Sabores en Stock</h5>
                            <?php
                            $res = mysqli_query($conexion, "SELECT COUNT(*) as total FROM helados");
                            $data = mysqli_fetch_assoc($res);
                            echo "<h3>" . $data['total'] . "</h3>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-custom bg-warning text-dark">
                        <div class="card-body text-center">
                            <i class="bi bi-cart fs-1"></i>
                            <h5 class="card-title mt-2">Pedidos Totales</h5>
                            <?php
                            $res = mysqli_query($conexion, "SELECT COUNT(*) as total FROM pedidos");
                            $data = mysqli_fetch_assoc($res);
                            echo "<h3>" . $data['total'] . "</h3>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h4>Nuestros Helados</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Sabor</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM helados LIMIT 5";
                            $result = mysqli_query($conexion, $query);
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['nombre_helado'] . "</td>";
                                echo "<td>" . $row['sabor'] . "</td>";
                                echo "<td>" . $row['categoria'] . "</td>";
                                echo "<td>S/ " . number_format($row['precio'], 2) . "</td>";
                                echo "<td>" . $row['stock'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
