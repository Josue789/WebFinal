<?php
    $cuenta = new Usuario();

    if (count($_POST)>1) {
        $valNombre=$valContrasenia=$valCorreo="is-invalid";
        $valido=true;

        //---------------------------------------- Proceso de verificacion de campos ---------------------------------
        // * La recoleccion de los input es usando el name

        // ? Validacion de correo
        if(ISSET($_POST["Usuario"]) && 
            (filter_var( $_POST["Usuario"] , FILTER_VALIDATE_EMAIL) || preg_match("/^[a-zA-Z0-9]+$/",$_POST["Usuario"]))){
          $valCorreo="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de contrasenia
        if(ISSET($_POST["Contrasenia"]) && 
        (strlen(trim($_POST["Contrasenia"]))>7 && strlen(trim($_POST["Contrasenia"]))<51) &&
          preg_match("/^[a-zA-Z0-9]+$/",$_POST["Contrasenia"])){
          $valContrasenia="is-valid";
        }else{
            $valido=false;
        }


        //Pasa los datos a un object de concurso
        $cuenta->usuario=ISSET($_POST["Usuario"])?trim($_POST["Usuario"]):"";
        $cuenta->contrasenia=ISSET($_POST["Contrasenia"])?trim($_POST["Contrasenia"]):"";

        if ($valido) {

            $dao= new DAOUsuario();
   
            $obj = new Usuario();
            $obj = $dao->obtenerUnoUsuario($cuenta -> usuario);
   
            echo $obj -> usuario;

            if($obj->usuario == $cuenta->usuario){
                if($dao->cambiarContrasenia($obj->id,$cuenta->contrasenia)){
                    header("Location: login.php");
                }else{
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }
            }else{
                $_SESSION["msj"]="danger-El usuario no existe";
            }

        }
    }
    

    


?>