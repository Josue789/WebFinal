<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="css/Registro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
<?php
  //Revisa si hay alguien logueado
  session_start();
  if(!ISSET($_SESSION["usuario"]) || $_SESSION["tipo"]=="Coach"){
    header("Location:login.php");
  }

  // Carga daoConcurso
  require_once('../datos/daoConcurso.php'); 
  
  //Crea una instancia del DAO
  $dao = new DAOConcurso();

  // Revisa si hay algun id enviado, 
  //si hay, significa que se esta pidiendo una eliminacion
  if(ISSET($_POST["id"]) && is_numeric($_POST["id"])){
    //Eliminar
    if($dao->eliminar($_POST["id"])){
      $_SESSION["msj"]="success-El concurso ha sido eliminado correctamente";
    }else{
      $_SESSION["msj"]="danger-No se ha podido eliminar el concurso seleccionado";
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

      <?php
          // Muestra cualquier mensaje pendiente en un alert
          if(ISSET($_SESSION["msj"])){
            $mensaje=explode("-",$_SESSION["msj"]);
        ?>
        <div id="mensajes" class="alert alert-<?=$mensaje[0]?> alert-dismissible fade show">
          <?=$mensaje[1]?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
          UNSET($_SESSION["msj"]);
        }
        ?>
  </header>

    <div class="container d-flex justify-content-center">
      <div class="container-lg ">
       
        <div class="container mb-3">
          <h1>Concursos</h1>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><span class="material-symbols-outlined">
              search
              </span></button>
          </div>
          <table class="table table-info">
              <thead>
                <tr>
                  <th scope="col">Concurso</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Fecha concurso</th>
                  <th scope="col">Fecha Inscripcion</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php
                //Crea el metodo de obtener todos del dao
                $listaConcursos=$dao->obtenerTodos();
                  
                //Verifica que si haya devuelto algo
                if (ISSET($listaConcursos)) {
                  //Carga los renglones en base al registro obtenido
                  foreach ($listaConcursos as $concurso){
                    
                    echo  "<tr> <td>$concurso->nombre</td>
                                <td>$concurso->descripcion</td>
                                <td>$concurso->fechaInicio</td>
                                <td>$concurso->fechaFin</td>
                                <td>".($concurso->estatus?"<span class='badge text-bg-success'>Activo</span>":"<span class='badge text-bg-dark'>Inactivo</span>")."</td>
                                <td>
                                <form method='post'>".
                                  "<button formaction='Equipos.php' class='btn btn-warning m-1' name='id' value='".$concurso->id."'>ver equipos</button>".
                                  "<button formaction='RegistroConcurso.php' class='btn btn-primary m-1' name='id' value='".$concurso->id."'>Editar</button>".
                                  "<button type='button' class='btn btn-danger' onclick='confirmar(this)' name='id' value='".$concurso->id."'>Eliminar</button>".
                                "</form>
                                </td>
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
                  <a href="../utils/cerrarSesion.php"  class=" btn btn-outline-danger" type="button">Cerrar sesión</a> 
              </div>
              
              <div class="col-2  ">
                  <a class=" btn btn-success" type="submit" href="RegistroConcurso.php">Nuevo concurso</a>
              </div>
              
          </div>      
      </div>  
      
      <div class="modal" id="mdlConfirmacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Confirmar eliminación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Está a punto de eliminar a <strong id="spnPersona"></strong> 
               ¿Desea continuar?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form method="post">
              <button class="btn btn-danger" data-bs-dismiss="modal" id="btnConfirmar" name="id">Si, continuar con la eliminación</button>
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
                  <a class="nav-link" href="DescargarListas.php">Descargar listas</a>
                  <a class="btn btn-danger" href="../utils/cerrarSesion.php"  >Cerrar sesion</a>
                </nav>
              </div>
            </div>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/concurso.js"></script>
</body>
</html>