<?php
    $equipo = new Equipo();

    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la informacion de ese id
        $dao=new DAOEquipo();
        $listaEquipos=$dao->obtenerTodosPorConcurso($_POST["id"]);

    }elseif(count($_POST)>1){

    }


?>