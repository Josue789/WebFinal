<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesion</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">    
    
</head>
<body>
    <?php
        require_once('../utils/loginUtil.php');

        if(ISSET($_SESSION["msj"])){
            $mensaje=explode("-",$_SESSION["msj"]);
    ?>
            <div id="mensajes" class="alert alert-<?=$mensaje[0]?> alert-dismissible fade show">
                <?=$mensaje[1]?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
            UNSET($_SESSION["msj"]);}
    ?>
    <div>
        <div class="row align-items-stretch">
            <div class="col caja-izquierda p-4">
                <div class="caja-principal">
                    <div class="align-self-start">
                        <img src="img/logo-coding.png" width="100" alt="">
                    </div>
                    <div class="titulo pt-1">
                        CodingCup TECNM
                    </div>
                    <div class="align-self-end">
                        <img src="img/logo-itsur.png" width="100" alt="">
                    </div>
                </div>
                <h2 class="fw-bold text-center">Bienvenido</h2>
                <!--LOGIN-->
                    <div>
                        <form method="POST">
                            <div class="formulario w-75">
                                <div class="caja-principal">
                                    <div class="imagen">
                                         <img src="img/icon-usuario.png" alt="">
                                    </div>
                                    <div class="caja-texto">
                                         <input name="Usuario" type="text" class="form-control" placeholder="Correo/Usuario">
                                    </div>
                                 </div>
                                 <div class="caja-principal">
                                     <div class="imagen">
                                          <img src="img/icon-contra.png" alt="">
                                     </div>
                                     <div class="caja-texto">
                                          <input name="Contrasenia" type="password" class="form-control" placeholder="Contraseña">
                                     </div>
                                 </div>
                                 <div class="caja-secundaria ">
                                     <span><a href="RecuperarContrasenia.php">Olvide mi contraseña</a></span>
                                 </div>
                            </div>
                            </div>
                         <div class="boton pt-2">
                            <button  formaction="login.php" class="btn btn-iniciar">Iniciar</button>
                        </div>
                        </form>
                 
                    <div class=" caja-tercearia">
                        <span>No tienes cuenta?<a href="Registro.php">Registrate</a></span>
                    </div>
            </div>
            <div class="col caja-derecha d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
                <div class="logo_tecnm">
                    <img src="img/logo-tecnm.png" width="200" alt="">
                </div>
                <div>
                    <div class="titulo pt-3 px-3 pb-4">
                        <label class="form-label">Tecnológico Nacional de México</label>
                    </div>
                </div>
                <div>
                    <div class="pt-2 align-self-start">
                        <label class="form-label">Dirección</label><br>
                        <label class="form-label">
                            Av. Universidad 1200, Col. Xoco, Ciudad de México, Alcaldía Benito Juárez C.P. 03330
                        </label>
                    </div>
                </div> 
                <div>
                    <div class="pt-2 align-self-start">
                        <label class="form-label">Contacto</label><br>
                        <label class="form-label">
                            Email: contacto@tecnm.mx<br>
                            Telefono: 55 36002500
                        </label>
                    </div>
                </div>                 
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>