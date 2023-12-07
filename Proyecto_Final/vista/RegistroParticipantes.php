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
    <div class="box">
        <div class="container text-center">
            <div class="position-absolute top-0 start-0">
                <img src="img/CCUP.png" class="img-fluid" width="100" height="100" alt="" >
            </div>

            <div class="row justify-content-between">

                <div class="col-6 mt-5">

                    <label class="display-3 mt-4 mb-3">Participantes </label>
                    <form action="" class="needs-validation" novalidate>

                        <div class="input-group mb-3">
                            <span class="input-group-text material-symbols-outlined p-3">
                                person
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Juan Pérez " required>
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
                                <input type="text" class="form-control" id="floatingInput" placeholder="Juan Pérez " required>
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
                                <input type="text" class="form-control" id="floatingInput" placeholder="Juan Pérez " required>
                                <label for="floatingInput">Nombre participante 3</label>
                                <div class="invalid-tooltip">
                                    Campo obligatorio
                                </div>
                            </div>
                        </div>



                        
                        <div class="row">
                            <div class="col-6">
                                <a href="index.php" class=" btn btn-outline-danger" type="button">Cancelar</a> 
                            </div>
                            
                            <div class="col-6">
                                <button id="btnGuardar" class=" btn btn-primary" type="submit">Registrar</button>
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
    <script src="js/RegistroParticipantes.js"></script>
</body>
</html>