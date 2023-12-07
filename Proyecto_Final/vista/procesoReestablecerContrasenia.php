<?php
require_once('../datos/daoUsuario.php');

// Verificar si se ha enviado un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar la nueva contraseña y confirmar contraseña del formulario
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validar y actualizar la contraseña en la base de datos
    if ($newPassword === $confirmPassword) {
        // Aquí deberías tener una lógica para obtener el usuario (por correo electrónico, nombre de usuario, etc.)
        // Puedes utilizar tu función existente como obtenerUsuarioPorCorreoElectronico o similar
        $dao = new DAOUsuario();
        $usuario = $dao->obtenerUsuarioPorUsuario($_POST['usuario']);

        if ($usuario) {
            $actualizacionExitosa = $dao->actualizarContrasenia($id_Usuario, $newPassword);
            if ($actualizacionExitosa) {
                // Redirigir al usuario a la página de inicio de sesión
                header("Location: login.php");
                exit();
            } else {
                echo "Error al actualizar la contraseña";
            }
        } else {
            echo "Usuario no encontrado";
        }
    } else {
        echo "Las contraseñas no coinciden";
    }
}
?>
