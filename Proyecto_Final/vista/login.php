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
                <h1 class="fw-bold text-center">Bienvenido</h1>
                <!--LOGIN-->
                    <div>
                        <form action="#">
                            <div class="formulario w-75">
                                <div class="caja-principal">
                                    <div class="imagen">
                                         <img src="img/icon-usuario.png" alt="">
                                    </div>
                                    <div class="caja-texto">
                                         <input type="email" class="form-control" placeholder="Correo">
                                    </div>
                                 </div>
                                 <div class="caja-principal">
                                     <div class="imagen">
                                          <img src="img/icon-contra.png" alt="">
                                     </div>
                                     <div class="caja-texto">
                                          <input type="password" class="form-control" placeholder="Contraseña">
                                     </div>
                                 </div>
                                 <div class="caja-secundaria ">
                                     <span><a href="#">Olvide mi contraseña</a></span>
                                 </div>
                            </div>
                        </form>
                    </div>
                    <div class="boton pt-2">
                        <a href="index.php" type="submit" class="btn btn-iniciar">Iniciar</a>
                     </div>
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
                        <h2>Tecnológico Nacional de México</h2>
                    </div>
                </div>
                <div>
                    <div class="pt-2 align-self-start">
                        <h5>Dirección</h5><br>
                        <h6>
                            Av. Universidad 1200, Col. Xoco, Ciudad de México, Alcaldía Benito Juárez C.P. 03330
                        </h6>
                    </div>
                </div> 
                <div>
                    <div class="pt-2 align-self-start">
                        <h5>Contacto</h5><br>
                        <h6>
                            Email: contacto@tecnm.mx<br>
                            Telefono: 55 36002500
                        </h6>
                    </div>
                </div>                 
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>