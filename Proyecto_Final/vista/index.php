<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/MainCoach.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"   >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
  <?php
    // Obtiene la fecha actual
    $infoFecha = getdate();

    // Carga daoEquipos
    require_once('../datos/daoEquipo.php'); 
    
    //Crea una instancia del DAO
    $dao = new daoEquipo();

    // Revisa si hay algun id enviado, 
    //si hay, significa que se esta pidiendo una eliminacion
    if(ISSET($_POST["id"]) && is_numeric($_POST["id"])){
      //Eliminar
      if($dao->eliminar($_POST["id"])){
        $_SESSION["msj"]="success-El equipo ha sido eliminado correctamente";
      }else{
        $_SESSION["msj"]="danger-No se ha podido eliminar el equipo seleccionado";
      }
    }
  ?>
  <header class="text-bg-danger">
    <nav class="navbar bg-body-tertiary w-100 h-100 text-bg-primary">
      <div class="container-fluid w-100">
        <div id="carouselExampleInterval" class="carousel slide w-100" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active w-100" data-bs-interval="5000">
              <img src="img/image-not-found-1-scaled-1150x647.png" width="100%" height="150px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item w-100" data-bs-interval="5000">
              <img src="img/image-not-found-1-scaled-1150x647.png" width="100%" height="150px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item w-100" data-bs-interval="5000">
              <img src="img/image-not-found-1-scaled-1150x647.png" width="100%" height="150px" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
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
  <div class="container-fluid scroller">
    <div class="container overflow-hidden text-center">
      <div class="row gx-5">
        <div class="col">
           <div class="p-3 text-start display-5">Coach: </div>
        </div>
        <div class="col">
          <div class="p-3 display-5">Coding cup <?= $infoFecha['year'] ?></div>
        </div>
      </div>
    </div>
    <div class="container mb-3">
      <table class="table table-info">
        <thead>
          <tr>
            <th scope="col">Equipo</th>
            <th scope="col">Institucion</th>
            <th scope="col">Concurso</th>
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
              echo  "<tr> <td>$concurso->nombreEquipo</td>
                          <td>$concurso->institucion</td>
                          <td>$concurso->concurso</td>
                          <td>".($concurso->estatus?"<span class='badge text-bg-success'>Aceptado</span>":"<span class='badge text-bg-warning'>En revision</span>")."</td>
                          <td>
                          <form method='post'>".
                            "<button formaction='RegistroEquipo.php' class='btn btn-primary' name='id' value='$concurso->id'>Editar</button>".
                            "<button type='button' class='btn btn-danger' onclick='confirmar(this)' name='id' value='$concurso->id'>Eliminar</button>".
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
          <a href="login.php" class=" btn btn-outline-danger" type="button">Cerrar sesión</a> 
        </div>
        <div class="col-2  ">
          <a class=" btn btn-primary" type="submit" href="./RegistroEquipo.php">Nuevo equipo</a>
        </div>        
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

  <footer id="sticky-footer" class="flex-shrink-0 py-1 text-white-50 MenuInf">
    <div class="container text-center">
      <div class="row">
        <div class="col-4">
          <img src="img/omegaup.png" height="12%" alt="">
        </div>
        <div class="col-4">
          <img src="img/SSC-blueprism-2col-logo-cmyk-ai (1).png" height="12%" alt="">
        </div>
        <div class="col-4">
          <img src="img/Untitled.png" height="12%" alt="">
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/index.js"></script>
</body>
</html>