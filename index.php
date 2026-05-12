<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Doña Solina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #ff6b6b;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ee5253;
        }
        .brand-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .brand-logo h1 {
            color: #ff6b6b;
            font-family: 'Brush Script MT', cursive;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="brand-logo">
        <h1>Doña Solina</h1>
        <p class="text-muted">Dulces Regionales y Helados</p>
    </div>
    
    <form action="login_proceso.php" method="POST">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        <div class="text-center mt-3">
            <a href="registro.php" class="text-muted small">¿No tienes cuenta? Regístrate aquí</a>
        </div>
    </form>
    
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger mt-3" role="alert">
            Usuario o contraseña incorrectos.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
