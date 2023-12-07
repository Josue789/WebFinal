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
    <?= 
       require_once('../datos/daoUsuario.php');
       require_once('../utils/RegistroUtil.php');
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

                    <h1>Nuevo Coach</h1>
                    <form method="post" class="needs-validation" novalidate>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                person
                            </span>
                            <div class="form-floating">
                                <input name="Nombre" type="text" class="form-control <?=$valNombre?>" id="floatingInput">
                                <label for="floatingInput">Nombre</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                            
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                mail
                            </span>
                            <div class="form-floating">
                                <input name="Correo" type="mail" class="form-control <?=$valNombre?>" id="floatingInput">
                                <label for="floatingInput">Correo</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                    <ul>
                                        <li>Debe tener mas de 8 caracteres</li>
                                        <li>Puede contener letras mayusculas, minusculas y numeros</li>
                                        <li>No debe llevar caracteres especiales</li>
                                    </ul> 
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                lock
                            </span>
                            <div class="form-floating">
                                <input name="Contrasenia" type="text" class="form-control <?=$valNombre?>" id="floatingInput" >
                                <label for="floatingInput">Contraseña</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                school
                            </span>
                            <select name="Institucion" class="form-select form-select-lg" aria-label="Large select example">
                                <option value="ITSUR">Tecnologico Superior del sur de Guanajuato</option>
                                <option value="UG">Universidad de Guanajuato</option>
                                <option value="CBTIs 217">Centro de Bachillerato Tecnologico Industrial y Servicios 217</option>
                              </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <a href="login.php" class=" btn btn-outline-danger" type="button">Cancelar</a>  
                            </div>
                            
                            <div class="col-6">
                                <button class=" btn btn-primary" formaction="Registro.php">Registrar</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-3 mt-5">
                  <h1>Bienvenido</h1>

                  <div id="carouselExampleSlidesOnly" class="carousel slide mb-4" data-bs-ride="carousel">
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

                  <h1>Coach</h1>
                </div>
              </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>