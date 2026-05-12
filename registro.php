<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Heladería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .register-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="text-center mb-4">
        <h2>Crear Cuenta</h2>
        <p class="text-muted">Únete a nuestra Heladería</p>
    </div>
    
    <form action="registro_proceso.php" method="POST">
        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" name="rol" id="rol">
                <option value="empleado">Empleado</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        <div class="text-center mt-3">
            <a href="index.php">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </form>
    
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success mt-3" role="alert">
            Usuario registrado con éxito.
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger mt-3" role="alert">
            Error al registrar el usuario.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
