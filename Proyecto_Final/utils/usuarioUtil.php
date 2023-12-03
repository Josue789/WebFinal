<?php
    $usuario = new Usuario();

    $valNombre=$valInstitucion=$valTipo=$valUsuario=$valPassword="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){

        //Obtener la informacion de ese id
        $dao=new DAOUsuario();
        $usuario=$dao->obtenerUno($_POST["id"]);

    }elseif(count($_POST)>1){

        $valNombre=$valInstitucion=$valTipo=$valUsuario=$valPassword="is-invalid";
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
        if(ISSET($_POST["Usuario"]) && 
          (strlen(trim($_POST["Usuario"]))>3 && strlen(trim($_POST["Usuario"]))<51) &&
            preg_match("/^[a-zA-Z]+$/",$_POST["Usuario"])){
            $valUsuario="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de contrasenia
        if(ISSET($_POST["Contrasenia"]) && 
          (strlen(trim($_POST["Contrasenia"]))>8 && strlen(trim($_POST["Contrasenia"]))<51) &&
            preg_match("/^[a-zA-Z0-9]+$/",$_POST["Contrasenia"])){
            $valContrasenia="is-valid";
        }else{
            $valido=false;
        }


        //Pasa los datos a un object de usuario
        $usuario->id=ISSET($_POST["Id"])?trim($_POST["Id"]):0;
        $usuario->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
        $usuario->usuario=ISSET($_POST["Usuario"])?trim($_POST["Usuario"]):"";
        $usuario->institucion="ITSUR";
        $usuario->contrasenia=ISSET($_POST["Contrasenia"])?trim($_POST["Contrasenia"]):"";
        $usuario->tipo=ISSET($_POST["Tipo"])?trim($_POST["Tipo"]):"Coach";

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
                if($dao->editar($usuario)){
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    //Al finalizar el guardado redireccionar a la lista
                    //header("Location: IndexAdmin.php");
                }else{
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }
            }
        }


    }


?>