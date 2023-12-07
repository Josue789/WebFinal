<?php 
    require_once('../datos/daoUsuario.php');
    
    if(count($_POST)>1){
        // * Verificar datos
        if(ISSET($_POST["Usuario"])&&ISSET($_POST["Contrasenia"])){
            // Conectar con bd y buscar usuario
            $dao = new DAOUsuario();
            $usuario=$dao->Autenticar($_POST["Usuario"],$_POST["Contrasenia"]);
        if($usuario){
            session_start();
            $_SESSION["usuario"]=$usuario->id;
            $_SESSION["nombre"]=$usuario->nombre;
            $_SESSION["institucion"]=$usuario->institucion;
            $_SESSION["tipo"]=$usuario->tipo;

            if($usuario->tipo=="Coach"){
                header("Location: index.php");
            }else{
                header("Location: indexAdmin.php");
            }
            return;
        }else{
            $_SESSION["msj"]="danger-Datos invalidos";
        }
    }
    }  
?>