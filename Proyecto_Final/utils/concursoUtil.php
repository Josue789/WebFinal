<?php
    $concurso = new Concurso();

    function validateDate1($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function validateDate2($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    $valNombre=$valFechaCon=$valFechaIns="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){

        //Obtener la informacion de ese id
        $dao=new DAOConcurso();
        $concurso=$dao->obtenerUno($_POST["id"]);

    }elseif(count($_POST)>1){

        $valNombre=$valFechaCon=$valFechaIns="is-invalid";
        $valido=true;
    //---------------------------------------- Proceso de verificacion de campos ---------------------------------
        // * La recoleccion de los input es usando el name

        // ? Validacion de nombre
        if(ISSET($_POST["Nombre"]) && 
          (strlen(trim($_POST["Nombre"]))>3 && strlen(trim($_POST["Nombre"]))<51) &&
            preg_match("/^[a-zA-Z0-9.\s]+$/",$_POST["Nombre"])){
            $valNombre="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de Fecha Concurso
        if(ISSET($_POST["FechaConcurso"]) && validateDate1($_POST["FechaConcurso"])){
            $valFechaCon="is-valid";
        }else{
            $valido=false;
        }

        // ? Validacion de Fecha Inscripcion
        if(ISSET($_POST["FechaInscripcion"]) && validateDate2($_POST["FechaInscripcion"])){
            $valFechaIns="is-valid";
        }else{ 
            $valido=false;
        }


        //Pasa los datos a un object de concurso
        $concurso->id=ISSET($_POST["id"])?trim($_POST["id"]):0;
        $concurso->nombre=ISSET($_POST["Nombre"])?trim($_POST["Nombre"]):"";
        $concurso->fechaInicio=ISSET($_POST["FechaConcurso"])?DateTime::createFromFormat('Y-m-d', $_POST["FechaConcurso"]):new DateTime();
        $concurso->fechaFin=ISSET($_POST["FechaInscripcion"])?DateTime::createFromFormat('Y-m-d', $_POST["FechaInscripcion"]):new DateTime();
        $concurso->descripcion=ISSET($_POST["Categoria"])?trim($_POST["Categoria"]):"";
        $concurso->estatus=ISSET($_POST["Estatus"])?($_POST["Estatus"]=='on'?1:0):0;

        if ($valido) {
            //Usar el método agregar del dao
            $dao= new DAOConcurso();
            
            if($concurso->id==0){
                if($dao->agregar($concurso)==0){
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }else{
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: concursos.php");
                }
            }else{
                if($dao->editar($concurso)){
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