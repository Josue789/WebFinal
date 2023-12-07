<?php
require_once('../datos/daoUsuario.php');

// Verificar si se ha enviado un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar el nombre de usuario o correo electrónico del formulario
    $username = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : null;

    // Validar que el usuario o correo exista en la base de datos
    $dao = new DAOUsuario();
    $usuario = $dao->obtenerUsuarioPorUsuario($username);

    if ($usuario) {
        // Generar y almacenar un token en la base de datos (puedes implementar esta lógica aquí)

        // Redirigir a la página de cambio de contraseña
        header("Location: reestablecerContrasenia.php");
        exit();
    } else {
        // Usuario o correo no encontrado
        echo "Usuario o correo no encontrado";
    }
}
?>
