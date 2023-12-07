<?php
    $coach = new Usuario();

    if (count($_POST)>1) {
        $valNombre=$valContrasenia=$valCorreo="is-invalid";
        $valido=true;

        //---------------------------------------- Proceso de verificacion de campos ---------------------------------
        // * La recoleccion de los input es usando el name

        // ? Validacion de nombre
        if(ISSET($_POST["Nombre"]) && 
          (strlen(trim($_POST["Nombre"]))>3 && strlen(trim($_POST["Nombre"]))<51) &&
            preg_match("/^[a-zA-Z\s]+$/",$_POST["Nombre"])){
            $valNombre="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de correo
        if(ISSET($_POST["Correo"]) && filter_var( $_POST["Correo"] , FILTER_VALIDATE_EMAIL)){
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
        $coach->id=ISSET($_POST["Id"])?trim($_POST["Id"]):0;
        $coach->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
        $coach->institucion=ISSET($_POST["Institucion"])?trim($_POST["Institucion"]):"";
        $coach->usuario=ISSET($_POST["Correo"])?trim($_POST["Correo"]):"";
        $coach->contrasenia=ISSET($_POST["Contrasenia"])?trim($_POST["Contrasenia"]):"";
        $coach->tipo="Coach";

        if ($valido) {
            //Usar el método agregar del dao
            $dao= new DAOUsuario();
            
            if($dao->agregar($coach)==0){
                $_SESSION["msj"]="danger-Error al intentar guardar";
            }else{
                $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                //Al finalizar el guardado redireccionar a la lista
                header("Location: login.php");
            }
            
        }


    }
    

    


?>