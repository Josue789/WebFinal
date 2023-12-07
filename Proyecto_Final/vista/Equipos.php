<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="css/Registro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="dt/Buttons-2.4.2/css/buttons.bootstrap5.min.css">

</head>
<body>
<?php

  session_start();
  if(!ISSET($_SESSION["usuario"]) || $_SESSION["tipo"]=="Coach"){
   header("Location:login.php");
  }elseif(!ISSET($_POST["id"])){
    header("Location: concursos.php");
  }
  // Carga daoConcurso
  require_once('../datos/daoEquipo.php'); 
  require_once('../utils/EquiposUtil.php'); 

  // Revisa si hay algun id enviado, 
  //si hay, significa que se esta pidiendo una actualizacion
  if(ISSET($_POST["idEquipo"]) && is_numeric($_POST["idEquipo"]) && $_POST["idEquipo"]>0){
    $dao = new daoEquipo();
    //Cambiar
    if($dao->ChangeEstatus($_POST["idEquipo"])){
      header("Location: concursos.php");
    }else{
      $_SESSION["msj"]="danger-No se ha podido validar el equipo seleccionado";
    }
  }
?>

  <header class="">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand display-6" href="#" >
            <img src="img/CCUP.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Coding cup
          </a>
          <a  class="navbar-brand display-5" href="#" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><span class="material-symbols-outlined">
            menu
            </span></a>
        </div>
      </nav>
  </header>

    <div class="container d-flex justify-content-center">
      <div class="container-lg ">
       
        <div class="container mb-3">
          <h1>Equipos registrados</h1>
          <table id="lista" class="table table-info table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Institucion</th>
                  <th scope="col">Coach</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  
                //Verifica que si haya devuelto algo
                if (ISSET($listaEquipos)) {
                  //Carga los renglones en base al registro obtenido
                  foreach ($listaEquipos as $equipo){
                    
                    echo  "<tr> <td>$equipo->nombreEquipo</td>
                                <td>$equipo->institucion</td>
                                <td>$equipo->coach</td>
                                <td>".
                                ($equipo->estatus?"<p class='fw-bold'>EQUIPO VALIDADO</p>":"<form method='post'>".
                                "<button type='button' class='btn btn-outline-success' onclick='confirmar(this)' name='idEquipo' value='".$equipo->id."'>Validar</button>".
                              "</form>")
                                ."</td>
                          </tr>";
                  }
                }else {
                  // !SI NO ENCUENTRA NADA SOLO MUESTRA UN MENSAJE, ESTO ES SOLO POR PREFERENCIA MIA
                  // TODO: Cambiar esto por un modal que informe que hay problemas
                  echo "<tr>NO HAY DATOS AUN</tr>";
                }
              ?>
              </tbody>
          </table>

          <div class="row justify-content-between">
              <div class="col-6">
                  <a href="concursos.php" class=" btn btn-outline-danger" type="button">Regresar</a> 
              </div>
          </div>      
      </div>  
      
      <div class="modal" id="mdlConfirmacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Confirmar validación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Está a punto de validar al equipo <strong id="spnPersona"></strong> 
              y estará aceptado para participar
               ¿Desea continuar?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form method="post">
              <button class="btn btn-success" data-bs-dismiss="modal" id="btnConfirmar" name="idEquipo">Validar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    </div>
        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="staticBackdropLabel">Menu administrador</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div>
                <nav class="nav flex-column nav-underline">
                  <a class="nav-link "  href="IndexAdmin.php">Usuarios</a>
                  <a class="nav-link active" aria-current="page" href="#">Concursos</a>
                  <a class="nav-link" href="DescargaListas.php">Descargar listas</a>
                  <a class="btn btn-danger" href="#" >Cerrar sesion</a>
                </nav>
              </div>
            </div>
          </div>
    </div>

    <script src="dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script> 
    <script src="dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="dt/JSZip-3.10.1/jszip.min.js"></script>
    <script src="dt/pdfmake-0.2.7/pdfmake.min.js"></script>
    <script src="dt/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.html5.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.print.min.js"></script>
    <script src="dt/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
    <script src="js/equipo.js"></script>
</body>
</html>