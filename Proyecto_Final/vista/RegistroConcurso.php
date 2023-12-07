<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
    <?= 
        //Revisa si hay alguien logueado
        session_start();
        if(!ISSET($_SESSION["usuario"]) || $_SESSION["tipo"]=="Coach"){
            header("Location:login.php");
        }

       require_once('../datos/daoConcurso.php');
       require_once('../utils/concursoUtil.php');
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

                <div class="col-12 mt-5">
                    <label class="display-3 mt-4 mb-3">Nuevo concurso </label>
                    <form method="post" class="needs-validation" novalidate>
                        <input hidden type="text" name="id" value="<?= $concurso->id ?>">


                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                signature
                            </span>
                            <div class="form-floating">
                                <input name="Nombre" type="text" class="form-control <?= $valNombre?>" id="floatingInput" value='<?=$concurso->nombre?>' required>
                                <label for="floatingInput">Nombre</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                event
                            </span>
                            <div class="form-floating">
                                <input name="FechaConcurso" type="date" class="form-control <?=$valFechaCon ?>" id="floatingInput" value=<?= $concurso->fechaFin->format('Y-m-d') ?> required>
                                <label for="floatingInput">Fecha del concurso</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                event
                            </span>
                            <div class="form-floating">
                                <input name="FechaInscripcion" type="date" class="form-control <?= $valFechaIns?>" id="floatingInput" value=<?= $concurso->fechaInicio->format('Y-m-d')?> required>
                                <label for="floatingInput">Fecha de Inscripcion</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                school
                            </span>
                            <select name="Categoria" class="form-select form-select-lg" aria-label="Large select example"  required>
                                <option value="Superior" <?= ($concurso->descripcion=="Superior")
                                                ?"selected":""; ?>>Superior</option>
                                <option value="Media Superior" <?= ($concurso->descripcion=="Media Superior")
                                                ?"selected":""; ?>>Media Superior</option>
                                <option value="TecNM" <?= ($concurso->descripcion=="TecNM")
                                                ?"selected":""; ?>>TecNM</option>
                            </select>
                            <div class="invalid-tooltip">
                               Campo obligatorio
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <input name="Estatus" type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off" <?= $concurso->estatus?"checked":"" ?>>
                            <label class="btn btn-outline-secondary" for="btn-check-2-outlined" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Concurso activo</label><br>
                        </div>


                        
                        <div class="row">
                            <div class="col-6">
                                <a href="concursos.php" class=" btn btn-outline-danger" type="button">Cancelar</a> 
                            </div>
                            
                            <div class="col-6">
                                <button id="btnGuardar" class=" btn btn-primary" formaction="RegistroConcurso.php">Registrar</button>
                            </div>
                        </div>
                    </form>

                </div>

                
            
            </div>

        </div>

    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-warning text-black">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">CUIDADO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Si cambias el estatus del concurso, recuerda lo siguiente:
                <ul>
                    <li>Si el concurso se cambia a activo, todos los otros concursos seran inactivados</li>
                    <li>Si el concurso se cambia a inactivo, todos los otros concursos se quedaran inactivos tambien</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Entendido</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/RegistroConcurso.js"></script>
</body>
</html>