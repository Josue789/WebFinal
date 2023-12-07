<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
    <?php
    //Revisa si hay alguien logueado
    session_start();
    if(!ISSET($_SESSION["usuario"]) || $_SESSION["tipo"]=="Coach" || $_SESSION["tipo"]=="Auxiliar"){
        header("Location:login.php");
    }


    // Cargar el archivo daoUsuario y cualquier otro archivo necesario
    require_once('../datos/daoUsuario.php');
    require_once('../utils/usuarioUtil.php');
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

                    <h1>Nuevo usuario </h1>
                    <form method="post" class="needs-validation" novalidate>
                        <input hidden type="text" name="id" value="<?= $usuario->id ?>">

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                signature
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control <?=$valNombre?>" name="Nombre" id="floatingInput" value="<?= $usuario->nombre?>"  required>
                                <label for="floatingInput">Nombre</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                badge
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control <?=$valUsuario?>" name="Usuario" id="floatingInput" value="<?= $usuario->usuario ?>" required>
                                <label for="floatingInput">usuario</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                lock
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control <?=$valPassword?>" name="Contrasenia" id="floatingInput" required>
                                <label for="floatingInput">Contraseña</label>
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
                                shield_person
                            </span>
                            <select class="form-select <?=$valTipo?>" name="Tipo" aria-label="Large select example" required>
                                <option value="Admin"  <?= ($usuario->tipo=="Admin")
                                                ?"selected":""; ?>>Administrador</option>
                                <option value="Auxiliar" <?= ($usuario->tipo=="Auxiliar")
                                                ?"selected":""; ?>>Auxiliar</option>
                                <option value="Coach" <?= ($usuario->tipo=="Coach")
                                                ?"selected":""; ?>>Coach</option>
                              </select>
                              <div class="invalid-tooltip">
                                <ul>
                                    <li>Debe seleccionar un tipo</li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button id="btnVolver" class="btn btn-outline-danger" type="button">Cancelar</button>
                            </div>
                            
                            <div class="col-6">
                                <button id="btnGuardar" class=" btn btn-primary" formaction="RegistroUsuario.php">Registrar</button>
                            </div>
                            
                        </div>
                    </form>

                </div>

                
            
            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/RegistroUsuarios.js"></script>
</body>
</html>