<?php
    $equipo = new Equipo();


    $valNombre=$valParticipante1=$valParticipante2=$valParticipante3="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la informacion de ese id
        $dao=new DAOEquipo();
        $equipo=$dao->obtenerUno($_POST["id"]);

    }elseif(count($_POST)>1){

        $valNombre=$valParticipante1=$valParticipante2=$valParticipante3="is-invalid";
        $valido=true;

    //---------------------------------------- Proceso de verificacion de campos ---------------------------------
        // * La recoleccion de los input es usando el name

        // ? Validacion de nombre
        if(ISSET($_POST["nombre"]) && 
          (strlen(trim($_POST["nombre"]))>3 && strlen(trim($_POST["nombre"]))<51) &&
            preg_match("/^[a-zA-Z0-9.#+\s-]+$/",$_POST["nombre"])){
            $valNombre="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de participante 1
        if(ISSET($_POST["participante1"]) && 
        (strlen(trim($_POST["participante1"]))>3 && strlen(trim($_POST["participante1"]))<51) &&
          preg_match("/^[a-zA-Z0-9.\s]+$/",$_POST["participante1"])){
          $valNombre="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de participante 2
        if(ISSET($_POST["participante2"]) && 
        (strlen(trim($_POST["participante2"]))>3 && strlen(trim($_POST["participante2"]))<51) &&
          preg_match("/^[a-zA-Z0-9.\s]+$/",$_POST["participante2"])){
          $valNombre="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de participante 3
        if(ISSET($_POST["participante3"]) && 
        (strlen(trim($_POST["participante3"]))>3 && strlen(trim($_POST["participante3"]))<51) &&
          preg_match("/^[a-zA-Z0-9.\s]+$/",$_POST["participante3"])){
          $valNombre="is-valid";
        }else{
            $valido=false;
        }
        


        //Pasa los datos a un object de concurso
        $equipo->id=ISSET($_POST["Id"])?trim($_POST["Id"]):0;
        $equipo->nombreEquipo=ISSET($_POST["nombre"])?trim($_POST["nombre"]):"";
        $equipo->institucion=ISSET($_SESSION["institucion"])?ISSET($_SESSION["institucion"]):"UNKNOWN";
        $equipo->concurso=ISSET($_POST["concurso"])?trim($_POST["concurso"]):"";
        $equipo->estudiante1=ISSET($_POST["participante1"])?trim($_POST["participante1"]):"";
        $equipo->estudiante2=ISSET($_POST["participante2"])?trim($_POST["participante2"]):"";
        $equipo->estudiante3=ISSET($_POST["participante3"])?trim($_POST["participante3"]):"";

        if ($valido) {
            //Usar el método agregar del dao
            $dao= new DAOEquipo();
            if($equipo->id==0){
                $coach= $_SESSION["usuario"];

                if($dao->agregar($equipo,$coach)==0){
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }else{
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: index.php");
                }
            }else{
                if($dao->editar($equipo)){
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: index.php");
                }else{
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }
            }
        }


    }


?>