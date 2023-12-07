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
        require_once('../datos/daoUsuario.php');
        require_once('../utils/RecuperarUtil.php');
    
    ?>
    <div class="container text-center">
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
        <div class="card w-90 mt-3">
        <div class="card-body">
            <div class="card-header">
                <h5>Recuperar contraseña</h5>
            </div>
            <form method="POST" class="mt-3">
                <div class="input-group mb-3">
                    <span class="input-group-text material-symbols-outlined p-3">
                        mail
                    </span>
                    <div class="form-floating">
                        <input name="Usuario" type="text" class="form-control <?=$valNombre?>" id="floatingInput">
                        <label for="floatingInput">Correo o Usuario</label>
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
                        <input name="Contrasenia" type="text" class="form-control <?=$valNombre?>" id="floatingInput">
                        <label for="floatingInput">Nueva contraseña</label>
                        <div class="invalid-tooltip">
                            Campo obligatorio
                        </div>
                    </div>                        
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="login.php" class=" btn btn-outline-danger" type="button">Cancelar</a>  
                    </div>
                    
                    <div class="col-6">
                        <button class=" btn btn-primary" formaction="RecuperarContrasenia.php">Cambiar</button>
                    </div>
                </div>
            </form>
            
        </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>