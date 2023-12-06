<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Registro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
    <?= 
       require_once('../datos/daoEquipo.php');
       require_once('../utils/equipoUtil.php');
    ?>
    <div class="box">
        <?php
            if(ISSET($_SESSION["msj"])){
            $mensaje=explode("-",$_SESSION["msj"]);
            ?>
            <div id="mensajes" class="alert alert-<?=$mensaje[0]?>">
                <?=$mensaje[1]?>
            </div>
        <?php
        UNSET($_SESSION["msj"]);}
        ?>
        <div class="container text-center">
            <div class="position-absolute top-0 start-0">
                <img src="img/CCUP.png" class="img-fluid" width="100" height="100" alt="" >
            </div>

            <div class="row justify-content-between">

                <div class="col-6 mt-5">

                    <label class="display-3 mt-4 mb-3">Nuevo Equipo</label>
                    <form method="post" class="needs-validation" novalidate>
                        <p class="d-inline-flex gap-1">
                        <a class="btn btn-outline-secundary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Datos del equipo
                        </a>
                        <a class="btn btn-outline-secundary" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Datos de los Participantes
                        </a>
                        </p>
                        <input type="text" name="Id" value="<?= $equipo->id ?>">
                        <!--    ++++++++++++++++++++++++++++NOMBRE,CONCURSO,FOTO++++++++++++++++++++++++++++++++++++  -->
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">

                                <h2>Datos del equipo</h2>
                                <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                groups
                            </span>
                            <div class="form-floating">
                                <input name="nombre" type="text" class="form-control <?=$valNombre?>" id="floatingInput" value="<?=$equipo->nombreEquipo?>" required>
                                <label for="floatingInput">Nombre</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                    <ul>
                                        <li>Debe tener por lo menos 3</li>
                                        <li>Puede tener maximo 51 caracteres</li>
                                        <li>Solo se permiten letras, numeros y los caracteres #,+,.,-</li>
                                    </ul>
                                </div>
                            </div>                          
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                school
                            </span>
                            <select name="concurso" class="form-select form-select-lg" aria-label="Large select example" required>
                            <?php
                                    $dao = new daoEquipo();
                                    $listaConcursos=$dao->obtenerConcursos();

                                    if (ISSET($listaConcursos)) {
                                    //Carga los renglones en base al registro obtenido
                                        foreach ($listaConcursos as $concurso){         
                                            echo  "<option value='$concurso->id'>
                                                    $concurso->nombre
                                            </option>";
                                        }
                                    }
                                ?>
                            </select>
                              <div class="invalid-tooltip">
                                Campo obligatorio
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text material-symbols-outlined">
                                    mail
                                </span>
                                <input name="file" type="file" class="form-control " id="inputGroupFile01">
                            </div>
                            <div class="invalid-tooltip">
                                Campo obligatorio
                            </div>
                        </div>
                            </div>
                        </div>
                        
                        <!-- +++++++++++++++++++++++++++++++++++++PARTICIPANTES+++++++++++++++++++++++++ -->
                        <div class="collapse" id="collapseExample2">
                            <div class="card card-body">
                            <h2>Nombre de Participantes</h2>
                            <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                person
                            </span>
                            <div class="form-floating">
                                <input name="participante1" type="text" class="form-control <?=$valParticipante1?>" id="floatingInput" value="<?= $equipo->estudiante1 ?>" required>
                                <label for="floatingInput">Nombre participante 1</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                person
                            </span>
                            <div class="form-floating">
                                <input name="participante2" type="text" class="form-control <?=$valParticipante2?>" id="floatingInput" value="<?=$equipo->estudiante2?>" required>
                                <label for="floatingInput">Nombre participante 2</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                person
                            </span>
                            <div class="form-floating">
                                <input name="participante3" type="text" class="form-control <?=$valParticipante3?>" id="floatingInput" value="<?=$equipo->estudiante3?>" required>
                                <label for="floatingInput">Nombre participante 3</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div> 
                            </div>
                        </div>


                        
                                                                
                        <div class="row mt-2">
                            <div class="col-6">
                                <a href="index.php" class=" btn btn-outline-danger" type="button">Cancelar</a> 
                            </div>
                            
                            <div class="col-6">
                                <button id="btnGuardar" class="btn btn-primary" formaction="RegistroEquipo.php">Registrar</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-4  position-absolute top-50 end-0 translate-middle-y">
                  <div id="carouselExampleSlidesOnly" class="carousel slide mb-4 w-100" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="img/no-image-found.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/no-image-found.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/no-image-found.jpg" class="d-block w-100" alt="...">
                      </div>
                    </div>
                  </div>

                  <label class="display-6">Participantes anteriores</label>
                </div>
            
            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/RegistroEquipo.js"></script>
</body>
</html>