<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
        <h2 class="mt-5">Recuperar Contraseña</h2>
        <form action="procesoRecuperarContrasenia.php" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario o Correo Electrónico</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Instrucciones</button>
        </form>
        <p class="mt-3">
            <a href="login.php">Volver al Inicio de Sesión</a>
        </p>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
