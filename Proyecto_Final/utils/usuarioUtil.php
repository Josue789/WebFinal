<?php
    $usuario = new Usuario();

    $valNombre=$valInstitucion=$valTipo=$valUsuario=$valPassword="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){

        //Obtener la informacion de ese id
        $dao=new DAOUsuario();
        $usuario=$dao->obtenerUno($_POST["id"]);

    }elseif(count($_POST)>1){

        $valNombre=$valInstitucion=$valUsuario=$valPassword="is-invalid";
        $valido=true;
    //---------------------------------------- Proceso de verificacion de campos ---------------------------------
        // * La recoleccion de los input es usando el name

        // ? Validacion de nombre
        if(ISSET($_POST["Nombre"]) && 
          (strlen(trim($_POST["Nombre"]))>3 && strlen(trim($_POST["Nombre"]))<51) &&
            preg_match("/^[a-zA-Z.\s]+$/",$_POST["Nombre"])){
            $valNombre="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de usuario
        if (ISSET($_POST["Tipo"])=="Coach") {
            if(ISSET($_POST["Usuario"]) && filter_var( $_POST["Usuario"] , FILTER_VALIDATE_EMAIL)){
                $valCorreo="is-valid";
              }else{
                  $valido=false;
              }
        }else{
            if(ISSET($_POST["Usuario"]) && 
          (strlen(trim($_POST["Usuario"]))>3 && strlen(trim($_POST["Usuario"]))<51) &&
            preg_match("/^[a-zA-Z]+$/",$_POST["Usuario"])){
                $valUsuario="is-valid";
            }else{
                $valido=false;
            }
        }
        

        // ? Validacion de contrasenia
        // ! Si la el id es 0 (es un nuevo registro), se hace esta validacion
        if(ISSET($_POST["id"]) && $_POST["id"]==0){
            echo "Nuevo";
            if(ISSET($_POST["Contrasenia"]) && 
            (strlen(trim($_POST["Contrasenia"]))>=8 && strlen(trim($_POST["Contrasenia"]))<51) &&
                preg_match("/^[a-zA-Z0-9]+$/",$_POST["Contrasenia"])){
                $valContrasenia="is-valid";
            }else{
                $valido=false;
            }
        }else{
            // ! Si es una edicion de un registro, valida si hay algo en la caja de texto o no
            if (ISSET($_POST["Contrasenia"]) && $_POST["contrasenia"]!="") {
                // ! Si hay algo, entonces revisamos que cumpla la validacion
                if( (strlen(trim($_POST["Contrasenia"]))>=8 && strlen(trim($_POST["Contrasenia"]))<51) &&
                preg_match("/^[a-zA-Z0-9]+$/",$_POST["Contrasenia"])){
                    $valContrasenia="is-valid";
                }else{
                    $valido=false;
                }
            }else{
                $valContrasenia="is-valid";
            }
        }


        //Pasa los datos a un object de usuario
        $usuario->id=ISSET($_POST["id"])?trim($_POST["id"]):0;
        $usuario->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
        $usuario->usuario=ISSET($_POST["Usuario"])?trim($_POST["Usuario"]):"";
        $usuario->institucion=ISSET($_POST["Institucion"])?trim($_POST["Institucion"]):"";
        $usuario->contrasenia=ISSET($_POST["Contrasenia"])?trim($_POST["Contrasenia"]):"";
        $usuario->tipo=ISSET($_POST["Tipo"])?trim($_POST["Tipo"]):"";

        if ($valido) {
            //Usar el método agregar del dao
            $dao= new DAOUsuario();
            
            if($usuario->id==0){
                if($dao->agregar($usuario)==0){
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }else{
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: IndexAdmin.php");
                }
            }else{
                // ! Antes de mandar la edicion, revisa si se guardo algo en contraseña
                if(ISSET($usuario->contrasenia)){
                    // ! Si hay algo mandamos llamar el actualizar normal
                    if($dao->editar($usuario)){
                        $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                        //Al finalizar el guardado redireccionar a la lista
                        header("Location: IndexAdmin.php");
                    }else{
                        $_SESSION["msj"]="danger-Error al intentar guardar";
                    }
                }else{
                    // ! Si no hay, mandamos llamar una actualizacion especial sin contraseña
                    if($dao->editarSinContrasenia($usuario)){
                        $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                        //Al finalizar el guardado redireccionar a la lista
                        header("Location: IndexAdmin.php");
                    }else{
                        $_SESSION["msj"]="danger-Error al intentar guardar";
                    }
                }
            }
        }


    }


?>